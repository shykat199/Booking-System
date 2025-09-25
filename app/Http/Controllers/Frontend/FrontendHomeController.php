<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class FrontendHomeController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $data['latestPosts'] = Blog::withCount([
            'likes as like_count',
            'unlikes as unlike_count'
        ])->with('firstImage')->latest()->limit(3)->get();

        $userActions = [];
        if ($userId) {
            $postIds = $data['latestPosts']->pluck('id')->toArray();
            $userActions = \App\Models\PostAction::where('user_id', $userId)
                ->whereIn('post_id', $postIds)
                ->pluck('action_status', 'post_id')
                ->toArray();
        }

        $data['latestPosts']->each(function ($post) use ($userActions) {
            $post->liked_by_user = isset($userActions[$post->id]) && $userActions[$post->id] == BLOG_LIKE_STATUS;
            $post->unliked_by_user = isset($userActions[$post->id]) && $userActions[$post->id] == BLOG_UNLIKE_STATUS;
        });

        return view('frontend.index',$data);
    }

    public function loadMorePosts(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 3);

        $posts = Blog::withCount(['likes as like_count', 'unlikes as unlike_count'])
            ->with('firstImage')->latest()
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $userId = auth()->id();

        $userActions = [];
        if ($userId) {
            $postIds = $posts->pluck('id')->toArray();
            $userActions = \App\Models\PostAction::where('user_id', $userId)
                ->whereIn('post_id', $postIds)
                ->pluck('action_status', 'post_id')
                ->toArray();
        }

        $posts->each(function ($post) use ($userActions) {
            $post->liked_by_user = isset($userActions[$post->id]) && $userActions[$post->id] == BLOG_LIKE_STATUS;
            $post->unliked_by_user = isset($userActions[$post->id]) && $userActions[$post->id] == BLOG_UNLIKE_STATUS;
        });

        if ($posts->isEmpty()) {
            return '';
        }

        return view('partials.post-card', compact('posts'))->render();
    }


}
