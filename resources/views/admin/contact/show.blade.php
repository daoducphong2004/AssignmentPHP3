@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <h1>Chi Tiết Liên Hệ</h1>
    <div class="container-fluid">
        <form action="#" method="post">
            <div class="form-group">
                <label for="title">Tiêu đề:</label>
                <input type="text" class="form-control" disabled id="title" name="title" value="{{ $contact->title }}" required>
                @if ($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" class="form-control"  disabled id="name" name="name" value="{{ $contact->name }}"
                    required>
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" disabled id="email" name="email" value="{{ $contact->email }}"
                    required>
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">Nội dung:</label>
                <textarea class="form-control" id="content" disabled name="content" rows="3" required>{{ $contact->content }}</textarea>
                @if ($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select class="form-control" id="status" disabled name="status">
                    <option value="1" @if ($contact->status == 1) selected @endif>Đã xử lý</option>
                    <option value="0" @if ($contact->status == 0) selected @endif>Chưa xử lý</option>
                </select>
                @if ($errors->has('status'))
                <div class="text-danger">{{ $errors->first('status') }}</div>
                @endif

            </div>
            <a href="{{ route('admin.contact.edit',$contact->id) }}" type="submit" class="btn btn-primary">Form sửa </a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
