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
        <form action="{{route("city.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('City Name (ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('CityEnglish') ? 'is-invalid' : '' }}"
                            name="CityEnglish"  placeholder="@lang('Name(ENG)')" autofocus required/>
                            @if ($errors->has('CityEnglish'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please enter city name')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('City Name (AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('CityArabic') ? 'is-invalid' : '' }}"
                            name="CityArabic"  placeholder="@lang('Name(AR)')" required/>
                            @if ($errors->has('CityArabic'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please enter city name')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Country') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" id="country"
                            name="country_id" required>
                                <option value="">@lang('--Select country first--')</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}} - {{ $country->name_ar }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country_id'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please select country')
                                    </div>
                                </div>
                            @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="governorate">@lang('Select Governorate') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('governorate') ? 'is-invalid' : '' }}" id="governorate"
                            name="governorate" required>
                                <option value="">@lang('--Select governorate first--')</option>
                            </select>
                            @if ($errors->has('governorate'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please select governorate')
                                    </div>
                                </div>
                            @endif
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
<script src="/metronic/theme/html/demo1/dist/assets/js/pages/crud/forms/validation/form-controls.js?v=7.1.8"></script>
<script>
    $('#country').on('change', function() {
        var id = this.value ;
        $('#governorate').empty();
        $.ajax({
            url: '/dashboard/country/'+id,
            success: data => {
                data.governorates.forEach(governorate =>
                    $('#governorate').append(`<option value="${governorate.id}">${governorate.title}-${governorate.title_ar}</option>`)
                )
            }
        });
    });
</script>
@endsection
