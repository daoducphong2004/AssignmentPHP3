@extends('layout.app')
@section('title')
    @if(isset($selectedCategory))
        {{ $selectedCategory->title }}
    @else
        Tất cả danh mục
    @endif
@endsection

@section('content')
    <main>
        <!-- Whats New Start -->
        <section class="whats-news-area pt-50 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 col-md-3">
                                <div class="section-tittle mb-30">
                                    <h3>Có Gì Mới</h3>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="properties__button">
                                    <!--Nav Button  -->
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link" id="nav-home-tab" href="{{ route('category') }}"
                                                aria-selected="true">All</a>
                                            @foreach ($category->take(6) as $item)
                                                <a class="nav-item nav-link" id="nav-profile-tab"
                                                    href="{{ route('category.show', $item->id) }}"
                                                    aria-selected="false">{{ $item->title }}</a>
                                            @endforeach
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
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                @foreach ($news as $item)
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="single-what-news mb-100">
                                                            <div class="what-img">
                                                                <img style="max-height: 300px" src="{{ asset($item->img) }}"
                                                                    alt="{{ $item->desc }}">
                                                            </div>
                                                            <div class="what-cap">
                                                                <span class="color1">{{ $item->category_title }}</span>
                                                                <h4><a
                                                                        href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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
@endsection
