<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog | @yield('front-end-page.title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-carousel .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .post-card {
            transition: transform 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .post-img {
            height: 200px;
            object-fit: cover;
        }

        .social-btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .facebook { background-color: #3b5998; }
        .twitter { background-color: #1da1f2; }
        .google { background-color: #dd4b39; }
        .github { background-color: #333; }

        .like-btn {
            border: none;
            background: none;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .like-btn:hover {
            color: #dc3545;
            transform: scale(1.1);
        }

        .like-btn.liked {
            color: #dc3545;
        }

        .unlike-btn {
            border: none;
            background: none;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .unlike-btn:hover {
            color: #007bff;
            transform: scale(1.1);
        }

        .unlike-btn.unliked {
            color: #007bff;
        }

        .search-results {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
        }

        .search-result-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .search-result-item:hover {
            background-color: #f8f9fa;
        }

        .auth-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: none;
            margin-top: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .heart-outline {
            color: white;
            -webkit-text-stroke: 2px red;
            text-stroke: 2px red;
        }
    </style>
    @stack('frontend.style')
</head>
<body>
@include('frontend.layouts.nav-bar')

    @section('frontend.content')
    @show

@include('frontend.layouts.footer')

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="auth-container">
                    <div class="card auth-card border-0 shadow-none">
                        <div class="card-body p-3">
                            <div class="text-center mb-4">
                                <h2><i class="fas fa-blog text-primary"></i> My Blog</h2>
                                <p class="text-muted">Welcome back! Please sign in to your account</p>
                            </div>

                            <form id="loginForm" action="{{route('login.store')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-sign-in-alt"></i> Sign In
                                </button>
                            </form>

                            <div class="text-center mb-3">
                                <small class="text-muted">── Or continue with ──</small>
                            </div>


                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="{{ route('login.provider', 'github') }}"
                                       class="btn btn-outline-primary github text-white w-100">
                                        <i class="fab fa-github"></i> Git Hub
                                    </a>
                                </div>
                                <div class="col-6">
                                        <a href="{{ route('login.provider', 'google') }}"
                                           class="btn btn-outline-danger social-btn google text-white w-100">
                                            <i class="fab fa-google"></i> Google
                                        </a>
                                    </div>
                            </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@stack('frontend.script')
<script>

    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchPosts();
                }
            });
        }

        // Initialize carousel
        const carousel = new bootstrap.Carousel('#heroCarousel', {
            interval: 5000,
            wrap: true
        });
    });
</script>

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

                    const likeIcon = likeBtn.querySelector('i');
                    const unlikeIcon = unlikeBtn.querySelector('i');

                    likeBtn.querySelector('.like-count').textContent = data.like_count;
                    unlikeBtn.querySelector('.unlike-count').textContent = data.unlike_count;

                    if(action === 'like') {
                        if(data.liked_by_user) {
                            likeBtn.classList.add('liked');
                            likeIcon.classList.remove('heart-outline');

                            unlikeBtn.classList.remove('unliked');
                            unlikeIcon.classList.remove('text-primary');
                            unlikeIcon.classList.add('thumbs-icon');
                        } else {
                            likeBtn.classList.remove('liked');
                            likeIcon.classList.add('heart-outline');
                        }
                    }

                    if(action === 'unlike') {
                        if(data.unliked_by_user) {
                            unlikeBtn.classList.add('unliked');
                            unlikeIcon.classList.add('text-primary');
                            unlikeIcon.classList.remove('thumbs-icon');

                            likeBtn.classList.remove('liked');
                            likeIcon.classList.add('heart-outline');
                        } else {
                            unlikeBtn.classList.remove('unliked');
                            unlikeIcon.classList.remove('text-primary');
                            unlikeIcon.classList.add('thumbs-icon');
                        }
                    }

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
</body>
</html>
