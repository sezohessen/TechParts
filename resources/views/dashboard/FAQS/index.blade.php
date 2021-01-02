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
<script src="{{asset("js/pages/crud/datatables/basic/basic.js?v=7.1.8")}}"></script>
<script src="{{asset("plugins/custom/datatables/datatables.bundle.js?v=7.1.8")}}"></script>

@endsection
