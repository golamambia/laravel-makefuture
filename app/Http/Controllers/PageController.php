<?php
namespace App\Http\Controllers;
use Redirect;
use Session;
use Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Page;
use App\Models\PageExtra;
use App\Models\User;
use App\Models\Referral;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Courses;
use App\Models\Colleges;
use App\Models\CollegeCourse;
use App\Models\CollegeImage;
use App\Models\States;
use App\Models\Cities;
use App\Models\Faculties;
use App\Models\News;
use App\Models\Applyform;
use App\Models\ApplyformExam;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Mail\WelcomeMail;
use App\Mail\UserRegistrationMailToAdmin;
use App\Mail\OrderMail;
use App\Mail\OrderMailToAdmin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

use File;

class PageController extends Controller
{
	public function __construct()
	{

	}

	/* Admin Manage Page Get*/
	public function index()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'desc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Page Name');
		$search = Request()->search;
		$where = "1 ";

		if($search)
		{
			$where .= " and (";
			$i=1;
			foreach($column_array as $key=>$val)
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
		$pages = Page::select('pages.*')
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

			$sorting_url = 'page?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.page.index', compact('pages','column_array','sorting_array','search'));
	}


	/* Admin Add Page Get*/
	public function add()
	{
		$all_pages = Page::get();
		return view('admin.page.add', compact('all_pages'));
	}

	/* Admin insert Page Post*/
	public function insert(Request $request)
	{
		$id = $request->id;

		$rules = array(
			'page_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:pages',
			'display_in' => 'required|integer',
			'parent_id' => 'required|integer',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all()); 
		}
		else
		{ 
			try {
				$slug = $request->slug;
				$page_name = $request->page_name;
				$page_title = $request->page_title;
				$bannertext = $request->bannertext;
				$body = $request->body;
				$body2 = $request->body2;
				$btn_text = $request->btn_text;
				$btn_url = $request->btn_url;
				$meta_keyword = $request->meta_keyword;
				$meta_description = $request->meta_description;
				$parent_id = $request->parent_id;
				$display_in = $request->display_in;
				$menu_order = $request->menu_order;

				$update_array = array('page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'btn_text' => $btn_text, 'btn_url' => $btn_url, 'meta_keyword' => $meta_keyword, 'meta_description' => $meta_description, 'parent_id' => $parent_id, 'display_in' => $display_in, 'menu_order' => $menu_order);

				if($request->hasfile('bannerimage'))
				{
					$bannerimage = $request->file('bannerimage');
					$filename = $bannerimage->getClientOriginalName();
					$filename = str_replace("&", "and", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = time().$filename;
					$bannerimage->move(public_path().'/uploads/', $filename);  
					$update_array['bannerimage'] = $filename;
				}

				if ($slug) {
					$update_array['slug'] = $slug;
				}

				$page_id = DB::table('pages')->insertGetId($update_array);

				return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	/* Admin Update Page Get*/
	public function edit($id)
	{
		$all_pages = Page::where('id','!=',$id)->get();
		$page = Page::where('id',$id)->get();
		$page_extra = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->get();

		return view('admin.page.edit', compact('page','page_extra','all_pages'));
	}

	/* Admin Update Page Post*/
	public function update(Request $request)
	{
		$id = $request->id;
		$page_extra = PageExtra::where('page_id',$id)->where('type', '!=', '1')->orderBy('type', 'asc')->get();

		$slug = $request->slug;
		$page_name = $request->page_name;
		$page_title = $request->page_title;
		$bannertext = $request->bannertext;
		$body = $request->body;
		$body2 = $request->body2;
		$btn_text = $request->btn_text;
		$btn_url = $request->btn_url;
		$meta_keyword = $request->meta_keyword;
		$meta_description = $request->meta_description;
		$parent_id = $request->parent_id;
		$display_in = $request->display_in;
		$menu_order = $request->menu_order;

		$rules = array(
			'page_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:pages,slug,'.$id,
			'display_in' => 'required|integer',
			'parent_id' => 'required|integer',
		);

		if($request->hasfile('bannerimage'))
		{
			//$rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/page/edit/'.$id)->withErrors($validator) 
			->withInput(); 
		}
		else
		{
			foreach ($page_extra as $val) {
				$x ='section_title_'.$val->id;
				$page_extra_title = $request->$x;
				$y ='section_sub_title_'.$val->id;
				$page_extra_sub_title = $request->$y;
				$z ='section_body_'.$val->id;
				$page_extra_body = $request->$z;
				$a ='section_btn_text_'.$val->id;
				$page_extra_btn_text = $request->$a;
				$b ='section_btn_url_'.$val->id;
				$page_extra_btn_url = $request->$b;
				$update_array1 = array('title' => $page_extra_title,'body' => $page_extra_body,'sub_title' => $page_extra_sub_title,'btn_text' => $page_extra_btn_text,'btn_url' => $page_extra_btn_url);
				if($request->hasfile('section_file_'.$val->id))
				{
					if($val->image!='' && file_exists(public_path().'/uploads/'.$val->image))
					{
						unlink(public_path().'/uploads/'.$val->image);
					}
					$file = $request->file('section_file_'.$val->id);
					$filename = $file->getClientOriginalName();
					$filename = str_replace("&", "and", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = time().$filename;
					$file->move(public_path().'/uploads/', $filename);  
					$update_array1['image'] = $filename;
				}
				if($request->hasfile('section_file2_'.$val->id))
				{
					if($val->image2!='' && file_exists(public_path().'/uploads/'.$val->image2))
					{
						unlink(public_path().'/uploads/'.$val->image2);
					}
					$file = $request->file('section_file2_'.$val->id);
					$filename = $file->getClientOriginalName();
					$filename = str_replace("&", "and", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = time().$filename;
					$file->move(public_path().'/uploads/', $filename);  
					$update_array1['image2'] = $filename;
				}
				if ( ( $val->page_id==2 && $val->type==7 && $val->image=='' ) ) {
					DB::delete('delete from pages_extra where id = ?',[$val->id]);
				}else{					
					DB::table('pages_extra')
					->where('id', $val->id)
					->update($update_array1);
				}
			}
			if ($id==1) {
			if ( isset($request->bannerimage) && count($request->bannerimage)>0) {
				if($request->hasfile('bannerimage'))
				{
					foreach($request->file('bannerimage') as $file){
						$filename = $file->getClientOriginalName();
						$filename = str_replace("&", "and", $filename);
						$filename = str_replace(" ", "_", $filename);
						$filename = time().$filename;
						$file->move(public_path().'/uploads/', $filename);  
						$update_array1['image'] = $filename;
						$section_logo = $filename;
						DB::insert('insert into pages_extra (page_id, type, image) values (?, ?, ?)', [$id, '1', $section_logo]);
					}
				}
			}
			}
			if (isset($request->banner_title) || isset($request->banner_sub_title) || isset($request->banner_body)) {
				$page_bannerimage = PageExtra::where('page_id',$id)->where('type', '1')->get();
				if ($page_bannerimage) {
						DB::table('pages_extra')->where('page_id', $id)->where('type', '1')->update(array('title' => $request->banner_title, 'sub_title' => $request->banner_sub_title, 'body' => $request->banner_body));
				}else{
					DB::insert('insert into pages_extra (page_id, type, title, sub_title, body) values (?, ?, ?, ?, ?)', [$id, '1', $request->banner_title, $request->banner_sub_title, $request->banner_body]);
				}
			}
			if ( isset($request->section_faq_new_t) && count($request->section_faq_new_t)>0) {
					$section_faq_new_t = $request->section_faq_new_t;
					$section_faq_new_c = $request->section_faq_new_c;
				for ($i=0; $i < count($request->section_faq_new_t); $i++) {
					$section_faq_new_t = $section_faq_new_t[$i];
					$section_faq_new_c = $section_faq_new_c[$i];
					DB::insert('insert into pages_extra (page_id, type, title, body) values (?, ?, ?, ?)', [$id, '4', $section_faq_new_t, $section_faq_new_c]);
				}
			}
			if ( isset($request->section_logo_new_i) && count($request->section_logo_new_i)>0) {
				if($request->hasfile('section_logo_new_i'))
				{
					foreach($request->file('section_logo_new_i') as $file){
						$filename = $file->getClientOriginalName();
						$filename = str_replace("&", "and", $filename);
						$filename = str_replace(" ", "_", $filename);
						$filename = time().$filename;
						$file->move(public_path().'/uploads/', $filename);  
						$update_array1['image'] = $filename;
						$section_logo = $filename;
						DB::insert('insert into pages_extra (page_id, type, image) values (?, ?, ?)', [$id, '7', $section_logo]);
					}
				}
			}

			$update_array = array('page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'btn_text' => $btn_text, 'btn_url' => $btn_url, 'meta_keyword' => $meta_keyword, 'meta_description' => $meta_description, 'parent_id' => $parent_id, 'display_in' => $display_in, 'menu_order' => $menu_order);

			if ($slug && $id!='1' && $id!='5' && $id!='9') {
				$update_array['slug'] = $slug;
			}

			if ($id!=1) {
				if($request->hasfile('bannerimage'))
				{
					$page = Page::where('id',$id)->get();
					if($page[0]->bannerimage!='' && file_exists(public_path().'/uploads/'.$page[0]->bannerimage))
					{
						unlink(public_path().'/uploads/'.$page[0]->bannerimage);
					}

					$bannerimage = $request->file('bannerimage');
					$filename = $bannerimage->getClientOriginalName();
					$filename = str_replace("&", "and", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = time().$filename;
					$bannerimage->move(public_path().'/uploads/', $filename);  
					$update_array['bannerimage'] = $filename;
				}
			}
				if($request->hasfile('image2'))
				{
					$page = Page::where('id',$id)->get();
					if($page[0]->image2!='' && file_exists(public_path().'/uploads/'.$page[0]->image2))
					{
						unlink(public_path().'/uploads/'.$page[0]->image2);
					}

					$image2 = $request->file('image2');
					$filename = $image2->getClientOriginalName();
					$filename = str_replace("&", "and", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = time().$filename;
					$image2->move(public_path().'/uploads/', $filename);  
					$update_array['image2'] = $filename;
				}

			DB::table('pages')
			->where('id', $id)
			->update($update_array);

			return redirect()->back()->with('success', true);

		}


	}

	/* Page Extra Fields Remove Image Get*/
	public function page_extra_remove_image($id)
	{
		$pages_extra = PageExtra::where('id',$id)->get();
		if($pages_extra[0]->image!='' && file_exists(public_path().'/uploads/'.$pages_extra[0]->image))
		{
			unlink(public_path().'/uploads/'.$pages_extra[0]->image);
		}
		if($pages_extra[0]->image2!='' && file_exists(public_path().'/uploads/'.$pages_extra[0]->image2))
		{
			unlink(public_path().'/uploads/'.$pages_extra[0]->image2);
		}
		if ($pages_extra[0]->type==1 || ($pages_extra[0]->type==7 && $pages_extra[0]->page_id!=1)) {
			DB::delete('delete from pages_extra where id = ?',[$id]);
		}else{
			DB::table('pages_extra')
			->where('id', $id)
			->update( array('image' => '' ) );
		}
		

		return redirect()->back()->with('remove_image_success', true);
	}

	public function delete($id)
	{
		if ($id>10) {
		$page = Page::where('id',$id)->get();
		if($page[0]->bannerimage!='' && file_exists(public_path().'/uploads/'.$page[0]->bannerimage))
		{
			unlink(public_path().'/uploads/'.$page[0]->bannerimage);
		}
			DB::delete('delete from pages where id = ?',[$id]);

			return redirect()->back()->with('delete_success', true);
		}
		return Redirect::to('admin/page/')->withErrors(array('errordetailsd' => 'Nothing is deleted.'));
	}



	/* Front end*/

	/* Contact Page Get*/
	public function contact()
	{
		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();

		$page = Page::where('id',5)->get();
		if(count($page))
		{
			if($page[0]->page_name)
			{
				// @$setting[0]->value = $page[0]->meta_title;
				@$setting[0]->value = $page[0]->page_name;
			}
			if($page[0]->meta_keyword)
			{
				@$setting[1]->value = $page[0]->meta_keyword;
			}
			if($page[0]->meta_description)
			{
				@$setting[2]->value = $page[0]->meta_description;
			}

			$page_image = '';
			$page_url = url('/'.$page[0]->slug);
			$site_logo = config('site.logo');
			if($site_logo && File::exists(public_path('uploads/'.$site_logo)) )
			{
				$page_image = url('/uploads/'.$site_logo);
			}
			return view('frontend.pages.contact', compact('page','setting','page_url','page_image'));
		}else{
			//return view('frontend.pages.contact');
			return redirect('404');
		}
		
	}

	/* Contact Page Post*/
	public function contactform(Request $request)
	{
		$name = $request->name;
		$email = $request->email;
		$message = $request->message;
		$phone = $request->phone_number;

		$rules = array(
			'name' => 'required',
			'email' => 'required|string|email|max:191',
			//'message' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('contact')->withErrors($validator) 
			->withInput(); 
		}
		else
		{
			try {
			$admin_message = "Dear Admin,<br><br> 
			
			This e-mail was sent from the contact form on ".config('site.title')." website.<br><br>
			
			Name: ".$name."<br>
			Email: ".$email."<br>
			Phone: ".$phone."<br>
			Message: ".$message."<br><br>";

			$admin_message_content = ['content' => $admin_message];

			Mail::send('mail', $admin_message_content, function ($msg) use ($request) {

				$admin_email = config('site.contact_email');
				$support_email = config('site.support_email');

				$msg->to($admin_email)->subject(config('site.title').': Contact Us Form');
				$msg->from($support_email, $request->name);
			});
			return redirect()->back()->with('message', "Thank you for getting in touch!");
			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	/* Need Support Form on Help Page Post*/
	public function enquiry(Request $request)
	{
		$fname = $request->fname;
		$lame = $request->lame;
		$email = $request->email;
		$phone = $request->phone;
		$subject = $request->subject;
		$state = $request->state;
		$course = $request->course;
		$message = $request->message;

		$rules = array(
			'fname' => 'required',
			'email' => 'required|string|email|max:191',
			//'message' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$admin_message = "Dear Admin,<br><br> 
			
			This e-mail was sent from the help desk form on ".config('site.title')." website.<br><br>
			
			First Name: ".$fname."<br>
			Last Name: ".$lame."<br>
			Email: ".$email."<br>
			Phone: ".$phone."<br>
			Subject: ".$subject."<br>
			State: ".$state."<br>
			Phone: ".$course."<br>
			Message: ".$message."<br><br>";

			$admin_message_content = ['content' => $admin_message];

			Mail::send('mail', $admin_message_content, function ($msg) use ($request) {

				$admin_email = config('site.contact_email');
				$support_email = config('site.support_email');

				$msg->to($admin_email)->subject(config('site.title').': Need Support');
				$msg->from($support_email, $request->name);
			});
			return redirect()->back()->with('message', "Thank you for getting in touch!");
			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	/* Need Support Form on Help Page Post*/
	public function enquiry_popup(Request $request)
	{
		$fullname = $request->fullname;
		$email = $request->email;
		$mobile = $request->mobile;
		$city = $request->city;
		$state = $request->state;
		$course = $request->course;

		$rules = array(
			'fullname' => 'required',
			//'email' => 'required|string|email|max:191',
			'mobile' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$admin_message = "Dear Admin,<br><br> 
			
			This e-mail was sent from the help desk form on ".config('site.title')." website.<br><br>
			
			Full Name: ".$fullname."<br>
			Email: ".$email."<br>
			Mobile Number: ".$mobile."<br>
			City: ".$city."<br>
			State: ".$state."<br>
			Phone: ".$course."<br><br>";

			$admin_message_content = ['content' => $admin_message];

			Mail::send('mail', $admin_message_content, function ($msg) use ($request) {

				$admin_email = config('site.contact_email');
				$support_email = config('site.support_email');

				$msg->to($admin_email)->subject(config('site.title').': Need Support');
				$msg->from($support_email, $request->name);
			});
			return redirect()->back()->with('message', "Thank you for getting in touch!");
			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}


	/* Show Page by Slug Get*/
	public function ShowPage($slug)
	{
		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();

		$page = Page::where('slug',$slug)->get();
		$extra_data = array();
		if(count($page))
		{
			if($page[0]->page_name)
			{
				// @$setting[0]->value = $page[0]->meta_title;
				@$setting[0]->value = $page[0]->page_name;
			}
			if($page[0]->meta_keyword)
			{
				@$setting[1]->value = $page[0]->meta_keyword;
			}
			if($page[0]->meta_description)
			{
				@$setting[2]->value = $page[0]->meta_description;
			}

			$page_image = '';
			$page_url = url('/'.$page[0]->slug);
			$site_logo = config('site.logo');
			if($site_logo && File::exists(public_path('uploads/'.$site_logo)) )
			{
				$page_image = url('/uploads/'.$site_logo);
			}
			
			if($page[0]->id=='2'){
				$extra_data = PageExtra::where('page_id',$page[0]->id)->get();
				return view('frontend.pages.about', compact('page','setting','page_url','page_image', 'extra_data'));
			}elseif($page[0]->id=='3'){
				$extra_data = PageExtra::where('page_id',$page[0]->id)->get();
				return view('frontend.pages.service', compact('page','setting','page_url','page_image', 'extra_data'));
			}
			elseif($page[0]->id=='4'){
				$extra_data = PageExtra::where('page_id',$page[0]->id)->get();
				return view('frontend.pages.find-a-course', compact('page','setting','page_url','page_image', 'extra_data'));
			}
			elseif($page[0]->id=='6'){
				//$extra_data = PageExtra::where('page_id',$page[0]->id)->get();
				return view('frontend.pages.find-a-college', compact('page','setting','page_url','page_image'));
			}elseif($page[0]->id=='8'){
				//$extra_data = PageExtra::where('page_id',$page[0]->id)->get();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'desc';
		}
		$search = Request()->s;
		$course = Request()->course;
		$collage_name = Request()->collage_name;
		$state = Request()->state;

		$college_type = Request()->college_type;
		$duration = Request()->duration;

		$where = "mf_college.status='1' ";
		if($search)
		{
			$where .= " and (";
			$where .= " mf_college.college_type like '%".$search."%' ";
			$where .= " or mf_college.college_name like '%".$search."%'";
			$where .= " or mf_college.short_name like '%".$search."%'";
			$where .= " or mf_state.name like '%".$search."%'";
			$where .= " or mf_city.name like '%".$search."%'";
			$where .= " or mf_course.name like '%".$search."%'";
			$where .= ") ";
		}
		if($course)
		{
			$where .= " and mf_college_course.course_id='".$course."' ";
		}
		if($collage_name)
		{
			$where .= " and (";
			$where .= " mf_college.college_name like '%".$collage_name."%'";
			$where .= " or mf_college.short_name like '%".$collage_name."%'";
			$where .= ") ";
		}
		if($state)
		{
			$where .= " and mf_college.state_id='".$state."' ";
		}
		if($college_type)
		{
			$where .= " and (";
			$where .= " mf_college.college_type like '%".$college_type."%'";
			$where .= ") ";
		}
		if($duration)
		{
			if ($duration=='4plus') {
				$where .= " and mf_course.completed_in>4 ";
			}else{
				$duration1=explode('-', $duration);
				$where .= " and mf_course.completed_in>=".$duration1[0]." and mf_course.completed_in<=".$duration1[1]." ";
			}			
		}
		$item_display_per_page = config('site.pagination');
		$colleges = Colleges::select('mf_college.*','mf_state.name as state_name','mf_city.name as city_name','mf_college_course.price','mf_course.name as course_name')
		->join('mf_state', 'mf_college.state_id', '=', 'mf_state.id')
		->join('mf_city', 'mf_college.city_id', '=', 'mf_city.id')
		->join('mf_college_course', 'mf_college.id', '=', 'mf_college_course.college_id')
		->join('mf_course', 'mf_course.id', '=', 'mf_college_course.course_id')
		->whereRaw($where)
		->orderBy($orderby, $order)
		->groupBy('mf_college_course.college_id')
		->paginate($item_display_per_page);

				return view('frontend.pages.apply-for-counselling', compact('colleges','page','setting','page_url','page_image'));
			}elseif($page[0]->id=='9'){
				return view('frontend.pages.apply-form', compact('page','setting','page_url','page_image'));
			}else{
				return view('frontend.pages.pages', compact('page','setting','page_url','page_image'));
			}
			
		}
		else
		{
			return redirect('404');
		}
	}

	/* Show College by Slug Get*/
	public function ShowCollege($slug)
	{
		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();

		$college = Colleges::where('slug',$slug)->first();
		if($college)
		{
			if($college->college_name)
			{
				// @$setting[0]->value = $page[0]->meta_title;
				@$setting[0]->value = $college->college_name;
			}
			if($college->meta_keyword)
			{
				@$setting[1]->value = $college->meta_keyword;
			}
			if($college->meta_description)
			{
				@$setting[2]->value = $college->meta_description;
			}

			$page_image = '';
			$page_url = url('/college/'.$college->slug);
			$site_logo = config('site.logo');
			if($college->bannerimage && File::exists(public_path('uploads/'.$college->bannerimage)) ){
				$page_image = url('/uploads/'.$college->bannerimage);
			}elseif ($college->logo && File::exists(public_path('uploads/'.$college->logo)) ){
				$page_image = url('/uploads/'.$college->logo);
			}elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo)) ){
				$page_image = url('/uploads/'.$site_logo);
			}
			
			return view('frontend.college_details', compact('college','setting','page_url','page_image'));
			
		}
		else
		{
			return redirect('404');
		}
	}

	/* Show Course by Slug Get*/
	public function ShowCourse($slug)
	{
		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();

		$course = Courses::where('slug',$slug)->first();
		if($course)
		{
			if($course->name)
			{
				@$setting[0]->value = $course->name;
			}
			if($course->meta_keyword)
			{
				@$setting[1]->value = $course->meta_keyword;
			}
			if($course->meta_description)
			{
				@$setting[2]->value = $course->meta_description;
			}

			$page_image = '';
			$page_url = url('/course/'.$course->slug);
			$site_logo = config('site.logo');
			if($course->image && File::exists(public_path('uploads/'.$course->image)) ){
				$page_image = url('/uploads/'.$course->image);
			}elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo)) ){
				$page_image = url('/uploads/'.$site_logo);
			}
			
			return view('frontend.course_details', compact('course','setting','page_url','page_image'));
			
		}
		else
		{
			return redirect('404');
		}
	}

	/* Show Faculty by Slug Get*/
	public function ShowFaculty($slug)
	{
		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();

		$faculty = Faculties::where('slug',$slug)->first();
		if($faculty)
		{
			if($faculty->title)
			{
				@$setting[0]->value = $faculty->title;
			}
			if($faculty->meta_keyword)
			{
				@$setting[1]->value = $faculty->meta_keyword;
			}
			if($faculty->meta_description)
			{
				@$setting[2]->value = $faculty->meta_description;
			}
			$college = Colleges::where('id',$faculty->college_id)->first();

			$page_image = '';
			$page_url = url('/'.$faculty->slug);
			$site_logo = config('site.logo');
			if($faculty->bannerimage && File::exists(public_path('uploads/'.$faculty->bannerimage)) ){
				$page_image = url('/uploads/'.$faculty->bannerimage);
			}elseif ($college->bannerimage && File::exists(public_path('uploads/'.$college->bannerimage)) ){
				$page_image = url('/uploads/'.$college->bannerimage);
			}elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo)) ){
				$page_image = url('/uploads/'.$site_logo);
			}
			
			return view('frontend.faculty_details', compact('faculty','college','setting','page_url','page_image'));
			
		}
		else
		{
			return redirect('404');
		}
	}

	/* Show News by Slug Get*/
	public function ShowNews($slug)
	{
		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();

		$news = News::where('slug',$slug)->first();
		if($news)
		{
			if($news->title)
			{
				@$setting[0]->value = $news->title;
			}
			if($news->meta_keyword)
			{
				@$setting[1]->value = $news->meta_keyword;
			}
			if($news->meta_description)
			{
				@$setting[2]->value = $news->meta_description;
			}
			$college = Colleges::where('id',$news->college_id)->first();

			$page_image = '';
			$page_url = url('/'.$news->slug);
			$site_logo = config('site.logo');
			if($news->bannerimage && File::exists(public_path('uploads/'.$news->bannerimage)) ){
				$page_image = url('/uploads/'.$news->bannerimage);
			}elseif ($college->bannerimage && File::exists(public_path('uploads/'.$college->bannerimage)) ){
				$page_image = url('/uploads/'.$college->bannerimage);
			}elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo)) ){
				$page_image = url('/uploads/'.$site_logo);
			}
			
			return view('frontend.news_details', compact('news','college','setting','page_url','page_image'));
			
		}
		else
		{
			return redirect('404');
		}
	}

	/* Search Get*/
	public function search_page()
	{
		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();
		$title = 'Listing Of College & Course';
		@$setting[0]->value = $title;
		@$setting[1]->value = $title;
		@$setting[2]->value = $title;

		$page_image = '';
		$page_url = url('/search');
		$site_logo = config('site.logo');
		if ($site_logo && File::exists(public_path('uploads/'.$site_logo)) ){
			$page_image = url('/uploads/'.$site_logo);
		}

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'desc';
		}
		$search = Request()->s;
		$course = Request()->course;
		$collage_name = Request()->collage_name;
		$state = Request()->state;

		$college_type = Request()->college_type;
		$duration = Request()->duration;

		$where = "mf_college.status='1' ";
		if($search)
		{
			$where .= " and (";
			$where .= " mf_college.college_type like '%".$search."%' ";
			$where .= " or mf_college.college_name like '%".$search."%'";
			$where .= " or mf_college.short_name like '%".$search."%'";
			$where .= " or mf_state.name like '%".$search."%'";
			$where .= " or mf_city.name like '%".$search."%'";
			$where .= " or mf_course.name like '%".$search."%'";
			$where .= ") ";
		}
		if($course)
		{
			$where .= " and mf_college_course.course_id='".$course."' ";
		}
		if($collage_name)
		{
			$where .= " and (";
			$where .= " mf_college.college_name like '%".$collage_name."%'";
			$where .= " or mf_college.short_name like '%".$collage_name."%'";
			$where .= ") ";
		}
		if($state)
		{
			$where .= " and mf_college.state_id='".$state."' ";
		}
		if($college_type)
		{
			$where .= " and (";
			$where .= " mf_college.college_type like '%".$college_type."%'";
			$where .= ") ";
		}
		if($duration)
		{
			if ($duration=='4plus') {
				$where .= " and mf_course.completed_in>4 ";
			}else{
				$duration1=explode('-', $duration);
				$where .= " and mf_course.completed_in>=".$duration1[0]." and mf_course.completed_in<=".$duration1[1]." ";
			}			
		}

		$item_display_per_page = config('site.pagination');
		$colleges = Colleges::select('mf_college.*','mf_state.name as state_name','mf_city.name as city_name','mf_college_course.price','mf_course.name as course_name',)
		->join('mf_state', 'mf_college.state_id', '=', 'mf_state.id')
		->join('mf_city', 'mf_college.city_id', '=', 'mf_city.id')
		->join('mf_college_course', 'mf_college.id', '=', 'mf_college_course.college_id')
		->join('mf_course', 'mf_course.id', '=', 'mf_college_course.course_id')
		->whereRaw($where)
		->orderBy($orderby, $order)
		->groupBy('mf_college_course.college_id')
		->paginate($item_display_per_page);

		return view('frontend.search_page', compact('colleges','setting','page_url','page_image'));
	}

	/* Not Found Get*/
	public function not_found()
	{
		return view('errors.404');
	}

	/* Franchise Register Get*/
	public function franchise_register()
	{
		return view('auth.franchise_register');
	}

	/* Apply Form Post*/
	public function apply_form(Request $request)
	{
		$data = $request->all();
		$rules = array(
			'name' => 'required|string|max:255',
			// 'email' => 'required|string|email|max:255|unique:users',
			//'file_upload' => 'required|mimes:txt,doc,docx,xml,rtf,TXT,DOC,DOCX,XML,RTF|max:5140',
			'subject_name' => 'required|array|min:1',
			'price' => 'required|numeric',
			'aggrement' => 'required',
		);
		if (Auth::check()) {
			$user = Auth::user();
			if($user->role_id=='2'){
				$rules['email'] = 'required|string|email|max:255|unique:users';
			}else{
				$rules['email'] = 'required|string|email|max:255|unique:users,email,'.$user->id;
			}
		}else{
			$rules['email'] = 'required|string|email|max:255|unique:users';
		}
        $customMessages = array(
            'name.required'  => 'Please enter name',
            'email.required'  => 'Please enter Email address',
            'email.unique'  => 'The email is already in use on the system. Please use a different email or after login fill this form.',
            'aggrement.required'  => 'Please agree to the Terms & Conditions.',
         );

        if(@$request->referral_code)
        {
            $data['referral_code_validate'] = '1';
            $rules['referral_code_validate'] = 'required';
            $customMessages['referral_code_validate.required'] = 'Wrong Referral Code.';

            $user_details = User::where('referral_code', $request->referral_code)->first();

            if(!$user_details)
            {
                $data['referral_code_validate'] = '';
            }
        }

		$validator = Validator::make($data , $rules, $customMessages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput(); 
		}
		else
		{			
			try {
				$name = $request->name;
				$name1 = explode(' ', $name);
				$first_name = $name1[0];
				$last_name = ltrim($name,$first_name);
				$email = $request->email;
				$dob = $request->dob?date('Y-m-d', strtotime($request->dob)):null;
				$student_mobile = $request->student_mobile;
				$father_name = $request->father_name;
				$currency = $_SESSION['currency'];

				if (Auth::check()) {
					$referred_user = Auth::user();
					if($referred_user->role_id=='2'){
						$referred_by = $referred_user->id;

						$password = random_strings();
				        $user = new User();
				        $user->role_id = 3;
				        $user->first_name = $first_name;
				        $user->last_name = $last_name;
				        $user->email = $email;
				        $user->password = Hash::make($password);
				        $user->status = 1;
				        $user->save();
				        $user_id = $user->id;

				        $user['fullname'] = $first_name.' '.$last_name;
				        $user['password'] = $password;
				        Mail::to($email)->send(new WelcomeMail($user));

		                $referral = new Referral();
		                $referral->user_id = $user_id;
		                $referral->referred_by = $referred_by;
		                $referral->save();
					}else{
						$user_id = $referred_user->id;
					}
				}else{
					$password = random_strings();
			        $user = new User();
			        $user->role_id = 3;
			        $user->first_name = $first_name;
			        $user->last_name = $last_name;
			        $user->email = $email;
			        $user->password = Hash::make($password);
			        $user->status = 1;
			        $user->save();

			        $user['fullname'] = $first_name.' '.$last_name;
			        $user['password'] = $password;
			        Mail::to($email)->send(new WelcomeMail($user));

			        $userdata = array(
						'email' => $email ,
						'password' => $password
					);
			        // Auth::attempt($userdata);
			        if ($user->id>0){
			        	$user_id = $user->id;
			        	Auth::loginUsingId($user_id);
						if(@$request->referral_code)
						{
							$user_details = User::where('referral_code', $request->referral_code)->first();
				            if($user_details)
				            {
				                $referral = new Referral();
				                $referral->user_id = $user_id;
				                $referral->referred_by = $user_details->id;
				                $referral->save();
				            }
						}
			        }
				}

		        $obj = new Applyform();
		        $obj->user_id = $user_id;
		        $obj->name = $name;
		        $obj->dob = $dob;
		        $obj->student_mobile = $student_mobile;
		        $obj->father_name = $request->father_name;
		        $obj->father_mobile = $request->father_mobile;
		        $obj->mother_name = $request->mother_name;
		        $obj->mother_mobile = $request->mother_mobile;
		        $obj->nationality = $request->nationality;
		        $obj->cast = $request->cast;
		        $obj->gender = $request->gender;
		        $obj->citizenship = $request->citizenship;
		        $obj->email = $email;
		        $obj->parmanent_address = $request->parmanent_address;
		        $obj->local_address = $request->local_address;

		        $obj->state_id = $request->state_id;
		        $obj->college_id = $request->college_id;
		        $obj->academic_year = $request->academic_year;

		        $obj->course_id = $request->course_id;
		        $obj->price = $request->price;
		        $obj->currency = $currency;
		        $obj->save();

				Session::put('user_id', $user_id);
				Session::put('applyform_id', $obj->id);

	            if ( isset($request->subject_name) && count($request->subject_name)>0) {
	            	DB::delete('delete from mf_applyform_exam where applyform_id = ?',[$obj->id]);
	            	$subject_name = $request->subject_name;
	            	$marks = $request->marks;
	            	$percentage = $request->percentage;
	            	$document = $request->file('document');
	            	$documents = [];
	            /*if ( isset($request->document) && count($request->document)>0) {
	                if($request->hasfile('document'))
	                {
	                    foreach($request->file('document') as $file){
	                        $filename = $file->getClientOriginalName();
	                        $filename = str_replace("&", "and", $filename);
	                        $filename = str_replace(" ", "_", $filename);
	                        $filename = time().$filename;
	                        $file->move(public_path().'/uploads/', $filename);
	                        $section_logo = $filename;
	                        $documents[] = $filename;
	                    }
	                }
	            }*/
	            	for ($i=0; $i < count($subject_name); $i++) { 
	            		$formUp = ApplyformExam::firstOrNew(array('subject_name' => $subject_name[$i],'applyform_id' => $obj->id));
						// $formUp->applyform_id = $obj->id;
	            		$formUp->marks = $marks[$i];
	            		$formUp->percentage = $percentage[$i];
	            		// dd($document);
	            		if (@$document[$i]) {
	            			$file = $document[$i];
	                        $filename = $file->getClientOriginalName();
	                        $filename = str_replace("&", "and", $filename);
	                        $filename = str_replace(" ", "_", $filename);
	                        $filename = time().$filename;
	                        $file->move(public_path().'/uploads/', $filename);
	                        $section_logo = $filename;
	                        $formUp->document = $section_logo;
	            		}
						$formUp->save(); 
	            	}
	            }

				// return redirect()->back()->with('success', true);
				return Redirect::to('payment');
			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	/* Payment get*/
	public function payment()
	{
		$user = currentUserDetails();
		if (Request()->applyform_id) {
			$applyform_id = Request()->applyform_id;
		}else{
			$applyform_id = Session::get('applyform_id');
		}
		
		if ($applyform_id<=0) {
			$list = Applyform::where('payment_status','0')->where('user_id',$user->id)->latest()->first();
		}else{
			$list = Applyform::where('id',$applyform_id)->where('user_id',$user->id)->latest()->first();
		}
		if (!$list) {
			return Redirect::to('apply-form')->with('message', 'Sorry, No any pending payment found.');
		}
		if ($list->payment_status=='1') {
			return Redirect::to('apply-course/view/'.$list->id)->with('message', 'You have already paid for this course.');
		}

		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();
		$title = 'Payment Course';
		@$setting[0]->value = $title;
		@$setting[1]->value = $title;
		@$setting[2]->value = $title;
		// dd(config('app.RAZORPAY_KEY'));
		// dd(env('RAZORPAY_KEY'));


		$price = $list->price;
		$subtotal_amount = $price;
		$total_amount = $subtotal_amount;
		$currency = $_SESSION['currency'];
		$displayCurrency = strtoupper($currency);
		$displayAmount = $amount = $total_amount * 100;
		$api = new Api(config('app.RAZORPAY_KEY'), config('app.RAZORPAY_SECRET'));

		$create_order = false;
		if (Session::has('razorpay_order_id')) {
			$razorpayOrderId = Session::get('razorpay_order_id');
			$payments = $api->order->fetch($razorpayOrderId)->payments(); 
			foreach ($payments->items as $key => $value) {
				if ($value->status=='captured' && !$create_order) {
					$create_order = true;
					break;
				}
			}
		}else{
			$create_order = true;
		}

		if ($create_order) {
			$orderData = [
			    'receipt'         => $list->id,
			    'amount'          => $amount, // 2000 rupees in paise
			    'currency'        => 'INR',
			    'payment_capture' => 1 // auto capture
			];
			$razorpayOrder = $api->order->create($orderData);
			$razorpayOrderId = $razorpayOrder['id'];
			Session::put('razorpay_order_id', $razorpayOrderId);
		}
		if ($displayCurrency !== 'INR')
		{
		    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
		    $exchange = json_decode(file_get_contents($url), true);

		    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
		}
		$logo_url = ( config('site.logo') && File::exists(public_path('uploads/'.config('site.logo'))) ) ? asset('/uploads/'.config('site.logo')) : asset('/frontend/images/logomain.png');
		$data = [
		    "key"               => config('app.RAZORPAY_KEY'),
		    "amount"            => $amount,
		    "name"              => config('site.title'),
		    "description"       => "",
		    "image"             => $logo_url,
		    "prefill"           => [
		    "name"              => $list->name,
		    "email"             => $list->email,
		    "contact"           => $list->student_mobile,
		    ],
		    "notes"             => [
		    "address"           => "",
		    "merchant_order_id" => "",
		    ],
		    "theme"             => [
		    "color"             => "#F37254"
		    ],
		    "order_id"          => $razorpayOrderId,
		];

		if ($displayCurrency !== 'INR')
		{
		    $data['display_currency']  = $displayCurrency;
		    $data['display_amount']    = $displayAmount;
		}

		return view('frontend.payment_razorpay', compact('list','setting','data'));
	}

	/* Place Order with payment post*/
	public function paymentOrder(Request $request)
	{
		$user = currentUserDetails();
		$user_id = $user->id;
		$applyform_id = $request->applyform_id;
		$list = Applyform::where('id',$applyform_id)->where('user_id',$user->id)->first();
		if (!Auth::check()) {
			return Redirect::to('login');
		}
		if (!$list) {
			return Redirect::to('payment')->with('message', 'Sorry, Something is wrong!');
		}

		$rules = array(
            'applyform_id' => 'required',
            'razorpay_payment_id' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('payment')->withErrors($validator)->withInput(); 
		}
		else
		{
			$razorpay_payment_id = $request->razorpay_payment_id;
			$razorpay_signature = $request->razorpay_signature;
			$api = new Api(config('app.RAZORPAY_KEY'), config('app.RAZORPAY_SECRET'));

			$price = $list->price;
			$subtotal_amount = $price;
			$total_amount = $subtotal_amount;
			$currency = $_SESSION['currency'];

			try {
				$razorpayOrderId = Session::get('razorpay_order_id');
		        $attributes = array(
		            'razorpay_order_id' => $razorpayOrderId,
		            'razorpay_payment_id' => $razorpay_payment_id,
		            'razorpay_signature' => $razorpay_signature
		        );

		        $response = $api->utility->verifyPaymentSignature($attributes);
		        //dd($response); 

				$msg = 'Money not add in wallet!!';
				if ($razorpay_payment_id) {
					$list->payment_status = '1';
					$list->save();

					$transaction_id = $razorpay_payment_id;

					$transaction = new Transaction();
					$transaction->applyform_id = $list->id;
					$transaction->user_id = $user_id;
					$transaction->transaction_id = $transaction_id;
					$transaction->razorpay_order_id = $razorpayOrderId;
					$transaction->currency = $currency;
					$transaction->amount = $total_amount;
					$transaction->payment_through = '1';
					$transaction->transaction_date = date('Y-m-d H:i:s');
					$transaction->save();

					Session::put('transaction_id', $transaction->id);
					Session::forget('applyform_id');
					Session::forget('razorpay_order_id');/**/
					$msg = 'Success! Thank you for payment.';

					$state_name = get_field_value('mf_state', 'name', 'id', $list->state_id);
					$college_name = get_field_value('mf_college', 'college_name', 'id', $list->college_id);
					$academic_year = $list->academic_year;
					$course_name = get_field_value('mf_course', 'name', 'id', $list->course_id);

					$data1 = array('fullname' => $list->name, 'email' => $list->email, 'applyform_id' => $list->id, 'state_name' => $state_name, 'college_name' => $college_name, 'academic_year' => $academic_year, 'course_name' => $course_name, 'transaction_id' => $transaction_id);
		        	Mail::to($list->email)->send(new OrderMail($data1));

					/*Order Email to Admin*/
					$admin_email = config('site.contact_email');
		        	$data1 = array('fullname' => $list->name, 'email' => $list->email, 'applyform_id' => $list->id, 'state_name' => $state_name, 'college_name' => $college_name, 'academic_year' => $academic_year, 'course_name' => $course_name, 'transaction_id' => $transaction_id);
		        	Mail::to($admin_email)->send(new OrderMailToAdmin($data1));
				}
				return Redirect::to('/')->with('message', $msg);
 
			} catch (SignatureVerificationError $e) {
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput();
			}
		}
	}

	/* Payment Stripe get*/
	public function payment_stripe()
	{
		$user = currentUserDetails();
		if (Request()->applyform_id) {
			$applyform_id = Request()->applyform_id;
		}else{
			$applyform_id = Session::get('applyform_id');
		}
		
		if ($applyform_id<=0) {
			$list = Applyform::where('payment_status','0')->where('user_id',$user->id)->latest()->first();
		}else{
			$list = Applyform::where('id',$applyform_id)->where('user_id',$user->id)->latest()->first();
		}
		if (!$list) {
			return Redirect::to('apply-form')->with('message', 'Sorry, No any pending payment found.');
		}
		if ($list->payment_status=='1') {
			return Redirect::to('apply-course/view/'.$list->id)->with('message', 'You have already paid for this course.');
		}

		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();
		$title = 'Payment Course';
		@$setting[0]->value = $title;
		@$setting[1]->value = $title;
		@$setting[2]->value = $title;
		// dd(config('app.RAZORPAY_KEY'));
		// dd(env('RAZORPAY_KEY'));

		return view('frontend.payment', compact('list','setting'));
	}

	/* Place Order with payment Stripe post*/
	public function paymentOrder_stripe(Request $request)
	{
		$user = currentUserDetails();
		$user_id = $user->id;
		$applyform_id = $request->applyform_id;
		$list = Applyform::where('id',$applyform_id)->where('user_id',$user->id)->first();
		if (!Auth::check()) {
			return Redirect::to('login');
		}
		if (!$list) {
			return Redirect::to('payment')->with('message', 'Sorry, Something is wrong!');
		}

		$rules = array(
            'applyform_id' => 'required',
            'card_no' => 'required',
            'exp' => 'required',
            'cvv' => 'required',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('payment')->withErrors($validator)->withInput(); 
		}
		else
		{
			$card_no = trim($request->card_no);
			$card_no = str_replace('-', '', $card_no);
			$exp = $request->exp;
			$exp = explode('/', $exp);
			$exp_month = trim($exp[0]);
			$exp_year = '20'.trim($exp[1]);
			$cvv = $request->cvv;

			$price = $list->price;
			$subtotal_amount = $price;
			$total_amount = $subtotal_amount;
			$currency = $_SESSION['currency'];

			// $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
			$stripe = Stripe::make(config('app.STRIPE_SECRET'));
			try {
				$token = $stripe->tokens()->create([
					'card' => [
					'number' => $card_no,
					'exp_month' => $exp_month,
					'exp_year' => $exp_year,
					'cvc' => $cvv,
					],
				]);
				if (!isset($token['id'])) {
					return Redirect::back()->withErrors(array('errordetailsd' => 'Invalid card! Please enter valid card.'))->withInput();
				}
				$charge = $stripe->charges()->create([
					'card' => $token['id'],
					'currency' => strtoupper($currency),
					'amount' => $total_amount,
					'description' => 'College Portal Order',
				]);
 
				if($charge['status'] == 'succeeded') {
					$amount = $charge['amount']/100;

					$list->payment_status = '1';
					$list->save();

					$transaction_id = $charge['id'];

					$transaction = new Transaction();
					$transaction->applyform_id = $list->id;
					$transaction->user_id = $user_id;
					$transaction->transaction_id = $transaction_id;
					$transaction->currency = $currency;
					$transaction->amount = $amount;
					$transaction->payment_through = '1';
					$transaction->transaction_date = date('Y-m-d H:i:s');
					$transaction->save();

					Session::put('transaction_id', $transaction->id);
					Session::forget('applyform_id');

					$state_name = get_field_value('mf_state', 'name', 'id', $list->state_id);
					$college_name = get_field_value('mf_college', 'college_name', 'id', $list->college_id);
					$academic_year = $list->academic_year;
					$course_name = get_field_value('mf_course', 'name', 'id', $list->course_id);

					$data1 = array('fullname' => $list->name, 'email' => $list->email, 'applyform_id' => $list->id, 'state_name' => $state_name, 'college_name' => $college_name, 'academic_year' => $academic_year, 'course_name' => $course_name, 'transaction_id' => $transaction_id);
		        	Mail::to($list->email)->send(new OrderMail($data1));

					/*Order Email to Admin*/
					$admin_email = config('site.contact_email');
		        	$data1 = array('fullname' => $list->name, 'email' => $list->email, 'applyform_id' => $list->id, 'state_name' => $state_name, 'college_name' => $college_name, 'academic_year' => $academic_year, 'course_name' => $course_name, 'transaction_id' => $transaction_id);
		        	Mail::to($admin_email)->send(new OrderMailToAdmin($data1));

					return Redirect::to('/')->with('message', 'Success! Thank you for payment.');
				} else {
					return Redirect::back()->withErrors(array('errordetailsd' => 'Money not add in wallet!!'))->withInput();
				}
			} catch (Exception $e) {
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput();
			} catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput();
			} catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput();
			}
		}
	}

}