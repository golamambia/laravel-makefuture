<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\States;
use App\Models\Cities;

use Illuminate\Support\Facades\DB;



class CityController extends Controller
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

		$column_array = array('id' => 'Id', 'name' => 'Name', 'state_name' => 'State', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "mf_city.id>0 ";

		if($search)
		{
			$search_column_array = array('mf_city.id' => 'Id', 'mf_city.name' => 'Name', 'mf_state.name' => 'State', 'mf_city.created_at' => 'Created At');

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
		$cities = Cities::join('mf_state', 'mf_city.state_id', '=', 'mf_state.id')
		->select('mf_city.*','mf_state.name as state_name')
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

			$sorting_url = 'city?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.city.index', compact('cities','column_array','sorting_array','search'));
	}

	public function add()
	{
		$states = States::where('status','1')->orderBy('name', 'asc')->get();
		return view('admin.city.add', compact('states'));
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'name' => 'required|string|max:255',
			'state_id' => 'required|int',
			'status' => 'required|int'
		);

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/city/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
				$name = $request->name;
				$state_id = $request->state_id>0?$request->state_id:0;
				$status = $request->status;

				$city_obj = new Cities();
				$city_obj->name = $name;
				$city_obj->state_id = $state_id;
				$city_obj->status = $status;
				$city_obj->save();

				return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	public function edit($id)
	{
		$city = Cities::where('id',$id)->first();
		$states = States::where('status','1')->orderBy('name', 'asc')->get();
		return view('admin.city.edit', compact('city','states'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$state_id = $request->state_id>0?$request->state_id:0;
		$status = $request->status;

		$rules = array(
			'name' => 'required|string|max:255',
			'state_id' => 'required|int',
			'status' => 'required|int',
		);

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('admin/city/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
				$city_obj = Cities::find($id); 
				$city_obj->name = $name;
				$city_obj->state_id = $state_id;
				$city_obj->status = $status;
				$city_obj->save();

				return redirect()->back()->with('success', true);

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

	public function delete($id)
	{
		Cities::destroy($id);
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
		DB::table('mf_city')
		->where('id', $id)
		->update($update_array);
		return redirect()->back()->with('status_success', true);
	}

	public function get_city()
	{
		$return='<option value="">Select</option>';
		$state_id = Request()->state_id;
		$city_id = Request()->city_id;
		if ($state_id>0) {
		}
			$cities = Cities::where('state_id',$state_id)->get();
		foreach ($cities as $key => $value) {
			$selected = ($value->id==$city_id) ? 'selected' : '' ;
			$return.='<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
		}
		echo json_encode($return);
	}
}