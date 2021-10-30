@extends('website.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/website/css/part.css') }}">
@endsection
@section('website')

<section class="section dark tiny search-section mt-60">
    <div class="inner">
        <div class="container">
            <div class="border tabpanel section-tab" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a class="" href="#search-cars" aria-controls="search-cars" role="tab" data-toggle="tab">
                            @lang('Search for parts')
                        </a>
                        <li role="presentation" class="sm:mt-3">
                            <a href="#sell-car" aria-controls="sell-car" role="tab" data-toggle="tab">@lang('Search for sellers')</a>
                        </li>
                    </li>
                </ul> <!-- end .nav-tabs -->
                <div class="tab-content">
                    <div role="tabpanel" class="p-5 tab-pane fade in active" id="search-cars">
                        <form action="{{ route('Website.parts') }}" method="get" role="search">
                            @csrf
                            <div class="row">
                                <div class="col-md-2 sm:mt-5">
                                    <label class="search-label">@lang('Search for best parts')</label>
                                </div>
                                <div class="col-md-5 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="search"  value="{{ app('request')->input('search') }}" placeholder="@lang('Search by name or part number')">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="item sm:mb-5">
                                        <button type="submit" id="simple-search" class="button solid light-blue"> <i class="fa fa-search"></i> @lang('Search')</button>
                                    </div> <!-- end .item -->
                                </div>
                                <div class="col-md-3">
                                    <button class="button solid light-blue" id="AdvancedSearch"><i class="px-2 fa fa-plus"></i> @lang('Advanced Search')</button>
                                </div>
                                <div class="hidden col-md-12" id="Adv">
                                    <div class="col-xs-12">
                                        <label for="car" class="search-label">@lang('By car model')</label>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="item form-group models">
                                            <label class="text-white">@lang('Brand')</label>
                                            <select class="form-control selectpicker" name="carMaker" id="maker" data-live-search="true">
                                                <option value="">@lang('Select Brand')</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        @if (request()->get('carMaker')&& $brand->id==request()->get('carMaker'))
                                                            {{ 'selected' }}
                                                        @endif
                                                        data-content="
                                                        <span>{{$brand->name}}</span> <img src='{{url('img/CarMakers/'.$brand->logo->name)}}'  class='img-thumbnail' width='35' height='35'>"
                                                        ></option>
                                                @endforeach
                                            </select>
                                        </div> <!-- end .item -->
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="item form-group">
                                            <label class="text-white">@lang('Model')</label>
                                            <select class="form-control selectpicker" name="carModel" id="models" data-live-search="true">
                                                <option value="" >@lang('Select brand first')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="item form-group">
                                            <label class="text-white">@lang('Year')</label>
                                            <select class="form-control selectpicker" name="carYear" id="year" data-live-search="true">
                                                <option value="" >@lang('Select Model first')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="item form-group">
                                            <label class="text-white">@lang('Car Capacity')</label>
                                            <select class="form-control selectpicker" id="carCapacity" data-live-search="true"
                                                name="carCapacity" >
                                                <option value="" >@lang('Select Car Capacity')</option>
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
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="hidden text-center adv_submit button solid light-blue"> <i class="fa fa-search"></i> @lang('Search')</button>
                        </form> <!-- end .banner-form -->
                    </div> <!-- end .tab-panel -->
                    <div role="tabpanel" class="tab-pane fade" id="sell-car">
                        <form action="{{ route('Website.Sellers') }}" method="get">
                            @csrf
                            <input type="text"  name="brand_id" hidden id="brand_selector">
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <label for="car" class="mt-5 search-label sm:mt-10">@lang('By address')</label>
                                    <span class="text-sm text-white ">@lang('Not required')</span>
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
                                </div>
                                <div class="col-md-8 col-xs-12">
                                    <div class="row brand">
                                        @foreach ($Classes as $Class)
                                            <div class="col-md-4">
                                                <label for="car" class="mt-5 search-label">{{ LangDetail($Class->name,$Class->name_ar) }}</label>
                                                @php
                                                    $brands = App\Models\CarMaker::where('class_id',$Class->id)->get();
                                                @endphp
                                                <div class="row brand-content">
                                                    @foreach ($brands as $brand)
                                                    <div class="col-md-4 col-xs-6 ">
                                                        <img class="brand-img brand-info" data-id="{{ $brand->id }}" src="{{ find_image($brand->logo,App\Models\CarMaker::base) }}" alt="{{ $brand->logo->name }}">
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="text-center Seller_submit button solid light-blue "> <i class="fa fa-search"></i> @lang('Search')</button>
                        </form> <!-- end .banner-form -->
                    </div> <!-- end .tab-panel -->
                </div> <!-- end .tab-content -->

            </div> <!-- end .tabpanel -->
        </div> <!-- end .container -->
    </div> <!-- end .inner -->
</section> <!-- end .section -->
<!-- Start Page / Under SlideBar -->


    <!--Start What are you looking for -->
<section class="section light">
    <div class="inner">
        <div class="container pt-10">
            <h1 class="main-heading">@lang('Are you looking for')<small class="font">@lang('Best Car Parts Deals')</small></h1>
            <div class="clearfix services">
                <div class="service yellow">
                    <div class="icon">
                    <i class="fas fa-tools fa-2x"></i>
                        <div class="sub-icon">$</div> <!-- end .sub-icon -->
                    </div> <!-- end .icon -->
                    <div class="line"></div> <!-- end .line -->
                    <h5>@lang('Cheapest Parts')</h5>
                    <p>@lang('We have the cheapest spare parts on the market')</p>
                </div> <!-- end .service -->
                <div class="service orange">
                    <div class="icon">
                    <i class="fas fa-search fa-2x"></i>
                        <div class="sub-icon"><i class="ion-key"></i></div> <!-- end .sub-icon -->
                    </div> <!-- end .icon -->
                    <div class="line"></div> <!-- end .line -->
                    <h5>@lang('Look For What You Need')</h5>
                    <p>@lang('Find all the parts you need')</p>
                </div> <!-- end .service -->
                <div class="service green">
                    <div class="icon">
                        <i class="far fa-comments fa-2x"></i>
                        <div class="sub-icon">C</div> <!-- end .sub-icon -->
                    </div> <!-- end .icon -->
                    <div class="line"></div> <!-- end .line -->
                    <h5>@lang('Talk To The Merchants')</h5>
                    <p>@lang('Talk to merchants directly without any intermediary')</p>
                </div> <!-- end .service -->
            </div> <!-- end .services -->
        </div> <!-- end .container -->
    </div> <!-- end .inner -->
</section> <!-- end .section -->

<!-- Start Featerd Parts Deals -->
@if ($deals->count() >= 5 )
    <section class="section white">
        <div class="py-0 my-0 inner">
            <h1 class="main-heading">@lang('Hot deals')<small>@lang('Best parts based on rating')</small></h1>
            <div id="featured-cars" class="owl-carousel featured-cars">
                <x-part :parts="$deals" :makeCol="0" :fav="0"/>

            </div> <!-- end .featured-cars -->
        </div> <!-- end .inner -->
    </section> <!-- end .section -->
@endif

@endsection
@section('js')
<script>
    $(".brand-info").each(function(index){

        $(this).on('click',function(){
            $('.brand-info').parent().css({'border':'1px solid #09a0f7','background-color':'unset'});
            var id = $(this).data('id');
            document.getElementById("brand_selector").value = id;
            $(this).parent().css({'border':'2px solid #ffffff','background-color':'#FFFFFF'});
        });
    });
   function getLatLong(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                console.log(position);
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                document.getElementById("lat").value = lat;
                document.getElementById("long").value = lng;
            });
        }
    }
    getLatLong();
    function getNearBy(){
        document.getElementById("orderFrom").submit();
    }
    function AllowLocation(){
        getLatLong();
    }
    $('#AdvancedSearch').on('click',function(e){
        e.preventDefault();
        $('#Adv').toggleClass('hidden');
        $('.adv_submit').toggleClass('hidden');
        $('#simple-search').toggleClass('hidden');

    });
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
                $("#year").selectpicker('refresh');
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
                $("#models").selectpicker('refresh');
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
                    $('#city').append(`<option value="" >@lang('All')</option>`)
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
                    $('#city').append(`<option value="" >@lang('All')</option>`)
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
</script>

@endsection
