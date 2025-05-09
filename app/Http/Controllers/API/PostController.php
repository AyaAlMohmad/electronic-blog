<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $posts = Post::with('writer:id,name')
            ->latest()
            ->get([
                'id',
                'writer_id',
                'image',
                'video',
                'title',
                'description',
                'short_description',
                'date'
            ]);

        // Modify image and video URLs
        $posts->transform(function ($post) {
            if ($post->image) {
                $post->image = '/storage/' . $post->image;
            }
            if ($post->video) {
                $post->video = '/storage/' . $post->video;
            }
            return $post;
        });

        return response()->json([
            'success' => true,
            'data' => $posts,
            'message' => 'Posts retrieved successfully.'
        ]);
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::with('writer:id,name')
            ->select([
                'id',
                'writer_id',
                'image',
                'video',
                'title',
                'description',
                'short_description',
                'date'
            ])
            ->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        // Modify image and video URLs
        if ($post->image) {
            $post->image = '/storage/' . $post->image;
        }
        if ($post->video) {
            $post->video = '/storage/' . $post->video;
        }

        return response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post retrieved successfully.'
        ]);
    }
}