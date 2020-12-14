<!DOCTYPE html>
<html lang="rtl">

<head>
    <title>مدونة مطلق الضبيب</title>
    <meta charset="UTF-8">
    <meta name="description" content="SUNZINE Photo Studio HTML Template">
    <meta name="keywords" content="photo, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/slicknav.min.css" />
    <link rel="stylesheet" href="/css/magnific-popup.css" />
    <link rel="stylesheet" href="/css/owl.carousel.min.css" />

    <link rel="stylesheet" href="/css/style.css" />

    @yield('moreCSS')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div id="preloder">
    <div class="loader"></div>
</div>

<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu">
    <nav class="mobile__menu"></nav>
</div>


<header class="header mt-4">
    <div class="header__warp">
        <div class="header__right">
            <nav class="main__menu">
                <ul>
                    @guest
                        @if (Route::has('register'))
                        <li>
                            <span>الحساب</span>
                            <ul class="sub__menu" style="font-size: 10px;text-align: center">
                                <li><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                                <li><a href="{{ route('register') }}">التسجيل</a></li>
                            </ul>
                        </li>
                        @endif
                    @else
                        <li><a href="{{route('showCreatePost')}}"  style="color:#030415;font-size:14px">إنشاء تدوينة</a></li>
                        <li><a href="{{route('myPosts')}}"  style="color:#030415;font-size:14px">تدويناتي</a></li>
                    @endguest
                    <span style="border-left: 6px solid #ffffff;height: 10px;"></span>
                    <li><a href="/" class="menu--active">مطلق الضبيب</a></li>
                </ul>
            </nav>
        </div>
        <div class="header__left header__switches">
            <a href="#" class="nav-switch"><i class="fa fa-bars"></i></a>
            <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
            @if(auth()->check())
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                </form>
            @endif
        </div>
    </div>
</header>



@yield('articles')

@yield('article')

@yield('forms')

@yield('landing')


<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
@extends('layouts.footer')

@yield('scripts')

