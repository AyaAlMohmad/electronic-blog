<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsection;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WriterController extends Controller
{


    /**
     * Display pending writer requests
     */
    public function pendingRequests()
    {
        $pendingWriters = User::where('writer_request', true)
                            ->where('is_writer', false)
                            ->get();
        
        return view('admin.writers.pending', compact('pendingWriters'));
    }


    public function show( $id){
        $writer=Writer::where('id', $id)->first();
        $postCount = $writer->posts->count();
        return view('admin.writers.show', compact('writer','postCount'));
    }
    /**
     * Display approved writers
     */
    public function approvedWriters()
    {
        $writers = User::where('is_writer', true)->get();
        
        return view('admin.writers.approved', compact('writers'));
    }

    /**
     * Show approval form for a writer request
     */
    public function approveForm($userId)
    {
        $user = User::where('id', $userId)
                    ->where('writer_request', true)
                    ->where('is_writer', false)
                    ->firstOrFail();
        $subsections=Subsection::all();
        return view('admin.writers.approve', compact('user','subsections'));
    }

    /**
     * Approve a writer request
     */
    public function approve(Request $request, $userId)
    {
        $user = User::where('id', $userId)
                    ->where('writer_request', true)
                    ->where('is_writer', false)
                    ->firstOrFail();
        
        $validated = $request->validate([
            'bio' => 'required|string',
            'subsection_id' => 'required|exists:subsections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('writers', 'public');
        } elseif ($user->image_path) {
            $imagePath = $user->image_path;
        }
        
        // Create writer record
        $writer = Writer::create([
            'user_id' => $user->id,
            'name' => ['en' => $user->name, 'ar' => $user->name], // Adjust translations as needed
            'bio' => ['en' => $validated['bio'], 'ar' => $validated['bio']],
            'subsection_id' => $validated['subsection_id'],
            'image' => $imagePath
        ]);
        
        // Update user status
        $user->update([
            'is_writer' => true,
            'writer_request' => false
        ]);
        
        return redirect()->route('admin.writers.approved')->with('success', 'Writer approved successfully');
    }

    /**
     * Reject a writer request
     */
    public function reject($userId)
    {
        $user = User::where('id', $userId)
                    ->where('writer_request', true)
                    ->where('is_writer', false)
                    ->firstOrFail();
        
        $user->update(['writer_request' => false]);
        
        return redirect()->route('admin.writers.pending')->with('success', 'Writer request rejected');
    }

    /**
     * Revoke writer privileges
     */
    public function revoke($userId)
    {
        $user = User::where('id', $userId)
                    ->where('is_writer', true)
                    ->firstOrFail();
        
        // Delete writer record
        Writer::where('user_id', $user->id)->delete();
        
        // Remove writer status
        $user->update(['is_writer' => false]);
        
        return redirect()->route('admin.writers.approved')->with('success', 'Writer privileges revoked');
    }
}