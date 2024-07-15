@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="container-fluid">
        <form action="{{ route('admin.news.update',$news->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="title">Tiêu đề:</label>
            <input class="form-control" value=" {{ $news->title }}" type="text" id="title" name="title"><br><br>

            <label for="img">Hình ảnh:</label>
            <input class="form-control-file" type="file" id="img" name="img">
            <img style="max-width: 200px;" src="{{asset( $news->img)}}" alt=""> <br><br>

            <label for="desc">Mô tả:</label>
            <textarea class="form-control" id="desc" name="desc">{{ $news->desc }}</textarea><br><br>

            <div class="form-group">
                <label for="content">Nội dung:</label>
                <div id="editor-container" style="min-height: 300px;"></div>
                <textarea name="content" id="content123" style="display: none;"></textarea>
                {!! $news->content !!}
            </div> <br><br>
            <label for="view">Lượt xem:</label>
            <input class="form-control" type="number" id="view" value="{{ $news->view }}" name="view"><br><br>

            <label for="id_author">ID Tác giả:</label>
            <select class="form-control" id="id_author" name="id_author">
                <option value="">chọn tác giả</option>
                @foreach ($author as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $news->id_author ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            <br><br>

            <label for="id_category">Thể Loại:</label>
            <select class="form-control" id="id_category" name="id_category">
                <option value="">Chọn thể loại</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $news->id_category ? 'selected' : '' }}>{{ $item->title }}</option>
                @endforeach
            </select>

            <br><br>
            <button class="btn btn-primary btn-user btn-block" type="submit">Sửa Tin Tức</button>
        </form>
    </div>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<!-- ResizeObserver polyfill for browsers that don't support it -->
<script src="https://cdn.jsdelivr.net/npm/resize-observer-polyfill@1.5.1/dist/ResizeObserver.global.js"></script>
<script src="https://unpkg.com/browser-image-compression@1.0.14/dist/browser-image-compression.js"></script>


<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: {
                container: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'link'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    [{ 'color': [] }, { 'background': [] }]
                ],
                handlers: {
                    'image': imageHandler
                }
            }
        }
    });
    function imageHandler() {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async function() {
                var file = input.files[0];

                try {
                    const options = {
                        maxSizeMB: 0.1,
                        maxWidthOrHeight: 300,
                        useWebWorker: true
                    };

                    const compressedFile = await imageCompression(file, options);

                    var formData = new FormData();
                    formData.append('image', compressedFile);

                    fetch('{{ route('admin.news.uploadImage') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(response => response.json())
                        .then(result => {
                            if (result.url) {
                                var range = quill.getSelection();
                                if (range) {
                                    quill.insertEmbed(range.index, 'image', result.url);
                                } else {
                                    quill.insertEmbed(quill.getLength(), 'image', result.url);
                                }
                            } else {
                                console.error('Failed to upload image');
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                        });
                } catch (error) {
                    console.error('Error:', error);
                }
            };
        }

    document.querySelector('#insert-form').onsubmit = function() {
        document.querySelector('#content123').value = quill.root.innerHTML;
    };
</script>
    <!-- /.container-fluid -->
@endsection
