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
                    <div class="font-weight-bold text-inverse-dark font-size-lg">@lang('No. of Customers')</div>
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
                    <div class="font-weight-bold text-inverse-info font-size-lg">@lang('No. Sellers')</div>
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
                    <div class="font-weight-bold text-inverse-white font-size-lg">@lang('No. Parts')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('dashboard.contact.index') }}" class="card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <i class="fas fa-phone-square-alt fa-3x" style="color: #ffffff"></i>
                        <!--end::Svg Icon-->
                    </span>
                    <div class="text-inverse-primary font-weight-bolder font-size-h3 mb-2 mt-5">{{ $contacts->count() }}</div>
                    <div class="font-weight-bold text-inverse-primary font-size-lg">@lang('No. Inquiries')</div>
                </div>
                <!--end::Body-->
            </a>
        </div>

    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')

@endsection
