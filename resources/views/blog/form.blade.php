@extends('layouts.app')
@section('page-title','Create Blog')
@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <style>
        .img-preview {
            display: flex;
            flex-wrap: wrap; /* allow wrapping to next row */
            gap: 10px;       /* space between images */
            margin-top: 10px;
        }
        .img-preview img {
            width: 120px;    /* fixed width */
            height: 120px;   /* fixed height */
            object-fit: cover; /* maintain aspect ratio and crop if necessary */
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .existing-image:hover .delete-image {
            display: block;
        }

    </style>
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2> {{isset($blog) ? 'Update '. \Illuminate\Support\Str::limit($blog->title,20,'...')  : 'Create New Blog'}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="blogForm" action="{{ isset($blog) ? route('update-blog', $blog->slug) : route('save-blog') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($blog))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" value="{{ old('title', $blog->title ?? '') }}">
                                <span class="text-danger" id="error-title"></span>
                                @error('title')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control">{{ old('description', $blog->description ?? '') }}</textarea>
                                <span class="text-danger" id="error-description"></span>
                                @error('title')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            @if(isset($blog_images) && count($blog_images))
                                <div class="mb-3">
                                    <label class="form-label">Existing Images</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($blog_images as $img)
                                            <div class="position-relative existing-image" style="width:100px; height:100px;">
                                                <img src="{{ asset('storage/' . $img->image) }}" alt="Blog Image"
                                                     style="width:100%; height:100%; object-fit:cover; display:block;">

                                                <button class="btn btn-danger btn-sm delete-image" data-id="{{ $img->id }}" style="position:absolute; top:2px; right:2px;">
                                                    &times;
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            @endif

                            <div class="mb-3">
                                <label for="images" class="form-label">Images</label>
                                <input type="file" name="image[]" id="images" class="form-control" multiple accept="image/*">
                                <div id="preview" class="img-preview"></div>
                                <span class="text-danger" id="error-image"></span>
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <select id="author" name="author" class="form-control select2">
                                    <option value="">Select Author</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author', $blog->user_id ?? '') == $author->id ? 'selected' : (auth()->user()->id == $author->id ? 'selected':'') }}>
                                            {{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="error-author"></span>
                                @error('author')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="published_date" class="form-label">Published Date</label>
                                <input type="datetime-local" id="published_date" name="published_date" class="form-control"
                                       value="{{ old('published_date', isset($blog) ? $blog->created_at->format('Y-m-d\TH:i') : '') }}">
                                <span class="text-danger" id="error-date"></span>
                                @error('published_date')<span class="text-danger">{{$message}}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ isset($blog) ? 'Update' : 'Create' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#author').select2({
                placeholder: "Select an author",
                allowClear: true
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            $('#description').summernote({
                placeholder: 'Write your description here...',
                tabsize: 2,
                height: 150
            });
        });


        const imageInput = document.getElementById('images');
        const previewContainer = document.getElementById('preview');

        imageInput.addEventListener('change', function () {
            previewContainer.innerHTML = "";
            const files = imageInput.files;
            if (files) {
                Array.from(files).forEach(file => {
                    if (file.type.startsWith("image/")) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = document.createElement("img");
                            img.src = e.target.result;
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>

    <script>
        document.getElementById('blogForm').addEventListener('submit', function(e) {
            let isValid = true;

            document.querySelectorAll('.text-danger').forEach(el => el.innerText = '');

            const title = document.getElementById('title').value.trim();
            if (!title) {
                document.getElementById('error-title').innerText = "Please enter a title";
                isValid = false;
            } else if (title.length > 255) {
                document.getElementById('error-title').innerText = "Title cannot exceed 255 characters";
                isValid = false;
            }

            const description = document.getElementById('description').value.trim();
            if (!description) {
                document.getElementById('error-description').innerText = "Please enter a description";
                isValid = false;
            }

            const imagesInput = document.getElementById('images');
            const files = imagesInput.files;

            document.getElementById('error-image').innerText = ''; // clear previous error

            if (files.length > 0) { // only validate if user selected new files
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

                    if (!allowedTypes.includes(file.type)) {
                        document.getElementById('error-image').innerText = "Only JPG, PNG, GIF files are allowed";
                        isValid = false;
                        break;
                    }
                    if (file.size > 2 * 1024 * 1024) { // 2MB
                        document.getElementById('error-image').innerText = "Each file must be less than 2MB";
                        isValid = false;
                        break;
                    }
                }
            } else {
                // On edit, allow empty input (user may not upload new files)
                // If this is a create form, you can add:
                if (isCreateForm) {
                    document.getElementById('error-image').innerText = "Please upload at least one image";
                    isValid = false;
                }
            }

            const author = document.getElementById('author').value;
            if (!author) {
                document.getElementById('error-author').innerText = "Please select an author";
                isValid = false;
            }

            const date = document.getElementById('published_date').value;
            if (!date) {
                document.getElementById('error-date').innerText = "Please select a publish date";
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-image');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const imageId = this.dataset.id;
                    const imageDiv = this.closest('.existing-image');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ route('delete-blog-image') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ id: imageId })
                            })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        imageDiv.remove();
                                        Swal.fire(
                                            'Deleted!',
                                            'Image has been deleted.',
                                            'success'
                                        );
                                    } else {
                                        Swal.fire(
                                            'Failed!',
                                            'Failed to delete the image.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
