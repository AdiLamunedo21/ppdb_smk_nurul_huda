<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaWali extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'nama_wali';
    protected $primaryKey = 'wali_id';

    protected $fillable = [
        'peserta_id', 'punya_wali', 'nama_lengkap_wali', 'tahun_lahir_wali', 'pendidikan_terakhir_wali',
        'pekerjaan_wali', 'penghasilan_perbulan_wali',
    ];

        public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }

}
