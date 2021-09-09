@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/user.css') }}">
@endsection

@section('website')

<!-- Profile Card -->
<!-- component -->
<div class="flex h-screen bg-gray-100 items-center justify-center">
  <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
    <div class="flex justify-center py-4">
      <div class="flex bg-purple-200 rounded-full md:p-4 p-2 border-2 border-purple-300">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
      </div>
    </div>
<form action="{{route('Website.SendEditUser')}}" method="POST">
    @csrf
    <div class="flex justify-center">
      <div class="flex">
        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Edit User ( {{ $user->first_name }} {{ $user->last_name }} )</h1>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
      <div class="grid grid-cols-1">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">First Name</label>
        <input name="first_name" value="{{$user->first_name}}" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="first name" />
        @if ($errors->has('first_name'))
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('first_name')  }}</strong>
                </div>
            </div>
        @endif
      </div>
      <div class="grid grid-cols-1">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Last Name</label>
        <input name="last_name" value="{{$user->last_name}}" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="last name" />
        @if ($errors->has('last_name'))
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('last_name')  }}</strong>
                </div>
            </div>
        @endif
      </div>
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Phone</label>
      <input name="phone" value="{{$user->phone}}" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Phone Number" />
      @if ($errors->has('phone'))
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('phone')  }}</strong>
                </div>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Password</label>
      <input name="password"  class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="password" placeholder="Password" />
      @if ($errors->has('password'))
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('password')  }}</strong>
                </div>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Confirm Password</label>
      <input name="password_confirm"  class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="password" placeholder="Confirm Password" />
      @if ($errors->has('password_confirm'))
            <div class="fv-plugins-message-container">
                <div class="fv-help-block">
                    <strong>{{ $errors->first('password confirm')  }}</strong>
                </div>
            </div>
        @endif
    </div>

    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
      <a href="{{url('user')}}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancel</a>
      <button type="submit" class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Save</button>
    </div>
    </form>
  </div>
</div>
@endsection

@section('js')

@endsection
