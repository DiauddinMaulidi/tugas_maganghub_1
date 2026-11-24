<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->string('slug');
            $table->string('route')->nullable();
            $table->string('is_active')->default(true);

            $table->timestamps();

            $table->unique(['nama_menu', 'route']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
