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
        <div class="pt-56 p-7">
            <!--begin::Content body-->
        <div class="card">
            <div class="description">
                <div class="my-10 card-header">
                    <div class="card-title">
                        <h3 class="pb-10 text-4xl border-b-4 border-dashed card-label drop-shadow-2xl">@lang('Privcay and policy') <small>@lang('Privcay and policy details')</small></h3>
                    </div>
                </div>
            <div class="card-body">
                <div class="mt-10 card-scroll">
                    {!!$PPolicy !!}
                </div>
            </div>
                <!--begin::Content footer-->
            <div class="mt-96 d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
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

        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
        <!--end::Content-->
</div>
<!--end::Login-->
</div>

@endsection


