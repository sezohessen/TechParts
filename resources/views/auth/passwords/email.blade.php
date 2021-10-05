@extends('website.layouts.app')
 @section('css')
<link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('website')
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="flex bg-white login login-1 login-signin-on flex-column flex-lg-row flex-column-fluid" id="kt_login">
        <!--begin::Aside-->
        <div class="pt-56 login-aside d-flex flex-column flex-row-auto sm:hidden" style="background-color: #65add8;">
            <!--begin::Aside Top-->
            <div id="Logo-section" class="logo-section">
                <!--begin::Aside header-->
                <a href="{{url('/')}}" class="mb-10 text-center">
                    <img src="{{find_image(App\Models\Settings::first()->logo,'img/settings/')}}" style="height: 40px;" class="mx-auto" alt="" />
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="mt-2 text-4xl font-bold text-center text-gray-200 font-size-h1-lg">@lang('Welcome to') {{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}</h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="mx-auto overflow-hidden login-content flex-row-fluid d-flex flex-column justify-content-center position-relative p-7">
            <!--begin::Content body-->
            <div class="mt-56 d-flex flex-column-fluid flex-center">
                <!--end::Signup-->
                <!--begin::Forgot-->
                <div class="login-form login-forgot" style="display: block">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('password.email') }}" class="form"  id="kt_login_forgot_form">
                        @csrf
                        <!--begin::Title-->
                        <div class="pt-5 pb-13 pt-lg-0">
                            <h3 class="py-10 text-4xl font-bold">@lang('Forgotten Password ?')</h3>
                            <p class="py-8 text-muted font-weight-bold font-size-h4">@lang('Enter your email to reset your password')</p>
                            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        </div>
                        <!--end::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">

                            <input id="email" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" type="email"  name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="@lang('Email')">

                            @error('email')
                                <span class="text-red-700 invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="flex-wrap form-group d-flex pb-lg-0">
                            <input type="submit"  class="px-8 py-4 my-3 mr-4 btn btn-primary font-weight-bolder font-size-h6" value="@lang('Submit')" />

                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Forgot-->
            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                <div class="mr-10 text-dark-50 font-size-lg font-weight-bolder">
                    <span class="block mr-1">2021</span>
                    <a href="{{ url('/') }}" target="_blank" class="text-dark-75 text-hover-primary">{{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}</a>
                    <a href="{{ url('/terms') }}" class="text-primary font-weight-bolder font-size-lg">@lang('Terms')</a>

                </div>
            </div>
            <!--end::Content footer-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>

@endsection
{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("js/pages/custom/login/login-general.js")}}"></script>
@endsection
