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
<livewire:scripts />
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js?v=7.1.8")}}"></script>
<script type="text/javascript">
"use strict";
// Class definition

var KTCkeditor = function () {
    // Private functions
    var demos = function () {
        ClassicEditor
			.create( document.querySelector( '#kt-ckeditor-1' ) )
			.then( editor => {
				console.log( editor );
			} )
			.catch( error => {
				console.error( error );
			} );

		ClassicEditor
			.create( document.querySelector( '#kt-ckeditor-2' ) )
			.then( editor => {
				console.log( editor );
			} )
			.catch( error => {
				console.error( error );
			} );

    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

window.livewire.on('postAdded' => {
    CKEDITOR.instances['answer'].on('change', function(e){
        @this.set('answer', e.editor.getData());
    });
    CKEDITOR.instances['answer_ar'].on('change', function(e){
        @this.set('answer_ar', e.editor.getData());
    });
});
</script>
@endsection

@section('styles')
<livewire:styles />
@endsection
