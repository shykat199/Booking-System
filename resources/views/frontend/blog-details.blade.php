@extends('frontend.layouts.app')

@section('frontend.content')

    <div id="blog-details-page" class="page">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8">
                    <article id="blog-content">
                        <!-- Blog content will be dynamically loaded here -->
                    </article>

                    <!-- Comments Section -->
                    <div class="mt-5">
                        <h4>Comments</h4>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="https://ui-avatars.com/api/?name=John+Smith&size=50"
                                         class="rounded-circle me-3" alt="User">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">John Smith</h6>
                                        <small class="text-muted">2 hours ago</small>
                                        <p class="mt-2">Great article! Very helpful for beginners like me. Thanks for
                                            sharing!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="https://ui-avatars.com/api/?name=Alice+Johnson&size=50"
                                         class="rounded-circle me-3" alt="User">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Alice Johnson</h6>
                                        <small class="text-muted">5 hours ago</small>
                                        <p class="mt-2">I learned so much from this post. Looking forward to more
                                            content like this.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Comment Form -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Leave a Comment</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="commentName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="commentName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="commentEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="commentEmail" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="commentText" class="form-label">Comment</label>
                                        <textarea class="form-control" id="commentText" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar for Blog Details -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Related Posts</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6><a href="#" class="text-decoration-none">Advanced JavaScript Concepts</a></h6>
                                <small class="text-muted">March 20, 2024</small>
                            </div>
                            <div class="mb-3">
                                <h6><a href="#" class="text-decoration-none">CSS Flexbox Complete Guide</a></h6>
                                <small class="text-muted">March 18, 2024</small>
                            </div>
                            <div class="mb-3">
                                <h6><a href="#" class="text-decoration-none">React Hooks Explained</a></h6>
                                <small class="text-muted">March 16, 2024</small>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Author Info</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&size=100" class="rounded-circle mb-3"
                                 alt="Author">
                            <h5>John Doe</h5>
                            <p class="text-muted">Full Stack Developer & Tech Blogger</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="text-primary"><i class="fab fa-twitter fa-lg"></i></a>
                                <a href="#" class="text-primary"><i class="fab fa-linkedin fa-lg"></i></a>
                                <a href="#" class="text-primary"><i class="fab fa-github fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
