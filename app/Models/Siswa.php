<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'siswa_id';

    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'peserta_id', 'peserta_id');
    }

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    public function namaAyah()
    {
        return $this->hasOne(NamaAyah::class, 'peserta_id', 'peserta_id');
    }

    public function namaIbu()
    {
        return $this->hasOne(NamaIbu::class, 'peserta_id', 'peserta_id');
    }

    public function namaWali()
    {
        return $this->hasOne(NamaWali::class, 'peserta_id', 'peserta_id');
    }
}
