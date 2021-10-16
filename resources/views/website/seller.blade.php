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
            <div class="col-md-4 col-xs-12 sm:mb-12">
                <div class="p-10 mb-20 left-section left-bar">
                    <div class="car-details">
                        <div class="rating">
                            {{  SellerTotalRating($seller->id) }}
                        </div>
                    </div>
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
                    <!-- Rate Seller -->
                    <div class="mt-14 rate-me">
                        <div class="pb-10 text-4xl font-bold">@lang('Rate me') </div>
                        <!-- Show reviews -->
                        @if(session()->has('review'))
                            <div class="m-4 alert alert-success ">
                                <p>{{ session('review') }}</p>
                            </div>
                        @endif
                        <!-- Not logged in -->
                        @if (!auth::check())
                        <div class="my-10 text-center">
                            <span>
                                <a href="{{ route('login') }}" class="text-primary">@lang('Please login')</a> @lang('to add your review')
                            </span>
                        </div>
                        @elseif ($review)
                            <span>
                                @lang('You reviewed this part already!')😉
                            </span>
                        @else
                        <form action="{{route('Website.RateSeller',$seller->id)}}" method="POST">
                        @csrf
                         <div class="rating-holder">
                         @if ($errors->any())
                            <div class="py-5 mt-10 text-red-400 fv-plugins-message-container">
                                <div class="fv-help-block">
                                    <strong>{{ $errors->first('rating')  }}</strong>
                                </div>
                            </div>
                        @endif
                            <div class="w-full rate">
                                <input type="radio" id="star5" name="rating" value="5" />
                                <label for="star5" title="Very good">5 stars</label>
                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" title="Good">4 stars</label>
                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" title="Nice">3 stars</label>
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" title="Bad">2 stars</label>
                                <input type="radio" id="star1" name="rating" value="1" />
                                <label for="star1" title="Very bad">1 star</label>
                            </div>
                        </div>
                        <!-- Description review -->
                        <textarea class="p-3 bg-gray-100 border border-gray-300 outline-none description sec h-60 form-control"
                            spellcheck="false" name="review" placeholder="@lang('Describe what you think about this part')" rows="10"></textarea>
                          @if ($errors->has('review'))
                            <div class="py-5 text-red-400 fv-plugins-message-container">
                                <div class="fv-help-block">
                                    <strong>{{ $errors->first('review')  }}</strong>
                                </div>
                            </div>
                        @endif
                        <div class="flex py-2 my-4 buttons">
                            <button type="button" onclick="this.form.reset();" class="p-1 px-4 ml-auto font-semibold text-gray-500 border border-gray-300 cursor-pointer btn">@lang('Cancel')</button>
                            <button type="submit" class="p-2 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">@lang('Add Review')</button>
                        </div>
                        <!-- Form End -->
                        </form>
                        @endif
                    </div>
                   <!-- end section -->
                </div>
                <!-- Show all review -->
                <div class="my-10 sm:p-4">
                    <div class="mt-12 reviews">
                       <div class="text-4xl font-bold">@lang('Reviews') </div>
                       @foreach ($UsersReviews as $review)
                       <!-- Card Review -->
                       <div class="my-10">
                            <hr class="my-5">
                            <p class="flex items-baseline">
                            <span class="font-bold text-gray-600"> {{ $review->user->FullName }} </span>
                            </p>
                            <p class="flex items-baseline">
                            <span class="text-lg text-gray-900 opacity-50 ">
                            {{\carbon\carbon::parse($review->created_at)->format('M d, Y')  }}</span>
                            </p>
                                <!-- Rating Stars -->
                                <div class="flex items-center mt-1">
                                @for ($i = 0; $i < 5; $i++)
                                @if ($i < $review->rating)
                                <svg class="w-4 h-4 text-yellow-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                @else
                                <svg class="w-4 h-4 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                @endif
                                @endfor
                                </div>
                            <div class="flex items-center mt-4 text-gray-600">
                            </div>
                            <div class="mt-3">
                                <p class="mt-1"> {{ $review->review }} </p>
                            </div>
                       </div>
                    @endforeach
                        <!-- paginate -->
                        <div class="mt-20 text-center">
                                {{ $UsersReviews->links("pagination::bootstrap-4") }}
                        </div>
                    </div>
                   <!-- end section -->
                </div>
            </div>
            <!-- new section -->
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
