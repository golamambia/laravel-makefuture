<?php 
session_start();
// use Session;
// use Auth;
// use Redirect;
use App\Models\User;
use App\Models\Role;

$currency_with_code_array = array('inr' => 'INR');
$currency_with_icon_array = array('inr' => '₹');
define("Currency_With_Code_Array", serialize($currency_with_code_array));
define("Currency_With_Icon_Array", serialize($currency_with_icon_array));

$_SESSION['currency'] = (isset($_SESSION['currency']) && in_array($_SESSION['currency'], $currency_with_code_array)) ? $_SESSION['currency'] : 'inr';

define("Order_ID", "1000");
define("Short_Description_Length", "50");
define("Job_ETA", "12hrs");
define("Ajax_Call_Per_Second", "10");
define("Auto_Logout_Time", "3");

$sub_admin_access_array = array('dashboard'=>'Dashboard', 'order'=>'Order', 'transaction'=>'Transaction', 'payment_request'=>'Payment Request', 'earning'=>'Earning', 'page'=>'Page', 'user'=>'User');
define("Sub_Admin_Access_Array", serialize($sub_admin_access_array));

$page_display_in_array = array('0'=>'None', '1'=>'Header', '2'=>'Footer', '3'=>'Header & Footer');
define("Page_Display_In_Array", serialize($page_display_in_array));

$user_status_array = array('0'=>'Inactive', '1'=>'Active', '2'=>'Delete');
define("User_Status_Array", serialize($user_status_array));

$order_status_array = array('0'=>'Pending','1'=>'Open','2'=>'Underway','3'=>'Canceled','4'=>'Completed'	);
define("Order_Status_Array", serialize($order_status_array));

$payment_status_array = array('0'=>'Pending', '1'=>'Completed', '2' => 'Failed'	);
define("Payment_Status_Array", serialize($payment_status_array));

$refund_status_array = array('0'=>'Inactive', '1'=>'Active', '2'=>'Delete');
define("Refund_Status_Array", serialize($refund_status_array));

$payment_through_array = array('1'=>'Stripe', '2'=>'Paypal');
define("Payment_Through_Array", serialize($payment_through_array));

$course_type_array = array('1'=>'10th','2'=>'12th','3'=>'Graduation');
define("Course_Type_Array", serialize($course_type_array));

$course_subtype_array = array('1'=>'Science','2'=>'Arts','3'=>'Commerce');
define("Course_Subtype_Array", serialize($course_subtype_array));

$college_type_array = array('0'=>'Engineering','1'=>'Management','2'=>'Medical','3'=>'Law','4'=>'Commerce','5'=>'Science','6'=>'Arts');
define("College_Type_Array", serialize($college_type_array));

function get_orderID($order_id) {
	$od = Order_ID;
	$return = $order_id;
	if (is_int($od)) {
		$return = $od + $return;
	}else{
		$return = $od . $return;
	}
	$return = '#'.$return;
	return $return;
}

function get_userID($user_id) {
	$return = $user_id;
	$return = 'MF'.$return;
	return $return;
}

if (!function_exists('get_fields_value')) {
	function get_fields_value_where($tbl_nm, $where, $orderby = "", $order = 'desc') {
		//$where = "status!='2' and (role_id='1' or role_id='1') ";
		if(!$orderby)
		{
			$orderby = 'id';
		}
		$data = DB::table($tbl_nm)->whereRaw($where)->orderBy($orderby, $order)->get();
		return @$data;
	}
}

if (!function_exists('get_field_value')) {
	function get_field_value($tbl_nm, $fld_nm, $search_fld, $row_id, $orderby = "", $order = 'desc',$limit = "") {
		$data = DB::table($tbl_nm)->where($search_fld, $row_id)->first();
		return @$data->$fld_nm;
	}
}

if (!function_exists('get_fields_value')) {
	function get_fields_value($tbl_nm, $search_fld, $row_id, $orderby = "", $order = 'desc',$limit = "") {
		if(!$orderby)
		{
			$orderby = 'id';
		}
		$data = DB::table($tbl_nm)->where($search_fld, $row_id)->orderBy($orderby, $order)->get();
		return @$data;
	}
}

if (!function_exists('get_fields_value2')) {
	function get_fields_value2($tbl_nm, $search_fld, $row_id, $search_fld2, $row_id2, $orderby = "", $order = 'desc',$limit = "") {
		if(!$orderby)
		{
			$orderby = 'id';
		}
		$data = DB::table($tbl_nm)->where($search_fld, $row_id)->where($search_fld2, $row_id2)->orderBy($orderby, $order)->get();
		return @$data;
	}
}

if (!function_exists('get_fields_value3')) {
	function get_fields_value3($tbl_nm, $search_fld, $row_id, $search_fld2, $row_id2, $search_fld3, $row_id3, $orderby = "", $order = 'desc',$limit = "") {
		if(!$orderby)
		{
			$orderby = 'id';
		}
		$data = DB::table($tbl_nm)->where($search_fld, $row_id)->where($search_fld2, $row_id2)->where($search_fld3, $row_id3)->orderBy($orderby, $order)->get();
		return @$data;
	}
}

if (!function_exists('defineOptions')) {

	function defineOptions() {
		$settings = DB::table('mf_settings')->get();
        foreach($settings as $setting)
        {
            // config([$setting->key => $setting->value]);
            define("$setting->key", $setting->value);
        }
	}
}

if (!function_exists('date_convert')) {

	function date_convert($date, $date_format=1){
	  $unx_stamp = strtotime($date);
	  $blank='';
	  if($date!=''){  
	  	switch ($date_format) {
	  		case '1':
	  			$date_str = (date("d/m/Y", $unx_stamp));
	  			break;
	  		case '2':
	  			$date_str = (date("d/m/Y,  h:i A", $unx_stamp));
	  			break;
	  		case '3':
	  			$date_str = (date("F jS, Y", $unx_stamp));
	  			break;
	  		case '4':
	  			$date_str = (date("F jS, Y, h:i A", $unx_stamp));
	  			break;
	  		case '5':
	  			$date_str = (date("m/d/Y", $unx_stamp));
	  			break;
	  		case '6':
	  			if (date("Y", $unx_stamp)==date("Y")) {
	  				$date_str = (date("D, M d", $unx_stamp)); // Thu, Nov 05
	  			}else{
	  				$date_str = (date("D, M d, Y", $unx_stamp)); // Thu, Nov 05, 2021
	  			}	  			
	  			break;
	  		case '7':
	  			$date_str = (date("M d, Y", $unx_stamp)); // Nov 05, 2021
	  			break;
	  		case '8':
	  			$date_str = (date("d M, Y", $unx_stamp)); // 05 Nov, 2021
	  			break;
	  		
	  		default:
	  			$date_str = (date("d-m-Y", $unx_stamp));
	  			break;
	  	}
	   return $date_str;

	  }else{
	    return $blank;
	  }
	}
}

if (!function_exists('check_user_permission')) {

	function check_user_permission() {
		if (Auth::check()){
			$user = Auth::user();
			if ($user->role_id!='1' && $user->role_id!='2') {
				echo redirect('/admin/logout');
    			exit;
			}
			if ($user->role_id=='2') {
				$role = Role::where('id','2')->first();
				$page = get_current_admin_page();
				$check_page_permission = check_page_permission($page);
				//echo "string=".$page;exit();
				if (!$check_page_permission) {
					echo redirect('/admin/login');
		    		exit;
				}
			}			
		}else{
			echo redirect('/admin/login');
    		exit;
		}
		//die();
	}
}

if (!function_exists('check_page_permission')) {

	function check_page_permission($page) {
		$return=false;
		if (Auth::check()){
			$user = Auth::user();
			$role = Role::where('id',$user->role_id)->first();
			$add_module = $role->add_module?explode(',', $role->add_module):array();
			$edit_module = $role->edit_module?explode(',', $role->edit_module):array();
			$view_module = $role->view_module?explode(',', $role->view_module):array();
			$delete_module = $role->delete_module?explode(',', $role->delete_module):array();

			if ( ($page == 'dashboard') || ($page == 'dashboard_view' && in_array('dashboard', $view_module)) ) {
				$return=true;
			}elseif ( ($page == 'order' && in_array('order', $view_module)) || ($page == 'order_view' && in_array('order', $edit_module)) || ($page == 'order_delete' && in_array('order', $delete_module)) ) {
				$return=true;
			}elseif ( ($page == 'transaction' && in_array('transaction', $view_module)) || ($page == 'transaction_delete' && in_array('transaction', $delete_module)) ) {
				$return=true;
			}elseif ( ($page == 'payment_request' && in_array('payment_request', $view_module)) || ($page == 'payment_request_edit' && in_array('payment_request', $edit_module)) ) {
				$return=true;
			}elseif ( $page == 'earning' && in_array('earning', $view_module) ) {
				$return=true;
			}elseif ( ($page == 'page' && in_array('page', $view_module)) || ($page == 'page_add' && in_array('page', $add_module)) || ($page == 'page_edit' && in_array('page', $edit_module)) || ($page == 'page_delete' && in_array('page', $delete_module)) ) {
				$return=true;
			}elseif ( ($page == 'user_customer' && in_array('user', $view_module)) || ($page == 'user_proofreader' && in_array('user', $view_module)) || ($page == 'user_add' && in_array('user', $add_module)) || ($page == 'user_edit' && in_array('user', $edit_module)) || ($page == 'user_delete' && in_array('user', $delete_module)) ) {
				$return=true;
			}

			if ($user->role_id=='1') {
				$return=true;
			}
		}
		return $return;
	}
}

if (!function_exists('get_current_admin_page')) {

	function get_current_admin_page() {
		$page = 'unknown';
		if (Request::is('admin')) {
			$page = 'dashboard';
		}elseif (Request::is('admin/order')) {
			$page = 'order';
		}elseif (Request::is('admin/order/view/*')) {
			$page = 'order_view';
		}elseif (Request::is('admin/transaction')) {
			$page = 'transaction';
		}elseif (Request::is('admin/proofreader/view-payment-request-release')) {
			$page = 'payment_request';
		}elseif (Request::is('admin/proofreader/view-earning')) {
			$page = 'earning';
		}elseif (Request::is('admin/page')) {
			$page = 'page';
		}elseif (Request::is('admin/page/add')) {
			$page = 'page_add';
		}elseif (Request::is('admin/page/edit/*')) {
			$page = 'page_edit';
		}elseif (Request::is('admin/user')) {
			$page = 'user_admin';
		}elseif (Request::is('admin/user/proofreader')) {
			$page = 'user_proofreader';
		}elseif (Request::is('admin/user/customer')) {
			$page = 'user_customer';
		}elseif (Request::is('admin/user/add')) {
			$page = 'user_add';
		}elseif (Request::is('admin/user/edit/*')) {
			$page = 'user_edit';
		}elseif (Request::is('admin/emailtemplate')) {
			$page = 'emailtemplate';
		}
		return $page;
	}
}


if (!function_exists('userDetails')) {

	function userDetails($id) {
		$user = User::select('users.*','roles.display_name as role_name')
				->join('roles', 'users.role_id', '=', 'roles.id')
				->whereRaw("users.status!='2' and users.id='".$id."'")
				->orderBy('users.id', 'desc')
				// ->limit(1)
				->first();
		if (isset($user) && $user->count()>0) {
			
			$avatar_url = ( $user->avatar && File::exists(public_path('uploads/'.$user->avatar)) ) ? url('/uploads/'.$user->avatar) : url('/frontend/images/user-icon.png');
			$user->avatar_url = $avatar_url;
			$retVal = $user;
		}else{
			$retVal = array();
		}
		return $retVal;
	}
}
if (!function_exists('currentUserDetails')) {

	function currentUserDetails() {
		if (Auth::check()){
			$user = Auth::user();
			// $userDetails = ($user->role_id!='1') ? userDetails($user->id) : $user ;
			$userDetails = userDetails($user->id);
		}else{
			$userDetails = array();
		}
		return $userDetails;
	}
}

if (!function_exists('orderid')) {
	function orderid() {
		$salt = "abchefghjkminpqrstuvwxyz0123456789";
		srand((double)microtime() * 1000000);
		$i = 0;
		$pass = "";
		$pass = date('Y');

		while ($i <= 5) {
			$num = rand() % 33;
			$tmp = substr($salt, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return strtoupper($pass);
	}
}

if (!function_exists('messageCounter')) {

	function messageCounter($with='') {
		$user = currentUserDetails();
		$where = 'read_unread="0" and user_to="'.$user->id.'" ';
		if ($with>0) {
			$where .= ' and user_from="'.$with.'"';
		}
		$message = DB::table('message')
			->whereRaw($where)
			->get();
		return $message->count();
	}
}


if (!function_exists('random_strings')) {
	// This function will return a random 
	// string of specified length 
	function random_strings($length_of_string=8) 
	{ 
	    // String of all alphanumeric character 
	    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
	  
	    // Shufle the $str_result and returns substring 
	    // of specified length 
	    return substr(str_shuffle($str_result), 0, $length_of_string); 
	}
}

function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
	/*
		    $interval can be:
		    yyyy - Number of full years
		    q    - Number of full quarters
		    m    - Number of full months
		    y    - Difference between day numbers
		           (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
		    d    - Number of full days
		    w    - Number of full weekdays
		    ww   - Number of full weeks
		    h    - Number of full hours
		    n    - Number of full minutes
		    s    - Number of full seconds (default)
	*/

	if (!$using_timestamps) {
		$datefrom = strtotime($datefrom, 0);
		$dateto = strtotime($dateto, 0);
	}

	$difference = $dateto - $datefrom; // Difference in seconds
	$months_difference = 0;

	switch ($interval) {
	case 'yyyy': // Number of full years
		$years_difference = floor($difference / 31536000);
		if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
			$years_difference--;
		}

		if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
			$years_difference++;
		}

		$datediff = $years_difference;
		break;

	case "q": // Number of full quarters
		$quarters_difference = floor($difference / 8035200);

		while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
			$months_difference++;
		}

		$quarters_difference--;
		$datediff = $quarters_difference;
		break;

	case "m": // Number of full months
		$months_difference = floor($difference / 2678400);

		while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
			$months_difference++;
		}

		$months_difference--;

		$datediff = $months_difference;
		break;

	case 'y': // Difference between day numbers
		$datediff = date("z", $dateto) - date("z", $datefrom);
		break;

	case "d": // Number of full days
		$datediff = floor($difference / 86400);
		break;

	case "w": // Number of full weekdays
		$days_difference = floor($difference / 86400);
		$weeks_difference = floor($days_difference / 7); // Complete weeks
		$first_day = date("w", $datefrom);
		$days_remainder = floor($days_difference % 7);
		$odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?

		if ($odd_days > 7) {
			// Sunday
			$days_remainder--;
		}

		if ($odd_days > 6) {
			// Saturday
			$days_remainder--;
		}

		$datediff = ($weeks_difference * 5) + $days_remainder;
		break;

	case "ww": // Number of full weeks
		//$datediff = floor($difference / 604800);
		$datediff = round($difference / 604800);
		break;

	case "h": // Number of full hours
		$datediff = floor($difference / 3600);
		break;

	case "n": // Number of full minutes
		$datediff = floor($difference / 60);
		break;

	case "s": // Number of full seconds
		$datediff = floor($difference);
		break;

	default: // Number of full seconds (default)
		$datediff = $difference;
		break;
	}

	return $datediff;
}

if (!function_exists('description_show')) {
	function description_show($description, $Short_Description_Length = Short_Description_Length) 
	{ 
		$description = strip_tags($description);
	    $str_length = strlen($description);
	    if ($Short_Description_Length<$str_length) {
	    	$return = '<div class="shortDesc">'.substr($description, 0, $Short_Description_Length).'... <a href="javascript:void(0);">Read more</a></div>';
	    	$return .= '<div class="longDesc">'.$description.'</div>';
	    }else{
	    	$return = '<div class="shortDesc">'.$description.'</div>';
	    }
	  
	    // Shufle the $str_result and returns substring 
	    // of specified length 
	    return $return; 
	}
}

if (!function_exists('get_file_name')) {
	function get_file_name($file_name, $format='') 
	{ 
		if ($format!='') {
			$file_name1 = $file_name;
			$file_name2 = explode('_', $file_name1);		
			$file_name3 = str_replace('_', ' ', $file_name1);
		}else{
			$file_name1 = explode('.', $file_name);
			$file_name2 = explode('_', $file_name1[0]);		
			$file_name3 = str_replace('_', ' ', $file_name1[0]);	
		}
		$return = ltrim($file_name3,$file_name2[0]);
	    return trim($return); 
	}
}






?>