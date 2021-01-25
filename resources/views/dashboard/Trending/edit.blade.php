{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
            <div class="text-right">
                <a href="{{ route('dashboard.trending.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.trending.update",["trending"=>$trending->id])}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="col-12">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Date')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group date" >
                                    <input type="text" class="form-control" readonly   value="{{ old("day") ?? date("m/d/Y", strtotime($trending->day)) }}" name='day' placeholder="Select date" id="kt_datepicker_1"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                @error('day')
                                    <div class="invalid-feedback">{{ $errors->first('day') }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Cars')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('car_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_12" name="car_id[]" required multiple >
                                    @foreach ($cars as $car)
                                       <option value="{{$car->id}}"
                                        {{(in_array($car->id,$car_select)) ? 'selected':""}}
                                        >ID[{{$car->id}}]: {{$car->maker->name}} -{{$car->model->name}} </option>
                                    @endforeach
                                </select>
                                @error('car_id')
                                    <div class="invalid-feedback">{{ $errors->first('car_id') }}</div>
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
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
<script>
    $('#kt_select2_12').select2({
            tags: true,
            placeholder: "{{__('Add a feature')}}",
    });
</script>
@endsection
