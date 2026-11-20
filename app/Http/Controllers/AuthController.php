<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses autentikasi user dengan keamanan input ketat (Anti SQLi & Anti XSS).
     */
    public function login(Request $request)
    {
        // Validasi input secara ketat
        $request->validate([
            'email'    => 'required|email:dns,rfc|string|max:255',
            'password' => 'required|string',
        ]);

        // Sanitasi input email (trim, lowercase, filter_var sanitize email)
        $cleanEmail = filter_var(strtolower(trim($request->input('email'))), FILTER_SANITIZE_EMAIL);

        $credentials = [
            'email'    => $cleanEmail,
            'password' => $request->input('password'),
        ];

        // Auth::attempt memanfaatkan PDO Prepared Statement bawaan Eloquent (Aman dari SQL Injection)
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Mencegah Session Fixation Attack
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        // Jika kredensial tidak cocok
        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    /**
     * Memproses logout user dan menghapus session secara aman.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session dan regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
