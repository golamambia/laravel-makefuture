<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use App\Models\Page;
use App\Models\PageExtra;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user='';
        //return Redirect::to('home');
        $setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();
        $page = Page::where('id','1')->get();
        $extra_data = array();

        if(count($page)){
            if($page[0]->meta_title){
                @$setting[0]->value = $page[0]->meta_title;
            }
            if($page[0]->meta_keyword){
                @$setting[1]->value = $page[0]->meta_keyword;
            }
            if($page[0]->meta_description){
                @$setting[2]->value = $page[0]->meta_description;
            }

            $extra_data = PageExtra::where('page_id',$page[0]->id)->get();
            return view('frontend.home', compact('user', 'page', 'extra_data'));
        }else{
            return redirect('404');
        }
    }
}
