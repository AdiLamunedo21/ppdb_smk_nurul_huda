<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaAyah extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'nama_ayah_kandung';
    protected $primaryKey = 'ayah_id';

    protected $fillable = [
        'peserta_id', 'punya_ayah', 'nama_lengkap_ayah', 'tahun_lahir_ayah', 'pendidikan_terakhir_ayah',
        'pekerjaan_ayah', 'penghasilan_perbulan_ayah',
    ];


        public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }

}
