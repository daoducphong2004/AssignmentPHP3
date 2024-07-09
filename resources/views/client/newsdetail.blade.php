@extends('layout.app')
@section('title',$news->title)

@section('content')
    <style>
        .comments-area {
            margin-top: 20px;
        }

        .comment {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .reply {
            color: blue;
            cursor: pointer;
        }

        .reply-form {
            margin-top: 10px;
        }

        .reply-comment {
            margin-left: 20px;
            /* Để bình luận trả lời lệch sang phải so với bình luận gốc */
            padding: 5px;
            border-left: 2px solid #ccc;
        }
    </style>
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset($news->img) }}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>{{ $news->title }}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="{{ route('category.show', $news->category_id) }}"><i
                                            class="fa fa-folder"></i>
                                        {{ $news->category_title }}</a></li>
                                <li><i class="fa fa-eye"></i>{{ $news->view }} lượt xem</li>
                                <li><i class="fa fa-commenting"></i> {{ isset($totalComments[0]) ? $totalComments[0]->totalComments : '0' }} Bình Luận</li>
                            </ul>
                            <p>
                                {!! $news->content !!}
                            </p>

                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            <p class="like-info"><span class="align-middle"><i
                                        class="fa fa-eye"></i></span>{{ $news->view }} lượt xem</p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                            </div>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                        <div class="navigation-area">
                            {{-- Bài Viết Trước Sau Bắt Đầu --}}
                            <div class="row">
                                @if (isset($newstruocsau[0]))
                                    <div
                                        class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                        <div class="thumb">
                                            <a href="{{ route('news.show', $newstruocsau[0]->id) }}">
                                                <img class="img-fluid"
                                                    style="max-height: 100px" src="{{ asset($newstruocsau[0]->img) }}"
                                                    alt="{{ $newstruocsau[0]->title }}">
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('news.show', $newstruocsau[0]->id) }}">
                                                <span class="lnr text-white ti-arrow-left"></span>
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Bài Viết Trước</p>
                                            <a href="{{ route('news.show', $newstruocsau[0]->id) }}">
                                                <h4>{{ $newstruocsau[0]->title }}</h4>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($newstruocsau[1]))
                                    <div
                                        class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                        <div class="detials">
                                            <p>Bài Viết Tiếp Theo</p>
                                            <a href="{{ route('news.show', $newstruocsau[1]->id) }}">
                                                <h4>{{ $newstruocsau[1]->title }}</h4>
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('news.show', $newstruocsau[1]->id) }}">
                                                <span class="lnr text-white ti-arrow-right"></span>
                                            </a>
                                        </div>
                                        <div class="thumb">
                                            <a href="{{ route('news.show', $newstruocsau[1]->id) }}">
                                                <img class="img-fluid"
                                                    style="max-height: 100px" src="{{ asset($newstruocsau[1]->img) }}"
                                                    alt="{{ $newstruocsau[1]->title }}">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            {{-- Bài Viết Trước Sau Kết Thúc --}}
                        </div>
                    </div>
                </div>
                <div class="comments-area">
                    <div class="container">
                        <h3>Bình luận</h3>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('comments.store', $news->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content">Nội Dung</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                            <input type="hidden" name="parent_id" value="0">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>

                        <div class="comments mt-4">

                            @foreach ($comments as $comment)
                                <div class="comment">
                                    <img src="{{ asset('assets/img/team/1.png') }}"style='max-width:50px' alt="">
                                    <strong>{{ $comment->name }}</strong>
                                    <p>{{ $comment->content }}</p>
                                    <p>{{ $comment->created_at }}</p>
                                    <a href="#" class="reply" data-comment-id="{{ $comment->id }}">Trả lời</a>

                                    <!-- Form trả lời bình luận -->
                                    <form action="{{ route('comments.store', $news->id) }}" method="POST"
                                        class="reply-form" style="display: none;">
                                        @csrf
                                        <div class="form-group">
                                            <label for="content">Nội Dung</label>
                                            <textarea class="form-control" id="content" name="content" rows="2" required></textarea>
                                        </div>
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                    </form>
                                    @foreach ($comment->replies as $reply)
                                        <div style="margin-left: 30px" class="comment reply-comment">
                                            <img src="{{ asset('assets/img/team/1.png') }}"style='max-width:50px'
                                                alt="">
                                            <strong>{{ $reply->name }}</strong>
                                            <p>{{ $reply->content }}</p>
                                            <p>{{ $comment->created_at }}</p>

                                        </div>
                                    @endforeach

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    {{-- Tìm Kiếm Bắt Đầu --}}
                    <aside class="single_sidebar_widget search_widget">
                        <form action="{{ route('search') }}">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder='Search Keyword'
                                        onfocus="this.placeholder = ''" name='keyword' onblur="this.placeholder = 'Search Keyword'">
                                    <div class="input-group-append">
                                        <button class="btns" type="button"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                type="submit">Search</button>
                        </form>
                    </aside>
                    {{-- Tìm Kiếm Kết Thúc --}}

                    {{-- Danh mục bắt đầu --}}
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Danh Mục</h4>
                        <ul class="list cat-list">
                            @foreach ($category as $item)
                                <li>
                                    <a href="{{ route('category.show', $item->id) }}" class="d-flex">
                                        <p>{{ $item->title }}</p>
                                        <p>({{ $item->tongbaiviet }})</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Bài đăng liên quan</h3>
                        @foreach ($tintuclq as $item)
                            <div class="media post_item">
                                <img style="max-width: 100px;" src="{{ asset($item->img) }}"
                                    alt="post">
                                <div class="media-body">
                                    <a href="{{ route('news.show', $item->id) }}">
                                        <h3>{{ $item->title }}</h3>
                                    </a>
                                    <p>{{ $item->created_at }}</p>
                                </div>
                            </div>
                        @endforeach
                    </aside>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.reply').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const commentId = this.dataset.commentId;
                const replyForm = this.nextElementSibling;
                replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
@endsection
