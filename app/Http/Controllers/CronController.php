<?php
namespace App\Http\Controllers;
use Redirect; 
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\OrderShow;
use App\Models\Transaction;

use App\Mail\OrderCancelMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class CronController extends Controller
{
	public function __construct()
	{
	}

	public function perMinute()
	{
		$today = date('Y-m-d H:i:s');
		$job_cancel_time = date('Y-m-d H:i:s', strtotime('-'.config('site.unallocated_job_automatically_cancel_time').' minute'));

		$cancel_jobs = Order::select('av_order_tbl.*')
		->whereRaw("payment_status='1' and proofreader_id='0' and (status='0' or status='1') and created_at<='".$job_cancel_time."'")
		->orderBy('created_at', 'desc')
		->get();
		// echo $job_cancel_time."<pre>";
		// print_r($cancel_jobs);
		// echo "</pre>";
		foreach ($cancel_jobs as $order) {
			$order->status = '3';
			$order->save();	

			/*Order Cancel Email*/
			$customer = userDetails($order->user_id);
			$fullname = $customer->first_name.' '.$customer->last_name;
		    $data1 = array('fullname' => $fullname, 'first_name' => $customer->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id));
		    Mail::to($customer->email)->send(new OrderCancelMail($data1));

		    if ($order->proofreader_id>0) {
			    /*Order Cancel Email To Admin*/
			    $proofreader = userDetails($order->proofreader_id);
				$fullname = $proofreader->first_name.' '.$proofreader->last_name;
			    $data2 = array('fullname' => $fullname, 'first_name' => $proofreader->first_name, 'email' => $customer->email, 'order_id' => get_orderID($order->id));
			    Mail::to($customer->email)->send(new OrderCancelMail($data2));
		    }

		    /*Order Cancel Email To Admin*/
			$admin_email = config('site.contact_email');
		    Mail::to($admin_email)->send(new OrderCancelMail($data1));	
		}
		/*DB::table('av_order_tbl')->whereRaw("payment_status='1' and proofreader_id='0' and (status='0' or status='1') and created_at<='".$job_cancel_time."'")->update(array('status' => '3', 'updated_at' => $today));*/

		/*$show_time_for_proofreader = date('Y-m-d H:i:s', strtotime('-'.config('site.unallocated_job_show_time_for_proofreader').' minute'));
		$show_jobs = OrderShow::select('*')
		->whereRaw("status='0' and created_at<='".$show_time_for_proofreader."'")
		->orderBy('created_at', 'desc')
		->get();
		foreach ($show_jobs as $job_show) {
			$job_show->status = '1';
			$job_show->save();

			$order = Order::find($job_show->order_id);
			$order->current_show_proofreader = '0';
			$order->save();
		}*/
		// DB::table('av_order_show_tbl')->whereRaw("status='0' and created_at<='".$show_time_for_proofreader."'")->update(array('status' => '1', 'updated_at' => $today));
		$orders = Order::whereRaw("status!='0' and status!='1'")->get();
		foreach ($orders as $order) {
			DB::table('av_order_show_tbl')->whereRaw("status='0' and order_id='".$order->id."'")->update(array('status' => '2', 'updated_at' => $today));
		}
		

		$auto_logout_time = date('Y-m-d H:i:s', strtotime('-'.Auto_Logout_Time.' minute'));
		echo $auto_logout_time."<br>";
		User::where('role_id','!=', '1')->where(function ($query) use ($auto_logout_time) {
                        $query->where('last_activity','<', $auto_logout_time)
                                ->orWhereNull('last_activity');
                    })->
		update(['already_logged' => '0']);
	}

	public function perDay()
	{
		//Document Auto Delete
		$document_auto_delete_day = date('Y-m-d H:i:s', strtotime('-'.config('site.document_auto_delete_day').' day'));
		$jobs = Order::select('av_order_tbl.*')
		->whereRaw("status!='2' and status!='1' and document_auto_delete='0' and created_at<='".$document_auto_delete_day."'")
		->orderBy('created_at', 'desc')
		->get();
		foreach ($jobs as $order) {
			if( $order->document_auto_delete=='0'){
				if($order->upload_file && file_exists(public_path().'/uploads/order/'.$order->upload_file))
				{
					unlink(public_path().'/uploads/order/'.$order->upload_file);
				}
				if($order->download_file && file_exists(public_path().'/uploads/order/'.$order->download_file))
				{
					unlink(public_path().'/uploads/order/'.$order->download_file);
				}
				$order->document_auto_delete = '1';
				$order->upload_file = '';
				$order->download_file = '';
				$order->save();	
			}
		}
	}

}