<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use GeneralTrait;
    //
    public function login(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        if (!$request->phone) {
            return $this->errorField('phone');
        }
        if (!$request->password) {
            return $this->errorField('password');
        }
        $user = User::where('phone' ,$request->phone)->first();
        if (!$user or !Hash::check($request->password, $user->password)) {
            return $this->errorMessage('unauthorized');
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $data = [
                    "country_code" => $user->country_code,
                    "country_number" => $user->country_phone,
                    "email" => $user->email,
                    "first_name" => $user->first_name,
                    "image" => @$user->image->base . @$user->image->name,
                    "is_phone_verified" => $user->is_phone_virefied,
                    "last_name" => $user->last_name,
                    "phone" => $user->phone,
                    "role_id" => $user->role,
                    "token"=> $token,
                    "userId"=> $user->id
                ];
                if ($user->interestCountry) {
                     $data["interest_country"] = @$user->interestCountry->name;
                }
        return $this->returnData('mUser',$data,__('Success login'));
    }
}
