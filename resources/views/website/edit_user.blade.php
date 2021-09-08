@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/user.css') }}">
@endsection

@section('website')
<div class="container">
    <div class="main-body" style="margin-top: 80px;">
          <div class="row gutters-sm">
            <div class="col-md-12">
              <div class="mb-3 card">
                <div class="card-body">
                <!-- Form -->
                <form action="{{route('Website.SendEditUser')}}" method="POST">
                    @csrf
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input value="{{ $user->first_name }}"  type="text" name="first_name">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                       @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input value="{{ $user->last_name }}" type="text" name="last_name">
                        @error('last_name')
                            <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                        @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                      <span style="font-size: 13px;color:#fc5555"> You can't change your email </span>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input disabled value="{{ $user->email }}"  type="text" name="email">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input value="{{ $user->phone }}"  type="text" name="phone">
                        @error('phone')
                            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                        @enderror
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input  type="password" name="password">
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
          </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
