@extends('admin.layouts.app')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form action="{{ route('admin.account.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" placeholder="Nhập tên">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="form-group">
                    <label for="image">Ảnh đại diện</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="type">Loại người dùng</label>
                    <select class="form-control" id="type" name="type">
                        <option value="user" {{ $user->type == 'user' ? 'selected' : '' }}>Người dùng</option>
                        <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
            </form>
        </div>
        <!-- /.container-fluid -->

@endsection
