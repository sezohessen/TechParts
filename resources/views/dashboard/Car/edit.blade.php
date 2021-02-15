
{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')
<?php
    $lat=!empty(old("lat"))?old("lat"):$car->lat;
    $lng=!empty(old("lng"))?old("lng"):$car->lng;
?>
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.car.update",["car"=>$car->id])}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Make')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}" name="CarMaker_id" id="maker" required>
                                    <option value="">@lang('Select Car Make')</option>
                                    @foreach ($makers as $key=>$maker)
                                        <option value="{{$maker->id}}"
                                            data-content="
                                            <img src='{{url('img/CarMakers/'.$maker->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$maker->name}}</span>
                                            "
                                            @if(old('CarMaker_id') == $maker->id)
                                                {{ 'selected' }}
                                            @elseif($maker->id==$car->CarMaker_id)
                                                {{ 'selected' }}
                                            @endif >
                                        </option>
                                    @endforeach
                                </select>
                            @error('CarMaker_id')
                                <div class="invalid-feedback">{{ $errors->first('CarMaker_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                             <label for="model" class="col-form-label  col-sm-12">@lang('Select Car Model')<span class="text-danger">*</span>
                            </label><br>
                             <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control {{ $errors->has('CarModel_id') ? 'is-invalid' : '' }}" id="models"
                                name="CarModel_id"  data-select2-id="{{old("CarModel_id")}}" >
                                    <option value=""  >@lang('Select Car Make first')</option>
                                </select>

                                @error('CarModel_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarModel_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Car Year')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                             <select class="form-control {{ $errors->has('CarYear_id') ? 'is-invalid' : '' }}"
                                name="CarYear_id" required id='year'>
                                <option value="">@lang('Select Car Model First')</option>
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
                                   <option value="">@lang('--Select Car Manufacture --')</option>
                                   @foreach ($manufactures as $manufacture)
                                       <option value="{{$manufacture->id}}"
                                            @if(old('CarManufacture_id') == $manufacture->id)
                                            {{ 'selected' }}
                                            @elseif($manufacture->id==$car->CarManufacture_id)
                                            {{ 'selected' }}
                                            @endif
                                        >{{$manufacture->name}} - {{$manufacture->name_ar}}</option>
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
                                   <option value="">@lang('--Select Car Capacity --')</option>
                                   @foreach ($capacities as $capacity)
                                       <option value="{{$capacity->id}}"
                                        @if(old('CarCapacity_id') == $capacity->id)
                                        {{ 'selected' }}
                                        @elseif($capacity->id==$car->CarCapacity_id)
                                        {{ 'selected' }}
                                        @endif
                                       >{{$capacity->capacity}}</option>
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
                                <input class="form-control" type="text" name="price" value="{{old("price") ?? $car->price}}" />
                                @error('price')
                                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">%</span></div>
                                    <input class="form-control" name="price_after_discount" value="{{old("price_after_discount") ?? $car->price_after_discount}}" type="text" placeholder="{{__("Discount")}}" />
                                </div>
                                @error('price_after_discount')
                                    <div class="invalid-feedback">{{ $errors->first('price_after_discount') }}</div>
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
                                        <input type="hidden" name="AccidentBefore" id='AccidentBefore' value="{{ old("AccidentBefore") ?? $car->AccidentBefore  }} ">
                                        <input type="checkbox" onclick="changeSwitchStatus(event.target);"
                                            @if(!is_null(old("AccidentBefore")))
                                                {{old("AccidentBefore")==1 ? "checked" : ""}}
                                            @else
                                            {{ $car->AccidentBefore==1 ? 'checked' : '' }}
                                            @endif
                                            />
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
                            <label class="col-form-label  col-sm-12">@lang("Kilometers")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("kiloUsed") ?? $car->kiloUsed}}"  placeholder="{{__("Kilometers")}}" name="kiloUsed" />
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
                                    <option value="">@lang('--Select Car Body --')</option>
                                    @foreach ($bodies as $key=>$body)
                                        <option value="{{$body->id}}"
                                            data-content="
                                            <img src='{{url('img/CarBodies/'.$body->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$body->name}}</span>
                                            "
                                            @if(old('CarBody_id') == $body->id)
                                            {{ 'selected' }}
                                            @elseif($body->id==$car->CarBody_id)
                                            {{ 'selected' }}
                                            @endif
                                            >
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
                                <select class="form-control selectpicker {{ $errors->has('CarColor_id') ? 'is-invalid' : '' }}" name="CarColor_id" id="maker" required>
                                    <option value="">@lang('--Select Car Color --')</option>
                                    @foreach ($colors as $key=>$color)
                                        <option value="{{$color->id}}"
                                            data-content="<div class='symbol-list d-flex flex-wrap'>
                                                <div class='symbol  mr-3'  >
                                                    <span class='symbol-label font-size-h5' style='background-color:{{$color->code}}'></span>
                                                </div>
                                            </div>
                                            "
                                            @if(old('CarColor_id') == $color->id)
                                            {{ 'selected' }}
                                            @elseif($color->id==$car->CarColor_id)
                                            {{ 'selected' }}
                                            @endif>
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
                                       <option value="{{$badge->id}}"
                                       {{(in_array($badge->id,$car_badges)) ? 'selected':""}}
                                        >{{$badge->name}} - {{$badge->name_ar}}</option>
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
                                       <option value="{{$feature->id}}"
                                        {{(in_array($feature->id,$car_features)) ? 'selected':""}} >{{$feature->name}}- {{$feature->name_ar}}</option>
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
                                <textarea   class="form-control"  cols="6"  rows="6"  name="Description"   required  class="{{ $errors->has('Description') ? ' is-invalid' : '' }}">
                                    {{old("Description") ?? $car->Description}}
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
                                <textarea    class="form-control"  cols="6"  rows="6" name="Description_ar"   required  class="{{ $errors->has('Description_ar') ? ' is-invalid' : '' }}">
                                    {{old("Description_ar") ?? $car->Description_ar}}
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
                                    <option value="">@lang('--Select country--')</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}"
                                            @if(old('Country_id') == $country->id)
                                            {{ 'selected' }}
                                            @elseif($country->id==$car->Country_id)
                                                {{ 'selected' }}
                                            @endif
                                            >{{$country->name}} - {{ $country->name_ar }}</option>
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
                                <option value="{{ $car->id }}" selected  >
                                    {{ $car->governorate->title }} - {{ $car->governorate->title_ar }}
                                </option>
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
                                    <option value="{{ $car->id }}" selected  >
                                        {{ $car->city->title }} - {{ $car->city->title_ar }}
                                    </option>
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
                                    <input type="hidden" value="{{$lat}}" id="lat" name="lat">
                                    <input type="hidden" value="{{$lng}}" id="lng" name="lng">
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
                                    {{old("ServiceHistory") ?? $car->ServiceHistory}}
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
                                         @if( old('transmission') == "0" )  checked @elseif($car->transmission == 0)  checked @else  @endif
                                        required/>
                                        <span></span>
                                       @lang('Automatic')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="transmission" value="1"
                                        @if( old('transmission') == "1" )  checked @elseif($car->transmission == 1)  checked @else  @endif
                                        />
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
                                        {{ old('isNew')=="0" ? 'checked':(($car->isNew==0) ? 'checked': '' ) }} required/>
                                        <span></span>
                                        @lang('New')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="isNew" value="1"
                                        {{ old('isNew')=="1" ? 'checked':(($car->isNew==1) ? 'checked': '' ) }}/>
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
                                        {{ old('payment')=="0" ? 'checked':(($car->payment==0) ? 'checked': '' ) }} required/>
                                        <span></span>
                                        @lang('Cash')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="payment" value="1"
                                        {{ old('payment')=="1" ? 'checked':(($car->payment==1) ? 'checked': '' ) }} />
                                        <span></span>
                                        @lang('Installment')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="payment" value="2"
                                        {{ old('payment')=="2" ? 'checked':(($car->payment==2) ? 'checked': '' ) }}/>
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
                                        @if(!is_null(old('FuelType')))
                                            {{old("FuelType")==0 ? "checked" : ""}}
                                        @else
                                            {{$car->FuelType==0 ? "checked" : ""}}
                                        @endif
                                        required/>
                                        <span></span>
                                        @lang('Gas')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="FuelType" value="1"
                                        @if(!is_null(old('FuelType')))
                                            {{old("FuelType")==1 ? "checked" : ""}}
                                        @else
                                            {{$car->FuelType==1 ? "checked" : ""}}
                                        @endif
                                        >
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
                            <label class="col-form-label  col-sm-12">@lang("Deposit Price")<span class="text-danger">*</span></label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("DepositPrice") ?? $car->DepositPrice}}"  placeholder="{{__("Deposit Price")}}" name="DepositPrice" />
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
                                    <input class="form-control" type="text" value="{{old("InstallmentAmount") ? old("InstallmentAmount"): $car->InstallmentAmount }}"  placeholder="{{__("Installment Price")}}" name="InstallmentAmount" />
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
                                    <input class="form-control" type="text" value="{{old("InstallmentPeriod") ?? $car->InstallmentPeriod}}"  placeholder="{{__("Installment Period")}}" name="InstallmentPeriod" />
                                    <span class="form-text text-muted">@lang("Number of Months")</span>
                                    @error('InstallmentPeriod')
                                    <div class="invalid-feedback">{{ $errors->first('InstallmentPeriod') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Car Photos")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" class="custom-file-input" name="CarPhotos[]" id="customFile" multiple/>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @error('CarPhotos')
                                    <div class="invalid-feedback">{{ $errors->first('CarPhotos') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($images as $key=>$item)
                                        <div class="carousel-item {{$key==0 ? 'active' :''}}">
                                            <img class="d-block w-100 img-thumbnail " src="{{asset("img/Cars/$item->name")}}"  style="width:1000px !important;height:400px" alt="First slide">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-2">

                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('Edit')  </button>
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
<script src="{{"https://maps.googleapis.com/maps/api/js?".MapTOken()}}"></script>
<script src="{{ asset('js/locationpicker.jquery.js') }}"></script>

<script>
    function year(id ){
        $('#year').empty();
        old_year="<?php echo old('CarYear_id') ?  old('CarYear_id') : $car->CarYear_id  ?>";
        $.ajax({
            url: '/dashboard/car/available_year/'+id,
            success: data => {
                if(data.years){
                    data.years.forEach(years =>
                    $('#year').append(`<option value="${years.id}" ${(old_year==years.id) ? "selected" : "" } >${years.year}</option>`)
                    )
                }else{
                    $('#year').append(`<option value="">{{__("No Results")}}</option>`)
                }

            },

        });
    }
    function model(id ){
        $('#models').empty();
        $('#year').empty();
        old_model="<?php echo old('CarModel_id') ?  old('CarModel_id') :  $car->CarModel_id  ?>";
        $.ajax({
            url: '/dashboard/car/available_model/'+id,
            success: data => {
                if(data.models){
                    $('#models').append(`<option value="" >@lang('Select Car Model')</option>`)
                    data.models.forEach(models =>
                    $('#models').append(`<option value="${models.id}" ${(old_model==models.id) ? "selected" : "" } >${models.name}</option>`)
                    )
                }else{
                    $('#models').append(`<option value="">{{__("No Results")}}</option>`)
                }

            },

        });
    }
    function governorate(id ){
        $('#governorate').empty();
        $('#city').empty();
        old_governorate="<?php echo old('Governorate_id') ?  old('Governorate_id') :  $car->Governorate_id   ?>";
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
        old_city="<?php echo old('City_id') ?  old('City_id') : $car->City_id  ?>";
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
    $('#maker').on('change', function() {
        var id = this.value ;
        model(id);
    });
    $('#models').on('change', function() {
        var id = this.value ;
        year(id);
    });
    model("<?php echo (old('CarMaker_id') ?? $car->CarMaker_id)?>");
    year("<?php echo (old('CarModel_id') ?? $car->CarModel_id)?>");
    governorate("<?php echo (old('Country_id') ?? $car->Country_id) ?>");
    city("<?php echo (old('Governorate_id')  ?? $car->Governorate_id) ?>");

    $('#kt_select2_12').select2({
            tags: true,
            placeholder: "Add a feature",
    });
    $('#kt_select2_2').select2({

    });
    $('#kt_select2_3').select2({
    });

    $('#map').locationpicker({
        location: {
            latitude: {{$lat}},
            longitude:  {{$lng}}
        },
        radius: 100,
        zoom:13,
        markerIcon: "{{url('/media/svg/icons/Map/google-maps.png')}}",
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
