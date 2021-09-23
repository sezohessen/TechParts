@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/website/css/seller.css')}}">
<link rel="stylesheet" href="{{asset('css/website/css/part.css')}}">

@endsection

@section('website')

<div class="Seller">
    <div class="container">
        <div class="mb-20 seller-bg">
            <div class="row">
                <div class="col-md-12 bg">
                @if (!$seller->bg)
                <img src="{{asset('img/background/background.jpg')}}" alt="Profile picture">
                @else
                <img src="{{find_image($seller->background , App\Models\Seller::backgroundBase)}}" alt="{{$seller->background->name}}">
                @endif

                </div>
            </div>
            <div class="seller-avatar">
                @if (!$seller->avatar)
                <img style="height: 150px; width: 150px" class="rounded-full img-thumbnail"
                src="{{asset('img/avatar/user-profile.png')}}" alt="Profile picture">
                @else
                <img style="height: 150px; width: 150px" class="rounded-full img-thumbnail"
                src="{{find_image($seller->sellerAvatar , App\Models\Seller::avatarBase)}}" alt="{{$seller->sellerAvatar->name}}">
                @endif

            </div>
        </div>
        <div class="text-center seller-name">
                <div class="mb-6 text-3xl">{{ $seller->user->FullName }}</div>
        </div>
        <div class="text-center seller-chat">
                <a class="mb-10 text-3xl btn btn-primary">@lang('Message Me') <i class="fab fa-facebook-messenger"></i></a>
        </div>
        <div class="row">
            <div class="col-md-4 left-bar">
                <div class="p-10 mb-20 left-section">
                    <div class="desc">
                        <div class="pb-10 text-4xl font-bold">@lang('Brief summary')</div>
                        <p> {!! LangDetail($seller->desc,$seller->desc_ar) !!} </p>
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
            <div class="col-md-8 mb-40">
                <div class="right-section">
                    @if ($parts->count())
                        <div class="featured-cars row">
                            <x-part :parts="$parts" :makeCol="6"></x-part>
                        </div>
                        <div class="text-center mt-20">
                            {{ $parts->links("pagination::bootstrap-4") }}
                        </div>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
