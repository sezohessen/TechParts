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
        <form action="{{route("dashboard.agency.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Agency Name (ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            name="title"  placeholder="@lang('Name(ENG)')" autofocus  value="{{old("name")}}"/>
                            @error('name')
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Agency Name (AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                            name="name_ar"  placeholder="@lang('Name(AR)')" value="{{old("name_ar")}}" />
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('description')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')</label>
                            <textarea name="description_ar" class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('description_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Show in home')</label>
                                    <div class="checkbox-list">
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes1"/>
                                            <span></span>
                                            @lang('Show')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Show in car show rooms')</label>
                                    <div class="checkbox-list">
                                        <label class="checkbox">
                                            <input type="checkbox" name="Checkboxes1"/>
                                            <span></span>
                                            @lang('Show')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Center type')</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Distributor')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Agency')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Individual')
                                        </label>
                                    </div>
                                    <span class="form-text text-muted">Some help text goes here</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Payment Method')</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Cash')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Installment')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Financial')
                                        </label>
                                    </div>
                                    <span class="form-text text-muted">Some help text goes here</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Car status')</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('New')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Used')
                                        </label>
                                    </div>
                                    <span class="form-text text-muted">Some help text goes here</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Status')</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Premium')
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2"/>
                                            <span></span>
                                            @lang('Trusted')
                                        </label>
                                    </div>
                                    <span class="form-text text-muted">Some help text goes here</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Country') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" id="country"
                            name="country_id" >
                                <option value="">@lang('--Select country first--')</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}} - {{ $country->name_ar }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">{{ $errors->first('title_ar') }}</div>
                            @enderror
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="governorate">@lang('Select Governorate') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('governorate_id') ? 'is-invalid' : '' }}" id="governorate"
                            name="governorate_id" >
                                <option value="">@lang('--Select governorate first--')</option>
                            </select>
                            @error('governorate_id')
                                <div class="invalid-feedback">{{ $errors->first('governorate_id') }}</div>
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
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script>
    $('#country').on('change', function() {
        var id = this.value ;
        $('#governorate').empty();
        $.ajax({
            url: '/dashboard/country/'+id,
            success: data => {
                if(data.governorates){
                    data.governorates.forEach(governorate =>
                    $('#governorate').append(`<option value="${governorate.id}">${governorate.title}-${governorate.title_ar}</option>`)
                    )
                }else{
                    $('#governorate').append(`<option value="">No Results</option>`)
                }

            }
        });
    });
</script>
@endsection
