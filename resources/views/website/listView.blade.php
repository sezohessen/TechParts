@extends('website.layouts.app')

@section('website')
{{-- Search --}}
<section class="section dark tiny" style="margin-top: 80px">
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
<section class="section small-top-padding white" style="margin-top: 50px">
    <div class="inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="listings">
                        <div class="heading clearfix">
                            <h5>8 Results Found For Exotic Cars</h5>
                            <div class="view">
                                <a href="{{url('parts')}}" class="active"><i class="fa fa-th-list"></i></a>
                                <a href="{{url('index')}}"><i class="fa fa-th"></i></a>
                            </div> <!-- end .view -->
                            <div class="select-wrapper sort">
                                <select class="selectpicker">
                                    <option>Sort By</option>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                </select>
                            </div> <!-- end .select-wrapper -->
                        </div> <!-- end .heading -->
                        <div class="listings-list clearfix">
                            <div class="listing">
                                <div class="image" style="background-image: url('img/website/listing02.jpg');"></div>
                                <div class="details">
                                    <div class="item"><span>4</span><i class="icon-car-seat"></i></div>
                                    <div class="item"><span>gas</span><i class="icon-car-fuel"></i></div>
                                    <div class="item"><span>sport</span><i class="icon-car-door"></i></div>
                                    <div class="item"><span>gear</span><i class="icon-car-gear"></i></div>
                                    <div class="item"><span>4</span><i class="fa fa-certificate"></i></div>
                                </div> <!-- end .details -->
                                <div class="content">
                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                    <div class="title"><a href="details.html">Ferrari <span>[ Grand ]</span></a></div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesett Ipsum has been the Off-road Vehicle/Pickup Truck, New vehic Diesel, 281 kW (382 PS), Fuel consumption.</p>
                                    <a href="details.html" class="button border">View Detials</a>
                                    <div class="price">$80000 <span>/ for sale</span></div>
                                </div> <!-- end .content -->
                            </div> <!-- end .listing -->
                            <div class="listing">
                                <div class="image" style="background-image: url('img/website/listing03.jpg');"></div>
                                <div class="details">
                                    <div class="item"><span>4</span><i class="icon-car-seat"></i></div>
                                    <div class="item"><span>gas</span><i class="icon-car-fuel"></i></div>
                                    <div class="item"><span>sport</span><i class="icon-car-door"></i></div>
                                    <div class="item"><span>gear</span><i class="icon-car-gear"></i></div>
                                    <div class="item"><span>4</span><i class="fa fa-certificate"></i></div>
                                </div> <!-- end .details -->
                                <div class="content">
                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                    <div class="title"><a href="details.html">Ferrari <span>[ Grand ]</span></a></div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesett Ipsum has been the Off-road Vehicle/Pickup Truck, New vehic Diesel, 281 kW (382 PS), Fuel consumption.</p>
                                    <a href="details.html" class="button border">View Detials</a>
                                    <div class="price green">$80000 <span>/ for rent</span></div>
                                </div> <!-- end .content -->
                            </div> <!-- end .listing -->
                            <div class="listing">
                                <div class="image" style="background-image: url('img/website/listing04.jpg');"></div>
                                <div class="details">
                                    <div class="item"><span>4</span><i class="icon-car-seat"></i></div>
                                    <div class="item"><span>gas</span><i class="icon-car-fuel"></i></div>
                                    <div class="item"><span>sport</span><i class="icon-car-door"></i></div>
                                    <div class="item"><span>gear</span><i class="icon-car-gear"></i></div>
                                    <div class="item"><span>4</span><i class="fa fa-certificate"></i></div>
                                </div> <!-- end .details -->
                                <div class="content">
                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                    <div class="title"><a href="details.html">Ferrari <span>[ Grand ]</span></a></div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesett Ipsum has been the Off-road Vehicle/Pickup Truck, New vehic Diesel, 281 kW (382 PS), Fuel consumption.</p>
                                    <a href="details.html" class="button border">View Detials</a>
                                    <div class="price">$80000 <span>/ for sale</span></div>
                                </div> <!-- end .content -->
                            </div> <!-- end .listing -->
                            <div class="listing">
                                <div class="image" style="background-image: url('img/website/listing04.jpg');"></div>
                                <div class="details">
                                    <div class="item"><span>4</span><i class="icon-car-seat"></i></div>
                                    <div class="item"><span>gas</span><i class="icon-car-fuel"></i></div>
                                    <div class="item"><span>sport</span><i class="icon-car-door"></i></div>
                                    <div class="item"><span>gear</span><i class="icon-car-gear"></i></div>
                                    <div class="item"><span>4</span><i class="fa fa-certificate"></i></div>
                                </div> <!-- end .details -->
                                <div class="content">
                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                    <div class="title"><a href="details.html">Ferrari <span>[ Grand ]</span></a></div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesett Ipsum has been the Off-road Vehicle/Pickup Truck, New vehic Diesel, 281 kW (382 PS), Fuel consumption.</p>
                                    <a href="details.html" class="button border">View Detials</a>
                                    <div class="price">$80000 <span>/ for sale</span></div>
                                </div> <!-- end .content -->
                            </div> <!-- end .listing -->
                            <div class="listing">
                                <div class="image" style="background-image: url('img/website/listing04.jpg');"></div>
                                <div class="details">
                                    <div class="item"><span>4</span><i class="icon-car-seat"></i></div>
                                    <div class="item"><span>gas</span><i class="icon-car-fuel"></i></div>
                                    <div class="item"><span>sport</span><i class="icon-car-door"></i></div>
                                    <div class="item"><span>gear</span><i class="icon-car-gear"></i></div>
                                    <div class="item"><span>4</span><i class="fa fa-certificate"></i></div>
                                </div> <!-- end .details -->
                                <div class="content">
                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                    <div class="title"><a href="details.html">Ferrari <span>[ Grand ]</span></a></div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesett Ipsum has been the Off-road Vehicle/Pickup Truck, New vehic Diesel, 281 kW (382 PS), Fuel consumption.</p>
                                    <a href="details.html" class="button border">View Detials</a>
                                    <div class="price">$80000 <span>/ for sale</span></div>
                                </div> <!-- end .content -->
                            </div> <!-- end .listing -->
                            <div class="listing">
                                <div class="image" style="background-image: url('img/website/listing04.jpg');"></div>
                                <div class="details">
                                    <div class="item"><span>4</span><i class="icon-car-seat"></i></div>
                                    <div class="item"><span>gas</span><i class="icon-car-fuel"></i></div>
                                    <div class="item"><span>sport</span><i class="icon-car-door"></i></div>
                                    <div class="item"><span>gear</span><i class="icon-car-gear"></i></div>
                                    <div class="item"><span>4</span><i class="fa fa-certificate"></i></div>
                                </div> <!-- end .details -->
                                <div class="content">
                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                                    <div class="title"><a href="details.html">Ferrari <span>[ Grand ]</span></a></div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesett Ipsum has been the Off-road Vehicle/Pickup Truck, New vehic Diesel, 281 kW (382 PS), Fuel consumption.</p>
                                    <a href="details.html" class="button border">View Detials</a>
                                    <div class="price">$80000 <span>/ for sale</span></div>
                                </div> <!-- end .content -->
                            </div> <!-- end .listing -->
                        </div> <!-- end .listings -->
                    </div> <!-- end .listing-grid -->
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
                    </div>
                </div> <!-- end .col-sm-9 -->
                <div class="col-sm-3">
                    <div class="refine-search">
                        <div class="title clearfix">Refine Your Search<i class="fa fa-search pull-right"></i></div>
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
                            <button type="submit" class="button solid yellow block">Search</button>
                        </form>
                    </div> <!-- end .refine-search -->
                </div> <!-- end .col-sm-3 -->
            </div> <!-- end .row -->
        </div> <!-- end .container -->
    </div> <!-- end .inner -->
</section> <!-- end .section -->
@endsection
