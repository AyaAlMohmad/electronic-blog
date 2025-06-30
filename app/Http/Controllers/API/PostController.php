<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index(Request $request)
    {
       
    $posts = Post::with('writer:id,name')
    ->withCount(['likes', 'comments'])
    ->where('is_approved', true)
    ->latest()
    ->selectRaw('id, writer_id, image, video, title, description, short_description, date')
    ->get();

        return response()->json([
            'success' => true,
            'data' => $posts,
            'message' => 'Posts retrieved successfully.'
        ]);
    }
    

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        // Check if user is a writer
        if (!Auth::user()->is_writer) {
            return response()->json([
                'success' => false,
                'message' => 'Only writers can create posts'
            ], 403);
        }
    
        try {
            // Decode JSON strings to arrays
            $title = json_decode($request->title, true) ?? [];
            $shortDescription = json_decode($request->short_description, true) ?? [];
            $description = json_decode($request->description, true) ?? [];
    
            $postData = [
                'title' => $title,
                'short_description' => $shortDescription,
                'description' => $description,
                'date' => $request->date,
                'writer_id' => Auth::user()->writer->id,
                'is_approved' => false,
                'action_type' => 'create',
            ];
    
            // Handle image upload
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('posts/images', 'public');
                $postData['image'] = '/storage/' . $path;
            }
    
            // Handle video upload
            if ($request->hasFile('video')) {
                $path = $request->file('video')->store('posts/videos', 'public');
                $postData['video'] = '/storage/' . $path;
            }
    
            $post = Post::create($postData);
    
            return response()->json([
                'success' => true,
                'data' => $post,
               'message' => 'Post created successfully and waiting for admin approval.'
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Post::with('writer:id,name')
            ->withCount(['likes', 'comments'])
            ->where('is_approved', true)
          ->selectRaw('id, writer_id, image, video, title, description, short_description, date')
            ->find($id);


        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post retrieved successfully.'
        ]);
    }
    

    /**
     * Update the specified post.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
    
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }
    
        // Check if user is the writer of this post
        if (Auth::user()->writer->id !== $post->writer_id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your own posts'
            ], 403);
        }
    
        try {
            $postData = ['date' => $request->date ?? $post->date];
    
            // Handle multilingual fields
            if ($request->has('title')) {
                $title = json_decode($request->title, true) ?? [];
                $postData['title'] = array_merge(
                    $post->getTranslations('title'),
                    $title
                );
            }
    
            if ($request->has('short_description')) {
                $shortDescription = json_decode($request->short_description, true) ?? [];
                $postData['short_description'] = array_merge(
                    $post->getTranslations('short_description'),
                    $shortDescription
                );
            }
    
            if ($request->has('description')) {
                $description = json_decode($request->description, true) ?? [];
                $postData['description'] = array_merge(
                    $post->getTranslations('description'),
                    $description
                );
            }
    
            // Handle image update
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($post->image) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $post->image));
                }
                $path = $request->file('image')->store('posts/images', 'public');
                $postData['image'] = '/storage/' . $path;
            }
    
            // Handle video update
            if ($request->hasFile('video')) {
                // Delete old video if exists
                if ($post->video) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $post->video));
                }
                $path = $request->file('video')->store('posts/videos', 'public');
                $postData['video'] = '/storage/' . $path;
            }
            $postData['is_approved' ]= false;
            $postData['action_type' ]= 'update';
            $post->update($postData);
    
            return response()->json([
                'success' => true,
                'data' => $post,
                'message' => 'Post updated successfully and waiting for admin approval.'
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified post.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }

        // Check if user is the writer of this post
        $writer = Auth::user()->writer;

        if (!$writer || $writer->id != $post->writer_id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only delete your own posts'
            ], 403);
        }
        

        // Delete associated files
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        if ($post->video) {
            Storage::disk('public')->delete($post->video);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.'
        ]);
    }

    /**
 * Get most interactive posts (sorted by likes + comments count)
 */
public function mostInteractivePosts()
{
    $posts = Post::withCount(['likes', 'comments'])
        ->where('is_approved', true)
        ->havingRaw('(likes_count + comments_count) > 0') 
        ->orderByRaw('likes_count + comments_count DESC')
        ->take(10)
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



    return response()->json([
        'success' => true,
        'data' => $posts,
        'message' => 'Most interactive posts retrieved successfully'
    ]);
}

/**
 * Get latest 5 approved posts
 */
public function latestPosts()
{
    $posts = Post::with('writer:id,name')
        ->where('is_approved', true)
        ->latest()
        ->take(5)
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



    return response()->json([
        'success' => true,
        'data' => $posts,
        'message' => 'Latest posts retrieved successfully'
    ]);
}
public function postsByWriter($writerId)
{
    $posts = Post::with(['writer.user', 'writer.subsection.section'])
        ->where('writer_id', $writerId)
        ->where('is_approved', true)
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

    

    return response()->json([
        'success' => true,
        'data' => $posts,
        'message' => 'Posts by writer retrieved successfully'
    ]);
}



}