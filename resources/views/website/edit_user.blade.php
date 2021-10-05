@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/user.css') }}">
@endsection

@section('website')

<!-- Profile Card -->
<!-- component -->
<div class="flex items-center justify-center bg-gray-100 pt-72 pb-44">
  <div class="grid w-11/12 bg-white rounded-lg shadow-xl md:w-9/12 lg:w-1/2 ">
    <div class="flex justify-center py-4">
      <div class="flex p-2 bg-purple-200 border-2 border-purple-300 rounded-full md:p-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
      </div>
    </div>
<form action="{{route('Website.SendEditUser')}}" method="POST">
    @csrf
    <div class="flex justify-center">
      <div class="flex">
        <h1 class="text-xl font-bold text-gray-600 md:text-2xl">
        My Profile
        </h1>
      </div>
    </div>
    <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 md:gap-8 mx-7">
      <div class="grid grid-cols-1">
        <label class="text-3xl font-semibold text-gray-500 uppercase md:text-2xl text-light">@lang('First name')  </label>
        @if ($errors->has('first_name'))
            <div class="py-5 text-red-400 fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('first_name')  }}</strong>
                </div>
            </div>
        @endif
        <input name="first_name" value="{{$user->first_name}}" class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="first name" />
      </div>
      <div class="grid grid-cols-1">
        <label class="text-3xl font-semibold text-gray-500 uppercase md:text-2xl text-light">@lang('Last Name')</label>
        @if ($errors->has('last_name'))
            <div class="py-5 text-red-400 fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('last_name')  }}</strong>
                </div>
            </div>
        @endif
        <input name="last_name" value="{{$user->last_name}}" class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="last name" />
      </div>
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="text-3xl font-semibold text-gray-500 uppercase md:text-2xl text-light">@lang('phone')</label>
      @if ($errors->has('phone'))
            <div class="py-5 text-red-400 fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('phone')  }}</strong>
                </div>
            </div>
        @endif
      <input name="phone" value="{{$user->phone}}" class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Phone Number" />
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="text-3xl font-semibold text-gray-500 uppercase md:text-2xl text-light">@lang('Whats app')</label>
      @if ($errors->has('whats_app'))
            <div class="py-5 text-red-400 fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('whats_app')  }}</strong>
                </div>
            </div>
        @endif
      <input name="whats_app" value="{{$user->whats_app}}" class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="whats app" />
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="text-xs font-semibold text-gray-500 uppercase md:text-2xl text-light">@lang('Password')</label>
      @if ($errors->has('password'))
            <div class="py-5 text-red-400 fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('password')  }}</strong>
                </div>
            </div>
        @endif
      <input name="password"  class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="password" placeholder="@lang('Password')" />
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="text-3xl font-semibold text-gray-500 uppercase md:text-2xl text-light">@lang('Confirm Password')</label>
      @if ($errors->has('password_confirm'))
            <div class="py-5 text-red-400 fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('password_confirm')  }}</strong>
                </div>
            </div>
        @endif
      <input name="password_confirm"  class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="password" placeholder="@lang('Confirm Password')" />
    </div>

    <div class='flex items-center justify-center gap-4 pt-5 pb-5 md:gap-8'>
      <button type="submit" class='w-auto px-4 py-2 font-medium text-white bg-blue-500 rounded-lg shadow-xl hover:bg-blue-700'>@lang('Update')</button>
    </div>
    @if(session()->has('success'))
                <div class="m-4 alert alert-success ">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="m-4 alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
    </form>
  </div>
</div>
@endsection

@section('js')

@endsection
