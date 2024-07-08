@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh Sách Bình Luận</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.comment.create') }}" class="btn btn-success">Thêm Bình
                                Luận</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Nội Dung</th>
                                    <th>Trả Lời</th>
                                    <th>Thời Gian</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->name }}</td>
                                        <td>{{ $comment->email }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>Comment id: {{ $comment->parent_id }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.comment.edit', $comment->id) }}"
                                                class="btn btn-primary">Sửa</a>
                                            <form action="{{ route('admin.comment.destroy', $comment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"   onclick="return confirm('Bạn có chắc chắn muốn xóa?');" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>



                </div>
            </div>
        </div>
    </div>
                <!-- /.container-fluid -->
            @endsection
