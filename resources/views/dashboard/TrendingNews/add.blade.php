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
                <a href="{{ route('dashboard.trending-news.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.trending-news.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="card-body">
                    @if (session('failed'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failed') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select Date')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group date" >
                                    <input type="text" class="form-control {{ $errors->has('day') ? 'is-invalid' : '' }}"
                                     readonly name='day' value="{{old("day")}}"  placeholder="Select date" id="kt_datepicker_1"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                    @error('day')
                                        <div class="invalid-feedback">{{ $errors->first('day') }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-12">@lang('Select News')<span class="text-danger">*</span></label><br>
                            <div class=" col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control select2 {{ $errors->has('news_id') ? 'is-invalid' : '' }}"
                                    id="kt_select2_2" name="news_id[]" required multiple  >
                                    @foreach ($newsList as $news)
                                       <option value="{{$news->id}}" >{{$news->title}} - {{$news->title_ar}} </option>
                                    @endforeach
                                </select>
                                @error('news_id')
                                    <div class="invalid-feedback">{{ $errors->first('news_id') }}</div>
                                @enderror
                                <span class="form-text text-muted">@lang('You can choose more than one news')</span>
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
<script src="{{ asset("js/pages/crud/forms/widgets/select2.js") }}"></script>
<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>

@endsection
