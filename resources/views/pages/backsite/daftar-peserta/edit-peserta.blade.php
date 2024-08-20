@extends('layouts.default-dashboard')

@section('title', 'Edit Biodata')

@section('content')
@if ($errors->any())
<div class="alert alert-danger" style="margin-top : 3rem;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link" href="/biodata"><i class="bx bx-user me-1"></i>Biodata Diri</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/biodata/edit"
        ><i class="bx bx-edit me-1"></i>Ubah Biodata</a
        >
    </li>
</ul>
<div class="card-header bg-info">
    <h5 class="mb-0 text-white">Ubah Biodata Diri</h5>
</div>
<div class="accordion" id="accordionExample">
    <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
        <button type="button" class="accordion-button collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne" role="tabpanel">

            @if($peserta->nama_lengkap && $peserta->tempat_lahir && $peserta->tanggal_lahir && $peserta->jenis_kelamin && $peserta->agama && $peserta->alamat_lengkap && $peserta->jurusan_id && $peserta->foto)
                <span>Informasi Pendaftaran</span> <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
            @else
                <span>Informasi Pendaftaran</span> <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
            @endif

        </button>
        </h2>

        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="informasi_pendaftaran">
                            <!-- Account -->
                            <p>Foto Profil</p>
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if($peserta->foto)
                                    <img
                                        src="{{ asset('/storage/peserta/'.$peserta->foto) }}" alt="user-avatar" class="d-block rounded" height="150" width="150" id="uploadedAvatar"
                                    />
                                    @else
                                    <img
                                        src="{{ asset('/assets/admin/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="80" width="80" id="uploadedAvatar"
                                    />
                                    @endif
                                    <div class="button-wrapper">
                                    <label for="foto" class="btn btn-primary me-2 mb-2" tabindex="0">
                                        <input type="file" class="form-control" id="foto" name="foto" {{ $peserta->foto == null ? "required" : "" }}>
                                    </label>
                                        <p class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="peserta_id" value="{{ $peserta->peserta_id }}" >
                            <div class="mb-3 col-md-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="nama_lengkap"
                                    name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $peserta->nama_lengkap) }}"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal-Lahir</label>
                                <input
                                    class="form-control"
                                    type="date"
                                    id="tanggal_lahir"
                                    name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $peserta->tanggal_lahir) ?? '' }}"
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="select2 form-select">
                                    <option value="">Pilih</option>
                                    <option value="laki-laki" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ old('jenis_kelamin', $peserta->jenis_kelamin) === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="agama">Agama</label>
                                <select id="agama" name="agama" class="select2 form-select">
                                    <option value="">Pilih</option>
                                    <option value="islam" {{ old('agama', $peserta->agama) === 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ old('agama', $peserta->agama) === 'kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="katolik" {{ old('agama', $peserta->agama) === 'katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="konghucu" {{ old('agama', $peserta->agama) === 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <option value="budha" {{ old('agama', $peserta->agama) === 'budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="hindu" {{ old('agama', $peserta->agama) === 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="lainnya" {{ old('agama', $peserta->agama) === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <input class="form-control" type="text" id="alamat_lengkap" name="alamat_lengkap" value="{{ old('alamat_lengkap', $peserta->alamat_lengkap) }}" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="jurusan">Jurusan</label>
                                <select id="jurusan_id" name="jurusan_id" class="select2 form-select">
                                    <option value="">--Pilih--</option>
                                    @foreach($jurusan as $row)
                                        <option value="{{ $row->jurusan_id }}" {{ old('jurusan_id', $peserta->jurusan_id) == $row->jurusan_id ? 'selected' : '' }}>{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingTwo">
        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo" role="tabpanel">
            @if($peserta->nik && $peserta->nisn && $peserta->nis && $peserta->asal_sekolah && $peserta->no_seri_ijazah_smp && $peserta->no_seri_shun_smp && $peserta->no_ujian_smp && $peserta->email && $peserta->no_hp)
                <span>Informasi Pribadi</span> <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
            @else
                <span>Informasi Pribadi</span> <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
            @endif
        </button>
        </h2>

        <div id="accordionTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="informasi_pribadi">
                            <div class="mb-3 col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK Pendaftar Sebanyak 16 karakter" value="{{ old('nik', $peserta->nik ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukan NISN Pendaftar" value="{{ old('nisn', $peserta->nisn ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukan NIS Pendaftar" value="{{ old('nis', $peserta->nis ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Masukan Asal Sekolah Pendaftar" value="{{ old('asal_sekolah', $peserta->asal_sekolah ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="no_seri_ijazah_smp" class="form-label">No Seri Ijazah SMP/MTs</label>
                                <input type="text" class="form-control" id="no_seri_ijazah_smp" name="no_seri_ijazah_smp" placeholder="Masukan no seri ijazah SMP/MTs Pendaftar" value="{{ old('no_seri_ijazah_smp', $peserta->no_seri_ijazah_smp ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="no_seri_shun_smp" class="form-label">No Seri SHUN SMP/MTs</label>
                                <input type="text" class="form-control" id="no_seri_shun_smp" name="no_seri_shun_smp" placeholder="Masukan no seri SHUN SMP/MTs Pendaftar" value="{{ old('no_seri_shun_smp', $peserta->no_seri_shun_smp ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="no_ujian_smp" class="form-label">No Ujian SMP/MTs</label>
                                <input type="text" class="form-control" id="no_ujian_smp" name="no_ujian_smp" placeholder="Masukan no UJIAN SMP/MTs Pendaftar" value="{{ old('no_ujian_smp', $peserta->no_ujian_smp ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email Pendaftar" value="{{ old('email', $peserta->email ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="no_hp">NO HP</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">ind (+62)</span>
                                    <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="813 4672 6927" value="{{ old('no_hp', $peserta->no_hp ?? '') }}" />
                                </div>
                            </div>
                        </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                                <button type="reset" class="btn btn-outline-secondary">CANCEL</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingThree">
        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree" role="tabpanel">
            @if($peserta->dusun && $peserta->kelurahan && $peserta->kabupaten && $peserta->kecamatan && $peserta->provinsi && $peserta->kewarganegaraan && $peserta->kode_pos && $peserta->alat_tranportasi_kesekolah && $peserta->jenis_tinggal)
                <span>Alamat</span> <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
            @else
                <span>Alamat</span> <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
            @endif
        </button>
        </h2>
        <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="alamat">
                            <div class="mb-3 col-md-6">
                                <label for="dusun" class="form-label">Dusun</label>
                                <input type="text" class="form-control" id="dusun" name="dusun" placeholder="Masukan Dusun" value="{{ old('dusun', $peserta->dusun ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input class="form-control" type="text" id="kelurahan" name="kelurahan" placeholder="Masukan kelurahan" value="{{ old('kelurahan', $peserta->kelurahan ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <select class="form-control" id="kabupaten" name="kabupaten" required>
                                    <option value="" disabled selected>--Pilih--</option>
                                    @foreach($kabupaten as $row => $val)
                                    <option {{ old('kabupaten', $peserta->kabupaten) == $val->kabupaten_id ? "selected" : "" }} value="{{$val->kabupaten_id}}">{{ $val->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                    <option value="" disabled selected>--Pilih--</option>
                                    @if(count($kecamatan) > 0)
                                        @foreach($kecamatan as $key => $val)
                                        <option data-tokens="{{ $val->nama }}" {{ old('kecamatan', $peserta->kecamatan) == $val->kecamatan_id ? "selected" : "" }} value="{{$val->kecamatan_id}}">{{ $val->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input class="form-control" type="text" id="provinsi" name="provinsi" placeholder="Masukan Provinsi" value="{{ old('provinsi', $peserta->provinsi ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                <input class="form-control" type="text" id="kewarganegaraan" name="kewarganegaraan" placeholder="Masukan Kewarganegaraan" value="{{ old('kewarganegaraan', $peserta->kewarganegaraan ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                <input class="form-control" type="text" id="kode_pos" name="kode_pos" placeholder="Masukan Kode Pos" value="{{ old('kode_pos', $peserta->kode_pos ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="alat_tranportasi_kesekolah" class="form-label">Alat Transportasi</label>
                                <input class="form-control" type="text" id="alat_tranportasi_kesekolah" name="alat_tranportasi_kesekolah" placeholder="Masukan Alat Transportasi" value="{{ old('alat_tranportasi_kesekolah', $peserta->alat_tranportasi_kesekolah ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="jenis_tinggal" class="form-label">Jenis Tinggal</label>
                                <input class="form-control" type="text" id="jenis_tinggal" name="jenis_tinggal" placeholder="Masukan Jenis Tinggal" value="{{ old('jenis_tinggal', $peserta->jenis_tinggal ?? '') }}" />
                            </div>
                        </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                                <button type="reset" class="btn btn-outline-secondary">CANCEL</button>
                            </div>
                    </form>
                </div>
        </div>
        </div>
    </div>
    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingFour">
        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour" role="tabpanel">
            @if($peserta->kebutuhan_khusus && $peserta->penerima_kps_pip && $peserta->nomor_kps_pip && $peserta->tinggi_badan && $peserta->berat_badan && $peserta->jumlah_saudara && $peserta->jarak_tempat_tinggal_kesekolah && $peserta->waktu_tempat_berangkat_kesekolah)
                <span>Data Lainya</span> <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
            @else
                <span>Data Lainya</span> <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
            @endif
        </button>
        </h2>
        <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="data_lainnya">
                            <div class="mb-3 col-md-6">
                                <label for="kebutuhan_khusus" class="form-label">Kebutuhan Khusus</label>
                                <select id="kebutuhan_khusus" name="kebutuhan_khusus" class="select2 form-select">
                                    <option value="">--Silahkan Pilih--</option>
                                    <option value="ya" {{ old('kebutuhan_khusus', $peserta->kebutuhan_khusus) === 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ old('kebutuhan_khusus', $peserta->kebutuhan_khusus) === 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="penerima_kps_pip" class="form-label">Apakah Sebagai Penerima KPS/PIP</label>
                                <select id="penerima_kps_pip" name="penerima_kps_pip" class="select2 form-select">
                                    <option value="">--Silahkan Pilih--</option>
                                    <option value="ya" {{ old('penerima_kps_pip', $peserta->penerima_kps_pip) === 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ old('penerima_kps_pip', $peserta->penerima_kps_pip) === 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nomor_kps_pip" class="form-label">No KPS</label>
                                <input class="form-control" type="text" id="nomor_kps_pip" name="nomor_kps_pip" placeholder="Masukkan No KPS" value="{{ old('nomor_kps_pip', $peserta->nomor_kps_pip ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan</label>
                                <input class="form-control" type="number" id="tinggi_badan" name="tinggi_badan" placeholder="centimeter (cm)" value="{{ old('tinggi_badan', $peserta->tinggi_badan ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="berat_badan" class="form-label">Berat Badan</label>
                                <input class="form-control" type="number" id="berat_badan" name="berat_badan" placeholder="Kilogram (Kg)" value="{{ old('berat_badan', $peserta->berat_badan ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="jumlah_saudara" class="form-label">Jumlah Saudara Kandung</label>
                                <input class="form-control" type="number" id="jumlah_saudara" name="jumlah_saudara" placeholder="Masukkan Jumlah Saudara Kandung" value="{{ old('jumlah_saudara', $peserta->jumlah_saudara ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="jarak_tempat_tinggal_kesekolah" class="form-label">Jarak Tempat Tinggal Ke Sekolah</label>
                                <input class="form-control" type="number" id="jarak_tempat_tinggal_kesekolah" name="jarak_tempat_tinggal_kesekolah" placeholder="Kilometer (Km)" value="{{ old('jarak_tempat_tinggal_kesekolah', $peserta->jarak_tempat_tinggal_kesekolah ?? '') }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="waktu_tempat_berangkat_kesekolah" class="form-label">Waktu Tempuh</label>
                                <input class="form-control" type="number" id="waktu_tempat_berangkat_kesekolah" name="waktu_tempat_berangkat_kesekolah" placeholder="Menit" value="{{ old('waktu_tempat_berangkat_kesekolah', $peserta->waktu_tempat_berangkat_kesekolah ?? '') }}"/>
                            </div>
                        </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                                <button type="reset" class="btn btn-outline-secondary">CANCEL</button>
                            </div>
                    </form>
            </div>
        </div>
        </div>
    </div>
    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingFive">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive" role="tabpanel">
                @if($catatanPrestasiExists)
                    <span>Catatan Prestasi</span> <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
                @else
                    <span>Catatan Prestasi</span> <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
                @endif
            </button>
        </h2>
        <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="prestasi">

                            <!-- Pertanyaan Apakah Berprestasi -->
                            <div class="mb-3 col-md-6 grid-item">
                                <label for="apakah_berprestasi" class="form-label">Apakah Anda Berprestasi?</label>
                                <select id="apakah_berprestasi" class="select2 form-select" name="apakah_berprestasi" onchange="togglePrestasiFields()">
                                    <option value="belum" {{ old('apakah_berprestasi', $prestasi->apakah_berprestasi ?? 'belum') === 'belum' ? 'selected' : '' }}>Belum</option>
                                    <option value="tidak" {{ old('apakah_berprestasi', $prestasi->apakah_berprestasi ?? 'tidak') === 'tidak' ? 'selected' : '' }}>Tidak</option>
                                    <option value="iya" {{ old('apakah_berprestasi', $prestasi->apakah_berprestasi ?? '') === 'iya' ? 'selected' : '' }}>Iya</option>
                                </select>
                            </div>

                            <!-- Form Prestasi -->
                            <div id="prestasi-fields" style="display: none;">
                                <div class="row">
                                    <div class="mb-3 col-md-6 grid-item">
                                        <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
                                        <input class="form-control" type="text" id="nama_prestasi" name="nama_prestasi" placeholder="Masukkan Nama Prestasi" value="{{ old('nama_prestasi', $prestasi->nama_prestasi ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6 grid-item">
                                        <label for="tahun" class="form-label">Tahun Prestasi</label>
                                        <input class="form-control" type="date" id="tahun" name="tahun" placeholder="Masukkan Tahun Prestasi" value="{{ old('tahun', $prestasi->tahun ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6 grid-item">
                                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                        <input class="form-control" type="text" id="penyelenggara" name="penyelenggara" placeholder="Masukkan Penyelenggara" value="{{ old('penyelenggara', $prestasi->penyelenggara ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6 grid-item">
                                        <label for="tingkat" class="form-label">Tingkat Prestasi</label>
                                        <select id="tingkat" class="select2 form-select" name="tingkat">
                                            <option value="">--Silakan Pilih--</option>
                                            <option value="prestasi_kecamatan" {{ old('tingkat', $prestasi->tingkat ?? '') === 'prestasi_kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                            <option value="prestasi_kabupaten" {{ old('tingkat', $prestasi->tingkat ?? '') === 'prestasi_kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                            <option value="prestasi_provinsi" {{ old('tingkat', $prestasi->tingkat ?? '') === 'prestasi_provinsi' ? 'selected' : '' }}>Provinsi</option>
                                            <option value="prestasi_nasional" {{ old('tingkat', $prestasi->tingkat ?? '') === 'prestasi_nasional' ? 'selected' : '' }}>Nasional</option>
                                            <option value="prestasi_internasional" {{ old('tingkat', $prestasi->tingkat ?? '') === 'prestasi_internasional' ? 'selected' : '' }}>Internasional</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                            <button type="reset" class="btn btn-outline-secondary">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingSixAyah">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionSixAyah" aria-expanded="false" aria-controls="accordionSixAyah" role="tabpanel">
                <span>Biodata Ayah</span>
                @if($isAyahLengkap)
                    <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
                @else
                    <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
                @endif
            </button>
        </h2>
        <div id="accordionSixAyah" class="accordion-collapse collapse" aria-labelledby="headingSixAyah" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="biodata_ayah">
                        @foreach ($peserta->namaAyah as $ayah)

                            <!-- Pertanyaan Apakah Anda mempunyai ayah? -->
                            <div class="mb-3 col-md-6 grid-item">
                                <label for="punya_ayah" class="form-label">Apakah anda mempunyai ayah?</label>
                                <select id="punya_ayah" class="select2 form-select" name="punya_ayah" onchange="toggleAyahFields()">
                                    <option value="belum_ayah" {{ old('punya_ayah', $ayah->punya_ayah ?? 'belum_ayah') === 'belum_ayah' ? 'selected' : '' }}>Belum</option>
                                    <option value="tidak_ayah" {{ old('punya_ayah', $ayah->punya_ayah ?? 'tidak_ayah') === 'tidak_ayah' ? 'selected' : '' }}>Tidak</option>
                                    <option value="iya_ayah" {{ old('punya_ayah', $ayah->punya_ayah ?? '') === 'iya_ayah' ? 'selected' : '' }}>Iya</option>
                                </select>
                            </div>

                            <!-- Form Ayah -->
                            <div id="ayah-fields" style="display: none;">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama_lengkap_ayah" class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="nama_lengkap_ayah" name="nama_lengkap_ayah" placeholder="Masukkan Nama Lengkap Ayah" value="{{ old('nama_lengkap_ayah', $ayah->nama_lengkap_ayah ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="tahun_lahir_ayah" class="form-label">Tahun Lahir</label>
                                        <input class="form-control" type="date" id="tahun_lahir_ayah" name="tahun_lahir_ayah" placeholder="Masukkan Tahun Lahir Ayah" value="{{ old('tahun_lahir_ayah', $ayah->tahun_lahir_ayah ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pendidikan_terakhir_ayah" class="form-label">Pendidikan Terakhir</label>
                                        <select id="pendidikan_terakhir_ayah" class="select2 form-select" name="pendidikan_terakhir_ayah">
                                            <option value="">--Silakan Pilih--</option>
                                            <option value="sd" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 'sd' ? 'selected' : '' }}>SD</option>
                                            <option value="sltp" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 'sltp' ? 'selected' : '' }}>SLTP</option>
                                            <option value="slta" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 'slta' ? 'selected' : '' }}>SLTA</option>
                                            <option value="diploma" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 'diploma' ? 'selected' : '' }}>Diploma</option>
                                            <option value="s1" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 's1' ? 'selected' : '' }}>S1</option>
                                            <option value="s2" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 's2' ? 'selected' : '' }}>S2</option>
                                            <option value="s3" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 's3' ? 'selected' : '' }}>S3</option>
                                            <option value="lainnya" {{ old('pendidikan_terakhir_ayah', $ayah->pendidikan_terakhir_ayah ?? '') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                        <input class="form-control" type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Masukkan Pekerjaan Ayah" value="{{ old('pekerjaan_ayah', $ayah->pekerjaan_ayah ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="penghasilan_perbulan_ayah" class="form-label">Penghasilan Perbulan</label>
                                        <select id="penghasilan_perbulan_ayah" class="select2 form-select" name="penghasilan_perbulan_ayah">
                                            <option value="">--Silakan Pilih--</option>
                                            <option value="< 1.500.000" {{ old('penghasilan_perbulan_ayah', $ayah->penghasilan_perbulan_ayah ?? '') === '< 1.500.000' ? 'selected' : '' }}>&lt; 1.500.000</option>
                                            <option value="< 2.500.000" {{ old('penghasilan_perbulan_ayah', $ayah->penghasilan_perbulan_ayah ?? '') === '< 2.500.000' ? 'selected' : '' }}>&lt; 2.500.000</option>
                                            <option value="> 3.00.000" {{ old('penghasilan_perbulan_ayah', $ayah->penghasilan_perbulan_ayah ?? '') === '> 3.500.000' ? 'selected' : '' }}>&gt; 3.500.000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                            <button type="reset" class="btn btn-outline-secondary">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingSixIbu">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionSixIbu" aria-expanded="false" aria-controls="accordionSixIbu" role="tabpanel">
                <span>Biodata Ibu</span>
                @if($isIbuLengkap)
                    <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
                @else
                    <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
                @endif
            </button>
        </h2>
        <div id="accordionSixIbu" class="accordion-collapse collapse" aria-labelledby="headingSixIbu" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="biodata_ibu">
                        @foreach ($peserta->namaIbu as $ibu)

                            <!-- Pertanyaan Apakah Anda mempunyai ibu? -->
                            <div class="mb-3 col-md-6 grid-item">
                                <label for="punya_ibu" class="form-label">Apakah anda mempunyai ibu?</label>
                                <select id="punya_ibu" class="select2 form-select" name="punya_ibu" onchange="toggleIbuFields()">
                                    <option value="belum_ibu" {{ old('punya_ibu', $ibu->punya_ibu ?? 'belum_ibu') === 'belum_ibu' ? 'selected' : '' }}>Belum</option>
                                    <option value="tidak_ibu" {{ old('punya_ibu', $ibu->punya_ibu ?? 'tidak_ibu') === 'tidak_ibu' ? 'selected' : '' }}>Tidak</option>
                                    <option value="iya_ibu" {{ old('punya_ibu', $ibu->punya_ibu ?? '') === 'iya_ibu' ? 'selected' : '' }}>Iya</option>
                                </select>
                            </div>

                            <!-- Form Ibu -->
                            <div id="ibu-fields" style="display: none;">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama_lengkap_ibu" class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="nama_lengkap_ibu" name="nama_lengkap_ibu" placeholder="Masukkan Nama Lengkap Ibu" value="{{ old('nama_lengkap_ibu', $ibu->nama_lengkap_ibu ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="tahun_lahir_ibu" class="form-label">Tahun Lahir</label>
                                        <input class="form-control" type="date" id="tahun_lahir_ibu" name="tahun_lahir_ibu" placeholder="Masukkan Tahun Lahir Ibu" value="{{ old('tahun_lahir_ibu', $ibu->tahun_lahir_ibu ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pendidikan_terakhir_ibu" class="form-label">Pendidikan Terakhir</label>
                                        <select id="pendidikan_terakhir_ibu" class="select2 form-select" name="pendidikan_terakhir_ibu">
                                            <option value="">--Silakan Pilih--</option>
                                            <option value="sd" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 'sd' ? 'selected' : '' }}>SD</option>
                                            <option value="sltp" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 'sltp' ? 'selected' : '' }}>SLTP</option>
                                            <option value="slta" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 'slta' ? 'selected' : '' }}>SLTA</option>
                                            <option value="diploma" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 'diploma' ? 'selected' : '' }}>Diploma</option>
                                            <option value="s1" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 's1' ? 'selected' : '' }}>S1</option>
                                            <option value="s2" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 's2' ? 'selected' : '' }}>S2</option>
                                            <option value="s3" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 's3' ? 'selected' : '' }}>S3</option>
                                            <option value="lainnya" {{ old('pendidikan_terakhir_ibu', $ibu->pendidikan_terakhir_ibu ?? '') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                        <input class="form-control" type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Masukkan Pekerjaan Ibu" value="{{ old('pekerjaan_ibu', $ibu->pekerjaan_ibu ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="penghasilan_perbulan_ibu" class="form-label">Penghasilan Perbulan</label>
                                        <select id="penghasilan_perbulan_ibu" class="select2 form-select" name="penghasilan_perbulan_ibu">
                                            <option value="">--Silakan Pilih--</option>
                                            <option value="< 1.500.000" {{ old('penghasilan_perbulan_ibu', $ibu->penghasilan_perbulan_ibu ?? '') === '< 1.500.000' ? 'selected' : '' }}>&lt; 1.500.000</option>
                                            <option value="< 2.500.000" {{ old('penghasilan_perbulan_ibu', $ibu->penghasilan_perbulan_ibu ?? '') === '< 2.500.000' ? 'selected' : '' }}>&lt; 2.500.000</option>
                                            <option value="> 3.500.000" {{ old('penghasilan_perbulan_ibu', $ibu->penghasilan_perbulan_ibu ?? '') === '> 3.500.000' ? 'selected' : '' }}>&gt; 3.500.000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                            <button type="reset" class="btn btn-outline-secondary">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card accordion-item">
        <h2 class="accordion-header" id="headingSixWali">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionSixWali" aria-expanded="false" aria-controls="accordionSixWali" role="tabpanel">
                <span>Biodata Wali</span>
                @if($isWaliLengkap)
                    <span class="badge bg-label-success ms-auto">Sudah Lengkap</span>
                @else
                    <span class="badge bg-label-danger ms-auto">Belum Lengkap</span>
                @endif
            </button>
        </h2>
        <div id="accordionSixWali" class="accordion-collapse collapse" aria-labelledby="headingSixWali" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-body">
                    <form action="/biodata/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="section" value="biodata_wali">
                        @foreach ($peserta->namaWali as $wali)

                            <!-- Pertanyaan Apakah Anda mempunyai wali? -->
                            <div class="mb-3 col-md-6 grid-item">
                                <label for="punya_wali" class="form-label">Apakah anda mempunyai wali?</label>
                                <select id="punya_wali" class="select2 form-select" name="punya_wali" onchange="toggleWaliFields()">
                                    <option value="belum_wali" {{ old('punya_wali', $wali->punya_wali ?? 'belum_wali') === 'belum_wali' ? 'selected' : '' }}>Belum</option>
                                    <option value="tidak_wali" {{ old('punya_wali', $wali->punya_wali ?? 'tidak_wali') === 'tidak_wali' ? 'selected' : '' }}>Tidak</option>
                                    <option value="iya_wali" {{ old('punya_wali', $wali->punya_wali ?? '') === 'iya_wali' ? 'selected' : '' }}>Iya</option>
                                </select>
                            </div>

                            <!-- Form Wali -->
                            <div id="wali-fields" style="display: none;">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nama_lengkap_wali" class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="nama_lengkap_wali" name="nama_lengkap_wali" placeholder="Masukkan Nama Lengkap Wali" value="{{ old('nama_lengkap_wali', $wali->nama_lengkap_wali ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="tahun_lahir_wali" class="form-label">Tahun Lahir</label>
                                        <input class="form-control" type="date" id="tahun_lahir_wali" name="tahun_lahir_wali" placeholder="Masukkan Tahun Lahir Wali" value="{{ old('tahun_lahir_wali', $wali->tahun_lahir_wali ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pendidikan_terakhir_wali" class="form-label">Pendidikan Terakhir</label>
                                        <select id="pendidikan_terakhir_wali" class="select2 form-select" name="pendidikan_terakhir_wali">
                                            <option value="">--Silakan Pilih--</option>
                                            <option value="sd" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 'sd' ? 'selected' : '' }}>SD</option>
                                            <option value="sltp" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 'sltp' ? 'selected' : '' }}>SLTP</option>
                                            <option value="slta" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 'slta' ? 'selected' : '' }}>SLTA</option>
                                            <option value="diploma" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 'diploma' ? 'selected' : '' }}>Diploma</option>
                                            <option value="s1" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 's1' ? 'selected' : '' }}>S1</option>
                                            <option value="s2" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 's2' ? 'selected' : '' }}>S2</option>
                                            <option value="s3" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 's3' ? 'selected' : '' }}>S3</option>
                                            <option value="lainnya" {{ old('pendidikan_terakhir_wali', $wali->pendidikan_terakhir_wali ?? '') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                        <input class="form-control" type="text" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Masukkan Pekerjaan Wali" value="{{ old('pekerjaan_wali', $wali->pekerjaan_wali ?? '') }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="penghasilan_perbulan_wali" class="form-label">Penghasilan Perbulan</label>
                                        <select id="penghasilan_perbulan_wali" class="select2 form-select" name="penghasilan_perbulan_wali">
                                            <option value="">--Silakan Pilih--</option>
                                            <option value="< 1.500.000" {{ old('penghasilan_perbulan_wali', $wali->penghasilan_perbulan_wali ?? '') === '< 1.500.000' ? 'selected' : '' }}>&lt; 1.500.000</option>
                                            <option value="< 2.500.000" {{ old('penghasilan_perbulan_wali', $wali->penghasilan_perbulan_wali ?? '') === '< 2.500.000' ? 'selected' : '' }}>&lt; 2.500.000</option>
                                            <option value="> 3.500.000" {{ old('penghasilan_perbulan_wali', $wali->penghasilan_perbulan_wali ?? '') === '> 3.500.000' ? 'selected' : '' }}>&gt; 3.500.000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                            <button type="reset" class="btn btn-outline-secondary">CANCEL</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<script>
function togglePrestasiFields() {
    const apakahBerprestasi = document.getElementById('apakah_berprestasi').value;
    const prestasiFields = document.getElementById('prestasi-fields');

    if (apakahBerprestasi === 'iya') {
        prestasiFields.style.display = 'block';
    } else {
        prestasiFields.style.display = 'none';

        document.getElementById('nama_prestasi').value = '';
        document.getElementById('tahun').value = '';
        document.getElementById('penyelenggara').value = '';
        document.getElementById('tingkat').value = '';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    togglePrestasiFields();
});
function toggleAyahFields() {
    const apakahPunyaAyah = document.getElementById('punya_ayah').value;
    const ayahFields = document.getElementById('ayah-fields');

    if (apakahPunyaAyah === 'iya_ayah') {
        ayahFields.style.display = 'block';
    } else {
        ayahFields.style.display = 'none';

        document.getElementById('nama_lengkap_ayah').value = '';
        document.getElementById('tahun_lahir_ayah').value = '';
        document.getElementById('pendidikan_terakhir_ayah').value = '';
        document.getElementById('pekerjaan_ayah').value = '';
        document.getElementById('penghasilan_perbulan_ayah').value = '';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    toggleAyahFields();
});

function toggleIbuFields() {
    const apakahPunyaIbu = document.getElementById('punya_ibu').value;
    const ibuFields = document.getElementById('ibu-fields');

    if (apakahPunyaIbu === 'iya_ibu') {
        ibuFields.style.display = 'block';
    } else {
        ibuFields.style.display = 'none';

        document.getElementById('nama_lengkap_ibu').value = '';
        document.getElementById('tahun_lahir_ibu').value = '';
        document.getElementById('pendidikan_terakhir_ibu').value = '';
        document.getElementById('pekerjaan_ibu').value = '';
        document.getElementById('penghasilan_perbulan_ibu').value = '';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    toggleIbuFields();
});

function toggleWaliFields() {
    const apakahPunyaWali = document.getElementById('punya_wali').value;
    const waliFields = document.getElementById('wali-fields');

    if (apakahPunyaWali === 'iya_wali') {
        waliFields.style.display = 'block';
    } else {
        waliFields.style.display = 'none';

        document.getElementById('nama_lengkap_wali').value = '';
        document.getElementById('tahun_lahir_wali').value = '';
        document.getElementById('pendidikan_terakhir_wali').value = '';
        document.getElementById('pekerjaan_wali').value = '';
        document.getElementById('penghasilan_perbulan_wali').value = '';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    toggleWaliFields();
});



</script>
@endsection
