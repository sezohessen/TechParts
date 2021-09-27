{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}"  rel="stylesheet" type="text/css"/>
<link href="{{ asset('plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" />

<style>
    .content .bootstrap-select .dropdown-menu{
        max-height: 200px!important;
    }
    .select2-container{
        min-width: 100%!important;
    }
    .invalid-feedback{
        display: block;
    }
</style>
@if (Session::get('app_locale')!='en')
    <style>
        .ck.ck-editor__editable_inline[dir=ltr]{
            text-align: right!important;
        }
    </style>
@endif
@endsection
{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
            <div class="text-right">
                <a href="{{ route('dashboard.part.index') }}" style="margin-top: 16px;" class="mr-2 btn btn-primary">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.part.store")}}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
               <!-- Part English name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Part name(ENG)')</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name"  placeholder="@lang('Name(ENG)')" value="{{ old('name')}}"  autofocus  />
                            @error('name')
                                 <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Part arabic name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Part name(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                             name="name_ar"  placeholder="@lang('Name(AR)')" value="{{ old('name_ar')}}" required autofocus  />
                            @error('name_ar')
                                 <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Part Number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Part number')</label>
                            <input type="text" class="form-control {{ $errors->has('part_number') ? 'is-invalid' : '' }}" id="part_number"
                             name="part_number"  placeholder="@lang('Part number')" value="{{ old('part_number')}}"  autofocus  />
                            @error('part_number')
                                 <div class="invalid-feedback">{{ $errors->first('part_number') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Price Number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Price')</label>
                            <input type="number" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                             name="price"  placeholder="@lang('Price')" value="{{ old('price')}}"  autofocus  />
                            @error('price')
                                 <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- in stock -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('In stock')</label>
                            <input type="number" class="form-control {{ $errors->has('in_stock') ? 'is-invalid' : '' }}"
                             name="in_stock"  placeholder="@lang('In stock')" value="{{ old('in_stock')}}"  autofocus  />
                            @error('in_stock')
                                 <div class="invalid-feedback">{{ $errors->first('in_stock') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12">@lang('Select User')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                     name="user_id" id="kt_select2_4" required >
                                    <option value="">@lang('Select Car')</option>
                                    @foreach ($sellers as $seller)
                                        <option
                                        @if (old('user_id')==$seller->user_id)
                                            {{ 'selected' }}
                                        @endif
                                        value="{{$seller->user_id}}">
                                            {{ $seller->user->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Select car -->
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('car_id') ? 'is-invalid' : '' }}"
                                     name="car_id" id="kt_select2_3" required >
                                    <option value="">@lang('Select Car')</option>
                                    @foreach ($cars as $key=>$car)
                                        <option
                                            @if (old('car_id')==$car->id)
                                                {{ 'selected' }}
                                            @endif
                                        value="{{$car->id}}">
                                        {{ $car->make->name }} - {{$car->model->name}}
                                       - {{$car->year->year}} - {{$car->capacity->capacity}}
                                        </option>
                                    @endforeach
                                </select>
                            @error('car_id')
                                <div class="invalid-feedback">{{ $errors->first('car_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Desc -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" >{{ old('desc') }}</textarea>
                            @error('desc')
                                <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Arabic Desc -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')<span class="text-danger">*</span></label>
                            <textarea name="desc_ar" class="form-control {{ $errors->has('desc_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3" required
                            placeholder="@lang('Write description')" >{{ old('desc_ar') }}</textarea>
                            @error('desc_ar')
                                <div class="invalid-feedback">{{ $errors->first('desc_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    @for ($i = 0; $i < App\Models\Part::ImgCount; $i++)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">
                                @if($i==0)@lang('Main Image') @else @lang('Part image') @endif
                                @if($i==0)<span class="text-danger">*</span> @endif
                            </label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="logo_{{ $i }}" style="background-image: url('')">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="part_img_new[]" accept=".png, .jpg, .jpeg ,gif,svg"  />
                                    <input type="hidden" name="part_img_new[]_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            @error('part_img_new.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="mr-2 btn btn-primary" id="submit-all">@lang('create')  </button>
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
            new KTImageInput("logo_0");
            new KTImageInput("logo_1");
            new KTImageInput("logo_2");
            new KTImageInput("logo_3");
            }
            };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
@endsection
