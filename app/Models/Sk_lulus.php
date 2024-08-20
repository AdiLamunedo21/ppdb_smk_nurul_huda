<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk_lulus extends Model
{
    use HasFactory;

    protected $table = 'sk_lulus';
    protected $primaryKey = 'sk_lulus_id';

    protected $fillable = ['nama', 'sk_lulus', 'tanggal_konfirmasi', 'status_konfirmasi', 'peserta_id'];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }

    protected $appends = ['path_sk_lulus'];

    public function getPathSkLulusAttribute()
    {
        $path_sk_lulus = isset($this->attributes['sk_lulus'])
            ? asset('/storage/sklulus/'.$this->attributes['sk_lulus'])
            : "" ;
        return $path_sk_lulus;
    }
}

