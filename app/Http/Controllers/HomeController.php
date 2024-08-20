<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use App\Models\Peserta;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Biaya;


class HomeController extends Controller
{

        public function index()
    {
        $jurusans = Jurusan::all();
        $tahun_periode_aktif  = " - ";
        $gelombang = Gelombang::where('aktif', true)->first();
        if ($gelombang) {
            $gelombang->tanggal_pendaftaran = Carbon::parse($gelombang->mulai)->isoFormat('D MMMM')." - ".Carbon::parse($gelombang->selesai)->isoFormat('D MMMM Y');
        }


        return view('pages.frontsite.landing-page.index', [
            'jurusans' => $jurusans,
            'gelombang' => $gelombang,
            'tahun_periode_aktif' => $tahun_periode_aktif,
        ]);
    }
        public function infoAkutansi()
    {
        return view('pages.frontsite.landing-page.info-akutansi');
    }
        public function infoPerkantoran()
    {
        return view('pages.frontsite.landing-page.info-perkantoran');
    }
        public function infoMultimedia()
    {
        return view('pages.frontsite.landing-page.info-multimedia');
    }

    public function daftarSekarang(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,jurusan_id'
        ]);

        $request->session()->put('selected_jurusan', $request->jurusan_id);

        return redirect()->route('isi-formulir');
    }


        public function isiFormulir(Request $request)
    {

        return view('pages.frontsite.formulir-pendaftaran.index');
    }

    public function showConfirmation(Request $request)
{
    $validatedData =  $request->validate([
                'jenis_pendaftaran' => 'required',
                'jurusan_id' => 'required',
                'nama_lengkap' => 'required',
                'nisn' => 'required|unique:peserta',
                'nis' => 'required',
                'asal_sekolah' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required|in:islam,kristen,katolik,hindu,budha,konghucu',
                'no_hp' => ['required', 'regex:/^\d{11,13}$/'],
                'email' => 'required|email|unique:peserta',
                'jenis_kelamin' => 'required',
                'alamat_lengkap' => 'required',
            ], [
                'nisn.unique' => 'NISN Sudah Terdaftar. Silahkan Login.',
                'email.unique' => 'Email Sudah Terdaftar. Silahkan Login.',
                'no_hp.regex' => 'Nomor HP harus terdiri dari 11 sampai 13 digit.',
            ]);

    session()->put('form_data', $validatedData);

    return view('pages.frontsite.konfirmasi-pendaftaran.index', ['data' => $validatedData]);
}


    public function dapatAkun($no_pendaftaran)
    {
        $peserta = Peserta::where('no_pendaftaran', $no_pendaftaran)->first();

        if (! $peserta) return redirect('/');

        $gelombang = Gelombang::where('aktif', true)->first();
        $tahun_periode_aktif = "";
        if ($gelombang) {
            $gelombang->tanggal_pendaftaran = Carbon::parse($gelombang->mulai)->isoFormat('D MMMM Y')." - ".Carbon::parse($gelombang->selesai)->isoFormat('D MMMM Y');
            $tahun_periode_aktif = Carbon::parse($gelombang->mulai)->isoFormat('Y');
        }

        return view('pages.frontsite.dapat-akun.index', [
            'iddaftar' => $peserta->no_pendaftaran,
            'password' => Carbon::parse($peserta->tanggal_lahir)->format('Ymd'),
            'gelombang' => $gelombang,
            'tahun_periode_aktif' => $tahun_periode_aktif
        ]);
    }
}
