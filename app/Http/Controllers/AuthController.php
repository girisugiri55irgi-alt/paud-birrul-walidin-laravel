<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranSpmb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password tidak sesuai.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $role = Auth::user()->role;

        // Dashboard administrator tetap seperti semula.
        if ($role === 'administrator') {
            return redirect()->route('dashboard');
        }

        // Dashboard pendidik tetap seperti semula.
        if ($role === 'pendidik') {
            return redirect()->route('pendidik.dashboard');
        }

        // Orang tua diarahkan ke menu tugas anak.
        if ($role === 'orang_tua') {
            return redirect()->route('orangtua.dashboard');
        }

        // Keluar jika peran tidak dikenali.
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Peran pengguna belum terdaftar.',
            ]);
    }

    public function dashboard()
    {
        // Dashboard ini hanya untuk administrator.
        abort_unless(
            Auth::check() &&
            Auth::user()->role === 'administrator',
            403,
            'Anda tidak memiliki akses ke dashboard administrator.'
        );

        $spmbStats = [
            'total' => PendaftaranSpmb::count(),

            'menunggu' => PendaftaranSpmb::where(
                'status',
                'menunggu'
            )->count(),

            'diterima' => PendaftaranSpmb::where(
                'status',
                'diterima'
            )->count(),

            'tidak_diterima' => PendaftaranSpmb::where(
                'status',
                'tidak_diterima'
            )->count(),
        ];

        return view('dashboard', compact('spmbStats'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}