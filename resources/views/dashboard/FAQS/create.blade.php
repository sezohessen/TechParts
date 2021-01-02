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
        @include('dashboard/message')
        <form action="{{route("faqs.store")}}" method="POST">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                    <div class="form-group">
                        <label>@lang('faq creat question') <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="question"  placeholder="Ask Question"/>
                    </div>
                    <div class="form-group mb-1">
                        <label for="exampleTextarea">{{__("faq__create_answer")}} <span class="text-danger">*</span></label>
                        <textarea  id="kt-ckeditor-1"  name="answer"> </textarea>
                    </div>
                <!-- AR Form -->
                    <div class="form-group">
                        <label>{{__("faq__create_question_ar")}}  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="question_ar"  placeholder="Ask Question"/>
                    </div>
                    <div class="form-group mb-1">
                        <label for="exampleTextarea">{{__("faq__create_answer_ar")}}   <span class="text-danger">*</span></label>
                        <textarea  id="kt-ckeditor-2"  name="answer_ar"> </textarea>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{__("create")}}  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js?v=7.1.8")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js?v=7.1.8")}}"></script>
@endsection
