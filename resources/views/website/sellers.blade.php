@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/part.css') }}">
@endsection
<!-- Start page -->
@section('website')

 <section class="container">
    <div class="py-20 mt-40">
            <div class="page-title" style="background-image: url('images/background01.jpg');">
                <div class="inner">
                    <div class="container">
                        <div class="title">@lang('Sellers')</div> <!-- end .title -->
                    </div> <!-- end .container -->
                </div> <!-- end .inner -->
         </div> <!-- end .page-title -->
            <!-- Row -->
            <div class="row">
                @foreach ($sellers as $seller)
                <div class="overflow-hidden col-md-12 col-xs-12 ">
                    <!-- component -->
                    <!-- eslint-disable -->
                        <div class="items-center justify-center w-full pb-6 mx-auto my-12 overflow-hidden bg-white rounded-lg shadow-inner">
                        <div class="h-40">
                            @if (!$seller->bg)
                            <img class="absolute object-cover w-full h-96" src="{{asset('img/background/background.jpg')}}" alt="Profile picture">
                            @else
                            <img class="absolute object-cover w-full h-96" src="{{find_image($seller->background , App\Models\Seller::backgroundBase)}}" alt="{{$seller->background->name}}">
                            @endif
                        </div>
                        <div class="relative mt-12 text-center seller-avatar">
                            @if (!$seller->avatar)
                            <img style="height: 80px; width: 80px" class="rounded-full img-thumbnail"
                            src="{{asset('img/avatar/user-profile.png')}}" alt="Profile picture">
                            @else
                            <img style="height: 150px; width: 150px;" class="rounded-full img-thumbnail"
                            src="{{find_image($seller->sellerAvatar , App\Models\Seller::avatarBase)}}" alt="{{$seller->sellerAvatar->name}}">
                            @endif
                        </div>
                        <div class="">
                            <h1 class="text-lg font-semibold text-center">
                                <a href="{{ route('Website.SellerProfile',['id'=>$seller->user->id,'first'=>$seller->user->first_name,'second'=>$seller->user->last_name]) }}">
                                   {{ $seller->user->FullName }}
                                </a>
                            </h1>
                            <p class="text-sm text-center text-gray-600">
                            {{ LangDetail($seller->governorate->title,$seller->governorate->title_ar) }} -
                            {{ LangDetail($seller->city->title,$seller->city->title_ar) }}

                        </div>
                            <div class="flex flex-wrap py-4 pt-3 mx-6 mt-6 border-t">
                                <div class="px-2 my-1 mr-2 text-xs tracking-wider text-indigo-600 uppercase border border-indigo-600 cursor-default hover:bg-indigo-600 hover:text-indigo-100">
                                User experience
                                </div>
                                <div class="px-2 my-1 mr-2 text-xs tracking-wider text-indigo-600 uppercase border border-indigo-600 cursor-default hover:bg-indigo-600 hover:text-indigo-100">
                                VueJS
                                </div>
                                <div class="px-2 my-1 mr-2 text-xs tracking-wider text-indigo-600 uppercase border border-indigo-600 cursor-default hover:bg-indigo-600 hover:text-indigo-100">
                                TailwindCSS
                                </div>
                                <div class="px-2 my-1 mr-2 text-xs tracking-wider text-indigo-600 uppercase border border-indigo-600 cursor-default hover:bg-indigo-600 hover:text-indigo-100">
                                React
                                </div>
                                <div class="px-2 my-1 mr-2 text-xs tracking-wider text-indigo-600 uppercase border border-indigo-600 cursor-default hover:bg-indigo-600 hover:text-indigo-100">
                                Painting
                                </div>
                            </div>
                            <div class="p-4 text-center bg-blue-300 rounded-b-lg text-gray-50">
                                   <span class="p-4 text-base text-gray-100 bg-blue-400 rounded-2xl">@lang('No rating yet')
                                        <i class="fas fa-circle-notch fa-spin"></i></span>
                            </div>
                        </div>
                        <hr>
                </div>
                @endforeach
            </div>
        </div>
    </div>
 </section>

@endsection

<!-- Js -->
@section('js')

@endsection
