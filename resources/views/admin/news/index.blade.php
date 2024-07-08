@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh Sách Tin Tức</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.news.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Thêm Tin Tứcc</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Hình Ảnh</th>
                                <th>View</th>
                                <th>Tác Giả</th>
                                <th>Danh Mục</th>
                                <th>Ngày Tạo</th>
                                <th>Ngày Sửa</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Hình Ảnh</th>
                                <th>View</th>
                                <th>Tác Giả</th>
                                <th>Danh Mục</th>
                                <th>Ngày Tạo</th>
                                <th>Ngày Sửa</th>
                                <th>Chức Năng</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><img style="max-width: 200px;" src="{{ asset($item->img) }}" alt=""></td>
                                    <td>{{ $item->view }}</td>
                                    <td>{{ $item->name_author }}</td>
                                    <td>{{ $item->title_category }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td><a class="btn btn-success btn-circle"
                                            href="{{ route('admin.news.edit', $item->id) }}"><i
                                                class="fas fa-wrench"></i></a>
                                        <a class="btn btn-primary btn-circle"
                                            href="{{ route('admin.news.show', $item->id) }}"><i
                                                class="fas fa-exclamation-circle"></i></a>
                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-circle" type="submit"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
    <!-- /.container-fluid -->
@endsection
