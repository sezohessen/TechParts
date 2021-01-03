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
        <form action="{{route("news.store")}}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Category')</label>
                            <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                 id="country" name="category_id" required>
                                <option value="">@lang('--Select category first--')</option>
                                @foreach ($categories as $key=> $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >
                                        {{$category->name}} - {{ $category->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </div>
                                </div>
                            @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('News Image')</label>
                            <div class="image-input image-input-empty image-input-outline" id="Image" style="background-image: url({{ asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="Image" accept=".png, .jpg, .jpeg ,gif,svg" />
                                    <input type="hidden" name="Image_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                             @if ($errors->has('Image'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $errors->first('Image')  }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Author Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('authorName') ? 'is-invalid' : '' }}"
                             name="authorName"  placeholder="@lang('Name')"value="{{ old('description') }}" required autofocus  />
                            @if ($errors->has('authorName'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('authorName')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('Author Image')</label>
                            <div class="image-input image-input-empty image-input-outline" id="authorImg" style="background-image: url({{ asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="authorImg" accept=".png, .jpg, .jpeg ,gif,svg" />
                                    <input type="hidden" name="authorImg_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                             @if ($errors->has('authorImg'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $errors->first('authorImg')  }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Title(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                             name="title"  placeholder="@lang('title name')" value="{{ old('description') }}" required autofocus  />
                            @if ($errors->has('title'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('title')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Title(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                             name="title_ar"  placeholder="@lang('title name')" value="{{ old('title_ar') }}" required autofocus  />
                            @if ($errors->has('title_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('title_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('description')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')</label>
                            <textarea name="description_ar" class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" id="description" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('description_ar')  }}</strong>
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
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script>

"use strict";
var KTUserEdit={
    init:function(){
        new KTImageInput("Image");
        new KTImageInput("authorImg");
        }
        };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
@endsection
