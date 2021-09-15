@extends('website.layouts.app')

@section('css')
    <style>
        .car-details #car-details-slider img , .One_image img{
            min-height: 360px;
            max-height: 360px;
            margin-top: 36px;
            margin-bottom: 55px;
        }
        .featured-cars .details .fuel , .featured-cars .details .door{
            width: 50%;
        }
        .featured-cars .item img{
            min-height: 200px;
            max-height: 200px;
            border: 1px solid #ccc;
        }
        .RelatedPartsDesc {
            min-height: 100px;
            max-height: 100px;
            display: -webkit-box;
            overflow : hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
        .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    display: contents;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
    </style>
@endsection

@section('website')
<section class="section white">
			<div class="inner">
				<div class="container">
					<div class="car-details">
						<div class="row">
							<div class="col-sm-8">
								<div class="clearfix">
									<div class="title">{{ $part->name }} <span>[ {{ $part->part_number }} ]</span></div>
									<div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
								</div>
                                @if ($part->images->count() == 1 )
                                <div class="One_image">
                                  <div class="item"><img src="{{find_image($part->FirstImage->image , 'img/PartImgs/')}}" alt="{{ $part->images[0]->image->name }}" class="img-responsive"></div>
                                </div>
                                @else
                                <div id="car-details-slider" class="responsive">
                                    @foreach ($part->images as $image)
                                    <div class="item"><img src="{{find_image($image->image , 'img/PartImgs/')}}" alt="{{ $image->image->name }}" class="img-responsive"></div>
                                    @endforeach
								</div>
                                @endif

								<div class="border tabpanel" role="tabpanel" id="goToReview">
									<ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#heading-tab4" aria-controls="heading-tab4" role="tab" data-toggle="tab">@lang('Description')</a></li>
										<li role="presentation"><a href="#heading-tab5" aria-controls="heading-tab5" role="tab" data-toggle="tab">@lang('Reviews')</a></li>
                                        <li role="presentation"><a href="#heading-tab6" aria-controls="heading-tab6" role="tab" data-toggle="tab">@lang('Add review')</a></li>
									</ul> <!-- end .nav-tabs -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="heading-tab4">
											<p>{{ LangDetail($part->desc,$part->desc_ar) }}</p>
										</div>

                                         <!-- show review -->
										<div role="tabpanel" class="tab-pane fade" id="heading-tab5">
											<p>
                                        <!-- if there no reviews -->
                                        @if (!$partReview)
                                            <span>
                                                @lang('Sorry, No currently reviews to show but you can add your own')
                                            </span>
                                        @else
                                       <!-- Show reviews -->
                                        @foreach ($reviews as $review)
                                                <!-- Review message -->
                                            @if(session()->has('review'))
                                                    <div class="m-4 alert alert-success ">
                                                        <p>{{ session('review') }}</p>
                                                    </div>
                                            @endif
                                            <!-- End message -->
                                        <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="relative inline-block">
                                            <div class="relative w-16 h-16 overflow-hidden rounded-full">
                                                <img class="absolute top-0 left-0 object-cover w-full h-full bg-cover object-fit" src="https://w7.pngwing.com/pngs/754/2/png-transparent-samsung-galaxy-a8-a8-user-login-telephone-avatar-pawn-blue-angle-sphere.png" alt="Profile picture">
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
                                           </p>
										</div> <!-- end .tab-panel -->

                                        <!-- If user added review -->
                                        <!-- Add review -->
                                        <div role="tabpanel" class="tab-pane fade" id="heading-tab6">
                                        <p>
                                        @if ($hasReview)
                                        <span>
                                           @lang('You reviewed this part already!')
                                        </span>
                                        @else
                                        <!-- Add review to the part -->
                                        <form action="{{route('Website.SendReview',$part->id)}}" method="POST">
                                            @csrf
                                        <div class="m-5 text-2xl font-bold text-center text-gray-800 heading">Type your review</div>
                                        <div class="comment-form-rating">
                                            <h5 class="mb-10">Your rating</h5>
                                            <div class="rate">
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
                                            @if ($errors->has('rating'))
                                                <div class="py-5 text-red-400 fv-plugins-message-container">
                                                    <div class="fv-help-block">
                                                        <strong>{{ $errors->first('rating')  }}</strong>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-gray-800 border border-gray-100 shadow-sm">
                                            <input class="p-2 mb-4 bg-gray-100 border border-gray-300 outline-none title" spellcheck="false" placeholder="Title" name="title" type="text">
                                            @if ($errors->has('title'))
                                                <div class="py-5 text-red-400 fv-plugins-message-container">
                                                    <div class="fv-help-block">
                                                        <strong>{{ $errors->first('title')  }}</strong>
                                                    </div>
                                                </div>
                                            @endif
                                            <textarea class="p-3 bg-gray-100 border border-gray-300 outline-none description sec h-60" spellcheck="false" name="review" placeholder="Describe everything about this post here"></textarea>
                                            @if ($errors->has('review'))
                                                <div class="py-5 text-red-400 fv-plugins-message-container">
                                                    <div class="fv-help-block">
                                                        <strong>{{ $errors->first('review')  }}</strong>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- buttons -->
                                            <div class="flex py-2 buttons">
                                            <div class="p-1 px-4 ml-auto font-semibold text-gray-500 border border-gray-300 cursor-pointer btn">Cancel</div>
                                            <button type="submit" class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">Add Review</button>
                                            </div>
                                        </div>
                                        @endif <!-- End  user reviewed this part -->
                                        </form>
                                        </p>
										</div> <!-- end .tab-panel -->

									</div> <!-- end .tab-content -->
								</div> <!-- end .tabpanel -->
                                </div> <!-- end .col-sm-8 -->
                             </div> <!-- End of left section -->
                                <!-- Right section -->
							<div class="mt-10 col-sm-4">
								<div class="price"> {{ $part->price }} L.E <span>/ for sale</span></div>
								<div class="main-car-details">
									<div class="clearfix item">
										<div class="option">Year</div>
										<div class="option-content"> {{ $part->car->year->year }} </div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Make</div>
										<div class="option-content">{{ $part->car->make->name }}</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Model</div>
										<div class="option-content">{{ $part->car->model->name }}</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Capacities</div>
										<div class="option-content">{{ $part->car->capacity->capacity }}</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">@lang('Seller')</div>
										<div class="option-content"> {{ $part->user->FullName }} </div>
									</div> <!-- end .item -->

									<div class="clearfix item">
										<div class="option">@lang('Part number')</div>
										<div class="option-content">{{$part->part_number}}</div>
									</div> <!-- end .item -->
								</div> <!-- end .main-car-details -->
							</div> <!-- end .col-sm-4 -->
						</div> <!-- end .row -->
					</div> <!-- end .car-details -->
                    </div> <!-- end .container -->
			</div> <!-- end .inner -->
                          <!-- ----------------------    Related Parts  ------------------------------ -->
       <hr>
		<section class="section white">
			<div class="py-0 my-0 inner">
				<h1 class="main-heading">Related Parts<small>Similar Parts</small></h1>
				<div id="featured-cars" class="owl-carousel featured-cars">
                    <!-- Reated Parts -->
                    @foreach ($RelatedParts as $RelatedPart)
                    <div class="item">
						<div class="featured-car">
							<div class="image">
								<a href="{{ route('Website.ShowPart',$RelatedPart->id) }}"><img src="{{find_image($RelatedPart->FirstImage->image , 'img/PartImgs/')}}" alt="{{ $RelatedPart->FirstImage->image->name }}" class="img-responsive"></a>
							</div> <!-- end .image -->
							<div class="content">
								<div class="clearfix">
									<h5><a href="{{ route('Website.ShowPart',$RelatedPart->id) }}"> {{ LangDetail($RelatedPart->name,$RelatedPart->name_ar) }} </a></h5>
									<span class="price">{{ $RelatedPart->price }} @lang('L.E')</span>
								</div> <!-- end .clearfix -->
								<div class="line"></div>
								<p class="RelatedPartsDesc">{{ LangDetail($RelatedPart->desc,$RelatedPart->desc_ar) }}</p>
							</div> <!-- end .content -->
							<div class="clearfix details">
								<div class="fuel"><i class="fas fa-car"></i> {{$RelatedPart->car->make->name }} </div>
								<div class="type"><i class="icon-car-door"></i> {{$RelatedPart->car->model->name }} </div>
							</div> <!-- end .details -->
						</div> <!-- end .featured-car -->
					</div> <!-- end .item -->
                    @endforeach

                    @foreach ($RelatedModelParts as $RelatedPart )
                    <div class="item">
						<div class="featured-car">
							<div class="image">
								<a href="{{ route('Website.ShowPart',$RelatedPart->id) }}"><img src="{{find_image($RelatedPart->FirstImage->image , 'img/PartImgs/')}}" alt="{{ $RelatedPart->FirstImage->image->name }}" class="img-responsive"></a>
							</div> <!-- end .image -->
							<div class="content">
								<div class="clearfix">
									<h5><a href="{{ route('Website.ShowPart',$RelatedPart->id) }}"> {{ LangDetail($RelatedPart->name,$RelatedPart->name_ar) }} </a></h5>
									<span class="price">{{ $RelatedPart->price }} @lang('L.E')</span>
								</div> <!-- end .clearfix -->
								<div class="line"></div>
								<p class="RelatedPartsDesc">{{ LangDetail($RelatedPart->desc,$RelatedPart->desc_ar) }}</p>
							</div> <!-- end .content -->
							<div class="clearfix details">
								<div class="fuel"><i class="fas fa-car"></i> {{$RelatedPart->car->make->name }} </div>
								<div class="type"><i class="icon-car-door"></i> {{$RelatedPart->car->model->name }} </div>
							</div> <!-- end .details -->
						</div> <!-- end .featured-car -->
					</div> <!-- end .item -->
                    @endforeach


				</div> <!-- end .featured-cars -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->


		</section> <!-- end .section -->
@endsection
