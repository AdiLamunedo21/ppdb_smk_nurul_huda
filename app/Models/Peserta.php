<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Gelombang;
use App\Models\NamaAyah;
use App\Models\NamaIbu;
use App\Models\NamaWali;
use App\Models\Jurusan;
use App\Models\Kecamatan;
use App\Models\Prestasi;
use App\Models\BerkasPeserta;
use App\Models\Siswa;
use App\Models\Ijazah;
use App\Models\Sk_lulus;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'peserta';
    protected $primaryKey = 'peserta_id';

    protected $fillable = [
        'gelombang_id','jenis_pendaftaran','jurusan_id','nama_lengkap','no_akte_kelahiran',
        'jenis_kelamin','nisn','nis','asal_sekolah','no_seri_ijazah_smp',
        'no_seri_shun_smp', 'no_ujian_smp','nik','alamat_lengkap','tempat_lahir','email',
        'tanggal_lahir', 'agama', 'kebutuhan_khusus',
        'kewarganegaraan', 'dusun', 'kelurahan', 'kecamatan', 'kabupaten',
        'provinsi', 'kode_pos', 'alat_tranportasi_kesekolah', 'jenis_tinggal',
        'no_hp', 'email', 'penerima_kps_pip', 'nomor_kps_pip', 'tinggi_badan',
        'berat_badan', 'jumlah_saudara', 'jarak_tempat_tinggal_kesekolah',
        'waktu_tempat_berangkat_kesekolah',
        'status_kelulusan_berkas',
        'pwd', 'sudah_daftar_ulang','progres',
        'cek_ulang_data','sudah_lulus',
    ];

    protected $appends = ['no_wa','path_ijazah'];

    public function gelombang()
{
    return $this->belongsTo(Gelombang::class, 'gelombang_id', 'gelombang_id');
}

    public function namaAyah()
    {
        return $this->hasMany(NamaAyah::class, 'peserta_id', 'peserta_id');
    }
    public function namaIbu()
    {
        return $this->hasMany(NamaIbu::class, 'peserta_id', 'peserta_id');
    }
    public function namaWali()
    {
        return $this->hasMany(NamaWali::class, 'peserta_id', 'peserta_id');
    }

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    public function kecamatandata()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan', 'kecamatan_id');
    }

    public function catatan_prestasi()
    {
        return $this->hasMany(Prestasi::class, 'peserta_id', 'peserta_id');
    }

    public function berkaspeserta()
    {
        return $this->hasMany(BerkasPeserta::class, 'peserta_id', 'peserta_id');
    }

    public function ijazahpeserta()
    {
        return $this->hasMany(Ijazah::class, 'peserta_id', 'peserta_id');
    }

    public function sklulus()
    {
        return $this->hasMany(Sk_lulus::class, 'peserta_id', 'peserta_id');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'peserta_id', 'peserta_id');
    }


    public function getNoWaAttribute()
    {
        $no_wa = null;
        if (isset($this->attributes['no_hp'])){
            $no_hp = $this->attributes['no_hp'];
            $length = (int) strlen($no_hp);
            $no_wa = "628".substr($no_hp, 2, $length);
        }

        return $no_wa;
    }

    public function getPathIjazahAttribute()
    {
        $path_ijazah = isset($this->attributes['ijazah'])
            ? asset('/storage/ijazah/'.$this->attributes['ijazah'])
            : "" ;
        return $path_ijazah;
    }
}
