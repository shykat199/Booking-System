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

        #searchResults a {
            transition: background-color 0.2s ease;
        }

        #searchResults a:hover {
            background-color: #f0f0f0;
        }

        #searchResults p {
            font-size: 0.9rem;
            color: #555;
        }
    </style>
@endpush
@section('frontend.content')

    <div id="posts-page" class="page">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8">
                    <h2>All Blogs</h2>

                    <div class="mb-4 position-relative">
                        <form action="{{route('blog-list')}}" method="get">
                            <div class="input-group">
                                <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search posts..." oninput="liveSearch()">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </form>
                        <div id="searchResults" class="search-results position-absolute w-100 mt-1 bg-white shadow-sm rounded" style="display: none; max-height: 300px; overflow-y: auto; z-index: 1000;"></div>
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
@push('frontend.style')
    <script>
        function liveSearch() {
            const query = document.getElementById('searchInput').value.trim();
            const resultsDiv = document.getElementById('searchResults');

            if (query.length < 2) {
                resultsDiv.style.display = 'none';
                resultsDiv.innerHTML = '';
                return;
            }

            fetch("{{ route('posts.search') }}?query=" + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        resultsDiv.innerHTML = '<div class="p-2 text-muted">No posts found</div>';
                    } else {
                        resultsDiv.innerHTML = data.map(post => `
                        <a href="/blog-details/${post.slug}" class="d-block text-decoration-none text-dark p-2 border-bottom">
                            <strong>${post.title}</strong>
                            <p class="mb-0 text-truncate">${post.description}</p>
                        </a>
                    `).join('');
                    }
                    resultsDiv.style.display = 'block';
                })
                .catch(err => console.error(err));
        }

        document.addEventListener('click', function(e){
            const resultsDiv = document.getElementById('searchResults');
            const searchInput = document.getElementById('searchInput');
            if (!resultsDiv.contains(e.target) && e.target !== searchInput) {
                resultsDiv.style.display = 'none';
            }
        });
    </script>
@endpush
