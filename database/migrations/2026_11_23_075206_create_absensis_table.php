<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->enum('status', [
                'hadir',
                'izin',
                'sakit',
                'alpa'
            ]);

            $table->timestamps();

            $table->unique(
                ['siswa_id', 'tanggal'],
                'absensis_siswa_tanggal_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
