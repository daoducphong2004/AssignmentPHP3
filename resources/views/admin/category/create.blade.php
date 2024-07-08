@extends('admin.layouts.app')

@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Enter description"></textarea>
                </div>
                <!-- Created_at will be automatically set to the current time -->
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>




        </div>
        <!-- /.container-fluid -->

@endsection
