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

class FranchiseController extends BaseController
{

	public function __construct()
	{
		$this->middleware(['auth']);
	    $this->middleware(function ($request, $next) {
	        $this->user = Auth::user();
	        if ($this->user->role_id!=2) {
	        	return Redirect::to('/');
	        }/**/
	        return $next($request);
	    });
	}

	/* student List Get*/
	public function studentList()
	{
		$user = $this->user;

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'users.id';
			$order = 'desc';
		}

		$where = "referred_by='".$user->id."' ";

		$item_display_per_page = config('site.pagination');
		$referrals = User::select('users.*')
		->join('mf_referral', 'users.id', '=', 'mf_referral.user_id')
		->whereRaw($where)
		->orderBy($orderby, $order)
		->paginate($item_display_per_page);

		$setting = DB::table('mf_settings')->whereIn('id', array(5, 6, 7))->get();
		$title = 'Student List';
		@$setting[0]->value = $title;
		@$setting[1]->value = $title;
		@$setting[2]->value = $title;

		return view('frontend.student-list', compact('referrals', 'setting'));
	}

}