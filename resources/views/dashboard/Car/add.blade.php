{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.category.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Make')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}" name="CarMaker_id" id="maker" required>
                                    @foreach ($makers as $key=>$maker)
                                        <option value="{{$maker->id}}"
                                            data-content="
                                            <img src='{{url('img/CarMakers/'.$maker->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$maker->name}}</span>
                                            ">
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
                             <label for="model" class="col-form-label  col-sm-12">@lang('Select Car Model')
                            </label><br>
                             <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control {{ $errors->has('CarModel_id') ? 'is-invalid' : '' }}" id="models"
                                name="CarModel_id" >
                                    <option value="">@lang('--Select Car Make first--')</option>
                                </select>
                                @error('CarModel_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarModel_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Year')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                             <select class="form-control select2 {{ $errors->has('CarYear_id') ? 'is-invalid' : '' }}"
                                 id="kt_select2_1" name="CarYear_id" required>
                                <option value="">@lang('--Select user--')</option>
                                @foreach ($years as $year)
                                    <option value="{{$year->id}}">{{$year->year}}</option>
                                @endforeach
                             </select>
                            @error('CarYear_id')
                             <div class="invalid-feedback">{{ $errors->first('CarYear_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Price Range')</label><br>
                            <div class="col-lg-4 col-md-9 col-sm-12 validate mb-2">
                                <input id="kt_touchspin_1" type="text" class="form-control"  name="price" placeholder="{{__("From")}}"/>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                             @enderror
                            <div class="col-lg-4 col-md-9 col-sm-12 validate">
                                <input id="kt_touchspin_2" type="text" class="form-control"  name="PrePrice" placeholder="{{__("To")}}"/>
                            </div>
                            @error('PrePrice')
                                <div class="invalid-feedback">{{ $errors->first('PrePrice') }}</div>
                             @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Kilometers")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="kt_nouislider_1_input"  placeholder="Currency"/>
                                    </div>
                                    <div class="col-8">
                                        <div id="kt_nouislider_1" class="nouislider nouislider-handle-danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Body')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarBody_id') ? 'is-invalid' : '' }}" name="CarBody_id"  required>
                                    @foreach ($bodies as $key=>$body)
                                        <option value="{{$body->id}}"
                                            data-content="
                                            <img src='{{url('img/CarBodies/'.$body->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$body->name}}</span>
                                            ">
                                        </option>
                                    @endforeach
                                </select>
                            @error('CarBody_id')
                                <div class="invalid-feedback">{{ $errors->first('CarBody_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Transmission')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <input data-switch="true" type="checkbox" checked="checked" data-off-color="warning"
                                data-on-text="<img src='{{asset('media/svg/icons/Electric/manual.png')}}' width='20' height='20'> Manual"
                                data-handle-width="100" name="transmission"
                                data-off-text="<img src='{{asset('media/svg/icons/Electric/automatic.png')}}' width='20' height='20'> Automatic" data-on-color="primary"/>
                                @error('transmission')
                                    <div class="invalid-feedback">{{ $errors->first('transmission') }}</div>
                                @enderror
                            </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('Sell')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
<script>
    $('#maker').on('change', function() {
        var id = this.value ;
        $('#models').empty();
        $.ajax({
            url: '/dashboard/car/available_model/'+id,
            success: data => {
                if(data.models){
                    data.models.forEach(models =>
                    $('#models').append(`<option value="${models.id}">${models.name}</option>`)
                    )
                }else{
                    $('#models').append(`<option value="">No Results</option>`)
                }

            },

        });
    });
    $("#kt_touchspin_1 , #kt_touchspin_2  ").TouchSpin({
            min: 0,
            max: 1000000000,
            step: 1 ,
            boostat: 5,
            maxboostedstep: 10,
            buttondown_class: "btn btn-secondary bootstrap-touchspin-down",
            buttonup_class: "btn btn-secondary bootstrap-touchspin-up"
    });


</script>
@endsection
