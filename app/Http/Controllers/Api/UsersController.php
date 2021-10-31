<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show(User $User, Request $request)
    {
            return $User;
    }

    public function AddUser(Request $request)
    {
        // Validation
        $rules = array(
            'first_name'        => 'required|string|min:4|max:255',
            'last_name'         => 'required|string|min:4|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'phone'             => 'required|string|digits:11|unique:users',
            'whats_app'         => 'nullable|string|digits:11|unique:users,whats_app',
            'password'          => 'required|string|min:8'
        );
        $validate = Validator::make($request->all(), $rules);
        if($validate->fails())
        {
            return $validate->errors();
        }
        //Add New User
        $User = new User();
        $User->first_name = $request->first_name;
        $User->last_name  = $request->last_name;
        $User->email      = $request->email;
        $User->phone      = $request->phone;
        $User->whats_app  = $request->whats_app;

        // Password
        $UserPassword     = Hash::make($request->password);
        $User->password   = $UserPassword;

        $Result = $User->save();
        if($Result)
        {
            return ['Result' => 'Data Has been added'];
        } else {
            return ['Result' => 'Failed'];
        }
    }

    public function UpdateUser(User $User, Request $request)
    {
        $Result = $User->update([
            $User->first_name = $request->first_name,
            $User->last_name  = $request->last_name,
            $User->email      = $request->email,
            $User->phone      = $request->phone
        ]);
        if($Result)
        {
            return ['Result' => 'Data Has been Updated'];
        } else {
            return ['Result' => 'Failed'];
        }
    }

    public function DeleteUser(User $User, Request $request)
    {
        $Result = $User->delete();
        if($Result)
        {
            return ['Result' => 'Data Has been Deleted'];
        } else {
            return ['Result' => 'Failed'];
        }
    }
}
