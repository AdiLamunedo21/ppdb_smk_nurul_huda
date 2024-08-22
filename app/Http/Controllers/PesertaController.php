<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
use DataTables;

use App\Models\Peserta;
use App\Models\Prestasi;
use App\Models\NamaAyah;
use App\Models\NamaIbu;
use App\Models\NamaWali;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Ijazah;
use App\Models\Sk_lulus;


use App\Models\Jurusan;

use App\Models\Gelombang;

use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

use App\Notifications\DaftarBerhasil;

use App\Exports\PesertaLulusExport;
use App\Exports\PesertaLulusDaftarExport;
use App\Exports\PesertaAdmExport;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{
    public function kontak()
    {
        $peserta_id = auth()->user()->peserta_id;
        $peserta = Peserta::all()->find($peserta_id);
        return view('pages.backsite-peserta.kontak.index', compact('peserta'));
    }

        public function index()
    {
        $peserta = null;
        $peserta = Peserta::all();
        $asal_sekolah = Peserta::select('asal_sekolah')->distinct()->get();
        $daftar_tahun = Gelombang::select('tahun')->distinct()->get();
        $nama_sekolah = request()->get('asal_sekolah');
        $gelombang = new Gelombang;
        $tahun = request()->get('tahun') ? request()->get('tahun') : $gelombang->currentyear() ;

        return view('pages.backsite.daftar-peserta.index', [
            'sekolah' => $asal_sekolah,
            'nama_sekolah' => $nama_sekolah,
            'daftar_tahun' => $daftar_tahun,
            'tahun' => $tahun,
            'peserta'=> $peserta
    ]);

    }

        public function jsonPeserta()
    {
        $asal_sekolah = request()->get('asal_sekolah');
        $tahun = request()->get('tahun');

        $data = Peserta::select('peserta_id', 'no_pendaftaran', 'nama_lengkap', 'asal_sekolah', 'gelombang_id','jurusan_id', 'sudah_cek_berkas', 'no_hp', 'progres')
            ->with('jurusan:jurusan_id,nama')
            ->orderBy('peserta_id', 'desc');
        if ( $asal_sekolah ) {
            $data->where('asal_sekolah', 'like', "%{$asal_sekolah}%");
        }

        if ($tahun) {
            $data->whereYear('created_at', $tahun);
        } else {
            $tahun = Gelombang::currentyear();
            $data->whereYear('created_at', $tahun);
        }

        return Datatables::of($data->get())->make(true);
    }

    public function edit($id)
    {
        if(!$id) {
            return redirect('/peserta');
        }

        $peserta = Peserta::with(['jurusan','catatan_prestasi', 'namaAyah', 'namaIbu', 'namaWali'])->find($id);
        $jurusan = Jurusan::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::where('kabupaten_id', $peserta->kabupaten ?? null)->get();

        if (!$peserta) {
            return redirect('/peserta')->with('error', 'Peserta tidak ditemukan.');
        }

        $peserta->tanggal_lahir = Carbon::parse($peserta->tanggal_lahir)->format('Y-m-d');
        if ($peserta->catatan_prestasi->isEmpty()) {
            $peserta->catatan_prestasi = collect([new Prestasi([
                'peserta_id' => $id,
                'apakah_berprestasi' => 'belum',
                'nama_prestasi' => null,
                'tahun' => null,
                'penyelenggara' => null,
                'tingkat' => null,
            ])]);
        }

        $catatanPrestasiExists = $peserta->catatan_prestasi->isNotEmpty() && $peserta->catatan_prestasi->first()->exists;

        if ($peserta->namaAyah->isEmpty()) {
            $peserta->namaAyah = collect([new NamaAyah([
                'peserta_id' => $id,
                'punya_ayah' => 'belum_ayah',
                'nama_lengkap_ayah' => null,
                'tahun_lahir_ayah' => null,
                'pendidikan_terakhir_ayah' => null,
                'pekerjaan_ayah' => null,
                'penghasilan_perbulan_ayah' => null,
            ])]);
        }

        $isAyahLengkap = $peserta->namaAyah->isNotEmpty() && $peserta->namaAyah->first()->exists;

        if ($peserta->namaIbu->isEmpty()) {
            $peserta->namaIbu = collect([new NamaIbu([
                'peserta_id' => $id,
                'punya_ibu' => 'belum_ibu',
                'nama_lengkap_ibu' => null,
                'tahun_lahir_ibu' => null,
                'pendidikan_terakhir_ibu' => null,
                'pekerjaan_ibu' => null,
                'penghasilan_perbulan_ibu' => null,
            ])]);
        }

        $isIbuLengkap = $peserta->namaIbu->isNotEmpty() && $peserta->namaIbu->first()->exists;

        if ($peserta->namaWali->isEmpty()) {
            $peserta->namaWali = collect([new NamaWali([
                'peserta_id' => $id,
                'punya_wali' => 'belum_wali',
                'nama_lengkap_wali' => null,
                'tahun_lahir_wali' => null,
                'pendidikan_terakhir_wali' => null,
                'pekerjaan_wali' => null,
                'penghasilan_perbulan_wali' => null,
            ])]);
        }

        $isWaliLengkap = $peserta->namaWali->isNotEmpty() && $peserta->namaWali->first()->exists;

        return view('pages.backsite.daftar-peserta.edit-peserta', [
            'id' => $id,
            'peserta' => $peserta,
            'prestasi' => $peserta->catatan_prestasi->first(),
            'jurusan' => $jurusan,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'catatanPrestasiExists' => $catatanPrestasiExists,
            'isAyahLengkap' => $isAyahLengkap,
            'isIbuLengkap'=> $isIbuLengkap,
            'isWaliLengkap'=>$isWaliLengkap,
        ]);
    }

    public function biodata()
    {
        $no_pendaftaran = auth()->user()->no_pendaftaran;

        $peserta = Peserta::with(['gelombang','jurusan', 'catatan_prestasi', 'namaAyah', 'namaIbu', 'namaWali', 'kecamatandata'])->where('no_pendaftaran', $no_pendaftaran)->first();

        if (!$peserta) {
            return redirect()->route('login');
        }

        $jurusan = Jurusan::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::where('kabupaten_id', $peserta->kabupaten ?? null)->get();

        $peserta->tanggal_lahir = Carbon::parse($peserta->tanggal_lahir)->format('Y-m-d');

        return view('pages.backsite-peserta.biodata.index', [
            'peserta' => $peserta,
            'jurusan' => $jurusan,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function editBiodata()
    {
        $peserta_id = auth()->user()->peserta_id;

        $peserta = Peserta::with(['catatan_prestasi', 'namaAyah', 'namaIbu', 'namaWali'])->find($peserta_id);

        if (!$peserta) {
            return redirect('/peserta')->with('error', 'Peserta tidak ditemukan.');
        }

        if ($peserta->catatan_prestasi->isEmpty()) {
            $peserta->catatan_prestasi = collect([new Prestasi([
                'peserta_id' => $peserta_id,
                'apakah_berprestasi' => 'belum',
                'nama_prestasi' => null,
                'tahun' => null,
                'penyelenggara' => null,
                'tingkat' => null,
            ])]);
        }

        $catatanPrestasiExists = $peserta->catatan_prestasi->isNotEmpty() && $peserta->catatan_prestasi->first()->exists;

        if ($peserta->namaAyah->isEmpty()) {
            $peserta->namaAyah = collect([new NamaAyah([
                'peserta_id' => $peserta_id,
                'punya_ayah' => 'belum_ayah',
                'nama_lengkap_ayah' => null,
                'tahun_lahir_ayah' => null,
                'pendidikan_terakhir_ayah' => null,
                'pekerjaan_ayah' => null,
                'penghasilan_perbulan_ayah' => null,
            ])]);
        }

            $isAyahLengkap = $peserta->namaAyah->isNotEmpty() && $peserta->namaAyah->first()->exists;

            if ($peserta->namaIbu->isEmpty()) {
                $peserta->namaIbu = collect([new NamaIbu([
                    'peserta_id' => $peserta_id,
                    'punya_ibu' => 'belum_ibu',
                    'nama_lengkap_ibu' => null,
                    'tahun_lahir_ibu' => null,
                    'pendidikan_terakhir_ibu' => null,
                    'pekerjaan_ibu' => null,
                    'penghasilan_perbulan_ibu' => null,
                ])]);
            }

            $isIbuLengkap = $peserta->namaIbu->isNotEmpty() && $peserta->namaIbu->first()->exists;

            if ($peserta->namaWali->isEmpty()) {
                $peserta->namaWali = collect([new NamaWali([
                    'peserta_id' => $peserta_id,
                    'punya_wali' => 'belum_wali',
                    'nama_lengkap_wali' => null,
                    'tahun_lahir_wali' => null,
                    'pendidikan_terakhir_wali' => null,
                    'pekerjaan_wali' => null,
                    'penghasilan_perbulan_wali' => null,
                ])]);
            }

            $isWaliLengkap = $peserta->namaWali->isNotEmpty() && $peserta->namaWali->first()->exists;


            $jurusan = Jurusan::all();
            $kabupaten = Kabupaten::all();
            $kecamatan = [];
            if ($peserta->kabupaten) {
                $kecamatan = Kecamatan::where('kabupaten_id', $peserta->kabupaten)->get();
            }

        return view('pages.backsite-peserta.biodata.edit', [
            'peserta' => $peserta,
            'prestasi' => $peserta->catatan_prestasi->first(),
            'jurusan' => $jurusan,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'catatanPrestasiExists' => $catatanPrestasiExists,
            'isAyahLengkap' => $isAyahLengkap,
            'isIbuLengkap'=> $isIbuLengkap,
            'isWaliLengkap'=>$isWaliLengkap,
        ]);
    }



    public function update(Request $request)
    {
        $peserta_id = auth()->user()->hasRole('admin') ? $request->peserta_id : auth()->user()->peserta_id;
        $section = $request->input('section');
        $rules = [];
        switch ($section) {
            case 'informasi_pendaftaran':
            $rules = [
                'jurusan_id' => 'required',
                'nama_lengkap' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|in:islam,kristen,katolik,hindu,budha,konghucu',
                'alamat_lengkap' => 'required',
                'tempat_lahir' => 'required|string|max:255',
            ];
            $this->validate($request, $rules);
            Peserta::where('peserta_id', $peserta_id)->update($request->only(array_keys($rules)));
        break;

        case 'informasi_pribadi':
            $rules = [
                'nik' => 'required|string|size:16',
                'nisn' => 'required',
                'nis' => 'required|string|max:255',
                'asal_sekolah' => 'required|string|max:255',
                'no_seri_ijazah_smp' => 'required|string|max:255',
                'no_seri_shun_smp' => 'required|string|max:255',
                'no_ujian_smp' => 'required|string|max:255',
                'email' => 'required|email',
                'no_hp' => 'required|string|max:14',
            ];
            $this->validate($request, $rules);
            Peserta::where('peserta_id', $peserta_id)->update($request->only(array_keys($rules)));
        break;

        case 'alamat':
            $rules = [
                'dusun' => 'required|string|max:255',
                'kelurahan' => 'required|string|max:255',
                'kabupaten' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kewarganegaraan' => 'required|string|max:255',
                'provinsi' => 'required|string|max:255',
                'kode_pos' => 'required|string|size:6',
                'jenis_tinggal' => 'required|string|max:255',
                'alat_tranportasi_kesekolah' => 'required|string|max:255',
            ];
            $this->validate($request, $rules);
            Peserta::where('peserta_id', $peserta_id)->update($request->only(array_keys($rules)));
        break;

        case 'data_lainnya':
            $rules = [
                'kebutuhan_khusus' => 'required|string|max:255',
                'penerima_kps_pip' => 'required|in:ya,tidak',
                'nomor_kps_pip' => 'required|string|max:255',
                'tinggi_badan' => 'required|string|max:255',
                'berat_badan' => 'required|string|max:255',
                'jumlah_saudara' => 'required|string|max:255',
                'jarak_tempat_tinggal_kesekolah' => 'required|string|max:255',
                'waktu_tempat_berangkat_kesekolah' => 'required|string|max:255',
            ];
            $this->validate($request, $rules);
            Peserta::where('peserta_id', $peserta_id)->update($request->only(array_keys($rules)));
        break;

        case 'prestasi':
                $rules = [
                    'apakah_berprestasi' => 'required|in:iya,belum,tidak'
                ];
                if ($request->input('apakah_berprestasi') === 'iya') {
                    $rules = array_merge($rules, [
                        'nama_prestasi' => 'required|string|max:255',
                        'tahun' => 'required|date',
                        'penyelenggara' => 'required|string|max:255',
                        'tingkat' => 'required|in:prestasi_kecamatan,prestasi_kabupaten,prestasi_provinsi,prestasi_nasional,prestasi_internasional',
                    ]);
                    Prestasi::updateOrCreate(
                        ['peserta_id' => $peserta_id],
                        $request->only(['apakah_berprestasi', 'nama_prestasi', 'tahun', 'penyelenggara', 'tingkat'])
                    );
                } elseif ($request->input('apakah_berprestasi') === 'belum') {
                    Prestasi::where('peserta_id', $peserta_id)->delete();
                } elseif ($request->input('apakah_berprestasi') === 'tidak') {
                    Prestasi::updateOrCreate(
                        ['peserta_id' => $peserta_id],
                        [
                            'apakah_berprestasi' => 'tidak',
                            'nama_prestasi' => null,
                            'tahun' => null,
                            'penyelenggara' => null,
                            'tingkat' => null,
                            'berkas' => null
                        ]
                    );
                }
        break;

        case 'biodata_ayah':
                $rules = [
                    'punya_ayah' => 'required|in:iya_ayah,belum_ayah,tidak_ayah',
                ];
                if ($request->input('punya_ayah') === 'iya_ayah') {
                    $rules = array_merge($rules, [
                        'nama_lengkap_ayah' => 'required|string|max:255',
                        'tahun_lahir_ayah' => 'required|date',
                        'pendidikan_terakhir_ayah' => 'required|in:sd,sltp,slta,diploma,s1,s2,s3,lainnya',
                        'pekerjaan_ayah' => 'required|string|max:255',
                        'penghasilan_perbulan_ayah' => 'required|in:< 1.500.000,< 2.500.000,> 3.500.000',
                    ]);
                    $ayahData = $request->only([
                        'punya_ayah',
                        'nama_lengkap_ayah',
                        'tahun_lahir_ayah',
                        'pendidikan_terakhir_ayah',
                        'pekerjaan_ayah',
                        'penghasilan_perbulan_ayah'
                    ]);
                    NamaAyah::updateOrCreate(['peserta_id' => $peserta_id], $ayahData);
                } elseif ($request->input('punya_ayah') === 'belum_ayah') {
                    NamaAyah::where('peserta_id', $peserta_id)->delete();

                } elseif ($request->input('punya_ayah') === 'tidak_ayah') {
                    NamaAyah::updateOrCreate(
                        ['peserta_id' => $peserta_id],
                        [
                            'punya_ayah' => 'tidak_ayah',
                            'nama_lengkap_ayah' => null,
                            'tahun_lahir_ayah' => null,
                            'pendidikan_terakhir_ayah' => null,
                            'pekerjaan_ayah' => null,
                            'penghasilan_perbulan_ayah' => null,
                        ]
                    );
                }
        break;

        case 'biodata_ibu':
                $rules = [
                    'punya_ibu' => 'required|in:iya_ibu,belum_ibu,tidak_ibu',
                ];
                if ($request->input('punya_ibu') === 'iya_ibu') {
                    $rules = array_merge($rules, [
                        'nama_lengkap_ibu' => 'required|string|max:255',
                        'tahun_lahir_ibu' => 'required|date',
                        'pendidikan_terakhir_ibu' => 'required|in:sd,sltp,slta,diploma,s1,s2,s3,lainnya',
                        'pekerjaan_ibu' => 'required|string|max:255',
                        'penghasilan_perbulan_ibu' => 'required|in:< 1.500.000,< 2.500.000,> 3.500.000',
                    ]);
                    $ibuData = $request->only([
                        'punya_ibu',
                        'nama_lengkap_ibu',
                        'tahun_lahir_ibu',
                        'pendidikan_terakhir_ibu',
                        'pekerjaan_ibu',
                        'penghasilan_perbulan_ibu'
                    ]);
                    NamaIbu::updateOrCreate(['peserta_id' => $peserta_id], $ibuData);
                } elseif ($request->input('punya_ibu') === 'belum_ibu') {
                    NamaIbu::where('peserta_id', $peserta_id)->delete();
                } elseif ($request->input('punya_ibu') === 'tidak_ibu') {
                    NamaIbu::updateOrCreate(
                        ['peserta_id' => $peserta_id],
                        [
                            'punya_ibu' => 'tidak_ibu',
                            'nama_lengkap_ibu' => null,
                            'tahun_lahir_ibu' => null,
                            'pendidikan_terakhir_ibu' => null,
                            'pekerjaan_ibu' => null,
                            'penghasilan_perbulan_ibu' => null,
                        ]
                    );
                }
        break;

        case 'biodata_wali':
                $rules = [
                    'punya_wali' => 'required|in:iya_wali,belum_wali,tidak_wali',
                ];
                if ($request->input('punya_wali') === 'iya_wali') {
                    $rules = array_merge($rules, [
                        'nama_lengkap_wali' => 'required|string|max:255',
                        'tahun_lahir_wali' => 'required|date',
                        'pendidikan_terakhir_wali' => 'required|in:sd,sltp,slta,diploma,s1,s2,s3,lainnya',
                        'pekerjaan_wali' => 'required|string|max:255',
                        'penghasilan_perbulan_wali' => 'required|in:< 1.500.000,< 2.500.000,> 3.500.000',
                    ]);
                    $waliData = $request->only([
                        'punya_wali',
                        'nama_lengkap_wali',
                        'tahun_lahir_wali',
                        'pendidikan_terakhir_wali',
                        'pekerjaan_wali',
                        'penghasilan_perbulan_wali'
                    ]);
                    NamaWali::updateOrCreate(['peserta_id' => $peserta_id], $waliData);
                } elseif ($request->input('punya_wali') === 'belum_wali') {
                    NamaWali::where('peserta_id', $peserta_id)->delete();
                } elseif ($request->input('punya_wali') === 'tidak_wali') {
                    NamaWali::updateOrCreate(
                        ['peserta_id' => $peserta_id],
                        [
                            'punya_wali' => 'tidak_wali',
                            'nama_lengkap_wali' => null,
                            'tahun_lahir_wali' => null,
                            'pendidikan_terakhir_wali' => null,
                            'pekerjaan_wali' => null,
                            'penghasilan_perbulan_wali' => null,
                        ]
                    );
                }
        break;

        case 'ubah_password':
            $rules = [
                'password_baru' => 'required|min:8',
            ];
            $this->validate($request, $rules);
            $peserta = Peserta::find($peserta_id);
            $getUser = User::where('peserta_id', $peserta_id)->first();
            $user_id = $getUser->id;
            $user = User::find($user_id);
            $user->no_pendaftaran = $peserta->no_pendaftaran;
            if ($request->password_baru) {
                $user->password = Hash::make($request->password_baru);
            }
            $user->save();

        break;

        default:
            return redirect()->back()->with(['error' => "Bagian tidak ditemukan"]);
        }

        $request->validate($rules);
        $peserta = Peserta::find($peserta_id);
        $peserta->fill($request->only(array_keys($rules)));

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'max:2048|mimes:jpg,jpeg,png'
            ]);
            $foto = $request->file('foto');
            $filename = strtolower(str_replace(' ', '', $request->nama_lengkap)) . "-" . $peserta->nik . "_foto";
            $filetype = $foto->getClientOriginalExtension();
            $pathfile = 'public/peserta';
            $fotoUpload = $filename . "." . $filetype;
            $foto->storeAs($pathfile, $fotoUpload);
            $peserta->foto = $fotoUpload;
        }

        $updatePeserta = $peserta->save();

        $peserta = Peserta::find($peserta_id);
        $prestasi = Prestasi::where('peserta_id', $peserta_id)->first();
        $namaAyah = NamaAyah::where('peserta_id', $peserta_id)->first();
        $namaIbu = NamaIbu::where('peserta_id', $peserta_id)->first();
        $namaWali = NamaWali::where('peserta_id', $peserta_id)->first();

        if (!auth()->user()->hasRole('admin')) {
            $sections = [
                'informasi_pendaftaran' => ['jurusan_id', 'nama_lengkap', 'jenis_kelamin', 'tanggal_lahir', 'agama', 'alamat_lengkap', 'tempat_lahir'],
                'informasi_pribadi' => ['nik', 'nisn', 'nis', 'asal_sekolah', 'no_seri_ijazah_smp', 'no_seri_shun_smp', 'no_ujian_smp', 'email', 'no_hp'],
                'alamat' => ['kewarganegaraan', 'dusun', 'kelurahan', 'kabupaten', 'kecamatan', 'provinsi', 'kode_pos', 'jenis_tinggal', 'alat_tranportasi_kesekolah'],
                'data_lainnya' => ['kebutuhan_khusus', 'penerima_kps_pip', 'nomor_kps_pip', 'tinggi_badan', 'berat_badan', 'jumlah_saudara', 'jarak_tempat_tinggal_kesekolah', 'waktu_tempat_berangkat_kesekolah']
            ];

            $allSectionsCompleted = true;
            foreach ($sections as $sectionFields) {
                foreach ($sectionFields as $field) {
                    if (is_null($peserta->$field)) {
                        $allSectionsCompleted = false;
                        break 2;
                    }
                }
            }

            if ($prestasi) {
                if ($prestasi->apakah_berprestasi === 'tidak') {
                    $prestasiCompleted = !is_null($prestasi->apakah_berprestasi);
                } elseif ($prestasi->apakah_berprestasi === 'iya') {
                    $prestasiCompleted = !is_null($prestasi->nama_prestasi) &&
                                        !is_null($prestasi->tahun) &&
                                        !is_null($prestasi->penyelenggara) &&
                                        !is_null($prestasi->tingkat);
                }
            } else {
                $prestasiCompleted = false;
            }


            if ($namaAyah) {
                if ($namaAyah->punya_ayah === 'tidak_ayah') {
                    $allSectionAyah = !is_null($namaAyah->punya_ayah);
                } elseif ($namaAyah->punya_ayah === 'iya_ayah') {
                    $allSectionAyah = !is_null($namaAyah->tahun_lahir_ayah) &&
                                    !is_null($namaAyah->pendidikan_terakhir_ayah) &&
                                    !is_null($namaAyah->pekerjaan_ayah) &&
                                    !is_null($namaAyah->penghasilan_perbulan_ayah);
                }
            } else {
                $allSectionAyah = false;
            }

            if ($namaIbu) {
                if ($namaIbu->punya_ibu === 'tidak_ibu') {
                    $allSectionIbu = !is_null($namaIbu->punya_ibu);
                } elseif ($namaIbu->punya_ibu === 'iya_ibu') {
                    $allSectionIbu = !is_null($namaIbu->tahun_lahir_ibu) &&
                                    !is_null($namaIbu->pendidikan_terakhir_ibu) &&
                                    !is_null($namaIbu->pekerjaan_ibu) &&
                                    !is_null($namaIbu->penghasilan_perbulan_ibu);
                }
            } else {
                $allSectionIbu = false;
            }

            if ($namaWali) {
                if ($namaWali->punya_wali === 'tidak_wali') {
                    $allSectionWali = !is_null($namaWali->punya_wali);
                } elseif ($namaWali->punya_wali === 'iya_wali') {
                    $allSectionWali = !is_null($namaWali->tahun_lahir_wali) &&
                                    !is_null($namaWali->pendidikan_terakhir_wali) &&
                                    !is_null($namaWali->pekerjaan_wali) &&
                                    !is_null($namaWali->penghasilan_perbulan_wali);
                }
            } else {
                $allSectionWali = false;
            }

            if ($allSectionsCompleted && $prestasiCompleted && $allSectionAyah && $allSectionIbu && $allSectionWali) {
                $peserta->sudah_lengkap = true;
                if ($peserta->progres !== 'sudah_daftar') {
                    $peserta->progres = ($peserta->progres !== 'berkas_lengkap') ? 'biodata_lengkap' : $peserta->progres;
                }
            } else {
                $peserta->sudah_lengkap = false;
            }
            $peserta->save();
        }

        if ($updatePeserta) {
            return redirect()->back()->with(['success' => "Data berhasil disimpan"]);
        } else {
            return redirect()->back()->with(['error' => "Gagal menyimpan data"]);
        }
    }

    public function store(Request $request)
    {
        if (! $request->session()->exists('jenis_pendaftaran')) redirect('/');

        $request->validate([
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
                'progres' => 'required',
            ], [
                'nisn.unique' => 'NISN Sudah Terdaftar. Silahkan Login.',
                'email.unique' => 'Email Sudah Terdaftar. Silahkan Login.',
                'no_hp.regex' => 'Nomor HP harus terdiri dari 11 sampai 13 digit.',
            ]);

        $gelombang = Gelombang::where('aktif', true)->first();
        if (!$gelombang) {
            return redirect()->back()->with(['error' => "Belum ada gelombang aktif. Silahkan hubungi admin"]);
        }

        $peserta = new Peserta;
        $peserta->fill($request->all());
        // $peserta->jenis_pendaftaran = $request->jenis_pendaftaran == "test" ? 1 : 2;
        $peserta->jenis_pendaftaran = $request->jenis_pendaftaran;
        $peserta->gelombang_id = $gelombang->gelombang_id;
        $peserta->pwd = Carbon::parse($peserta->tanggal_lahir)->format('Ymd');

        $insert = $peserta->save();

        if ($insert)
        {
            // Generate & Update no pendaftaran
            $peserta_id = $peserta->peserta_id;
            $kode_sekolah = "21038";
            $no_pendaftaran = $kode_sekolah . str_pad($peserta_id, 4, '0', STR_PAD_LEFT);

            $peserta->no_pendaftaran = $no_pendaftaran;
            $peserta->save();

            $password = Carbon::parse($peserta->tanggal_lahir)->format('Ymd');

            $user = new User;
            $user->name = $peserta->nama_lengkap;
            $user->email = $peserta->email;
            $user->password = Hash::make($password);
            $user->no_pendaftaran = $no_pendaftaran;
            $user->peserta_id = $peserta->peserta_id;
            $user->save();

            $role = match($peserta->jenis_pendaftaran) {
                'prestasi' => 'peserta_prestasi',
                'transfer' => 'peserta_transfer',
                default => 'peserta',
            };
            $user->assignRole($role);

            $user->notify(new DaftarBerhasil($user, $password));

                return redirect()->route('dapat-akun', ['no_pendaftaran' => $no_pendaftaran]);

        } else {
                return back();
        }
    }

public function hapus(Request $request)
    {
        // Temukan peserta berdasarkan ID
        $peserta = Peserta::findOrFail($request->peserta_id);

        // Hapus data terkait di tabel nama ayah, ibu, wali, prestasi, dan ijazah
        NamaAyah::where('peserta_id', $request->peserta_id)->delete();
        NamaIbu::where('peserta_id', $request->peserta_id)->delete();
        NamaWali::where('peserta_id', $request->peserta_id)->delete();
        Prestasi::where('peserta_id', $request->peserta_id)->delete();
        Ijazah::where('peserta_id', $request->peserta_id)->delete();
        Sk_lulus::where('peserta_id', $request->peserta_id)->delete();

        // Hapus peserta
        $delete = $peserta->delete();

        if ($delete) {
            // Jika peserta berhasil dihapus, hapus juga user terkait jika ada
            $user = User::where('peserta_id', $request->peserta_id)->first();
            if ($user) {
                $user->delete();
            }
            return redirect()->back()->withSuccess('Peserta berhasil dihapus');
        } else {
            return redirect()->back()->withError('Gagal menghapus data');
        }
    }



    public function pesertaLulus()
    {
        $jurusan_id = request()->get('jurusan_id');
        $jurusan = Jurusan::all();
        $daftar_tahun = Gelombang::select('tahun')->distinct()->get();
        $gelombang = new Gelombang;
        $tahun = request()->get('tahun') ? request()->get('tahun') : $gelombang->currentyear();
        $daftar_gelombang = Gelombang::where('tahun', $tahun)->get();
        $gelombang_id = request()->get('gelombang');

        return view('pages.backsite.daftar-peserta-lulus.index', [
            "jurusan" => $jurusan,
            "jurusan_id" => $jurusan_id,
            'daftar_tahun' => $daftar_tahun,
            'tahun' => $tahun,
            'daftar_gelombang' => $daftar_gelombang,
            'gelombang_id' => $gelombang_id
        ]);
    }

    public function pesertaLulusJson()
    {
        $jurusan_id = request()->get('jurusan_id');
        $tahun = request()->get('tahun');
        $gelombang_id = request()->get('gelombang_id');

        $data = Peserta::select('peserta_id', 'no_pendaftaran', 'nama_lengkap', 'gelombang_id','jurusan_id', 'no_hp', 'created_at','sudah_lulus','status_kelulusan_berkas')
            ->with('jurusan:jurusan_id,nama')
            ->where('sudah_lulus', 'lulus')
            ->with('siswa')
            ->orderBy('peserta_id', 'desc');

        if ($jurusan_id) {
            $data->where('jurusan_id', $jurusan_id);
        }

        if ($tahun) {
            $data->whereYear('created_at', $tahun);
        } else {
            $tahun = Gelombang::currentyear();
            $data->whereYear('created_at', $tahun);
        }

        if ($gelombang_id) {
            $data->where('gelombang_id', $gelombang_id);
        }

        $result = $data->get();

        return Datatables::of($result)->make(true);
    }


    public function sudahDaftarUlang()
    {
        return view('pages.backsite.peserta-sudah-daftar-ulang.index');
    }

    public function sudahDaftarUlangJson()
    {
        $tahun = request()->get('tahun');

        $data = Peserta::select('peserta_id', 'no_pendaftaran', 'nama_lengkap', 'gelombang_id','jurusan_id', 'sudah_lulus', 'no_hp', 'created_at')
            ->with('jurusan:jurusan_id,nama')
            ->where('progres', 'sudah_daftar')
            ->orderBy('peserta_id', 'desc');

        if ($tahun) {
            $data->whereYear('created_at', $tahun);
        } else {
            $gelombang = new Gelombang;
            $tahun = $gelombang->currentyear();
            $data->whereYear('created_at', $tahun);
        }

        return Datatables::of($data->get())->make(true);
    }

    public function updateStatusLulus(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required|exists:peserta,peserta_id',
            'sudah_lulus' => 'required|in:proses,lulus,tidak_lulus',
        ]);

        $peserta = Peserta::find($request->peserta_id);
        $peserta->sudah_lulus = $request->sudah_lulus;

        if ($request->sudah_lulus == 'tidak_lulus') {
        $peserta->batal_sekolah = true;
        } else {
            $peserta->batal_sekolah = false; // Optional: Reset to false if not 'tidak_lulus'
        }

        $peserta->sudah_daftar_ulang = true;
        $peserta->save();

        return redirect()->back()->with('status', 'Status lulus berhasil diperbarui');
    }

    public function batalSekolah()
    {
        $jurusan_id = request()->get('jurusan_id');
        $jurusan = Jurusan::all();

        return view('pages.backsite.peserta-batal-sekolah.index', [
            "jurusan" => $jurusan,
            "jurusan_id" => $jurusan_id
        ]);
    }

    public function batalSekolahJson()
    {
        $jurusan_id = request()->get('jurusan_id');

        $data = Peserta::select('peserta_id', 'no_pendaftaran', 'nama_lengkap', 'gelombang_id','jurusan_id', 'no_hp', 'created_at','sudah_daftar_ulang','sudah_lulus')
            ->with('jurusan:jurusan_id,nama')
            ->where('batal_sekolah', true)
            ->orderBy('peserta_id', 'desc');

        if ($jurusan_id) {
            $data->where('jurusan_id', $jurusan_id);
        }

        $result = $data->get();

        return Datatables::of($result)->make(true);
    }


    public function excelPesertaLulus(Request $request)
    {
        $arg['jurusan_id'] = $request->get('jurusan_id');
        $nama = 'peserta';

        if ($arg['jurusan_id']) {
            $jurusan = Jurusan::find($arg['jurusan_id']);
            $nama = $nama . "_" . $jurusan->nama;
        }

        return Excel::download(new PesertaLulusExport($arg), $nama . 'peserta-lulus.xlsx');
    }

    public function excelPesertaLulusDaftar(Request $request)
    {
        $arg['prodi_id'] = $request->get('prodi_id');
        $arg['gelombang_id'] = $request->get('gelombang_id');

        $result = Excel::download(new PesertaLulusDaftarExport($arg), 'peserta-lulus-all.xlsx');

        return $result;
    }

    public function excelPeserta(Request $request)
    {
        $arg['asal_sekolah'] = $request->get('asal_sekolah');

        $result = Excel::download(new PesertaAdmExport($arg), 'peserta-all.xlsx');

        return $result;
    }

}
