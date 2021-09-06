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
            <div class="text-right">
                <a href="{{ route('dashboard.year.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.year.update",['year'=>$year->id])}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Date Year of manufacture') <span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <input type="text" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}"
                                name="year"  placeholder="@lang('Date Year of manufacture')" value="{{ old('year') ?? $year->year}}" required autofocus  />
                                @error('year')
                                    <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                             <label for="model" class="col-form-label  col-sm-12">@lang('Select Car Model')<span class="text-danger">*</span>
                            </label><br>
                             <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control {{ $errors->has('CarModel_id') ? 'is-invalid' : '' }}" id="kt_select2_1"
                                name="CarModel_id"  data-select2-id="{{old("CarModel_id")}}" >
                                    @foreach ($models as $model)
                                        <option value="{{$model->id}}" {{ $year->CarModel_id==$model->id ? 'selected':'' }}>{{$model->name}}</option>
                                    @endforeach
                                </select>

                                @error('CarModel_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarModel_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('Update')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
@endsection
