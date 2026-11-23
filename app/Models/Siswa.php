<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Absensi;
class Siswa extends Model
{
    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'kelas',
        'kelas_id',
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function absensis() {
        return $this->hasMany(Absensi::class);
    }
}
