@extends('website.layouts.app')
@section('website')
<div class="responsive-menu">
			<a href="#" class="responsive-menu-close"><i class="ion-android-close"></i></a>
			<nav class="responsive-nav"></nav> <!-- end .responsive-nav -->
		</div> <!-- end .responsive-menu -->

		<div class="flexslider welcome">
			<div class="slides">
				<div class="slide" style="background-image: url('img/website/background01.jpg');">
					<div class="inner">
						<div class="container">
							<div class="banner-wrapper">
								<div class="banner">
									<div class="before">$480000</div>
									Top Cars: Mercedes S Class
								</div> <!-- end .banner -->
							</div> <!-- end .banner-wrapper -->
							<a href="details.html" class="border button white xsmall">Know More</a>
						</div> <!-- end .container -->
					</div> <!-- end .inner -->
				</div> <!-- end .slide -->
				<div class="slide" style="background-image: url('img/website/background02.jpg');">
					<div class="inner">
						<div class="container">
							<div class="banner-wrapper">
								<div class="banner big light">
									Top Cars: Mercedes S Class
									<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem eriam, eaque ipsa quae ab illo inventore veritatis..</p>
								</div> <!-- end .banner -->
							</div> <!-- end .banner-wrapper -->
							<a href="details.html" class="button solid blue xsmall">Know More</a>
						</div> <!-- end .container -->
					</div> <!-- end .inner -->
				</div> <!-- end .slide -->
				<div class="slide" style="background-image: url('img/website/background01.jpg');">
					<div class="inner">
						<div class="container">
							<div class="banner-wrapper">
								<div class="banner big">
									<div class="before">$480000</div>
									Top Cars: Mercedes S Class
									<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem eriam, eaque ipsa quae ab illo inventore veritatis..</p>
								</div> <!-- end .banner -->
							</div> <!-- end .banner-wrapper -->
							<a href="details.html" class="button solid white xsmall">Know More</a>
						</div> <!-- end .container -->
					</div> <!-- end .inner -->
				</div> <!-- end .slide -->
			</div> <!-- end .slides -->
		</div> <!-- end .welcome -->

		<section class="section dark tiny">
			<div class="inner">
				<div class="container">
					<div class="border tabpanel section-tab" role="tabpanel">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#search-cars" aria-controls="search-cars" role="tab" data-toggle="tab">Search Cars</a></li>
							<li role="presentation"><a href="#sell-car" aria-controls="sell-car" role="tab" data-toggle="tab">Sell Car</a></li>
						</ul> <!-- end .nav-tabs -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="search-cars">
								<form action="#" method="post" class="banner-form">
									<div class="item">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Select Brand</option>
												<option>Brand 1</option>
												<option>Brand 2</option>
											</select>

										</div> <!-- end .select-wrapper -->
									</div> <!-- end .item -->
									<div class="item">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Select Model</option>
												<option>Model 1</option>
												<option>Model 2</option>
											</select>

										</div> <!-- end .select-wrapper -->
									</div> <!-- end .item -->
									<div class="item">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Year of Model</option>
												<option>Year 1</option>
												<option>Year 2</option>
											</select>

										</div> <!-- end .select-wrapper -->
									</div> <!-- end .item -->
									<div class="item">
										<span class="price-slider-value">Price (Lt) <span id="price-min"></span> - <span id="price-max"></span></span>
										<div id="price-slider"></div>
									</div> <!-- end .item -->
									<div class="item">
										<button type="submit" class="button solid light-blue">Search</button>
									</div> <!-- end .item -->
								</form> <!-- end .banner-form -->
							</div> <!-- end .tab-panel -->
							<div role="tabpanel" class="tab-pane fade" id="sell-car">
								<form action="#" method="post" class="banner-form">
									<div class="item">
										<input type="text" placeholder="Brand">
									</div> <!-- end .item -->
									<div class="item">
										<input type="text" placeholder="Model">
									</div> <!-- end .item -->
									<div class="item">
										<input type="text" placeholder="Year">
									</div> <!-- end .item -->
									<div class="item">
										<input type="text" placeholder="Price">
									</div> <!-- end .item -->
									<div class="item">
										<button type="submit" class="button solid light-blue">Submit</button>
									</div> <!-- end .item -->
								</form> <!-- end .banner-form -->
							</div> <!-- end .tab-panel -->
						</div> <!-- end .tab-content -->
					</div> <!-- end .tabpanel -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->

        <!-- Start Page / Under SlideBar -->

		<section class="section light">
			<div class="inner">
				<div class="container">
					<h1 class="main-heading">What are you looking for?<small>Best Car Parts Deals</small></h1>
					<div class="clearfix services">
						<div class="service yellow">
							<div class="icon">
                            <i class="fas fa-tools fa-2x"></i>
								<div class="sub-icon">$</div> <!-- end .sub-icon -->
							</div> <!-- end .icon -->
							<div class="line"></div> <!-- end .line -->
							<h5>Cheapest Parts</h5>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
						</div> <!-- end .service -->
						<div class="service orange">
							<div class="icon">
                          <i class="fas fa-search fa-2x"></i>
								<div class="sub-icon"><i class="ion-key"></i></div> <!-- end .sub-icon -->
							</div> <!-- end .icon -->
							<div class="line"></div> <!-- end .line -->
							<h5>Look For What You Need</h5>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
						</div> <!-- end .service -->
						<div class="service green">
							<div class="icon">
                              <i class="far fa-comments fa-2x"></i>
								<div class="sub-icon">R</div> <!-- end .sub-icon -->
							</div> <!-- end .icon -->
							<div class="line"></div> <!-- end .line -->
							<h5>Talk To The Merchants</h5>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
						</div> <!-- end .service -->
					</div> <!-- end .services -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->

		<section class="section white">
			<div class="inner">
				<h1 class="main-heading">Featured Parts Deals<small>Best Parts Deals</small></h1>
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

@endsection
