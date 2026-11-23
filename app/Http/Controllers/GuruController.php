<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GuruController extends Controller
{
    public function index() {
        $gurus = Guru::latest()->get();

        return view('admin.guru.index', compact('gurus'));
    }

    public function dashboard()
        {
            $guru = Auth::user();

            // Pastikan akun memiliki role guru
            if (!$guru->roles()->where('name', 'guru')->exists()) {
                abort(403, 'Anda tidak memiliki akses sebagai guru.');
            }

            // Ambil kelas yang ditugaskan kepada guru
            $kelas = $guru->kelasAbsensi()
                ->withCount('siswas')
                ->get();

            return view('guru.dashboard', compact('guru', 'kelas'));
        }
}
