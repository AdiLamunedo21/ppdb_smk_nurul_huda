<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\PesertaDaftarUlangController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.backsite.jadwal-tes.index');
// });




Route::get('/', [HomeController::class, 'index']);
Route::get('/info-jurusan-akutansi', [HomeController::class, 'infoAkutansi']);
Route::get('/info-jurusan-perkantoran', [HomeController::class, 'infoPerkantoran']);
Route::get('/info-jurusan-multimedia', [HomeController::class, 'infoMultimedia']);
Route::post('/daftar-sekarang', [HomeController::class, 'daftarSekarang']);
Route::get('/isi-formulir', [HomeController::class, 'isiFormulir'])->name('isi-formulir');
Route::post('/konfirmasi', [HomeController::class, 'showConfirmation'])->name('konfirmasi');
Route::post('/daftar', [PesertaController::class, 'store']);
Route::get('/dapat-akun/{no_pendaftaran}', [HomeController::class, 'dapatAkun'])->name('dapat-akun');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth', [LoginController::class, 'auth']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/lupa-password', [LoginController::class, 'lupaPassword'])->name('lupa-password');
Route::post('/lupa-password', [LoginController::class, 'kirimEmailLupaPassword']);
Route::get('/lupa-password-terkirim', [LoginController::class, 'kirimEmailLupaPasswordTerkirim'])->name('lupa-password-terkirim');
Route::get('/lupa-password/buat', [LoginController::class, 'buatPassword']);
Route::post('/buat-password', [LoginController::class, 'updatePassword']);

Route::get('/cetak-formulir-daftar', [PesertaDaftarUlangController::class, 'cetakFormulirDaftar'])->middleware('role:peserta');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/notifikasi', [NotifikasiController::class, 'json']);
    Route::get('/notifikasi/sudah-dibaca', [NotifikasiController::class, 'markAsRead']);

    Route::get('/daftar-kecamatan/{kabupaten_id}', [KecamatanController::class, 'json']);

    Route::get('/biodata', [PesertaController::class, 'biodata']);
    Route::get('/biodata/edit', [PesertaController::class, 'editBiodata']);
    Route::post('/biodata/update', [PesertaController::class, 'update']);
    Route::get('/status', [PesertaController::class, 'statusKelulusan']);

    Route::get('/bukti-berkas', [BerkasController::class, 'cekBerkas']);
    Route::get('/bukti-berkas/upload', [BerkasController::class, 'uploadBerkas']);

    Route::post('/berkas/upload-ijazah', [BerkasController::class, 'uploadIjazah'])->name('berkas.upload.ijazah');

    Route::post('/berkas/upload-sk-lulus', [BerkasController::class, 'uploadSkLulus']);

    Route::get('/daftar-ulang-peserta', [PesertaDaftarUlangController::class, 'index'])->middleware('role:peserta|peserta_prestasi|peserta_transfer|admin|superadmin');

    Route::post('/daftar-ulang-peserta', [PesertaDaftarUlangController::class, 'simpan'])->middleware('role:peserta|peserta_prestasi|peserta_transfer|admin|superadmin');

    Route::get('/kontak', [PesertaController::class, 'kontak'])->middleware('role:peserta|peserta_prestasi|peserta_transfer|admin|superadmin');;

    //admin
    Route::get('/peserta', [PesertaController::class, 'index'])->middleware('role:superadmin|admin');
    Route::post('/peserta/hapus', [PesertaController::class, 'hapus'])->middleware('role:superadmin|admin');
    Route::get('/peserta/json', [PesertaController::class, 'jsonPeserta'])->middleware('role:superadmin|admin');
    Route::get('/peserta/edit/{id}', [PesertaController::class, 'edit'])->middleware('role:superadmin|admin');
    Route::post('/peserta/update/{id}', [PesertaController::class, 'update'])->middleware('role:superadmin|admin');
    Route::post('/set-status-kelulusan', [PesertaController::class, 'setStatusKelulusan'])->middleware('role:superadmin|admin');
    Route::get('/peserta-sudah-daftar-ulang', [PesertaController::class, 'sudahDaftarUlang'])->middleware('role:superadmin|admin|keuangan');
    Route::get('/peserta-sudah-daftar-ulang/json', [PesertaController::class, 'sudahDaftarUlangJson'])->middleware('role:superadmin|admin|keuangan');
    Route::post('/status-konfirm-daftar-ulang', [PesertaController::class, 'updateStatusLulus'])->middleware('role:superadmin|admin|keuangan');

    Route::get('/peserta-lulus', [PesertaController::class, 'pesertaLulus'])->middleware('role:superadmin|admin|keuangan');
    Route::get('/peserta-lulus/json', [PesertaController::class, 'pesertaLulusJson'])->middleware('role:superadmin|admin|keuangan');

    Route::get('/peserta-batal-sekolah', [PesertaController::class, 'batalSekolah'])->middleware('role:superadmin|admin');
    Route::get('/peserta-batal-sekolah/json', [PesertaController::class, 'batalSekolahJson'])->middleware('role:superadmin|admin');

    Route::get('/peserta-referal', [PesertaController::class, 'pesertaReferal'])->middleware('role:superadmin|admin|keuangan');
    Route::get('/peserta-referal/json', [PesertaController::class, 'pesertaReferalJson'])->middleware('role:superadmin|admin|keuangan');

    // Ijazah
    Route::get('/status-ijazah', [BerkasController::class, 'index'])->middleware('role:superadmin|admin');
    Route::get('/status-ijazah/json', [BerkasController::class, 'jsonIjazahKonfirmasi'])->middleware('role:superadmin|admin');
    Route::post('/status-konfirm-ijazah', [BerkasController::class, 'konfirmasiIjazahStatus'])->middleware('role:superadmin|admin');

    // Surat Keterangan Lulus
    Route::get('/status-sk-lulus', [BerkasController::class, 'sk_lulus'])->middleware('role:superadmin|admin');
    Route::get('/status-sk-lulus/json', [BerkasController::class, 'jsonLulusKonfirmasi'])->middleware('role:superadmin|admin');
    Route::post('/status-konfirm-sk-lulus', [BerkasController::class, 'konfirmasiLulusStatus'])->middleware('role:superadmin|admin');

    // Excel
    Route::get('/excel/peserta-lulus', [PesertaController::class, 'excelPesertaLulus'])->middleware('role:superadmin|admin');
    Route::get('/excel/peserta-lulus-daftar-ulang', [PesertaController::class, 'excelPesertaLulusDaftar'])->middleware('role:superadmin|admin');
    Route::get('/excel/peserta', [PesertaController::class, 'excelPeserta'])->middleware('role:superadmin|admin');

    Route::get('/excel/peserta-per-bulan/{bulan}', [DashboardController::class, 'downloadPesertaPerBulan'])->middleware('role:superadmin|admin');

    // Resmi siswa
    Route::post('/generate-nis', [SiswaController::class, 'generateNis'])->middleware('role:superadmin|admin|keuangan');
    Route::get('/siswa', [SiswaController::class, 'index'])->middleware('role:superadmin|admin');
    Route::get('/siswa/json', [SiswaController::class, 'jsonSiswa'])->middleware('role:superadmin|admin');
    Route::get('/excel/siswa', [SiswaController::class, 'excelSiswa'])->middleware('role:superadmin|admin');

});
