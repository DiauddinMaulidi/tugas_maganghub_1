<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // menampilkan halaman login
    public function showLogin() {
        return view('auth.login');
    }

    // memproses login
    public function login(Request $request) {
        // validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // mencari user berdasarkan email
        $user = User::with('role')
                ->where('email', $credentials['email'])
                ->first();

        // memeriksa user dan status aktif
        if (!$user || !$user->is_active) {
            return back()->withErrors([
                'email' => 'Akun tidak ditemukan atau tidak aktif.',
            ])->onlyInput('email');
        }

        // memeriksa password
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        // login menggunakan session laravel
        Auth::login($user);

        // regenerasi session untuk keamanan
        $request->session()->regenerate();

        // mengambil role user
        $roles = $user->role?->name;

        // mengarahkan berdasarkan role
        if ($roles === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($roles === 'guru') {
            return redirect()->route('guru.dashboard');
        }

        if ($roles === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        // logout jika tidak memiliki role
        Auth::logout();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Akun belum memiliki role.',
            ]);
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
