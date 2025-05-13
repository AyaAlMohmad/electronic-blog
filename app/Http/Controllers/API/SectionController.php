<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::select('id', 'name','image')->get();
        $sections->each(function ($section) {
            $section->image ='/storage/' . $section->image;
        });
        return response()->json([
            'status' => 'success',
            'data' => $sections
        ]);
    }

    public function show($id)
    {
        $section = Section::select('id', 'name','image')->findOrFail($id);
        $section->image = '/storage/' . $section->image;
        return response()->json([
            'status' => 'success', 
            'data' => $section
        ]);
    }
}
