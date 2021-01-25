{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('dashboard.users.index') }}" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-2x svg-icon-danger">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                        <i class="fa fa-user fa-3x" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-dark font-weight-bolder font-size-h3 mb-2 mt-5">{{ $users->count() }}</div>
                    <div class="font-weight-bold text-inverse-dark font-size-sm">@lang('No. of Customers')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('dashboard.bank.index') }}" class="card card-custom bg-info bg-hover-state-info card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <i class="menu-icon fas fa-synagogue fa-3x" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-info font-weight-bolder font-size-h3 mb-2 mt-5">{{ $banks->count() }}</div>
                    <div class="font-weight-bold text-inverse-info font-size-sm">@lang('No. of Banks')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('dashboard.insurance.index') }}" class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/General/Shield-check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="25" height="25"></rect>
                                <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                                <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-white font-weight-bolder font-size-h3 mb-2 mt-5">{{ $insurances->count() }}</div>
                    <div class="font-weight-bold text-inverse-white font-size-sm">@lang('No. of Insurance Companies')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('dashboard.agency.index',['center_type'=>0]) }}" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                        <i class="menu-icon fas fa-3x fa-landmark" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-danger font-weight-bolder font-size-h3 mb-2 mt-5">{{ $agencies->count() }}</div>
                    <div class="font-weight-bold text-inverse-danger font-size-sm">@lang('No. of Showrooms agencies')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('dashboard.agency.index') }}" class="card card-custom bg-success bg-hover-state-success card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                        <i class="fa fa-tools fa-3x" style="color:#ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-success font-weight-bolder font-size-h3 mb-2 mt-5">{{ $maintenance->count() }}</div>
                    <div class="font-weight-bold text-inverse-success font-size-sm">@lang('No. of Maintenance Centers')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('dashboard.agency.index') }}" class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <i class="fa fa-cogs fa-3x" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">{{ $spares->count() }}</div>
                    <div class="font-weight-bold text-inverse-primary font-size-sm">@lang('No. of Spare Parts Vendors')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('dashboard.bank-offer.index') }}">
                <div class="card card-custom bg-light-success card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-success">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-opened.svg-->
                            <i class="fa fa-tags fa-2x " style="color: #000000"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $banks_offers->count() }}</span>
                        <span class="font-weight-bold text-dark font-size-sm">@lang('No. of Offers by Banks.')</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('dashboard.insurance-offer.index') }}">
                <div class="card card-custom bg-light-danger card-stretch gutter-b">
                    <!--begin::ody-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-danger">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                            <i class="fa fa-user-shield fa-2x" style="color: #000000"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $insurances_offers->count() }}</span>
                        <span class="font-weight-bold text-dark font-size-sm">@lang('No. of Offers by Insurance Companies.')</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="">
                <div class="card card-custom bg-light-warning card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-warning">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
                                    <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">23,508</span>
                        <span class="font-weight-bold text-muted font-size-sm">23,508</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="">
                <div class="card card-custom bg-light-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-info">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">$50,000</span>
                        <span class="font-weight-bold text-muted font-size-sm">Milestone Reached</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')

@endsection
