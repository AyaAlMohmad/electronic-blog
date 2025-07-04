<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subsection;
use App\Models\Section;
use Illuminate\Http\Request;

class SubSectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['subsections' => function($query) {
            $query->select('id', 'section_id', 'name');
        }])->get(['id', 'name']);

        return response()->json([
            'status' => 'success',
            'data' => $sections
        ]);
    }

    public function show($id)
    {
        $subsection = Subsection::with(['section:id,name'])->findOrFail($id, ['id', 'name', 'section_id']);
    
        return response()->json([
            'status' => 'success',
            'data' => $subsection
        ]);
    }

    public function showSubsectionDetails($subsectionId)
{
    $subsection = \App\Models\Subsection::where('id', $subsectionId)
        ->first();

    if (!$subsection) {
        return response()->json([
            'success' => false,
            'message' => 'Subsection not found'
        ], 404);
    }
    $writer = \App\Models\Writer::where('subsection_id', $subsectionId)
    ->get();
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
        'data' => [
            'subsection' => $subsection,
            'posts' => $posts
        ],
        'message' => 'Posts by subsection with comments and likes retrieved successfully'
    ]);
}
    
    

    
}
