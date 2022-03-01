<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UsersResource;
>>>>>>> api-doc
use Illuminate\Support\Facades\Hash;
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
            'password'          => 'required|string|min:4|max:100|',
            'provider'          => 'required'
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
                if ($request['provider'] == 'seller') {
                    $provider = 'seller';
                } else {
                $provider = 'user';
                }
                // Give Role
            $user->attachRole($provider);
            if($user->hasRole(User::SellerRole)){
                $isExist    = Seller::where('user_id',$user->id)->first();
                if(!$isExist)DB::table('sellers')->insert([
                    'user_id'   => $user->id,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            }
            // Create token
            $token      = $user->createToken('topartToken')->plainTextToken;
            $response   = [
                'user'          => $user,
                'token'         => $token,
                'Account-Type'  => $provider
            ];

            return response($response, 201);
    }

    public function login(Request $request)
    {
         // Validation
         $rules = array(
            'email'             => 'required|string|email|max:255|',
            'password'          => 'required|string|min:4|max:100|',
            );
            $validate = Validator::make($request->all(), $rules);
            if($validate->fails())
            {
                return $validate->errors();
            }
            // Check Email
            $user = User::where('email', $request['email'])->first();
            // check password
            if(!$user)
            {
                return response([
                    'Message' => 'Wrong email'
                ], 401);
            } elseif (!Hash::check($request['password'], $user->password))
            {
                return response([
                    'Message' => 'Wrong password '
                ], 401);
            }
            // Create token
            $token      = $user->createToken('topartToken')->plainTextToken;
            $response   = [
                'user'  => $user,
                'token' => $token
            ];

            return new UsersResource($response);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'Message' => 'Logged out!',
            'P.S'    =>  'Token has been destroyed and you will have to create a new token'
        ];

    }

}
