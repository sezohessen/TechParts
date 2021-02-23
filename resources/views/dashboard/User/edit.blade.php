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

        <form action="{{route("dashboard.users.update",['user'=>$user->id])}}" method="POST" id="myform" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
            <div class="card-body">
               <!--begin::Form group-->
               <div class="form-group">
                <input id="first_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6
                 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? $user->first_name }}"
                 required autocomplete="first_name" autofocus placeholder="@lang('first name')">
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
                <input id="last_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror"
                name="last_name" value="{{ old('last_name')  ?? $user->last_name  }}" required autocomplete="last_name"
                 placeholder="@lang('last name')">
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
                <input id="email" type="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6
                 @error('email') is-invalid @enderror" name="email" value="{{ old('email')  ?? $user->email }}"
                 required autocomplete="email"  placeholder="@lang('Email')">
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
                        <option value="{{$country->id}}"
                            @if(old('country_id'))
                         {{   old('country_id') == $country->id ? 'selected' : ''}}
                            @else
                         {{ $selected == $country->id ? 'selected' : ''}}
                            @endif

                        >
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
                <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6
                @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone }}"
                required autocomplete="phone"  placeholder="@lang('phone')" disabled>
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
                <input id="password" type="password" value="{{ old('password')}}"
                class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror"
                 name="password" value="{{ old('password') }}" placeholder="@lang('Password')">
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

                <select id="provider" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('provider') is-invalid @enderror" name="provider" required disabled>
                    <option value="" >@lang('--Select Acount Type--')</option>
                    {{--
                    <option value="user" {{ old('provider') == 'user' ? 'selected' : '' }}>
                        @lang('new user')
                    </option>
                    --}}
                    <option value="insurance"
                    @if(old('provider'))
                    {{   old('provider') == 'insurance'? 'selected' : ''}}
                       @else
                    {{ $provider == 'insurance' ? 'selected' : ''}}
                       @endif
                    >
                        @lang('Insurance Company')
                    </option>
                    <option value="agency"
                    @if(old('provider'))
                    {{   old('provider') == 'agency'? 'selected' : ''}}
                       @else
                    {{ $provider == 'agency' ? 'selected' : ''}}
                       @endif
                    >
                        @lang('Agency')
                    </option>
                    <option value="bank"
                    @if(old('provider'))
                    {{   old('provider') == 'bank'? 'selected' : ''}}
                       @else
                    {{ $provider == 'bank' ? 'selected' : ''}}
                       @endif
                       >
                        @lang('Bank')
                    </option>
                    <option value="administrator"
                    @if(old('provider'))
                    {{   old('provider') == 'administrator'? 'selected' : ''}}
                       @else
                    {{ $provider == 'administrator' ? 'selected' : ''}}
                       @endif
                       >
                        @lang('administrator')
                    </option>
                    <option value="user"
                    @if(old('provider'))
                    {{   old('provider') == 'user'? 'selected' : ''}}
                       @else
                    {{ $provider == 'user' ? 'selected' : ''}}
                       @endif
                       >
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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Image">@lang('Logo image') <span class="text-danger">*</span></label><br>
                        <div class="image-input image-input-empty image-input-outline" id="image_id" style="background-image: url({{ (isset($user->image)) ? asset($user->image->base.$user->image->name)  :  asset('media/svg/image_ids/image_id.jpg') }})">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image_id" accept=".png, .jpg, .jpeg ,gif,svg"  />
                                <input type="hidden" name="image_id_remove" value="{{$user->image->id ?? null}}" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        @error('image_id')
                            <div class="invalid-feedback">{{ $errors->first('image_id') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('Is verified')</label>
                        <div class="checkbox-list">
                            <label class="checkbox">
                                <input type="checkbox" name="is_phone_virefied"
                                {{ old('is_phone_virefied')=="on" ? 'checked':( ($user->is_phone_virefied) ? 'checked': '') }}/>
                                @error('is_phone_virefied')
                                    <div class="invalid-is_phone_virefied">{{ $errors->first('is_phone_virefied') }}</div>
                                @enderror
                                <span></span>
                                @lang('Yes')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="agree" value="on" />
            <!--end::Form group-->

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2" wire:click="$emit('postAdded')">@lang("update") </button>
            </div>
        </form>
    </div>


@endsection

@section('scripts')
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
    <script>
        "use strict";
        var KTUserEdit={
            init:function(){
                new KTImageInput("image_id");
                }
                };jQuery(document).ready((function(){KTUserEdit.init()}));
        </script>
@endsection
