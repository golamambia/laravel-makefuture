<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

use App\Mail\WelcomeMail;
use App\Mail\PasswordChangeMail;
use App\Mail\AccountApprovedMail;

use Illuminate\Support\Facades\Mail;

class UserAuthController extends Controller
{
    public function __construct()
    {
    }

    public function test(Request $request)
    {
        echo "string";
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function register_user(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++
        $respond = [];
        //++++++++++++++++++++++++++++++++++++++++++++++
        $rules = array(
            'role_id' => 'required|int',
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            //'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
            //'phone_number' => 'digits:10',
            //'phone_number' => 'required|regex:/^\d{3}-\d{3}-\d{4}$/|min:10',
            // 'status' => 'required|int'
        );

        $customMessages = array(
            //'username.required'  => 'Please enter username',
            //'username.unique'  => 'The username is already in use on the system. Please use a different username.',
            'email.required'  => 'Please enter Email address',
            'email.unique'  => 'The email is already in use on the system. Please use a different email.',
            //'password.regex' => 'The :attribute field must have: a minimum of 1 lower case letter [a-z] and a minimum of 1 upper case letter [A-Z] and a minimum of 1 numeric character [0-9] and a minimum of 1 special character: ~`!@#$%^&*()-_+={}[]|\;:"<>,./?'
         ); 

        if($request->hasfile('avatar'))
        {
            $rules['avatar'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validator = Validator::make($request->all() , $rules, $customMessages);
        //++++++++++++++++++++++++++++++++++++++++++++++
        if ($validator->fails()) {
            $respond['status']        = false;
            $respond['response_data']       = 'Validation Error';
            $errors = $validator->messages();
            /*$msg='';
            foreach ($errors->all() as $key => $value) {
                $msg=$value;
            }
            $respond['message'] = $msg;*/
            if($errors->any()){
                $respond['message'] = implode(',', $errors->all());
            }else{
                $respond['message']       = 'Validation Error';
            }            
        } else {
            try {
                $fname = $request->f_name;
                $lname = $request->l_name;
                $fullname = $fname.' '. $lname;
                $email = $request->email;
                //$username = $request->username;
                $phone_number = $request->phone_number;
                // $role_id = $request->role_id=='2'?'2':'3';
                $password = $request->password;
                // $status = $request->status=='0'?'0':'1';
                if ($request->role_id=='2') {
                    $role_id = '2';
                    $status = '0';
                }else{
                    $role_id = '3';
                    $status = '1';
                }

                $address = $request->address;
                $aadhaar_number = $request->aadhaar_number;

                $avatar_filename = '';
                if($request->hasfile('avatar'))
                {
                    $avatar = $request->file('avatar');
                    $filename = $avatar->getClientOriginalName();
                    $filename = str_replace("&", "and", $filename);
                    $filename = str_replace(" ", "_", $filename);
                    $filename = time().$filename;
                    $avatar->move(public_path().'/uploads/', $filename);
                    $avatar_filename = $filename;
                }
                $referral_code = $role_id=='2'?strtoupper(Str::random(9)):'';

                $obj            = new User;
                $obj->role_id     = $role_id;
                $obj->first_name      = $fname;
                $obj->last_name      = $lname;
                $obj->email     = $request->email;
                $obj->avatar      = $avatar_filename;
                $obj->phone_number      = $phone_number;
                $obj->password  = Hash::make($password);
                $obj->address     = $address;
                $obj->aadhaar_number     = $aadhaar_number;
                $obj->referral_code     = $referral_code;
                $obj->status     = $status;
                //++++++++++++++++++++++++++++++++++++++++++++++++++++++
                $obj->save();
                //++++++++++++++++++++++++++++++++++++++++++++++++++++++
                if ($obj->id) {
                    //++++++++++++++++++++++++++++++++++++++++++++++++++
                    /*New User Email*/
                    $data1 = array('fullname' => $fullname, 'first_name' => $fname, 'email' => $email, 'password' => $password);
                    Mail::to($email)->send(new WelcomeMail($data1));
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    $respond['status']        = true;
                    $respond['message']       = 'Thank you for your registration! Your account is now ready to use.';
                    $respond['response_data'] = User::find($obj->id);
                } else {
                    $respond['status']        = false;
                    $respond['message']       = 'Opps!! sorry!! problem occurred.Please try again!';
                    $respond['response_data'] = null;
                }
            } catch (\Exception $e) {
                $respond['status']        = false;
                $respond['message']       = $e->getMessage();
                $respond['response_data'] = null;
            }
        }
        return $respond;
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * @queryParam email string required
     * @queryParam password string required
     */
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function login_user(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++
        $respond = [];
        //++++++++++++++++++++++++++++++++++++++++++++++
        /*$validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:240',
            'password' => 'required|max:240',
        ]);*/
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|max:191',
        );

        $customMessages = array(
            'email.required'  => 'Please enter Email address',
            'password.required'  => 'Please enter Password.',
         ); 
        $validator = Validator::make($request->all() , $rules);
        //++++++++++++++++++++++++++++++++++++++++++++++
        if ($validator->fails()) {
            $respond['status']        = false;
            $respond['response_data']       = 'Validation Error';
            $errors = $validator->messages();
            if($errors->any()){
                $respond['message'] = implode(',', $errors->all());
            }else{
                $respond['message']       = 'Validation Error';
            } 
        } else {
            try {
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                $credentials = $request->only('email', 'password');
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                if (Auth::attempt($credentials)) {
                    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    if (Auth()->user()->status!='1') {
                        Auth::logout();
                        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        $respond['status']            = false;
                        $respond['message']           = 'Sorry, Your account has been deactivated. Please contact administrator';
                        $respond['response_data']     = null;
                        $respond['api_token']         = null;
                        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
                    }else{                       
                        $token_name = Auth()->user()->email . '__' . now();
                        $token      = $request->user()->createToken($token_name);
                        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        DB::table('users')->where('id', Auth::ID())->update([
                            "already_logged" => 1,
                            'last_login'=>date('Y-m-d H:i:s')
                        ]);
                        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        $respond['status']            = true;
                        $respond['message']           = 'Login Successfully';
                        $respond['response_data']     = User::find(Auth::ID());
                        $respond['api_token']         = $token->plainTextToken;
                        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
                    }
                } else {
                    $respond['status']        = false;
                    $respond['message']       = 'Sorry!! wrong username or password';
                    $respond['response_data'] = null;
                }
            } catch (\Exception $e) {
                $respond['status']        = false;
                $respond['message']       = $e->getMessage();
                $respond['response_data'] = null;
            }
        }
        return $respond;
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * @queryParam user_id int required
     */
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function login_token_list_al(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++
        $respond = [];
        //++++++++++++++++++++++++++++++++++++++++++++++
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        //++++++++++++++++++++++++++++++++++++++++++++++
        if ($validator->fails()) {
            $respond['status']        = false;
            $respond['response_data']       = 'Validation Error';
            $errors = $validator->messages();
            if($errors->any()){
                $respond['message'] = implode(',', $errors->all());
            }else{
                $respond['message']       = 'Validation Error';
            } 
        } else {
            try {
                //++++++++++++++++++++++++++++++++++++++++++++++
                $user = User::find($request->user_id);
                //++++++++++++++++++++++++++++++++++++++++++++++
                $respond['status']        = true;
                $respond['message']       = 'All token list';
                $respond['response_data'] = $user->tokens;
            } catch (\Exception $e) {
                $respond['status']        = false;
                $respond['message']       = $e->getMessage();
                $respond['response_data'] = null;
            }
        }
        return $respond;
    }
//End
}
