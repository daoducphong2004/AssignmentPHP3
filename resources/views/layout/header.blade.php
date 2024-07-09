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
