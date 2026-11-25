<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Menu;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::latest()->get();

        return view('admin.guru.index', compact('gurus'));
    }

    public function dashboard()
    {
        // Mengambil pengguna yang sedang login
        $guru = Auth::user();

        // Memastikan pengguna memiliki role Guru
        if (!$guru->role || strtolower($guru->role->name) !== 'guru') {
            abort(403, 'Anda tidak memiliki akses sebagai guru.');
        }

        $role = $guru->role;

        // Mengambil menu yang diizinkan Admin
        $menus = Menu::with(['roleMenus' => function ($query) use ($role) {
            $query->where('role_id', $role->id);
        }])
            ->where('is_active', true)
            ->whereHas('roleMenus', function ($query) use ($role) {
                $query->where('role_id', $role->id)
                    ->where('can_view', true);
            })
            ->get();

        // Memeriksa menu yang diizinkan
        $bolehAbsensi = $menus->contains('slug', 'absensi');
        $bolehDataSiswa = $menus->contains('slug', 'data-siswa');
        $bolehDataGuru = $menus->contains('slug', 'data-guru');
        $bolehDataKelas = $menus->contains('slug', 'data-kelas');

        // Mengambil kelas yang ditugaskan kepada Guru
        $kelas = ($bolehAbsensi || $bolehDataKelas || $bolehDataSiswa)
            ? $guru->kelasAbsensi()
            ->withCount('siswas')
            ->get()
            : collect();

        // Mengambil siswa hanya dari kelas yang ditugaskan
        $siswas = $bolehDataSiswa
            ? Siswa::whereIn('kelas_id', $kelas->pluck('id'))->get()
            : collect();

        // Mengambil akun pengguna dengan role Guru
        $gurus = $bolehDataGuru
            ? User::whereHas('role', function ($query) {
                $query->whereRaw('LOWER(name) = ?', ['guru']);
            })->get()
            : collect();

        return view('guru.dashboard', compact(
            'guru',
            'menus',
            'kelas',
            'siswas',
            'gurus',
            'bolehAbsensi',
            'bolehDataSiswa',
            'bolehDataGuru',
            'bolehDataKelas'
        ));
    }

    public function absensi($id)
    {
        $guru = Auth::user();

        // Memastikan kelas memang ditugaskan kepada Guru
        $kelas = $guru->kelasAbsensi()
            ->where('kelas.id', $id)
            ->firstOrFail();

        // Mengambil siswa berdasarkan kelas
        $siswa = Siswa::where('kelas_id', $kelas->id)
            ->orderBy('nama')
            ->get();

        return view('guru.absensi', compact(
            'guru',
            'kelas',
            'siswa'
        ));
    }

    public function simpanAbsensi(Request $request, $id)
    {
        $guru = Auth::user();

        // Fungsi simpan absensi tetap dilanjutkan di sini
    }
}
