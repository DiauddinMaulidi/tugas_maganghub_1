<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        Guru::updateOrCreate([
            'nip' => '123456789',
            'nama' => 'Ahmad Syahroni',
            'jenis_kelamin' => 'Laki-laki',
            'email' => 'roni@gmail.com',
        ]);

        Guru::updateOrCreate([
            'nip' => '987654321',
            'nama' => 'Siti Rahma',
            'jenis_kelamin' => 'Perempuan',
            'email' => 'rahma@gmail.com',
        ]);

        Guru::updateOrCreate([
            'nip' => '123459876',
            'nama' => 'Menteng',
            'jenis_kelamin' => 'Laki-laki',
            'email' => 'men@gmail.com',
        ]);
    }
}
