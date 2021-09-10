<?php

namespace App\Http\Controllers\Website;

use App\Models\website\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            return view('website.user',compact('user'));
        } else {
            return redirect('/');
        }
    }
    public function edit()
    {
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            return view('website.edit_user',compact('user'));
        } else {
            return redirect('/');
        }
    }
    public function update(Request $request)
    {
        $EditUser = User::find(Auth::user()->id);
        $this->validate($request,[
            'first_name'       => 'required|min:4|max:15',
            'last_name'        => 'required|min:4|max:15|',
            'phone'            => 'required|digits:11|',
            'password_confirm' => 'nullable|same:password'
        ]);
        $hashPassword = Hash::make($request->password);
        $EditUser->first_name         = $request->first_name;
        $EditUser->last_name          = $request->last_name;
        $EditUser->phone              = $request->phone;
        if($request->password)
        {
        $EditUser->password           = $hashPassword;
        }
        $EditUser->save();
        session()->flash('success',__("Settings has been updated!"));
        return redirect()->back();
    }
}
