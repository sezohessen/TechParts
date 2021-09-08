<?php

namespace App\Http\Controllers\Website;

use App\Models\website\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            return redirect('index');
        }
    }
    public function edit()
    {   
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            return view('website.edit_user',compact('user'));
        } else {
            return redirect('index');
        }
    }
    public function store(Request $request)
    {
        $rules = User::rules($request);
        $request->validate($rules);
        $credentials = User::credentials($request);
        $credentials = User::create($credentials);
        session()->flash('created',__("Message Has Been Send successfully"));
        return redirect()->route("Website.Index");
    }
}
