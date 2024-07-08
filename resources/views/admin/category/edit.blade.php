@extends('admin.layouts.app')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form action="{{ route('admin.category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Tên</label>
                    <input type="text" class="form-control" value="{{ $data->title }}" id="title" name="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="image">Ảnh</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="desc">Mô Tả</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Enter description">{{ $data->desc }}</textarea>
                </div>
                <!-- Created_at will be automatically set to the current time -->
                <button type="submit" class="btn btn-primary">Sửa danh mục</button>
            </form>




        </div>
        <!-- /.container-fluid -->

@endsection
