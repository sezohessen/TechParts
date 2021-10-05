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
            <a href="{{ route('MessengerID',$seller->user_id) }}" class="mb-10 text-3xl btn btn-primary">@lang('Message Me') <i class="fab fa-facebook-messenger"></i></a>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12 left-bar sm:mb-12">
                <div class="p-10 mb-20 left-section ">
                    <div class="desc">
                        <div class="pb-10 text-4xl font-bold">@lang('Brief summary')</div>
                        <p> {!! LangDetail($seller->desc,$seller->desc_ar) !!} </p>
                    </div>
                    <div class="seller-location">
                        <div class="py-10 text-4xl font-bold"> @lang('Location') </div>
                          <p>
                            <i class="text-4xl text-blue-400 fas fa-map-marked"></i>
                            @if ($seller->governorate && $seller->city)
                            <span class="ml-5">
                                <a class="text-primary" target="_blank" href="http://maps.google.com/?q={{ $seller->lat }},{{ $seller->long }}">
                                    {{ LangDetail($seller->governorate->title,$seller->governorate->title_ar) }}-
                                    {{ LangDetail($seller->city->title,$seller->city->title_ar) }}-{{ $seller->street }}
                                </a>
                            </span>
                            @endif
                         </p>
                    </div>
                    <div class="seller-icons">
                        <div class="py-10 text-4xl font-bold"> @lang('Contact me') </div>
                        <p class="">
                           <a class="py-2 sm:block" href="#">
                               <i class="px-2 text-4xl text-gray-800 fas fa-phone-square"></i>
                               {{ $seller->user->phone }}
                            </a>
                            @if ($seller->user->whats_app)
                            <a class="py-2 sm:block" href="https://api.whatsapp.com/send?phone={{$seller->user->whats_app}}" target="_blank">
                               <i class="px-2 text-4xl text-green-500 fab fa-whatsapp "></i>
                               {{ $seller->user->whats_app }}
                            </a>
                            @endif
                            @if ($seller->facebook)
                            <a class="py-2 sm:block md:block" href="{{$seller->facebook}}" target="_blank">
                                <i class="px-2 text-4xl text-blue-500 fab fa-facebook"></i>
                                <span class="capitalize">facebook</span>
                            </a>
                            @endif
                            @if ($seller->instagram)
                            <a class="py-2 sm:block" href="{{$seller->instagram}}"  target="_blank">
                               <i class="px-2 text-4xl text-pink-400 fab fa-instagram "></i>
                               <span class="capitalize">instagram</span>
                            </a>
                            @endif
                        </p>
                    </div>
                       <!-- if file exists in database -->
                    @if ($seller->file)
                    @php
                        $file       = storage_path('app\files\\') . $seller->file;
                    @endphp
                        <!-- if file exists in storge -->
                        @if (file_exists($file))
                            <div class="download-file">
                                <div class="my-10">
                                    <div class="">
                                            <div class="py-10 text-3xl font-bold capitalize">@lang('file with more information about me')</div>
                                            <a class="btn btn-primary" href="/download/{{$seller->id}}"> @lang('Download File') </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <!-- Seller parts -->
            <div class="mb-40 col-md-8 col-xs-12">
                <!-- Favorite part session -->
                @if(session()->has('deleted'))
                  <div class="m-4 text-center text-gray-100 bg-blue-900 alert">
                    <p>{{ session('deleted') }} <br> <a class="text-yellow-400" href="{{url('favorite')}}">@lang('See Your Favorite Parts')</a> </p>
                 </div>
                @endif
                @if(session()->has('added'))
                    <div class="m-4 text-center text-gray-100 bg-blue-900 alert">
                        <p>{{ session('added') }} <br>  <a class="text-yellow-400" href="{{url('favorite')}}">@lang('See Your Favorite Parts')</a></p>
                    </div>
                @endif
                <div class="right-section">
                    @if ($parts->count())
                        <div class="featured-cars row">
                            <x-part :parts="$parts" :makeCol="6"></x-part>
                        </div>
                        <div class="mt-20 text-center">
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
