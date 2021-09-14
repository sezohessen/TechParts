
{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{asset('plugins/custom/uppy/uppy.bundle.css')}}" rel="stylesheet" type="text/css" />
<style>
    .bootstrap-select>.dropdown-toggle.btn-light .filter-option, .bootstrap-select>.dropdown-toggle.btn-secondary .filter-option{
        text-align: initial;
    }
    .form-control,
    .select2-selection--single,
    .bootstrap-select>.dropdown-toggle.bs-placeholder.btn{
        height: 45px!important;
    }
    .invalid-feedback {
        display: block;
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
                <a href="{{ route('dashboard.car.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.car.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Make')<span class="text-danger">*</span></label><br>
                            <div class="col-md-12">
                                <select class="form-control selectpicker {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}" name="CarMaker_id" id="maker" required>
                                    <option value="">@lang('Select Car Make')</option>
                                    @foreach ($makers as $key=>$maker)
                                        <option value="{{$maker->id}}"
                                            data-content="
                                            <img src='{{url('img/CarMakers/'.$maker->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$maker->name}}</span>
                                            "{{ old('CarMaker_id')==$maker->id ? 'selected':'' }}>
                                        </option>
                                    @endforeach
                                </select>
                            @error('CarMaker_id')
                                <div class="invalid-feedback">{{ $errors->first('CarMaker_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                             <label for="model" class="col-form-label  col-sm-12">@lang('Select Car Model')<span class="text-danger">*</span>
                            </label><br>
                             <div class="col-md-12">
                                <select class="form-control {{ $errors->has('CarModel_id') ? 'is-invalid' : '' }}" id="models"
                                name="CarModel_id"  data-select2-id="{{old("CarModel_id")}}" >
                                    <option value=""  >@lang('Select Car Make first')</option>
                                </select>
                                @error('CarModel_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarModel_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Car Year')<span class="text-danger">*</span></label><br>
                            <div class="col-md-12">
                             <select class="form-control {{ $errors->has('CarYear_id') ? 'is-invalid' : '' }}"
                                 name="CarYear_id" required id='year'>
                                 <option value="">@lang('Select Car Model First')</option>
                             </select>
                            @error('CarYear_id')
                             <div class="invalid-feedback">{{ $errors->first('CarYear_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Capacity')<span class="text-danger">*</span></label><br>
                            <div class="col-md-12">
                                <select class="form-control select2 {{ $errors->has('CarCapacity_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_3" name="CarCapacity_id" required>
                                   <option value="">@lang('Select Car Capacity')</option>
                                   @foreach ($capacities as $capacity)
                                       <option value="{{$capacity->id}}" {{ old('CarCapacity_id')==$capacity->id ? 'selected':'' }}>{{$capacity->capacity}}</option>
                                   @endforeach
                                </select>
                               @error('CarCapacity_id')
                                <div class="invalid-feedback">{{ $errors->first('CarCapacity_id') }}</div>
                               @enderror
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
<script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>

<script>
    function year(id ){
        $('#year').empty();
        old_year="<?php echo old('CarYear_id') ?  old('CarYear_id') : ""  ?>";
        $.ajax({
            url: '/dashboard/car/available_year/'+id,
            success: data => {
                if(data.years){
                    data.years.forEach(years =>
                    $('#year').append(`<option value="${years.id}" ${(old_year==years.id) ? "selected" : "" } >${years.year}</option>`)
                    )
                }else{
                    $('#year').append(`<option value="">{{__("No Results")}}</option>`)
                }

            },

        });
    }
    function model(id ){
        $('#models').empty();
        $('#year').empty();
        old_model="<?php echo old('CarModel_id') ?  old('CarModel_id') : ""  ?>";
        $.ajax({
            url: '/dashboard/car/available_model/'+id,
            success: data => {
                if(data.models){
                    $('#models').append(`<option value="" >@lang('Select Car Model')</option>`)
                    data.models.forEach(models =>
                    $('#models').append(`<option value="${models.id}" ${(old_model==models.id) ? "selected" : "" } >${models.name}</option>`)
                    )
                }else{
                    $('#models').append(`<option value="">{{__("No Results")}}</option>`)
                }

            },

        });
    }
    $('#maker').on('change', function() {
        var id = this.value ;
        model(id);
    });
    $('#models').on('change', function() {
        var id = this.value;
        year(id);
    });
    var old_maker="<?php echo (old('CarMaker_id')) ? old('CarMaker_id') : null; ?>";
    if (old_maker != ''){
        model("<?php echo (old('CarMaker_id'))?>");
    }
    var old_maker="<?php echo (old('CarModel_id')) ? old('CarModel_id') : null; ?>";
    if (old_maker != ''){
        year("<?php echo (old('CarModel_id'))?>");
    }
</script>

@endsection
