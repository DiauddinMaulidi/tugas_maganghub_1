<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();

            $table->string('nama_kelas');
            $table->string('tingkat');
            $table->string('tahun_ajaran');

            $table->foreignId('guru_id')
                ->nullable()
                ->constrained('gurus')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['nama_kelas', 'tahun_ajaran']
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
