<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Get comments for a post
     */
    public function getComments($postId)
    {
        $post = Post::find($postId);
        
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        $comments = PostComment::with('user:id,name,image_path')
                             ->where('post_id', $postId)
                             ->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $comments,
            'message' => 'Comments retrieved successfully'
        ]);
    }

    /**
     * Add comment to a post
     */
    public function addComment(Request $request, $postId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $post = Post::find($postId);
        
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        $comment = PostComment::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        $comment->load('user:id,name,image_path');

        return response()->json([
            'success' => true,
            'data' => $comment,
            'message' => 'Comment added successfully'
        ], 201);
    }

    /**
     * Delete a comment
     */
    public function deleteComment($postId, $commentId)
    {
        $comment = PostComment::where('id', $commentId)
                            ->where('post_id', $postId)
                            ->first();
    
        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found for this post'
            ], 404);
        }
    
        // Check if user is the comment owner or post owner
        $isCommentOwner = $comment->user_id === Auth::id();
        $isPostOwner = $comment->post->writer_id === Auth::user()->writer->id;
    
        if (!$isCommentOwner && !$isPostOwner) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to delete this comment'
            ], 403);
        }
    
        $comment->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully'
        ]);
    }
}