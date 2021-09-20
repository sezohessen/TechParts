@extends('website.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/home.css') }}">
@endsection
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

        <!-- Start Page / Under SlideBar -->

        <!--start Parts (List View) -->
		<div class="page-title" style="background-image: url('images/background01.jpg');">
			<div class="inner">
				<div class="container">
					<div class="title">@lang('Parts Listing')</div> <!-- end .title -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</div> <!-- end .page-title -->
        <section class="section small-top-padding white">
			<div class="inner">
				<div class="container">
					<div class="row">
                        <div class="col-sm-3">
							<div class="refine-search">
								<div class="clearfix title">@lang('Search:')<i class="fa fa-search pull-right"></i></div>
								<form method="get" role="search">
                                    <label for="car" class="search-label">@lang('By car model')</label>
                                    <div class="item form-group">
                                        <label class="text-white">@lang('Brand')</label>
                                        <select class="form-control" name="carMaker" id="maker" data-live-search="true">
                                            <option>@lang('Select Brand')</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> <!-- end .item -->
                                    <div class="item form-group">
                                        <label class="text-white">@lang('Model')</label>
                                        <select class="form-control" name="carModel" id="models" data-live-search="true">
                                            <option value="" >@lang('Select brand first')</option>
                                        </select>
                                    </div> <!-- end .item -->
                                    <div class="item form-group">
                                        <label class="text-white">@lang('Year')</label>
                                        <select class="form-control" name="carYear" id="year" data-live-search="true">
                                            <option value="" >@lang('Select Model first')</option>
                                        </select>
                                    </div> <!-- end .item -->
                                    <label for="car" class="search-label">@lang('By address')</label>
                                    <div class="item form-group">
                                        <label class="text-white">@lang('Governorate')</label>
                                        <select class="form-control" id="governorate"
                                            name="governorate_id" >
                                                <option value="">@lang('Select Governorate')</option>
                                                @foreach ($governorates as $governorate)
                                                <option value="{{$governorate->id}}">
                                                    @if (Session::get('app_locale')=='en')
                                                        {{ $governorate->title }}
                                                    @else
                                                        {{ $governorate->title_ar }}
                                                    @endif
                                                </option>
                                                @endforeach
                                            </select>
                                    </div> <!-- end .item -->
                                    <div class="item form-group">
                                        <label class="text-white" >@lang('City')</label>
                                        <select class="form-control" id="city"
                                            name="city_id" required >
                                                <option value="">@lang('Select governorate first')</option>
                                        </select>
                                    </div> <!-- end .item -->
									<div class="form-group">
										<span class="price-slider-value">
                                            <label class="search-label">
                                                @lang('By price') :
                                                <input id="price-min" name="from" disabled/> - <input id="price-max" name="to" disabled />
                                            </label>
                                        </span>
                                        <div class="item">
                                            <span class="price-slider-value">@lang('Price')<span id="price-min"></span> - <span id="price-max"></span></span>
                                            <div id="price-slider"></div>
                                        </div> <!-- end .item -->
									</div> <!-- end .form-group -->

									<button type="submit" class="block button solid yellow">@lang('Search')</button>
								</form>
							</div> <!-- end .refine-search -->
						</div> <!-- end .col-sm-3 -->
						<div class="col-sm-9">
							<div class="listings">
								<div class="clearfix heading">
									<h5>8 @lang('Results Found')</h5>
                                    <form  method="get">
                                        <div class="select-wrapper sort">
                                            <div class="form-group">
                                                <label for="order" class="text-muted font-weight-bolder font-size-lg mx-5">@lang('Sort By')</label>
                                                <input type="text" name="search" hidden value="{{app('request')->input('search')}}">
                                                <input type="text" name="governorate_id" hidden value="{{app('request')->input('governorate_id')}}">
                                                <input type="text" name="city_id" hidden value="{{app('request')->input('city_id')}}">
                                                <input type="text" name="category_id" hidden value="{{app('request')->input('category_id')}}">
                                                <input type="text" name="subcategory_id" hidden value="{{app('request')->input('subcategory_id')}}">
                                                <input type="text" hidden name="type" value = "{{app('request')->input('type')}}">
                                                <select name="order" class="selectpicker">
                                                    <option value="views"
                                                        @if (request()->get('order')=='views')
                                                        {{ 'selected' }}
                                                        @endif
                                                    >@lang('Popularity')</option>
                                                    <option value="newest"
                                                        @if (request()->get('order')=='newest')
                                                        {{ 'selected' }}
                                                        @endif
                                                    >@lang('Most recent')</option>
                                                    <option value="asc"
                                                        @if (request()->get('order')=='asc')
                                                        {{ 'selected' }}
                                                        @endif
                                                    >@lang('Price: Low to High')</option>
                                                    <option value="desc"
                                                        @if (request()->get('order')=='desc')
                                                        {{ 'selected' }}
                                                        @endif
                                                    >@lang('Price: High to Low')</option>
                                                    <option value="nearest"
                                                        @if (request()->get('order')=='nearest')
                                                        {{ 'selected' }}
                                                        @endif
                                                    >@lang('Nearest')</option>
                                                </select>
                                            </div>
                                        </div> <!-- end .select-wrapper -->
                                    </form>
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
@section('js')
<script>
    function year(id){
        $('#year').empty();
        $.ajax({
            url: 'available_year/'+id,
            success: data => {
                if(data.years){
                    data.years.forEach(years =>
                    $('#year').append(`<option value="${years.id}">${years.year}</option>`))
                }else{
                    $('#year').append(`<option value="">{{__("No Results")}}</option>`)
                }
            },
        });
    }
    function model(id){
        $('#models').empty();
        $('#year').empty();
        year();
        $.ajax({
            url: 'available_model/'+id,
            success: data => {
                if(data.models){
                    $('#models').append(`<option value="" >@lang('Select Model first')</option>`)
                    data.models.forEach(models =>
                    $('#models').append(`<option value="${models.id}" >${models.name}</option>`))
                }else{
                    $('#models').append(`<option value="">{{__("No Results")}}</option>`)
                }
            },
        });
    }
    $('#maker').on('change', function() {
        var id = this.value ;
        model(id);
    });
    $('#models').on('change', function() {
        var id = this.value;
        year(id);
    });
    function governorate(id){
        $('#city').empty();

        $.ajax({
            url: '/available_cities/'+id,
            success: data => {
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}" >${city.title}</option>`))
                }else{
                $('#city').append(`<option value="">@lang('Select Governorate')</option>`)
                }
            }
        });
    }
    function governorate_ar(id){
        $('#city').empty();
        $.ajax({
            url: '/available_cities/'+id,
            success: data => {
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}" > ${city.title_ar}</option>`))
                }else{
                $('#city').append(`<option value="">@lang('Select governorate first')</option>`)
                }
            }
        });
    }
    $('#governorate').on('change', function() {
        var id = this.value ;
        var en = <?php echo Session::get('app_locale')=='en' ? 1: 0; ?>;
        en ? governorate(id):governorate_ar(id);
    });

</script>
@endsection
