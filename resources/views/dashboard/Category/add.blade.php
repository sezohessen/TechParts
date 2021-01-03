{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
        </div>
        <!--begin::Form-->
        <form action="{{route("category.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Category Name(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('CategoryEnglish') ? 'is-invalid' : '' }}"
                             name="CategoryEnglish"  placeholder="@lang('Name(ENG)')" required autofocus  />
                            @if ($errors->has('CategoryEnglish'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please enter category name')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Category Name(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('CategoryArabic') ? 'is-invalid' : '' }}"
                             name="CategoryArabic"  placeholder="@lang('Name(AR)')"  required/>
                            @if ($errors->has('CategoryArabic'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        @lang('Please enter category name')
                                    </div>
                                </div>
                            @endif
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
<script src="/metronic/theme/html/demo1/dist/assets/js/pages/crud/forms/validation/form-controls.js?v=7.1.8"></script>
@endsection
