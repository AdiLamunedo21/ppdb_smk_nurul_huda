<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peserta', function (Blueprint $table){
            $table->boolean('batal_sekolah')->nullable();
            $table->boolean('cek_ulang_data')->nullable();
            $table->enum('sudah_lulus', ['belum', 'proses', 'lulus', 'tidak_lulus'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table){
            $table->dropColumn('batal_sekolah');
            $table->dropColumn('cek_ulang_data');
            $table->dropColumn('sudah_lulus');
        });
    }
};
