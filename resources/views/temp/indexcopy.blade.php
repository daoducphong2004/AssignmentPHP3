@include('template.header')

<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        @if ($tintuc->count() > 0)
                            <div class="trending-top mb-30">
                                <div class="trend-top-img">
                                    <img src="{{ $tintuc[0]->image }}" alt="">
                                    <!-- img banner top -->
                                    <div class="trend-top-cap">
                                        <span>{{ $danhmuc[0]->title }}</span><!-- Danh Mục -->
                                        <h2><a href="{{ route('trangchu', $tintuc[0]->ID) }}">{{ $tintuc[0]->Title }}</a></h2><!-- Tiêu Đề và link bài viết -->
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @foreach ($tintuc->skip(1)->take(6) as $item)
                                    <!-- start Single Trending Item -->
                                    <div class="col-lg-4">
                                        <div class="single-bottom mb-35">
                                            <div class="trend-bottom-img mb-30">
                                                <img src="{{ $item->image }}" alt=""><!-- img -->
                                            </div>
                                            <div class="trend-bottom-cap">
                                                {{-- <span class="color1">{{ $item->->title }}</span><!-- danh mục --> --}}
                                                <h4><a href="{{ route('trangchu', $item->ID) }}">{{ $item->Title }}</a></h4><!-- title sau phải đổi lại -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Single Trending Item -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                        @foreach ($tintuc->take(5) as $item)
                            <!-- start Single Trending Item -->
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <img src="{{ $item->image }}" alt=""><!-- img -->
                                </div>
                                <div class="trand-right-cap">
                                    {{-- <span class="color1">{{ $item->category->title }}</span><!-- Danh Mục --> sau đổi lại --}}
                                    <h4><a href="{{ route('trangchu', $item->ID) }}">{{ $item->Title }}</a></h4><!-- title  sau đổi lại-->
                                </div>
                            </div>
                            <!-- end Single Trending Item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->

    <!-- Weekly-News start -->
    <div class="weekly-news-area pt-50">
        <div class="container">
            <div class="weekly-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Weekly Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly-news-active dot-style d-flex dot-style">
                            @foreach ($tintuc->take(4) as $item)
                                <div class="weekly-single">
                                    <div class="weekly-img">
                                        <img src="{{ $item->image }}" alt="">
                                    </div>
                                    <div class="weekly-caption">
                                        {{-- <span class="color1">{{ $item->category->title }}</span> sau đổi lại cả phần route--}}
                                        <h4><a href="{{ route('trangchu', $item->ID) }}">{{ $item->Title }}</a></h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Weekly-News -->

    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle mb-30">
                                <h3>What's New</h3>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <!-- start Single Trending Item -->
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                        <!-- end Single Trending Item -->
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            @foreach ($tintuc->take(6) as $item)
                                                <!-- start Single Item -->
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-what-news mb-100">
                                                        <div class="what-img">
                                                            <img src="./assets/{{ $item->image }}" alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            {{-- <span class="color1">{{ $item->category->title }}</span> --}}
                                                            <h4><a href="{{ route('trangchu', $item->ID) }}">{{ $item->Title }}</a></h4><!-- sau đổi lại phần category và phần route -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end Single Item -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->
</main>

@include('template.footer')
