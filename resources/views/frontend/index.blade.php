@extends('frontend.layouts.app')

@section('frontend.content')
    <!-- Home Page -->
    <div id="home-page" class="page">
        <!-- Hero Carousel -->
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

        <!-- Featured Posts Section -->
        <div class="container my-5">
            <h2 class="text-center mb-4">Featured Posts</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card post-card h-100">
                        <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200" class="card-img-top post-img" alt="Web Development">
                        <div class="card-body">
                            <h5 class="card-title">Getting Started with Web Development</h5>
                            <p class="card-text">Learn the fundamentals of web development including HTML, CSS, and JavaScript.</p>
                            <small class="text-muted">Posted on March 15, 2024</small>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="1">
                                        <i class="fas fa-heart"></i> <span class="like-count">24</span>
                                    </button>
                                    <button class="unlike-btn" onclick="toggleUnlike(this)" data-post-id="1">
                                        <i class="fas fa-thumbs-down"></i> <span class="unlike-count">2</span>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm" onclick="showPostDetails(1)">Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card post-card h-100">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200" class="card-img-top post-img" alt="Data Analysis">
                        <div class="card-body">
                            <h5 class="card-title">Data Analysis with Python</h5>
                            <p class="card-text">Explore powerful data analysis techniques using Python libraries like Pandas and NumPy.</p>
                            <small class="text-muted">Posted on March 12, 2024</small>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="2">
                                        <i class="fas fa-heart"></i> <span class="like-count">18</span>
                                    </button>
                                    <button class="unlike-btn" onclick="toggleUnlike(this)" data-post-id="2">
                                        <i class="fas fa-thumbs-down"></i> <span class="unlike-count">1</span>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm" onclick="showPostDetails(2)">Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card post-card h-100">
                        <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200" class="card-img-top post-img" alt="Mobile Development">
                        <div class="card-body">
                            <h5 class="card-title">Mobile App Development Trends</h5>
                            <p class="card-text">Discover the latest trends and technologies in mobile app development for 2024.</p>
                            <small class="text-muted">Posted on March 10, 2024</small>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="3">
                                        <i class="fas fa-heart"></i> <span class="like-count">32</span>
                                    </button>
                                    <button class="unlike-btn" onclick="toggleUnlike(this)" data-post-id="3">
                                        <i class="fas fa-thumbs-down"></i> <span class="unlike-count">0</span>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm" onclick="showPostDetails(3)">Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card post-card h-100">
                        <img src="https://images.unsplash.com/photo-1504639725590-34d0984388bd?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200" class="card-img-top post-img" alt="AI Technology">
                        <div class="card-body">
                            <h5 class="card-title">Artificial Intelligence in 2024</h5>
                            <p class="card-text">How AI is transforming industries and creating new opportunities for developers.</p>
                            <small class="text-muted">Posted on March 8, 2024</small>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="4">
                                        <i class="fas fa-heart"></i> <span class="like-count">45</span>
                                    </button>
                                    <button class="unlike-btn" onclick="toggleUnlike(this)" data-post-id="4">
                                        <i class="fas fa-thumbs-down"></i> <span class="unlike-count">3</span>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm" onclick="showPostDetails(4)">Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card post-card h-100">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200" class="card-img-top post-img" alt="Digital Marketing">
                        <div class="card-body">
                            <h5 class="card-title">Digital Marketing Strategies</h5>
                            <p class="card-text">Effective digital marketing strategies to grow your online presence.</p>
                            <small class="text-muted">Posted on March 5, 2024</small>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="5">
                                        <i class="fas fa-heart"></i> <span class="like-count">27</span>
                                    </button>
                                    <button class="unlike-btn" onclick="toggleUnlike(this)" data-post-id="5">
                                        <i class="fas fa-thumbs-down"></i> <span class="unlike-count">1</span>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm" onclick="showPostDetails(5)">Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card post-card h-100">
                        <img src="https://images.unsplash.com/photo-1563206767-5b18f218e8de?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200" class="card-img-top post-img" alt="Cloud Computing">
                        <div class="card-body">
                            <h5 class="card-title">Cloud Computing Essentials</h5>
                            <p class="card-text">Understanding cloud computing services and their benefits for modern businesses.</p>
                            <small class="text-muted">Posted on March 3, 2024</small>
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="6">
                                        <i class="fas fa-heart"></i> <span class="like-count">19</span>
                                    </button>
                                    <button class="unlike-btn" onclick="toggleUnlike(this)" data-post-id="6">
                                        <i class="fas fa-thumbs-down"></i> <span class="unlike-count">0</span>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm" onclick="showPostDetails(6)">Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

