@extends('website.layouts.app')
@section('css')
<link href="{{ asset('css/pages/error/error-3.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('website')
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Error-->
			<div class="py-96 error error-3 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{ asset('/media/error/bg3.jpg') }});">
				<!--begin::Content-->
				<div class="px-10 py-10 text-5xl px-md-30 py-md-0 d-flex flex-column justify-content-md-center">
                    <h1 class="py-10 font-bold text-center text-9xl">404</h1>
					<p class="mb-12 text-center display-4 font-weight-boldest">@lang('How did you get here')</p>
					<p class="text-center font-size-h1 font-weight-boldest text-dark-75 mb-10">@lang("Sorry we can't seem to find the page you're looking for.")</p>
                    <div class="text-center"><a class="btn btn-primary" href="{{route('Website.Index')}}">@lang('Back')</a></div>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Error-->
		</div>

@endsection
