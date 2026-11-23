<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;

class GuruController extends Controller
{
    public function index() {
        $gurus = Guru::latest()->get();

        return view('admin.guru.index', compact('gurus'));
    }

    public function dashboard() {
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

    public function absensi($id) {
        $guru = Auth::user();

        // ambil kelas yang ditugaskan guru
        $kelas = $guru->kelasAbsensi()
            ->where('kelas.id', $id)
            ->firstOrFail();
        
        // ambil siswa berdasarkan kelas
        $siswa = Siswa::where('kelas_id', $kelas->id)
            ->orderBy('nama')
            ->get();

        return view('guru.absensi', compact('guru', 'kelas', 'siswa'));
    }

    public function simpanAbsensi(Request $request, $id) {
        $guru = Auth::user();
    }

}
