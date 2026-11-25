<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // mengambil semua user dgn rolenya
        $users = User::with('role')->get();

        // mengambil seluruh data guru
        $gurus = Guru::all();
        $siswas = Siswa::all();
        $kelas = Kelas::with('waliKelas')
            ->withCount('siswas')
            ->latest()
            ->get();

        // Mengambil akun yang memiliki role guru
        $guruUsers = User::whereHas('role', function ($query) {
            $query->where('name', 'guru');
        })->get();

        $guruRole = Role::where('name', 'guru')->first();

        $menus = Menu::with(['roleMenus' => function ($query) use ($guruRole) {
            if ($guruRole) {
                $query->where('role_id', $guruRole->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        }])->get();

        // mengirim data ke halaman Blade
        return view('admin.dashboard', compact('users', 'gurus', 'siswas', 'kelas', 'guruUsers', 'guruRole', 'menus'));
    }

    public function assignGuruKelas(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $guru = User::whereHas('role', function ($query) {
            $query->where('name', 'guru');
        })->findOrFail($request->user_id);

        $guru->kelasAbsensi()->syncWithoutDetaching([
            $request->kelas_id
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Guru berhasil ditambahkan ke kelas absensi.');
    }
}
