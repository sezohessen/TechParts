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
        <form action="{{route("dashboard.settings.update",$settings->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('App Name(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('appName') ? 'is-invalid' : '' }}"
                             name="appName"  placeholder="@lang('title name')" value="{{ old('appName')? old('appName') :$settings->appName }}" required autofocus  />
                            @if ($errors->has('appName'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('appName')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('App Name(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('appName_ar') ? 'is-invalid' : '' }}"
                             name="appName_ar"  placeholder="@lang('title name')" value="{{ old('appName_ar')? old('appName_ar') :$settings->appName_ar }}" required autofocus  />
                            @if ($errors->has('appName_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('appName_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Edit setting -->
                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Email') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                             name="email"  placeholder="@lang('Enter Email')" value="{{ old('email')? old('email') :$settings->email }}"  autofocus  />
                            @if ($errors->has('email'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('appName_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Phone number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Phone') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                             name="phone"  placeholder="@lang('phone')" value="{{ old('phone')? old('phone') :$settings->phone }}"  autofocus  />
                            @if ($errors->has('phone'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('phone')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- whatsapp number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Whatsapp') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}"
                             name="Whatsapp"  placeholder="@lang('Whatsapp')" value="{{ old('whatsapp')? old('whatsapp') :$settings->whatsapp }}"  autofocus  />
                            @if ($errors->has('whatsapp'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('whatsapp')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Facebook number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Facebook') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                             name="facebook"  placeholder="@lang('Facebook')" value="{{ old('facebook')? old('facebook') :$settings->facebook }}"  autofocus  />
                            @if ($errors->has('facebook'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('facebook')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- instgram number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Instagram') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('instgram') ? 'is-invalid' : '' }}"
                             name="instgram"  placeholder="@lang('Instagram')" value="{{ old('instgram')? old('instgram') :$settings->instgram }}"  autofocus  />
                            @if ($errors->has('instgram'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('instgram')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- location number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Location') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                             name="location"  placeholder="@lang('Location')" value="{{ old('location')? old('location') :$settings->location }}"  autofocus  />
                            @if ($errors->has('location'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('facebook')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- andriod number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Andriod') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('andriod') ? 'is-invalid' : '' }}"
                             name="andriod"  placeholder="@lang('Andriod')" value="{{ old('andriod')? old('andriod') :$settings->andriod }}"  autofocus  />
                            @if ($errors->has('andriod'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('andriod')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- ios Ios -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Ios') <span class="text-danger"></span></label>
                            <input type="text" class="form-control {{ $errors->has('ios') ? 'is-invalid' : '' }}"
                             name="ios"  placeholder="@lang('Ios')" value="{{ old('ios')? old('ios') :$settings->ios }}"  autofocus  />
                            @if ($errors->has('ios'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('ios')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- End Edit Setting -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('Logo image')</label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="logo" style="background-image: url({{ $settings->logo ? find_image($settings->logo, App\Models\Settings::base) : asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg ,gif,svg" />
                                    <input type="hidden" name="logo_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                             @if ($errors->has('logo'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $errors->first('logo')  }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="mr-2 btn btn-primary">@lang('update')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="/metronic/theme/html/demo1/dist/assets/js/pages/crud/forms/validation/form-controls.js?v=7.1.8"></script>
<script>
"use strict";
var KTUserEdit={
    init:function(){
        new KTImageInput("logo");
        }
        };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
@endsection
