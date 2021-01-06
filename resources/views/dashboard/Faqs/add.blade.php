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
                <a href="{{ route('dashboard.faqs.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>

        <form action="{{route("dashboard.faqs.store")}}" method="POST" id="myform" wire:submit.prevent="store">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="form-group">
                    <label>@lang('Create A Question') <span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" required  wire:model="question" value="{{ old('question') }}"   placeholder="{{__("Ask a Question")}}" autofocus/>
                    @error('question')
                        <div class="invalid-feedback">{{ $errors->first('question') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">@lang("Write an Answer")<span class="text-danger">*</span></label>
                    <textarea  id="kt-ckeditor-1" name="answer"  wire:model="answer"  required  class="{{ $errors->has('question') ? ' is-invalid' : '' }}">
                            {{old("answer")}}
                    </textarea>
                    @error('answer')
                        <div class="invalid-feedback"  style="display: block">{{ $errors->first('answer') }}</div>
                    @enderror
                </div>
            <!-- AR Form -->
                <div class="form-group">
                    <label>@lang("Create A Question (AR)") <span class="text-danger">*</span></label>
                    <input type="text" class="form-control  {{ $errors->has('question_ar') ? ' is-invalid' : '' }}" required value="{{ old('question_ar') }}"   name="question_ar"   wire:model="question_ar" placeholder="{{__("Ask a Question")}}"/>
                    @error('question_ar')
                        <div class="invalid-feedback">{{ $errors->first('question_ar') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">@lang("Write A Answer (EN)") <span class="text-danger">*</span></label>
                    <textarea   id="kt-ckeditor-2" name="answer_ar"  wire:model="answer_ar" required  class="{{ $errors->has('question') ? ' is-invalid' : '' }}">
                        {{old("answer_ar")}}
                    </textarea>
                    @error('answer_ar')
                        <div class="invalid-feedback " style="display: block">{{ $errors->first('answer_ar') }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2" wire:click="$emit('postAdded')">@lang("create") </button>
            </div>
        </form>
    </div>


@endsection

{{-- Scripts Section --}}
@section('scripts')

<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>

@endsection

@section('styles')

@endsection
