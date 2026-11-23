<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // mengambil semua user dgn rolenya
        $users = User::with('roles')->get();

        // mengambil seluruh data guru
        $gurus = Guru::all();
        $siswas = Siswa::all();
        $kelas = Kelas::with('waliKelas')
            ->withCount('siswas')
            ->latest()
            ->get();

        // Mengambil akun yang memiliki role guru
        $guruUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        // mengirim data ke halaman Blade
        return view('admin.dashboard', compact('users', 'gurus', 'siswas', 'kelas', 'guruUsers'));
    }
}
