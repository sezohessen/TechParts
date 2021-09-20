@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/website/css/seller.css')}}">

@endsection

@section('website')

<div class="Seller">
    <div class="container">
        <div class="mb-28 seller-bg">
            <div class="row">
                <div class="col-md-12 bg">
                     <img class="background" src="{{find_image($seller->background , 'img/background/')}}" alt="">
                </div>
            </div>
            <div class="seller-avatar">
                <img style="height: 200px; width: 200px" class="rounded-full"
                src="{{find_image($seller->sellerAvatar , 'img/avatar/')}}" alt="">
            </div>
        </div>
        <div class="text-center seller-name">
                <div class="mb-6 text-4xl">{{ $seller->FullName }}</div>
        </div>
        <div class="text-center seller-chat">
                <a class="mb-10 text-4xl btn btn-primary">@lang('Message Me') <i class="fab fa-facebook-messenger"></i></a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="p-10 mb-20 left-section">
                    <div class="desc">
                        <div class="pb-10 text-4xl font-bold">@lang('Description')</div>
                        <p> {{ LangDetail($seller->desc,$seller->desc_ar) }} </p>
                    </div>
                    <div class="seller-location">
                        <div class="py-10 text-4xl font-bold"> @lang('Location') </div>
                          <p>
                            <i class="text-4xl text-gray-800 fas fa-map-marked"></i>
                            <span class="ml-5">
                            {{ LangDetail($seller->governorate->title,$seller->governorate->title_ar) }} /
                            {{ LangDetail($seller->city->title,$seller->city->title_ar) }} /
                            {{ $seller->street }}
                            </span>
                         </p>
                    </div>
                    <div class="seller-icons">
                        <div class="py-10 text-4xl font-bold"> @lang('Contact me') </div>
                        <p class="">
                        <a href="#">
                               <i class="px-2 text-4xl text-gray-800 fas fa-phone-square"></i>
                               {{ $seller->user->phone }}
                            </a>
                            <a href="#">
                               <i class="px-2 text-4xl text-green-500 fab fa-whatsapp "></i>
                               {{ $seller->user->whats_app }}
                            </a>
                            <a href="{{$seller->facebook}}" target="_blank">
                                <i class="px-2 text-4xl text-blue-500 fab fa-facebook"></i>
                            </a>
                            <a href="{{$seller->instagram}}"  target="_blank">
                               <i class="px-2 text-4xl text-pink-400 fab fa-instagram "></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
