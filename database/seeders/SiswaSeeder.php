<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $dataSiswa = [
            [
                'nis' => '2026001',
                'nama' => 'Andi Saputra',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Mataram',
                'tanggal_lahir' => '2010-01-15',
                'alamat' => 'Mataram, NTB',
                'kelas' => 'VII A',
            ],
            [
                'nis' => '2026002',
                'nama' => 'Siti Aisyah',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Selong',
                'tanggal_lahir' => '2010-03-20',
                'alamat' => 'Selong, Lombok Timur',
                'kelas' => 'VII A',
            ],
            [
                'nis' => '2026003',
                'nama' => 'Muhammad Rizki',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Praya',
                'tanggal_lahir' => '2010-05-10',
                'alamat' => 'Praya, Lombok Tengah',
                'kelas' => 'VII B',
            ],
            [
                'nis' => '2026004',
                'nama' => 'Dewi Anggraini',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Mataram',
                'tanggal_lahir' => '2010-07-12',
                'alamat' => 'Cakranegara, Mataram',
                'kelas' => 'VII B',
            ],
        ];

        foreach ($dataSiswa as $siswa) {
            Siswa::updateOrCreate(
                ['nis' => $siswa['nis']],
                $siswa
            );
        }
    }
}
