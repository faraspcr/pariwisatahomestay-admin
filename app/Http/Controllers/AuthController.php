<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        // TAMBAHKAN: Auth::check() untuk cek jika sudah login
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login');
    }

    // Show register form
    public function showRegisterForm()
    {
        // TAMBAHKAN: Auth::check() untuk cek jika sudah login
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.register');
    }

    // Process register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // TAMBAHKAN: Auth::login() untuk login otomatis setelah register
        Auth::login($user);

        // TAMBAHKAN: Simpan waktu login WIB ke session
        date_default_timezone_set('Asia/Jakarta');
        $waktuWIB = date('Y-m-d H:i:s');
        session(['last_login' => $waktuWIB]);

        // Redirect ke dashboard dengan success message
        return redirect()->route('dashboard')
            ->with('success', 'Registrasi dan login berhasil! Selamat datang.');
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        // TAMBAHKAN: Cari user dan gunakan Auth::login() seperti materi
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // TAMBAHKAN: Auth::login() seperti di materi
            Auth::login($user);

            // TAMBAHKAN: Simpan waktu login WIB ke session
            date_default_timezone_set('Asia/Jakarta');
            $waktuWIB = date('Y-m-d H:i:s');
            session(['last_login' => $waktuWIB]);

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil! Selamat datang.');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->except('password'));
    }

    // Logout
    public function logout(Request $request)
    {
        // TAMBAHKAN: Auth::logout() seperti di materi
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Logout berhasil!');
    }
}
