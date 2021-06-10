<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use DB;

class UserHomeController extends Controller
{
    public function __construct()
    {
    }

    public function test(Request $request)
    {
        echo "UserHomeController string";
        if (Auth::check()) {
            echo "User Yes";
        }else{
            echo "User No";
        }
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
            $respond['message']       = 'Validation Error';
            $respond['response_data'] = $validator->messages();
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
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * @queryParam user
     */
     public function sermon_list_view(Request $request)

    {

      
            $data['sermon_list'] = User::find($request->user_id);

           echo json_encode($data['sermon_list']);
        

    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function get_user(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++
        $respond = [];
        //++++++++++++++++++++++++++++++++++++++++++++++
        //echo "1";
        //++++++++++++++++++++++++++++++++++++++++++++++
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        //++++++++++++++++++++++++++++++++++++++++++++++
        if ($validator->fails()) {
            $respond['status']        = false;
            $respond['message']       = 'Validation Error';
            $respond['response_data'] = $validator->messages();
        } else {
            try {
                //++++++++++++++++++++++++++++++++++++++++++++++
                $user = User::find($request->user_id);
                //++++++++++++++++++++++++++++++++++++++++++++++
                $respond['status']        = true;
                $respond['message']       = 'All token list';
                $respond['response_data'] = $user;
            } catch (\Exception $e) {
                $respond['status']        = false;
                $respond['message']       = $e->getMessage();
                $respond['response_data'] = null;
            }
        }
        /*if (Auth::check()) {
            try {
                //++++++++++++++++++++++++++++++++++++++++++++++
                $user = Auth::user();
                //++++++++++++++++++++++++++++++++++++++++++++++
                $respond['status']        = true;
                $respond['message']       = 'User Details';
                $respond['response_data'] = $user;
            } catch (\Exception $e) {
                $respond['status']        = false;
                $respond['message']       = $e->getMessage();
                $respond['response_data'] = null;
            }
        } else {
            $respond['status']        = false;
            $respond['message']       = 'Auth Error';
            $respond['response_data'] = $validator->messages();
        }*/
        return $respond;
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * @queryParam id int required
     * @queryParam title string required
     * @queryParam name string required
     * @queryParam gender string required
     * @queryParam email string required
     * @queryParam phone_no integer required
     */
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function update_user_al(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++
        $respond = [];
        //++++++++++++++++++++++++++++++++++++++++++++++
        $validator = Validator::make($request->all(), [
            'id'                               => 'required',
            'f_name'                            => 'required|max:240',
            'l_name'                             => 'required|max:240',
            // 'email'                            => 'required|email|max:240',
            // 'phone_number'                         => 'required|numeric',
        ]);
        //++++++++++++++++++++++++++++++++++++++++++++++
        if ($validator->fails()) {
            $respond['status']        = false;
            $respond['message']       = 'Validation Error';
            $respond['response_data'] = $validator->messages();
        } else {
            try {
                $address = $request->address;
                $aadhaar_number = $request->aadhaar_number;

                $obj            = User::find($request->id);
                $obj->first_name      = $request->f_name;
                $obj->last_name     = $request->l_name;
                $obj->phone_number      = $request->phone_number;
                $obj->address     = $address;
                $obj->aadhaar_number     = $aadhaar_number;
                $avatar_filename = '';
                if($request->hasfile('avatar'))
                {
                    if($obj->avatar!='' && file_exists(public_path().'/uploads/'.$obj->avatar))
                    {
                        unlink(public_path().'/uploads/'.$obj->avatar);
                    }
                    $avatar = $request->file('avatar');
                    $filename = $avatar->getClientOriginalName();
                    $filename = str_replace("&", "and", $filename);
                    $filename = str_replace(" ", "_", $filename);
                    $filename = time().$filename;
                    $avatar->move(public_path().'/uploads/', $filename);
                    $obj->avatar = $filename;
                }
                //++++++++++++++++++++++++++++++++++++++++++++++++++++++
                $obj->save();
                //++++++++++++++++++++++++++++++++++++++++++++++++++++++
                if ($obj->id) {
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    $respond['status']            = true;
                    $respond['message']           = 'The user has been updated.';
                    $respond['response_data']     = User::find($obj->id);
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
     * @queryParam old_password string required
     * @queryParam new_password string required
     * @queryParam confirm_new_password string required
     */
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function update_user_password_al(Request $request)
    {
        //++++++++++++++++++++++++++++++++++++++++++++++
        $respond = [];
        //++++++++++++++++++++++++++++++++++++++++++++++
        $validator = Validator::make($request->all(), [
            'id'                    => 'required',
            'old_password'         => 'required|max:240',
            'new_password'         => 'required|max:240',
            'confirm_new_password' => 'required|max:240',
        ]);
        //++++++++++++++++++++++++++++++++++++++++++++++
        if ($validator->fails()) {
            $respond['status']        = false;
            $respond['message']       = 'Validation Error';
            $respond['response_data'] = $validator->messages();
        } else {
            try {
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                $obj = User::find($request->id);
                if (Hash::check($request->old_password, $obj->password)) {
                    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    DB::table('users')->where('id', $obj->id)->update(['password' => Hash::make($request->new_password)]);
                    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    $respond['status']            = true;
                    $respond['message']           = 'Password updated successfully.';
                    $respond['response_data']     = User::find($obj->id);
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
//End
}
