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
        <form action="{{route("governorate.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Governorate Name(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('GovernorateEnglish') ? 'is-invalid' : '' }}"
                             name="GovernorateEnglish"  placeholder="@lang('Name(ENG)')" required autofocus  />
                            @if ($errors->has('GovernorateEnglish'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please enter governorate name')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Governorate Name (AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('GovernorateArabic') ? 'is-invalid' : '' }}"
                             name="GovernorateArabic"  placeholder="@lang('Name(AR)')" required />
                            @if ($errors->has('GovernorateArabic'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please enter governorate name')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Country')</label>
                            <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                                 id="country" name="country_id" required>
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
