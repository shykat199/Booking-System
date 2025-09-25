@extends('frontend.layouts.app')
@section('front-end-page.title','Home')
@push('frontend.style')
    <style>
        #loadingSpinner {
            margin-top: 10px;
        }
    </style>
@endpush

@section('frontend.content')

    <div id="home-page" class="page">

        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=400" class="d-block w-100" alt="Technology Blog">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Welcome to Our Tech Blog</h5>
                        <p>Discover the latest trends in technology and programming.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=400" class="d-block w-100" alt="Team Work">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Expert Insights</h5>
                        <p>Learn from industry experts and thought leaders.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=400" class="d-block w-100" alt="Innovation">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Innovation Hub</h5>
                        <p>Stay ahead with cutting-edge innovations and ideas.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="container my-5">
            <h2 class="text-center mb-4">Featured Posts</h2>

            <div id="postsContainer" class="row g-4">
                @include('partials.post-card', ['posts' => $latestPosts])
            </div>

            <div class="col-12 text-center mt-4" id="loadMoreContainer">
                <button id="loadMoreBtn" class="btn btn-outline-primary btn-sm px-4" onclick="loadMorePosts()">
                    Load More
                </button>
                <div id="loadingSpinner" class="spinner-border text-primary d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('frontend.script')
    <script>
        let page = 1;
        const perPage = `{{count($latestPosts)}}`;

        function loadMorePosts() {
            page++;
            const loadBtn = document.getElementById('loadMoreBtn');
            const spinner = document.getElementById('loadingSpinner');

            loadBtn.classList.add('d-none');
            spinner.classList.remove('d-none');

            fetch(`/load-more-posts?page=${page}&per_page=${perPage}`)
                .then(res => res.text())
                .then(html => {
                    if (html.trim().length === 0) {
                        document.getElementById('loadMoreContainer').innerHTML = '<p>No more posts</p>';
                    } else {
                        document.getElementById('postsContainer').insertAdjacentHTML('beforeend', html);
                        loadBtn.classList.remove('d-none');

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

                    }
                })
                .catch(err => console.error(err))
                .finally(() => spinner.classList.add('d-none'));
        }

    </script>

    <script>
        function openLoginModal() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }
    </script>

@endpush

