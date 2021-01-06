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
                <a href="{{ route('dashboard.aqs.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>

        <!--begin::Form-->
        <form action="{{route("dashboard.faqs.update",$faq->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- EN Form -->
                <div class="form-group">
                    <label>@lang('Create A Question') <span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" name="question"  wire:model="question" value="{{ old('question') ?? $faq->question }}"   placeholder="Ask Question" autofocus/>
                    @error('question')
                        <div class="invalid-feedback">{{ $errors->first('question') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">@lang("Write an Answer")<span class="text-danger">*</span></label>
                    <textarea  id="kt-ckeditor-1" name="answer"  wire:model="answer"   class="{{ $errors->has('question') ? ' is-invalid' : '' }}">
                        {{ old('answer') ?? $faq->answer }}
                    </textarea>
                    @error('answer')
                        <div class="invalid-feedback"  style="display: block">{{ $errors->first('answer') }}</div>
                    @enderror
                </div>
            <!-- AR Form -->
                <div class="form-group">
                    <label>@lang("Create A Question (AR)") <span class="text-danger">*</span></label>
                    <input type="text" class="form-control  {{ $errors->has('question_ar') ? ' is-invalid' : '' }}"value="{{ old('question_ar') ?? $faq->question_ar }}"   name="question_ar"   wire:model="question_ar" placeholder="Ask Question"/>
                    @error('question_ar')
                        <div class="invalid-feedback">{{ $errors->first('question_ar') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">@lang("Write A Answer (EN)") <span class="text-danger">*</span></label>
                    <textarea   id="kt-ckeditor-2" name="answer_ar"  wire:model="answer_ar"  class="{{ $errors->has('question') ? ' is-invalid' : '' }}">
                        {{ old('answer_ar') ?? $faq->answer_ar }}
                    </textarea>
                    @error('answer_ar')
                        <div class="invalid-feedback " style="display: block">{{ $errors->first('answer_ar') }}</div>
                    @enderror
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

<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
@endsection
