@extends('layout.front')
@section('styles')
    <link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />
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
                    <a href="{{ url('/') }}" class="text-center mb-10">
                        <img src="{{ find_image(App\Models\Settings::first()->logo, 'img/settings/') }}"
                            class="max-h-70px" alt="" />
                    </a>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                        @lang('Welcome to')
                        {{ Session::get('app_locale') == 'en' ? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}
                    </h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                    style="background-image: url({{ asset('media/svg/illustrations/two-men-having-car-accident-isolated-flat-vector-illustration-cartoon-people-looking-automobile-damage_74855-8655.jpg') }})">
                </div>
                <!--end::Aside Bottom-->
            </div>
            <div class="card card-custom card-stretch" style="width: 60%;height: auto;margin: 30px auto;"
                id="kt_page_stretched_card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">@lang('Terms And Conditions') <small>@lang('Terms Details')</small></h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-scroll">
                        {!! $term !!}
                    </div>
                    <!--begin::Content footer-->
                    <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                        <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                            <span class="mr-1">2021</span>
                            <a href="{{ url('/') }}" target="_blank"
                                class="text-dark-75 text-hover-primary">{{ Session::get('app_locale') == 'en' ? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}</a>
                        </div>
                        <div class="mr-10">
                            <a href="{{ url('/terms') }}"
                                class="text-primary font-weight-bolder font-size-lg">@lang('Terms')</a>
                        </div>
                        <div class="mr-10">
                            <a href="{{ url('/privacy-policy') }}"
                                class="text-primary font-weight-bolder font-size-lg">@lang('Privcay and policy')</a>
                        </div>
                    </div>
                    <!--end::Content footer-->
                </div>
            </div>

        </div>
        <!--end::Login-->
    </div>

@endsection
{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/custom/login/login-general.js') }}"></script>
@endsection
