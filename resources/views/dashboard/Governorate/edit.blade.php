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
                <a href="{{ route('dashboard.governorate.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>

        <!--begin::Form-->
        <form action="{{route("dashboard.governorate.update",$governorate->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="col-12">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Governorate Name(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                             name="title" value="{{ old('title') ? old('title'): $governorate->title }}"
                              placeholder="@lang('Name(ENG)')" required autofocus  />
                            @error('title')
                              <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Governorate Name (AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                             name="title_ar" value="{{ old('title_ar') ? old('title_ar'): $governorate->title_ar }}"
                              placeholder="@lang('Name(AR)')" required />
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $errors->first('title_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Country')<span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                                 id="country" name="country_id" required>
                                @foreach ($countries as $country)
                                    @if ($country->id == $governorate->country_id)
                                        <option value="{{$country->id}}" selected>{{$country->name}} - {{ $country->name_ar }}</option>
                                    @else
                                        <option value="{{$country->id}}">{{$country->name}} - {{ $country->name_ar }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>
                            @enderror
                          </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('update') </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="/metronic/theme/html/demo1/dist/assets/js/pages/crud/forms/validation/form-controls.js?v=7.1.8"></script>
@endsection
