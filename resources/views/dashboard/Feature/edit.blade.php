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
                <a href="{{ route('dashboard.feature.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.feature.update",$feature->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="col-12">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Feature Name (ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name" value="{{ old('name') ? old('name'): $feature->name }}"
                              required placeholder="@lang('Name(ENG)')"autofocus/>
                            @error('name')
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Feature Name (AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                             name="name_ar" value="{{ old('name_ar') ? old('name_ar'): $feature->name_ar }}"
                             required placeholder="@lang('Name(AR)')"/>
                            @error('name_ar')
                             <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                            @enderror
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
    <script src="/metronic/theme/html/demo1/dist/assets/js/pages/crud/forms/validation/form-controls.js?v=7.1.8"></script>
@endsection
