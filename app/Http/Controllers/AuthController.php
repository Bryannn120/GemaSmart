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
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'captcha' => ['required', 'numeric'],
        ]);

        if ($request->captcha != session('captcha_answer')) {
            return back()->withErrors([
                'captcha' => 'Jawaban penjumlahan salah.',
            ])->onlyInput('login');
        }

        // Hapus session captcha setelah divalidasi
        $request->session()->forget('captcha_answer');

        $loginInput = $request->login;
        $password = $request->password;

        // 1. Coba login normal via email
        $attempt = Auth::attempt(['email' => $loginInput, 'password' => $password]);

        // 2. Jika gagal atau loginInput bukan email, cek apakah itu Nomor KK (Penerima)
        if (!$attempt) {
            $keluarga = \App\Models\KeluargaPenerima::where('no_kk', $loginInput)->first();
            if ($keluarga && $keluarga->user) {
                $attempt = Auth::attempt(['id' => $keluarga->user_id, 'password' => $password]);
            }
        }

        if ($attempt) {
            $request->session()->regenerate();
            
            // Redirect based on role
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
            'login' => 'Email / Nomor KK atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('login');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
