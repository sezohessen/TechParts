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

        {{-- CDN --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>

		<header class="header">
			<div class="container">
				<div class="clearfix navigation">
					<div class="logo"><a href="index.html"><img src="{{ asset('img/website/logo.png') }}" alt="Automan" class="img-responsive"></a></div> <!-- end .logo -->
					<div class="login"><a href="#"><i class="ion-ios-person"></i></a></div> <!-- end .login -->
					<div class="contact">
					</div> <!-- end .contact -->
					<nav class="main-nav">
						<ul class="list-unstyled">
							<li class="active">
								<a href="index.html">Home</a>
								<ul>
									<li><a href="index.html">Homepage 1</a></li>
									<li><a href="homepage2.html">Homepage 2</a></li>
									<li><a href="homepage3.html">Homepage 3</a></li>
								</ul>
							</li>
							<li>
								<a href="add-car-details.html">Add Car</a>
								<ul>
									<li><a href="add-car-details.html">Add Car Details</a></li>
									<li><a href="choose-specification.html">Choose Specification</a></li>
									<li><a href="contact-details.html">Contact Details</a></li>
									<li><a href="photos-videos.html">Photos Videos</a></li>
									<li><a href="pay-publish.html">Pay Publish</a></li>
								</ul>
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
							<li><a href="contact-us.html">Contact Us</a></li>
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
							<hr />
							<div class="iconbox-left">
								<div class="icon"><i class="fa fa-map-marker"></i></div> <!-- end .icon -->
								<div class="content"><p>3015 Grand Ave, Coconut Grove, Merrick Way, FL 12345</p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
							<div class="iconbox-left">
								<div class="icon"><i class="fa fa-envelope"></i></div> <!-- end .icon -->
								<div class="content"><p>info@wheels-control.com</p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
							<div class="iconbox-left">
								<div class="icon"><i class="fa fa-phone"></i></div> <!-- end .icon -->
								<div class="content"><p>123-456-7890</p></div> <!-- end .content -->
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
                                <a class="btn btn-primary" style="background-color: #ac2bac;" href="#!" role="button"
                                ><i class="fab fa-instagram"></i
                                ></a>
                                <!-- Whatsapp -->
                                <a class="btn btn-primary" style="background-color: #25d366;" href="#!" role="button"
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
                                style="background-color: #ac2bac;" href="#!" role="button">
                                <i class="fab fa-apple"></i></a>
                                <!-- Andriod -->
                                    <a class="btn btn-primary"
                                    style="background-color: #25d366;" href="#!" role="button">
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

	</body>

<!-- Mirrored from premiumlayers.com/html/automan/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Sep 2021 05:37:39 GMT -->
</html>
