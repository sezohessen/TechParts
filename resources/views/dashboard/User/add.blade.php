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
                <a href="{{ route('dashboard.users.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>

        <form action="{{route("dashboard.users.store")}}" method="POST" id="myform" autocomplete="off">
            @csrf
            <div class="card-body">
               <!--begin::Form group-->
               <div class="form-group">
                <input id="first_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="@lang('first name')">
                @error('first_name')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group">
                <input id="last_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name"  placeholder="@lang('last name')">
                @error('last_name')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
            <!--end::Form group-->
            <div class="form-group">
                <input id="email" type="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" autocomplete="new-password"   required placeholder="@lang('Email')">
                @error('email')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
            <!--end::Form group-->
            <!--end::Form group-->
            <div class="form-group">

                <select class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                     id="country_id" name="country_id" required>
                    <option value="">@lang('--Select country--')</option>
                    @foreach ($countries->get() as $country)
                        <option value="{{$country->id}}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{$country->code}} {{ $country->country_phone }}
                        </option>
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
            <!--end::Form group-->
            <!--end::Form group-->
            <div class="form-group">
                <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone"  placeholder="@lang('phone')">
                @error('phone')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
            <!--end::Form group-->
            <!--end::Form group-->
            <div class="form-group">
                <input id="password" type="password"   class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror"
                 name="password" value="{{ old('password') }}" autocomplete="new-password"  required placeholder="@lang('Password')">
                <label class="checkbox mt-5">
                    <input type="checkbox" onclick="myFunction()"/>
                    <span></span>
                    <div class="ml-2">
                        @lang('Show Password')
                    </div>
                </label>
                @error('password')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror

            </div>

            <!--end::Form group-->
            <div class="form-group">

                <select id="provider" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('provider') is-invalid @enderror" name="provider" required>
                    <option value="" >@lang('--Select Acount Type--')</option>
                    {{--
                    <option value="user" {{ old('provider') == 'user' ? 'selected' : '' }}>
                        @lang('new user')
                    </option>
                    --}}
                    <option value="insurance" {{ old('provider') == 'insurance' ? 'selected' : '' }}>
                        @lang('Insurance Company')
                    </option>
                    <option value="agency" {{ old('provider') == 'agency' ? 'selected' : '' }}>
                        @lang('Agency')
                    </option>
                    <option value="bank" {{ old('provider') == 'bank' ? 'selected' : '' }}>
                        @lang('Bank')
                    </option>
                    <option value="user" {{ old('provider') == 'user' ? 'selected' : '' }}>
                        @lang('User')
                    </option>
                </select>
                @error('provider')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Image">@lang('User Image') </label><br>
                    <div class="image-input image-input-empty image-input-outline" id="image_id" style="background-image: url({{ asset('media/users/blank.png') }})">
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
            <input type="hidden" name="agree" value="on" />
            <!--end::Form group-->

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2" wire:click="$emit('postAdded')">@lang("create") </button>
            </div>
        </form>
    </div>


@endsection

@section('scripts')
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script>

"use strict";
var KTUserEdit={
    init:function(){
        new KTImageInput("image_id");
        }
        };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
<script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>
@endsection
