<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peserta;
use App\Models\Prestasi;
use App\Models\NamaAyah;
use App\Models\NamaIbu;
use App\Models\NamaWali;
use Carbon\Carbon;
use App\Models\Jurusan;
use App\Models\Siswa;
use PDF;

class PesertaDaftarUlangController extends Controller
{
    public function index()
    {
        $peserta_id = auth()->user()->peserta_id;

        $peserta = Peserta::with('jurusan')->find($peserta_id);
        if ($peserta->progres == 'biodata_lengkap'|| $peserta->progres == 'sudah_buat_akun' ) return redirect('dashboard')->with(['error' => 'Anda belum mengupload Berkas. Silahkan melakukan Upload Berkas terlebih dahulu.']);

        $jurusan = Jurusan::get();
        $siswa = Siswa::where('peserta_id', $peserta->peserta_id)->first();

        return view('pages.backsite-peserta.daftar-ulang-peserta.index', [
            'peserta' => $peserta,
            'jurusan' => $jurusan,
        ]);
    }

    public function simpan(Request $request)
    {
        $validation = $request->validate([
            'sudah_lulus' => 'required',
            'nisn' => 'required',
            'nama_lengkap' => 'required',
        ]);

        $peserta_id = auth()->user()->peserta_id;
        $peserta = Peserta::find($peserta_id);
        $peserta->fill($request->all());
        $peserta->cek_ulang_data = true;
        $peserta->progres = 'sudah_daftar';

        $simpan = $peserta->save();

        if ($simpan) {
            $this->generateSiswa($peserta);
            return redirect()->back()->with(['success' => 'Data berhasil disimpan']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal menyimpan data']);
        }
    }

    public function cetakFormulirDaftar()
    {
        $peserta_id = auth()->user()->peserta_id;

        $peserta = Peserta::with('jurusan', 'catatan_prestasi', 'namaAyah', 'namaIbu', 'namaWali')->findOrFail($peserta_id);


        $pdf = PDF::loadView('pages.backsite-peserta.cetak-kartu.index', compact('peserta'))->setPaper('a4', 'portrait');


        return $pdf->stream('formulir-peserta.pdf');
    }

    private function generateSiswa($peserta)
    {
        $ada_siswa = Siswa::where('peserta_id', $peserta->peserta_id)->first();
        if ($ada_siswa) {
            $peserta->cek_ulang_data = true;
            $peserta->save();
            return $ada_siswa->nisn;
        }

        $siswa = new Siswa;
        $siswa->nisn = $peserta->nisn;
        $siswa->peserta_id = $peserta->peserta_id;
        $siswa->jurusan_id = $peserta->jurusan_id;

        $simpan = $siswa->save();

        if ($simpan) {
            return $siswa->nisn;
        } else {
            $peserta->cek_ulang_data = false;
            $peserta->save();
            return redirect()->back()->with(['error' => "Gagal menyimpan data siswa. Silahkan ulangi klik simpan"]);
        }
    }


}
