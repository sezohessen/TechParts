<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
         // Validation
         $rules = array(
            'first_name'        => 'required|string|min:4|max:255',
            'last_name'         => 'required|string|min:4|max:255',
            'email'             => 'required|string|email|max:255|unique:users,email',
            'password'          => 'required|string|min:4|max:100|confirmed',
            );
            $validate = Validator::make($request->all(), $rules);
            if($validate->fails())
            {
                return $validate->errors();
            }
            // Create user
            $user = User::create([
                'first_name'     => $request['first_name'],
                'last_name'      => $request['last_name'],
                'email'          => $request['email'],
                'password'       => bcrypt($request['password'])
            ]);
            // Create token
            $token      = $user->createToken('topartToken')->plainTextToken;
            $response   = [
                'user'  => $user,
                'token' => $token
            ];

            return response($response, 201);
    }
}
