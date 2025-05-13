<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   
    public function index()
    {
        $users = User::where('writer_request', false)
                    ->where('is_writer', false)
                    ->where('is_admin', false)
                    ->get();
                    
        return view('admin.users.index', compact('users'));
    }

   
    public function show($id)
    {
        $user = User::where('id', $id)
                    ->where('writer_request', false)
                    ->where('is_writer', false)
                    ->where('is_admin', false)
                    ->firstOrFail();
                    
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)
                    ->where('writer_request', false)
                    ->where('is_writer', false)
                    ->where('is_admin', false)
                    ->firstOrFail();
                    
        return view('admin.users.edit', compact('user'));
    }

    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
         
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_admin' => 'nullable|boolean',
            'is_writer' => 'nullable|boolean'
        ]);
        
        // Handle password update
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image_path) {
                Storage::disk('public')->delete($user->image_path);
            }

            $path = $request->file('image')->store('profiles', 'public');
            $validated['image_path'] ='/storage/'. $path;
        }
        
        // Handle checkboxes (they won't be sent if unchecked)
        $validated['is_admin'] = $request->has('is_admin');
        $validated['is_writer'] = $request->has('is_writer');
        
        $user->update($validated);
        
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

  
    public function destroy($id)
    {
        $user = User::where('id', $id)
                    ->where('writer_request', false)
                    ->where('is_writer', false)
                    ->where('is_admin', false)
                    ->firstOrFail();
                    
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}