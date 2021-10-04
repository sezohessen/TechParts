<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        return RouteServiceProvider::HOME;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'min:4' ,'max:20'],
            'last_name' => ['required', 'string', 'min:4' ,'max:20'],
            'email' => ['required', 'string', 'email', 'min:8' , 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string','digits:11', 'unique:users'],
            'whats_app' => ['nullable', 'string','digits:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:30'],
            'agree' => ['accepted'],
        ]);
        return Validator::make($data, User::rules());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
     protected function create($data)
    {

        $provider = 'user';
        $user = User::create(User::credentials((object)$data));
        $user->attachRole($provider) ;
        return $user;

    }
}
