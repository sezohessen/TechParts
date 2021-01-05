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
        <div class="card card-custom card-stretch" style="width: 60%;height: auto;margin: 30px auto;" id="kt_page_stretched_card">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">@lang('Privcay and policy') <small>@lang('Privcay and policy details')</small></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="card-scroll">
                    {!!$PPolicy !!}
                </div>
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>

@endsection
{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("js/pages/custom/login/login-general.js")}}"></script>
@endsection
