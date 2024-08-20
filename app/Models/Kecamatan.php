<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $primaryKey = 'kecamatan_id';
    protected $fillable = [
        'kode', 'kecamatan', 'kabupaten_id'
    ];
}
