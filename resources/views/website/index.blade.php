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

        {{-- Search --}}
<section class="section dark tiny">
    <div class="inner">
        <div class="container">
            <div class="border tabpanel section-tab" role="tabpanel">
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
                </div> <!-- end .tab-content -->
            </div> <!-- end .tabpanel -->
        </div> <!-- end .container -->
    </div> <!-- end .inner -->
</section>

        <!-- Start Page / Under SlideBar -->



        <!--start Parts (List View) -->
		<div class="page-title" style="background-image: url('images/background01.jpg');">
			<div class="inner">
				<div class="container">
					<div class="title">Parts Listing Grid</div> <!-- end .title -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</div> <!-- end .page-title -->
        <section class="section small-top-padding white">
			<div class="inner">
				<div class="container">
					<div class="row">
						<div class="col-sm-9">
							<div class="listings">
								<div class="clearfix heading">
									<h5>8 Results Found For Exotic Cars</h5>
									<!-- <div class="view">
										<a href="{{url('parts')}}"><i class="fa fa-th-list"></i></a>
										<a href="{{url('index')}}" class="active"><i class="fa fa-th"></i></a>
									</div> end .view -->
									<div class="select-wrapper sort">
										<select class="selectpicker">
											<option>Sort By</option>
											<option>Option 1</option>
											<option>Option 2</option>
										</select>

									</div> <!-- end .select-wrapper -->
								</div> <!-- end .heading -->
								<div class="clearfix listings-grid">
                                    @foreach ($parts as $part )
									<div class="listing">
										<div class="image"><a href="details.html"><img src="img/website/listing01.jpg" alt="listing" class="img-responsive"></a></div>
										<div class="content">
											<div class="title"><a href=""> s <span>[ Grand ]</span></a></div>
											<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore aliquid iusto officia dolore numquam ipsa exercitationem veritatis, commodi libero aut labore! Inventore dolores ipsum mollitia veniam distinctio doloribus id placeat!</p>
											<div class="price"> 8000$ <span>/ for sale</span></div>
										</div>
									</div> <!-- end .listing -->
                                    @endforeach
								</div> <!-- end .listing-grid -->
							</div> <!-- end .listings -->
							<div class="pagination-wrapper">
								<nav>
									<ul class="pager">
										<li class="previous"><a href="#"><span><i class="fa fa-angle-left"></i></span>Prev</a></li>
										<li class="next"><a href="#">Next<span><i class="fa fa-angle-right"></i></span></a></li>
									</ul>
									<ul class="pagination">
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li class="disabled"><a href="#"><i class="ion-ios-more"></i></a></li>
										<li><a href="#">7</a></li>
									</ul>
								</nav>
							</div> <!-- end .pagination-wrapper -->
						</div> <!-- end .col-sm-9 -->
						<div class="col-sm-3">
							<div class="refine-search">
								<div class="clearfix title">Refine Your Search<i class="fa fa-search pull-right"></i></div>
								<form>
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Brand</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Model</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>1st Registration From</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<div class="form-group">
										<span class="price-slider-value">Price: <span id="price-min"></span> - <span id="price-max"></span></span>
										<div id="price-slider"></div>
									</div> <!-- end .form-group -->
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Fuel</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Gear</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Engine Size</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<div class="form-group">
										<span class="distance-slider-value">Kilometers: <span id="distance-min"></span> - <span id="distance-max"></span> km</span>
										<div id="distance-slider"></div>
									</div> <!-- end .form-group -->
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Car Type</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<div class="form-group">
										<div class="select-wrapper">
											<select class="selectpicker">
												<option>Car Color</option>
												<option>Option 1</option>
												<option>Option 2</option>
											</select>
											<span class="arrow"><i class="fa fa-caret-down"></i></span>
										</div> <!-- end .select-wrapper -->
									</div> <!-- end .form-group -->
									<button type="submit" class="block button solid yellow">Search</button>
								</form>
							</div> <!-- end .refine-search -->
						</div> <!-- end .col-sm-3 -->
					</div> <!-- end .row -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->
        <!-- end Parts (List View) -->

         <!--Start What are you looking for -->
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

        <!-- Start Featerd Parts Deals -->
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
