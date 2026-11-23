<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;

class Absensi extends Model
{
    protected $table = 'absensis';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'user_id',
        'tanggal',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ]

    // relasi ke siswa
    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    // relasi ke guru
    public function guru() {
        return $this->belongsTo(Guru::class);
    }

    // relasi ke kelas
    public function kelas() {
        return $this->belonsTo(Kelas::class);
    }
}
