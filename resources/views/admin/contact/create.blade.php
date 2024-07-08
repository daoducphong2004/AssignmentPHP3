@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <h1 class="h3 mb-2 text-gray-800">Thêm Liên Hệ</h1>

    <div class="container-fluid">
        <form action="{{ route('admin.contact.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Tiêu đề:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                @if ($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">Nội dung:</label>
                <textarea class="form-control" id="content" name="content" rows="3" required>{{ old('content') }}</textarea>
                @if ($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Gửi</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
