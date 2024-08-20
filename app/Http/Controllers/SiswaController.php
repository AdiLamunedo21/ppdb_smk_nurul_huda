<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

use App\Models\Siswa;
use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\Gelombang;

use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function generateNis(Request $request)
    {
        $peserta_id = $request->peserta_id;

        $peserta = Peserta::with('jurusan')->find($peserta_id);
        if (! $peserta) {
            return redirect()->back()->with(['error' => "Data peserta tidak ditemukan"]);
        }

        $ada_siswa = Siswa::where('peserta_id', $peserta->peserta_id)->first();
        if ($ada_siswa) {
            return redirect()->back()->with(['error' => "Sudah menjadi siswa"]);
        }

        $tahun_sekarang = Carbon::now()->year;
        $jml_siswa_jurusan = Siswa::where('jurusan_id', $peserta->jurusan_id)->whereYear('created_at', $tahun_sekarang)->count()+1;

        $tahun_masuk = Carbon::now()->format('y');
        $kode_jurusan = $peserta->jurusan->kode;
        $no_urut = "000";

        $panjang = strlen((string) $jml_siswa_jurusan);

        if ($jml_siswa_jurusan == 0) {
            $no_urut = "001";
        }else {
            if ($panjang == 1) {
                $no_urut = "00".$jml_siswa_jurusan;
            } else if ($panjang == 2) {
                $no_urut = "0".$jml_siswa_jurusan;
            } else {
                $no_urut = $jml_siswa_jurusan;
            }
        }

        if ($peserta->jenis_pendaftaran == 'transfer') {
            $nis = $tahun_masuk.$kode_jurusan.$no_urut."P";
        } else {
            $nis = $tahun_masuk.$kode_jurusan.$no_urut;
        }

        $siswa = new Siswa;
        $siswa->nis = $nis;
        $siswa->peserta_id = $peserta->peserta_id;
        $siswa->jurusan_id = $peserta->jurusan_id;

        $simpan = $siswa->save();

        if ($simpan) {
            return redirect()->back()->with(['success' => "Data berhasil disimpan"]);
        } else {
            return redirect()->back()->with(['error' => "Gagal menyimpan data"]);
        }
    }

    public function index()
    {
        $jurusan_id = request()->get('jurusan_id');
        $jurusan = Jurusan::all();

        return view('pages.backsite.daftar-siswa.index', [
            "jurusan" => $jurusan,
            "jurusan_id" => $jurusan_id
        ]);
    }

    public function jsonSiswa()
    {
        $tahun = new Gelombang;
        $tahun = $tahun->currentyear();

        $siswa = Siswa::with('peserta')->with('jurusan')
                ->join('peserta', 'siswa.peserta_id', 'peserta.peserta_id')
                ->where('peserta.sudah_lulus', 'lulus')
                ->whereYear('peserta.created_at', $tahun)
                ->orderBy('siswa.nisn', 'asc');

        if (request()->jurusan_id)
        {
            $jurusan_id = request()->jurusan_id;
            $siswa->whereHas('jurusan', function($query) use($jurusan_id) {
                $query->where('jurusan_id', $jurusan_id);
            });
        }

        return Datatables::of($siswa->get())->make(true);
    }

        public function excelSiswa(Request $request)
    {
        $arg['jurusan_id'] = $request->get('jurusan_id');
        $nama = 'siswa';

        if ($arg['jurusan_id']) {
            $jurusan = Jurusan::find($arg['jurusan_id']);
            $nama = $nama . "_" . $jurusan->nama;
        }

        // Mengambil data siswa dan menambahkan informasi nama lengkap ayah dan ibu
        $siswa = Siswa::with(['namaAyah', 'namaIbu', 'jurusan'])->get();

        // Membuat array baru untuk menampung data yang akan diekspor
        $data = $siswa->map(function ($item) {
            return [
                'nama' => $item->nama,
                'jurusan' => $item->jurusan->nama,
                'nama_lengkap_ayah' => $item->namaAyah->nama_lengkap_ayah,
                'nama_lengkap_ibu' => $item->namaIbu->nama_lengkap_ibu,
                // Tambahkan field lain yang diperlukan
            ];
        });

        $result = Excel::download(new SiswaExport($data->toArray()), $nama . '.xlsx');

        return $result;
    }

}
