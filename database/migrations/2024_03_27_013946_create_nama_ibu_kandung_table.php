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
        Schema::create('nama_ibu_kandung', function (Blueprint $table) {
            $table->id('ibu_id');
            $table->foreignId('peserta_id')->references('peserta_id')->on('peserta');
            $table->enum('punya_ibu', ['belum_ibu','tidak_ibu', 'iya_ibu',])->nullable();
            $table->string('nama_lengkap_ibu')->nullable();
            $table->date('tahun_lahir_ibu')->nullable();
            $table->enum('pendidikan_terakhir_ibu', ['sd', 'sltp', 'slta', 'diploma', 's1', 's2', 's3', 'lainnya'])->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->enum('penghasilan_perbulan_ibu', ['< 1.500.000', '< 2.500.000', '> 3.500.000',])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nama_ibu_kandung');
    }
};
