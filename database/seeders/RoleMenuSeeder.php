<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class RoleMenuSeeder extends Seeder
{
    public function run(): void
    {
        // mengambil seluruh role
        $roles = DB::table('roles')->get();

        $admin = $roles->first(
            fn($role) => strtolower($role->name) === 'admin'
        );

        $guru = $roles->first(
            fn($role) => strtolower($role->name) === 'guru'
        );

        // memastikan role tersedia
        if (!$admin || !$guru) {
            throw new RuntimeException(
                'Role Admin atau Guru belum ditemukan di tabel roles.'
            );
        }

        // mengambil seluruh menu
        $menus = DB::table('menus')->get();

        // hak akses Guru berdasarkan slug menu
        $aksesGuru = [
            'data-siswa' => [
                'can_view' => true,
            ],
            'data-kelas' => [
                'can_view' => true,
            ],
            'data-guru' => [
                'can_view' => true,
            ],
            'absensi' => [
                'can_view' => true,
                'can_create' => true,
                'can_edit' => true
            ],
        ];

        foreach ($menus as $menu) {
            // Hak akses Admin
            DB::table('role_menus')->updateOrInsert(
                [
                    'role_id' => $admin->id,
                    'menu_id' => $menu->id,
                ],
                [
                    'can_view' => true,
                    'can_create' => true,
                    'can_edit' => true,
                    'can_delete' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            // Hak akses Guru
            $akses = $aksesGuru[$menu->slug] ?? [];

            DB::table('role_menus')->updateOrInsert(
                [
                    'role_id' => $guru->id,
                    'menu_id' => $menu->id,
                ],
                [
                    'can_view' => $akses['can_view'] ?? false,
                    'can_create' => $akses['can_create'] ?? false,
                    'can_edit' => $akses['can_edit'] ?? false,
                    'can_delete' => $akses['can_delete'] ?? false,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
