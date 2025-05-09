<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_us = ContactUs::all();
        return view('admin.contact_us.index', compact('contact_us'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact_us.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'fax' => 'nullable|string',
            'map' => 'nullable|string',
            'address' => 'required|array',
        ]);

        ContactUs::create($request->all());

        return redirect()->route('admin.contact_us.index')->with('success', 'Contact us created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactUs  $contact_us
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact_us = ContactUs::findOrFail($id);
        return view('admin.contact_us.show', compact('contact_us'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $contact_us
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact_us = ContactUs::findOrFail($id);

        return view('admin.contact_us.edit', compact('contact_us'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contact_us
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contact_us)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'fax' => 'nullable|string',
            'map' => 'nullable|string',
            'address' => 'required|array',
        ]);

        $contact_us->update($request->all());

        return redirect()->route('admin.contact_us.index')->with('success', 'Contact us updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $contact_us
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contact_us)
    {
        $contact_us->delete();

        return redirect()->route('admin.contact_us.index')->with('success', 'Contact us deleted successfully.');
    }
}