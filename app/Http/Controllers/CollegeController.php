<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\Courses;
use App\Models\Colleges;
use App\Models\CollegeCourse;
use App\Models\CollegeImage;
use App\Models\States;
use App\Models\Cities;

use Illuminate\Support\Facades\DB;



class CollegeController extends Controller
{
	public function __construct()
	{
		// $this->middleware(['auth','verified']);
	}

	public function index()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'mf_college.id';
			$order = 'desc';
		}

		$column_array = array('id' => 'Id', 'college_name' => 'Name', 'short_name' => 'Short Name', 'city_name' => 'City', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "mf_college.id>0 ";

		if($search)
		{
			$search_column_array = array('mf_college.id' => 'Id', 'college_name' => 'Name', 'short_name' => 'Short Name', 'mf_city.name' => 'City', 'mf_college.created_at' => 'Created At');

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
		$colleges = Colleges::join('mf_city', 'mf_college.city_id', '=', 'mf_city.id')
		->select('mf_college.*','mf_city.name as city_name')
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

			$sorting_url = 'college?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.college.index', compact('colleges','column_array','sorting_array','search'));
	}

	public function add()
	{
		$courses = Courses::where('status','1')->orderBy('name', 'asc')->get();
		$states = States::where('status','1')->orderBy('name', 'asc')->get();
		return view('admin.college.add', compact('courses','states'));
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'college_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:mf_college',
			'state_id' => 'required|int',
			'city_id' => 'required|int',
			'course_id' => 'required|array|min:1',
			'price' => 'required|array|min:1',
			'status' => 'required|int'
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}
		if($request->hasfile('logo'))
		{
			$rules['logo'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}
		if($request->hasfile('brochure'))
		{
			$rules['brochure'] = 'mimes:doc,docx,pdf,jpg,jpeg|max:6120';
		}

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/college/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$college_name = $request->college_name;
			$slug = $request->slug;
			$status = $request->status;
			$college_type1 = $request->college_type;
			$college_type = '';
			if (is_array($college_type1) && count($college_type1)) {
				$college_type = implode(',', $college_type1);
			}

			$college_obj = new Colleges();
			$college_obj->college_name = $college_name;
			$college_obj->short_name = $request->short_name;
			$college_obj->slug = $slug;
			$college_obj->college_type = $college_type;
			$college_obj->state_id = $request->state_id;
			$college_obj->city_id = $request->city_id;
			$college_obj->meta_keyword = $request->meta_keyword;
			$college_obj->meta_description = $request->meta_description;
			if($request->hasfile('bannerimage'))
			{
				$file = $request->file('bannerimage');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$college_obj->bannerimage = $filename;
			}
			if($request->hasfile('logo'))
			{
				$file = $request->file('logo');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$college_obj->logo = $filename;
			}
			if($request->hasfile('brochure'))
			{
				$file = $request->file('brochure');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$college_obj->brochure = $filename;
			}
			$college_obj->estd_info = $request->estd_info;
			$college_obj->rank_info = $request->rank_info;
			$college_obj->map = $request->map;
			$college_obj->description = $request->description;
			$college_obj->course_fee = $request->course_fee;
			$college_obj->admission = $request->admission;
			$college_obj->placement = $request->placement;
			$college_obj->hostel = $request->hostel;
			$college_obj->news_articles = $request->news_articles;
			$college_obj->status = $status;
			$college_obj->save();

            if ( isset($request->galleryimage) && count($request->galleryimage)>0) {
                if($request->hasfile('galleryimage'))
                {
                    foreach($request->file('galleryimage') as $file){
                        $filename = $file->getClientOriginalName();
                        $filename = str_replace("&", "and", $filename);
                        $filename = str_replace(" ", "_", $filename);
                        $filename = time().$filename;
                        $file->move(public_path().'/uploads/', $filename);
                        $section_logo = $filename;
                        DB::insert('insert into mf_college_image (college_id, image) values (?, ?)', [$college_obj->id, $section_logo]);
                    }
                }
            }
            if ( isset($request->course_id) && count($request->course_id)>0) {
            	$course_id = $request->course_id;
            	$price = $request->price;
            	for ($i=0; $i < count($course_id); $i++) { 
            		$courseUp = CollegeCourse::firstOrNew(array('course_id' => $course_id[$i],'college_id' => $college_obj->id));
					$courseUp->college_id = $college_obj->id;
            		$courseUp->course_id = $course_id[$i];
            		$courseUp->price = $price[$i];
					$courseUp->save(); 
            	}
            }

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$college = Colleges::where('id',$id)->first();
		$courses = Courses::where('status','1')->orderBy('name', 'asc')->get();
		$states = States::where('status','1')->orderBy('name', 'asc')->get();
		$images = CollegeImage::where('college_id',$id)->get();
		$college_courses = CollegeCourse::where('college_id',$id)->get();
		return view('admin.college.edit', compact('college','courses','states','images','college_courses'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$college_name = $request->college_name;
		$slug = $request->slug;
		$status = $request->status;

		$rules = array(
			'college_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:mf_college,slug,'.$id,
			'state_id' => 'required|int',
			'city_id' => 'required|int',
			'course_id' => 'required|array|min:1',
			'price' => 'required|array|min:1',
			'status' => 'required|int'
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}
		if($request->hasfile('logo'))
		{
			$rules['logo'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}
		if($request->hasfile('brochure'))
		{
			$rules['brochure'] = 'mimes:doc,docx,pdf,jpg,jpeg|max:6120';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/college/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {

			$college_obj = Colleges::find($id); 
			$college_name = $request->college_name;
			$slug = $request->slug;
			$status = $request->status;
			$college_type1 = $request->college_type;
			$college_type = '';
			if (is_array($college_type1) && count($college_type1)) {
				$college_type = implode(',', $college_type1);
			}

			$college_obj->college_name = $college_name;
			$college_obj->short_name = $request->short_name;
			$college_obj->slug = $slug;
			$college_obj->college_type = $college_type;
			$college_obj->state_id = $request->state_id;
			$college_obj->city_id = $request->city_id;
			$college_obj->meta_keyword = $request->meta_keyword;
			$college_obj->meta_description = $request->meta_description;
			if($request->hasfile('bannerimage'))
			{
				if($college_obj->bannerimage!='' && file_exists(public_path().'/uploads/'.$college_obj->bannerimage))
				{
					unlink(public_path().'/uploads/'.$college_obj->bannerimage);
				}
				$file = $request->file('bannerimage');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$college_obj->bannerimage = $filename;
			}
			if($request->hasfile('logo'))
			{
				if($college_obj->logo!='' && file_exists(public_path().'/uploads/'.$college_obj->logo))
				{
					unlink(public_path().'/uploads/'.$college_obj->logo);
				}
				$file = $request->file('logo');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$college_obj->logo = $filename;
			}
			if($request->hasfile('brochure'))
			{
				if($college_obj->brochure!='' && file_exists(public_path().'/uploads/'.$college_obj->brochure))
				{
					unlink(public_path().'/uploads/'.$college_obj->brochure);
				}
				$file = $request->file('brochure');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$college_obj->brochure = $filename;
			}
			$college_obj->estd_info = $request->estd_info;
			$college_obj->rank_info = $request->rank_info;
			$college_obj->map = $request->map;
			$college_obj->description = $request->description;
			$college_obj->course_fee = $request->course_fee;
			$college_obj->admission = $request->admission;
			$college_obj->placement = $request->placement;
			$college_obj->hostel = $request->hostel;
			$college_obj->news_articles = $request->news_articles;
			$college_obj->status = $status;
			$college_obj->save();

            if ( isset($request->galleryimage) && count($request->galleryimage)>0) {
                if($request->hasfile('galleryimage'))
                {
                    foreach($request->file('galleryimage') as $file){
                        $filename = $file->getClientOriginalName();
                        $filename = str_replace("&", "and", $filename);
                        $filename = str_replace(" ", "_", $filename);
                        $filename = time().$filename;
                        $file->move(public_path().'/uploads/', $filename);
                        $section_logo = $filename;
                        DB::insert('insert into mf_college_image (college_id, image) values (?, ?)', [$college_obj->id, $section_logo]);
                    }
                }
            }
            if ( isset($request->course_id) && count($request->course_id)>0) {
            	DB::delete('delete from mf_college_course where college_id = ?',[$college_obj->id]);
            	$course_id = $request->course_id;
            	$price = $request->price;
            	for ($i=0; $i < count($course_id); $i++) { 
            		$courseUp = CollegeCourse::firstOrNew(array('course_id' => $course_id[$i],'college_id' => $college_obj->id));
					$courseUp->college_id = $college_obj->id;
            		$courseUp->course_id = $course_id[$i];
            		$courseUp->price = $price[$i];
					$courseUp->save(); 
            	}
            }

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}

		}
	}

    public function file_destroy($key,$id)
    {
		$msg = 'Sorry, nothing is deleted.';
    	if ($key=='bannerimage') {
    		$college_obj = Colleges::find($id);
			if($college_obj->bannerimage!='' && file_exists(public_path().'/uploads/'.$college_obj->bannerimage))
			{
				unlink(public_path().'/uploads/'.$college_obj->bannerimage);
			}
			$college_obj->bannerimage='';
			$college_obj->save();
			$msg = 'Image deleted successfully.';
    	}elseif ($key=='brochure') {
    		$college_obj = Colleges::find($id);
			if($college_obj->brochure!='' && file_exists(public_path().'/uploads/'.$college_obj->brochure))
			{
				unlink(public_path().'/uploads/'.$college_obj->brochure);
			}
			$college_obj->brochure='';
			$college_obj->save();
			$msg = 'File deleted successfully.';
    	}elseif ($key=='logo') {
    		$college_obj = Colleges::find($id);
			if($college_obj->logo!='' && file_exists(public_path().'/uploads/'.$college_obj->logo))
			{
				unlink(public_path().'/uploads/'.$college_obj->logo);
			}
			$college_obj->logo='';
			$college_obj->save();
			$msg = 'Logo deleted successfully.';
    	}elseif ($key=='gallery') {
	        $obj = CollegeImage::find($id);
	        if ($obj->image && file_exists(public_path().'/uploads/'.$obj->image)) {
	            unlink(public_path().'/uploads/'.$obj->image);
	        }
	        CollegeImage::destroy($id);
			$msg = 'Image deleted successfully.';
    	}
        return redirect()->back()->with('file_destroy', $msg);
    }

	public function delete($id)
	{
		$list = Colleges::find($id);
        $images = CollegeImage::where('college_id',$id)->get();
        if ($list->bannerimage && file_exists(public_path().'/uploads/'.$list->bannerimage)) {
            unlink(public_path().'/uploads/'.$list->bannerimage);
        }
        if ($list->brochure && file_exists(public_path().'/uploads/'.$list->brochure)) {
            unlink(public_path().'/uploads/'.$list->brochure);
        }
        if ($list->logo && file_exists(public_path().'/uploads/'.$list->logo)) {
            unlink(public_path().'/uploads/'.$list->logo);
        }
        foreach ($images as $key => $value) {
            if ($value->image && file_exists(public_path().'/uploads/'.$value->image)) {
                unlink(public_path().'/uploads/'.$value->image);
            }
            CollegeImage::destroy($value->id);
        }
        DB::delete('delete from mf_college_course where college_id = ?',[$id]);
		Colleges::destroy($id);
		return redirect()->back()->with('delete_success', true);
	}

	public function status($id,$status)
	{
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		DB::table('mf_college')
		->where('id', $id)
		->update($update_array);
		return redirect()->back()->with('status_success', true);
	}

	public function get_college()
	{
		$return='<option value="">Select</option>';
		$state_id = Request()->state_id;
		$college_id = Request()->college_id;
		$colleges = Colleges::where('state_id',$state_id)->get();
		foreach ($colleges as $key => $value) {
			$selected = ($value->id==$college_id) ? 'selected' : '' ;
			$return.='<option value="'.$value->id.'" '.$selected.'>'.$value->college_name.'</option>';
		}
		echo json_encode($return);
	}

	public function get_college_course()
	{
		$return='<option value="">Select</option>';
		$course_id = Request()->course_id;
		$college_id = Request()->college_id;
		$colleges = CollegeCourse::select('mf_college_course.*','mf_course.name')
				->join('mf_course', 'mf_college_course.course_id', '=', 'mf_course.id')
				->where('mf_college_course.college_id',$college_id)
				->get();
		foreach ($colleges as $key => $value) {
			$selected = ($value->course_id==$course_id) ? 'selected' : '' ;
			$return.='<option value="'.$value->course_id.'" '.$selected.' data-price="'.$value->price.'">'.$value->name.'</option>';
		}
		echo json_encode($return);
	}
}