<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\User;
use App\Notifications\UploadBukti;
use App\Notifications\KonfirmasiIjazah;
use App\Notifications\KonfirmasiSkLulus;

use App\Models\Peserta;
use App\Models\Ijazah;
use App\Models\Gelombang;
use App\Models\Sk_lulus;

use DataTables;

class BerkasController extends Controller
{
        public function index()
    {
        $daftar_tahun = Gelombang::select('tahun')->distinct()->get();
        $gelombang = new Gelombang;
        $tahun = request()->get('tahun') ? request()->get('tahun') : $gelombang->currentyear();

        return view('pages.backsite.status-konfirmasi-ijazah.index', [
            'daftar_tahun' => $daftar_tahun,
            'tahun' => $tahun
        ]);
    }

        public function sk_lulus()
    {
        $daftar_tahun = Gelombang::select('tahun')->distinct()->get();
        $gelombang = new Gelombang;
        $tahun = request()->get('tahun') ? request()->get('tahun') : $gelombang->currentyear();

        return view('pages.backsite.status-konfirmasi-sk-lulus.index', [
            'daftar_tahun' => $daftar_tahun,
            'tahun' => $tahun
        ]);
    }

    //Peserta dashboard
        public function cekBerkas()
    {
        $peserta_id = auth()->user()->peserta_id;

        $peserta = Peserta::with('jurusan')->find($peserta_id);
        $ijazah = Ijazah::where('peserta_id', $peserta_id)->first();
        $sk_lulus = Sk_lulus::where('peserta_id', $peserta_id)->first();
        return view('pages.backsite-peserta.upload-berkas.index', [
            'peserta' => $peserta,
            'ijazah' => $ijazah,
            'sk_lulus' => $sk_lulus,
        ]);
    }

        public function uploadBerkas()
    {
        $peserta_id = auth()->user()->peserta_id;

        $peserta = Peserta::with('jurusan')->find($peserta_id);
        return view('pages.backsite-peserta.upload-berkas.upload', [
            'peserta' => $peserta,
        ]);
    }

        // upluad ijazah
        public function uploadIjazah(Request $request)
    {
        $peserta_id = auth()->user()->peserta_id;
        $peserta = Peserta::find($peserta_id);

        $request->validate([
            'foto-ijazah' => [
                'required',
                'max:5048',
                'mimes:jpg,png'
            ],
        ], [
            'required' => 'Maaf file upload harus di isi dengan maksimal data 5 MB',
            'max' => 'Maaf file upload harus di isi dengan maksimal data 5 MB',
            'mimes' => 'Maaf ekstensi File yang di upload harus png dan jpg',
        ]);

        if ($request->hasFile('foto-ijazah')) {
            $ijazah = $request->file('foto-ijazah');
            $filename = strtolower(str_replace(' ', '', $peserta->nama_lengkap)) . "-" . $peserta->nisn . "_ijazah";
            $filetype = $ijazah->getClientOriginalExtension();
            $pathfile = 'public/ijazah';
            $ijazahUpload = $filename . "." . $filetype;
            $nama = $ijazah->storeAs($pathfile, $ijazahUpload);

            $existingIjazah = Ijazah::where('peserta_id', $peserta_id)->first();

            if ($existingIjazah) {
                $existingIjazah->ijazah = $ijazahUpload;
                $existingIjazah->nama = $nama;
                $existingIjazah->status_konfirmasi = 'proses';
                $simpan = $existingIjazah->save();
            } else {
                $newIjazah = new Ijazah();
                $newIjazah->ijazah = $ijazahUpload;
                $newIjazah->nama = $nama;
                $newIjazah->status_konfirmasi = 'proses';
                $newIjazah->peserta_id = $peserta_id;
                $simpan = $newIjazah->save();
            }

            if ($simpan) {
                $user = User::find(1);
                if ($user) {
                    $user->notify(new UploadBukti($user, $peserta->nama_lengkap));
                }
                return response()->json(['success' => 'Upload berhasil']);
            } else {
                return response()->json(['error' => 'Gagal upload'], 500);
            }
        } else {
            return response()->json(['error' => 'File tidak ditemukan'], 400);
        }
    }

        public function konfirmasiIjazahStatus(Request $request)
    {
        $ijazah_id = $request->ijazah_id;

        $ijazah = Ijazah::find($ijazah_id);

        if (!$ijazah) {
            return redirect()->back()->with(['error' => 'Data tidak ditemukan']);
        }

        $ijazah->status_konfirmasi = $request->status_konfirmasi;
        $ijazah->tanggal_konfirmasi = Carbon::now();

        $update = $ijazah->save();

        if ($update)
        {
            $peserta = Peserta::find($ijazah->peserta_id);

            if ($ijazah->status_konfirmasi == 'diterima') {
                $user = User::where('peserta_id', $ijazah->peserta_id)->first();

                if ($user) {
                    $user->notify(new KonfirmasiIjazah($ijazah->status_konfirmasi));
                }

                // Periksa status konfirmasi di tabel sk_lulus
                $skLulusDiterima = Sk_lulus::where('peserta_id', $ijazah->peserta_id)
                                        ->where('status_konfirmasi', 'diterima')
                                        ->exists();

                if ($skLulusDiterima && $peserta) {
                    // Update progres di tabel peserta
                    $peserta->progres = 'berkas_lengkap';
                    $peserta->sudah_cek_berkas = true;
                    $peserta->status_kelulusan_berkas = 'lulus';
                    $peserta->save();
                }
            }
            elseif ($ijazah->status_konfirmasi == 'ditolak') {
                // Update progres di tabel peserta menjadi 'biodata_lengkap'
                if ($peserta) {
                    $peserta->progres = 'biodata_lengkap';
                    $peserta->sudah_cek_berkas = false;
                    $peserta->status_kelulusan_berkas = 'tidak lulus';
                    $peserta->save();
                }
            }

            return redirect()->back()->with(['success' => 'Status ijazah berhasil diubah']);
        }
        else
        {
            return redirect()->back()->with(['error' => 'Gagal ubah status']);
        }
    }


        public function jsonIjazahKonfirmasi()
    {
        $tahun = request()->get('tahun');

        $ijazah = Ijazah::with('peserta:peserta_id,no_pendaftaran,nama_lengkap,created_at,no_hp')
            ->orderBy('ijazah.status_konfirmasi', 'DESC');

        if ($tahun) {
            $ijazah->whereYear('created_at', $tahun);
        } else {
            $tahun = Gelombang::currentyear();
            $ijazah->whereYear('created_at', $tahun);
        }

        return Datatables::of($ijazah->get())->make(true);
    }
        // upluad SK-Lulus
        public function uploadSkLulus(Request $request)
    {
        $peserta_id = auth()->user()->peserta_id;
        $peserta = Peserta::find($peserta_id);

        $request->validate([
            'foto-sk-lulus' => [
                'required',
                'max:5048',
                'mimes:jpg,png'
            ],
        ], [
            'required' => 'Maaf file upload harus di isi dengan maksimal data 5 MB',
            'max' => 'Maaf file upload harus di isi dengan maksimal data 5 MB',
            'mimes' => 'Maaf ekstensi file yang di upload harus png dan jpg',
        ]);

        if ($request->hasFile('foto-sk-lulus')) {
            $sk_lulus = $request->file('foto-sk-lulus');
            $filename = strtolower(str_replace(' ', '', $peserta->nama_lengkap)) . "-" . $peserta->nisn . "_sk-lulus";
            $filetype = $sk_lulus->getClientOriginalExtension();
            $pathfile = 'public/sklulus';
            $skLulusUpload = $filename . "." . $filetype;
            $nama = $sk_lulus->storeAs($pathfile, $skLulusUpload);

            // Cek apakah data SK Lulus sudah ada
            $existingSkLulus = Sk_lulus::where('peserta_id', $peserta_id)->first();

            if ($existingSkLulus) {
                // Update data dengan file baru
                $existingSkLulus->sk_lulus = $skLulusUpload;
                $existingSkLulus->nama = $nama;
                $existingSkLulus->status_konfirmasi = 'proses';
                $simpan = $existingSkLulus->save();
            } else {
                // Simpan informasi file baru ke database
                $sk_lulus = new Sk_lulus();
                $sk_lulus->sk_lulus = $skLulusUpload;
                $sk_lulus->nama = $nama;
                $sk_lulus->status_konfirmasi = 'proses';
                $sk_lulus->peserta_id = $peserta_id;
                $simpan = $sk_lulus->save();
            }

            if ($simpan) {
                // Kirim notifikasi ke admin
                $user = User::find(1);
                if ($user) {
                    $user->notify(new UploadBukti($user, $peserta->nama_lengkap));
                }
                return response()->json(['success' => 'Upload berhasil']);
            } else {
                return response()->json(['error' => 'Gagal upload'], 500);
            }
        } else {
            return response()->json(['error' => 'File tidak ditemukan'], 400);
        }
    }

        public function konfirmasiLulusStatus(Request $request)
    {
        $sk_lulus_id = $request->sk_lulus_id;

        $sk_lulus = Sk_lulus::find($sk_lulus_id);

        if (!$sk_lulus) {
            return redirect()->back()->with(['error' => 'Data tidak ditemukan']);
        }

        $sk_lulus->status_konfirmasi = $request->status_konfirmasi;
        $sk_lulus->tanggal_konfirmasi = Carbon::now();

        $update = $sk_lulus->save();

        if ($update)
        {
            $peserta = Peserta::find($sk_lulus->peserta_id);

            if ($sk_lulus->status_konfirmasi == 'diterima') {
                $user = User::where('peserta_id', $sk_lulus->peserta_id)->first();

                if ($user) {
                    $user->notify(new KonfirmasiSkLulus($sk_lulus->status_konfirmasi));
                }

                // Periksa status konfirmasi di tabel ijazah
                $ijazahDiterima = Ijazah::where('peserta_id', $sk_lulus->peserta_id)
                                        ->where('status_konfirmasi', 'diterima')
                                        ->exists();

                if ($ijazahDiterima && $peserta) {
                    // Update progres di tabel peserta
                    $peserta->progres = 'berkas_lengkap';
                    $peserta->sudah_cek_berkas = true;
                    $peserta->status_kelulusan_berkas = 'lulus';
                    $peserta->save();
                }
            }
            elseif ($sk_lulus->status_konfirmasi == 'ditolak') {
                // Update progres di tabel peserta menjadi 'biodata_lengkap'
                if ($peserta) {
                    $peserta->progres = 'biodata_lengkap';
                    $peserta->sudah_cek_berkas = false;
                    $peserta->status_kelulusan_berkas = 'tidak lulus';
                    $peserta->save();
                }
            }

            return redirect()->back()->with(['success' => 'Status Sk lulus berhasil diubah']);
        }
        else
        {
            return redirect()->back()->with(['error' => 'Gagal ubah status']);
        }
    }

        public function jsonLulusKonfirmasi()
    {
        $tahun = request()->get('tahun');

        $sk_lulus = Sk_lulus::with('peserta:peserta_id,no_pendaftaran,nama_lengkap,created_at,no_hp')
            ->orderBy('sk_lulus.status_konfirmasi', 'DESC');

        if ($tahun) {
            $sk_lulus->whereYear('created_at', $tahun);
        } else {
            $tahun = Gelombang::currentyear();
            $sk_lulus->whereYear('created_at', $tahun);
        }

        return Datatables::of($sk_lulus->get())->make(true);
    }

        public function konfirmasiBerkas() {

        }
}



