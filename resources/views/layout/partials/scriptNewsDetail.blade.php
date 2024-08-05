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
                console.log(formData);
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
    // xóa comment
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-comment').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const commentId = this.dataset.commentId;
            if (confirm('Bạn có chắc chắn muốn xóa comment này?')) {
                fetch('{{ route('comments.destroy') }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        commentId: commentId
                    })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        location.reload();
                    } else {
                        console.error('Failed to delete comment');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
});
</script>
