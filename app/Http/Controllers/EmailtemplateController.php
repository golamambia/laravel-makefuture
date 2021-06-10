<?php
namespace App\Http\Controllers;
use Redirect;
//use Input;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Emailtemplate;

use Illuminate\Support\Facades\DB;

class EmailtemplateController extends Controller
{
	public function __construct()
	{
	}

	public function emailtemplate()
	{
		$emailtemplate = Emailtemplate::where('id', '1')->get();
		return view('admin.emailtemplate', compact('emailtemplate'));
	}


	public function update(Request $request)
	{
		$registration_email = $request->registration_email;
		$forgotpass_email = $request->forgotpass_email;
		$password_change_email = $request->password_change_email;
		$release_request_approved_email = $request->release_request_approved_email;
		$account_approved_email = $request->account_approved_email;
		$order_email = $request->order_email;
		$order_email_to_admin = $request->order_email_to_admin;
		$order_complete_email = $request->order_complete_email;
		$order_complete_email_to_admin = $request->order_complete_email_to_admin;
		$order_accept_email = $request->order_accept_email;
		$order_cancel_email = $request->order_cancel_email;

		$rules = array(
			'registration_email' => 'required',
			'forgotpass_email' => 'required',
			// 'password_change_email' => 'required',
			// 'release_request_approved_email' => 'required',
			// 'account_approved_email' => 'required',
			// 'order_email' => 'required',
			// 'order_email_to_admin' => 'required',
			// 'order_complete_email' => 'required',
			//'order_complete_email_to_admin' => 'required',
			// 'order_accept_email' => 'required',
			// 'order_cancel_email' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/emailtemplate/')->withErrors($validator) 
			->withInput(); 
		}
		else
		{
			try {
				DB::beginTransaction();
				// store
					$updateObj = Emailtemplate::find(1);
					$updateObj->registration_email = $registration_email;
					$updateObj->forgotpass_email = $forgotpass_email;
					// $updateObj->password_change_email = $password_change_email;
					// $updateObj->release_request_approved_email = $release_request_approved_email;
					$updateObj->account_approved_email = $account_approved_email;
					$updateObj->order_email = $order_email;
					$updateObj->order_email_to_admin = $order_email_to_admin;
					// $updateObj->order_complete_email = $order_complete_email;
					//$updateObj->order_complete_email_to_admin = $order_complete_email_to_admin;
					// $updateObj->order_accept_email = $order_accept_email;
					// $updateObj->order_cancel_email = $order_cancel_email;
					$updateObj->save();
				DB::commit();

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

			return redirect()->back()->with('success', true);

		}


	}

	public function delete($key)
	{
		if ($key=='site_logo') {
			$site_logo = Settings::where('id',2)->get();
			if($site_logo[0]->value!='' && file_exists(public_path().'/uploads/'.$site_logo[0]->value))
			{
				unlink(public_path().'/uploads/'.$site_logo[0]->value);
			}
			$update_array = array('value' => '');
			DB::table('settings')
			->where('id', '2')
			->update($update_array);			
		}elseif ($key=='site_meta_image') {
			$site_meta_image = Settings::where('id',8)->get();
			if($site_meta_image[0]->value!='' && file_exists(public_path().'/uploads/'.$site_meta_image[0]->value))
			{
				unlink(public_path().'/uploads/'.$site_meta_image[0]->value);
			}
			$update_array = array('value' => '');
			DB::table('settings')
			->where('id', '8')
			->update($update_array);
		}

		return redirect()->back()->with('delete_success', true);
	}

}