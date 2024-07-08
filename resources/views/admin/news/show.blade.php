@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form action="#" method="post" enctype="multipart/form-data">

            <label for="title">Tiêu đề:</label>
            <input class="form-control" value=" {{ $news->title }}" type="text" disabled id="title" name="title"><br><br>

            <label for="img">Hình ảnh:</label>
            <img style="max-width: 200px;" src="{{asset( $news->img)}}" alt=""> <br><br>

            <label for="desc">Mô tả:</label>
            <textarea class="form-control" id="desc" disabled name="desc">{{ $news->desc }}</textarea><br><br>

            <label for="content">Nội dung:</label>
            <textarea class="form-control" id="content"disabled name="content">{{ $news->content }}</textarea><br><br>

            <label for="view">Lượt xem:</label>
            <input class="form-control" type="number"disabled id="view" value="{{ $news->view }}" name="view"><br><br>

            <label for="id_author">ID Tác giả:</label>
            <select class="form-control" id="id_author"disabled name="id_author">
                <option value="">chọn tác giả</option>
                @foreach ($author as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $news->id_author ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            <br><br>

            <label for="id_category">Thể Loại:</label>
            <select class="form-control" id="id_category"disabled name="id_category">
                <option value="">Chọn thể loại</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $news->id_category ? 'selected' : '' }}>{{ $item->title }}</option>
                @endforeach
            </select>

            <br><br>
            <a href="{{ route('admin.news.edit',$news->id) }}" class="btn btn-primary btn-user btn-block" type="submit">Form sửa tin tức</a>
            <a href="{{ url()->previous() }}" class="btn btn-danger btn-user btn-block" type="submit">Quay Lại</a>
        </form>
    </div>

    <!-- /.container-fluid -->
@endsection
