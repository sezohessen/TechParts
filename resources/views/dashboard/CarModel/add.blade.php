{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}"  rel="stylesheet" type="text/css"/>
<style>
    .bootstrap-select>.dropdown-toggle.btn-light .filter-option, .bootstrap-select>.dropdown-toggle.btn-secondary .filter-option{
        text-align: initial;
    }
    .form-control,
    .select2-selection--single,
    .bootstrap-select>.dropdown-toggle.bs-placeholder.btn{
        height: 45px;
    }
    .img-thumbnail{
        height: 25px;
        width: 50px;
        margin: 0px 5px;
    }
</style>
@endsection
{{-- Content --}}
@section('content')
    <div class="container">
        @include('dashboard/message')
    </div>
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
            <div class="text-right">
                <a href="{{ route('dashboard.model.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.model.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Car Model Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name"  placeholder="@lang('Type name')" value="{{ old('name')}}" required autofocus  />
                            @error('name')
                                 <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="Image">@lang('Select company name') <span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}"
                                     name="CarMaker_id" required data-select2-id="{{old("CarModel_id")}}">
                                    @foreach ($makers as $key=>$maker)
                                        <option value="{{$maker->id}}"
                                        data-content="<img src='{{url('img/CarMakers/'.$maker->logo->name)}}' class='img-thumbnail ml-5 mr-5'  width='30' height='30' >{{ $maker->name }}">
                                        </option>
                                    @endforeach
                                </select>
                                @error('CarMaker_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarMaker_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('create')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}

