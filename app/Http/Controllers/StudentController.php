<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use URL;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;

use App\Mail\WelcomeMail;
// use App\Mail\PaymentReleaseRequestMailToAdmin;
use App\Mail\OrderAcceptMail;
use App\Mail\OrderCompleteMail;
use App\Mail\OrderCompleteMailToAdmin;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Models\Role;
use App\Models\Referral;
use App\Models\Applyform;
use App\Models\ApplyformExam;
use App\Models\Transaction;

class StudentController extends BaseController
{

	public function __construct()
	{
		$this->middleware(['auth']);
	    $this->middleware(function ($request, $next) {
	        $this->user = Auth::user();
	        if ($this->user->role_id!=3) {
	        	return Redirect::to('/');
	        }/**/
	        return $next($request);
	    });
	}

	/* Apply Course Get*/
	public function applyCourse()
	{
		$user = $this->user;

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'mf_applyform.id';
			$order = 'desc';
		}

		$where = "mf_applyform.user_id='".$user->id."' ";

		$item_display_per_page = config('site.pagination');
		$lists = Applyform::select('mf_applyform.*','mf_state.name as state_name','mf_college.college_name','mf_course.name as course_name')
		->join('mf_state', 'mf_applyform.state_id', '=', 'mf_state.id')
		->join('mf_college', 'mf_applyform.college_id', '=', 'mf_college.id')
		->join('mf_course', 'mf_applyform.course_id', '=', 'mf_course.id')
		->whereRaw($where)
		->orderBy($orderby, $order)
		->paginate($item_display_per_page);

		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();
		$title = 'Apply Course';
		@$setting[0]->value = $title;
		@$setting[1]->value = $title;
		@$setting[2]->value = $title;

		return view('frontend.apply-course', compact('lists', 'setting'));
	}

	/* View Apply Course GET */
	public function applyCourseView($id)
	{
		$user = $this->user;
		$list = Applyform::select('mf_applyform.*','mf_state.name as state_name','mf_college.college_name','mf_course.name as course_name')
		->join('mf_state', 'mf_applyform.state_id', '=', 'mf_state.id')
		->join('mf_college', 'mf_applyform.college_id', '=', 'mf_college.id')
		->join('mf_course', 'mf_applyform.course_id', '=', 'mf_course.id')
		->where('mf_applyform.id',$id)->where('mf_applyform.user_id',$user->id)->first(); 
		if (!$list) {
			return Redirect::to('apply-form');
		}
		$transaction = Transaction::where('applyform_id',$list->id)->first(); 

		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();
		$title = 'Apply Course View';
		@$setting[0]->value = $title;
		@$setting[1]->value = $title;
		@$setting[2]->value = $title;
		return view('frontend.apply-course-view', compact('list','transaction', 'setting'));
	}

}