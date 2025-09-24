@extends('frontend.layouts.app')

@section('frontend.content')

    <div id="blog-details-page" class="page">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8">
                    <article id="blog-content" class="card shadow-sm border-0">

                        {{-- Image Slider --}}
                        @if($post->images->count())
                            <div id="blogCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($post->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            @php
                                                $imagePath = getBlogImage($image->image);
                                            @endphp
                                            <img src="{{ $imagePath }}" class="d-block w-100" alt="Blog Image {{ $key+1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-body mt-3">
                            <h2 class="card-title mb-2">{{ $post->title }}</h2>
                            <small class="text-muted mb-3 d-block">Posted on {{ $post->created_at->format('F d, Y') }}</small>
                            <p class="card-text">{!! nl2br(e($post->description)) !!}</p>
                        </div>

                        <div class="card-footer d-flex justify-content-start align-items-center bg-white border-0">
                            <button class="{{Auth::user() ? 'likebtn' : ''}} btn btn-outline-danger btn-sm me-2 {{ $post->liked_by_user ? 'liked' : '' }}"
                                @if(Auth::guest())
                                    onclick="openLoginModal()"
                                @else
                                    data-post-id="{{ $post->id }}"
                                @endif
                            >
                                <i class="fas fa-heart"></i> <span class="like-count">{{$post->like_count}}</span>
                            </button>

                            <button class="{{Auth::user() ? 'unlikebtn' : ''}} btn btn-outline-secondary btn-sm {{ $post->unliked_by_user ? 'unliked' : '' }}"
                                @if(Auth::guest())
                                    onclick="openLoginModal()"
                                @else
                                    data-post-id="{{ $post->id }}"
                                @endif
                            >
                                <i class="fas fa-thumbs-down"></i> <span class="unlike-count">{{$post->unlike_count}}</span>
                            </button>
                        </div>

                    </article>
                </div>

                <!-- Sidebar for Blog Details -->
                <div class="col-md-4">
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <h5>Related Posts</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="mb-3">--}}
{{--                                <h6><a href="#" class="text-decoration-none">Advanced JavaScript Concepts</a></h6>--}}
{{--                                <small class="text-muted">March 20, 2024</small>--}}
{{--                            </div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <h6><a href="#" class="text-decoration-none">CSS Flexbox Complete Guide</a></h6>--}}
{{--                                <small class="text-muted">March 18, 2024</small>--}}
{{--                            </div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <h6><a href="#" class="text-decoration-none">React Hooks Explained</a></h6>--}}
{{--                                <small class="text-muted">March 16, 2024</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Author Info</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}" class="rounded-circle mb-3" alt="{{$post->user->name}}">
                            <h5>{{$post->user->name}}</h5>
                            <p class="text-muted">Full Stack Developer & Tech Blogger</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('frontend.script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function sendAction(postId, action, button) {
                fetch("{{ route('post.action') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ post_id: postId, action: action })
                })
                    .then(res => res.json())
                    .then(data => {
                        const likeBtn = document.querySelector(`.likebtn[data-post-id="${postId}"]`);
                        const unlikeBtn = document.querySelector(`.unlikebtn[data-post-id="${postId}"]`);

                        likeBtn.querySelector('.like-count').textContent = data.like_count;
                        unlikeBtn.querySelector('.unlike-count').textContent = data.unlike_count;

                        likeBtn.classList.toggle('liked', data.liked_by_user);
                        unlikeBtn.classList.toggle('unliked', data.unliked_by_user);
                    })
                    .catch(err => console.error(err));
            }

            document.querySelectorAll('.likebtn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    sendAction(postId, 'like', this);
                });
            });

            document.querySelectorAll('.unlikebtn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');
                    sendAction(postId, 'unlike', this);
                });
            });

        });
    </script>
@endpush
