<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/'
            ],
        ], [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 3 karakter!',
            'password.regex' => 'Password harus mengandung huruf kapital!',
        ]);

        if ($request->username === $request->password) {
            $username = $request->username;

            // ✅ SIMPAN username ke session
            session(['username' => $username]);

            return view('login-success', compact('username'));
        }

        return back()
            ->withErrors(['login' => 'Username dan password tidak cocok!'])
            ->withInput();
    }

    // ✅ TAMBAHKAN METHOD LOGOUT
    public function logout(Request $request)
    {
        // Hapus session
        $request->session()->forget('username');
        $request->session()->flush();

        return redirect('/auth')->with('success', 'Anda berhasil logout!');
    }
}
