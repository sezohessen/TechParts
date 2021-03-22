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
                <a href="{{ route('dashboard.finance-request.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{ route('dashboard.finance-request.update',$request->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('User Email')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->user->email}}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('User Phone')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->user->phone }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('Are you self-Employed ?')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->self_employed ? 'Yes' : 'No' }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('Is your salary paid through Bank transfer ?')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->salary_through_bank ? 'Yes' : 'No' }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('What is your monthly salary ?')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->monthly_salary}}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('Have you ever not paid any loan ?')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->paid_loan ? 'Yes' : 'No' }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('Do you have any existing loans ?')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->existing_loans ? 'Yes -' : 'No' }} {{ $request->provide_amount }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('Do you have any existing credit cards ?')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->existing_credit ? 'Yes' : 'No' }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('Date')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->created_at->format('d/m/Y H:i') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3>@lang('bank name')</h3>
                            <i class="fa fa-arrow-right" style="color:#3699FF" ></i> <h4 style="color: #3699FF;display:inline-block">{{ $request->bank_name }}</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h2 style="color:#3699FF" >@lang('Change Status')</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Status') <span class="text-danger">*</span></label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="status" value="Pending"
                                             {{ old('status')=="Pending" ? 'checked':(($request->status=="Pending") ? 'checked': '' ) }} required/>
                                            <span></span>
                                            @lang('Pending')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="status" value="Approved"
                                            {{ old('status')=="Approved" ? 'checked':(($request->status=="Approved") ? 'checked': '' ) }}/>
                                            <span></span>
                                            @lang('Approved')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="status" value="Canceled"
                                            {{ old('status')=="Canceled" ? 'checked':(($request->status=="Canceled") ? 'checked': '' ) }}/>
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
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('update')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
