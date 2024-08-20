<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    use HasFactory;

    protected $table = 'ijazah';
    protected $primaryKey = 'ijazah_id';

    protected $fillable = ['nama', 'ijazah', 'tanggal_konfirmasi', 'status_konfirmasi', 'peserta_id'];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }

    protected $appends = ['path_ijazah'];

    public function getPathIjazahAttribute()
    {
        $path_ijazah = isset($this->attributes['ijazah'])
            ? asset('/storage/ijazah/'.$this->attributes['ijazah'])
            : "" ;
        return $path_ijazah;
    }
}
