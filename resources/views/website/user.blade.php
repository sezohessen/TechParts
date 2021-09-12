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
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('first name')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user->first_name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('last name')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       {{ $user->last_name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('Email')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ $user->email  }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('Phone')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    {{ $user->phone  }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info" href="{{route('Website.EditUser')}}">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
