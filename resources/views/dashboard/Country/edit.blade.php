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
                <a href="{{ route('dashboard.country.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>

        <!--begin::Form-->
        <form action="{{route("dashboard.country.update",$country->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Country Name (ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name" value="{{ old('name') ? old('name'): $country->name }}"
                            placeholder="@lang('Name(ENG)')" required autofocus/>
                            @if ($errors->has('name'))
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
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                             name="name_ar" value="{{ old('name_ar') ? old('name_ar'): $country->name_ar }}" required placeholder="@lang('Name(AR)')"/>
                             @if ($errors->has('name_ar'))
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
                            <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                             name="code"  value="{{ old('code') ? old('code'): $country->code }}" required placeholder="@lang('Code')"/>
                             @if ($errors->has('code'))
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
                             name="country_phone"  value="{{ old('country_phone') ? old('country_phone'): $country->country_phone }}" required placeholder="@lang('country phone')"/>
                             @error('country_phone')
                             <div class="invalid-feedback">{{ $errors->first('country_phone') }}</div>
                             @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('Update') </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="/metronic/theme/html/demo1/dist/assets/js/pages/crud/forms/validation/form-controls.js?v=7.1.8"></script>
@endsection
