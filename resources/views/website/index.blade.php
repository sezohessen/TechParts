@extends('website.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/website/css/part.css') }}">
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
		<section class="section dark tiny search-section">
			<div class="inner">
				<div class="container">
					<div class="tabpanel border section-tab" role="tabpanel">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#search-cars" aria-controls="search-cars" role="tab" data-toggle="tab">Search Cars</a></li>
						</ul> <!-- end .nav-tabs -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active p-5" id="search-cars">
								<form method="get" role="search">
                                    <input type="text" name="order" hidden  value = "{{app('request')->input('order')}}">
                                    <input type="text" name="governorate_id" hidden value="{{app('request')->input('governorate_id')}}">
                                    <input type="text" name="city_id" hidden value="{{app('request')->input('city_id')}}">
                                    <input type="text" name="carMaker" hidden value="{{app('request')->input('carMaker')}}">
                                    <input type="text" name="carModel" hidden value="{{app('request')->input('carModel')}}">
                                    <input type="text" name="carYear" hidden value="{{app('request')->input('carYear')}}">
                                    <input type="text" name="carCapacity" hidden value="{{app('request')->input('carCapacity')}}">
                                    <input type="text" name="from" hidden  value = "{{app('request')->input('from')}}">
                                    <input type="text" name="to" hidden  value = "{{app('request')->input('to')}}">
									<div class="row">
                                        <div class="col-md-2">
                                            <label class="search-label">@lang('Search for best parts')</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="search"  value="{{ app('request')->input('search') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="item">
                                                <button type="submit" class="button solid light-blue"> <i class="fa fa-search"></i> @lang('Search')</button>
                                            </div> <!-- end .item -->
                                        </div>
                                    </div>

								</form> <!-- end .banner-form -->
							</div> <!-- end .tab-panel -->
						</div> <!-- end .tab-content -->
					</div> <!-- end .tabpanel -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->
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
								<form method="get" role="select-search">
                                    <input type="text" name="order" hidden  value = "{{app('request')->input('order')}}">
                                    <input type="text" name="search" hidden  value = "{{app('request')->input('search')}}">
                                    <label for="car" class="search-label">@lang('By car model')</label>
                                    <div class="item form-group">
                                        <label class="text-white">@lang('Brand')</label>
                                        <select class="form-control" name="carMaker" id="maker" data-live-search="true">
                                            <option value="">@lang('Select Brand')</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    @if (request()->get('carMaker')&& $brand->id==request()->get('carMaker'))
                                                        {{ 'selected' }}
                                                    @endif
                                                    >{{ $brand->name }}</option>
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
                                    <div class="item form-group">
                                        <label class="text-white">@lang('Car capacity')</label>
                                        <select class="form-control" id="carCapacity"
                                            name="carCapacity" >
                                                @foreach ($capacities as $capacity)
                                                    <option value="{{$capacity->id}}"
                                                        @if (request()->get('carCapacity')&& $capacity->id==request()->get('carCapacity'))
                                                            {{ 'selected' }}
                                                        @endif>
                                                        {{$capacity->capacity}}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </div> <!-- end .item -->
                                    <label for="car" class="search-label">@lang('By address')</label>
                                    <div class="item form-group">
                                        <label class="text-white">@lang('Governorate')</label>
                                        <select class="form-control" id="governorate"
                                            name="governorate_id" >
                                                <option value="">@lang('Select Governorate')</option>
                                                @foreach ($governorates as $governorate)
                                                <option value="{{$governorate->id}}"
                                                    @if (request()->get('governorate_id')&& $governorate->id==request()->get('governorate_id'))
                                                        {{ 'selected' }}
                                                    @endif>
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
                                            name="city_id" >
                                                <option value="">@lang('Select governorate first')</option>
                                        </select>
                                    </div> <!-- end .item -->
									<div class="form-group">
                                        <div class="range-slider">
                                            <div class="text-muted font-weight-bolder font-size-lg mb-5 header"><label class="search-label">@lang('Price range') :</label></div>
                                            <label for="number" class="search-label search-range">
                                                <input type="number" value="{{ request()->get('from')||request()->get('from')=='0' ? request()->get('from') : '0' }}" min="0" max="100000" name="from" />
                                            </label>
                                            <span>-</span>
                                            <label for="number" class="search-label search-range">
                                                <input type="number" value="{{ request()->get('to') ? request()->get('to') : '100000' }}" min="0" max="100000" name="to"/>
                                            </label>
                                            <div class="row">
                                                <div class="col-md-12 search-price">
                                                    <input value="{{ request()->get('from')||request()->get('from')=='0' ? request()->get('from') : '0' }}" min="0" max="100000" step="500" type="range"/>
                                                    <input value="{{ request()->get('to') ? request()->get('to') : '100000' }}" min="0" max="100000" step="500" type="range"/>
                                                </div>
                                            </div>
                                        </div>
									</div> <!-- end .form-group -->

									<button type="submit" class="block button solid yellow">@lang('Search')</button>
								</form>
							</div> <!-- end .refine-search -->
						</div> <!-- end .col-sm-3 -->
						<div class="col-sm-9">
							<div class="listings">
								<div class="clearfix heading">
									<h5>{{ $parts->count() }} @lang('Results Found')</h5>
                                    @if ($parts->count())
                                        <form  method="get">
                                            <div class="select-wrapper sort">
                                                <div class="form-group">
                                                    <label for="order" class="text-muted font-weight-bolder font-size-lg mx-5">@lang('Sort By')</label>
                                                    <input type="text" name="search" hidden value="{{app('request')->input('search')}}">
                                                    <input type="text" name="governorate_id" hidden value="{{app('request')->input('governorate_id')}}">
                                                    <input type="text" name="city_id" hidden value="{{app('request')->input('city_id')}}">
                                                    <input type="text" name="carMaker" hidden value="{{app('request')->input('carMaker')}}">
                                                    <input type="text" name="carModel" hidden value="{{app('request')->input('carModel')}}">
                                                    <input type="text" name="carYear" hidden value="{{app('request')->input('carYear')}}">
                                                    <input type="text" name="carCapacity" hidden value="{{app('request')->input('carCapacity')}}">
                                                    <input type="text" name="from" hidden  value = "{{app('request')->input('from')}}">
                                                    <input type="text" name="to" hidden  value = "{{app('request')->input('to')}}">
                                                    <select name="order" class="selectpicker" onchange="this.form.submit()">
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
                                                        >@lang('Nearby')</option>
                                                    </select>
                                                </div>
                                            </div> <!-- end .select-wrapper -->
                                        </form>
                                    @else
                                    <div class="alert alert-warning mt-32" role="alert">
                                        <i class="fa fa-exclamation-triangle"></i> <span>@lang('There are no results with such options')</span>
                                    </div>
                                    @endif
								</div> <!-- end .heading -->
								<div class="clearfix listings-grid">
                                    <div class="featured-cars">
                                        <div class="row">
                                            <x-part :parts="$parts" makeCol="1"/>
                                        </div>
                                    </div>
                                    {{ $parts->appends(Request::only([
                                        'search','order','from','to','governorate_id','city_id','carMaker','carModel','carYear','carCapacity',
                                        ]))->links("pagination::bootstrap-4") }}
								</div> <!-- end .listing-grid -->
							</div> <!-- end .listings -->
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
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            $.ajax({
                url:'{{ route("Website.Index") }}',
                type:'GET',
                data:{latitude:lat,longitude:lng},
            });
        });
    }
</script>
<script>
    function year(id){
        $('#year').empty();
        old_year="<?php echo  request()->get('carYear') ?>";
        $.ajax({
            url: 'available_year/'+id,
            success: data => {
                if(data.years){
                    data.years.forEach(years =>
                    $('#year').append(`<option value="${years.id}" ${(old_year==years.id) ? "selected" : "" } >${years.year}</option>`))
                }else{
                    $('#year').append(`<option value="">{{__("No Results")}}</option>`)
                }
            },
        });
    }
    function model(id){
        $('#models').empty();
        $('#year').empty();
        old_model="<?php echo  request()->get('carModel') ?>";
        year();
        $.ajax({
            url: 'available_model/'+id,
            success: data => {
                if(data.models){
                    $('#models').append(`<option value="" >@lang('Select Model first')</option>`)
                    data.models.forEach(models =>
                    $('#models').append(`<option value="${models.id}" ${(old_model==models.id) ? "selected" : "" } >${models.name}</option>`))
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
        old_city="<?php echo  request()->get('city_id') ?>";
        $.ajax({
            url: '/available_cities/'+id,
            success: data => {
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}" ${(old_city==city.id) ? "selected" : "" } >${city.title}</option>`))
                }else{
                $('#city').append(`<option value="">@lang('Select Governorate')</option>`)
                }
            }
        });
    }
    function governorate_ar(id){
        $('#city').empty();
        old_city="<?php echo  request()->get('city_id') ?>";
        $.ajax({
            url: '/available_cities/'+id,
            success: data => {
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}" ${(old_city==city.id) ? "selected" : "" }> ${city.title_ar}</option>`))
                }else{
                $('#city').append(`<option value="">@lang('Select governorate first')</option>`)
                }
            }
        });
    }
    function getOldCities(){
        var id = "<?php echo  request()->get('governorate_id') ?>";
        if(id){
            var en = <?php echo Session::get('app_locale')=='en' ? 1: 0;?>;
            en ? governorate(id):governorate_ar(id);
        }
    }
    function getOldModels(){
        var id = "<?php echo  request()->get('carModel') ?>";
        if(id)model(id);
    }
    function getOldYears(){
        var id = "<?php echo  request()->get('carYear') ?>";
        if(id)year(id);
    }
    getOldModels();
    getOldYears();
    getOldCities();
    $('#governorate').on('change', function() {
        var id = this.value ;
        var en = <?php echo Session::get('app_locale')=='en' ? 1: 0;?>;
        en ? governorate(id):governorate_ar(id);
    });
    (function() {
    var parent = document.querySelector(".range-slider");
    if(!parent) return;
    var
    rangeS = parent.querySelectorAll("input[type=range]"),
    numberS = parent.querySelectorAll("input[type=number]");
    rangeS.forEach(function(el) {
    el.oninput = function() {
        var slide1 = parseFloat(rangeS[0].value),
            slide2 = parseFloat(rangeS[1].value);
        if (slide1 > slide2) {
                [slide1, slide2] = [slide2, slide1];
        // var tmp = slide2;
        // slide2 = slide1;
        // slide1 = tmp;
        }
        numberS[0].value = slide1;
        numberS[1].value = slide2;
    }
    });
    numberS.forEach(function(el) {
    el.oninput = function() {
            var number1 = parseFloat(numberS[0].value),
                    number2 = parseFloat(numberS[1].value);
        if (number1 > number2) {
        var tmp = number1;
        numberS[0].value = number2;
        numberS[1].value = tmp;
        }
        rangeS[0].value = number1;
        rangeS[1].value = number2;
    }
    });
    })();

</script>

@endsection
