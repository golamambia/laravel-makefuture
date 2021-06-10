<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Referral;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Mail\WelcomeMail;
use App\Mail\UserRegistrationMailToAdmin;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Redirect;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = array(
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'aggrement' => 'required',
        );
        $customMessages = array(
            'first_name.required'  => 'Please enter First name',
            'last_name.required'  => 'Please enter Last name',
            'email.required'  => 'Please enter Email address',
            'email.unique'  => 'The email is already in use on the system. Please use a different email.',
            'aggrement.required'  => 'Please agree to the Terms & Conditions.',
         );
        if(@$data['referral_code'])
        {
            $data['referral_code_validate'] = '1';
            $rules['referral_code_validate'] = 'required';
            $customMessages['referral_code_validate.required'] = 'Wrong Referral Code.';

            $user_details = User::where('referral_code', $data['referral_code'])->first();

            if(!$user_details)
            {
                $data['referral_code_validate'] = '';
            }
        }
        return Validator::make($data, $rules, $customMessages);
        /*return Validator::make($data, [
            //'role_id' => ['required', 'int'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);*/
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (@$data['role_id']=='2') {
            $role_id = 2;
            $status = '0';
            $aadhaar_number = $data['aadhaar_number'];
            $referral_code = strtoupper(Str::random(9));
        }else{
            $role_id = 3;
            $status = '1';
            $aadhaar_number = '';
            $referral_code = '';
        }
        /*return User::create([
            'role_id' => $role_id,
            'name' => $data['first_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);*/
        $user = new User();
        $user->role_id = $role_id;
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone_number = $data['phone_number'];
        $user->address = $data['address'];
        $user->aadhaar_number = $aadhaar_number;
        $user->referral_code = $referral_code;
        $user->status = $status;
        // $user->last_activity = date('Y-m-d H:i:s');
        $user->save();

        if(@$data['referral_code'])
        {
            $user_details = User::where('referral_code', $data['referral_code'])->first();
            if($user_details)
            {
                $referral = new Referral();
                $referral->user_id = $user->id;
                $referral->referred_by = $user_details->id;
                $referral->save();
            }
        }

        $data['fullname'] = $data['first_name'].' '.$data['last_name'];
        Mail::to($data['email'])->send(new WelcomeMail($data));
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // event(new Registered($user = $this->create($request->all())));
        $user = $this->create($request->all());
        if ($user->role_id == '2') {
            // $msg = 'Franchise registration successful! Please wait for approve by administrator.';
            $msg = 'Success! You have registered as franchise, Please wait for approve by administrator and check your email for more instructions.';
            \Session::flash('message',$msg );
            \Auth::logout();
        }else{
            $userdata = array(
                'email' => $request->email ,
                'password' => $request->password
            );
            Auth::attempt($userdata);
        }

        return redirect($this->redirectPath());
    }
}
