<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        // If user is already authenticated, redirect to admin dashboard
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            // Check if user is admin
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();
                
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Umefanikiwa kuingia kwenye mfumo wa usimamizi.');
            } else {
                // Log out if user is not admin
                Auth::logout();
                Session::flush();
                
                return back()->withErrors([
                    'email' => 'Huna ruhusa ya kuingia kwenye mfumo wa usimamizi.',
                ])->onlyInput('email');
            }
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'Barua pepe au nenosiri si sahihi.',
        ])->onlyInput('email');
    }

    /**
     * Handle admin logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Umefanikiwa kutoka kwenye mfumo wa usimamizi.');
    }

    /**
     * Show admin dashboard (optional - can be in AdminController)
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}