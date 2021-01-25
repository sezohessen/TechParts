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
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.body.store")}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Car Body Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name"  placeholder="@lang('Car Body Name')" value="{{ old('name')}}" required autofocus  />
                            @error('name')
                                 <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('Logo image')</label><br>
                            <div class="image-input image-input-empty image-input-outline" id="logo" style="background-image: url({{asset('media/svg/logos/Logo.jpg') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg ,gif,svg"  required />
                                    <input type="hidden" name="logo_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
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
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script>
"use strict";
var KTUserEdit={
    init:function(){
        new KTImageInput("logo");
        }
        };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
@endsection
