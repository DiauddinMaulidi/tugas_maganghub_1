<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class RoleMenuSeeder extends Seeder
{
    public function run(): void
    {
        $admin = DB::table('roles')
            ->where('name', 'admin')
            ->first();

        $guru = DB::table('roles')
            ->where('name', 'guru')
            ->first();



        // memastikan role tersedia
        if (!$admin || !$guru) {
            throw new RuntimeException(
                'Role Admin atau Guru belum ditemukan di tabel roles.'
            );
        }

        // mengambil seluruh menu
        $menus = DB::table('menus')->get();

        foreach ($menus as $menu) {
            // Admin mendapatkan akses penuh
            DB::table('role_menus')->updateOrInsert(
                [
                    'role_id' => $admin->id,
                    'menu_id' => $menu->id
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

            DB::table('role_menus')->insertOrIgnore([
                [
                    'role_id' => $guru->id,
                    'menu_id' => $menu->id,
                    'can_view' => false,
                    'can_create' => false,
                    'can_edit' => false,
                    'can_delete' => false,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            ]);
        }
    }
}
