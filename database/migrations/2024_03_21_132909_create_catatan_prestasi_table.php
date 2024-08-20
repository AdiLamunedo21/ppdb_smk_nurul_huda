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
        Schema::create('catatan_prestasi', function (Blueprint $table) {
            $table->id('prestasi_id');
            $table->foreignId('peserta_id')->references('peserta_id')->on('peserta');
            $table->enum('berprestasi', ['belum','tidak', 'iya'])->nullable();
            $table->string('nama_prestasi')->nullable();
            $table->date('tahun')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->string('tingkat')->nullable();
            $table->string('berkas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_prestasi');
    }
};
