@extends('layouts.default-dashboard')

@section('title', 'Biodata Peserta')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
        <div class="user-profile-header-banner">
            <img src="{{ asset('/assets/images/profile-banner.png')}}" alt="Banner image" class="rounded-top">
        </div>
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                @if ($peserta->foto)
                <img src="{{ asset('/storage/peserta/'.$peserta->foto) }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                @else
                <img src="{{ asset('/assets/admin/img/avatars/default-profil.jpg')}}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                @endif
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                    <div class="user-profile-info">
                    <h4 class="font-weight-bold">{{ $peserta->nama_lengkap }}</h4>
                    <ul class="list-inline mb-2 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                        <li class="list-inline-item fw-medium font-weight-bold">
                        <i class=""></i> No Pendaftaran
                        </li>
                        <li class="list-inline-item fw-medium">
                        <i class=""></i> {{ $peserta->no_pendaftaran}}
                        </li>
                    </ul>
                    </div>
                    <div class="align-self-center">
                        <a href="/biodata/edit" class="btn btn-primary text-nowrap">
                            <i class="bx bx-user-check me-1"></i>Update Biodata
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="nav-align-top">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">Info Daftar</button>
        </li>
        <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Informasi Pribadi</button>
        </li>
        <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-alamat" aria-controls="navs-top-alamat" aria-selected="false">Alamat</button>
        </li>
        <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-data-lainya" aria-controls="navs-top-data-lainya" aria-selected="false">Data Lainya</button>
        </li>
        <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-catatan-prestasi" aria-controls="navs-top-catatan-prestasi" aria-selected="false">Jejak Prestasi</button>
        </li>
        <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-biodata-ortu" aria-controls="navs-top-catatan-prestasi" aria-selected="false">Orang Tua</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">Nama Lengkap</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->nama_lengkap }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">No Pendaftaran</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_pendaftaran }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Tanggal Pendaftaran</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->created_at }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Jurusan Pilihan</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->jurusan->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">NISN</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->nisn }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">NIS</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->nis }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">No HP</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_hp }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Email</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Tanggal Lahir</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->tanggal_lahir }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Jenis Kelamin</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->jenis_kelamin }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Agama</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->agama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Alamat Lengkap</div>
                        <div class="col-7 font-weight-bold">: {{$peserta->alamat_lengkap}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">NIK</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->nik }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">NISN</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->nisn }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Nis</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->nis }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Asal Sekolah</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->asal_sekolah }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">No Seri Ijazah SMP/MTs</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_seri_ijazah_smp ?? '' }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">No Seri SHUN SMP/MTs</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_seri_shun_smp ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">No Ujian SMP/MTs</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_ujian_smp ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">No HP</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_hp ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">No HP Orang Tua</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_hp_ortu ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">No Akte Kelahiran</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->no_akte_kelahiran ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-top-alamat" role="tabpanel">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">Dusun</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->dusun ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Kelurahan</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->kelurahan ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Kecamatan</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->kecamatan ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Kabupaten/Kota</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->kabupaten ?? '' }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">Provinsi</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->provinsi ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Kode Pos</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->kode_pos ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Alat Transportasi</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->alat_tranportasi_kesekolah ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Jenis Tinggal</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->jenis_tinggal ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-top-data-lainya" role="tabpanel">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">Apakah Sebagai Penerima KPS/PIP</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->penerima_kps_pip ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">No KPS/PIP </div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->nomor_kps_pip ?? '' }} </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Tinggi badan</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->tinggi_badan ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5"> Berat Badan </div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->berat_badan ?? '' }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-5">Jumlah Saudara Kandung</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->jumlah_saudara ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Jarak Tempat Tinggal ke Sekolah</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->jarak_tempat_tinggal_kesekolah ?? '' }} </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Waktu Tempuh</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->waktu_tempat_berangkat_kesekolah ?? '' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">E-mail pribadi</div>
                        <div class="col-7 font-weight-bold">: {{ $peserta->email ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-top-catatan-prestasi" role="tabpanel">
            @foreach ($peserta->catatan_prestasi as $prestasi)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5"> Tingkat </div>
                            <div class="col-7 font-weight-bold">: {{ $prestasi->tingkat }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5"> Nama Prestasi </div>
                            <div class="col-7 font-weight-bold">: {{ $prestasi->nama_prestasi }} </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5"> Tahun </div>
                            <div class="col-7 font-weight-bold">: {{ $prestasi->tahun }} </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5"> Penyelenggara </div>
                            <div class="col-7 font-weight-bold">: {{ $prestasi->penyelenggara }} </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tab-pane fade" id="navs-top-biodata-ortu" role="tabpanel">
            <h6 class="border-bottom"> Ayah Kandung </h6>
            @foreach ($peserta->namaAyah as $ayah)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5">Nama Lengkap</div>
                            <div class="col-7 font-weight-bold">: {{ $ayah->nama_lengkap_ayah }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Tahun Lahir</div>
                            <div class="col-7 font-weight-bold">: {{ $ayah->tahun_lahir_ayah }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Pendidikan Terakhir</div>
                            <div class="col-7 font-weight-bold">: {{ $ayah->pendidikan_terakhir_ayah }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5">Pekerjaan</div>
                            <div class="col-7 font-weight-bold">: {{ $ayah->pekerjaan_ayah }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Penghasilan Perbulan</div>
                            <div class="col-7 font-weight-bold">: {{ $ayah->penghasilan_perbulan_ayah }}</div>
                        </div>
                    </div>
                </div>
            @endforeach

            <h6 class="border-bottom"> Ibu Kandung </h6>
            @foreach ($peserta->namaIbu as $ibu)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5">Nama Lengkap</div>
                            <div class="col-7 font-weight-bold">: {{ $ibu->nama_lengkap_ibu }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Tahun Lahir</div>
                            <div class="col-7 font-weight-bold">: {{ $ibu->tahun_lahir_ibu }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Pendidikan Terakhir</div>
                            <div class="col-7 font-weight-bold">: {{ $ibu->pendidikan_terakhir_ibu }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5">Pekerjaan</div>
                            <div class="col-7 font-weight-bold">: {{ $ibu->pekerjaan_ibu }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Penghasilan Perbulan</div>
                            <div class="col-7 font-weight-bold">: {{ $ibu->penghasilan_perbulan_ibu }}</div>
                        </div>
                    </div>
                </div>
            @endforeach


            <h6 class="border-bottom"> Nama Wali </h6>
            @foreach ($peserta->namaWali as $wali)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5">Nama Lengkap</div>
                            <div class="col-7 font-weight-bold">: {{ $wali->nama_lengkap_wali }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Tahun Lahir</div>
                            <div class="col-7 font-weight-bold">: {{ $wali->tahun_lahir_wali }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Pendidikan Terakhir</div>
                            <div class="col-7 font-weight-bold">: {{ $wali->pendidikan_terakhir_wali }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-5">Pekerjaan</div>
                            <div class="col-7 font-weight-bold">: {{ $wali->pekerjaan_wali }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-5">Penghasilan Perbulan</div>
                            <div class="col-7 font-weight-bold">: {{ $wali->penghasilan_perbulan_wali }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop
