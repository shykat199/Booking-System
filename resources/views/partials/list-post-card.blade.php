@forelse($posts as $post)
    <div class="card mb-4 post-item" data-post-id="4">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{getBlogImage($post->firstImage->image ?? null)}}" class="img-fluid rounded-start h-100" alt="AI Technology">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{\Illuminate\Support\Str::limit($post->title,70),'...'}}</h5>
                    <p class="card-text">{{\Illuminate\Support\Str::limit(strip_tags($post->description), 100, '...')}}</p>
                    <p class="card-text"><small class="text-muted">Posted on {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} by <strong>{{$post->user->name}}</strong></small></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <button class="{{Auth::user() ? 'likebtn' : ''}} btn btn-outline-danger btn-sm me-2 {{ $post->liked_by_user ? 'liked' : '' }}"
                                    @if(Auth::guest())
                                        onclick="openLoginModal()"
                                    @else
                                        data-post-id="{{ $post->id }}"
                                @endif
                            >
                                <i class="fas fa-heart {{ !$post->liked_by_user ? 'heart-outline' : '' }}"></i>
                                <span class="like-count">{{$post->like_count}}</span>
                            </button>

                            <button class="{{Auth::user() ? 'unlikebtn' : ''}} btn btn-outline-secondary btn-sm {{ $post->unliked_by_user ? 'unliked' : '' }}"
                                    @if(Auth::guest())
                                        onclick="openLoginModal()"
                                    @else
                                        data-post-id="{{ $post->id }}"
                                @endif
                            >
                                <i class="fas fa-thumbs-down {{ $post->unliked_by_user ? 'text-primary' : '' }}"></i>
                                <span class="unlike-count">{{$post->unlike_count}}</span>
                            </button>
                        </div>
                        <a class="btn btn-primary btn-sm" href="{{route('blog-details',$post->slug)}}">Read More</a>
                    </div>

                    <button id="loginModalTrigger" type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#loginModal"></button>

                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <span class="text-muted">No Post Available</span>
    </div>
@endforelse
