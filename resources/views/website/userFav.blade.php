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
                @if(session()->has('added'))
                    <div class="m-4 text-center text-gray-100 bg-blue-900 alert">
                        <p>{{ session('added') }}</p>
                    </div>
                @endif
                <div>
                    @php
                    $parts = App\Models\User::find(Auth()->user()->id);
                    @endphp
                    @if ($parts->favorite->count() < 1)
                    <!-- No items in favorite -->
                    <div class="row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-64 text-center bg-blue-100 py-7 rounded-b-xl">
                                    <span class="py-12 text-2xl">@lang('No Parts to show')</span>
                                    <a class="p-3 text-gray-200 transition duration-500 ease-in-out bg-blue-500 rounded-2xl hover:text-gray-50 hover:bg-blue-300 " href="{{route('Website.Index')}}"> @lang('Home') </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                {{-- Fav parts --}}
                <div class="featured-cars">
                    <div class="row fav">
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
