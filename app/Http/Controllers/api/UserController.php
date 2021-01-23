<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
            "country_code"      => $user->country_code,
            "country_number"    => $user->country_phone,
            "email"             => $user->email,
            "first_name"        => $user->first_name,
            "image"             => find_image(@$user->image ),
            "is_phone_verified" => $user->is_phone_virefied ? true: false ,
            "last_name"         => $user->last_name,
            "phone"             => $user->phone,
            "role_id"           => $user->role,
            "token"             => $token,
            "userId"            => $user->id
        ];
        if ($user->interestCountry) {
                $data["interest_country"] = @$user->interestCountry;
        }
        return $this->returnData('mUser',$data,__('Success login'));
    }
    public function check_phone(Request $request)
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

        $user = User::where('phone' ,$request->phone)->first();
        if ($user ) {
            return $this->SuccessMessage('This Phone Number Already Found');
        }else {
            return $this->errorMessage("phone number does n't exist");
        }
    }
    public function update_interested_country(Request $request)
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
        $validator  = Validator::make((array) $request->all(), ['interest_country'=>'required|integer']);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $user = auth()->user();
        $user->interest_country = $request->interest_country;
        $user->save();
        return $this->SuccessMessage('Updated Successfully');
    }
    public function signup(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }
        if (!$request->phone) {
            return $this->errorField('phone');
        }
        $user = User::where('phone' ,$request->phone)->first();
        if ($user ) {
            return $this->returnFailData('phone_number_exist',true,__('This phone number used before'));
        }
        $validator  = Validator::make((array) $request->all(), User::rules(true));
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $provider = 'user';
        $user = User::create(User::credentials($request,true));
        $user->attachRole($provider) ;
        $token = $user->createToken('my-app-token')->plainTextToken;
        $data = [
            "country_code"      => $user->country_code,
            "country_number"    => $user->country_phone,
            "email"             => $user->email,
            "first_name"        => $user->first_name,
            "image"             => find_image(@$user->image ),
            "is_phone_verified" => $user->is_phone_virefied ? true: false ,
            "last_name"         => $user->last_name,
            "phone"             => $user->phone,
            "role_id"           => $user->role,
            "token"             => $token,
            "userId"            => $user->id
        ];
        if ($user->interestCountry) {
            $data["interest_country"] = @$user->interestCountry;
        }
        return $this->returnData('mUser',$data,__('Success create the Account'), ["phone_number_exist" => false]);

    }
}
