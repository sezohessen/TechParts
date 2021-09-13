@extends('website.layouts.app')
namespace App;
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
								<div id="car-details-slider" class="image">
									<div class="item"><img src="{{asset('img/website/details.jpg')}}" alt="alt" class="img-responsive"></div>
									<div class="item"><img src="{{asset('img/website/details.jpg')}}" alt="alt" class="img-responsive"></div>
									<div class="item"><img src="{{asset('img/website/details.jpg')}}" alt="alt" class="img-responsive"></div>
								</div>
								<div class="border tabpanel" role="tabpanel">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#heading-tab4" aria-controls="heading-tab4" role="tab" data-toggle="tab">@lang('Description')</a></li>
										<li role="presentation"><a href="#heading-tab5" aria-controls="heading-tab5" role="tab" data-toggle="tab">@lang('Reviews')</a></li>
										<li role="presentation"><a href="#heading-tab6" aria-controls="heading-tab6" role="tab" data-toggle="tab">@lang('Add review')</a></li>
									</ul> <!-- end .nav-tabs -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="heading-tab4">
											<p>{{$part->desc}}</p>

										</div> <!-- show review -->
										<div role="tabpanel" class="tab-pane fade" id="heading-tab5">
											<p>
                                       <!-- component -->
                                        <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="relative inline-block">
                                            <div class="relative w-16 h-16 overflow-hidden rounded-full">
                                                <img class="absolute top-0 left-0 object-cover w-full h-full bg-cover object-fit" src="https://picsum.photos/id/646/200/200" alt="Profile picture">
                                                <div class="absolute top-0 left-0 w-full h-full rounded-full shadow-inner"></div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="ml-6">
                                            <p class="flex items-baseline">
                                            <span class="font-bold text-gray-600">Mary T.</span>
                                            </p>
                                            <p class="flex items-baseline">
                                            <span class="text-lg text-gray-900 opacity-50 ">2018-6-4</span>
                                            </p>
                                            <div class="flex items-center mt-1">
                                            <svg class="w-4 h-4 text-yellow-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            <svg class="w-4 h-4 text-yellow-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            <svg class="w-4 h-4 text-yellow-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            <svg class="w-4 h-4 text-yellow-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            <svg class="w-4 h-4 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            </div>
                                            <div class="flex items-center mt-4 text-gray-600">
                                            </div>
                                            <div class="mt-3">
                                            <span class="font-bold">Title</span>
                                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                            </div>
                                        </div>
                                        </div>
                                           </p>
										</div> <!-- end .tab-panel -->
                                        <!-- Add review -->
										<div role="tabpanel" class="tab-pane fade" id="heading-tab6">
                                        <!-- component -->
                            <div class="m-5 text-2xl font-bold text-center text-gray-800 heading">Type your review</div>
                            <div class="flex flex-col w-10/12 max-w-2xl p-4 mx-auto text-gray-800 border border-gray-300 shadow-lg editor">
                                <input class="p-2 mb-4 bg-gray-100 border border-gray-300 outline-none title" spellcheck="false" placeholder="Title" type="text">
                                <textarea class="p-3 bg-gray-100 border border-gray-300 outline-none description sec h-60" spellcheck="false" placeholder="Describe everything about this post here"></textarea>

                                <!-- buttons -->
                                <div class="flex py-2 buttons">
                                <div class="p-1 px-4 ml-auto font-semibold text-gray-500 border border-gray-300 cursor-pointer btn">Cancel</div>
                                <div class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">Add Review</div>
                                </div>
                            </div>
										</div> <!-- end .tab-panel -->
									</div> <!-- end .tab-content -->
								</div> <!-- end .tabpanel -->
							</div> <!-- end .col-sm-8 -->
							<div class="col-sm-4">
								<div class="buttons">
									<a href="#" class="border button dark">Download Manual</a>
									<a href="#" class="border button blue">Schedule A Test Drive</a>
								</div>
								<div class="price"> {{ $part->price }} L.E <span>/ for sale</span></div>
								<div class="main-car-details">
									<div class="clearfix item">
										<div class="option">Year</div>
										<div class="option-content"> {{ $car[0]->Car->CarYear_id }} </div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Make</div>
										<div class="option-content">{{ $car[0]->Car->CarMaker_id }}</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Model</div>
										<div class="option-content">{{ $car[0]->Car->CarModel_id }}</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Capacities</div>
										<div class="option-content">{{ $car[0]->Car->CarCapacity_id }}</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">@lang('Seller')</div>
										<div class="option-content">{{ $user[0]->name }}</div>
									</div> <!-- end .item -->

									<div class="clearfix item">
										<div class="option">@lang('Part number')</div>
										<div class="option-content">{{$part->price}}</div>
									</div> <!-- end .item -->
								</div> <!-- end .main-car-details -->
							</div> <!-- end .col-sm-4 -->
						</div> <!-- end .row -->
					</div> <!-- end .car-details -->
                    </div> <!-- end .container -->
			</div> <!-- end .inner -->
       <!-- Start Featerd Parts Deals -->
       <hr>
		<section class="section white">
			<div class="py-0 my-0 inner">
				<h1 class="main-heading">Related Parts<small>Best Parts Deals</small></h1>
				<div id="featured-cars" class="owl-carousel featured-cars">
					<div class="item">
						<div class="featured-car">
							<div class="image">
								<a href="#"><img src="{{asset('img/website/featured-car01.jpg')}}" alt="car" class="img-responsive"></a>
								<span class="sale-tag">For Sale</span>
							</div> <!-- end .image -->
							<div class="content">
								<div class="clearfix">
									<h5><a href="#">Range Rover</a></h5>
									<span class="price">$80,000</span>
								</div> <!-- end .clearfix -->
								<div class="line"></div>
								<p>Nam liber tempor cum soluta nobis eleife option congue nihil...</p>
							</div> <!-- end .content -->
							<div class="clearfix details">
								<div class="seats"><i class="icon-car-seat"></i>4</div>
								<div class="fuel"><i class="icon-car-fuel"></i>Petrol</div>
								<div class="type"><i class="icon-car-door"></i>Sport</div>
							</div> <!-- end .details -->
						</div> <!-- end .featured-car -->
					</div> <!-- end .item -->
					<div class="item">
						<div class="featured-car">
							<div class="image">
								<a href="#"><img src="{{asset('img/website/featured-car02.jpg')}}" alt="car" class="img-responsive"></a>
								<span class="sale-tag">For Sale</span>
							</div> <!-- end .image -->
							<div class="content">
								<div class="clearfix">
									<h5><a href="#">Porsche</a></h5>
									<span class="price">$80,000</span>
								</div> <!-- end .clearfix -->
								<div class="line"></div>
								<p>Nam liber tempor cum soluta nobis eleife option congue nihil...</p>
							</div> <!-- end .content -->
							<div class="clearfix details">
								<div class="seats"><i class="icon-car-seat"></i>4</div>
								<div class="fuel"><i class="icon-car-fuel"></i>Petrol</div>
								<div class="type"><i class="icon-car-door"></i>Sport</div>
							</div> <!-- end .details -->
						</div> <!-- end .featured-car -->
					</div> <!-- end .item -->
					<div class="item">
						<div class="featured-car">
							<div class="image">
								<a href="#"><img src="{{asset('img/website/featured-car03.jpg')}}" alt="car" class="img-responsive"></a>
								<span class="sale-tag green">For Rent</span>
							</div> <!-- end .image -->
							<div class="content">
								<div class="clearfix">
									<h5><a href="#">Mercediz Benz</a></h5>
									<span class="price">$10 / km</span>
								</div> <!-- end .clearfix -->
								<div class="line"></div>
								<p>Nam liber tempor cum soluta nobis eleife option congue nihil...</p>
							</div> <!-- end .content -->
							<div class="clearfix details">
								<div class="seats"><i class="icon-car-seat"></i>4</div>
								<div class="fuel"><i class="icon-car-fuel"></i>Petrol</div>
								<div class="type"><i class="icon-car-door"></i>Sport</div>
							</div> <!-- end .details -->
						</div> <!-- end .featured-car -->
					</div> <!-- end .item -->
					<div class="item">
						<div class="featured-car">
							<div class="image">
								<a href="#"><img src="{{asset('img/website/featured-car01.jpg')}}" alt="car" class="img-responsive"></a>
								<span class="sale-tag">For Sale</span>
							</div> <!-- end .image -->
							<div class="content">
								<div class="clearfix">
									<h5><a href="#">Range Rover</a></h5>
									<span class="price">$80,000</span>
								</div> <!-- end .clearfix -->
								<div class="line"></div>
								<p>Nam liber tempor cum soluta nobis eleife option congue nihil...</p>
							</div> <!-- end .content -->
							<div class="clearfix details">
								<div class="seats"><i class="icon-car-seat"></i>4</div>
								<div class="fuel"><i class="icon-car-fuel"></i>Petrol</div>
								<div class="type"><i class="icon-car-door"></i>Sport</div>
							</div> <!-- end .details -->
						</div> <!-- end .featured-car -->
					</div> <!-- end .item -->
					<div class="item">
						<div class="featured-car">
							<div class="image">
								<a href="#"><img src="{{asset('img/website/featured-car02.jpg')}}" alt="car" class="img-responsive"></a>
								<span class="sale-tag">For Sale</span>
							</div> <!-- end .image -->
							<div class="content">
								<div class="clearfix">
									<h5><a href="#">Porsche</a></h5>
									<span class="price">$80,000</span>
								</div> <!-- end .clearfix -->
								<div class="line"></div>
								<p>Nam liber tempor cum soluta nobis eleife option congue nihil...</p>
							</div> <!-- end .content -->
							<div class="clearfix details">
								<div class="seats"><i class="icon-car-seat"></i>4</div>
								<div class="fuel"><i class="icon-car-fuel"></i>Petrol</div>
								<div class="type"><i class="icon-car-door"></i>Sport</div>
							</div> <!-- end .details -->
						</div> <!-- end .featured-car -->
					</div> <!-- end .item -->
				</div> <!-- end .featured-cars -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->


		</section> <!-- end .section -->
@endsection
