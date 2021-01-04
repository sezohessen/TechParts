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
        <form action="{{route("country.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Country Name (ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('CountryEnglish') ? 'is-invalid' : '' }}"
                             name="CountryEnglish" value="{{ old('CountryEnglish') }}" required placeholder="@lang('Name(ENG)')"autofocus/>
                            @if ($errors->has('CountryEnglish'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please enter country name')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Country Name (AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('CountryArabic') ? 'is-invalid' : '' }}"
                             name="CountryArabic" value="{{ old('CountryArabic') }}"required placeholder="@lang('Name(AR)')"/>
                             @if ($errors->has('CountryArabic'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                     @lang('Please enter country name')
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Country Code') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('CountryCode') ? 'is-invalid' : '' }}"
                             name="CountryCode"  value="{{ old('CountryCode') }}" required placeholder="@lang('Code')"/>
                             @if ($errors->has('CountryCode'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                     @lang('Please enter code')
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('country phone') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('country_phone') ? 'is-invalid' : '' }}"
                             name="country_phone"  value="{{ old('country_phone') }}" required placeholder="@lang('country phone')"/>
                             @if ($errors->has('country_phone'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                     @lang('Please enter code')
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
@endsection
