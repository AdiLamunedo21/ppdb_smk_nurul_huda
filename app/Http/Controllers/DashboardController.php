<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\RiwayatPembayaran;
use App\Models\RiwayatPembayaranDetail;
use App\Models\Gelombang;
use App\Models\Pembayaran;
use App\Models\JadwalTes;
use Illuminate\Support\Facades\DB;
use App\Models\Biaya;

class DashboardController extends Controller
{

    public function index() {
        $peserta = null;
        $statistik = [];
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin') ) {
            $gelombang = new Gelombang;
            $tahun = request()->get('tahun') ? request()->get('tahun') : $gelombang->currentyear();

            $total_pendaftar = Peserta::whereYear('created_at', $tahun)->count();
            $jalur_umum = Peserta::where('jenis_pendaftaran', 'tes')->whereYear('created_at', $tahun)->count();
            $jml_peserta_per_gelombang = Gelombang::withCount('peserta')->where('tahun', $tahun)->get();

            $sudah_lengkap_biodata = Peserta::where('sudah_lengkap', true)->whereYear('created_at', $tahun)->count();

            $total_lulus = Peserta::whereYear('created_at', $tahun)->where('sudah_lulus', 'lulus')->count();

            $peserta_melengkapi_berkas = Peserta::whereYear('created_at', $tahun)->where('status_kelulusan_berkas', 'lulus')->count();

            // Daftar Ulang
            $sudah_daftar_ulang = Peserta::whereYear('created_at', $tahun)->where('sudah_daftar_ulang', true)->count();
            $belum_daftar_ulang = Peserta::whereYear('created_at', $tahun)->where('sudah_daftar_ulang', false)->where('sudah_lulus', 'lulus')->count();
            // peserta by Jurusan
            $peserta_per_jurusan = Peserta::select(DB::raw('count(peserta_id) as jml'), 'jurusan_id')->with('jurusan:jurusan_id,nama')->whereYear('created_at', $tahun)->groupBy('jurusan_id')->get();
            // Jurusan
            $jurusan = Jurusan::select('jurusan_id', 'nama')->get();
            $per_jurusan = [];
            if (!empty($jurusan))
            {
                foreach($jurusan as $key => $val) {
                    $per_jurusan[$key]['nama_jurusan'] = $val->nama;
                    $per_jurusan[$key]['jumlah'] = Peserta::whereYear('created_at', $tahun)->where('jurusan_id', $val->jurusan_id)->count();
                    $per_jurusan[$key]['lulus'] = Peserta::whereYear('created_at', $tahun)->where('jurusan_id', $val->jurusan_id)->where('sudah_lulus', 'lulus')->count();
                    $per_jurusan[$key]['tidak_lulus'] = Peserta::whereYear('created_at', $tahun)->where('jurusan_id', $val->jurusan_id)->where('sudah_lulus', 'tidak lulus')->count();
                    $per_jurusan[$key]['sudah_daftar_ulang'] = Peserta::whereYear('created_at', $tahun)->where('jurusan_id', $val->jurusan_id)->where('sudah_daftar_ulang', true)->count();
                }
            }

            // peserta sudah test per bulan
            $nama_bulan = ["01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];
            $peserta_per_bulan = DB::table('peserta')
                ->selectRaw('count(*) as jumlah, DATE_FORMAT(created_at, "%m") as month')
                ->whereYear('created_at', $tahun)
                //->where('sudah_tes', true)
                ->where('sudah_lulus', 'lulus')
                ->groupBy('month')
                ->get();

            $statistik = [
                'total_pendaftar' => $total_pendaftar,
                'jalur_umum' => $jalur_umum,
                // 'jalur_prestasi' => $jalur_prestasi,
                'peserta_per_gelombang' => $jml_peserta_per_gelombang,

                'sudah_lengkap_biodata' => $sudah_lengkap_biodata,
                'status_kelulusan_berkas'=>$peserta_melengkapi_berkas,
                'total_lulus' => $total_lulus,
                'peserta_per_jurusan' => $per_jurusan,
                'peserta_per_bulan' => $peserta_per_bulan,
                'month' => $nama_bulan,

                'sudah_daftar_ulang' => $sudah_daftar_ulang,
                'belum_daftar_ulang' => $belum_daftar_ulang,
            ];

            return view('pages.backsite.dashboard.index', [
                'statistik' => (object) $statistik,
                'peserta' => $peserta
            ]);
        }
        else if (auth()->user()->hasRole('siswa')) {
            $jurusan = Jurusan::all();
            return view('pages.backsite.dashboard.index', ['jurusan' => $jurusan]);
        } else {
            $peserta_id = auth()->user()->peserta_id;
            $peserta = Peserta::with('jurusan')->find(auth()->user()->peserta_id);

            $gelombang = Gelombang::where('aktif', true)->first();

            return view('pages.backsite.dashboard.index', [
                'statistik' => (object) $statistik,
                'peserta' => $peserta,
                'gelombang' => $gelombang,

            ]);
        }
    }

}
