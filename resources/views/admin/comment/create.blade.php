@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.comment.store') }}">
            @csrf
            <div class="form-group">
                <label for="tintuc_id">Tin Tức ID:</label>
                <select type="text" class="form-control" id="tintuc_id" name="tintuc_id" required>
                    <option value="">Chọn bài viết</option>
                    @foreach ($news as $tintuc)
                    <option value="{{ $tintuc->id }}">{{ $tintuc->id }}</option
                        >
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">Người Dùng</label>
                <select type="text" class="form-control" id="user_id" name="user_id" required>
                    <option value="">Chọn người dùng</option>
                    @foreach($user as $users)
                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Nội Dung:</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Comment</button>
        </form>



    </div>
    <!-- /.container-fluid -->
@endsection
