{{-- Extends layout --}}
@extends('layout.bank')
@section('styles')
    <link href="{{ asset('css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- Content --}}
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{ $page_title }}
            </h3>
            <div class="text-right">
                <a href="{{ route('bank.bank-offer.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{ route('bank.bank-offer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Bank offer title(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" placeholder="@lang('Title(ENG)')" value="{{ old('name') }}" required
                                autofocus />
                            @error('name')
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Bank offer title(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                name="name_ar" placeholder="@lang('Title(AR)')" value="{{ old('name_ar') }}" required />
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)') <span class="text-danger">*</span></label>
                            <textarea name="description"
                                class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                id="kt-ckeditor-1" rows="3"
                                placeholder="@lang('Write description')">{{ old('description_ar') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)') <span class="text-danger">*</span></label>
                            <textarea name="description_ar"
                                class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                id="kt-ckeditor-2" rows="3"
                                placeholder="@lang('Write description')">{{ old('description_ar') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $errors->first('description_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valid_till">@lang('Offer expiration date') <span class="text-danger">*</span></label>
                            <div class="input-group">
                             <input class="form-control" name="valid_till" type="date" id="valid_till" value="{{ old('valid_till') }}" required
                             class="form-control {{ $errors->has('valid_till') ? 'is-invalid' : '' }}"/>
                             @error('valid_till')
                                <div class="invalid-feedback">{{ $errors->first('valid_till') }}</div>
                             @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Down payment percentage') <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="down_payment_percentage" placeholder="@lang('percentage')" value="{{ old('down_payment_percentage') }}" required
                                class="form-control {{ $errors->has('down_payment_percentage') ? 'is-invalid' : '' }}" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('down_payment_percentage')
                                    <div class="invalid-feedback">{{ $errors->first('down_payment_percentage') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Interest rate') <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="interest_rate" placeholder="@lang('percentage')" value="{{ old('interest_rate') }}" required
                                class="form-control {{ $errors->has('interest_rate') ? 'is-invalid' : '' }}" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('interest_rate')
                                <div class="invalid-feedback">{{ $errors->first('interest_rate') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Number of years') <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="number_of_years" placeholder="@lang('Number')" value="{{ old('number_of_years') }}" required
                                class="form-control {{ $errors->has('number_of_years') ? 'is-invalid' : '' }}" aria-describedby="basic-addon2">
                                @error('number_of_years')
                                <div class="invalid-feedback">{{ $errors->first('number_of_years') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Installment months') <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="installment_months" placeholder="@lang('Months')" value="{{ old('installment_months') }}" required
                                class="form-control {{ $errors->has('installment_months') ? 'is-invalid' : '' }}" aria-describedby="basic-addon2">
                                @error('installment_months')
                                <div class="invalid-feedback">{{ $errors->first('installment_months') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('Offer image') <span class="text-danger">*</span></label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="logo_id"
                                style="background-image: url({{ asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo_id" accept=".png, .jpg, .jpeg ,gif,svg" />
                                    <input type="hidden" name="logo_id_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            @error('logo_id')
                                <div class="invalid-feedback">{{ $errors->first('logo_id') }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('create')</button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/editors/ckeditor-classic.js') }}"></script>
    <script src="{{ asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        "use strict";
        var KTUserEdit = {
            init: function() {
                new KTImageInput("logo_id");
            }
        };
        jQuery(document).ready((function() {
            KTUserEdit.init()
        }));

    </script>
@endsection
