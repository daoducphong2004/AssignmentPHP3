@extends('layout.app')

@section('content')
    <main class="container">
        <div style="margin-top:20px" class="search-box">
            <form action="{{ route('search') }}" method="GET">
                <div class="input-group mb-12">
                    <input style="height: 50px" type="text" name="keyword" class="form-control" placeholder="Search"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'" value="{{ $keyword ?? '' }}">
                    <div class="input-group-append">
                        <button style="height: 50px;padding:14px 14px"
                            class="button rounded-0 primary-bg text-white h-100 btn_1 boxed-btn" type="submit">Tìm
                            Kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="search-results">
            <h2>Kết quả tìm kiếm cho "{{ $keyword }}"</h2>
            <ul>
                @forelse ($results as $result)
                    <div class="section-top-border">
                        <div class="row">
                            <div class="col-md-3">
                               <a href="{{ route('news.show',$result->id) }}"> <img src="{{ asset( $result->img) }}" alt="{{ $result->title }}"class="img-fluid"></a>
                            </div>
                            <div class="col-md-9 mt-sm-20">
                                <h3 class="mb-30">{{ $result->title }}</h3>
                                <p>{{ $result->desc }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <li>Không có kết quả phù hợp.</li>
                @endforelse
            </ul>
        </div>
    </main>
@endsection
