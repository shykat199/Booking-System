<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PostAction;
use DB;
use Illuminate\Http\Request;

class BlogListController extends Controller
{
    public function index()
    {
        return view('frontend.blog-list');
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:blogs,id',
            'action'  => 'required|in:like,unlike'
        ]);

        $userId = auth()->id();
        $postId = $request->post_id;
        $action = $request->action;

        // Check if user already has action
        $existingAction = PostAction::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($existingAction) {
            if ($action === 'like') {
                $existingAction->action_status = BLOG_LIKE_STATUS;
            } else {
                $existingAction->action_status = BLOG_UNLIKE_STATUS;
            }
            $existingAction->save();
        } else {
            PostAction::create([
                'post_id' => $postId,
                'user_id' => $userId,
                'action_status' => $action === 'like' ? BLOG_LIKE_STATUS : BLOG_UNLIKE_STATUS
            ]);
        }

        // Get updated counts
        $postCounts = PostAction::select('action_status', DB::raw('count(*) as total'))
            ->where('post_id', $postId)
            ->groupBy('action_status')
            ->pluck('total', 'action_status');

        $likeCount = $postCounts[BLOG_LIKE_STATUS] ?? 0;
        $unlikeCount = $postCounts[BLOG_UNLIKE_STATUS] ?? 0;

        return response()->json([
            'like_count' => $likeCount,
            'unlike_count' => $unlikeCount,
            'liked_by_user' => $action === 'like',
            'unliked_by_user' => $action === 'unlike',
        ]);
    }
}
