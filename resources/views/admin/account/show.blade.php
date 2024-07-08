@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <!-- Card for User Profile -->
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="text-center border-end">
                                    <img src="{{ asset($user->image) ?: asset('storage/account/avatar.png') }}" class="img-fluid avatar-xxl rounded-circle" alt="avatar">
                                    <h4 class="text-primary font-size-20 mt-3 mb-2"></h4>
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-9">
                                <div class="ms-3">
                                    <div>
                                        <h4 class="card-title text-primary font-size-20 mt-3 mb-2">{{ $user->name }}</h4>
                                        <!-- User's Biography -->
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <div>
                                                <p class="text-muted mb-2 fw-medium"><i class="mdi mdi-email-outline me-2"></i>{{ $user->email }}</p>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->

                <!-- Card for News Section -->
                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="news-tab" role="tabpanel">
                            <div class="row">
                                <h4 class="text-primary font-size-20 mt-3 mb-2">Tin Tức Đã Đăng</h4>

                                <!-- News Items -->
                                @foreach ($news as $item)
                                    <div class="col-lg-4">
                                        <!-- Single Trending Item -->
                                        <div class="trand-right-single d-flex">
                                            <div class="trand-right-img">
                                                <img style="height: 100px; width: 120px;" src="{{ asset($item->img) }}" alt="news-image">
                                            </div>
                                            <div class="trand-right-cap">
                                                <span class="color1">{{ $item->category->title }}</span>
                                                <h4><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></h4>
                                            </div>
                                        </div>
                                        <!-- end Single Trending Item -->
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- end tab pane -->
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
