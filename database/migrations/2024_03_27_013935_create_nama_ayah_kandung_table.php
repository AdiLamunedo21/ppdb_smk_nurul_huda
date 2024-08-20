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
        Schema::create('nama_ayah_kandung', function (Blueprint $table) {
            $table->id('ayah_id');
            $table->foreignId('peserta_id')->references('peserta_id')->on('peserta');
            $table->enum('punya_ayah', ['belum_ibu', 'tidak_ayah', 'iya_ayah',])->nullable();
            $table->string('nama_lengka_ayah')->nullable();
            $table->date('tahun_lahir_ayah')->nullable();
            $table->enum('pendidikan_terakhir_ayah', ['sd', 'sltp', 'slta', 'diploma', 's1', 's2', 's3', 'lainnya'])->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->enum('penghasilan_perbulan_ayah', ['< 1.500.000', '< 2.500.000', '> 3.500.000',])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nama_ayah_kandung');
    }
};
