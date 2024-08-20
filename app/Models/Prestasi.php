<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'catatan_prestasi';
    protected $primaryKey = 'prestasi_id';

    protected $fillable = [
        'peserta_id', 'apakah_berprestasi', 'nama_prestasi', 'tahun', 'penyelenggara', 'tingkat', 'berkas', 'created_at', 'updated_at'
    ];

    protected $appends = ['path_berkas'];

    public function getPathBerkasAttribute()
    {
        $path_berkas = isset($this->attributes['berkas'])
            ? asset('/storage/prestasi/'.$this->attributes['berkas'])
            : "" ;
        return $path_berkas;
    }
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }
}
