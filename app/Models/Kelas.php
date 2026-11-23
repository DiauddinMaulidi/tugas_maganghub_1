<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\User;
use App\Models\Absensi;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'tahun_ajaran',
        'guru_id',
        'user_id',
    ];

    // Relasi ke table gurus
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi ke table siswas
    public function siswas() {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function waliKelas() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function guruPengabsen()
    {
        return $this->belongsToMany(
            User::class,
            'guru_kelas',
            'kelas_id',
            'user_id'
        );
    }

    public function absensis() {
        return $this->hasMany(Absensi::class);
    }
}
