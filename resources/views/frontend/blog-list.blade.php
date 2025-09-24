@extends('frontend.layouts.app')

@section('frontend.content')

    <div id="posts-page" class="page">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8">
                    <h2>All Posts</h2>

                    <!-- Search Bar with Live Results -->
                    <div class="mb-4 position-relative">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search posts..." oninput="liveSearch()">
                            <button class="btn btn-primary" type="button" onclick="searchPosts()">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                        <div id="searchResults" class="search-results position-absolute w-100 mt-1" style="display: none;"></div>
                    </div>

                    <!-- Posts List -->
                    <div id="posts-container">
                        <div class="card mb-4 post-item" data-post-id="1">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200" class="img-fluid rounded-start h-100" alt="Web Development">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Getting Started with Web Development</h5>
                                        <p class="card-text">Learn the fundamentals of web development including HTML, CSS, and JavaScript. This comprehensive guide will take you through...</p>
                                        <p class="card-text"><small class="text-muted">Posted on March 15, 2024 by John Doe</small></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="1">
                                                    <i class="fas fa-heart"></i> <span class="like-count">24</span>
                                                </button>
                                                <button class="unlike-btn me-3" onclick="toggleUnlike(this)" data-post-id="1">
                                                    <i class="fas fa-thumbs-down"></i> <span class="unlike-count">2</span>
                                                </button>
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="showPostDetails(1)">Read More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 post-item" data-post-id="2">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200" class="img-fluid rounded-start h-100" alt="Data Analysis">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Data Analysis with Python</h5>
                                        <p class="card-text">Explore powerful data analysis techniques using Python libraries like Pandas and NumPy. Master the art of data manipulation...</p>
                                        <p class="card-text"><small class="text-muted">Posted on March 12, 2024 by Jane Smith</small></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="2">
                                                    <i class="fas fa-heart"></i> <span class="like-count">18</span>
                                                </button>
                                                <button class="unlike-btn me-3" onclick="toggleUnlike(this)" data-post-id="2">
                                                    <i class="fas fa-thumbs-down"></i> <span class="unlike-count">1</span>
                                                </button>
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="showPostDetails(2)">Read More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 post-item" data-post-id="3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200" class="img-fluid rounded-start h-100" alt="Mobile Development">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Mobile App Development Trends</h5>
                                        <p class="card-text">Discover the latest trends and technologies in mobile app development for 2024. From React Native to Flutter...</p>
                                        <p class="card-text"><small class="text-muted">Posted on March 10, 2024 by Mike Johnson</small></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="3">
                                                    <i class="fas fa-heart"></i> <span class="like-count">32</span>
                                                </button>
                                                <button class="unlike-btn me-3" onclick="toggleUnlike(this)" data-post-id="3">
                                                    <i class="fas fa-thumbs-down"></i> <span class="unlike-count">0</span>
                                                </button>
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="showPostDetails(3)">Read More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 post-item" data-post-id="4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1504639725590-34d0984388bd?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200" class="img-fluid rounded-start h-100" alt="AI Technology">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Artificial Intelligence in 2024</h5>
                                        <p class="card-text">How AI is transforming industries and creating new opportunities for developers. Machine learning, deep learning...</p>
                                        <p class="card-text"><small class="text-muted">Posted on March 8, 2024 by Sarah Wilson</small></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <button class="like-btn me-2" onclick="toggleLike(this)" data-post-id="4">
                                                    <i class="fas fa-heart"></i> <span class="like-count">45</span>
                                                </button>
                                                <button class="unlike-btn me-3" onclick="toggleUnlike(this)" data-post-id="4">
                                                    <i class="fas fa-thumbs-down"></i> <span class="unlike-count">3</span>
                                                </button>
                                            </div>
                                            <button class="btn btn-primary btn-sm" onclick="showPostDetails(4)">Read More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Categories</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">Web Development <span class="badge bg-primary rounded-pill">12</span></a>
                            <a href="#" class="list-group-item list-group-item-action">Mobile Apps <span class="badge bg-primary rounded-pill">8</span></a>
                            <a href="#" class="list-group-item list-group-item-action">Data Science <span class="badge bg-primary rounded-pill">6</span></a>
                            <a href="#" class="list-group-item list-group-item-action">AI & Machine Learning <span class="badge bg-primary rounded-pill">4</span></a>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Recent Posts</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6><a href="#" class="text-decoration-none">Getting Started with React</a></h6>
                                <small class="text-muted">March 18, 2024</small>
                            </div>
                            <div class="mb-3">
                                <h6><a href="#" class="text-decoration-none">Node.js Best Practices</a></h6>
                                <small class="text-muted">March 16, 2024</small>
                            </div>
                            <div class="mb-3">
                                <h6><a href="#" class="text-decoration-none">CSS Grid vs Flexbox</a></h6>
                                <small class="text-muted">March 14, 2024</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
