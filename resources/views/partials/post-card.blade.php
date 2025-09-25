@forelse($posts as $post)
    <div class="col-md-4">
        <div class="card post-card h-100">
            <img src="{{getBlogImage($post->firstImage->image ?? null)}}" class="card-img-top post-img" alt="Web Development">
            <div class="card-body">
                <h5 class="card-title">{{\Illuminate\Support\Str::limit($post->title,45),'...'}}</h5>
                <p class="card-text">{{\Illuminate\Support\Str::limit(strip_tags($post->description), 70, '...')}}</p>
                <small class="text-muted">Posted on {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</small>
                <div class="mt-3 d-flex justify-content-between align-items-center p-2 border rounded bg-light">

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
@empty
    <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <span class="text-muted">No Post Available</span>
    </div>
@endforelse
