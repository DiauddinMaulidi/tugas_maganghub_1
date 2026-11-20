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

        // Membuat akun Petugas Sekolah
        $petugas = User::updateOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name' => 'Petugas Sekolah',
                'password' => Hash::make('petugas123'),
                'is_active' => true,
            ]
        );

        // Mengambil role
        $roleAdmin = Role::where('name', 'admin')->firstOrFail();
        $rolePetugas = Role::where('name', 'petugas')->firstOrFail();

        // Menghubungkan user dengan role
        $admin->roles()->syncWithoutDetaching([$roleAdmin->id]);
        $petugas->roles()->syncWithoutDetaching([$rolePetugas->id]);

    }
}
