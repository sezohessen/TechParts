{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}"  rel="stylesheet" type="text/css"/>
<style>
    .content .bootstrap-select .dropdown-menu{
        max-height: 200px!important;
    }
    .select2-container{
        min-width: 100%!important;
    }
    .invalid-feedback{
        display: block;
    }
</style>
@if (Session::get('app_locale')!='en')
    <style>
        .ck.ck-editor__editable_inline[dir=ltr]{
            text-align: right!important;
        }
    </style>
@endif
@endsection
{{-- Content --}}
@section('content')
<div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
            <div class="text-right">
                <a href="{{ route('dashboard.part.index') }}" style="margin-top: 16px;" class="mr-2 btn btn-primary">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.part.update",$part->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
               <!-- Part English name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Part name(ENG)')</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name"  placeholder="@lang('Name(ENG)')" value="{{$part->name}}"  autofocus  />
                            @error('name')
                                 <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Part arabic name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Part name(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                             name="name_ar"  placeholder="@lang('Name(AR)')" value="{{$part->name_ar}}" required autofocus  />
                            @error('name_ar')
                                 <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Part Number -->
                       <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Part number')</label>
                            <input type="text" class="form-control {{ $errors->has('part_number') ? 'is-invalid' : '' }}"
                             name="part_number"  placeholder="@lang('Part number')" value="{{$part->part_number}}"  autofocus  />
                            @error('part_number')
                                 <div class="invalid-feedback">{{ $errors->first('part_number') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Price Number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Price')</label>
                            <input type="number" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                             name="price"  placeholder="@lang('Price')" value="{{$part->price}}"  autofocus  />
                            @error('price')
                                 <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- in stock -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('In stock')</label>
                            <input type="number" class="form-control {{ $errors->has('in_stock') ? 'is-invalid' : '' }}"
                             name="in_stock"  placeholder="@lang('In stock')" value="{{$part->in_stock}}"  autofocus  />
                            @error('in_stock')
                                 <div class="invalid-feedback">{{ $errors->first('in_stock') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-12">@lang('Select User')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                <select class="form-control selectpicker {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                     name="user_id" id="kt_select2_4" required >
                                    <option value="{{$part->seller->id}}">{{$part->seller->user->full_name}}</option>
                                    @foreach ($sellers as $seller)
                                        <option
                                        @if (old('user_id')==$seller->user_id)
                                            {{ 'selected' }}
                                        @endif
                                        value="{{$seller->user_id}}">
                                            {{ $seller->user->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <!-- v2 Edit - add ( car manf , model , year, CC) -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Make')<span class="text-danger">*</span></label><br>
                            <div class="col-md-12">
                                <select class="form-control selectpicker {{ $errors->has('CarMaker_id') ? 'is-invalid' : '' }}" name="CarMaker_id" id="maker" required>
                                    <option value="{{$part->car->CarMaker_id}}"
                                    data-content="
                                            <img src='{{url('img/CarMakers/'.$part->car->make->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$part->car->make->name}}</span>
                                            "></option>
                                    @foreach ($makers as $key=>$maker)
                                        <option value="{{$maker->id}}"
                                            data-content="
                                            <img src='{{url('img/CarMakers/'.$maker->logo->name)}}'  class='img-thumbnail' width='30' height='30'>
                                            <span>{{$maker->name}}</span>
                                            "{{ old('CarMaker_id')==$maker->id ? 'selected':'' }}>
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
                             <label for="model" class="col-form-label  col-sm-12">@lang('By car type')<span class="text-danger">*</span>
                            </label><br>
                             <div class="col-md-12">
                                <select class="form-control {{ $errors->has('CarModel_id') ? 'is-invalid' : '' }}" id="models"
                                name="CarModel_id"  data-select2-id="{{old("CarModel_id")}}" >
                                    <option value="{{$part->car->CarModel_id}}">{{$part->car->model->name}}</option>

                                </select>
                                @error('CarModel_id')
                                    <div class="invalid-feedback">{{ $errors->first('CarModel_id') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Car Year')</label><br>
                            <div class="col-md-12">
                             <select class="form-control {{ $errors->has('CarYear_id') ? 'is-invalid' : '' }}"
                                 name="CarYear_id" id='year'>
                                    @if ($part->car->CarYear_id != null)
                                    <option value="{{$part->car->CarYear_id}}">{{$part->car->year->year}}</option>
                                    @else
                                        <option value="">@lang('By car type First')</option>
                                    @endif
                             </select>
                            @error('CarYear_id')
                             <div class="invalid-feedback">{{ $errors->first('CarYear_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Car Capacity')</label><br>
                            <div class="col-md-12">
                                <select class="form-control select2 {{ $errors->has('CarCapacity_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_3" name="CarCapacity_id">
                                    @if ($part->car->CarCapacity_id != null)
                                    <option value="{{$part->car->CarCapacity_id}}">{{$part->car->capacity->capacity}}</option>
                                    @else
                                        <option value="">@lang('Select Car Capacity')</option>
                                    @endif
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
                </div>
                    <!-- Desc -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" >{{$part->desc}}</textarea>
                            @error('desc')
                                <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Arabic Desc -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')<span class="text-danger">*</span></label>
                            <textarea name="desc_ar" class="form-control {{ $errors->has('desc_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3" required
                            placeholder="@lang('Write description')" >{{$part->desc_ar}}</textarea>
                            @error('desc_ar')
                                <div class="invalid-feedback">{{ $errors->first('desc_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    @foreach ($part->images as $key=>$image)
                    <!-- Part img -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">
                                @if($key==0)@lang('Main Image') @else @lang('Part image') @endif
                                @if($key==0)<span class="text-danger">*</span> @endif
                            </label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="logo_{{ $key }}" style="background-image: url('{{ find_image($image->image,App\Models\Part::base) }}')">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="part_img[{{ $image->image->id }}]" accept=".png, .jpg, .jpeg ,gif,svg"/>
                                    <input type="hidden" name="part_img[{{ $image->image->id }}]_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            @error('part_img.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endforeach
                    @for ($i = ($part->images->count()); $i < App\Models\Part::ImgCount; $i++)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Image">@lang('Part image')</label><br>
                                <div class="image-input image-input-empty image-input-outline" id="logo_{{ $i }}" style="background-image: url('')">
                                    <div class="image-input-wrapper"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="part_img_new[]" accept=".png, .jpg, .jpeg ,gif,svg"  />
                                        <input type="hidden" name="part_img_new[]_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                @error('part_img_new.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="mr-2 btn btn-primary">@lang('Edit')  </button>
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
        new KTImageInput("logo_0");
        new KTImageInput("logo_1");
        new KTImageInput("logo_2");
        new KTImageInput("logo_3");
        }
        };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
<script>
    function year(id ){
        $('#year').empty();
        old_year="<?php echo old('CarYear_id') ?  old('CarYear_id') : ""  ?>";
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
        old_model="<?php echo old('CarModel_id') ?  old('CarModel_id') : ""  ?>";
        $.ajax({
            url: '/dashboard/car/available_model/'+id,
            success: data => {
                if(data.models){
                    $('#models').append(`<option value="" >@lang('By car type')</option>`)
                    data.models.forEach(models =>
                    $('#models').append(`<option value="${models.id}" ${(old_model==models.id) ? "selected" : "" } >${models.name}</option>`)
                    )
                }else{
                    $('#models').append(`<option value="">{{__("No Results")}}</option>`)
                }

            },

        });
    }
    $('#maker').on('change', function() {
        var id = this.value ;
        model(id);
    });
    $('#models').on('change', function() {
        var id = this.value;
        year(id);
    });
    var old_maker="<?php echo (old('CarMaker_id')) ? old('CarMaker_id') : null; ?>";
    if (old_maker != ''){
        model("<?php echo (old('CarMaker_id'))?>");
    }
    var old_maker="<?php echo (old('CarModel_id')) ? old('CarModel_id') : null; ?>";
    if (old_maker != ''){
        year("<?php echo (old('CarModel_id'))?>");
    }
</script>
@endsection
