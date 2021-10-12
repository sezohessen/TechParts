@extends('website.layouts.app')

@section('css')
<link href="{{ asset('css/website/css/part.css') }}" rel="stylesheet">
@endsection
@section('js')

@if(session('review') || $errors->any() )
    <script>
        window.location="#goToReview";
    </script>
@endif

@endsection
@section('website')
<section class="section white" id="Part-Page">
        <div class="inner">
            <div class="container">
                @if(session()->has('Exist'))
                    <div class="m-4 text-center text-gray-100 bg-red-500 alert show" role="alert">
                        <p>{{ session('Exist') }}</p>
                    </div>
                @endif
                <div class="car-details">
                    <div class="mt-20 row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="clearfix">
                                <div class="title sm:pb-5">{{ LangDetail($part->name,$part->name_ar) }}
                                    <span class="sm:block sm:py-4">
                                        @if ($part->part_number)
                                        [ {{ $part->part_number }} ]
                                        @endif
                                    </span>
                                </div>
                                <!-- IF there is no reviews -->
                                @if (NoReview($part->id))
                                <div class="rating">
                                   <span class="p-4 text-gray-100 bg-blue-400 rounded-2xl">@lang('No rating yet')
                                        <i class="fas fa-circle-notch fa-spin"></i></span>
                                </div>
                                @else
                                <!-- Tottal Rating -->
                                <div class="rating">
                                    {{  TotalRating($part->id) }}
                                </div>
                                @endif

                            </div>
                            @if ($part->images->count() == 1 )
                            <div class="One_image">
                                <div class="item"><img src="{{find_image($part->FirstImage->image , App\Models\Part::base)}}" alt="{{ $part->FirstImage->image->name }}" class="img-responsive"></div>
                            </div>
                            @else
                            <div id="car-details-slider" class="responsive">
                                @foreach ($part->images as $image)
                                <div class="item"><img src="{{find_image($image->image , App\Models\Part::base)}}" alt="{{ $image->image->name }}" class="img-responsive"></div>
                                @endforeach
                            </div>
                            @endif
                        </div> <!-- end .col-sm-8 -->
                            <!-- Right section -->
                        <div class="mt-10 col-sm-4 col-xs-12">
                            @if ($part->price)
                               <div class="price"> {{ $part->price }} @lang('L.E') <span></span></div>
                            @else
                                <div class="price">
                                <h4 class="text-2xl font-bold text-center"> @lang('Price is negotiable')
                                <i class="fas fa-hand-holding-usd"></i></h4> </div>
                            @endif
                            <div class="main-car-details">
                                <div class="clearfix item">
                                    <div class="option"> @lang('Year') </div>
                                    <div class="option-content"> {{ $part->car->year->year }} </div>
                                </div> <!-- end .item -->
                                <div class="clearfix item">
                                    <div class="option"> @lang("Manufacture") </div>
                                    <div class="option-content">{{ $part->car->make->name }}</div>
                                </div> <!-- end .item -->
                                <div class="clearfix item">
                                    <div class="option"> @lang('Model') </div>
                                    <div class="option-content">{{ $part->car->model->name }}</div>
                                </div> <!-- end .item -->
                                <div class="clearfix item">
                                    <div class="option"> @lang('Engine Capacity') </div>
                                    <div class="option-content">{{ $part->car->capacity->capacity }}</div>
                                </div> <!-- end .item -->
                                <div class="clearfix item">
                                    <div class="option">@lang('Seller')</div>
                                    <div class="option-content">

                                        <a href="{{ route('Website.SellerProfile',['id'=>$part->user_id,'first'=>$part->user->first_name,'second'=>$part->user->last_name]) }}">
                                             {{ $part->user->FullName }}
                                        </a>
                                    </div>
                                </div> <!-- end .item -->
                                @if ($part->in_stock)
                                <div class="clearfix item">
                                    <div class="option">@lang('In stock')</div>
                                          <div class="option-content">{{$part->in_stock}}</div>
                                </div> <!-- end .item -->
                                @endif
                                <!-- if there is a part number  -->
                                @if ($part->part_number)
                                <div class="clearfix item">
                                    <div class="option">@lang('Part number')</div>
                                    <div class="option-content">{{$part->part_number}}</div>
                                </div> <!-- end .item -->
                                @endif
                                @if ($part->seller->city_id)
                                <div class="clearfix item">
                                    <div class="option">@lang('City')</div>
                                    <div class="option-content">{{ Langdetail($part->seller->city->title,$part->seller->city->title_ar) }}</div>
                                </div> <!-- end .item -->
                                @endif
                                <!-- Add to favorite buttin -->
                                @if (Auth::check())
                                    @if (App\Models\UserFav::where('user_id', Auth()->user()->id)->where('part_id', $part->id)->first() == false)
                                    <div class="clearfix mt-10 item">
                                        <div class="option-content">
                                        <div class="p-2 font-bold text-center text-gray-100 bg-blue-500 rounded-lg">
                                        <!-- Add part to favorite -->
                                            <form method="POST" action="{{route('Website.storeFav',$part->id)}}">
                                                @csrf
                                                <Button class="text-lg uppercase" type="submit">
                                                    @lang('Add it to your favorite')
                                                    <i class="fas fa-hand-holding-heart"></i>
                                                </Button>
                                            </form>
                                        </div>
                                        </div>
                                    </div> <!-- end .item -->
                                    @endif
                                @else
                                <div class="clearfix mt-10 item">
                                        <div class="option-content">
                                           <div class="p-2 font-bold text-center bg-blue-500 rounded-lg">
                                                <a id="add-to-favorite-login" href="{{route('login')}}" class="text-lg uppercase">
                                                    @lang('Add it to your favorite')
                                                    <i class="fas fa-hand-holding-heart"></i>
                                                </a>
                                           </div>
                                        </div>
                                    </div> <!-- end .item -->
                                @endif

                            </div> <!-- end .main-car-details -->
                        </div> <!-- end .col-sm-4 -->
                    </div> <!-- end .row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="my-20 border tabpanel" role="tabpanel" id="goToReview">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="{{(session('review') || $errors->any()  ) ? '' : 'active' }}"><a href="#heading-tab4" aria-controls="heading-tab4" role="tab" data-toggle="tab">@lang('Description')</a></li>
                                    <li role="presentation" class="{{session('review') ? 'active' : '' }}">
                                        <a href="#heading-tab5" aria-controls="heading-tab5" role="tab" data-toggle="tab">
                                            @lang('Reviews') ({{ $reviewCount }})
                                        </a>
                                    </li>
                                    <li class="{{$errors->any() ? 'active' : '' }}" role="presentation"><a href="#heading-tab6" aria-controls="heading-tab6" role="tab" data-toggle="tab">@lang('Add review')  </a></li>
                                </ul> <!-- end .nav-tabs -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in {{(session('review') || $errors->any()) ? '' : 'active in' }}" id="heading-tab4">
                                        <p>{!! LangDetail($part->desc,$part->desc_ar) !!}</p>
                                    </div>

                                        <!-- show review -->
                                    <div role="tabpanel" class="tab-pane fade {{session('review') ? 'active in' : '' }}" id="heading-tab5">
                                        <!-- if there no reviews -->
                                        @if (!$partReview)
                                            <span>
                                                @lang('Sorry, No currently reviews to show but you can add your own')
                                            </span>
                                        @else
                                        <!-- Show reviews -->
                                            @if(session()->has('review'))
                                                <div class="m-4 alert alert-success ">
                                                    <p>{{ session('review') }}</p>
                                                </div>
                                            @endif
                                            @foreach ($reviews as $review)
                                                <!-- Review message -->
                                                <!-- End message -->
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        <div class="relative inline-block">
                                                        <div  id="Review-avatar" class="relative w-16 h-16 overflow-hidden rounded-full">
                                                            <img  class="absolute top-0 left-0 object-cover w-full h-full bg-cover object-fit" src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere.png" alt="Profile picture">
                                                            <div class="absolute top-0 left-0 w-full h-full rounded-full shadow-inner"></div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-6">
                                                        <p class="flex items-baseline">
                                                        <span class="font-bold text-gray-600">{{ $review->user->FullName }}</span>
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
                                                        <span class="my-4 font-bold">{{ $review->title }}</span>
                                                        <p class="mt-1">{{ $review->review }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="my-10 bg-gray-200">
                                            @endforeach
                                        @endif
                                    </div> <!-- end .tab-panel -->

                                    <!-- If user added review -->
                                    <!-- Add review -->
                                    <div role="tabpanel" class="tab-pane fade {{$errors->any() ? 'active in' : '' }}" id="heading-tab6">
                                        @if ($hasReview== App\Models\Review::HasReview)
                                            <span>
                                                @lang('You reviewed this part already!')😉
                                            </span>
                                        @elseif($hasReview == App\Models\Review::NotLogin)
                                            <div class="my-10 text-center">
                                                <span>
                                                    <a href="{{ route('login') }}" class="text-primary">@lang('Please login')</a> @lang('to add your review')
                                                </span>
                                            </div>
                                        @else
                                            <!-- Add review to the part -->
                                            <form action="{{route('Website.SendReview',$part->id)}}" method="POST">
                                                @csrf
                                            <div class="m-5 text-2xl font-bold text-center text-gray-800 heading">@lang('Type your review')</div>
                                            <div class="comment-form-rating">
                                                <h5 class="mb-10 sm:hidden">@lang('Your rating')</h5>
                                                <div class="rating-holder">
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
                                                @if ($errors->any())
                                                    <div class="py-5 mt-10 text-red-400 fv-plugins-message-container">
                                                        <div class="fv-help-block">
                                                            <strong>{{ $errors->first('rating')  }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-gray-800">
                                                <input id="add-review-title" class="p-2 mb-4 text-2xl bg-gray-100 border border-gray-300 outline-none title form-control"
                                                spellcheck="false" placeholder="@lang('Title')" name="title" type="text">
                                                @if ($errors->has('title'))
                                                    <div class="py-5 text-red-400 fv-plugins-message-container">
                                                        <div class="fv-help-block">
                                                            <strong>{{ $errors->first('title')  }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                                <textarea class="p-3 bg-gray-100 border border-gray-300 outline-none description sec h-60 form-control"
                                                 spellcheck="false" name="review" placeholder="@lang('Describe what you think about this part')" rows="10"></textarea>
                                                @if ($errors->has('review'))
                                                    <div class="py-5 text-red-400 fv-plugins-message-container">
                                                        <div class="fv-help-block">
                                                            <strong>{{ $errors->first('review')  }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                                <!-- buttons -->
                                                <div class="flex py-2 buttons">
                                                <button type="button" onclick="this.form.reset();" class="p-1 px-4 ml-auto font-semibold text-gray-500 border border-gray-300 cursor-pointer btn">@lang('Cancel')</button>
                                                <button type="submit" class="p-2 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">@lang('Add Review')</button>
                                                </div>
                                            </div>
                                        <!-- End  user reviewed this part -->
                                            </form>
                                        @endif
                                    </div> <!-- end .tab-panel -->
                                </div> <!-- end .tab-content -->
                            </div> <!-- end .tabpanel -->
                        </div>
                    </div>
                </div> <!-- end .car-details -->
            </div> <!-- end .container -->
        </div> <!-- end .inner -->
</section>             <!-- ----------------------    Related Parts  ------------------------------ -->
<hr>
    @if ($RelatedModelParts->count() == 0)
    @else
    <section class="section white">
        <div class="py-0 my-0 inner">
            <h1 class="main-heading">@lang('Related Parts')<small>@lang('Similar Parts')</small></h1>
            <div id="featured-cars" class="owl-carousel featured-cars">
                <x-part :parts="$RelatedModelParts" :makeCol="0" :fav="0"/>
            </div> <!-- end .featured-cars -->
        </div> <!-- end .inner -->
    </section> <!-- end .section -->
    @endif
@endsection

