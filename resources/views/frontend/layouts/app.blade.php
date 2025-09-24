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
                <!-- Your form goes here -->
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

                            <!-- Social Login Buttons -->
                            <div class="row g-2">
                                <div class="col-6">
                                    <button class="btn btn-outline-primary social-btn facebook text-white w-100">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-danger social-btn google text-white w-100">
                                        <i class="fab fa-google"></i> Google
                                    </button>
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
    // Store posts data
    const postsData = {
        1: {
            title: "Getting Started with Web Development",
            author: "John Doe",
            date: "March 15, 2024",
            image: "https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=400",
            content: `
                    <h1>Getting Started with Web Development</h1>
                    <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=400" class="img-fluid mb-4" alt="Web Development">
                    <p class="lead">Web development is an exciting field that combines creativity with technical skills. In this comprehensive guide, we'll explore the fundamentals of web development.</p>

                    <h3>What is Web Development?</h3>
                    <p>Web development refers to the creating, building, and maintaining of websites. It includes aspects such as web design, web publishing, web programming, and database management.</p>

                    <h3>Essential Technologies</h3>
                    <ul>
                        <li><strong>HTML:</strong> The structure of web pages</li>
                        <li><strong>CSS:</strong> Styling and layout</li>
                        <li><strong>JavaScript:</strong> Interactive functionality</li>
                    </ul>

                    <h3>Getting Started</h3>
                    <p>To begin your web development journey, start with learning HTML, then CSS, and finally JavaScript. Practice by building small projects and gradually increase complexity.</p>

                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <div>
                            <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="1">
                                <i class="fas fa-heart"></i> <span class="like-count">24</span>
                            </button>
                            <button class="unlike-btn me-3" onclick="toggleUnlike(this)" data-post-id="1">
                                <i class="fas fa-thumbs-down"></i> <span class="unlike-count">2</span>
                            </button>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-share"></i> Share
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="showPage('posts')">
                                <i class="fas fa-arrow-left"></i> Back to Posts
                            </button>
                        </div>
                    </div>
                `,
            likes: 24,
            unlikes: 2
        },
        2: {
            title: "Data Analysis with Python",
            author: "Jane Smith",
            date: "March 12, 2024",
            image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=400",
            content: `
                    <h1>Data Analysis with Python</h1>
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=400" class="img-fluid mb-4" alt="Data Analysis">
                    <p class="lead">Python has become the go-to language for data analysis. Learn how to leverage powerful libraries like Pandas and NumPy for data manipulation and analysis.</p>

                    <h3>Why Python for Data Analysis?</h3>
                    <p>Python offers a rich ecosystem of libraries specifically designed for data analysis, making it easier to work with data of all sizes and types.</p>

                    <h3>Essential Libraries</h3>
                    <ul>
                        <li><strong>Pandas:</strong> Data manipulation and analysis</li>
                        <li><strong>NumPy:</strong> Numerical computing</li>
                        <li><strong>Matplotlib:</strong> Data visualization</li>
                        <li><strong>Seaborn:</strong> Statistical visualization</li>
                    </ul>

                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <div>
                            <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="2">
                                <i class="fas fa-heart"></i> <span class="like-count">18</span>
                            </button>
                            <button class="unlike-btn me-3" onclick="toggleUnlike(this)" data-post-id="2">
                                <i class="fas fa-thumbs-down"></i> <span class="unlike-count">1</span>
                            </button>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-share"></i> Share
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="showPage('posts')">
                                <i class="fas fa-arrow-left"></i> Back to Posts
                            </button>
                        </div>
                    </div>
                `,
            likes: 18,
            unlikes: 1
        }
    };

    // Live search functionality
    function liveSearch() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
        const searchResults = document.getElementById('searchResults');

        if (searchTerm.length > 2) {
            const results = [];
            const posts = document.querySelectorAll('.post-item');

            posts.forEach(post => {
                const title = post.querySelector('.card-title').textContent.toLowerCase();
                const content = post.querySelector('.card-text').textContent.toLowerCase();

                if (title.includes(searchTerm) || content.includes(searchTerm)) {
                    results.push({
                        title: post.querySelector('.card-title').textContent,
                        snippet: post.querySelector('.card-text').textContent.substring(0, 100) + '...',
                        postId: post.getAttribute('data-post-id')
                    });
                }
            });

            displaySearchResults(results);
            searchResults.style.display = 'block';
        } else {
            searchResults.style.display = 'none';
        }
    }

    // Display search results
    function displaySearchResults(results) {
        const searchResults = document.getElementById('searchResults');

        if (results.length === 0) {
            searchResults.innerHTML = '<div class="search-result-item text-muted">No results found</div>';
            return;
        }

        let html = '';
        results.forEach(result => {
            html += `
                    <div class="search-result-item" onclick="selectSearchResult('${result.postId}')">
                        <h6 class="mb-1">${result.title}</h6>
                        <small class="text-muted">${result.snippet}</small>
                    </div>
                `;
        });

        searchResults.innerHTML = html;
    }

    // Select search result
    function selectSearchResult(postId) {
        document.getElementById('searchResults').style.display = 'none';
        showPostDetails(postId);
    }

    // Regular search functionality
    function searchPosts() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const posts = document.querySelectorAll('.post-item');

        posts.forEach(post => {
            const title = post.querySelector('.card-title').textContent.toLowerCase();
            const content = post.querySelector('.card-text').textContent.toLowerCase();

            if (title.includes(searchTerm) || content.includes(searchTerm)) {
                post.style.display = 'block';
            } else {
                post.style.display = 'none';
            }
        });

        document.getElementById('searchResults').style.display = 'none';
    }

    // Hide search results when clicking outside
    // document.addEventListener('click', function(e) {
    //     const searchResults = document.getElementById('searchResults');
    //     const searchInput = document.getElementById('searchInput');
    //
    //     if (!searchResults.contains(e.target) && e.target !== searchInput) {
    //         searchResults.style.display = 'none';
    //     }
    // });

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

    // Search on Enter key press
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
</body>
</html>
