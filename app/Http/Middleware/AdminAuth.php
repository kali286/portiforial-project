<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login.');
        }

        // Check if user has admin privileges (uncomment if you have is_admin column)
        if (!Auth::user()->is_admin) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Access denied.');
        }

        return $next($request);
    }
}