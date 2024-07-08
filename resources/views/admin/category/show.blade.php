@extends('admin.layouts.app')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu Đề</label>
                    <input type="text" class="form-control" value="{{ $data->title }}" disabled id="title" name="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="image">Ảnh</label>
                    <img src="{{ asset($data->image) }}" alt="">
                </div>
                <div class="form-group">
                    <label for="desc">Mô Tả</label>
                    <textarea class="form-control" id="desc" disabled name="desc" rows="3" placeholder="Enter description">{{ $data->desc }}</textarea>
                </div>
                <!-- Created_at will be automatically set to the current time -->
            </form>




        </div>
        <!-- /.container-fluid -->

@endsection
