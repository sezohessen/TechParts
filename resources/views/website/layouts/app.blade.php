<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from premiumlayers.com/html/automan/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Sep 2021 05:37:39 GMT -->
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Automan - Advanced Car Dealer HTML Template</title>

		<!-- Bootstrap -->
		<link href="{{ asset('css/website/css/bootstrap.min.css') }}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{ asset('lang/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<!-- Ionicons -->
		<link href="{{ asset('lang/fonts/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <!-- Cars -->
		<link href="{{ asset('lang/fonts/cars/style.css') }}" rel="stylesheet">
		<!-- FlexSlider -->
		<link href="{{ asset('js/website/scripts/FlexSlider/flexslider.css') }}" rel="stylesheet">
		<!-- Owl Carousel -->
		<link href="{{ asset('css/website/css/owl.carousel.css') }}" rel="stylesheet">
		<link href="{{ asset('css/website/css/owl.theme.default.css') }}" rel="stylesheet">
		<!-- noUiSlider -->
		<link href="{{ asset('css/website/css/jquery.nouislider.min.css') }}" rel="stylesheet">
		<!-- Style.css -->
		<link href="{{ asset('css/website/css/style.css') }}" rel="stylesheet">
        <!-- Tailwindcss -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700&display=swap" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- CDN --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        @yield('css')
	</head>
	<body>

		<header class="header ">
			<div class="container">
				<div class="clearfix navigation">
					<div class="logo"><a href="{{ route('Website.Index') }}"><img src="{{ asset('img/website/logo.png') }}" alt="Automan" class="img-responsive"></a></div> <!-- end .logo -->
					<div class="contact">
					</div> <!-- end .contact -->
					<nav class="main-nav">
						<ul class="list-unstyled">

							<li class="active">
								<a href="{{url('index')}}">Home</a>
							</li>
							<li>
								<a href="listing-grid-view.html">Cars</a>
								<ul>
									<li><a href="listing-grid-view.html">Listing Grid View</a></li>
									<li><a href="listing-list-view.html">Listing List View</a></li>
									<li><a href="details.html">Details 1</a></li>
									<li><a href="details-1.html">Details 2</a></li>
								</ul>
							</li>
							<li>
								<a href="compare.html">Compare</a>
								<ul>
									<li><a href="compare.html">Compare</a></li>
									<li><a href="compare-details.html">Compare Details</a></li>
								</ul>
							</li>
							<li>
								<a href="blog.html">Blog</a>
								<ul>
									<li><a href="blog.html">Blog</a></li>
									<li><a href="blog-post.html">Blog Post</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Pages</a>
								<ul>
									<li><a href="about-us.html">About Us</a></li>
									<li><a href="shortcodes.html">Shortcodes</a></li>
								</ul>
							</li>
							<li><a href="{{url('contact-us')}}">Contact Us</a></li>
                            <!-- User component -->
                            <li>
								<a class="mr-32" href="">
                                     <i class="px-4 text-gray-100 bg-gray-600 rounded-t-md ion-ios-person fa-2x"></i> </a>
									<ul>
                                    @auth
									<li><a href="{{url('/edit-user')}}"> @lang('Profile') </a></li>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @endauth
                                    @guest
                                    <li><a href="{{ url('/') }}">Login</a></li>
                                    @endguest
								</ul>
							</li>
						</ul>
					</nav> <!-- end .main-nav -->
					<a href="#" class="responsive-menu-open"><i class="fa fa-bars"></i></a>
				</div> <!-- end .navigation -->
			</div> <!-- end .container -->
		</header> <!-- end .header -->
		<div class="responsive-menu">
			<a href="#" class="responsive-menu-close"><i class="ion-android-close"></i></a>
			<nav class="responsive-nav"></nav> <!-- end .responsive-nav -->
		</div> <!-- end .responsive-menu -->

        <main>
            @yield('website')
        </main>


		<footer class="footer">
			<div class="top" style="padding-top:50px;">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<h5>About Us</h5>
							<p>Lorem ipsum dolor sit amet, consectetur  some dymm adipiscing elit. Nam turpis quam, sodales in text she ante sagittis, varius efficitur mauris.</p>
                            <hr class="my-10"/>
                            <!-- Call Setting globaly -->
                            @php
                              use App\Models\Settings;
                              $Settings = Settings::all()->first();
                            @endphp
							<div class="iconbox-left">
								<div class="icon"><i class="fa fa-map-marker"></i></div> <!-- end .icon -->
								<div class="content"><p>{{ $Settings->location }}</p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
							<div class="iconbox-left">
								<div class="icon"><i class="fa fa-envelope"></i></div> <!-- end .icon -->
								<div class="content"><p> {{ $Settings->email }} </p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
							<div class="iconbox-left">
								<div class="icon"><i class="fa fa-phone"></i></div> <!-- end .icon -->
								<div class="content"><p>{{ $Settings->phone }}</p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
						</div> <!-- end .col-sm-4 -->
						<div class="col-sm-4">
							<h5>Featured Deals</h5>
                            <div id="footer-parts" class="part-one">
                                <div class="row">
                                    <div class="img col-md-3">
                                        <img src="{{ asset('img/agency/161282191711464.png') }}" alt="">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="part-info col-md-3">
                                        <div>Price</div>
                                        <div>Name</div>
                                    </div>
                                </div>
                            </div>
                            <div id="footer-parts" class="part-two">
                                <div class="row">
                                    <div class="img col-md-3">
                                        <img src="{{ asset('img/agency/161282191711464.png') }}" alt="">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="part-info col-md-3">
                                        <div>Price</div>
                                        <div>Name</div>
                                    </div>
                                </div>
                            </div>
                            <div id="footer-parts" class="part-three">
                                <div class="row">
                                    <div class="img col-md-3">
                                        <img src="{{ asset('img/agency/161282191711464.png') }}" alt="">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="part-info col-md-3">
                                        <div>Price</div>
                                        <div>Name</div>
                                    </div>
                                </div>
                            </div>
                            <div id="footer-parts" class="part-four">
                                <div class="row">
                                    <div class="img col-md-3">
                                        <img src="{{ asset('img/agency/161282191711464.png') }}" alt="">
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="part-info col-md-3">
                                        <div>Price</div>
                                        <div>Name</div>
                                    </div>
                                </div>
                            </div>

						</div> <!-- end .col-sm-4 -->
						<div class="col-sm-4">
							<h5>Get in Touch</h5>
                            <div class="row">
                                <div class="col-md-12">
                                   Feel Free To  <a href="{{ url('contact-us') }}">
                                    Contact us   <i class="fas fa-envelope-open-text"></i></a>
                                </div>
                                <div id="in-touch" class="col-md-12">
                                    Check<a href="#"> Terms <i class="fas fa-journal-whills"></i> </a>
                                 </div>
                                 <div id="in-touch" class="col-md-12">
                                    See Our <a href="#"> Policy <i class="fas fa-handshake"></i> </a>
                                 </div>
                            </div>
                            {{-- social links --}}
                            <h5 style="margin-top:15px;margin-bottom:10px;">Social Media</h5>
                            <div class="row">
                                <div class="col-md-12">
                                <!-- Instagram -->
                                <a id="insta" class="btn btn-primary"  href="#!" role="button"
                                title="Check our Instagram"
                                ><i class="fab fa-instagram"></i
                                ></a>
                                <!-- Whatsapp -->
                                <a id="whatsapp" class="btn btn-primary" href="#!" role="button"
                                title="Contact us on WhatsApp"
                                ><i class="fab fa-whatsapp"></i
                                ></a>
                                </div>
                            </div>
                            {{-- Download IOS/ANDRIOD --}}
                            <h5 style="margin-top:15px;margin-bottom:10px;">Download Our App..</h5>
                            <div class="row">
                                <div class="col-md-12">
                                <!-- Ios -->
                                <a class="btn btn-primary"
                                id="ios"
                                title="Download Ios App"
                                href="#!" role="button">
                                <i class="fab fa-apple"></i></a>
                                <!-- Andriod -->
                                    <a class="btn btn-primary"
                                    id="andriod"
                                    title="Download Andriod App"
                                    href="#!" role="button">
                                    <i class="fab fa-android"></i></a>
                                </div>
                            </div>
                            </div>
                            {{-- End Footer --}}
                            </div>
						</div> <!-- end .col-sm-4 -->
					</div> <!-- end .row -->
				</div> <!-- end .container -->
			</div> <!-- end .top -->
			<div class="bottom">
				<span class="copyright">Copyright 2015. All Rights Reserved by Automan. Designed by Theme Designer.</span>
			</div> <!-- end .bottom -->
		</footer> <!-- end .footer -->

		<!-- jQuery -->
		<script src="{{ asset('js/website/js/jquery-1.11.2.min.js') }}"></script>
		<!-- Bootstrap -->
		<script src="{{ asset('js/website/js/bootstrap.min.js') }}"></script>
		<!-- Inview -->
		<script src="{{ asset('js/website/js/jquery.inview.min.js') }}"></script>
		<!-- google maps -->
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<!-- Tweetie -->
		<script src="{{ asset('js/website/scripts/Tweetie/tweetie.min.js') }}"></script>
		<!-- FlexSlider -->
		<script src="{{ asset('js/website/scripts/FlexSlider/jquery.flexslider-min.js') }}"></script>
		<!-- Owl Carousel -->
		<script src="{{ asset('js/website/js/owl.carousel.min.js') }}"></script>
		<!-- Isotope -->
		<script src="{{ asset('js/website/js/isotope.pkgd.min.js') }}"></script>

		<script src="{{ asset('js/website/js/imagesloaded.pkgd.min.js') }}"></script>
		<!-- noUiSlider -->
		<script src="{{ asset('js/website/js/jquery.nouislider.all.min.js') }}"></script>
		<!-- Scripts.js -->
		<script src="{{ asset('js/website/js/scripts.js') }}"></script>

        @yield('js')

	</body>

<!-- Mirrored from premiumlayers.com/html/automan/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Sep 2021 05:37:39 GMT -->
</html>
