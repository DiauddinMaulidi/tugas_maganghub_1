<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Mengambil role
        $roleAdmin = Role::where('name', 'admin')->firstOrFail();
        $roleGuru = Role::where('name', 'guru')->firstOrFail();
        $siswaRole = Role::where('name', 'siswa')->firstOrFail();
        
        // Membuat akun Admin Sekolah
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('admin123'),
                'role_id' => $roleAdmin->id,
                'is_active' => true,
            ]
        );

        // Membuat akun Guru Sekolah
        $guru = User::updateOrCreate(
            ['email' => 'guru1@gmail.com'],
            [
                'name' => 'Tantowi Ahmad',
                'password' => Hash::make('guru123'),
                'role_id' => $roleGuru->id,
                'is_active' => true,
            ]
        );

        // Membuat akun Siswa
       $siswa = User::updateOrCreate(
            ['email' => 'siswa@gmail.com'],
            [
                'name' => 'Siswa Sekolah',
                'password' => Hash::make('siswa123'),
                'role_id' => $siswaRole->id,
                'is_active' => true,
            ]
        );
    }
}
