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
                        <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{-- {{ $banks_offers->count() }} --}}</span>
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
