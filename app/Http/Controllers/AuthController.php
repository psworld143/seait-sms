<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended($this->getDashboardRoute());
        }
        
        return view('auth.login');
    }

    /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        // Check if user exists and get their role
        $user = DB::table('users')
            ->where('email', $credentials['email'])
            ->where('is_active', 1)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Invalid credentials or account is inactive.',
            ])->withInput($request->only('email'));
        }

        // Check password
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->withInput($request->only('email'));
        }

        // Login the user
        Auth::loginUsingId($user->id);
        
        // Store user role in session
        Session::put('user_role', $user->role);
        Session::put('user_id', $user->id);

        // Redirect to appropriate dashboard based on role
        return redirect()->intended($this->getDashboardRoute($user->role));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        
        return redirect('/')->with('success', 'You have been successfully logged out.');
    }

    /**
     * Get dashboard route based on user role
     */
    private function getDashboardRoute($role = null)
    {
        if (!$role && Auth::check()) {
            $role = Auth::user()->role;
        }

        switch ($role) {
            case 'admin':
                return '/admin';
            case 'faculty':
                return '/faculty';
            case 'student':
                return '/students';
            case 'head':
                return '/heads';
            case 'content_creator':
                return '/content-creator';
            case 'social_media_manager':
                return '/social-media';
            default:
                return '/';
        }
    }
}
