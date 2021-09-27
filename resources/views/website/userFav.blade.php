@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/part.css') }}">
@endsection
<!-- Start page -->
@section('website')

 <section class="container">
        <div class="py-20 mt-40">
            <div class="favorite-parts row">
                <h1 class="py-4 mb-10 text-4xl text-center text-gray-300 bg-blue-900 border-4 rounded-t-full ">
                    @lang('Your Favorite Parts')
                </h1>
                @if(session()->has('deleted'))
                    <div class="m-4 text-center text-gray-100 bg-blue-900 alert">
                        <p>{{ session('deleted') }}</p>
                    </div>
                @endif
                @if(session()->has('created'))
                    <div class="m-4 text-center text-gray-100 bg-blue-900 alert">
                        <p>{{ session('created') }}</p>
                    </div>
                @endif
                {{-- Fav parts --}}
                <div class="featured-cars">
                    <div class="row">
                        <x-part :parts="$parts->favorite" makeCol="4"/>
                    </div>
                </div>
            </div>
        </div>
 </section>

@endsection

<!-- Js -->
@section('js')

@endsection
