{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}"  rel="stylesheet" type="text/css"/>
@endsection
{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
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
                             name="name"  placeholder="@lang('Car Make ')" value="{{ old('name')}}" required autofocus  />
                            @error('name')
                                 <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="Image">@lang('Select Car Model')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}" name="CarMaker_id" required>
                                    @foreach ($makers as $key=>$maker)
                                        <option value="{{$maker->id}}"  data-content="<img src='{{url('img/CarMakers/'.$maker->logo->name)}}' class='img-fluid img-thumbnai'  width='40' height='40'>  {{$maker->name}}</span>">
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
@section('scripts')
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-select.js?v=7.1.8') }}"></script>
@endsection
