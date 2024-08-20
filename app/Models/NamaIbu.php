<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaIbu extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'nama_ibu_kandung';
    protected $primaryKey = 'ibu_id';

    protected $fillable = [
        'peserta_id', 'punya_ibu', 'nama_lengkap_ibu', 'tahun_lahir_ibu', 'pendidikan_terakhir_ibu',
        'pekerjaan_ibu', 'penghasilan_perbulan_ibu',
    ];

        public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }

}
