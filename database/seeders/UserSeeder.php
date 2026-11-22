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
        // Membuat akun Admin Sekolah
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('admin123'),
                'is_active' => true,
            ]
        );

        // Membuat akun Guru Sekolah
        $guru = User::updateOrCreate(
            ['email' => 'guruAgama@gmail.com'],
            [
                'name' => 'Tantowi Ahmad',
                'password' => Hash::make('petugas123'),
                'is_active' => true,
            ]
        );

        // Mengambil role
        $roleAdmin = Role::where('name', 'admin')->firstOrFail();
        $roleGuru = Role::where('name', 'guru')->firstOrFail();

        // Menghubungkan user dengan role
        $admin->roles()->syncWithoutDetaching([$roleAdmin->id]);
        $guru->roles()->syncWithoutDetaching([$roleGuru->id]);
    }
}
