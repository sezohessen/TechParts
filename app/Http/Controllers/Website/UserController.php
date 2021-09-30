<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        // if(Auth::user())
        // {
        //     $user = User::find(Auth::user()->id);
        //     return view('website.user',compact('user'));
        // } else {
        //     return redirect('/');
        // }
    }
    public function edit()
    {
        $page_title = __('Profile');
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            return view('website.edit_user',compact('user','page_title'));
        } else {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {


        $EditUser = User::find(Auth::user()->id);
        $this->validate($request,[
            'first_name'       => 'required|min:4|max:25',
            'last_name'        => 'required|min:4|max:25|',
            'phone'            => 'required|min:8|max:11',
            'whats_app'        => 'required|min:8|max:11',
            'password'         => 'nullable|min:8|max:30',
            'password_confirm' => 'nullable|same:password'
        ]);
        $hashPassword                 = Hash::make($request->password);
        $EditUser->first_name         = $request->first_name;
        $EditUser->last_name          = $request->last_name;
        $EditUser->phone              = $request->phone;
        $EditUser->whats_app          = $request->whats_app;

        // if password is writen and it equles confirm password then save the new password
        if($request->password AND $request->password == $request->password_confirm)
        {
        $EditUser->password           = $hashPassword;
        $EditUser->save();
        session()->flash('success',__("Settings has been updated!"));
        return redirect()->back();
        }
        // if password is writen and it doesn't equle confirm password then show error message
        elseif($request->password AND $request->password != $request->password_confirm)
        {
        session()->flash('error',__("Passowrd Not confirmed"));
        return redirect()->back();
        }
        // if password is not written save data
        else
        {
        $EditUser->save();
        session()->flash('success',__("Settings has been updated!"));
        return redirect()->back();
        }

    }
}
