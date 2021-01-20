
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
        <form action="{{route("dashboard.car.store")}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Make')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}" name="CarMaker_id" id="maker" required>
                                    <option value="">@lang('--Select Car Make --')</option>
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
                             <label for="model" class="col-form-label  col-sm-12">@lang('Select Car Model')
                            </label><br>
                             <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control {{ $errors->has('CarModel_id') ? 'is-invalid' : '' }}" id="models"
                                name="CarModel_id"  data-select2-id="{{old("CarModel_id")}}" >
                                    <option value=""  >@lang('--Select Car Make first--')</option>
                                </select>

                                @error('CarModel_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarModel_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Year')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                             <select class="form-control select2 {{ $errors->has('CarYear_id') ? 'is-invalid' : '' }}"
                                 id="kt_select2_1" name="CarYear_id" required>
                                <option value="">@lang('--Select user--')</option>
                                @foreach ($years as $year)
                                    <option value="{{$year->id}}"
                                        @if(old('CarYear_id') == $year->id)
                                            {{ 'selected' }}
                                        @elseif($year->id==$car->CarYear_id)
                                            {{ 'selected' }}
                                        @endif
                                        >{{$year->year}}</option>
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
                            <label class="col-form-label col-sm-12">@lang('Select Car Manufacture')</label><br>
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
                            <label class="col-form-label col-sm-12">@lang('Select Car Capacity')</label><br>
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
                            <label class="col-form-label  col-sm-12">@lang('Price ')</label>
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
                            <label class="col-form-label  col-sm-12">@lang("Accidents")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <span class="switch switch-icon">
                                    <label>
                                        <input type="hidden" name="AccidentBefore" id='AccidentBefore' value="{{ old("AccidentBefore") ?? $car->AccidentBefore  }} ">
                                        <input type="checkbox" onclick="changeSwitchStatus(event.target);"  {{ $car->AccidentBefore==1 ? 'checked' : '' }}  />
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
                            <label class="col-form-label  col-sm-12">@lang("Kilometers")</label><br>
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
                            <label class="col-form-label col-sm-12">@lang('Select Car Body')</label><br>
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
                            <label class="col-form-label col-sm-12">@lang('Select Color')</label><br>
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
                            <label class="col-form-label col-sm-12">@lang('Badges')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('badge_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_11" name="badge_id[]"   required multiple >
                                    @php
                                        $c=0;
                                        $count=count(old('feature_id') ?? array());
                                    @endphp
                                   @foreach ($badges as $badge)
                                       <option value="{{$badge->id}}" >{{$badge->name}} - {{$badge->name_ar}}</option>
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
                            <label class="col-form-label col-sm-12">@lang('Extra Features')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('feature_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_12" name="feature_id[]" required multiple >
                                   @foreach ($features as $feature)
                                       <option value="{{$feature->id}}">{{$feature->name}}- {{$feature->name_ar}}</option>
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
                                <label for="exampleTextarea">@lang("Write A Description (EN)")</label>
                                <textarea   id="kt-ckeditor-1" name="Description"   required  class="{{ $errors->has('Description') ? ' is-invalid' : '' }}">
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
                                <label for="exampleTextarea">@lang("Write A Description (AR)")</label>
                                <textarea   id="kt-ckeditor-2" name="Description_ar"   required  class="{{ $errors->has('Description_ar') ? ' is-invalid' : '' }}">
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
                                <label for="country" class="col-form-label  col-sm-12">@lang('Select Country ')</label><br>
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
                                <label for="governorate" class="col-form-label  col-sm-12">@lang('Select Governorate ')
                                </label><br>
                                <select class="form-control {{ $errors->has('Governorate_id') ? 'is-invalid' : '' }}" id="governorate"
                                name="Governorate_id" >
                                <option value="{{ $car->Governorate_id }}" selected  >
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
                                <label for="city" class="col-form-label  col-sm-12">@lang('Select City')
                                </label><br>
                                    <select class="form-control {{ $errors->has('City_id') ? 'is-invalid' : '' }}" id="city"
                                    name="City_id" >
                                    <option value="{{ $car->City_id }}" selected  >
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
                            <div class=" col-lg-9 col-md-9 col-sm-12">@lang("Location")</label><br>
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
                                <label for="exampleTextarea" class="mb-10">@lang("Service History")</label>
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
                            <label class="col-form-label  col-sm-12">@lang("Car Transmission")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="transmission" value="0"
                                        {{ old('transmission')=="0" ? 'checked':(($car->transmission==0) ? 'checked': '' ) }}
                                        required/>
                                        <span></span>
                                        <img src='{{asset('media/svg/icons/Electric/automatic.png')}}' width='20' height='20'>  @lang('Automatic')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="transmission" value="1"
                                            c  />
                                        <span></span>
                                        <img src='{{asset('media/svg/icons/Electric/manual.png')}}' width='20' height='20'> &nbsp; @lang('Manual')
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
                            <label class="col-form-label  col-sm-12">@lang("Car Status")</label><br>
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
                            <label class="col-form-label  col-sm-12">@lang("Seller type")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="SellerType" value="0"
                                        {{ old('SellerType')=="0" ? 'checked':(($car->SellerType==0) ? 'checked': '' ) }} required/>
                                        <span></span>
                                        @lang('Agency')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="SellerType" value="1"
                                        {{ old('SellerType')=="1" ? 'checked':(($car->SellerType==1) ? 'checked': '' ) }}/>
                                        <span></span>
                                        @lang('Distributor')
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="SellerType" value="2"
                                        {{ old('SellerType')=="2" ? 'checked':(($car->SellerType==2) ? 'checked': '' ) }}/>
                                        <span></span>
                                        @lang('Individual')
                                    </label>
                                    @error('SellerType')
                                        <div class="invalid-feedback">{{ $errors->first('SellerType') }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang("Payment")</label><br>
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
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Phone")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("phone") ?? Auth::user()->phone}}"  placeholder="{{__("Your Phone")}}" name="phone" />
                                    <span class="form-text text-muted">@lang("This is your phone number ")</span>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Deposit Price")</label><br>
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
                            <label class="col-form-label  col-sm-12">@lang("Installment Price")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("InstallmentPrice") ?? $car->InstallmentPrice}}"  placeholder="{{__("Installment Price")}}" name="InstallmentPrice" />
                                @error('InstallmentPrice')
                                    <div class="invalid-feedback">{{ $errors->first('InstallmentPrice') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-form-label  col-sm-12">@lang("Installment Month")</label><br>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                    <input class="form-control" type="text" value="{{old("InstallmentMonth") ?? $car->InstallmentMonth}}"  placeholder="{{__("Installment Month")}}" name="InstallmentMonth" />
                                    <span class="form-text text-muted">@lang("Type numeric numbers only")</span>
                                    @error('InstallmentMonth')
                                    <div class="invalid-feedback">{{ $errors->first('InstallmentMonth') }}</div>
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
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($images as $key=>$item)
                                        <div class="carousel-item {{$key==0 ? 'active' :''}}">
                                            <img class="d-block w-100 img-thumbnail " src="{{asset("img/Cars/$item->name")}}"  style="width:500px !important" alt="First slide">
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
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('Sell')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('styles')
<link href="{{asset('plugins/custom/uppy/uppy.bundle.css')}}" rel="stylesheet" type="text/css" />
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
    function model(id ){
        $('#models').empty();
        old_model="<?php echo old('CarModel_id') ?  old('CarModel_id') : ""  ?>";
        $.ajax({
            url: '/dashboard/car/available_model/'+id,
            success: data => {
                if(data.models){
                    data.models.forEach(models =>
                    $('#models').append(`<option value="${models.id}" ${(old_model==models.id) ? "selected" : "" } >${models.name}</option>`)
                    )
                }else{
                    $('#models').append(`<option value="">No Results</option>`)
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
                    $('#governorate').append(`<option value="" >@lang('--Select Governorate--')</option>`)
                    data.governorates.forEach(governorate =>
                    $('#governorate').append(`<option value="${governorate.id}" ${(old_governorate==governorate.id) ? "selected" : "" } >${governorate.title}-${governorate.title_ar}</option>`)
                    )
                }else{
                    $('#governorate').append(`<option value="">No Results</option>`)
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
                    $('#city').append(`<option value="">No Results</option>`)
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
