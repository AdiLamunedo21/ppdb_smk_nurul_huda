<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Models\Peserta;

class Gelombang extends Model
{
    use HasFactory;

    protected $table = 'gelombang';
    protected $primaryKey = 'gelombang_id';

    protected $fillable = [
        'nama', 'mulai', 'selesai', 'biaya', 'aktif','potongan_angsuran_1'
    ];

    public function currentyear()
    {
        return Carbon::now()->year;
    }

    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'gelombang_id', 'gelombang_id');
    }
}
