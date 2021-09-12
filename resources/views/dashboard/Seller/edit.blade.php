{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}"  rel="stylesheet" type="text/css"/>
@if (Session::get('app_locale')!='en')
    <style>
        .ck.ck-editor__editable_inline[dir=ltr]{
            text-align: right!important;
        }
    </style>
@endif
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
                <a href="{{ route('dashboard.seller.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.seller.update",['seller'=>$seller])}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <!-- Arabic Desc -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')<span class="text-danger">*</span></label>
                            <textarea name="desc_ar" class="form-control {{ $errors->has('desc_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3"
                            placeholder="@lang('Write description')" >{{$seller->desc_ar}}</textarea>
                            @error('desc_ar')
                                <div class="invalid-feedback">{{ $errors->first('desc_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" >{{$seller->desc}}</textarea>
                            @error('desc')
                                <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Instagram')</label>
                            <input type="text" class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                            name="instagram"  placeholder="@lang('Link')"  value="{{old("instagram") ? old("instagram") : $seller->instagram}}"/>
                            @error('instagram')
                                <div class="invalid-feedback">{{ $errors->first('instagram') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Facebook')</label>
                            <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                            name="facebook"  placeholder="@lang('Link')"  value="{{old("facebook") ? old("facebook") : $seller->facebook}}"/>
                            @error('facebook')
                                <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="governorate">@lang('Select Governorate') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('governorate_id') ? 'is-invalid' : '' }}" id="governorate"
                            name="governorate_id" required >
                                <option value="">@lang('--Select country first--')</option>
                                @foreach ($governorates as $governorate)
                                <option value="{{$governorate->id}}"
                                    @if(old('governorate_id') == $governorate->id)
                                        {{ 'selected' }}
                                    @elseif($governorate->id==$seller->governorate_id)
                                        {{ 'selected' }}
                                    @endif
                                    >
                                    @if (Session::get('app_locale')=='en')
                                        {{ $governorate->title }}
                                    @else
                                        {{ $governorate->title_ar }}
                                    @endif
                                </option>
                                @endforeach
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Address in details') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('street') ? 'is-invalid' : '' }}"
                            name="street"  placeholder="@lang('Address')"  value="{{old("street") ? old("street") : $seller->street}}"/>
                            @error('street')
                                <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>@lang('Location') <span class="text-danger">*</span></label>
                            <input type="hidden" value="{{$lat}}" id="lat" name="lat"  required>
                            <input type="hidden" value="{{$long}}" id="long" name="long" required>
                            <input type="text" class="form-control" id="address" placeholder="@lang('Search ...')"/>
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
<script src="{{ asset('js/pages/widgets.js') }}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src='https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key={{MapTOken()}}'></script>
<script src="{{ asset('js/locationpicker.jquery.js') }}"></script>
<script>
    function governorate(id){
        console.log(id);
        old_city    ="<?php echo old('city_id') ?  old('city_id') : $seller->city_id ?>";
        $('#city').empty();
        $.ajax({
            url: '/dashboard/governorate/'+id,
            success: data => {
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}" ${(old_city==city.id) ? "selected" : "" }>${city.title} - ${city.title_ar}</option>`)
                    )
                }else{
                $('#city').append(`<option value="">@lang('Select Governorate first')</option>`)
                }
            }
        });
    }

    $('#governorate').on('change', function() {
        var id = this.value ;
        governorate(id);
    });
    governorate("<?php echo (old('governorate_id') ?? $seller->governorate_id)?>");
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
