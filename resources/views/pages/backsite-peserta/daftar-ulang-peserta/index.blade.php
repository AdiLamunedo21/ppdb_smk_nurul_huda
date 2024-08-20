@extends('layouts.default-dashboard')

@section('title', 'Daftar Ulang')

@section('content')

<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">SYARAT DAFTAR ULANG</li>
                        <li class="list-group-item">1. Bersedia bertempat tinggal di asrama</li>
                        <li class="list-group-item">2. Mengisi Formulir Pendaftaran</li>
                        <li class="list-group-item">3. Foto KopiIjazah dan Legalisir 3 lembar</li>
                        <li class="list-group-item">4. Pas Foto Terbaru 3x4 cm 3 lembar </li>
                        <li class="list-group-item">5. Foto kopi kartu keluarga</li>
                        <li class="list-group-item">6. Foto kopi KTP Orang Tua</li>
                        <li class="list-group-item">7. Surat Keterangan Lulus dari sekolah Asal</li>
                </ul>
                @if($peserta->sudah_lulus == null|| $peserta->sudah_lulus == 'belum')
                <form action="/daftar-ulang-peserta" method="post" class="d-flex justify-content-between align-items-center mt-4 ml-1">
                    @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="sudah_lulus" name="sudah_lulus" value="proses">
                        <input class="form-control" type="hidden" id="nisn" name="nisn" value="{{$peserta->nisn}}" required>
                        <input class="form-control" type="hidden" id="nama_lengkap" name="nama_lengkap" value="{{$peserta->nama_lengkap}}" required>
                        <label class="form-check-label custom-checkbox-label" for="agreement">
                            Saya Setuju Mengikuti Proses Untuk daftar
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success">SUBMIT</button>
                </form>
                @elseif($peserta->sudah_lulus == 'proses')
                <div class="d-flex justify-content-between align-items-center mt-4 ml-3">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label custom-checkbox-label" for="agreement">
                            Download Form Pendaftaran anda
                        </label>
                    </div>
                    <a href="your_image_url" download class="btn btn-success">
                        <i class="fa fa-download"></i> Unduh
                    </a>
                </div>
                @elseif($peserta->sudah_lulus == 'lulus')
                <div class="d-flex justify-content-between align-items-center mt-4 ml-3">
                    <h5 class="card-title">Progres</h5>
                    <div class="alert alert-success" role="alert">
                        Selamat Anda Dinyatakan Lulus
                    </div>
                </div>
                @endif
        </div>
    </div>
</div>

@stop
