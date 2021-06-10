<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use URL;
use Session;
use PDF;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;

use App\Mail\WelcomeMail;
use App\Mail\PasswordChangeMail;
use App\Mail\OrderCancelMail;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Earning;

class CustomerController extends BaseController
{

	public function __construct()
	{
		// $this->middleware(['auth','verified']);
		// $this->middleware('verified');
		// $this->middleware('auth');
	    $this->middleware(function ($request, $next) {
	        $this->user = Auth::user();
	        /*if (!$this->user->email_verified_at) {
	        	return Redirect::guest(URL::route('verification.notice'));
	        }elseif ($this->user->role_id!=4) {
	        	return Redirect::to('/');
	        }*/

	        return $next($request);
	    });
	}

	/* Find Proofreader Get*/
	public function findProofreader()
	{
		$order_id = Session::get('order_id');
		$user = Auth::user();
		$cancel_button_show_time_for_customer = floor(config('site.cancel_button_show_time_for_customer')*60);
		if ($order_id>0) {
			$order = Order::where('id',$order_id)->where('user_id',$user->id)->first();
		}else{
			$order = Order::whereRaw("(status='1' or status='2') and user_id='".$user->id."'")
				->orderBy('id', 'desc')
				->first();
		}
		if ($order) {
			$created_at = $order->created_at;
			$total_second = datediff("s",date('Y-m-d H:i:s', strtotime($created_at)),date('Y-m-d H:i:s'));
			if ($total_second >= $cancel_button_show_time_for_customer) {
				$cancel_button_show_time = 0;
			}else{
				$cancel_button_show_time = ($cancel_button_show_time_for_customer - $total_second);
			}
			if ($order->status=='1') {
				return view('frontend.find_proofreader', compact('order', 'cancel_button_show_time'));
			}elseif ($order->status=='2') {
				$proofreader = User::where('id',$order->proofreader_id)->first();
				return view('frontend.found_proofreader', compact('order', 'cancel_button_show_time', 'proofreader'));
			}else{
				return Redirect::to('my-orders'); 
			}
		}else{
			return Redirect::to('file-upload'); 
		}		
	}

	/* Find Proofreader Check Get*/
	public function foundProofreader()
	{
		$type = $redirect = '0';
		$order_id = Session::get('order_id');
		$user = Auth::user();
		$cancel_button_show_time_for_customer = floor(config('site.cancel_button_show_time_for_customer')*60);
		if ($order_id>0) {
			$order = Order::where('id',$order_id)->where('user_id',$user->id)->first();
		}else{
			$order = Order::whereRaw("(status='1' or status='2') and user_id='".$user->id."'")
				->orderBy('id', 'desc')
				->first();
		}
		if ($order) {
			if ($order->status=='1') {
				$type=0;
			}elseif ($order->status=='2') {
				$type=1;
				$redirect = url('find-proofreader');
			}else{
				$type=1;
				$redirect = url('my-orders');
			}
		}else{
			$type=1;
			$redirect = url('file-upload');
		}
		$return = array('type'=>$type, 'redirect'=>$redirect);
		echo json_encode($return);
	} 

	/* My Profile Get*/
	public function my_profile()
	{
		$user = currentUserDetails();
		return view('frontend.profile', compact('user'));
	} 

	/* Update Profile Post*/
	public function updateProfile(Request $request)
	{
		$id = $request->id;
		$user = Auth::user();
		if ($id != $user->id) {
			\Session::flash('message','Sorry, Profile is not updated! Please try again.');
			return redirect()->back();
		}

		$rules = array(
			'first_name' => 'required|string|max:191',
			'last_name' => 'required|string|max:191',
			'email' => 'required|string|email|max:191|unique:users,email,'.$id,
		);

		if($request->hasfile('avatar'))
		{
			$rules['avatar'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator) 
			->withInput(request()->except('password')); 
		}
		else
		{
			if($request->hasfile('avatar'))
			{
				if($user->avatar!='' && file_exists(public_path().'/uploads/'.$user->avatar))
				{
					unlink(public_path().'/uploads/'.$user->avatar);
				}
				$avatar = $request->file('avatar');
				$filename = $avatar->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$avatar->move(public_path().'/uploads/', $filename);
				//$update_array['avatar'] = $filename;
				$user->avatar = $filename;
			}

			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$job_sound = $request->job_sound=='1'?'1':'0';
			if ($user->role_id=='3') {
				$user->job_sound = $job_sound;
				$user->account_holder = $request->account_holder;
				$user->short_code = $request->short_code;
				$user->account_no = $request->account_no;
			}else{
				$user->address_1 = $request->address_1;
				$user->address_2 = $request->address_2;
				$user->city = $request->city;
				$user->province = $request->province;
				$user->postcode = $request->postcode;				
			}
			$user->save();

			$msg = 'Your account has been updated successfully.' ;
			\Session::flash('message',$msg);
			return redirect()->back();

		}
	}

	/* Change Password Post*/
	public function changePassword(Request $request)
	{
		$id = $request->id;
		$user = currentUserDetails();
		if ($id != $user->id) {
			\Session::flash('message','Sorry, Password is not updated! Please try again.');
			return redirect()->back();
		}

		$password = $request->password;

		$rules = array(
			'password' => 'min:8|confirmed'
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('profile/')->withErrors($validator)->withInput($request->all()); 
		}
		else
		{
				$updateUser = User::find($id);
				$updateUser->password = Hash::make($password);
				$updateUser->save();

				$fullname = $user->first_name.' '.$user->last_name;

				/*Password Change Email*/
				$data1 = array('fullname' => $fullname, 'password' => $password);

		        Mail::to($user->email)->send(new PasswordChangeMail($data1));

				return redirect()->back()->with('message', 'Password has been updated successfully.');

		}
	} 

	/* Profile Delete Post*/
	public function profile_delete(Request $request)
	{
		$id = $request->id;
		$user = Auth::user();
		if ($id != $user->id) {
			\Session::flash('message','Sorry, Profile is not deleted! Please try again.');
			return redirect()->back();
		}
		$user->status = '2'; 
		$user->save();
			$msg = 'Your account has been deleted successfully.';

		/*DB::delete('delete from users where id = ?',[$id]);*/

		\Session::flash('message',$msg);
		return Redirect::to('logout/');
	}

	/* Cancel Order Get*/
	public function order_cancel($id)
	{
		$order = Order::find($id);
		$user = currentUserDetails();
		$msg = '';
		if ($order->user_id == $user->id) {
			if ($order->status=='3') {
				$msg = 'Your order already cancelled.';
			}elseif ($order->status=='4') {
				$msg = 'Your order is completed.';
			}else{
				DB::table('av_earning_tbl')->whereRaw("order_id='".$order->id."'")->update(array('status' => '2'));

				$order->status = '3';
				$order->save();
				$msg = 'Your order has been cancelled successfully.';	

				/*Order Complete Email*/
				$customer = userDetails($order->user_id);
				$fullname = $customer->first_name.' '.$customer->last_name;
			    $data1 = array('fullname' => $fullname, 'first_name' => $customer->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id));
			    Mail::to($customer->email)->send(new OrderCancelMail($data1));

			    if ($order->proofreader_id>0) {
				    /*Order Complete Email To Admin*/
				    $proofreader = userDetails($order->proofreader_id);
					$fullname = $proofreader->first_name.' '.$proofreader->last_name;
				    $data2 = array('fullname' => $fullname, 'first_name' => $proofreader->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id));
				    Mail::to($customer->email)->send(new OrderCancelMail($data2));
			    }

			    /*Order Complete Email To Admin*/
				$admin_email = config('site.contact_email');
			    Mail::to($admin_email)->send(new OrderCancelMail($data1));			
			}
			\Session::flash('message', $msg);
		}
		return Redirect::to('my-orders'); 
	}

	/* My Order Get*/
	public function my_orders()
	{
		$user = currentUserDetails();

		$sorderby = Request()->sorderby;
		$sorder = Request()->sorder;
		if(!$sorderby && !$sorder)
		{
			$sorderby = 'created_at';
			$sorder = 'desc';
		}
		$sorder = $sorderby=='created_at'?'desc':'asc';
		$orders = Order::where("user_id",$user->id)->orderBy($sorderby, $sorder)->get();
		return view('frontend.my_orders', compact('user', 'orders','sorderby','sorder'));
	}

	/* Download Order Receipt Get*/
	public function order_receipt($id)
	{
		$order = Order::find($id);
		$user = currentUserDetails();
		$msg = '';
		if ($order->user_id == $user->id) {			
		    $proofreader = userDetails($order->proofreader_id);

			$pdf = PDF::loadView('frontend.order-receipt-pdf', compact('order','user','proofreader'));
			//\Session::flash('message', $msg);
			return $pdf->download('Invoice.pdf');
			// return view('frontend.order-receipt-pdf', compact('order','user'));
		}
		return Redirect::to('my-orders'); 
	}
}