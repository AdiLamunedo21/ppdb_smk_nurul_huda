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
            $table->boolean('sudah_daftar_ulang')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table){
            $table->dropColumn('sudah_daftar_ulang');
        });
    }

};
