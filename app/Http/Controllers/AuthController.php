<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Kalau sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        // Ambil artikel terbaru untuk ditampilkan di login page (jika ada)
        $artikels = collect([]);
        try {
            if (\Schema::hasTable('artikels')) {
                $artikels = \App\Models\Artikel::where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
            }
        } catch (\Exception $e) {
            // Jika error, biarkan artikels kosong
        }
        
        return view('auth.login', compact('artikels'));
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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
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

    // Register
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir', // Default role kasir
        ]);

        // Auto login setelah register
        Auth::login($user);

        // Log register
        \App\Models\LoginLog::create([
            'user_id'    => $user->id,
            'aksi'       => 'register',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    // Forgot Password
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
        ]);

        // Generate token
        $token = Str::random(64);

        // Simpan token ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Kirim email (simulasi - dalam production gunakan Mail::send)
        // Untuk development, kita redirect dengan token
        return redirect()->route('password.reset', ['token' => $token, 'email' => $request->email])
            ->with('success', 'Link reset password telah dikirim!');
    }

    // Reset Password
    public function showResetPassword(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.exists' => 'Email tidak terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Cek token
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Token reset tidak valid']);
        }

        // Cek apakah token expired (24 jam)
        if (now()->diffInHours($resetRecord->created_at) > 24) {
            return back()->withErrors(['email' => 'Token reset sudah kadaluarsa']);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login.');
    }
}
