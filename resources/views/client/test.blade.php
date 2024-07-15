@extends('layout.app')
{{-- @section('title', $news->title) --}}

@section('content')
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/browser-image-compression@1.0.14/dist/browser-image-compression.js"></script>
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="{{ asset('/assets/js/quill.min.js') }}"></script>

    <div class="container mt-5">
        <!-- Form Bình luận -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bình luận</h5>
                <form action="{{ route('comments.store') }}" method="POST" id="comment-form">
                    @csrf
                    <div id="editor-container"></div>
                    <input type="hidden" value="{{ $news->id }}" name='tintuc_id'>
                    <textarea name="content" id="content" style="display: none;"></textarea>
                    <input type="hidden" name="parent_id" value="0">
                    <button class="btn btn-primary mt-3" type="submit">Đăng bình luận</button>
                </form>
            </div>
        </div>

        <!-- Danh sách Bình luận -->
        <div class="mt-5">
            <h5 class="card-title">Comments</h5>
            @foreach ($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        {!! $comment->content !!}
                        <a href="#" class="reply" data-comment-id="{{ $comment->id }}">Trả lời</a>
                    </div>
                    <!-- Form trả lời bình luận -->
                    <form action="{{ route('comments.store') }}" method="POST" class="reply-form"
                        data-comment-id="{{ $comment->id }}" style="display: none;">
                        @csrf
                        <div id="editor-container-reply-{{ $comment->id }}"></div>
                        <input type="hidden" value="{{ $news->id }}" name='tintuc_id'>
                        <textarea name="content" id="content-reply-{{ $comment->id }}" style="display: none;"></textarea>
                        <button class="btn btn-primary mt-3" type="submit">Đăng bình luận</button>
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    </form>
                    @foreach ($comment->replies as $reply)
                        <div style="margin-left: 30px" class="comment reply-comment">
                            <img src="{{ asset('assets/img/team/1.png') }}" style="max-width:50px" alt="">
                            <strong>Tên Thử</strong>
                            {!! $reply->content !!}
                            <p>{{ $reply->created_at }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>


    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <!-- ResizeObserver polyfill for browsers that don't support it -->
    <script src="https://cdn.jsdelivr.net/npm/resize-observer-polyfill@1.5.1/dist/ResizeObserver.global.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.reply').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const commentId = this.dataset.commentId;
                    const replyForm = document.querySelector(
                        `.reply-form[data-comment-id='${commentId}']`);
                    if (replyForm) {
                        replyForm.style.display = replyForm.style.display === 'none' ? 'block' :
                            'none';
                    } else {
                        console.error('Reply form not found for comment ID:', commentId);
                    }
                });
            });
        });

        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        [{
                            'header': [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'link'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'align': []
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }]
                    ],
                    handlers: {
                        'image': parentImageHandler
                    }
                }
            }
        });

        document.querySelector('#comment-form').onsubmit = function() {
            document.querySelector('#content').value = quill.root.innerHTML;
        };

        document.querySelectorAll('.reply-form').forEach(form => {
            var commentId = form.querySelector('textarea').id.split('-').pop();
            var replyQuill = new Quill(`#editor-container-reply-${commentId}`, {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: [
                            [{
                                'header': [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['image', 'link'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'align': []
                            }],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }]
                        ],
                        handlers: {
                            'image': function() {
                                replyImageHandler(replyQuill);
                            }
                        }
                    }
                }
            });

            form.onsubmit = function() {
                form.querySelector(`#content-reply-${commentId}`).value = replyQuill.root.innerHTML;
            };
        });

        function parentImageHandler() {
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

                    fetch('{{ route('comments.uploadImage') }}', {
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

        function replyImageHandler(replyQuill) {
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

                    fetch('{{ route('comments.uploadImage') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(response => response.json())
                        .then(result => {
                            if (result.url) {
                                var range = replyQuill.getSelection();
                                if (range) {
                                    replyQuill.insertEmbed(range.index, 'image', result.url);
                                } else {
                                    replyQuill.insertEmbed(replyQuill.getLength(), 'image', result.url);
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
    </script>
@endsection
