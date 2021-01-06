{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}"  rel="stylesheet" type="text/css"/>
@endsection
{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
        </div>
        <!--begin::Form-->
        <form action="{{route("offer-plan.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Offer Plan title(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                             name="name"  placeholder="@lang('Title(ENG)')" value="{{ old('name')}}" required autofocus  />
                            @if ($errors->has('name'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('name')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Offer Plan title(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                             name="name_ar"  placeholder="@lang('Title(AR)')" value="{{ old('name_ar') }}" required   />
                            @if ($errors->has('name_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('name_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" required>{{ old('description') }}</textarea>
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
                            placeholder="@lang('Write description')" required>{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('description_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="insurance_id">@lang('Select Insurance company name') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('insurance_id') ? 'is-invalid' : '' }}" id="insurance_id"
                            name="insurance_id" required>
                                <option value="">@lang('--Select insurance company--')</option>
                                @foreach ($Insurances as $Insurance)
                                    <option value="{{$Insurance->id}}">{{$Insurance->name}} - {{ $Insurance->name_ar }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('insurance_id'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('insurance_id')  }}</strong>
                                    </div>
                                </div>
                            @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="offer_id">@lang('Select Offer company') <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->has('offer_id') ? 'is-invalid' : '' }}" id="offer_id"
                            name="offer_id" required>
                                <option value="">@lang('--Select Insurance company first--')</option>
                            </select>
                            @if ($errors->has('offer_id'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('offer_id')  }}</strong>
                                    </div>
                                </div>
                            @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="Price" class="col-2 col-form-label">@lang('Price')</label>
                            <div class="col-10">
                            <input type="number" name="price" min="0" step="1" value="{{ old('price') }}"
                             id="Price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="0.00" required>
                            @if ($errors->has('price'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('price')  }}</strong>
                                    </div>
                                </div>
                            @endif
                            </div>
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
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script>
    $('#insurance_id').on('change', function() {
        var id = this.value ;
        $('#offer_id').empty();
        $.ajax({
            url: '/dashboard/insurance/'+id,
            success: data => {
                if(data.insurance_offers){
                    data.insurance_offers.forEach(insurance_offer =>
                        $('#offer_id').append(`<option value="${insurance_offer.id}">${insurance_offer.title}-${insurance_offer.title_ar}</option>`)
                    )
                }else{
                    $('#offer_id').append(`<option value="">No Results</option>`)
                }

            }
        });
    });
</script>
@endsection
