@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/user.css') }}">
@endsection

@section('website')
<div class="container">
    <div class="main-body" style="margin-top: 80px;">
          <div class="row gutters-sm">
            <div class="col-md-9">
              <div class="mb-3 card">
                <div class="card-body">
                <!-- Form -->
                <form action="{{route('Website.SendEditUser')}}" method="POST">
                    @csrf
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('first name')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <div class="col-md-6">
                        <input value="{{ $user->first_name }}"  type="text" name="first_name">
                        </div>
                        @error('first_name')
                        <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                       @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('last name')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <div class="col-md-6">
                        <input value="{{ $user->last_name }}" type="text" name="last_name">
                        </div>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                        @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('phone')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <div class="col-md-6">
                        <input value="{{ $user->phone }}"  type="text" name="phone">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                        @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('Password')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <div class="col-md-6">
                        <input  type="password" name="password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <button class="btn btn-info" type="submit" >Save</button>
                      <a class="btn btn-danger" href="{{route('Website.ShowUser')}}">Back</a>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
            <div class="col-md-3">
                
            </div>
          </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
