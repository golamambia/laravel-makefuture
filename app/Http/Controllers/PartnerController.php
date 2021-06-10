<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\Partner;

use Illuminate\Support\Facades\DB;



class PartnerController extends Controller
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
			$orderby = 'rank';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'name' => 'Name', 'image' => 'Image', 'rank' => 'Order', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "id>0 ";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'name' => 'Name', 'image' => 'Image', 'rank' => 'Order', 'created_at' => 'Created At');

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
		$partners = Partner::whereRaw($where)
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

			$sorting_url = 'partner?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.partner.index', compact('partners','column_array','sorting_array','search'));
	}

	public function add()
	{
		return view('admin.partner.add');
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'name' => 'required|string|max:255',
			'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'rank' => 'required|int',
			'status' => 'required|int',
		);

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/partner/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$name = $request->name;
			$status = $request->status;

			$partner_obj = new Partner();
			$partner_obj->name = $name;
			if($request->hasfile('image'))
			{
				$file = $request->file('image');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$partner_obj->image = $filename;
			}
			$partner_obj->rank = $request->rank;
			$partner_obj->status = $status;
			$partner_obj->save();

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$partner = Partner::where('id',$id)->first();
		return view('admin.partner.edit', compact('partner'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$country_id = $request->country_id>0?$request->country_id:0;
		$status = $request->status;

		$rules = array(
			'name' => 'required|string|max:255',
			'rank' => 'required|int',
			'status' => 'required|int'
		);
		if($request->hasfile('image'))
		{
			$rules['image'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/partner/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {

			$partner_obj = Partner::find($id); 
			$partner_obj->name = $name;
			if($request->hasfile('image'))
			{
				if($partner_obj->image!='' && file_exists(public_path().'/uploads/'.$partner_obj->image))
				{
					unlink(public_path().'/uploads/'.$partner_obj->image);
				}
				$file = $request->file('image');
				$filename = $file->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$file->move(public_path().'/uploads/', $filename);
				$partner_obj->image = $filename;
			}
			$partner_obj->rank = $request->rank;
			$partner_obj->status = $status;
			$partner_obj->save();

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}

		}


	}

	public function delete($id)
	{
		$partner_obj = Partner::find($id); 
		if($partner_obj->image!='' && file_exists(public_path().'/uploads/'.$partner_obj->image))
		{
			unlink(public_path().'/uploads/'.$partner_obj->image);
		}
		Partner::destroy($id);
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
		DB::table('mf_partner')
		->where('id', $id)
		->update($update_array);
		return redirect()->back()->with('status_success', true);
	}
}