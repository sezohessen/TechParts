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
                <a href="{{ route('dashboard.news.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>

        <!--begin::Form-->
        <form action="{{route("dashboard.news.update", $news->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Category') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                 id="country" name="category_id" required>
                                <option value="">@lang('--Select category first--')</option>
                                @foreach ($categories as $key=> $category)
                                    <option value="{{ $category->id }}"
                                    @if (old('category_id') == $category->id)
                                            {{ 'selected' }}
                                    @elseif($category->id==$news->category_id)
                                            {{ 'selected' }}
                                    @endif>
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
                            <label for="image_id">@lang('News Image') <span class="text-danger">*</span></label><br>
                            <div class="image-input image-input-empty image-input-outline" id="image_id" style="background-image: url({{find_image($news->img , 'img/news/') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="image_id" accept=".png, .jpg, .jpeg ,gif,svg" />
                                    <input type="hidden" name="image_id_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                             @if ($errors->has('image_id'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $errors->first('image_id')  }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Author Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('authorName') ? 'is-invalid' : '' }}"
                             name="authorName"  placeholder="@lang('Name')"value="{{ old('authorName') ?? $news->authorName }}" required   />
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
                            <label for="authorImg_id">@lang('Author Image') <span class="text-danger">*</span></label><br>
                            <div class="image-input image-input-empty image-input-outline" id="authorImg_id" style="background-image: url({{find_image($news->imgAuthor , 'img/news/') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="authorImg_id" accept=".png, .jpg, .jpeg ,gif,svg" />
                                    <input type="hidden" name="authorImg_id_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                             @if ($errors->has('authorImg_id'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $errors->first('authorImg_id')  }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Title(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                             name="title"  placeholder="@lang('title name')" value="{{ old('title') ?? $news->title }}" required   />
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
                             name="title_ar"  placeholder="@lang('title name')" value="{{ old('title_ar') ?? $news->title_ar }}" required   />
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
                            <label for="description">@lang('Description(ENG)') <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description') ?? $news->description }}</textarea>
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
                            <label for="description">@lang('Description(AR)') <span class="text-danger">*</span></label>
                            <textarea name="description_ar" class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description_ar') ?? $news->description_ar }}</textarea>
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
                <button type="submit" class="btn btn-primary mr-2">@lang('update') </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script>
    "use strict";
    var KTUserEdit={
        init:function(){
            new KTImageInput("image_id");
            new KTImageInput("authorImg_id");
            }
            };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
@endsection
