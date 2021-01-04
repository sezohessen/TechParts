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
        @livewire('faqs')
    </div>


@endsection

{{-- Scripts Section --}}
@section('scripts')

<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<livewire:scripts />
<script type="text/javascript">
    Livewire.on('initializeCkEditor', function () {
        ClassicEditor.create(document.getElementById('kt-ckeditor-1')).then(editor => { thisEditor = editor });
    });
    Livewire.on('initializeCkEditor', function () {
        ClassicEditor.create(document.getElementById('kt-ckeditor-2')).then(editor => { thisEditor = editor });
    });
</script>
@endsection

@section('styles')
<livewire:styles />
@endsection
