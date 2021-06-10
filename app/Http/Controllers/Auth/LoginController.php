<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Redirect;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }


    protected function authenticated(Request $request, $user)
    {
        if ($user->status != 1) {

            if($user->status==0)
            {
                $message = 'Your account is inactive, please contact to administratior.';
            }
            else
            {
                $message = 'Your account has been deleted.';
            }

            // Log the user out.
            $this->logout($request);

            // Return them to the log in form.
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    // This is where we are providing the error message.
                    $this->username() => $message,
                ]);
        }
        else
        {
            $update_array = array('already_logged' => 0, 'last_login'=>date('Y-m-d H:i:s'));
            DB::table('users')
            ->where('id', $user->id)
            ->update($update_array);
            if ($user->role_id=='4' && Session::has('file_upload') && file_exists(public_path().'/uploads/order/'.Session::get('file_upload'))){
                return Redirect::to('place-order');
            }
        }
    }


    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }


    /**
    * Get the login username to be used by the controller.
    *
    * @return string
    */
    public function findUsername()
    {
        $login = request()->input('email');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
    * Get username property.
    *
    * @return string
    */
    public function username()
    {
        return $this->username;
    }
}
