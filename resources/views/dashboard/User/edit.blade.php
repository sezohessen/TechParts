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
                <a href="{{ route('dashboard.users.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
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
                <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6
                @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone }}"
                 autocomplete="phone"  placeholder="@lang('phone')">
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
                <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6
                @error('whats_app') is-invalid @enderror" name="whats_app" value="{{ old('whats_app') ?? $user->whats_app }}"
                 autocomplete="whats_app"  placeholder="@lang('Whatsapp')">
                @error('whats_app')
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
                <input id="password" type="password"  class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror"
                 name="password" value="{{ old('password') }}" autocomplete="password"  placeholder="@lang('Password')">
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
                    <option value="seller"
                    @if(old('provider'))
                    {{   old('provider') == 'seller'? 'selected' : ''}}
                       @else
                    {{ $provider == 'seller' ? 'selected' : ''}}
                       @endif
                    >
                        @lang('Seller')
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
@endsection
