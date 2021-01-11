{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
    <link href="{{ asset('css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{ $page_title }}
            </h3>
            <div class="text-right">
                <a href="{{ route('dashboard.insurance-offer.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{ route('dashboard.insurance-offer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Insurance offer title(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" placeholder="@lang('Title(ENG)')" value="{{ old('title') }}" required
                                autofocus />
                            @error('title')
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Insurance offer title(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                                name="title_ar" placeholder="@lang('Title(AR)')" value="{{ old('title_ar') }}" required />
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $errors->first('title_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="description"
                                class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                id="kt-ckeditor-1" rows="3"
                                placeholder="@lang('Write description')">{{ old('description_ar') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')</label>
                            <textarea name="description_ar"
                                class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                id="kt-ckeditor-2" rows="3"
                                placeholder="@lang('Write description')">{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $errors->first('description_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Insurance Company Name')</label>
                            <div class="col-sm-12">
                                <select class="form-control select2 {{ $errors->has('insurance_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_1" name="insurance_id" required>
                                    <option value="">@lang('--Select Insurance--')</option>
                                    @foreach ($Insurances as $Insurance)
                                        <option value="{{ $Insurance->id }}">{{ $Insurance->name }} -
                                            {{ $Insurance->title_ar }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('insurance_id')
                                    <div class="invalid-feedback">{{ $errors->first('insurance_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('Logo image')</label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="logo"
                                style="background-image: url({{ asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg ,gif,svg" required />
                                    <input type="hidden" name="logo_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove avatar">
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
                <button type="submit" class="btn btn-primary mr-2">@lang('create')</button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/editors/ckeditor-classic.js') }}"></script>
    <script src="{{ asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        "use strict";
        var KTUserEdit = {
            init: function() {
                new KTImageInput("logo");
            }
        };
        jQuery(document).ready((function() {
            KTUserEdit.init()
        }));

    </script>
@endsection
