<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostComment;
use Illuminate\Http\Request;
use App\Models\Writer;
use Illuminate\Support\Facades\Auth;
class WriterController extends Controller
{
    public function index() {
        $writers = Writer::with(['user', 'subsection.section'])->get();
    
        $writers->transform(function ($writer) {

            if ($writer->image && !str_starts_with($writer->image, '/storage/')) {
                $writer->image = '/storage/' . $writer->image;
            }

            if ($writer->user && $writer->user->image_path && !str_starts_with($writer->user->image_path, '/storage/')) {
                $writer->user->image_path = '/storage/' . $writer->user->image_path;
            }
    
   
            if ($writer->subsection && $writer->subsection->section && $writer->subsection->section->image) {
                if (!str_starts_with($writer->subsection->section->image, '/storage/')) {
                    $writer->subsection->section->image = '/storage/' . $writer->subsection->section->image;
                }
            }
    
            return $writer;
        });
    
        return response()->json([
            'success' => true,
            'data' => $writers,
            'message' => 'Writers retrieved successfully'
        ]);
    }
    
    public function myPostsWithDetails()
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    
        $writer = Writer::where('user_id', $user->id)->first();
    
        if (!$writer) {
            return response()->json([
                'success' => false,
                'message' => 'Writer profile not found'
            ], 404);
        }
    
        $posts = $writer->posts()
            ->with(['comments.user', 'likes'])
            ->withCount(['comments', 'likes']) 
            ->orderByRaw('likes_count + comments_count DESC')
            ->latest()
            ->get([
                'id',
                'title',
                'description',
                'short_description',
                'image',
                'video',
                'date',
            ]);
    
        return response()->json([
            'success' => true,
            'data' => $posts,
            'message' => 'Your posts with comments and likes retrieved successfully'
        ]);
    }
    public function replyToComment(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'parent_id' => 'required|exists:post_comments,id',
        'content' => 'required|string|max:1000',
    ]);

    $user = Auth::user();

    $comment = PostComment::create([
        'post_id' => $request->post_id,
        'user_id' => $user->id,
        'parent_id' => $request->parent_id,
        'content' => $request->content,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Reply added successfully',
        'data' => $comment
    ]);
}
public function getPostCommentsWithReplies($postId)
{
    $comments = PostComment::with([
        'user:id,name,email',
        'replies.user:id,name,email'
    ])
    ->where('post_id', $postId)
    ->whereNull('parent_id') 
    ->latest()
    ->get();

    return response()->json([
        'success' => true,
        'message' => 'Post comments with replies retrieved successfully',
        'data' => $comments
    ]);
}
public function myNotifications()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $writer = Writer::where('user_id', $user->id)->first();

    if (!$writer) {
        return response()->json([
            'success' => false,
            'message' => 'Writer not found'
        ], 404);
    }

    $notifications = $writer->notifications()
        ->orderBy('created_at', 'desc')
        ->take(20)
        ->get();

    return response()->json([
        'success' => true,
        'message' => 'Notifications retrieved successfully',
        'data' => $notifications
    ]);
}

}
