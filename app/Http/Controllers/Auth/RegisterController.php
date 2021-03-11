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
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $page_title = __('register');
        $page_description = __('register page');
        return view('auth.register',  compact('page_title', 'page_description'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (auth()->user()->hasRole('insurance')) {
            return '/insurance';
        }
        if (auth()->user()->hasRole('agency')) {
            return '/agency';
        }
        if (auth()->user()->hasRole('bank')) {
            return '/bank';
        }
        return '/user';
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
        /*return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);*/
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
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);*/
        if (isset($data['provider'])) {
            if ($data['provider'] == 'insurance') {
                $provider = 'insurance';
            }elseif ($data['provider'] == 'agency') {
                $provider = 'agency';
            }elseif ($data['provider'] == 'bank') {
                $provider = 'bank';
            }else {
                $provider = 'user';
            }
            unset($data['provider']);
        }else {
            $provider = 'user';
        }
        $user = User::create(User::credentials((object)$data));
        $user->attachRole($provider) ;
        return $user;
    }
}
