{{-- Extends layout --}}
@extends('layout.agency')

{{-- Content --}}
@section('content')
<?php
    $lat=!empty(old("lat"))?old("lat"):'30.044352632821397';
    $long=!empty(old("long"))?old("long"):'31.24011230468745';
?>
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
            <div class="text-right">
                <a href="{{ route('agency.company.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("agency.company.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Agency Name (ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required
                            name="name"  placeholder="@lang('Name(ENG)')" autofocus  value="{{old("name")}}"/>
                            @error('name')
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Agency Name (AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" required
                            name="name_ar"  placeholder="@lang('Name(AR)')" value="{{old("name_ar")}}" />
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')<span class="text-danger">*</span></label>
                            <textarea name="description_ar" class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $errors->first('description_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Center type')<span class="text-danger">*</span></label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="center_type" value="0"
                                             {{ old('center_type')=="0" ? 'checked':'' }} required/>
                                            <span></span>
                                            @lang('Agency')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="center_type" value="1"
                                            {{ old('center_type')=="1" ? 'checked':'' }}/>
                                            <span></span>
                                            @lang('Maintenance')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="center_type" value="2"
                                            {{ old('center_type')=="2" ? 'checked':'' }}/>
                                            <span></span>
                                            @lang('Spare parts')
                                        </label>
                                        @error('center_type')
                                            <div class="invalid-feedback">{{ $errors->first('center_type') }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group center_type" id="center_type0" style="display: none">
                                    <label>@lang('Center type categorization')<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('Agency center type')<span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" name="agency_type" value="1"
                                                    {{ old('agency_type')=="1" ? 'checked':'' }}/>
                                                    <span></span>
                                                    @lang('Agency')
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="agency_type" value="2"
                                                    {{ old('agency_type')=="2" ? 'checked':'' }}/>
                                                    <span></span>
                                                    @lang('Distributor')
                                                </label>
                                                @error('agency_type')
                                                    <div class="invalid-feedback">{{ $errors->first('agency_type') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group center_type" id="center_type1" style="display: none">
                                    <label>@lang('Center type categorization')<span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('Maintenance center type')<span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" name="maintenance_type" value="1"
                                                    {{ old('maintenance_type')=="1" ? 'checked':'' }}/>
                                                    <span></span>
                                                    @lang('Service center')
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="maintenance_type" value="2"
                                                    {{ old('maintenance_type')=="2" ? 'checked':'' }}/>
                                                    <span></span>
                                                    @lang('Workshop')
                                                </label>
                                                @error('maintenance_type')
                                                    <div class="invalid-feedback">{{ $errors->first('maintenance_type') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="specialty_id">@lang('Maintenance center specialties') <span class="text-danger">*</span></label>
                                            <select class="form-control select2 {{ $errors->has('specialty_id') ? 'is-invalid' : '' }}"
                                                id="kt_select2_2" name="specialty_id[]" multiple="multiple" style="width: 100%">
                                                @foreach ($specialties as $specialty)
                                                    <option value="{{$specialty->id}}">{{ $specialty->name }} - {{ $specialty->name_ar }}</option>
                                                @endforeach
                                            </select>
                                            @error('specialty_id')
                                             <div class="invalid-feedback">{{ $errors->first('specialty_id') }}</div>
                                            @enderror
                                            <span class="form-text text-muted">@lang('You can choose more than one specialty')</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('Payment Method')<span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" name="payment_method" value="0"
                                                    {{ old('payment_method')=="0" ? 'checked':'' }} required/>
                                                    <span></span>
                                                    @lang('Cash')
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="payment_method" value="1"
                                                    {{ old('payment_method')=="1" ? 'checked':'' }}/>
                                                    <span></span>
                                                    @lang('Installment')
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="payment_method" value="2"
                                                    {{ old('payment_method')=="2" ? 'checked':'' }}/>
                                                    <span></span>
                                                    @lang('Financial')
                                                </label>
                                                @error('payment_method')
                                                    <div class="invalid-feedback">{{ $errors->first('payment_method') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('Car status')<span class="text-danger">*</span></label>
                                                    <div class="radio-inline">
                                                        <label class="radio">
                                                            <input type="radio" name="car_status" value="0"
                                                            {{ old('car_status')=="0" ? 'checked':'' }} required/>
                                                            <span></span>
                                                            @lang('New')
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="car_status" value="1"
                                                            {{ old('car_status')=="1" ? 'checked':'' }}/>
                                                            <span></span>
                                                            @lang('Used')
                                                        </label>
                                                        @error('car_status')
                                                            <div class="invalid-feedback">{{ $errors->first('car_status') }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Country') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" id="country"
                            name="country_id" required>
                                <option value="">@lang('--Select country--')</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}"
                                        @if(old('country_id') == $country->id)
                                            {{ 'selected' }}
                                        @endif
                                        >{{$country->name}} - {{ $country->name_ar }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>
                            @enderror
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="governorate">@lang('Select Governorate') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('governorate_id') ? 'is-invalid' : '' }}" id="governorate"
                            name="governorate_id" required >
                                <option value="">@lang('--Select country first--')</option>
                            </select>
                            @error('governorate_id')
                                <div class="invalid-feedback">{{ $errors->first('governorate_id') }}</div>
                            @enderror
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">@lang('Select City') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" id="city"
                            name="city_id" required >
                                <option value="">@lang('--Select governorate first--')</option>
                            </select>
                            @error('city_id')
                                <div class="invalid-feedback">{{ $errors->first('city_id') }}</div>
                            @enderror
                          </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" value="{{$lat}}" id="lat" name="lat"  required>
                            <input type="hidden" value="{{$long}}" id="long" name="long" required>
                            <input type="text" class="form-control" id="address" placeholder="Search ..."/>
                            <div id="map" style="height: 300px;">
                                @error('lat')
                                <div class="invalid-feedback">{{ $errors->first('lat') }}</div>
                                @enderror
                                @error('long')
                                <div class="invalid-feedback">{{ $errors->first('long') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('Contact Information')</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Whatsapp')</label>
                                    <input type="text" class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}"
                                    name="whatsapp"  placeholder="@lang('Phone number')"   value="{{old("whatsapp")}}"/>
                                    @error('whatsapp')
                                        <div class="invalid-feedback">{{ $errors->first('whatsapp') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Facebook')</label>
                                    <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                    name="facebook"  placeholder="@lang('Link')"   value="{{old("facebook")}}"/>
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Instagram')</label>
                                    <input type="text" class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                    name="instagram"  placeholder="@lang('Link')"   value="{{old("instagram")}}"/>
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $errors->first('instagram') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Messenger')</label>
                                    <input type="text" class="form-control {{ $errors->has('messenger') ? 'is-invalid' : '' }}"
                                    name="messenger"  placeholder="@lang('Link')"   value="{{old("messenger")}}"/>
                                    @error('messenger')
                                        <div class="invalid-feedback">{{ $errors->first('messenger') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('Logo image') <span class="text-danger">*</span></label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="img_id" style="background-image: url({{asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="img_id" accept=".png, .jpg, .jpeg ,gif,svg" required >
                                    <input type="hidden" name="img_id_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            @error('img_id')
                            <div class="invalid-feedback">{{ $errors->first('img_id') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kt_select2_3">@lang('Car Maker Working in')</label>
                            <select class="form-control select2" id="kt_select2_3"
                             name="CarMaker_id[]" multiple="multiple" required>
                                @foreach ($car_makers as $car_maker)
                                    <option value="{{$car_maker->id}}">{{ $car_maker->name }}</option>
                                @endforeach
                            </select>
                            @error('CarMaker_id')
                             <div class="invalid-feedback">{{ $errors->first('CarMaker_id') }}</div>
                            @enderror
                            <span class="form-text text-muted">@lang('You can choose more than one company')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('create')</button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script>
    $('#country').on('change', function() {
        var id = this.value ;
        $('#governorate').empty();
        $.ajax({
            url: '/agency/country/'+id,
            success: data => {
                if(data.governorates){
                    data.governorates.forEach(governorate =>
                    $('#governorate').append(`<option value="${governorate.id}">${governorate.title}-${governorate.title_ar}</option>`)
                    )
                }else{
                    $('#governorate').append(`<option value="">No Results</option>`)
                }
            }
        });
    });
    $('#governorate').on('change', function() {
        var id = this.value ;
        $('#city').empty();
        $.ajax({
            url: '/agency/governorate/'+id,
            success: data => {
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}">${city.title}-${city.title_ar}</option>`)
                    )
                }else{
                    $('#city').append(`<option value="">No Results</option>`)
                }
            }
        });
    });
</script>
<script>
    "use strict";
    var KTUserEdit={
        init:function(){
            new KTImageInput("img_id");
            }
            };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
<script>
    $(document).ready(function() {
    $("input[name$='center_type']").click(function() {
        var test = $(this).val();

        $("div.center_type").hide();
        $("#center_type" + test).show();
    });
    });
</script>
@if (old('center_type') == "0")
    <script>
        $(document).ready(function() {
            $("div.center_type").hide();
            $("#center_type0").show();
        });
    </script>
    @endif
@if (old('center_type') == "1")
    <script>
        $(document).ready(function() {
            $("div.center_type").hide();
            $("#center_type1").show();
        });
    </script>
@endif
<script src='https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key={{MapTOken()}}'></script>
<script src="{{ asset('js/locationpicker.jquery.js') }}"></script>
<script>
    $('#map').locationpicker({
        location: {
            latitude: {{$lat}},
            longitude:  {{$long}}
        },
        radius: 300,
        zoom:13,
        markerIcon: "{{url('/media/svg/icons/Map/google-maps.png')}}",
        inputBinding: {
            latitudeInput: $('#lat'),
            longitudeInput: $('#long'),
            locationNameInput:$("#address")
        },
        enableAutocomplete: true

    });
</script>
@endsection
