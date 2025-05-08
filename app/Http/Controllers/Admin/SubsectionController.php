<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Subsection;
use Illuminate\Http\Request;

class SubsectionController extends Controller
{
    /**
     * Display a listing of the subsections.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsections = Subsection::with('section')->get();
        return view('admin.subsections.index', compact('subsections'));
    }

    /**
     * Show the form for creating a new subsection.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.subsections.create', compact('sections'));
    }

    /**
     * Store a newly created subsection in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id'
        ]);

        Subsection::create($validatedData);

        return redirect()->route('admin.subsections.index')
                         ->with('success', 'Subsection created successfully.');
    }

    /**
     * Display the specified subsection.
     *
     * @param  \App\Models\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function show(Subsection $subsection)
    {
        return view('admin.subsections.show', compact('subsection'));
    }

    /**
     * Show the form for editing the specified subsection.
     *
     * @param  \App\Models\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsection $subsection)
    {
        $sections = Section::all();
        return view('admin.subsections.edit', compact('subsection', 'sections'));
    }

    /**
     * Update the specified subsection in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsection $subsection)
    {
        $validatedData = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id'
        ]);

        $subsection->update($validatedData);

        return redirect()->route('admin.subsections.index')
                         ->with('success', 'Subsection updated successfully');
    }

    /**
     * Remove the specified subsection from storage.
     *
     * @param  \App\Models\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsection $subsection)
    {
        $subsection->delete();

        return redirect()->route('admin.subsections.index')
                         ->with('success', 'Subsection deleted successfully');
    }
}