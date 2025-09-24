<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogDetailsController extends Controller
{
    public function index($slug)
    {
        $userId = auth()->id();
        $data['post']=Blog::withCount([
            'likes as like_count',
            'unlikes as unlike_count'
        ])->with(['user','images'])->where('slug',$slug)->firstOrFail();

        if (empty($data['post'])) {
            abort(404);
        }

        $userActions = [];
        if ($userId) {
            $postIds = $data['post']->pluck('id')->toArray();
            $userActions = \App\Models\PostAction::where('user_id', $userId)
                ->whereIn('post_id', $postIds)
                ->pluck('action_status', 'post_id')
                ->toArray();
        }

        $data['post']->liked_by_user = isset($userActions[$data['post']->id]) && $userActions[$data['post']->id] == BLOG_LIKE_STATUS;
        $data['post']->unliked_by_user = isset($userActions[$data['post']->id]) && $userActions[$data['post']->id] == BLOG_UNLIKE_STATUS;

        return view('frontend.blog-details',$data);
    }

    public function like($id)
    {

    }

    public function dislike($id)
    {

    }
}
