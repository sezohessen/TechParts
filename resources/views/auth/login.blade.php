@extends('layout.front')
@section('styles')
<link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside header-->
                <a href="{{url('/')}}" class="text-center mb-10">
                    <img src="{{asset("media/logos/logo-letter-1.png")}}" class="max-h-70px" alt="" />
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">{{ config('app.name') }} @lang('Web Site')</h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{asset('media/svg/illustrations/login-visual-1.svg')}})"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center">
                @guest
                <!--begin::Signin-->
                <div class="login-form login-signin" >
                    <!--begin::Form-->
                    <!--begin::Title-->
                    <div class="pb-13 pt-lg-0 pt-5">
                        <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">{{ __('Welcome to ') }}{{ config('app.name') }}</h3>
                        <span class="text-muted font-weight-bold font-size-h4">{{ __('New Here?') }}
                        <a href="{{ url('/register') }}" id="kt_login_signup" class="text-primary font-weight-bolder">{{ __('Create an Account') }}</a></span>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="form" id="kt_login_signin_form" >
                        @csrf
                        <div class="form-group">
                            <label for="email" class="font-size-h6 font-weight-bolder text-dark">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >

                            @error('email')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label for="password" class="font-size-h6 font-weight-bolder text-dark pt-5">{{ __('Password') }}</label>
                                <a href="{{ route('password.request') }}"class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot"> {{ __('Forgot Your Password?') }}</a>
                            </div>
                            <input id="password" type="password" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required  >
                            @error('password')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="pb-lg-0 pb-5">

                            <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                {{ __('Login') }}
                            </button>
                            <div class="form-check" style="display: inline-block;">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
                @else
                    <div class="card">

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">{{ __('Welcome to ') }}{{ config('app.name') }}</h3>
                        </div>
                    </div>
                @endguest
            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                    <span class="mr-1">2021©</span>
                    <a href="{{ url('/') }}" target="_blank" class="text-dark-75 text-hover-primary">{{ config('app.name') }}</a>
                </div>
                <a href="{{ url('/terms') }}" class="text-primary font-weight-bolder font-size-lg">@lang('Terms')</a>
            </div>
            <!--end::Content footer-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>

@endsection


