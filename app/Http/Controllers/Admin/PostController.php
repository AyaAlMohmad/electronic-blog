<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts that are pending approval
    public function pending()
    {
        $posts = Post::with('writer:id,name')->where('is_approved', 0)->latest()->get();
        return view('admin.posts.pending', compact('posts'));
    }

    // Show all approved posts
    public function approved()
    {
        $posts = Post::with('writer:id,name')->where('is_approved', 1)->latest()->get();
        return view('admin.posts.approved', compact('posts'));
    }

    // Approve a specific post
    public function approve(Post $post)
    {
        $post->update(['is_approved' => 1]);
        return redirect()->back()->with('success', 'The post has been approved.');
    }

    // Reject a specific post
    public function reject(Post $post)
    {
        $post->update(['is_approved' => 0]);
        return redirect()->back()->with('success', 'The post has been rejected.');
    }

    // Delete a specific post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'The post has been deleted.');
    }

    public function show(Post $post)
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
        ->find($post->id);

        return view('admin.posts.show', compact('post'));
    }
}
