@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/part.css') }}">
<link rel="stylesheet" href="{{ asset('css/website/css/seller-page.css') }}">
@endsection
<!-- Start page -->
@section('website')

 <section class="container seller">
    <div class="py-20 mt-40">
            <div class="page-title" style="background-image: url('images/background01.jpg');">
                <div class="inner">
                    <div class="container">
                        <div class="title">@lang('Sellers')</div> <!-- end .title -->
                    </div> <!-- end .container -->
                </div> <!-- end .inner -->
         </div> <!-- end .page-title -->
            <!-- Row -->
            <div class="row all-sellers">
                @foreach ($sellers as $seller)
                <div class="overflow-hidden col-md-6 col-xs-12 ">
                    <!-- component -->
                    <!-- eslint-disable -->
                    <div class="items-center justify-center w-full pb-6 mx-auto my-4 overflow-hidden bg-white rounded-lg shadow relative">
                        <div class="seller-rating">
                            <!-- Tottal Rating -->
                            <div class="flex p-1 mx-10 leading-6 text-yellow-400 rating">
                                @php
                                    $total = SellerTotalRating($seller->id);
                                @endphp
                            </div>
                        </div>
                        <div class="bg">
                            @if (!$seller->bg)
                            <img class=" object-cover w-full" src="{{asset('img/background/background.jpg')}}" alt="Profile picture">
                            @else
                            <img class=" object-cover w-full" src="{{find_image($seller->background , App\Models\Seller::backgroundBase)}}" alt="{{$seller->background->name}}">
                            @endif
                        </div>
                        <div class="text-center seller-avatar relative">
                            @if (!$seller->avatar)
                            <img class="rounded-full img-thumbnail"
                            src="{{asset('img/avatar/user-profile.png')}}" alt="Profile picture">
                            @else
                            <img class="rounded-full img-thumbnail"
                            src="{{find_image($seller->sellerAvatar , App\Models\Seller::avatarBase)}}" alt="{{$seller->sellerAvatar->name}}">
                            @endif
                        </div>
                        <div class="info">
                            <h1 class="text-2x font-semibold text-primary text-center">
                                <a href="{{ route('Website.SellerProfile',['id'=>$seller->user->id,'first'=>$seller->user->first_name,'second'=>$seller->user->last_name]) }}">
                                {{ $seller->user->FullName }}
                                </a>
                            </h1>
                            <p class="text-muted text-center">
                            {{ LangDetail($seller->governorate->title,$seller->governorate->title_ar) }} -
                            {{ LangDetail($seller->city->title,$seller->city->title_ar) }}
                        </div>
                        <hr>
                        <div class="all-brands row">
                            @foreach ($seller->brands as $brand)
                                <div class="col-md-2 brands">
                                    <img src="{{ find_image($brand->carMaker->logo,App\Models\CarMaker::base) }}" alt="{{ $brand->carMaker->logo->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                {{ $sellers->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
 </section>

@endsection

<!-- Js -->
@section('js')

@endsection
