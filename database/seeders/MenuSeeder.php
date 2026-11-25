<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $dataMenu = [
            [
                'nama_menu' => 'Managemen Pengguna',
                'slug' => 'pengguna',
                'route' => 'admin.dashboard',
            ],
            [
                'nama_menu' => 'Data Guru',
                'slug' => 'data-guru',
                'route' => 'admin.dashboard',
            ],
            [
                'nama_menu' => 'Data Siswa',
                'slug' => 'data-siswa',
                'route' => 'admin.dashboard',
            ],
            [
                'nama_menu' => 'Absensi',
                'slug' => 'guru',
                'route' => 'guru.absensi',
            ],
            [
                'nama_menu' => 'Data Guru',
                'slug' => 'data_guru',
                'route' => 'admin.data_guru',
            ],
        ];

        foreach ($dataMenu as $menu) {
            DB::table('menus')->updateOrInsert(
                ['slug' => $menu['slug']],
                array_merge($menu, [
                    'is_active' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
