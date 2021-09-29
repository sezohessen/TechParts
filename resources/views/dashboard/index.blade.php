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
            <a href="{{ route('dashboard.seller.index') }}" class="card card-custom bg-info bg-hover-state-info card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <i class="fas fa-users-cog fa-3x" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-info font-weight-bolder font-size-h3 mb-2 mt-5">{{ $sellers->count() }}</div>
                    <div class="font-weight-bold text-inverse-info font-size-sm">@lang('No. Sellers')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('dashboard.part.index') }}" class="card card-custom card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-info svg-icon-3x ml-n1">
                        <i class="fas fas fa-tools fa-3x" style="color: #000000"></i>
                    </span>
                    <div class="text-inverse-white font-weight-bolder font-size-h3 mb-2 mt-5">{{ $parts->count() }}</div>
                    <div class="font-weight-bold text-inverse-white font-size-sm">@lang('No. Parts')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{-- {{ route('dashboard.agency.index',['center_type'=> App\Models\Agency::center_type_Agency ]) }} --}}" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                        <i class="menu-icon fas fa-3x fa-landmark" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-danger font-weight-bolder font-size-h3 mb-2 mt-5">N/A</div>
                    <div class="font-weight-bold text-inverse-danger font-size-sm">@lang('No. of Showrooms agencies')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{-- {{ route('dashboard.agency.index',['center_type'=> App\Models\Agency::center_type_Maintenance ]) }} --}}" class="card card-custom bg-success bg-hover-state-success card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                        <i class="fa fa-tools fa-3x" style="color:#ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-success font-weight-bolder font-size-h3 mb-2 mt-5">N/A</div>
                    <div class="font-weight-bold text-inverse-success font-size-sm">@lang('No. of Maintenance Centers')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{-- {{ route('dashboard.agency.index',['center_type'=> App\Models\Agency::center_type_Spare ]) }} --}}" class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <i class="fa fa-cogs fa-3x" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">N/A</div>
                    <div class="font-weight-bold text-inverse-primary font-size-sm">@lang('No. of Spare Parts Vendors')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{-- {{ route('dashboard.bank-offer.index') }} --}}">
                <div class="card card-custom bg-light-success card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-success">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-opened.svg-->
                            <i class="fa fa-tags fa-2x " style="color: #000000"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">N/A</span>
                        <span class="font-weight-bold text-dark font-size-sm">@lang('No. of Offers by Banks.')</span>
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
