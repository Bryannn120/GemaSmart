<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        session(['captcha_answer' => $num1 + $num2]);

        return view('auth.login', compact('num1', 'num2'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'captcha' => ['required', 'numeric'],
        ]);

        if ($request->captcha != session('captcha_answer')) {
            return back()->withErrors([
                'captcha' => 'Jawaban penjumlahan salah.',
            ])->onlyInput('email');
        }

        // Hapus session captcha setelah divalidasi
        $request->session()->forget('captcha_answer');

        if (\Illuminate\Support\Facades\Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            
            // Redirect based on role
            // Assume the users table has a 'role' column. 
            // Roles: 'pemda', 'kampus', 'pendamping', 'validator'
            $role = Auth::user()->role ?? 'default';
            
            return match($role) {
                'pemda' => redirect()->intended('/dashboard/pemda'),
                'kampus' => redirect()->intended('/dashboard/kampus'),
                'pendamping' => redirect()->intended('/dashboard/pendamping'),
                'validator' => redirect()->intended('/dashboard/validator'),
                'penerima' => redirect()->intended('/dashboard/penerima'),
                default => redirect()->intended('/dashboard/penerima'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
