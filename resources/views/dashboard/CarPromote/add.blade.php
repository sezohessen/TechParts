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
                <a href="{{ route('dashboard.promote.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.promote.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="col-12">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Car')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                             <select class="form-control select2 {{ $errors->has('car_id') ? 'is-invalid' : '' }}"
                                 id="kt_select2_1" name="car_id" required>
                                @foreach ($cars as $car)
                                    <option value="{{$car->id}}"{{ old('car_id')==$car->id ? 'selected':'' }} >
                                        <strong>ID</strong> [{{$car->id}}]: <strong>{{__("Maker")}}</strong>: {{$car->maker->name}} -<strong>{{__("Price")}}</strong>: {{$car->price}}
                                    </option>
                                @endforeach
                             </select>
                            @error('car_id')
                             <div class="invalid-feedback">{{ $errors->first('car_id') }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label  col-sm-12">@lang('Select Package')</label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                             <select class="form-control select2 {{ $errors->has('subscribe_package_id') ? 'is-invalid' : '' }}"
                                 id="kt_select2_2" name="subscribe_package_id" required>
                                @foreach ($packages as $package)
                                    <option value="{{$package->id}}"{{ old('subscribe_package_id')==$package->id ? 'selected':'' }} >
                                         <strong>{{__("Period")}}</strong>: {{$package->period}} -<strong>{{__("Price")}}</strong>: {{$car->price}}
                                    </option>
                                @endforeach
                             </select>
                            @error('subscribe_package_id')
                             <div class="invalid-feedback">{{ $errors->first('subscribe_package_id') }}</div>
                            @enderror
                            </div>
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
                        <div class="form-group">
                            <label>@lang('Order ID') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('weaccept_order_id') ? 'is-invalid' : '' }}"
                             name="weaccept_order_id" value="{{ old('weaccept_order_id') }}"required placeholder="@lang('Order ID')"/>
                            @error('weaccept_order_id')
                                <div class="invalid-feedback">{{ $errors->first('weaccept_order_id') }}</div>
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
    <script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
    
    <script>
        $('#kt_select2_1').select2({
            tags: true,
            placeholder: "{{__('Select Car')}}",
        });
        $('#kt_select2_2').select2({
            tags: true,
            placeholder: "{{__('Select Package')}}",
        });
    </script>
@endsection
