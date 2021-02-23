<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (auth()->user()->hasRole('insurance')) {
            return '/insurance';
        }
        if (auth()->user()->hasRole('bank')) {
            return '/bank';
        }
        if (auth()->user()->hasRole('agency')) {
            return '/agency';
        }
        if (auth()->user()->hasRole('administrator') or auth()->user()->hasRole('superadministrator')) {
            return '/dashboard';
        }
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $page_title = __('login');
        $page_description = __('login page');
        return view('auth.login',  compact('page_title', 'page_description'));
    }
}
