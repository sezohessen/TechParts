
{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')
<?php
    $lat=!empty(old("lat"))?old("lat"):'30.044352632821397';
    $lng=!empty(old("lng"))?old("lng"):'31.24011230468745';
?>
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.AgencyCar.store")}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agency_id">@lang('Select agency center') <span class="text-danger">*</span></label>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control {{ $errors->has('agency_id') ? 'is-invalid' : '' }}" id="agency_id"
                                name="agency_id" required>
                                    <option value="">@lang('--Select Agency--')</option>
                                    @foreach ($agencies as $agency)
                                        <option value="{{$agency->id}}"
                                            @if(old('agency_id') == $agency->id)
                                                {{ 'selected' }}
                                            @endif
                                            >{{$agency->name}} - {{ $agency->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('agency_id')
                                <div class="invalid-feedback">{{ $errors->first('agency_id') }}</div>
                            @enderror
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="CarMaker_id">@lang('Select car Maker') <span class="text-danger">*</span></label>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}" id="CarMaker_id"
                                name="CarMaker_id" required>
                                    <option value="">@lang('Select car Maker')</option>
                                </select>
                                @error('CarMaker_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarMaker_id') }}</div>
                                @enderror
                            </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                             <label for="model" class="col-form-label  col-sm-12">@lang('Select Car Model')
                            </label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <div class=" col-md-12">
                                    <select class="form-control {{ $errors->has('CarModel_id') ? 'is-invalid' : '' }}" id="CarModel_id"
                                    name="CarModel_id"  data-select2-id="{{old("CarModel_id")}}" >
                                        <option value=""  >@lang('Select Car Make first')</option>
                                    </select>
                                    @error('CarModel_id')
                                        <div class="invalid-feedback">{{ $errors->first('CarModel_id') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Car Year')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                             <select class="form-control select2 {{ $errors->has('CarYear_id') ? 'is-invalid' : '' }}"
                                 id="kt_select2_1" name="CarYear_id" required>
                                 <option value="">@lang('Select Car Year')</option>
                                @foreach ($years as $year)
                                    <option value="{{$year->id}}"{{ old('CarYear_id')==$year->id ? 'selected':'' }} >{{$year->year}}</option>
                                @endforeach
                             </select>
                            @error('CarYear_id')
                             <div class="invalid-feedback">{{ $errors->first('CarYear_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Manufacture')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('CarManufacture_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_2" name="CarManufacture_id" required>
                                   <option value="">@lang('Select Car Manufacture')</option>
                                   @foreach ($manufactures as $manufacture)
                                       <option value="{{$manufacture->id}}" {{ old('CarManufacture_id')==$manufacture->id ? 'selected':'' }}>{{$manufacture->name}} - {{$manufacture->name_ar}}</option>
                                   @endforeach
                                </select>
                               @error('CarManufacture_id')
                                <div class="invalid-feedback">{{ $errors->first('CarManufacture_id') }}</div>
                               @enderror
                               </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Capacity')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('CarCapacity_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_3" name="CarCapacity_id" required>
                                   <option value="">@lang('Select Car Capacity')</option>
                                   @foreach ($capacities as $capacity)
                                       <option value="{{$capacity->id}}" {{ old('CarCapacity_id')==$capacity->id ? 'selected':'' }}>{{$capacity->capacity}}</option>
                                   @endforeach
                                </select>
                               @error('CarCapacity_id')
                                <div class="invalid-feedback">{{ $errors->first('CarCapacity_id') }}</div>
                               @enderror
                               </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Price')<span class="text-danger">*</span></label>
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <input class="form-control" type="text" name="price" value="{{old("price")}}" placeholder="{{__("Price")}}" />
                                @error('price')
                                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                                    <input class="form-control" name="price_after_discount" value="{{old("price_after_discount")}}" type="text" placeholder="{{__("Discount (Optional)")}}" />
                                </div>
                                @error('price_after_discount')
                                    <div class="invalid-feedback">{{ $errors->first('price_after_discount') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Kilometers")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("kiloUsed")}}"  placeholder="{{__("Kilometers")}}" name="kiloUsed" />
                                @error('kiloUsed')
                                    <div class="invalid-feedback">{{ $errors->first('kiloUsed') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Body')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarBody_id') ? 'is-invalid' : '' }}" name="CarBody_id"  required>
                                    <option value="">@lang('Select Car Body')</option>
                                    @foreach ($bodies as $key=>$body)
                                        <option value="{{$body->id}}"
                                            data-content="
                                            <img src='{{url('img/CarBodies/'.$body->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$body->name}}</span>
                                            " {{ old('CarBody_id')==$body->id ? 'selected':'' }}>
                                        </option>
                                    @endforeach
                                </select>
                            @error('CarBody_id')
                                <div class="invalid-feedback">{{ $errors->first('CarBody_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Color')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarColor_id') ? 'is-invalid' : '' }}" name="CarColor_id"  required>
                                    <option value="">@lang('Select Color')</option>
                                    @foreach ($colors as $key=>$color)
                                        <option value="{{$color->id}}"
                                            data-content="<div class='symbol-list d-flex flex-wrap'>
                                                <div class='symbol  mr-3'  >
                                                    <span class='symbol-label font-size-h5' style='background-color:{{$color->code}}'></span>
                                                </div>
                                            </div>
                                            "  {{ old('CarColor_id')==$color->id ? 'selected':'' }}>
                                        </option>
                                    @endforeach
                                </select>
                                @error('CarColor_id')
                                     <div class="invalid-feedback">{{ $errors->first('CarColor_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Badges')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('badge_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_11" name="badge_id[]"   required multiple >
                                    @foreach ($badges as $badge)
                                       <option value="{{$badge->id}}">{{$badge->name}} - {{$badge->name_ar}}</option>
                                    @endforeach
                                </select>
                                @error('badge_id')
                                    <div class="invalid-feedback">{{ $errors->first('badge_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Extra Features')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('feature_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_12" name="feature_id[]" required multiple >
                                    @foreach ($features as $feature)
                                       <option value="{{$feature->id}}" >{{$feature->name}}- {{$feature->name_ar}}</option>
                                    @endforeach
                                </select>
                                @error('feature_id')
                                    <div class="invalid-feedback">{{ $errors->first('feature_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="exampleTextarea">@lang("Write A Description (EN)")<span class="text-danger">*</span></label>
                                <textarea   id="kt-ckeditor-1" name="Description"   required  class="{{ $errors->has('Description') ? ' is-invalid' : '' }}">
                                    {{old("Description")}}
                                </textarea>
                                @error('Description')
                                    <div class="invalid-feedback " style="display: block">{{ $errors->first('Description') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="exampleTextarea">@lang("Write A Description (AR)")<span class="text-danger">*</span></label>
                                <textarea   id="kt-ckeditor-2" name="Description_ar"   required  class="{{ $errors->has('Description_ar') ? ' is-invalid' : '' }}">
                                    {{old("Description_ar")}}
                                </textarea>
                                @error('Description_ar')
                                    <div class="invalid-feedback " style="display: block">{{ $errors->first('Description_ar') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="country" class="col-form-label  col-sm-12">@lang('Select Country')<span class="text-danger">*</span></label><br>
                                <select class="form-control {{ $errors->has('Country_id') ? 'is-invalid' : '' }}" id="country"
                                name="Country_id" >
                                    <option value="">@lang('Select Country')</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}" {{ old('Country_id')==$country->id ? 'selected':'' }}>{{$country->name}} - {{ $country->name_ar }}</option>
                                    @endforeach
                                </select>
                                @error('Country_id')
                                    <div class="invalid-feedback">{{ $errors->first('Country_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="governorate" class="col-form-label  col-sm-12">@lang('Select Governorate')<span class="text-danger">*</span>
                                </label><br>
                                <select class="form-control {{ $errors->has('Governorate_id') ? 'is-invalid' : '' }}" id="governorate"
                                name="Governorate_id" >
                                    <option value="">@lang('Select Country first')</option>
                                </select>
                                @error('Governorate_id')
                                    <div class="invalid-feedback">{{ $errors->first('Governorate_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="city" class="col-form-label  col-sm-12">@lang('Select City')<span class="text-danger">*</span>
                                </label><br>
                                    <select class="form-control {{ $errors->has('City_id') ? 'is-invalid' : '' }}" id="city"
                                    name="City_id" >
                                        <option value="">@lang('Select Governorate first')</option>
                                    </select>
                                    @error('City_id')
                                        <div class="invalid-feedback">{{ $errors->first('City_id') }}</div>
                                    @enderror
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                            <div class=" col-lg-9 col-md-9 col-sm-12">@lang("Location")<span class="text-danger">*</span></label><br>
                                <input type="hidden" value="{{old("lat") ?? $lat}}" id="lat" name="lat">
                                <input type="hidden" value="{{old("lng") ?? $lat}}" id="lng" name="lng">
                                <div class="input-group">
                                    <input type="text" class="form-control " id="address" placeholder="Search ..."/>
                                    <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="flaticon2-search text-white"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="map" class="mt-2" style="height: 240px;"></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="exampleTextarea" class="mb-10">@lang("Service History")<span class="text-danger">*</span></label>
                                <textarea   id="kt-ckeditor-3" name="ServiceHistory"   required  class="{{ $errors->has('ServiceHistory') ? ' is-invalid' : '' }}">
                                    {{old("ServiceHistory")}}
                                </textarea>
                                @error('ServiceHistory')
                                    <div class="invalid-feedback " style="display: block">{{ $errors->first('ServiceHistory') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang("Car Transmission")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="transmission" value="0"
                                        {{ old('transmission')=="0" ? 'checked':'' }} required/>
                                        <span></span>
                                          @lang('Automatic')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="transmission" value="1"
                                        {{ old('transmission')=="1" ? 'checked':'' }}/>
                                        <span></span>
                                      @lang('Manual')
                                    </label>
                                    @error('transmission')
                                         <div class="invalid-feedback">{{ $errors->first('transmission') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang("Car Status")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="isNew" value="0"
                                        {{ old('isNew')=="0" ? 'checked':'' }} required/>
                                        <span></span>
                                        @lang('New')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="isNew" value="1"
                                        {{ old('isNew')=="1" ? 'checked':'' }}/>
                                        <span></span>
                                        @lang('Used')
                                    </label>
                                    @error('isNew')
                                        <div class="invalid-feedback">{{ $errors->first('isNew') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang("Payment")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="payment" value="0"
                                        {{ old('payment')=="0" ? 'checked':'' }} required/>
                                        <span></span>
                                        @lang('Cash')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="payment" value="1"
                                        {{ old('payment')=="1" ? 'checked':'' }}/>
                                        <span></span>
                                        @lang('Installment')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="payment" value="2"
                                        {{ old('payment')=="2" ? 'checked':'' }}/>
                                        <span></span>
                                        @lang('Financing')
                                    </label>
                                    @error('payment')
                                        <div class="invalid-feedback">{{ $errors->first('payment') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang("Feul Type")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="FuelType" value="0"
                                        {{ old('FuelType')=="0" ? 'checked':'' }} required/>
                                        <span></span>
                                        @lang('Gas')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="FuelType" value="1"
                                        {{ old('FuelType')=="1" ? 'checked':'' }}/>
                                        <span></span>
                                        @lang('Petrol')
                                    </label>
                                    @error('FuelType')
                                        <div class="invalid-feedback">{{ $errors->first('FuelType') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Phone")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("phone") ?? Auth::user()->phone}}"  placeholder="{{__("Your Phone")}}" name="phone" />
                                    <span class="form-text text-muted">@lang("This is your phone number")</span>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("What's App")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("whats") ?? Auth::user()->whats_app}}"  placeholder="{{__("Your What's App")}}" name="whats" />
                                    <span class="form-text text-muted">@lang("This is your what's app number")</span>
                                @error('whats')
                                    <div class="invalid-feedback">{{ $errors->first('whats') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Accidents")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <span class="switch switch-icon">
                                    <label>
                                        <input type="hidden" name="AccidentBefore" id='AccidentBefore' value="1">
                                        <input type="checkbox" onclick="changeSwitchStatus(event.target);"  checked="checked" />
                                        <span></span>
                                    </label>
                                </span>
                                @error('AccidentBefore')
                                    <div class="invalid-feedback">{{ $errors->first('AccidentBefore') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Deposit Price")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("DepositPrice")}}"  placeholder="{{__("Deposit Price")}}" name="DepositPrice" />
                                @error('DepositPrice')
                                    <div class="invalid-feedback">{{ $errors->first('DepositPrice') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Installment Price")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("InstallmentAmount")}}"  placeholder="{{__("Installment Price")}}" name="InstallmentAmount" />
                                @error('InstallmentAmount')
                                    <div class="invalid-feedback">{{ $errors->first('InstallmentAmount') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Installment Period")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("InstallmentPeriod")}}"  placeholder="{{__("Installment Period")}}" name="InstallmentPeriod" />
                                    <span class="form-text text-muted">@lang("Number of Months")</span>
                                @error('InstallmentPeriod')
                                    <div class="invalid-feedback">{{ $errors->first('InstallmentPeriod') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Car Photos")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" class="custom-file-input" name="CarPhotos[]" id="customFile" multiple/>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @error('CarPhotos')
                                    <div class="invalid-feedback">{{ $errors->first('CarPhotos') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('create')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('styles')
<link href="{{asset('plugins/custom/uppy/uppy.bundle.css')}}" rel="stylesheet" type="text/css" />
<style>
    .invalid-feedback {
        display: block;
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src='https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key={{MapTOken()}}'></script>
<script src="{{ asset('js/locationpicker.jquery.js') }}"></script>
<script>
    $('#agency_id').on('change', function() {
        var id = this.value ;
        agency(id);
    });
    function agency(id ){
        $('#CarMaker_id').empty();
        $.ajax({
            url: '/dashboard/AgencyCar/'+id,
            success: data => {
                if(data.carMakers){
                    $('#CarMaker_id').append(`<option value="" >@lang('Select car Maker')</option>`)
                    data.carMakers.forEach(carMaker =>
                    $('#CarMaker_id').append(`<option value="${carMaker.id}">${carMaker.name}</option>`)
                    )
                }else{
                    $('#CarMaker_id').append(`<option value="">{{__("No Results")}}</option>`)
                }
            }
        });
    }
    $('#CarMaker_id').on('change', function() {
        var id = this.value ;
        model(id);
    });
    function model(id){
        $('#CarModel_id').empty();
        $.ajax({
            url: '/dashboard/car/available_model/'+id,
            success: data => {
                if(data.models){
                    data.models.forEach(model =>
                    $('#CarModel_id').append(`<option value="${model.id}" >${model.name}</option>`)
                    )
                }else{
                    $('#CarModel_id').append(`<option value="">{{__("No Results")}}</option>`)
                }
            },
        });
    }
    function governorate(id ){
        $('#governorate').empty();
        $('#city').empty();
        old_governorate="<?php echo old('Governorate_id') ?  old('Governorate_id') : ""  ?>";
        $.ajax({
            url:'/dashboard/car/available_governorate/'+id,
            success: data => {
                if(data.governorates){
                    $('#governorate').append(`<option value="" >@lang('Select Governorate')</option>`)
                    data.governorates.forEach(governorate =>
                    $('#governorate').append(`<option value="${governorate.id}" ${(old_governorate==governorate.id) ? "selected" : "" } >${governorate.title}-${governorate.title_ar}</option>`)
                    )
                }else{
                    $('#governorate').append(`<option value="">{{__("No Results")}}</option>`)
                }

            }
        });
    }
    function city(id ){
        $('#city').empty();
        old_city="<?php echo old('City_id') ?  old('City_id') : ""  ?>";
        $.ajax({
            url: '/dashboard/car/available_city/'+id,
            success: data => {
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}"  ${(old_city==city.id) ? "selected" : "" } >${city.title}-${city.title_ar}</option>`)
                    )
                }else{
                    $('#city').append(`<option value="">{{__("No Results")}}</option>`)
                }

            }
        });
    }
    $('#governorate').on('change', function() {
        var id = this.value ;
        city(id);
    });
   $('#country').on('change', function() {
        var id = this.value ;
        governorate(id)
    });
    var old_maker="<?php echo (old('CarMaker_id')) ? old('CarMaker_id') : null; ?>";
    if (old_maker != ''){
        model("<?php echo (old('CarMaker_id'))?>");
    }
    var old_country="<?php echo (old('Country_id')) ? old('Country_id') : null; ?>";
    if (old_country != ''){
        governorate("<?php echo (old('Country_id'))?>");
    }

    var old_governorate="<?php echo (old('Governorate_id')) ? old('Governorate_id') : null; ?>";
    if (old_governorate != ''){
        city("<?php echo (old('Governorate_id'))?>");
        }
    var old_agency="<?php echo (old('agency_id')) ? old('agency_id') : null; ?>";
    if (old_agency != ''){
        agency("<?php echo (old('agency_id'))?>");
    }
    $('#kt_select2_12').select2({
            tags: true,
            placeholder: "{{__('Add a feature')}}",
    });
    $('#kt_select2_2').select2({
            placeholder: "{{__('Select Car Manufacture')}}",
    });
    $('#kt_select2_3').select2({
            placeholder: "{{__('Select Car Capacity')}}",
    });

    $('#map').locationpicker({
        location: {
            latitude: {{$lat}},
            longitude:  {{$lng}}
        },
        radius: 100,
        zoom:13,
        markerIcon: "{{url('/media/svg/icons/Mششap/google-maps.png')}}",
        inputBinding: {
            latitudeInput: $('#lat'),
            longitudeInput: $('#lng'),
            locationNameInput:$("#address")
        },
        enableAutocomplete: true

    });
    function changeSwitchStatus(_this) {
        var status = $(_this).prop('checked') == true ? 1 : 0;
        $("#AccidentBefore").val(status);
    }

</script>

@endsection
