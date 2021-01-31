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
            <a href="{{ route('dashboard.agency.index',['center_type'=> App\Models\Agency::center_type_Agency ]) }}" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b">
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
            <a href="{{ route('dashboard.agency.index',['center_type'=> App\Models\Agency::center_type_Maintenance ]) }}" class="card card-custom bg-success bg-hover-state-success card-stretch gutter-b">
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
            <a href="{{ route('dashboard.agency.index',['center_type'=> App\Models\Agency::center_type_Spare ]) }}" class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
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
            <a href="{{ route('dashboard.car.index',['Showrooms'=>'show']) }}">
                <div class="card card-custom bg-light-warning card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-warning">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                            <i class="menu-icon fas fa-2x fa-landmark" style="color: #000000"></i>
                            <i class="fas fa-car fa-2x" style="color: #000000"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $carShowrooms->count() }}</span>
                        <span class="font-weight-bold text-dark font-size-sm">@lang('No. of Cars for sale (owned by Showrooms)')</span>
                    </div>
                    <!--end::Body-->
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('dashboard.car.index',['Customers'=>'show']) }}">
                <div class="card card-custom bg-light-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-info">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                            <i class="fas fa-user fa-2x" style="color: #000000"></i>
                            <i class="fas fa-car fa-2x" style="color: #000000"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{ $carCustomers->count() }}</span>
                        <span class="font-weight-bold text-dark font-size-sm">@lang('No. of Cars for sale (owned by Customers)')</span>
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
