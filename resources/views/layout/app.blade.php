<?php
use App\Models\category;
$category = category::all();
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} </title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href={{ asset('assets/css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/ticker-style.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/flaticon.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/slicknav.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/animate.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/magnific-popup.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/fontawesome-all.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/themify-icons.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/slick.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/nice-select.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/responsive.css') }}>
    @vite('resources/js/app.js')

</head>

<body>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-mid d-none d-md-block">
                    <div class="container">
                        <div class="row d-flex ">
                            <!-- Logo -->
                            <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                                <div class="logo ">
                                    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/logo.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                <div class="sticky-logo">
                                    <a href="{{ route('home') }}"><img style="max-width: 200px;"
                                            src="{{ asset('assets/img/logo/logo.png') }}" alt=""></a>
                                </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                                            <li><a href="{{ route('category') }}">Danh Mục</a>
                                                <ul class="submenu">
                                                    @foreach ($category as $item)
                                                    <li><a href="{{ route('category.show',$item->id) }}">{{ $item->title }}</a></li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                            <li><a href="{{ route('aboutus') }}">Giới Thiệu</a></li>
                                            <li><a href="{{ route('contact.create') }}">Liên Hệ</a></li>
                                            <li><a href="#">Chức Năng</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('login') }}">Đăng Nhập</a></li>
                                                    <li><a href="{{ route('register') }}">Đăng Ký</a></li>
                                                    <li><a href="elements.html">Element</a></li>
                                                </ul>
                                            </li>
                                            @guest

                                                @if (Route::has('login'))
                                                    <li>
                                                        <a href="{{ route('login') }}">{{ __('Đăng Nhập') }}</a>
                                                    </li>
                                                @endif
                                                @if (Route::has('register'))
                                                    <li>
                                                        <a href="{{ route('register') }}">{{ __('Đăng Ký') }}</a>
                                                    </li>
                                                @endif
                                            @else
                                                <li><a href=""> {{ Auth::user()->name }}</a>
                                                    <ul class="submenu">
                                                        <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                      document.getElementById('logout-form').submit();">
                                                                {{ __('Đăng Xuất') }}
                                                            </a></li>
                                                        <li>
                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endguest
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4">
                                    <div class="header-right-btn f-right d-none d-lg-block">


                                    </div>
                                    <aside class="single_sidebar_widget search_widget">
                                        <form action="{{ route('search') }}">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" style="border-radius: 10px; margin-right: 10px" name='keyword' placeholder="Keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="genric-btn info circle arrow" type="button"><i class="ti-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </aside>
                                </div>
                                <!-- Mobile Menu -->
                                <div class="col-12">
                                    <div class="mobile_menu d-block d-md-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->
        </header>

        @yield('content')

        <footer>
            <!-- Footer Start-->
            <div class="footer-area footer-padding fix">
                <div class="container">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                            <div class="single-footer-caption">
                                <div class="single-footer-caption">
                                    <!-- logo -->
                                    <div class="footer-logo">
                                        <a href="{{ route('home') }}"><img style="max-width: 300px"
                                                src="{{ asset('assets/img/logo/logo.png') }}" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Chúng tôi là một nhóm đam mê sáng tạo, luôn cập nhật những thông tin mới nhất
                                                và hữu ích nhất trong các lĩnh vực công nghệ, khoa học, giáo dục, sức khỏe
                                                và kinh doanh. Mục tiêu của chúng tôi là mang đến cho bạn những bài viết
                                                chất lượng cao, thông tin đa dạng và sâu sắc. Hãy theo dõi chúng tôi để
                                                không bỏ lỡ bất kỳ tin tức nào!</p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4  col-sm-6">
                            <div class="single-footer-caption mt-60">
                                <div class="footer-tittle">
                                    <h4>Đăng ký</h4>
                                    <p>Đăng ký để nhận được các tin tức mới nhất đến từ chúng tôi!</p>
                                    <!-- Form -->
                                    <div class="footer-form">
                                        <div id="mc_embed_signup">
                                            <form target="_blank"
                                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                                method="get" class="subscribe_form relative mail_part">
                                                <input type="email" name="email" id="newsletter-form-email"
                                                    placeholder="Email Address" class="placeholder hide-on-focus"
                                                    onfocus="this.placeholder = ''"
                                                    onblur="this.placeholder = ' Email Address '">
                                                <div class="form-icon">
                                                    <button type="submit" name="submit" id="newsletter-submit"
                                                        class="email_icon newsletter-submit button-contactForm"><img
                                                            src="{{ asset('assets/img/logo/form-iocn.png') }}"
                                                            alt=""></button>
                                                </div>
                                                <div class="mt-10 info"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50 mt-60">
                                <div class="footer-tittle">
                                    <h4>Instagram Feed</h4>
                                </div>
                                <div class="instagram-gellay">
                                    <ul class="insta-feed">
                                        <li><a href="#"><img src="{{ asset('assets/img/post/instra1.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('assets/img/post/instra2.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('assets/img/post/instra3.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('assets/img/post/instra4.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('assets/img/post/instra5.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                        <li><a href="#"><img src="{{ asset('assets/img/post/instra6.jpg') }}"
                                                    alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom aera -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-lg-6">
                                <div class="footer-copy-right">
                                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                        Copyright &copy;
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script> By Phongdeeptry copy in Internet
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer-menu f-right">
                                    <ul>
                                        <li><a href="#">Terms of use</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </footer>

        <!-- JS here -->

        <!-- All JS Custom Plugins Link Here here -->
        <script src="{{ asset('./assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
        <!-- Jquery, Popper, Bootstrap -->
        <script src="{{ asset('./assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('./assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('./assets/js/bootstrap.min.js') }}"></script>
        <!-- Jquery Mobile Menu -->
        <script src="{{ asset('./assets/js/jquery.slicknav.min.js') }}"></script>



        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('./assets/js/owl.carousel.min.js') }}."></script>
        <script src="{{ asset('./assets/js/slick.min.js') }}"></script>
        <!-- Date Picker -->
        <script src="{{ asset('./assets/js/gijgo.min.js') }}"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('./assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('./assets/js/animated.headline.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.magnific-popup.js') }}"></script>

        <!-- Breaking New Pluging -->
        <script src="{{ asset('./assets/js/jquery.ticker.js') }}"></script>
        <script src="{{ asset('./assets/js/site.js') }}"></script>

        <!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('./assets/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.sticky.js') }}"></script>

        <!-- contact js -->
        <script src="{{ asset('./assets/js/contact.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.form.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('./assets/js/mail-script.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.ajaxchimp.min.js') }}"></script>

        <!-- Jquery Plugins, main Jquery -->
        <script src="{{ asset('./assets/js/plugins.js') }}"></script>
        <script src="{{ asset('./assets/js/main.js') }}"></script>

    </body>

    </html>
