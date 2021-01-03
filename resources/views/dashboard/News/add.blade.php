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
        <form action="{{route("news.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">@lang('Select Category')</label>
                            <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                                 id="country" name="category_id" required>
                                <option value="">@lang('--Select category first--')</option>
                                @foreach ($categories as $key=> $category)
                                    <option value="{{ $category->id }}" {{-- {{ (Input::old("category_id") == $category->id ? "selected":"") }} --}}>
                                        {{$category->name}} - {{ $category->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @endif
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Image">@lang('News Image')</label>
                            <input type="file" class="form-control-file form control {{ $errors->has('Image') ? 'is-invalid' : '' }}"
                             name="Image">
                             @if ($errors->has('Image'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $message }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Author Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('authorName') ? 'is-invalid' : '' }}"
                             name="authorName"  placeholder="@lang('Name')"value="{{ old('description') }}" required autofocus  />
                            @if ($errors->has('authorName'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="authorImg">@lang('Author Image')</label>
                            <input type="file" class="form-control-file form control {{ $errors->has('authorImg') ? 'is-invalid' : '' }}"
                             name="authorImg">
                             @if ($errors->has('authorImg'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $message }}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Title(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                             name="title"  placeholder="@lang('title name')" value="{{ old('description') }}" required autofocus  />
                            @if ($errors->has('title'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Title(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                             name="title_ar"  placeholder="@lang('title name')" value="{{ old('title_ar') }}" required autofocus  />
                            @if ($errors->has('title_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)')</label>
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)')</label>
                            <textarea name="description_ar" class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" id="description" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $message }}</strong>
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
