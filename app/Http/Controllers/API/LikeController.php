<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Like a post
     */
    public function likePost($postId)
    {
        $post = Post::find($postId);
        
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        // Check if already liked
        $existingLike = PostLike::where('post_id', $postId)
                               ->where('user_id', Auth::id())
                               ->first();

        if ($existingLike) {
            return response()->json([
                'success' => false,
                'message' => 'You already liked this post'
            ], 400);
        }

        $like = PostLike::create([
            'post_id' => $postId,
            'user_id' => Auth::id()
        ]);

        return response()->json([
            'success' => true,
            'data' => $like,
            'likes_count' => $post->likes()->count(),
            'message' => 'Post liked successfully'
        ]);
    }

    /**
     * Unlike a post
     */
    public function unlikePost($postId)
    {
        $like = PostLike::where('post_id', $postId)
                       ->where('user_id', Auth::id())
                       ->first();

        if (!$like) {
            return response()->json([
                'success' => false,
                'message' => 'Like not found'
            ], 404);
        }

        $post = $like->post;
        $like->delete();

        return response()->json([
            'success' => true,
            'likes_count' => $post->likes()->count(),
            'message' => 'Post unliked successfully'
        ]);
    }

    /**
     * Check if user liked a post
     */
    public function checkLike($postId)
    {
        $isLiked = PostLike::where('post_id', $postId)
                          ->where('user_id', Auth::id())
                          ->exists();

        return response()->json([
            'success' => true,
            'is_liked' => $isLiked
        ]);
    }
}