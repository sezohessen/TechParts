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

        <form action="{{route("dashboard.users.store")}}" method="POST" id="myform" >
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
                <input id="email" type="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="@lang('Email')">
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
                @php
                    $countries = \App\Models\Country::all();
                @endphp
                <select class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                     id="country_id" name="country_id" required>
                    <option value="">@lang('--Select country--')</option>
                    @foreach ($countries as $country)
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
                <input id="password" type="password" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password"  placeholder="@lang('Password')">
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
                </select>
                @error('provider')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
            <!--end::Form group-->

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2" wire:click="$emit('postAdded')">@lang("create") </button>
            </div>
        </form>
    </div>


@endsection



