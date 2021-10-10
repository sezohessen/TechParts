
@extends('website.layouts.app')
@section('css')
<link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css"/>
<style>
.form-label{
    width: 100%;
    margin-top: 10px;
}
.form-label >div{
    display: inline-block;
    margin: 0px 5px;
}
</style>
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
                    <img src="{{find_image(App\Models\Settings::first()->logo,'img/settings/')}}"  style="height: 40px;" class="mx-auto" alt="" />
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
        <div class="pt-56 mx-auto overflow-hidden login-content flex-row-fluid d-flex flex-column justify-content-center position-relative p-7">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid ">
                <div class="login-form login-signup pt-11" style="display: block">
                    <!--begin::Form-->
                    <form class="form"  method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--begin::Title-->
                        <div class="py-10">
                            <h2 class="text-4xl font-bold text-dark font-size-h2 font-size-h1-lg pb-9">@lang('Sign Up')</h2>
                            <p class="text-muted font-weight-bold font-size-h4">@lang('Enter your details to create your account')</p>
                        </div>
                        <!--end::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <input id="first_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="@lang('first name')">
                            @error('first_name')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <input id="last_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name"  placeholder="@lang('last name')">
                            @error('last_name')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="@lang('Email')">
                            @error('email')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--end::Form group-->
                        <div class="form-group">
                            <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone"  placeholder="@lang('phone')">
                            @error('phone')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <div class="form-group">
                            <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('whats_app') is-invalid @enderror" name="whats_app" value="{{ old('whats_app') }}"  autocomplete="whats_app"  placeholder="@lang('Whats app')">
                            @error('whats_app')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                    <!--end::Form group-->
                        <div class="form-group">
                            <select id="provider" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('provider') is-invalid @enderror" name="provider" required>
                                <option value="" >@lang('--Select Acount Type--')</option>
                                <option value="seller" {{ old('provider') == 'seller' ? 'selected' : '' }}>
                                    @lang('Seller')
                                </option>
                                <option value="user" {{ old('provider') == 'user' ? 'selected' : '' }}>
                                    @lang('User')
                                </option>
                            </select>
                            @error('provider')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <div class="form-group">
                            <input id="password" type="password" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password"  placeholder="@lang('Password')">
                            <label class="form-label">
                                <input type="checkbox" onclick="myFunction()"/>
                                <span></span>
                                <div class="leading-10">
                                    @lang('Show Password')
                                </div>
                            </label>
                            @error('password')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                            <label class="form-label">
                                <input type="checkbox" name="agree" {{ old('agree') == 'on' ? 'checked' : '' }} />
                                <span></span>
                                <div class="leading-10">
                                    @lang('I Agree the ')
                                    <a href="{{ url('/terms') }}">@lang('terms and conditions')</a>.
                                </div>
                            </label>
                            @error('agree')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="pt-10 mt-10">
                            <button type="submit"  class="px-8 py-4 mx-4 my-3 btn btn-primary font-weight-bolder font-size-h6">@lang('Sign Up')</button>
                        </div>
                        <!--end::Form group-->
                    </form>
                    <!--end::Form-->
                </div>

            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                <div class="mr-10 text-dark-50 font-size-lg font-weight-bolder">
                    <span class="mr-1">2021</span>
                    <a href="{{ url('/') }}" target="_blank" class="text-dark-75 text-hover-primary">{{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}</a>
                </div>
                <div class="mr-10">
                    <a href="{{ url('/terms') }}" class="text-primary font-weight-bolder font-size-lg">@lang('Terms')</a>
                </div>
                <div class="mr-10">
                    <a href="{{ url('/PPolicy') }}" class="text-primary font-weight-bolder font-size-lg">@lang('Privcay and policy')</a>
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
@section('js')
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script src="{{asset("js/pages/custom/login/login-general.js")}}"></script>
@endsection
