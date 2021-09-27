
@extends('website.layouts.app')
@section('css')
<link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('website')
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="bg-white login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside header-->
                <a href="{{url('/')}}" class="mb-10 text-center">
                    <img src="{{find_image(App\Models\Settings::first()->logo,'img/settings/')}}"  style="height: 70px;" class="mx-auto" alt="" />
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="text-center font-weight-bolder font-size-h4 font-size-h1-lg" style="color: #986923;">@lang('Welcome to') {{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}</h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{asset('media/svg/illustrations/login-visual-1.svg')}})"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="mx-auto mt-20 overflow-hidden login-content flex-row-fluid d-flex flex-column justify-content-center position-relative p-7">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid ">
                <div class="login-form login-signup pt-11" style="display: block">
                    <!--begin::Form-->
                    <form class="form"  method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--begin::Title-->
                        <div class="pb-8 ">
                            <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">@lang('Sign Up')</h2>
                            <p class="text-muted font-weight-bold font-size-h4">@lang('Enter your details to create your account')</p>
                        </div>
                        <!--end::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <input id="first_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="@lang('first name')">
                            @error('first_name')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
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
                                    <div class="fv-help-block">
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
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--end::Form group-->
                        <div class="form-group">
                            <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone"  placeholder="@lang('phone')">
                            @error('phone')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <div class="form-group">
                            <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('whats_app') is-invalid @enderror" name="whats_app" value="{{ old('whats_app') }}" required autocomplete="whats_app"  placeholder="@lang('Whats app')">
                            @error('whats_app')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--end::Form group-->
                        <div class="form-group ">
                            <input id="password" type="password" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password"  placeholder="@lang('Password')">
                            <label class="mt-5 checkbox">
                                <input type="checkbox" onclick="myFunction()"/>
                                <span></span>
                                <div style="width: fit-content;margin-left: 20px;" class="leading-10">
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
                        </div>

                        <!--begin::Form group-->
                        <div class="form-group fv-plugins-icon-container">
                            <label class="mb-0 checkbox">
                                <input type="checkbox" name="agree" {{ old('agree') == 'on' ? 'checked' : '' }} />
                                <span></span>
                                <div style="width: fit-content;margin-left: 20px;" class="leading-10">
                                    @lang('I Agree the ')
                                    <a href="{{ url('/terms') }}">@lang('terms and conditions')</a>.
                                </div>
                            </label>
                            @error('agree')
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="flex-wrap pb-3 form-group d-flex flex-center pb-lg-0">
                            <button type="submit"  class="px-8 py-4 mx-4 my-3 btn btn-primary font-weight-bolder font-size-h6">@lang('Submit')</button>
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
