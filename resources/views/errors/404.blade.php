@extends('website.layouts.app')
@section('css')
<link href="{{ asset('css/pages/error/error-3.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('website')
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Error-->
			<div class="py-56 error error-3 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ asset('/media/error/bg3.jpg') }});">
				<!--begin::Content-->
				<div class="px-10 py-10 px-md-30 py-md-0 d-flex flex-column justify-content-md-center">
					<h1 class="text-transparent error-title text-stroke">404</h1>
					<p class="mb-12 text-white display-4 font-weight-boldest">How did you get here</p>
					<p class="font-size-h1 font-weight-boldest text-dark-75">Sorry we can't seem to find the page you're looking for.</p>
                    <a class="btn btn-primary" href="{{route('Website.Index')}}">Back</a>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Error-->
		</div>

@endsection
