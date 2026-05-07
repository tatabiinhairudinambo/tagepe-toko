<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Kalau sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Rate limiting: max 5 percobaan per menit per IP
        $key = 'login.' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            ])->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            \Illuminate\Support\Facades\RateLimiter::clear($key);
            $request->session()->regenerate();
            // Log login
            \App\Models\LoginLog::create([
                'user_id'    => Auth::id(),
                'aksi'       => 'login',
                'ip_address' => $request->ip(),
            ]);
            return redirect()->route('dashboard');
        }

        \Illuminate\Support\Facades\RateLimiter::hit($key, 60);

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        // Log logout
        \App\Models\LoginLog::create([
            'user_id'    => Auth::id(),
            'aksi'       => 'logout',
            'ip_address' => $request->ip(),
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
