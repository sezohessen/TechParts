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
            <div class="text-right">
                <a href="{{ route('dashboard.bank.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.bank.update",$bank->id)}}" method="POST" enctype="multipart/form-data">
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
                            <label>@lang('Bank Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name"  placeholder="@lang('Name(ENG)')" value="{{ old('name') ? old('name') : $bank->name}}" required autofocus  />
                            @if ($errors->has('name'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('name')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">@lang('Select User')</label>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                             <select class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                 id="kt_select2_1" name="user_id" required>
                                <option value="">@lang('--Select user--')</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}"
                                        @if ($user->id==$bank->user_id)
                                        {{ 'selected' }}
                                        @endif
                                        >{{ $user->email }}</option>
                                @endforeach
                             </select>
                            @error('user_id')
                             <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Bank order')</label>
                                    <input type="number" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}"
                                     name="order"  placeholder="@lang('Order')" value="{{ old('order') ? old('order'):$bank->order}}"  />
                                     @error('order')
                                     <div class="invalid-feedback">{{ $errors->first('order') }}</div>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color">@lang("Color Code") <span class="text-danger">*</span></label>
                                    <div class="col-md-12">
                                     <input class="form-control" type="color" name="color" value="{{ old('color') ? old('color'):$bank->color}}" id="color" required/>
                                    </div>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $errors->first('color') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Show in finance services')</label>
                                <div class="checkbox-list">
                                    <label class="checkbox">
                                        <input type="checkbox" name="show_finance_services"
                                        {{ old('show_finance_services')=="on" ? 'checked':( ($bank->show_finance_services) ? 'checked': '') }}/>
                                        @error('show_finance_services')
                                            <div class="invalid-feedback">{{ $errors->first('show_finance_services') }}</div>
                                        @enderror
                                        <span></span>
                                        @lang('Show')
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('Logo image')</label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="logo_id" style="background-image: url({{find_image($bank->img , 'img/bank/')  }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo_id" accept=".png, .jpg, .jpeg ,gif,svg" />
                                    <input type="hidden" name="logo_id_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                             @if ($errors->has('logo_id'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $errors->first('logo_id')  }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h2>@lang('Contact Information')</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Whatsapp')</label>
                                    <input type="text" class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}"
                                    name="whatsapp"  placeholder="@lang('Phone number')"  value="{{old("whatsapp") ? old("whatsapp") : $bank_contact->whatsapp}}"/>
                                    @error('whatsapp')
                                        <div class="invalid-feedback">{{ $errors->first('whatsapp') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Phone')</label>
                                    <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                    name="phone"  placeholder="@lang('Phone number')"  value="{{old("phone") ? old("phone") : $bank_contact->phone}}"/>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    name="email"  placeholder="@lang('Email')"  value="{{old("email") ? old("email") : $bank_contact->email}}"/>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2 style="color:#3699FF" >@lang('Change Status')</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('Status') <span class="text-danger">*</span></label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" name="status" value="Pending"
                                                     {{ old('status')=="Pending" ? 'checked':(($bank->status=="Pending") ? 'checked': '' ) }} required/>
                                                    <span></span>
                                                    @lang('Pending')
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="status" value="Approved"
                                                    {{ old('status')=="Approved" ? 'checked':(($bank->status=="Approved") ? 'checked': '' ) }}/>
                                                    <span></span>
                                                    @lang('Approved')
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="status" value="Canceled"
                                                    {{ old('status')=="Canceled" ? 'checked':(($bank->status=="Canceled") ? 'checked': '' ) }}/>
                                                    <span></span>
                                                    @lang('Canceled')
                                                </label>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('update')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script>
"use strict";
var KTUserEdit={
    init:function(){
        new KTImageInput("logo_id");
        }
        };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
@endsection
