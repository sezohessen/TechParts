{{-- Extends layout --}}
@extends('layout.seller')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}
    <div class="container">
        @include('SellerDashboard/message')
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-custom bg-danger gutter-b" style="height: 150px">
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
