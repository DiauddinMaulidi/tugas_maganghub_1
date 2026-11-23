<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $dataKelas = [
            [
                'nama_kelas' => 'VII A',
                'tingkat' => 'VII',
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'VII B',
                'tingkat' => 'VII',
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'VIII A',
                'tingkat' => 'VIII',
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'VIII B',
                'tingkat' => 'VIII',
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'IX A',
                'tingkat' => 'IX',
                'tahun_ajaran' => '2026/2027',
            ],
        ];

        foreach ($dataKelas as $kelas) {
            Kelas::updateOrCreate(
                [
                    'nama_kelas' => $kelas['nama_kelas'],
                    'tahun_ajaran' => $kelas['tahun_ajaran'],
                ],
                $kelas
            );
        }
    }
}
