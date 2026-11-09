<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->text('subjudul')->nullable();
            $table->string('gambar');
            $table->string('tombol_teks')->nullable()->default('Selengkapnya');
            $table->string('tombol_url')->nullable()->default('/profil#tentang');
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sliders');
    }
};

