@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Tiêu đề:</label>
            <input class="form-control" type="text" id="title" name="title"><br><br>

            <label for="img">Hình ảnh:</label>
            <input class="form-control-file" type="file" id="img" name="img"><br><br>

            <label for="desc">Mô tả:</label>
            <textarea class="form-control" id="desc" name="desc"></textarea><br><br>

            <label for="content">Nội dung:</label>
            <textarea class="form-control" id="content" name="content"></textarea><br><br>

            <label for="view">Lượt xem:</label>
            <input class="form-control" type="number" id="view" name="view"><br><br>

            <label for="id_author">ID Tác giả:</label>
            <select class="form-control" id="id_author" name="id_author">
                <option value="">chọn tác giả</option>
                @foreach ($author as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <br><br>

            <label for="id_category">Thể Loại:</label>
            <select class="form-control" id="id_category" name="id_category">
                <option value="">chọn thể loại</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
            <br><br>
            <button class="btn btn-primary btn-user btn-block" type="submit">Thêm Tin Tức</button>
        </form>
    </div>

    <!-- /.container-fluid -->
@endsection
