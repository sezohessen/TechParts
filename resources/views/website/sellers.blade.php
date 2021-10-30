@extends('website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/part.css') }}">
<link rel="stylesheet" href="{{ asset('css/website/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/website/css/seller-page.css') }}">
@endsection
<!-- Start page -->
@section('website')
<section class="section dark tiny search-section mt-60">
    <div class="inner">
        <div class="container">
            <div class="border tabpanel section-tab" role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation">
                        <a href="#search-cars" aria-controls="search-cars" role="tab" data-toggle="tab">
                            @lang('Search for parts')
                        </a>
                        <li role="presentation"  class="active">
                            <a href="#sell-car" aria-controls="sell-car" role="tab" data-toggle="tab">@lang('Search for sellers')</a>
                        </li>
                    </li>
                </ul> <!-- end .nav-tabs -->
                <div class="tab-content">
                    <div role="tabpanel" class="p-5 tab-pane fade " id="search-cars">
                        <form action="{{ route('Website.parts') }}" method="get" role="search">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="search-label">@lang('Search for best parts')</label>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="search"  value="{{ app('request')->input('search') }}" placeholder="@lang('Search by name or part number')">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="item">
                                        <button type="submit" id="simple-search" class="button solid light-blue"> <i class="fa fa-search"></i> @lang('Search')</button>
                                    </div> <!-- end .item -->
                                </div>
                                <div class="col-md-3">
                                    <button class="button solid light-blue" id="AdvancedSearch"><i class="fa fa-plus px-2"></i> @lang('Advanced Search')</button>
                                </div>
                                <div class="col-md-12 hidden" id="Adv">
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
                            <button type="submit" class="hidden adv_submit button solid light-blue text-center"> <i class="fa fa-search"></i> @lang('Search')</button>
                        </form> <!-- end .banner-form -->
                    </div> <!-- end .tab-panel -->
                    <div role="tabpanel" class="tab-pane fade in active" id="sell-car">
                        <form action="{{ route('Website.Sellers') }}" method="get">
                            @csrf
                            <input type="text"  name="brand_id" hidden id="brand_selector">
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <label for="car" class="search-label mt-5">@lang('By address')</label>
                                    <span class="text-white text-sm ">@lang('Not required')</span>
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
                                                <label for="car" class="search-label mt-5">{{ LangDetail($Class->name,$Class->name_ar) }}</label>
                                                @php
                                                    $brands = App\Models\CarMaker::where('class_id',$Class->id)->get();
                                                @endphp
                                                <div class="row brand-content">
                                                    @foreach ($brands as $brand)
                                                    <div class="col-md-4 col-xs-6 @if ($brand->id==request()->get('brand_id')) selected-brand @endif">
                                                        <img class="brand-img brand-info" data-id="{{ $brand->id }}" src="{{ find_image($brand->logo,App\Models\CarMaker::base) }}" alt="{{ $brand->logo->name }}">
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="Seller_submit button solid light-blue text-center "> <i class="fa fa-search"></i> @lang('Search')</button>
                        </form> <!-- end .banner-form -->
                    </div> <!-- end .tab-panel -->
                </div> <!-- end .tab-content -->

            </div> <!-- end .tabpanel -->
        </div> <!-- end .container -->
    </div> <!-- end .inner -->
</section> <!-- end .section -->
<!-- Start Page / Under SlideBar -->
 <section class="container seller">
    <div class="py-20 mt-10">
            <div class="page-title" style="background-image: url('images/background01.jpg');">
                <div class="inner">
                    <div class="container">
                        <div class="title">@lang('Sellers')</div> <!-- end .title -->
                    </div> <!-- end .container -->
                </div> <!-- end .inner -->
         </div> <!-- end .page-title -->
            <!-- Row -->
            @if ($sellers->count())
                <div class="row all-sellers">
                    @foreach ($sellers as $seller)
                    <div class="overflow-hidden col-md-6 col-xs-12 ">
                        <!-- component -->
                        <!-- eslint-disable -->
                        <div class="items-center justify-center w-full pb-6 mx-auto my-4 overflow-hidden bg-white rounded-lg shadow relative">
                            <div class="seller-rating">
                                <!-- Tottal Rating -->
                                <div class="flex p-1 mx-10 leading-6 text-yellow-400 rating">
                                    @php
                                        $total = SellerTotalRating($seller->id);
                                    @endphp
                                </div>
                            </div>
                            <div class="bg">
                                @if (!$seller->bg)
                                <img class=" object-cover w-full" src="{{asset('img/background/background.jpg')}}" alt="Profile picture">
                                @else
                                <img class=" object-cover w-full" src="{{find_image($seller->background , App\Models\Seller::backgroundBase)}}" alt="{{$seller->background->name}}">
                                @endif
                            </div>
                            <div class="text-center seller-avatar relative">
                                @if (!$seller->avatar)
                                <img class="rounded-full img-thumbnail"
                                src="{{asset('img/avatar/user-profile.png')}}" alt="Profile picture">
                                @else
                                <img class="rounded-full img-thumbnail"
                                src="{{find_image($seller->sellerAvatar , App\Models\Seller::avatarBase)}}" alt="{{$seller->sellerAvatar->name}}">
                                @endif
                            </div>
                            <div class="info">
                                <h1 class="text-2x font-semibold text-primary text-center">
                                    <a href="{{ route('Website.SellerProfile',['id'=>$seller->user->id,'first'=>$seller->user->first_name,'second'=>$seller->user->last_name]) }}">
                                    {{ $seller->user->FullName }}
                                    </a>
                                </h1>
                                <p class="text-muted text-center">
                                {{ LangDetail($seller->governorate->title,$seller->governorate->title_ar) }} -
                                {{ LangDetail($seller->city->title,$seller->city->title_ar) }}
                            </div>
                            <hr>
                            <div class="all-brands row">
                                @foreach ($seller->brands as $brand)
                                    <div class="col-md-2 brands">
                                        <img src="{{ find_image($brand->carMaker->logo,App\Models\CarMaker::base) }}" alt="{{ $brand->carMaker->logo->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    {{ $sellers->links("pagination::bootstrap-4")}}
                </div>
            @else
                <div class="text-center">
                    <div class="mt-32 alert alert-warning" role="alert">
                        <i class="fa fa-exclamation-triangle"></i> <span>@lang('There are no results with such options')</span>
                    </div>
                </div>
            @endif

        </div>
    </div>
 </section>

@endsection

<!-- Js -->
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
