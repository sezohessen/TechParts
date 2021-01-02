{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="card card-custom ">
            @include('dashboard/message')
        <div class="row">
            <div class="my_datatable" id="kt_datatable"></div>
        </div>
    </div>


@endsection

{{-- Scripts Section --}}
@section('scripts')

@endsection
@section('styles')

@endsection
