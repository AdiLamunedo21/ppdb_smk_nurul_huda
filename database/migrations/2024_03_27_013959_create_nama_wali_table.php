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
        Schema::create('nama_wali', function (Blueprint $table) {
            $table->id('wali_id');
            $table->foreignId('peserta_id')->references('peserta_id')->on('peserta');
            $table->enum('punya_wali', ['belum_wali','tidak_wali', 'iya_wali',])->nullable();
            $table->string('nama_lengkap_wali')->nullable();
            $table->date('tahun_lahir_wali')->nullable();
            $table->enum('pendidikan_terakhir_wali', ['sd', 'sltp', 'slta', 'diploma', 's1', 's2', 's3', 'lainnya'])->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->enum('penghasilan_perbulan_wali', ['< 1.500.000', '< 2.500.000', '> 3.500.000',])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nama_wali');
    }
};
