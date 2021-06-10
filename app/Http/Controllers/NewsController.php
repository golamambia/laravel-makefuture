<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\News;
use App\Models\Colleges;

use Illuminate\Support\Facades\DB;



class NewsController extends Controller
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

		$column_array = array('id' => 'Id', 'title' => 'Name', 'college_name' => 'College', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "mf_news.id>0 ";

		if($search)
		{
			$search_column_array = array('mf_news.id' => 'Id', 'mf_news.title' => 'Name', 'mf_college.college_name' => 'College', 'mf_news.created_at' => 'Created At');

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
		$news = News::leftjoin('mf_college', 'mf_news.college_id', '=', 'mf_college.id')
		->select('mf_news.*','mf_college.college_name')
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

			$sorting_url = 'news?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.news.index', compact('news','column_array','sorting_array','search'));
	}

	public function add()
	{
		$colleges = Colleges::where('status','1')->orderBy('college_name', 'asc')->get();
		return view('admin.news.add', compact('colleges'));
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'title' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:mf_news',
			// 'college_id' => 'required|int',
			'status' => 'required|int'
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/news/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
				$title = $request->title;
				$slug = $request->slug;
				$college_id = $request->college_id>0?$request->college_id:0;
				$status = $request->status;

				$news_obj = new News();
				$news_obj->title = $title;
				$news_obj->slug = $slug;
				$news_obj->college_id = $college_id;
				$news_obj->meta_keyword = $request->meta_keyword;
				$news_obj->meta_description = $request->meta_description;
				$news_obj->description = $request->description;
				$news_obj->status = $status;
				if($request->hasfile('bannerimage'))
				{
					$file = $request->file('bannerimage');
					$filename = $file->getClientOriginalName();
					$filename = str_replace("&", "and", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = time().$filename;
					$file->move(public_path().'/uploads/', $filename);
					$news_obj->bannerimage = $filename;
				}
				$news_obj->save();

				return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	public function edit($id)
	{
		$news = News::where('id',$id)->first();
		$colleges = Colleges::where('status','1')->orderBy('college_name', 'asc')->get();
		return view('admin.news.edit', compact('news','colleges'));
	}

	public function update(Request $request)
	{
		$id = $request->id;

		$rules = array(
			'title' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:mf_news,slug,'.$id,
			// 'college_id' => 'required|int',
			'status' => 'required|int'
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/news/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
				$title = $request->title;
				$slug = $request->slug;
				$college_id = $request->college_id>0?$request->college_id:0;
				$status = $request->status;

				$news_obj = News::find($id); 
				$news_obj->title = $title;
				$news_obj->slug = $slug;
				$news_obj->college_id = $college_id;
				$news_obj->meta_keyword = $request->meta_keyword;
				$news_obj->meta_description = $request->meta_description; 
				$news_obj->description = $request->description;
				$news_obj->status = $status;
				if($request->hasfile('bannerimage'))
				{
					if($news_obj->bannerimage!='' && file_exists(public_path().'/uploads/'.$news_obj->bannerimage))
					{
						unlink(public_path().'/uploads/'.$news_obj->bannerimage);
					}
					$file = $request->file('bannerimage');
					$filename = $file->getClientOriginalName();
					$filename = str_replace("&", "and", $filename);
					$filename = str_replace(" ", "_", $filename);
					$filename = time().$filename;
					$file->move(public_path().'/uploads/', $filename);
					$news_obj->bannerimage = $filename;
				}
				$news_obj->save();

				return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

    public function file_destroy($id)
    {
		$msg = 'Sorry, nothing is deleted.';
    		$news_obj = News::find($id);
			if($news_obj->bannerimage!='' && file_exists(public_path().'/uploads/'.$news_obj->bannerimage))
			{
				unlink(public_path().'/uploads/'.$news_obj->bannerimage);
			}
			$news_obj->bannerimage='';
			$news_obj->save();
			$msg = 'Image deleted successfully.';
        return redirect()->back()->with('file_destroy', $msg);
    }

	public function delete($id)
	{
		$news_obj = News::find($id); 
		if($news_obj->bannerimage!='' && file_exists(public_path().'/uploads/'.$news_obj->bannerimage))
		{
			unlink(public_path().'/uploads/'.$news_obj->bannerimage);
		}
		News::destroy($id);
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
		DB::table('mf_news')
		->where('id', $id)
		->update($update_array);
		return redirect()->back()->with('status_success', true);
	}
}