@extends('frontend.layouts.app')
@section('front-end-page.title','Blog List')
@push('frontend.style')
    <style>
        .pagination {
            border-radius: 0.25rem;
        }

        .pagination .page-link {
            color: #fff;
            background-color: #0d6efd;
            border: 1px solid #0d6efd;
            margin: 0 2px;
        }

        .pagination .page-link:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
            color: #fff;
        }

        .pagination .page-item.active .page-link {
            background-color: #032557;
            border-color: #0b5ed7;
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #6c757d;
        }
    </style>
@endpush
@section('frontend.content')

    <div id="posts-page" class="page">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8">
                    <h2>All Blogs</h2>

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
                        @include('partials.list-post-card',['posts'=>$posts])
                    </div>

                    <nav aria-label="Page navigation">
                        <div class="d-flex justify-content-center mt-4">
                            {{ $posts->links() }}
                        </div>
                    </nav>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <h5>Categories</h5>--}}
{{--                        </div>--}}
{{--                        <div class="list-group list-group-flush">--}}
{{--                            <a href="#" class="list-group-item list-group-item-action">Web Development <span class="badge bg-primary rounded-pill">12</span></a>--}}
{{--                            <a href="#" class="list-group-item list-group-item-action">Mobile Apps <span class="badge bg-primary rounded-pill">8</span></a>--}}
{{--                            <a href="#" class="list-group-item list-group-item-action">Data Science <span class="badge bg-primary rounded-pill">6</span></a>--}}
{{--                            <a href="#" class="list-group-item list-group-item-action">AI & Machine Learning <span class="badge bg-primary rounded-pill">4</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Recent Posts</h5>
                        </div>
                        <div class="card-body">
                            @forelse(recentPosts() as $post)
                                <div class="mb-3">
                                    <h6><a href="#" class="text-decoration-none">{{\Illuminate\Support\Str::limit($post->title,30,'...')}}</a></h6>
                                    <small class="text-muted">Posted on {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</small>
                                </div>
                            @empty
                                <small class="text-muted">No Post Found</small>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
