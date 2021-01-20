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
                <a href="{{ route('dashboard.subscribe_packages.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.subscribe_packages.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="col-12">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Package Period') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('period') ? 'is-invalid' : '' }}"
                             name="period" value="{{ old('period') }}" required placeholder="@lang('period')" autofocus/>
                            @error('period')
                                <div class="invalid-feedback">{{ $errors->first('period') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Price') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                             name="price" value="{{ old('price') }}"required placeholder="@lang('price')"/>
                            @error('price')
                                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="exampleTextarea">@lang("Write A Description (EN)") <span class="text-danger">*</span></label>
                                <textarea   id="kt-ckeditor-1" name="description"   required  class="{{ $errors->has('description') ? ' is-invalid' : '' }}">
                                    {{old("description")}}
                                </textarea>
                                @error('description')
                                    <div class="invalid-feedback " style="display: block">{{ $errors->first('description') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <label for="exampleTextarea">@lang("Write A Description (AR)") <span class="text-danger">*</span></label>
                                <textarea   id="kt-ckeditor-2" name="description_ar"   required  class="{{ $errors->has('description_ar') ? ' is-invalid' : '' }}">
                                    {{old("description_ar")}}
                                </textarea>
                                @error('description_ar')
                                    <div class="invalid-feedback " style="display: block">{{ $errors->first('description_ar') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Currency Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('currency_name') ? 'is-invalid' : '' }}"
                             name="currency_name"  value="{{ old('currency_name') }}" required placeholder="@lang('Currency Name')"/>
                            @error('currency_name')
                                <div class="invalid-feedback">{{ $errors->first('currency_name') }}</div>
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
@section('scripts')
    <script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
    <script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
@endsection
