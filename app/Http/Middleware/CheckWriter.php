<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWriter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if authenticated user has writer privileges
        if (!auth()->user()->is_writer) {
            return response()->json([
                'message' => 'You do not have writing permissions'
            ], 403);
        }
        
        return $next($request);
    }
}
