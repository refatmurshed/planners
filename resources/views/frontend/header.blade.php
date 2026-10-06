<!DOCTYPE html>
<!-- saved from url=(0023) -->
<html lang="zxx"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- required meta tags -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Social Meta Tags-->
          

        <!-- CSRF Token -->

        <!-- title -->
        <title>Planners & Designers Association </title>
        <!-- favicon -->
        <link rel="icon" href="asset/frontend/images/favicon.png" type="image/x-icon">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="assets/frontend/css/bootstrap.min.css">
            <!-- ticker style -->
    <link rel="stylesheet" href="assets/frontend/css/breaking-news-ticker.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/frontend/css/owl.carousel.min.css">
    <!-- youbube popup -->
    <link rel="stylesheet" href="assets/frontend/css/YouTubePopUp.css">
        <!-- include css -->
        <link rel="stylesheet" href="assets/frontend/css/master.css">
        <link rel="stylesheet" href="assets/frontend/css/responsive.css">
        
        <!-- ShareThis BEGIN -->
        <!-- <iframe id="pxcelframe" title="pxcelframe" src="./প্রথম পাতা _ প্ল্যানার্স এন্ড ডিজাইনার্স এসোসিয়েশন_files/t_.html" style="display: none;"></iframe> -->
        <script async="" src="assets/frontend/js/5cac7ee99b272f00119ac05f.js.download"></script><script src="assets/frontend/js/sharethis.js.download" sticky-share-buttons"=""></script>
        <!-- ShareThis END -->
        
        <style>
            @media  screen and (min-width:768px){
                #st-2 {top: 14rem !important;}
            }
        </style>
    <script charset="utf-8" src="assets/frontend/js/button.2276a045429f6681b56da5eb1dcfa53c.js.download"></script></head>

    <body>
        <!-- navbar nav start -->
<nav class="fixed-top">

    <!-- contact nav -->
    <div class="contact-nav">
        <div class="container">
            <div class="cnav-content">

                <a href="#" class="brand">
                    <img src="assets/frontend/images/logo_fav.png" alt="">
                </a>

                <ul class="contact-information">
                    <li>
                        <a href="mailto:pdam23092017@gmail.com">
                            <i class="icon ion-ios-mail"></i>
                            pdam23092017@gmail.com
                        </a>
                    </li>

                    <li>
                        <a href="tel:01787213447">
                            <i class="icon ion-ios-call"></i>
                            01787213447
                        </a>
                    </li>
                </ul>

                <ul class="social">
                    <li>
                        <a href="https://twitter.com/maxsopofficial" target="_blank">
                            <i class="icon ion-logo-twitter"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.facebook.com/groups/1955443144736233/" target="_blank">
                            <i class="icon ion-logo-facebook"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://linkedin.com/maxsopofficial" target="_blank">
                            <i class="icon ion-logo-linkedin"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <!-- main nav -->
    <div class="navbar navbar-expand-xl">
        <div class="container">

            <a href="#" class="brand">
                <img src="assets/frontend/images/logo_fav.png" alt="">
            </a>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#nav">
                <i class="icon ion-ios-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="nav">

                <ul class="navbar-nav">

                    <li>
                        <a href="#" class="nav-link">Home</a>
                    </li>

                    <li>
                        <a href="#" class="nav-link">About Us</a>
                    </li>

                    <li>
                        <a href="#" class="nav-link">Projects</a>
                    </li>

                    <li>
                        <a href="#" class="nav-link">Gallary</a>
                    </li>

                    <li class="dropdown">

                        <span class="nav-link active" data-toggle="dropdown">
                            Founders and members
                        </span>

                        <ul class="dropdown-menu">

                            <li>
                                <a href="#">
                                    Executive Council (2018-2019)
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    Executive Council (2020-2021)
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    Executive Council (2022-2023)
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    Advisory Council (2018-2019)
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    Advisory Council (2020-2021)
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    Advisory Council (2022-2023)
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    General Member
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    Founding members
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!-- MOBILE LOGIN/REGISTER -->

                    @if (Route::has('login'))

                        @auth

                            @if(auth()->user()->role == 1)

                                <li>
                                    <a href="{{ route('subscription.pay') }}"
                                       class="nav-link reg d-lg-none d-block">
                                        Dashboard
                                    </a>
                                </li>

                            @elseif(auth()->user()->role == 2)

                                <li>
                                    <a href="{{ url('/member/dashboard') }}"
                                       class="nav-link reg d-lg-none d-block">
                                        Dashboard
                                    </a>
                                </li>

                            @endif

                        @else

                            <li>
                                <a href="{{ route('login') }}"
                                   class="nav-link reg d-lg-none d-block">
                                    Login
                                </a>
                            </li>

                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}"
                                       class="nav-link reg d-lg-none d-block">
                                        Register
                                    </a>
                                </li>
                            @endif

                        @endauth

                    @endif

                </ul>

            </div>

            <!-- DESKTOP BUTTONS -->

            @if (Route::has('login'))

                @auth

                    @if(auth()->user()->role == 1)

                        <a href="{{ route('subscription.pay') }}"
                           class="enter d-none d-xl-inline-flex">
                            Dashboard
                        </a>

                    @elseif(auth()->user()->role == 2)

                        <a href="{{ url('/member/dashboard') }}"
                           class="enter d-none d-xl-inline-flex">
                            Dashboard
                        </a>

                    @else

                        <a href="{{ url('/') }}"
                           class="enter d-none d-xl-inline-flex">
                            Home
                        </a>

                    @endif

                @else

                    <a href="{{ route('login') }}"
                       class="enter d-none d-xl-inline-flex">
                        Login
                    </a>

                    @if (Route::has('register'))

                        <a href="{{ route('register') }}"
                           class="enter d-none d-xl-inline-flex">
                            Register
                        </a>

                    @endif

                @endauth

            @endif

        </div>
    </div>

</nav>
<!-- navbar nav end -->
        <!-- navbar nav end -->


