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
        Schema::create('ijazah', function (Blueprint $table) {
            $table->id('ijazah_id');
            $table->foreignId('peserta_id')->references('peserta_id')->on('peserta');
            $table->string('nama');
            $table->string('ijazah');
            $table->dateTime('tanggal_konfirmasi')->nullable();
            $table->enum('status_konfirmasi', ['proses', 'diterima', 'ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ijazah');
    }
};
