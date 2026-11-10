<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran_ppdb', function (Blueprint $table) {
            $table->string('kartu_keluarga')->nullable()->after('keterangan_tambahan');
            $table->string('akta_kelahiran')->nullable()->after('kartu_keluarga');
            $table->string('ijazah_skl')->nullable()->after('akta_kelahiran');
            $table->string('pas_foto')->nullable()->after('ijazah_skl');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran_ppdb', function (Blueprint $table) {
            $table->dropColumn(['kartu_keluarga', 'akta_kelahiran', 'ijazah_skl', 'pas_foto']);
        });
    }
};
