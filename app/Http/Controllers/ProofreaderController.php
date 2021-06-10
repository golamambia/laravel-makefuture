<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use URL;

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
// use App\Mail\PaymentReleaseRequestMailToAdmin;
use App\Mail\OrderAcceptMail;
use App\Mail\OrderCompleteMail;
use App\Mail\OrderCompleteMailToAdmin;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\OrderShow;
use App\Models\Transaction;
use App\Models\Earning;
use App\Models\PaymentRequestRelease;

class ProofreaderController extends BaseController
{

	public function __construct()
	{
		$this->middleware(['auth','verified']);
	    $this->middleware(function ($request, $next) {
	        $this->user = Auth::user();
	        if (!$this->user->email_verified_at) {
	        	return Redirect::guest(URL::route('verification.notice'));
	        }elseif ($this->user->role_id!=3) {
	        	return Redirect::to('/');
	        }/**/
	        return $next($request);
	    });
	}

	/* Proofreader Dashboard Get*/
	public function dashboard()
	{
		$user = $this->user;

			/*$order = Order::where('id',70)->first();
			$customer = userDetails($order->user_id);
			$proofreader_fullname = $user->first_name.' '.$user->last_name;
			$fullname = $customer->first_name.' '.$customer->last_name;
		    $data1 = array('fullname' => $fullname, 'first_name' => $customer->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id), 'proofreader_fullname' => $proofreader_fullname);
		    Mail::to($customer->email)->send(new OrderAcceptMail($data1));*/

		return view('frontend.dashboard', compact('user'));
	}

	/* Get New Job Get*/
	public function getNewJobs()
	{
		$user = currentUserDetails();
		$jobs = array();
		$jobs[$user->id] = array();

		$orders = Order::whereRaw("payment_status='1' and proofreader_id='0' and (status='0' or status='1')")->orderBy('created_at', 'asc')->get(); // and current_show_proofreader='0'

		$show_time_for_proofreader = config('site.unallocated_job_show_time_for_proofreader');
		$check_order = '';
		$new_job = '0';
		foreach ($orders as $key => $order) {
			$all_proofreader = User::where('already_logged','1')
			->where('role_id','3')->where('status','1')->where('accept_word','>=',$order->no_of_word)
			->orderBy('last_login', 'asc')
			->get();
			$show='yes';
			$get_order = $order;
			$get_order->order_id = get_orderID($order->id);
			$get_order->message = $order->notes?description_show($order->notes):'';
			$get_order->accept_url = url('order/accept/'.$order->id);
			$get_order->reject_url = url('order/reject/'.$order->id);
			$get_order->upload_file_name = get_file_name($order->upload_file);
			$proofreader_count = 0;
			foreach ($all_proofreader as $u) {
				$check_order = Order::whereRaw("proofreader_id='".$u->id."' and status='2'")->get();
				$check_order_show = array();
				$check_order_show = OrderShow::select('av_order_show_tbl.*')
				->join('av_order_tbl', 'av_order_show_tbl.order_id', '=', 'av_order_tbl.id')
				->where('av_order_show_tbl.status','0')
				->where('av_order_tbl.status','1')
				->where('av_order_show_tbl.user_id',$u->id)
				->orderBy('av_order_show_tbl.id', 'desc')
				->first();
				if ($show=='yes' && $u->accept_word>=$order->no_of_word && count($check_order)==0) {
					$proofreader_count++;
					$job_show = OrderShow::where('order_id',$order->id)->where('user_id',$u->id)->first();
					if ($check_order_show) {
						if ($order->id==$check_order_show->order_id) {
							// $order_up = Order::find($order->id);
							// $order_up->current_show_proofreader = $u->id;
							// $order_up->save();

							$jobs[$u->id][] = $get_order;
							$show_time_for_proofreader1 = date('Y-m-d H:i:s', strtotime('-'.$show_time_for_proofreader.' sec'));
							if ($job_show->created_at>$show_time_for_proofreader1) {
								$show='no';
							}
						}
					} elseif ($job_show) {
						if ($job_show->status == '0') {
							// $show_time_for_proofreader1 = date('Y-m-d H:i:s', strtotime('-'.$show_time_for_proofreader.' minute'));
							$show_time_for_proofreader1 = date('Y-m-d H:i:s', strtotime('-'.$show_time_for_proofreader.' sec'));
							if ($job_show->created_at<=$show_time_for_proofreader1) {
								// $job_show->status = '1';
								// $job_show->save();

								$order_up = Order::find($order->id);
								$order_up->current_show_proofreader = '0';
								$order_up->save();
							}else{
								$show='no';								
							}
								$jobs[$u->id][] = $get_order;
						}elseif ($job_show->status == '1') {
							$cal_time = ($show_time_for_proofreader * ($proofreader_count-1))+15;
							$check_user = date('Y-m-d H:i:s', (strtotime($order->created_at)+$cal_time));
							//if (date('Y-m-d H:i:s')>$check_user && time()>(strtotime($job_show->updated_at)+5)) {
							if (time()>(strtotime($job_show->updated_at)+$show_time_for_proofreader)) {
								$show='yes';
								$jobs[$u->id][] = $get_order;
								$job_show->status = '0';
								$job_show->save();
								$new_job='1';
							}else{
								$show='no';
							}
							/*if (time()>(strtotime($job_show->updated_at)+$show_time_for_proofreader)) {
							}else{
								$show='no';								
							}*/
						}
					}else{
						$cal_time = ($show_time_for_proofreader * $proofreader_count)+1;
						// $check_user = date('Y-m-d H:i:s', strtotime('+'.$cal_time.' minute', strtotime($order->created_at)));
						$check_user = date('Y-m-d H:i:s', (strtotime($order->created_at)+$cal_time));
						if (date('Y-m-d H:i:s')>$check_user) {
							$show='yes';
						}else{
							$show='no';
						}
						$jobs[$u->id][] = $get_order;
						
						if ($u->id==$user->id) {
							$order_up = Order::find($order->id);
							$order_up->current_show_proofreader = $u->id;
							$order_up->save();

							$order_show = new OrderShow();
							$order_show->user_id = $u->id;
							$order_show->order_id = $order->id;
							$order_show->status = '0';
							$order_show->save();
							$new_job='1';
						}
					}
				}
			}
			$check_job_show = OrderShow::where('order_id',$order->id)->where('status','1')->get();
			if (count($check_job_show)>=count($all_proofreader) && count($check_job_show)>0) {
				//DB::delete('delete from av_order_show_tbl where order_id = ?',[$order->id]);
			}
		}
		if ($user->job_sound!='1' || !config('site.unallocated_job_offered_audio') || !file_exists(public_path('uploads/'.config('site.unallocated_job_offered_audio')))) {
			$new_job='0';
		}
		$return = array('all_jobs'=>$jobs, 'jobs'=>$jobs[$user->id],'new_job'=>$new_job);
		echo json_encode($return);
	}

	/* Proofreader update accept word / status Get*/
	public function updateUserDetails(Request $request)
	{
		$user = $this->user;
		$accept_word = round(str_replace(',', '', $request->accept_word));
		$already_logged = $request->already_logged=='1'?'1':'0';
		$msg = 'Sorry, nothing is updated!';
		$type = $redirect = '0';
		if ($user->role_id==3) {
			$check_order = Order::whereRaw("proofreader_id='".$user->id."' and status='2'")->get();
			$msg = '';
			if (count($check_order)==0 || $user->already_logged == $already_logged) {
				if ($user->accept_word != $accept_word && $already_logged=='1') {
					$msg = 'Max Word Count Updated!';
				}elseif ($user->already_logged != $already_logged) {
					$msg = 'Profile updated!';
				}
				if ($user->already_logged=='0' && $already_logged=='1') {
					$user->last_login = date('Y-m-d H:i:s');
					// DB::delete('delete from av_order_show_tbl where status="0" and user_id = ?',[$user->id]);
				}

				if ($user->already_logged=='1' && $accept_word<=0) {
					$msg = 'You can not set Max Word Count less then one!';
				}elseif ($already_logged=='1' && $accept_word<=0) {
					$msg = 'Please set your Max Word Count before going online';
					\Session::flash('message',$msg);
					$redirect = '1';
				}else{
					$user->accept_word = $accept_word;
					$user->already_logged = $already_logged;
					$user->save();
				}
			}else{
				$msg = 'Please complete your job before going online!';
				\Session::flash('message',$msg);
				$redirect = '1';
			}
		}
		$accept_word = number_format($user->accept_word);
		$return = array('msg'=>$msg, 'type'=>$type, 'redirect'=>$redirect, 'accept_word'=>$accept_word);
		echo json_encode($return);
	}

	/* Proofreader Update Sound Get*/
	public function updateSaveUserDetails(Request $request)
	{
		$user = $this->user;
		$job_sound = $request->job_sound=='1'?'1':'0';
		$msg = 'Sorry, nothing is updated!';
		$type = $redirect = '0';
		if ($user->role_id==3) {
			$user->job_sound = $job_sound;
			$user->save();
			$type = 1;
			$msg = 'Job Sound updated!';
		}
		$return = array('msg'=>$msg, 'type'=>$type, 'redirect'=>$redirect);
		echo json_encode($return);
	}

	/* Proofreader Accept Get*/
	public function orderAccept($id)
	{
		$user = $this->user;
		$msg = 'Sorry, job has expired';
		$job_show = OrderShow::where('order_id',$id)->where('user_id',$user->id)->where('status','0')->first();
		$order = Order::where('id',$id)->where('proofreader_id','0')->where('status','1')->first();
		if ($job_show && $order) {
			$order->proofreader_id = $user->id;
			$order->status = '2';
			$order->order_accept = date('Y-m-d H:i:s');
			$order->save();

			// Priority Change
			$user->last_login = date('Y-m-d H:i:s');
			$user->already_logged = '0';
			$user->save();

			// $job_show->status = '1';
			// $job_show->save();

			// $percentage_for_proofreader = config('site.percentage_for_proofreader');
			// $total_amount = $order->total_amount;
			// $amount = $total_amount * $percentage_for_proofreader/100;

			// $earning = new Earning();
			// $earning->user_id = $user->id;
			// $earning->order_id = $order->id;
			// $earning->amount = $amount;
			// $earning->status = '0';
			// $earning->save();

			$msg = 'Job accepted! Click <a href="'.url('/my-jobs/').'">“My Jobs”</a> to access file.';

			/*Order Accepted Email*/
			$customer = userDetails($order->user_id);
			$proofreader_fullname = $user->first_name.' '.$user->last_name;
			$fullname = $customer->first_name.' '.$customer->last_name;
		    $data1 = array('fullname' => $fullname, 'first_name' => $customer->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id), 'proofreader_fullname' => $proofreader_fullname);
		    Mail::to($customer->email)->send(new OrderAcceptMail($data1));
		}
		\Session::flash('message',$msg);
		return Redirect::to('dashboard');
	}

	/* Proofreader Reject Get*/
	public function orderReject($id)
	{
		$user = $this->user;
		$msg = 'Sorry, job has been expaired.';
		$job_show = OrderShow::where('order_id',$id)->where('user_id',$user->id)->where('status','0')->first();
		$order = Order::where('id',$id)->where('proofreader_id','0')->first();
		if ($job_show && $order) {
			$job_show->status = '1';
			$job_show->save();

			$order->current_show_proofreader = '0';
			$order->save();
			$msg = 'Job has been rejected successfully.';

			// Priority Change
			$user->last_login = date('Y-m-d H:i:s');
			$user->save();
		}
		\Session::flash('message',$msg);
		return Redirect::to('dashboard');
	}

	/* Proofreader my Jobs Get*/
	public function myJobs()
	{
		$user = $this->user;
		$item_display_per_page = config('site.pagination');
		$orders = Order::select('av_order_tbl.*','av_earning_tbl.amount')
		->where('proofreader_id',$user->id)
		->leftjoin('av_earning_tbl', 'av_order_tbl.id', '=', 'av_earning_tbl.order_id')
		->orderBy('created_at', 'desc')
		->paginate($item_display_per_page);
		return view('frontend.my_jobs', compact('user','orders'));
	}

	/* Proofreader Order Save Post*/
	public function orderProofreaderSave(Request $request)
	{
		$user = $this->user;
		$msg = 'Sorry, nothing is save.';
		$id = $request->id;
		$proofreader_notes = $request->proofreader_notes;

		$order = Order::where('id',$id)->where('proofreader_id',$user->id)->where('status','2')->first();
		if (!$order) {
			return redirect()->back()->with('message', $msg);
		}

		$rules = array(
			'id' => 'required|integer',
		);

		if($request->hasfile('download_file'))
		{
			$rules['download_file'] = 'mimes:txt,doc,docx,xml,rtf,TXT,DOC,DOCX,XML,RTF|max:5140';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('my-jobs')->withErrors($validator)->withInput(); 
		}
		else
		{			
			if($request->hasfile('download_file'))
			{
				if($order->download_file && file_exists(public_path().'/uploads/order/'.$order->download_file))
				{
					unlink(public_path().'/uploads/order/'.$order->download_file);
				}
				$download_file = $request->file('download_file');
				$filename1 = $download_file->getClientOriginalName();
				$filename1 = str_replace("&", "and", $filename1);
				$filename1 = str_replace(" ", "_", $filename1);
				$filename2 = time().'_'.$filename1;
				$download_file->move(public_path().'/uploads/order/', $filename2);  

				$order->download_file = $filename2;
			}
			$order->proofreader_notes = $proofreader_notes;
			$order->save();
			$msg = 'Job has been saved successfully.';
		}
		return redirect()->back()->with('message', $msg);
	}

	/* Proofreader Order Delete Download File Get*/
	public function orderProofreaderDeleteDownloadFile($id)
	{
		$user = $this->user;
		//$msg = 'Sorry, nothing is deleted.';
		$order = Order::where('id',$id)->where('proofreader_id',$user->id)->where('status','2')->first();
		if ($order && $order->download_file && file_exists(public_path().'/uploads/order/'.$order->download_file)) {
			unlink(public_path().'/uploads/order/'.$order->download_file);
			$order->download_file = '';
			$order->save();
			$msg = 'File has been deleted successfully.';
		}
		return redirect()->back()->with('message', $msg);
	}



	/* Proofreader Order Complete Get*/
	public function orderProofreaderComplete($id)
	{
		$user = $this->user;
		$msg = 'Sorry, nothing is completed.';
		$order = Order::where('id',$id)->where('proofreader_id',$user->id)->where('status','2')->first();
		if ($order && $order->download_file && file_exists(public_path().'/uploads/order/'.$order->download_file)) {
			$order->status = '4';
			$order->order_complete = date('Y-m-d H:i:s');
			$order->save();
			$msg = 'Job has been completed successfully.';

			$percentage_for_proofreader = config('site.percentage_for_proofreader');
			$total_amount = $order->total_amount;
			$amount = $total_amount * $percentage_for_proofreader/100;

			DB::table('av_earning_tbl')->whereRaw("order_id='".$order->id."'")->update(array('status' => '2'));
			/*$earning = Earning::where('order_id',$order->id)->where('user_id',$user->id)->first();
			if (!$earning) {
				$earning = new Earning();
			}*/	
			$earning = Earning::firstOrNew(array('order_id' => $order->id,'user_id' => $user->id));		
			$earning->user_id = $user->id;
			$earning->order_id = $order->id;
			$earning->amount = $amount;
			$earning->status = '0';
			$earning->save();


			$payment_release_request_array = PaymentRequestRelease::where('status','0')->where('user_id',$user->id)->first();
			if (!$payment_release_request_array) {
				$payment_release_request = new PaymentRequestRelease();
				$payment_release_request->user_id = $user->id;
				$payment_release_request->status = '0';
				$payment_release_request->save();
			}

			// Priority Change
			$user->last_login = date('Y-m-d H:i:s');
			$user->save();

			/*Order Complete Email*/
			$customer = userDetails($order->user_id);
			$proofreader_fullname = $user->first_name.' '.$user->last_name;
			$fullname = $customer->first_name.' '.$customer->last_name;
		    $data1 = array('fullname' => $fullname, 'first_name' => $customer->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id), 'proofreader_fullname' => $proofreader_fullname);
		    Mail::to($customer->email)->send(new OrderCompleteMail($data1));

		    /*Order Complete Email To Admin*/
		    if (config('site.order_email_option')=='yes') {
				// $admin_email = config('site.contact_email');
				$admin_email = config('site.order_email');
			    $data1 = array('fullname' => $fullname, 'first_name' => $customer->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id), 'proofreader_fullname' => $proofreader_fullname);
			    Mail::to($admin_email)->send(new OrderCompleteMailToAdmin($data1));
			}
		}
		return redirect()->back()->with('message', $msg);
	}

	/* Proofreader my Jobs Get*/
	public function myEarnings()
	{
		$user = $this->user;
		$sdate = Request()->sdate;
		$edate = Request()->edate;
        if (isset($sdate) && $sdate!='') {
            $sdate = date("Y-m-d", strtotime($sdate));
        }else{
            $sdate = date("Y-m-01");
        }

        $from_date = date("Y-m-d H:i:s",strtotime($sdate.' 00:00:00' ));
        /*if (date("Y",strtotime($from_date)) == date("Y") && date("m",strtotime($from_date)) == date("m")) {
            $to_date = date("Y-m-d H:i:s");
        }else{
            $to_date = date("Y-m-t H:i:s", strtotime($from_date));
        }*/
        if (isset($edate) && $edate!='') {
            $to_date = date("Y-m-d", strtotime($edate));
        }else{
            $to_date = date("Y-m-t H:i:s", strtotime($from_date));
        }

        $where = "av_earning_tbl.user_id='".$user->id."' and (av_earning_tbl.created_at >= '".$from_date."' and av_earning_tbl.created_at <= '".$to_date."')";
		$item_display_per_page = config('site.pagination');
		$earnings = Earning::select('av_earning_tbl.*','av_order_tbl.currency','av_order_tbl.no_of_word')
		->Join('av_order_tbl', 'av_order_tbl.id', '=', 'av_earning_tbl.order_id')
		->whereRaw($where)
		->orderBy('created_at', 'desc')
		//->paginate($item_display_per_page);
		->get();

		$earning_hold_array = Earning::select(DB::raw('SUM(amount) As total_earn'))->where('status','0')->where('user_id',$user->id)->first();
		$earning_released_array = Earning::select(DB::raw('SUM(amount) As total_earn'))->where('status','1')->where('user_id',$user->id)->first();

		$payment_release_request_array = PaymentRequestRelease::where('status','0')->where('user_id',$user->id)->first();

		$completed_orders = Order::where('status','4')->where('proofreader_id',$user->id)->get();

		$earning_amount = ($earning_hold_array->count() > 0) ? $earning_hold_array->total_earn : 0 ;
		$earned_amount = ($earning_released_array->count() > 0) ? $earning_released_array->total_earn : 0;
		$accumulated_revenue = $earned_amount + $earning_amount;
		$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
		$currency = $currency_with_icon_array[$_SESSION['currency']];

        $monthly_revenue = 0;
        foreach ($earnings as $earning) 
        {
            $monthly_revenue = $monthly_revenue + $earning->amount;
        }
		return view('frontend.my_earnings', compact('user', 'earnings','currency','from_date','to_date','earning_amount','earned_amount','accumulated_revenue','payment_release_request_array','monthly_revenue','completed_orders'));
	}

	/* Proofreader Payment Release Request Post*/
	public function paymentReleaseRequest(Request $request)
	{
		$user = $this->user;
		$msg = 'Sorry, nothing is request submitted!';
		$submit = $request->submit;

		if ($submit!='Release Request') {
			return redirect()->back()->with('message', $msg);
		}
		$payment_release_request_array = PaymentRequestRelease::where('status','0')->where('user_id',$user->id)->first();
		if ($payment_release_request_array && $payment_release_request_array->count() > 0) {
			$msg = 'Sorry, you have already payment release request submitted!';
			return redirect()->back()->with('message', $msg);
		}
		$earning_hold_array = Earning::select(DB::raw('SUM(amount) As total_earn'))->where('status','0')->where('user_id',$user->id)->first();
		$earning_amount = ($earning_hold_array->count() > 0) ? $earning_hold_array->total_earn : 0 ;
		if ($earning_amount<=0) {
			$msg = 'Sorry, nothing enough amount available!';
			return redirect()->back()->with('message', $msg);
		}

		$rules = array(
			'submit' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('my-earnings')->withErrors($validator)->withInput(); 
		}
		else
		{
			$payment_release_request = new PaymentRequestRelease();
			$payment_release_request->user_id = $user->id;
			$payment_release_request->status = '0';
			$payment_release_request->save();
			$msg = 'Payment release request has been submitted successfully.';

			/*Payment Release Request Email to Admin
			$admin_email = config('site.contact_email');
			$proofreader = userDetails($payment_release_request->user_id);
			$fullname = $user->first_name.' '.$user->last_name;
			$data1 = array('fullname' => $fullname, 'email' => $user->email, 'earning_amount' => $earning_amount);
		    Mail::to($admin_email)->send(new PaymentReleaseRequestMailToAdmin($data1));*/
		}
		return redirect()->back()->with('message', $msg);
	}

}