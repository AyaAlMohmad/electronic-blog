<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::select('id', 'name')->get();
        return response()->json([
            'status' => 'success',
            'data' => $sections
        ]);
    }

    public function show($id)
    {
        $section = Section::select('id', 'name')->findOrFail($id);
        return response()->json([
            'status' => 'success', 
            'data' => $section
        ]);
    }
}
