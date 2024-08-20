<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPeserta extends Model
{
    use HasFactory;

    protected $table = 'berkas_peserta';
    protected $primaryKey = 'berkas_id';

    protected $fillable = ['nama', 'berkas', 'peserta_id'];

    protected $appends = ['path_berkas'];

    public function getPathBerkasAttribute()
    {
        $path_berkas = isset($this->attributes['berkas'])
            ? asset('/storage/transfer/'.$this->attributes['berkas'])
            : "" ;
        return $path_berkas;
    }
}
