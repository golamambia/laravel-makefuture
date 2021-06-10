<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\Courses;

use Illuminate\Support\Facades\DB;



class CourseController extends Controller
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
			$orderby = 'id';
			$order = 'desc';
		}

		$column_array = array('id' => 'Id', 'name' => 'Name', 'completed_in' => 'Course Duration', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "id>0 ";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'name' => 'Name', 'completed_in' => 'Course Duration', 'created_at' => 'Created At');

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
		$courses = Courses::whereRaw($where)
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

			$sorting_url = 'course?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.course.index', compact('courses','column_array','sorting_array','search'));
	}

	public function add()
	{
		return view('admin.course.add');
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:mf_course',
			'status' => 'required|int'
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		if($request->hasfile('image'))
		{
			$rules['image'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/course/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$name = $request->name;
			$slug = $request->slug;
			$completed_in = $request->completed_in;
			$status = $request->status;
			$course_type = $request->course_type>0?$request->course_type:0;
			$course_subtype = $request->course_subtype>0 && $course_type>1?$request->course_subtype:0;

			$course_obj = new Courses();
			$course_obj->name = $name;
			$course_obj->slug = $slug;
			$course_obj->completed_in = $completed_in;
			$course_obj->status = $status;
			$course_obj->course_type = $course_type;
			$course_obj->course_subtype = $course_subtype;
			if($request->hasfile('image'))
			{
				$file = $request->file('image');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$course_obj->image = $filename;
			}
			$course_obj->meta_keyword = $request->meta_keyword;
			$course_obj->meta_description = $request->meta_description;
			if($request->hasfile('bannerimage'))
			{
				$file = $request->file('bannerimage');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$course_obj->bannerimage = $filename;
			}
			$course_obj->description = $request->description;
			$course_obj->save();

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$course = Courses::where('id',$id)->first();
		return view('admin.course.edit', compact('course'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$slug = $request->slug;
		$completed_in = $request->completed_in;
		$status = $request->status;
		$course_type = $request->course_type>0?$request->course_type:0;
		$course_subtype = $request->course_subtype>0 && $course_type>1?$request->course_subtype:0;

		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:mf_course,slug,'.$id,
			'status' => 'required|int'
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		if($request->hasfile('image'))
		{
			$rules['image'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/course/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {

			$course_obj = Courses::find($id); 
			$course_obj->name = $name;
			$course_obj->slug = $slug;
			$course_obj->completed_in = $completed_in;
			$course_obj->status = $status;
			$course_obj->course_type = $course_type;
			$course_obj->course_subtype = $course_subtype;
			if($request->hasfile('image'))
			{
				if($course_obj->image!='' && file_exists(public_path().'/uploads/'.$course_obj->image))
				{
					unlink(public_path().'/uploads/'.$course_obj->image);
				}
				$file = $request->file('image');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$course_obj->image = $filename;
			}
			$course_obj->meta_keyword = $request->meta_keyword;
			$course_obj->meta_description = $request->meta_description;
			if($request->hasfile('bannerimage'))
			{
				if($course_obj->bannerimage!='' && file_exists(public_path().'/uploads/'.$course_obj->bannerimage))
				{
					unlink(public_path().'/uploads/'.$course_obj->bannerimage);
				}
				$file = $request->file('bannerimage');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$course_obj->bannerimage = $filename;
			}
			$course_obj->description = $request->description;
			$course_obj->save();

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}

		}


	}

    public function file_destroy($key,$id)
    {
		$course_obj = Courses::find($id);
		$msg = 'Sorry, nothing is deleted.';
    	if ($key=='bannerimage') {
			if($course_obj->bannerimage!='' && file_exists(public_path().'/uploads/'.$course_obj->bannerimage))
			{
				unlink(public_path().'/uploads/'.$course_obj->bannerimage);
			}
			$course_obj->bannerimage='';
			$course_obj->save();
			$msg = 'Banner Image deleted successfully.';
    	}elseif ($key=='image') {
			if($course_obj->image!='' && file_exists(public_path().'/uploads/'.$course_obj->image))
			{
				unlink(public_path().'/uploads/'.$course_obj->image);
			}
			$course_obj->image='';
			$course_obj->save();
			$msg = 'Image deleted successfully.';
		}
        return redirect()->back()->with('file_destroy', $msg);
    }

	public function delete($id)
	{
		$course_obj = Courses::find($id); 
		if($course_obj->image!='' && file_exists(public_path().'/uploads/'.$course_obj->image))
		{
			unlink(public_path().'/uploads/'.$course_obj->image);
		}
		Courses::destroy($id);
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
		DB::table('mf_course')
		->where('id', $id)
		->update($update_array);
		return redirect()->back()->with('status_success', true);
	}
}