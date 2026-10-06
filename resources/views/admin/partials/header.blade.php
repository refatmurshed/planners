<!DOCTYPE html>
<html style="height: auto; min-height: 100%;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset ('images/favicon.png')}}">
    <title>Planners & Designers</title>

    <!-- CSRF Token -->

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset ('assets/admin/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('assets/admin/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset ('assets/admin/ionicons.min.css')}}">

    
    <link rel="stylesheet" href="{{asset ('assets/admin/toastr.min.css')}}">

    <!--jquery-confirm -->
    <link rel="stylesheet" href="{{asset ('assets/admin/jquery-confirm.min.css')}}">

    <!-- datepicker -->
    <link rel="stylesheet" href="{{asset ('assets/admin/bootstrap-datepicker.min.css')}}">

        <style>.has-success .error {visibility: hidden !important;display: none !important;}</style>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset ('assets/admin/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset ('assets/admin/_all-skins.min.css')}}">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="{{asset ('assets/admin/css')}}">


    <!-- font owsome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset ('assets/admin/all.min.css')}}">


</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
sidebar-collapse
-->
<body class="sidebar-mini skin-black-light" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">

    <!-- Main Header -->
    <style>
    .skin-black-light .main-header .logo {border-right: 1px solid #f5f5f5 !important;}
    .skin-black-light .main-header .navbar>.sidebar-toggle {border-right: 1px solid #f5f5f5 !important;}
    .skin-black-light .main-header .navbar .navbar-custom-menu .navbar-nav>li>a,
    .skin-black-light .main-header .navbar .navbar-right>li>a { border-left: 1px solid #f5f5f5 !important;}
</style>

<header class="main-header">

    <!-- Logo -->
    <a href="{{asset ('images/logo_fav.png')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->

        <span class="logo-mini">
            <img src="{{asset ('images/logo_fav.png')}}" alt="">
        </span>
        <!-- logo for regular state and mobile devices -->


        <span class="logo-lg">
            <img src="{{asset ('images/logo_fav.png')}}" alt="">
        </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                

                    

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{asset ('images/profile.png')}}" class="user-image profile_photo" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{asset ('images/profile.png')}}" class="img-circle profile_photo" alt="User Image">
                            <p>
                                
                            


                            @guest
                @if (Route::has('login'))
                    
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    
                @endif

                @if (Route::has('register'))
                    
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    
                @endif
            @else

            
            <div class="pull-left" style="margin:10%; color:white">
                <a id="navbarDropdown" class="d-none" href="#" >
                        {{ Auth::user()->name }}
                </a>
            </div>
            <div class="pull-right" style="margin:10%; color:white">
                <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
            </div>
                                
            @endguest

                            </p>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                -->
            </ul>
        </div>
    </nav>
</header>