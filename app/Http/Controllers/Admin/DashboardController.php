<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;
use App\Models\User;
use App\Models\Writer;
use App\Models\Section;
use App\Models\Subsection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    { $topLikedPosts = Post::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(5)
            ->get();
    
        $topCommentedPosts = Post::withCount('comments')
            ->orderByDesc('comments_count')
            ->take(5)
            ->get();
    
        $stats = [
            'total_posts' => Post::count(),
            'approved_posts' => Post::where('is_approved', true)->count(),
            'pending_posts' => Post::where('is_approved', false)->count(),
    
            'total_users' => User::count(),
            'writer_requests' => User::writerRequests()->count(),
            'writers' => Writer::count(),
    
            'total_sections' => Section::count(),
            'total_subsections' => Subsection::count(),
    
            'total_likes' => PostLike::count(),
            'total_comments' => PostComment::count(),
            
            'avg_likes_per_post' => round(PostLike::count() / max(Post::count(), 1), 2),
            'avg_comments_per_post' => round(PostComment::count() / max(Post::count(), 1), 2),
            'approval_rate' => round(Post::where('is_approved', true)->count() / max(Post::count(), 1) * 100, 2),
        ];
    
        $monthlyPosts = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');
        
        $topWriters = User::whereHas('writer')
            ->withCount('posts')
            ->orderByDesc('posts_count')
            ->take(5)
            ->get();
        
        $totalComments = PostComment::count();
        
        $pendingPosts = Post::where('is_approved', false)->count();
        
        $topCategories = Subsection::select('subsections.*')
        ->selectSub(function($query) {
            $query->selectRaw('count(posts.id)')
                  ->from('posts')
                  ->join('writers', 'writers.id', '=', 'posts.writer_id')
                  ->whereColumn('writers.subsection_id', 'subsections.id');
        }, 'posts_count')
        ->orderByDesc('posts_count')
        ->take(5)
        ->get();
        
        $averageApprovalTime = Post::where('is_approved', true)
        ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_hours')
        ->value('avg_hours') ?? 0;
        
        $mostActiveWritersByInteraction = Writer::leftJoin('posts', 'writers.id', '=', 'posts.writer_id')
        ->leftJoin('post_likes', 'post_likes.post_id', '=', 'posts.id')
        ->select([
            'writers.*',
            DB::raw('COUNT(DISTINCT posts.id) as posts_count'),
            DB::raw('COUNT(post_likes.id) as total_likes')
        ])
        ->groupBy('writers.id')
        ->orderByDesc('total_likes')
        ->take(5)
        ->get();
        $sectionActivity = Section::select('sections.*')
        ->selectSub(function($query) {
            $query->selectRaw('COUNT(posts.id)')
                  ->from('posts')
                  ->join('writers', 'writers.id', '=', 'posts.writer_id')
                  ->join('subsections', 'subsections.id', '=', 'writers.subsection_id')
                  ->whereColumn('subsections.section_id', 'sections.id');
        }, 'posts_count')
        ->orderByDesc('posts_count')
        ->take(3)
        ->get();
        
        $writerConversionRate = Writer::count() / max(User::writerRequests()->count() + Writer::count(), 1) * 100;
    
        return view('dashboard', compact(
            'stats',
            'topLikedPosts',
            'topCommentedPosts',
            'monthlyPosts',
            'topWriters',
            'totalComments',
            'pendingPosts',
            'topCategories',
            'averageApprovalTime',
            'mostActiveWritersByInteraction',
            'sectionActivity',
            'writerConversionRate'
        ));
    }
}
