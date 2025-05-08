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
        $section = Section::with(['subsections' => function($query) {
            $query->select('id', 'section_id', 'name');
        }])->findOrFail($id, ['id', 'name']);

        return response()->json([
            'status' => 'success',
            'data' => $section
        ]);
    }
}
