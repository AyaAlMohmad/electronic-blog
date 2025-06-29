<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    // public function me()
    // {
    //     $user = auth()->user();

    //     return response()->json([
    //         'user' => [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'avatar' => $user->image_path,
    //             'is_writer' => $user->is_writer,
    //             'registration_date' => $user->created_at->format('d M Y')
    //         ],
    //         'meta' => [
    //             'status' => 'success',
    //             'message' => 'User profile retrieved successfully'
    //         ]
    //     ]);
    // }
    public function me()
    {
        $user = auth()->user();
        
        // Base user data
        $response = [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->image_path,
                'is_writer' => $user->is_writer,
                'registration_date' => $user->created_at->format('d M Y')
            ],
            'meta' => [
                'status' => 'success',
                'message' => 'User profile retrieved successfully'
            ]
        ];
    
        // Add writer-specific data if user is a writer
        if ($user->is_writer) {
            $writer = $user->writer->with(['subsection', 'posts'])->first();
            
            $response['user']['writer_profile'] = [
                'bio' => $writer->bio,
                'writer_image' => $writer->image ? asset('storage/' . $writer->image) : null,
                'subsection' => $writer->subsection ? [
                    'id' => $writer->subsection->id,
                    'name' => $writer->subsection->name
                ] : null,
                'posts_count' => $writer->posts->count(),
                'writer_since' => $writer->created_at->format('d M Y')
            ];
        }
    
        return response()->json($response);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logged out']);
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => JWTAuth::refresh(),
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'is_writer' => 'boolean' // New field
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'writer_request' => $validated['is_writer'] ?? false
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Registration successful' .
                ($user->writer_request ? ' and writer request submitted for admin approval' : ''),
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ], 201);
    }
    // public function updateProfile(Request $request)
    // {
    //     $userid = Auth::id();
    //     $user = User::where('id', $userid)->first();
    //     $validated = $request->validate([
    //         'name' => 'sometimes|string|max:255',
    //         'email' => 'sometimes|email|unique:users,email,' . $user->id,
    //         'password' => 'sometimes|string|min:6|confirmed',
    //         'image' => 'nullable|file|image|max:2048',
    //     ]);

    //     // Update password if provided
    //     if ($request->has('password')) {
    //         $validated['password'] = bcrypt($validated['password']);
    //     }

    //     // Handle image update
    //     if ($request->hasFile('image')) {
    //         // Delete old image if exists
    //         if ($user->image_path) {
    //             Storage::disk('public')->delete($user->image_path);
    //         }

    //         $path = $request->file('image')->store('profiles', 'public');
    //         $validated['image_path'] ='/storage/'. $path;
    //     }

    //     $user->update($validated);

    //     return response()->json([
    //         'message' => 'Profile updated successfully',
    //         'user' => $user
    //     ]);
    // }
 public function updateProfile(Request $request)
{
    $userid = Auth::id();
    $user = User::where('id', $userid)->first();
    
    $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:users,email,' . $user->id,
        'password' => 'sometimes|string|min:6|confirmed',
        'image' => 'nullable|file|image|max:2048', // صورة واحدة لليوزر والكاتب
        'bio' => 'sometimes|json',
        'subsection_id' => 'sometimes|exists:subsections,id',
    ]);

    // تحديث كلمة المرور إذا تم تقديمها
    if ($request->has('password')) {
        $validated['password'] = bcrypt($validated['password']);
    }

    // التعامل مع صورة المستخدم/الكاتب
    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إذا كانت موجودة
        if ($user->image_path) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $user->image_path));
        }

        // رفع الصورة الجديدة
        $path = $request->file('image')->store('profiles', 'public');
        $validated['image_path'] = '/storage/'.$path;
    }

    // تحديث بيانات المستخدم
    $user->update($validated);

    // إذا كان المستخدم كاتبًا، تحديث بيانات الكاتب
    if ($user->is_writer) {
        $writer = $user->writer()->firstOrNew();
        $writerData = [
            'name' => $user->name,
            'image' => $user->image_path,
        ];

        if ($request->has('bio')) {
            try {
                $bioData = json_decode($validated['bio'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $writerData['bio'] = $bioData;
                }
            } catch (\Exception $e) {
                // يمكنك تسجيل الخطأ إذا لزم الأمر
            }
        }
        
        if ($request->has('subsection_id')) {
            $writerData['subsection_id'] = $validated['subsection_id'];
        }

        $writer->fill($writerData)->save();
    }

    return response()->json([
        'message' => 'Profile updated successfully',
        'user' => $user->load('writer'),
    ]);
}

protected function getUpdatedFields($validated, $request)
{
    $updated = [];
    
    // Check user fields
    if (isset($validated['name'])) $updated[] = 'name';
    if (isset($validated['email'])) $updated[] = 'email';
    if (isset($validated['password'])) $updated[] = 'password';
    if ($request->hasFile('image')) $updated[] = 'image';
    
    // Check writer fields
    if ($request->user()->is_writer) {
        if (isset($validated['bio'])) $updated[] = 'bio';
        if (isset($validated['subsection_id'])) $updated[] = 'subsection_id';
        // تمت إزالة writer_image من القائمة
    }
    
    return $updated;
}
}
