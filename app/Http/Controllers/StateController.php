<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\States;

use Illuminate\Support\Facades\DB;



class StateController extends Controller
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

		$column_array = array('id' => 'Id', 'name' => 'Name', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "id>0 ";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'name' => 'Name', 'created_at' => 'Created At');

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
		$states = States::whereRaw($where)
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

			$sorting_url = 'state?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.state.index', compact('states','column_array','sorting_array','search'));
	}

	public function add()
	{
		return view('admin.state.add');
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'name' => 'required|string|max:255',
			'status' => 'required|int'
		);

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/state/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$name = $request->name;
			$country_id = $request->country_id>0?$request->country_id:0;
			$status = $request->status;

			$state_obj = new States();
			$state_obj->name = $name;
			$state_obj->country_id = $country_id;
			$state_obj->status = $status;
			$state_obj->save();

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$state = States::where('id',$id)->first();
		return view('admin.state.edit', compact('state'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$country_id = $request->country_id>0?$request->country_id:0;
		$status = $request->status;

		$rules = array(
			'name' => 'required|string|max:255',
			'status' => 'required|int'
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/state/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {

			$state_obj = States::find($id); 
			$state_obj->name = $name;
			$state_obj->country_id = $country_id;
			$state_obj->status = $status;
			$state_obj->save();

			return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}

		}


	}

	public function delete($id)
	{
		States::destroy($id);
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
		DB::table('mf_state')
		->where('id', $id)
		->update($update_array);
		return redirect()->back()->with('status_success', true);
	}
}