{{-- Extends layout --}}
@extends('layout.seller')

{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}
    <div class="container">
        @include('SellerDashboard/message')
    </div>
    <div class="row">
        @if ($seller->governorate_id==NULL)
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
               <i class="fa fa-exclamation-triangle text-white px-2"></i>  @lang('In order for you to appear on the site and for people to find you'), <a href="{{ route('seller.my_account.edit') }}">@lang('personal information')</a> @lang('must be updated.')
              </div>
        </div>
        @endif
        <div class="col-md-6">
            <div class="card card-custom bg-primary gutter-b" style="height: 150px">
                <div class="card-body">
                    <i class="fas fa-tools fa-3x text-inverse-danger font-weight-bolder"></i>
                    <div class="text-inverse-danger font-weight-bolder font-size-h2 mt-3">{{ $parts->count() }}</div>
                    <a href="{{ route('seller.part.index') }}" class="text-inverse-success font-weight-bold font-size-lg mt-1">@lang("My spare parts")</a>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')

@endsection
