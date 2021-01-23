<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class UserController extends Controller
{
    use GeneralTrait, SendsPasswordResetEmails;
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
    public function forgetPassword(Request $request)
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
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );
        if ($response == Password::RESET_LINK_SENT) {
            return $this->SuccessMessage($response);
        } else {
            return $this->ValidatorMessages(['email' => trans($response)]);
        }
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
