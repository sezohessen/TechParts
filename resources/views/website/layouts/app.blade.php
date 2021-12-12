<!DOCTYPE html>
<html lang="en" @if (App::isLocale('ar')) direction="rtl" dir="rtl" style="direction: rtl" @endif>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ LangDetail(App\Models\Settings::first()->appName,App\Models\Settings::first()->appName_ar) }} @yield('title',@$page_title ? ' | '.@$page_title : '')</title>

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
    <!-- Metronic css -->
    <link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css"/>

    @if (App::isLocale('ar')) <link href="{{ asset('css/website/css/style_ar.css') }}" rel="stylesheet"> @endif
    <!-- Tailwindcss -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if (App::isLocale('ar')) <link rel="stylesheet" href="{{ asset('css/website/css/fontfamilyAR.css') }}"> @endif
    <link href="{{ asset('css/pages/error/error-3.css') }}" rel="stylesheet" type="text/css"/>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/settings/TO-PART-LOGO.svg') }}" />
    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />



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
    <header class="header">
        <div class="container">
            <div class="clearfix navigation">
                <div class="logo"><a href="{{ route('Website.Index') }}"><img style='height: 65px;' src="{{find_image(App\Models\Settings::first()->logo,'img/settings/')}}" alt="Automan" class="p-4 img-responsive"></a></div> <!-- end .logo -->
                <div class="contact">
                </div> <!-- end .contact -->
                <nav class="main-nav">
                    <ul class="list-unstyled">

                        <li class="active">
                            <a href="{{ route('Website.Index') }}">@lang('Home')</a>
                        </li>
                        <li class="favorite">
                            <a href="{{ route('Website.favorite')}}">@lang('Favorite')
                        @if (Auth::check())<span id="QtyCount">( {{  App\Models\UserFav::where('user_id', Auth()->user()->id)->count(); }} )</span>@endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Messenger') }}">
                                @lang('Messenger') <i class="far fa-comments fa-lg"></i>
                                @if (Auth::check())
                                    @php
                                        $resevedMessages = App\Models\ChMessage::where('to_id',@Auth()->user()->id)
                                        ->where('seen',0)
                                        ->groupBy('from_id')
                                        ->get();
                                    @endphp
                                    @if($resevedMessages->count())
                                        <div class="resMessages" id="TotalMessages">
                                            <span class="number-of-messages" id="Unseen">{{ $resevedMessages->count() }}</span>
                                        </div>
                                    @endif
                                @endif
                            </a>
                        </li>
                        <li><a href="{{ route('Website.ContactUs') }}">@lang('Contact Us')</a></li>

                        <!-- Langague -->
                        <li class="relative nav-lang-container">
                            <a href="">@lang('language')</a>
                            <ul class="absolute left-0 nav-lang" id='nav-lang'>
                                <li class="py-3 navi-item">
                                    <a href="{{url('/lang/en')}}" class="navi-link @if (App::isLocale('en'))  active  @endif">
                                        <div>
                                            <div class="flex">
                                                <span class="leading-10">@lang('English') </span>
                                                <img class="mr-auto" style="height: 30px;" src="{{ asset('img/language/united-kingdom.svg') }}" alt=""/>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="py-3 navi-item">
                                    <a href="{{url('/lang/ar')}}" class="navi-link @if (App::isLocale('ar'))  active  @endif" href="{{url('/ar')}}">
                                        <div>
                                            <div class="flex">
                                                <span class="leading-10">@lang('Arabic') </span>
                                                <img class="mr-auto" style="height: 20px;" src="{{ asset('img/language/Flag_of_Egypt.svg') }}" alt=""/>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- User component -->
                        <li class="relative">
                            <a id="user-logo" href="#">
                                <i class="px-4 text-gray-100 bg-gray-600 rounded-lg ion-ios-person fa-2x"></i>
                            </a>
                            <a href="#" class="visible-xs visible-sm hidden-lg hidden-md">@lang('Account')</a>
                            <ul class="absolute right-0">
                            @auth
                            <li>
                                @if (auth()->user()->hasRole('seller'))
                                    <a href="{{ route('seller.index') }}"> @lang('Dashboard') </a>
                                @elseif (auth()->user()->hasRole('administrator') || auth()->user()->hasRole('superadministrator'))
                                    <a href="{{ route('dashboard.dashboard') }}"> @lang('Dashboard') </a>
                                @endif
                            </li>
                            <li><a href="{{ route('Website.EditUser') }}"> @lang('Profile') </a></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            @endauth
                            @guest
                            <li class="p-4"><a href="{{ route('login') }}">@lang('Login')</a></li>
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
                    <div class="my-10 col-md-4 col-sm-6 col-xs-12">
                        <h3 class="mb-10 sm:font-bold sm:text-3xl">@lang('About Us')</h3>
                        @php
                            $settings  = App\Models\Settings::first();
                        @endphp
                        {{-- <p>{{ LangDetail($settings->about_us,$settings->about_us_ar) }}</p> --}}
                        <p>@lang('A website that provide easy access to auto parts companies and stores.')</p>
                        <hr class="my-10"/>
                        <!-- Call Setting globaly -->
                        @php
                            use App\Models\Settings;
                            $Settings = Settings::all()->first();
                        @endphp
                        <div class="iconbox-left">
                            <div class="px-5 icon"><i class="fa fa-map-marker"></i></div> <!-- end .icon -->
                            <div class="content"><p>{{ $Settings->location }}</p></div> <!-- end .content -->
                        </div> <!-- end .iconbox-left -->
                        <div class="iconbox-left">
                            <div class="px-5 icon"><i class="fa fa-envelope"></i></div> <!-- end .icon -->
                            <div class="content"><p> {{ $Settings->email }} </p></div> <!-- end .content -->
                        </div> <!-- end .iconbox-left -->
                        <div class="iconbox-left">
                            <div class="px-5 icon"><i class="fa fa-phone"></i></div> <!-- end .icon -->
                            <div class="content"><p>{{ $Settings->phone }}</p></div> <!-- end .content -->
                        </div> <!-- end .iconbox-left -->
                    </div> <!-- end .col-sm-4 -->
                    <div class="my-10 col-md-4 col-sm-6 col-xs-12">
                        <h3 class="mb-10 sm:font-bold sm:text-3xl sm:mb-16 ">@lang('Top Sellers')</h3>
                        @php
                            $footerSellers = App\Models\Seller::leftJoin('sellers_rating', 'sellers_rating.seller_id', '=', 'sellers.id')
                        ->select('sellers.*', DB::raw('AVG(rating) as rating_average' ))->groupBy('id')->orderBy('rating_average', 'DESC')->limit(3)->get();
                        @endphp
                        @foreach ($footerSellers as $seller)
                            <div id="footer-parts">
                                <div class="row">
                                    <div class="img col-md-4 col-xs-6">
                                        @if (!$seller->avatar)
                                        <img
                                            src="{{asset('img/avatar/user-profile.png')}}" alt="Profile picture">
                                        @else
                                        <img
                                            src="{{find_image($seller->sellerAvatar , App\Models\Seller::avatarBase)}}" alt="{{$seller->sellerAvatar->name}}">
                                        @endif
                                    </div>
                                    <div class="part-info col-md-8 col-xs-6">
                                        <a href="{{ route('Website.SellerProfile',['id'=>$seller->user->id,'first'=>$seller->user->first_name,'second'=>$seller->user->last_name]) }}">
                                            {{ $seller->user->FullName }}
                                        </a>
                                        @if ($seller->governorate)
                                            <p>{{ LangDetail($seller->governorate->title,$seller->governorate->title_ar) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div> <!-- end .col-sm-4 -->
                    <div class="my-10 col-md-4 col-sm-12 col-xs-12">
                        <h3 class="mb-10 sm:font-bold sm:text-3xl ">@lang('Get in Touch')</h3>
                        <div class="row">
                            <div class="iconbox-left">
                                <div class="px-5 icon"><i class="fas fa-envelope-open-text"></i></div> <!-- end .icon -->
                                <div class="content"><a href="{{ route('Website.ContactUs') }}">@lang('Feel free to contact us')</a> </div> <!-- end .content -->
                            </div> <!-- end .iconbox-left -->
                            <div class="iconbox-left">
                                <div class="px-5 icon"><i class="fas fa-journal-whills"></i></div> <!-- end .icon -->
                                <div class="content"><a href="{{ route('OurTerms') }}">@lang('Check Terms and Conditions')</a></div> <!-- end .content -->
                            </div> <!-- end .iconbox-left -->
                            <div class="iconbox-left">
                                <div class="px-5 icon"><i class="fas fa-handshake"></i></div> <!-- end .icon -->
                                <div class="content"><a href="{{ route('OurPolicy') }}">@lang('Check Privacy and Policy')</a></div> <!-- end .content -->
                            </div> <!-- end .iconbox-left -->
                        </div>
                        <!-- {{-- social links --}} -->
                        @if ($Settings->instgram || $Settings->whatsapp)
                        <h5 style="margin-top:15px;margin-bottom:10px;">@lang('Our Social media links')</h5>
                        <div class="row">
                            <div class="col-md-12">
                            @if ($Settings->instgram)
                                <!-- Instagram -->
                                <a id="insta" class="btn btn-primary"  href="#!" role="button"
                                title="Check our Instagram"
                                ><i class="fab fa-instagram"></i
                                ></a>
                            @endif
                            @if ($Settings->whatsapp)
                                <!-- Whatsapp -->
                                <a id="whatsapp" class="btn btn-primary"
                                href="https://api.whatsapp.com/send?phone={{$Settings->whatsapp}}" role="button"
                                target="_blank"
                                title="{{ $Settings->whatsapp }}"
                                ><i class="fab fa-whatsapp"></i
                                ></a>
                            @endif
                            </div>
                        </div>
                        @endif
                        <!-- {{-- Download IOS/ANDRIOD --}} -->
                        @if ($Settings->andriod || $Settings->ios)
                            <h5 style="margin-top:15px;margin-bottom:10px;">@lang('Download Our App..')</h5>
                            <div class="row">
                                <div class="col-md-12">
                                @if ($Settings->ios)
                                    <!-- Ios -->
                                    <a class="btn btn-primary"
                                    id="ios"
                                    title="Download Ios App"
                                    href="#!" role="button">
                                    <i class="fab fa-apple"></i></a>
                                @endif
                                @if ($Settings->andriod)
                                    <!-- Andriod -->
                                    <a class="btn btn-primary"
                                    id="andriod"
                                    title="Download Andriod App"
                                    href="#!" role="button">
                                    <i class="fab fa-android"></i></a>
                                @endif
                                </div>
                            </div>
                        @endif
                        </div>
                        {{-- End Footer --}}
                        </div>
                    </div> <!-- end .col-sm-4 -->
                </div> <!-- end .row -->
            </div> <!-- end .container -->
        </div> <!-- end .top -->
        <div class="bottom">
            <span class="copyright sm:text-lg sm:font-semibold">&copy;  ToPart.Services {{ now()->format('Y') }} @lang('Copyright All Rights Reserved.')</span>
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
    {{-- <script src="{{asset("js/pages/custom/login/login-general.js")}}"></script> --}}
    @yield('js')
    @yield('jsFav')
</body>
</html>
