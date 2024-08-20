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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('peserta_id');
            $table->foreignId('gelombang_id')->references('gelombang_id')->on('gelombang');
            $table->enum('jenis_pendaftaran', ['tes', 'prestasi']);
            $table->foreignId('jurusan_id')->references('jurusan_id')->on('jurusan');
            $table->integer('no_pendaftaran')->nullable();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('nisn');
            $table->string('nis');
            $table->string('no_akte_kelahiran')->nullable();
            $table->string('asal_sekolah');
            $table->string('no_seri_ijazah_smp')->nullable();
            $table->string('no_seri_shun_smp')->nullable();
            $table->string('no_ujian_smp')->nullable();
            $table->string('nik')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'budha']);
            $table->string('kebutuhan_khusus')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('dusun')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->char('kode_pos', 6)->nullable();
            $table->string('alat_tranportasi_kesekolah')->nullable();
            $table->string('jenis_tinggal')->nullable();
            $table->string('no_hp', 14);
            $table->string('no_hp_ortu', 14)->nullable();
            $table->string('email')->unique()->nullable();
            $table->enum('penerima_kps_pip', ['ya', 'tidak'])->nullable();
            $table->string('nomor_kps_pip')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->string('jarak_tempat_tinggal_kesekolah')->nullable();
            $table->string('waktu_tempat_berangkat_kesekolah')->nullable();
            $table->boolean('sudah_lengkap')->default(0);
            $table->string('foto')->nullable();
            $table->enum('status_kelulusan_berkas', ['belum','lulus', 'tidak lulus'])->nullable();
            $table->boolean('sudah_cek_berkas')->default(0);
            $table->boolean('sudah_tes')->default(0);
            $table->string('sumber_informasi')->nullable();
            $table->string('pwd')->nullable();
            $table->timestamps();
            $table->enum('progres', ['sudah_buat_akun', 'biodata_lengkap', 'berkas_lengkap', 'sudah_daftar']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
