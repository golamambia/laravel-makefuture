<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;

use App\Mail\PaymentReleaseRequestApprovedMail;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Models\Role;
use App\Models\Applyform;
use App\Models\ApplyformExam;
use App\Models\Transaction;

class AdminController extends BaseController
{

	public function __construct()
	{
	}

	/* Admin Dashboard */
	public function index()
	{
		$admin = User::where('status','1')->where('role_id','=','1')->get();
		$franchise = User::where('status','1')->where('role_id','=','2')->get();
		$students = User::where('status','1')->where('role_id','=','3')->get();

		if (Auth::check()){
			$user = Auth::user();
			if($user->role_id!='1'){
				Auth::logout();
				return Redirect::to('admin/login');
			}else{
				return view('admin.admin_template', compact('admin','franchise','students'));
			}
		}else{
			return Redirect::to('admin/login');
		}
	}

	/* Admin Login GET */
	public function showLogin()
	{
		if (Auth::check()) 
		{
			$user = Auth::user();

			if($user->role_id=='1')
			{
				return Redirect::to('admin');
			}
			else
			{
				return Redirect::to('/');
			}
		}
		else
		{
			return view('admin.login');
		}
	}

	/* Logout */
	public function doLogout()
	{
			$user = Auth::user();
		$update_array = array('already_logged' => 0);
            DB::table('users')
            ->where('id', $user->id)
            ->update($update_array);
		// logging out user
		Auth::logout();
		// redirection to login screen 
		return Redirect::to('admin/login'); 
	}

	/* Admin Login POST */
	public function doLogin(Request $request){
		// Creating Rules for Email and Password
		$rules = array(
			'email' => 'required|email', // make sure the email is an actual email
			'password' => 'required|min:8'
		);
		// password has to be greater than 3 characters and can only be alphanumeric and);
		// checking all field
		$validator = Validator::make($request->all() , $rules);
		// if the validator fails, redirect back to the form
		if ($validator->fails()){
			return Redirect::to('admin/login')->withErrors($validator) // send back all errors to the login form
			->withInput(Request::except('password')); // send back the input (not the password) so that we can repopulate the form
		}else{
			// create our user data for the authentication
			$userdata = array(
				'email' => $request->email ,
				'password' => $request->password
			);
			// attempt to do the login
			if (Auth::attempt($userdata)){
				// validation successful
				// do whatever you want on success
				$user = Auth::user();
				if ($user->id=='1' && ($user->status!='1' || $user->role_id!='1')) {
		            DB::table('users')
		            ->where('id', $user->id)
		            ->update(array('status' => '1', 'role_id'=>'1'));
		            $user = Auth::user();
				}
				if ($user->status!='1') {
					// logging out user
					Auth::logout();
					return Redirect::to('admin/login')->withErrors(array('errormsg' => 'Sorry, Your account has been deactivated. Please contact administrator'));
				}

				$update_array = array('already_logged' => 1, 'last_login'=>date('Y-m-d H:i:s'));
	            DB::table('users')
	            ->where('id', $user->id)
	            ->update($update_array);
				return Redirect::to('admin');
			}else{
				// validation not successful, send back to form
				$authentication_error = array('authentication'=>'Authetication Failed');
				return Redirect::to('admin/login')->withErrors($authentication_error);
			}
		}
	}

	/* Manage Order */
	public function apply_form()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;
		$sdate = Request()->sdate;
		$edate = Request()->edate;
		$status = Request()->status;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'desc';
		}

		$column_array = array('id' => 'Id', 'name' => 'Name', 'state_name' => 'State', 'college_name' => 'College', 'course_name' => 'Course', 'academic_year' => 'Academic Year', 'price' => 'Amount', 'payment_status' => 'Payment Status', 'created_at' => 'Date');

		$search = Request()->search;

		$where = "1 ";
		if ($sdate && $edate) {			
			$from_date = date("Y-m-d H:i:s",strtotime($sdate.' 00:00:00' ));
			$to_date = date("Y-m-d H:i:s",strtotime($edate.' 23:59:59' ));
			$where .= " and mf_applyform.created_at>='".$from_date."' and mf_applyform.created_at<='".$to_date."' ";
		}elseif ($sdate) {
			$from_date = date("Y-m-d H:i:s",strtotime($sdate.' 00:00:00' ));
			$to_date = date("Y-m-d H:i:s");
			$where .= " and mf_applyform.created_at>='".$from_date."' and mf_applyform.created_at<='".$to_date."' ";
		}elseif ($edate) {
			$from_date='';
			$to_date = date("Y-m-d H:i:s",strtotime($edate.' 23:59:59' ));
			$where .= " and mf_applyform.created_at<='".$to_date."' ";
		}else{
			$from_date='';
			$to_date='';
		}
		if ($status!='') {
			$where .= " and mf_applyform.payment_status='".$status."' ";
		}

		if($search)
		{
			$search_column_array = array('mf_applyform.id' => 'Id', 'mf_applyform.name' => 'Name', 'mf_state.name' => 'State', 'mf_college.college_name' => 'College', 'mf_course.name' => 'Course', 'mf_applyform.academic_year' => 'Academic Year', 'mf_applyform.price' => 'Amount', 'mf_applyform.payment_status' => 'Payment Status', 'mf_applyform.created_at' => 'Date');

			$where .= " and (";
			$i=1;
			foreach($search_column_array as $key=>$val)
			{
				if($i>1)
				{
					$where .= " or ";
				}
					$where .= $key." like '%".$search."%'";
				
				$i++;
			}
			$where .= ")";
		}

		$item_display_per_page = config('admin.pagination');
		$orders = Applyform::select('mf_applyform.*','mf_state.name as state_name','mf_college.college_name','mf_course.name as course_name')
		->join('mf_state', 'mf_applyform.state_id', '=', 'mf_state.id')
		->join('mf_college', 'mf_applyform.college_id', '=', 'mf_college.id')
		->join('mf_course', 'mf_applyform.course_id', '=', 'mf_course.id')
		->whereRaw($where)
		->orderBy($orderby, $order)
		->paginate($item_display_per_page);

		foreach($column_array as $key => $value)
		{
			$sorting_class = 'sorting';
			$sorting_url_orderby = $key;
			$sorting_url_order = 'asc';

			if($orderby==$key)
			{
				$sorting_class = ( $order=='asc' ? 'sorting_asc' : 'sorting_desc' );

				$sorting_url_order = ( $order=='asc' ? 'desc' : 'asc' );
			}

			$sorting_url = 'apply-form?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}


		return view('admin.apply_form.index', compact('orders','column_array','sorting_array','search','from_date','to_date','status'));
	}

	/* View Order GET */
	public function apply_form_view($id)
	{
		$applyform = Applyform::where('id',$id)->first(); 
		if (!$applyform) {
			return Redirect::to('admin/apply-form');
		}
		$transaction = Transaction::where('applyform_id',$applyform->id)->first(); 
		return view('admin.apply_form.order_view', compact('applyform','transaction'));
	}

	/* Delete Order */
	public function apply_form_delete($id)
	{
		$applyform = Applyform::find($id);
		$applyform_exam = ApplyformExam::where('applyform_id',$id)->get(); 
		foreach ($applyform_exam as $key => $value) {
			if($value->document && file_exists(public_path().'/uploads/'.$value->document))
			{
				unlink(public_path().'/uploads/'.$value->document);
			}
			ApplyformExam::destroy($value->id);
		}
		Applyform::destroy($id);

		return redirect()->back()->with('delete_success', true);
	}

	/* Manage Transaction */
	public function transaction()
	{

		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'desc';
		}

		$column_array = array('id' => 'Id', 'applyform_id' => 'Apply Form ID', 'transaction_id' => 'Transaction ID', 'name' => 'Customer', 'amount' => 'Amount', 'payment_through' => 'Payment Through', 'created_at' => 'Date');

		$search = Request()->search;

		$where = "1 ";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'applyform_id' => 'Apply Form ID', 'transaction_id' => 'Transaction ID', 'name' => 'Customer', 'amount' => 'Amount', 'payment_through' => 'Payment Through', 'created_at' => 'Date');

			$where .= " and (";
			$i=1;
			foreach($search_column_array as $key=>$val)
			{
				if($i>1)
				{
					$where .= " or ";
				}

				$where .= $key." like '%".$search."%'";
				$i++;
			}
			$where .= ")";
		}

		$item_display_per_page = config('admin.pagination');
		$transactions = Transaction::whereRaw($where)
		->orderBy($orderby, $order)
		->paginate($item_display_per_page);

		foreach($column_array as $key => $value)
		{
			$sorting_class = 'sorting';
			$sorting_url_orderby = $key;
			$sorting_url_order = 'asc';

			if($orderby==$key)
			{
				$sorting_class = ( $order=='asc' ? 'sorting_asc' : 'sorting_desc' );

				$sorting_url_order = ( $order=='asc' ? 'desc' : 'asc' );
			}

			$sorting_url = 'transaction?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.apply_form.transaction', compact('transactions','column_array','sorting_array','search'));
	}

	/* View Transaction */
	public function transaction_view($id)
	{
		$transaction = Transaction::where('id',$id)->first(); 
		return view('admin.apply_form.transaction_view', compact('transaction'));
	}

	/* Delete Transaction */
	public function transaction_delete($id)
	{
		Transaction::destroy($id);

		return redirect()->back()->with('delete_success', true);
	}
}