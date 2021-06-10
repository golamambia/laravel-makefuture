<?php
namespace App\Http\Controllers;
use Redirect;
//use Input;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Settings;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
	public function __construct()
	{
	}

	public function settings()
	{
		$settings = Settings::select('mf_settings.*')->get();
		return view('admin.settings', compact('settings'));
	}


	public function update(Request $request)
	{
		$site_title = $request->site_title;
		$admin_pagination = $request->admin_pagination;
		$site_pagination = $request->site_pagination;
		$site_meta_title = $request->site_meta_title;
		$site_meta_keyword = $request->site_meta_keyword;
		$site_meta_description = $request->site_meta_description;
		$user_designation = $request->user_designation;
		$site_email = $request->site_email;
		$site_phone = $request->site_phone;
		$site_address = $request->site_address;

		$rules = array(
			'site_title' => 'required|string|max:255',
			'site_contact_email' => 'required|string|email|max:191',
			'site_support_email' => 'required|string|email|max:191',
		);

		if($request->hasfile('site_unallocated_job_offered_audio'))
		{
			//$rules['site_unallocated_job_offered_audio'] = 'mimes:mp3,acc,wav|max:1024';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/settings/')->withErrors($validator) 
			->withInput(); 
		}
		else
		{
			
		try {
			if($request->hasfile('site_logo'))
			{
				$site_logo = config('site.logo');
				if($site_logo!='' && file_exists(public_path().'/uploads/'.$site_logo))
				{
					unlink(public_path().'/uploads/'.$site_logo);
				}
				$site_logo = $request->file('site_logo');
				$filename = $site_logo->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$site_logo->move(public_path().'/uploads/', $filename);  

				if ($filename) {
					$update_array = array('value' => $filename);
					DB::table('mf_settings')
					->where('id', '2')
					->update($update_array);
				}
			}
			if($request->hasfile('site_logo2'))
			{
				$site_logo2 = config('site.logo2');
				if($site_logo2!='' && file_exists(public_path().'/uploads/'.$site_logo2))
				{
					unlink(public_path().'/uploads/'.$site_logo2);
				}
				$site_logo2 = $request->file('site_logo2');
				$filename = $site_logo2->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$site_logo2->move(public_path().'/uploads/', $filename);  

				if ($filename) {
					$update_array = array('value' => $filename);
					DB::table('mf_settings')
					->where('id', '9')
					->update($update_array);
				}
			}

			if ($site_title) {
				$update_array = array('value' => $site_title);
				DB::table('mf_settings')
				->where('id', '1')
				->update($update_array);
			}

			if ($admin_pagination) {
				$update_array = array('value' => $admin_pagination);
				DB::table('mf_settings')
				->where('id', '3')
				->update($update_array);
			}

			if ($site_pagination) {
				$update_array = array('value' => $site_pagination);
				DB::table('mf_settings')
				->where('id', '4')
				->update($update_array);
			}

				$update_array = array('value' => $site_meta_title);
				DB::table('mf_settings')
				->where('id', '5')
				->update($update_array);

				$update_array = array('value' => $site_meta_keyword);
				DB::table('mf_settings')
				->where('id', '6')
				->update($update_array);

				$update_array = array('value' => $site_meta_description);
				DB::table('mf_settings')
				->where('id', '7')
				->update($update_array);

			if($request->hasfile('site_meta_image'))
			{
				$site_meta_image = config('site.meta_image');
				if($site_meta_image!='' && file_exists(public_path().'/uploads/'.$site_meta_image))
				{
					unlink(public_path().'/uploads/'.$site_meta_image);
				}
				$site_meta_image = $request->file('site_meta_image');
				$filename1 = $site_meta_image->getClientOriginalName();
				$filename1 = str_replace("&", "and", $filename1);
				$filename1 = str_replace(" ", "_", $filename1);
				$filename1 = time().$filename1;
				$site_meta_image->move(public_path().'/uploads/', $filename1);  

				if ($filename1) {
					$update_array = array('value' => $filename1);
					DB::table('mf_settings')
					->where('id', '8')
					->update($update_array);
				}
			}

				$update_array = array('value' => $request->site_contact_email);
				DB::table('mf_settings')
				->where('id', '10')
				->update($update_array);

				$update_array = array('value' => $request->site_support_email);
				DB::table('mf_settings')
				->where('id', '11')
				->update($update_array);

				$update_array = array('value' => $site_address);
				DB::table('mf_settings')
				->where('id', '12')
				->update($update_array);

				$update_array = array('value' => $site_email);
				DB::table('mf_settings')
				->where('id', '13')
				->update($update_array);

				$update_array = array('value' => $site_phone);
				DB::table('mf_settings')
				->where('id', '14')
				->update($update_array);

				$update_array = array('value' => $request->site_facebook_link);
				DB::table('mf_settings')
				->where('id', '15')
				->update($update_array);

				$update_array = array('value' => $request->site_twitter_link);
				DB::table('mf_settings')
				->where('id', '16')
				->update($update_array);

				$update_array = array('value' => $request->site_google_plus_link);
				DB::table('mf_settings')
				->where('id', '17')
				->update($update_array);

				$update_array = array('value' => $request->site_instagram_link);
				DB::table('mf_settings')
				->where('id', '18')
				->update($update_array);

				$update_array = array('value' => $request->site_message_show_time);
				DB::table('mf_settings')
				->where('id', '19')
				->update($update_array);

			return redirect()->back()->with('success', true);
		} catch (\Exception $e) {
			DB::rollback();
			return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
		}

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
			DB::table('av_settings')
			->where('id', '2')
			->update($update_array);			
		}elseif ($key=='site_meta_image') {
			$site_meta_image = Settings::where('id',8)->get();
			if($site_meta_image[0]->value!='' && file_exists(public_path().'/uploads/'.$site_meta_image[0]->value))
			{
				unlink(public_path().'/uploads/'.$site_meta_image[0]->value);
			}
			$update_array = array('value' => '');
			DB::table('av_settings')
			->where('id', '8')
			->update($update_array);
		}elseif ($key=='site_unallocated_job_offered_audio') {
			$site_unallocated_job_offered_audio = Settings::where('id',26)->get();
			if($site_unallocated_job_offered_audio[0]->value!='' && file_exists(public_path().'/uploads/'.$site_unallocated_job_offered_audio[0]->value))
			{
				unlink(public_path().'/uploads/'.$site_unallocated_job_offered_audio[0]->value);
			}
			$update_array = array('value' => '');
			DB::table('av_settings')
			->where('id', '26')
			->update($update_array);
		}

		return redirect()->back()->with('delete_success', true);
	}

	public function user_permission()
	{
		check_user_permission();
		$roles = Role::orderBy('display_name', 'asc')
		->where('id','=','2')
		// ->where('id','>','0')
		->get();
		return view('admin.user_permission', compact('roles'));
	}

	public function updateUserPermission(Request $request)
	{
		$add_module = $request->add_module;
		$edit_module = $request->edit_module;
		$view_module = $request->view_module;
		$delete_module = $request->delete_module;
		//$roles = Role::orderBy('display_name', 'asc')->where('id','>','0')->get();
		
		$msg = 'Sorry, nothing is updated.';
		$type = '0';
		$c=0;
		if ($add_module) {
			foreach ($add_module as $key => $value) {
				if ($value && count($value)) {
					$updateRole = Role::find($key);
					$updateRole->add_module = implode(',', $value);
					$updateRole->save();
					$c++;
				}
			}
		}
		if ($edit_module) {
			foreach ($edit_module as $key => $value) {
				if ($value && count($value)) {
					$updateRole = Role::find($key);
					$updateRole->edit_module = implode(',', $value);
					$updateRole->save();
					$c++;
				}
			}
		}
		if ($view_module) {
			foreach ($view_module as $key => $value) {
				if ($value && count($value)) {
					$updateRole = Role::find($key);
					$updateRole->view_module = implode(',', $value);
					$updateRole->save();
					$c++;
				}
			}
		}
		if ($delete_module) {
			foreach ($delete_module as $key => $value) {
				if ($value && count($value)) {
					$updateRole = Role::find($key);
					$updateRole->delete_module = implode(',', $value);
					$updateRole->save();
					$c++;
				}
			}
		}
		if ($c>0) {
			$type = '1';
			$msg = 'User Permission updated successfully';
		}
		$return = array('msg'=>$msg, 'type'=>$type);
		//\Session::flash('message',$msg);
		echo json_encode($return);
	}

}