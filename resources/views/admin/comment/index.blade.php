@extends('admin.layouts.app')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Danh Sách Tin Tức</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.comment.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Thêm Bình Luận</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Bài Viết</th>
                                <th>Tiêu Đề</th>
                                <th>Hình Ảnh</th>
                                <th>Số Lượng Bình Luận</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID Bài Viết</th>
                                <th>Tiêu Đề</th>
                                <th>Hình Ảnh</th>
                                <th>Số Lượng Bình Luận</th>
                                <th>Chức Năng</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($comment as $item)
                                <tr>
                                    <td>{{ $item->tintuc_id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><img style="max-width: 200px;" src="{{ asset($item->img) }}" alt=""></td>
                                    <td>{{ $item->total_comments }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-circle"
                                            href="{{ route('admin.comment.show', $item->tintuc_id) }}"><i
                                                class="fas fa-exclamation-circle"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>




        </div>
        <!-- /.container-fluid -->

@endsection
