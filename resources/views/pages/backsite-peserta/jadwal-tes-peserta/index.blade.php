@extends('layouts.default-dashboard')

@section('title', 'Jadwal Peserta')

@section('content')
<h1 class="h3 mb-1 text-gray-800">Jadwal Tes</h1>
<p class="mb-4">Jadwal tes ujian masuk SMK Nurul Huda</p>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow">
            <div class="card-body">
                @if ($jadwal && $pembayaran && $pembayaran->status_konfirmasi == 'diterima')
                    <p class="mb-0">Tanggal Ujian</p>
                    @if($peserta->sudah_tes)
                        <h5 class="mb-3 font-weight-bold">Selamat Anda Lulus</h5>
                    @else
                        @if ($jadwal)
                            <h5 class="mb-3 font-weight-bold">{{ \Carbon\Carbon::parse($jadwal['tanggal'])->isoFormat('dddd, D MMMM Y') }} WIB</h5>
                        @else
                            <h5 class="mb-3 font-weight-bold">Mohon tunggu pengumuman dari Panitia.</h5>
                        @endif
                    @endif
                @else
                    @if (! $peserta->sudah_lengkap)
                    <div class="alert alert-warning">
                        <strong>Anda belum melengkapi biodata. Silahkan melengkapi <a href="/biodata/edit">Biodata</a> terlebih dahulu</strong>
                    </div>
                    @endif

                    @if ($pembayaran)
                        @if ($pembayaran->status_konfirmasi == "proses")
                        <div class="alert alert-info">
                            <strong>Bukti Pembayaran sedang tahap verifikasi</strong>
                        </div>
                        @else
                        <div class="alert alert-danger">
                            <strong>Bukti pembayaran anda ditolak. Silahkan <a href="/bukti-pendaftaran">upload ulang bukti pembayaran</a></strong>
                        </div>
                        @endif
                    @else
                    <div class="alert alert-warning">
                        <strong>Anda belum <a href="/bukti-pendaftaran">upload bukti pembayaran</a> </strong>
                    </div>
                    @endif
                @endif

                @if ($peserta->lokasi_ujian == "Kampus A")
                    <hr />
                    <p class="mb-0">Lokasi</p>
                    <h5 class="mb-3 font-weight-bold">Kampus A</h5>

                    <p class="mb-0">Alamat</p>
                    <h5 class="mb-3 font-weight-bold">Jl. Kotabaru Sukaraja Kec. Buay Madang</h5>
                @endif

                @if ($peserta->lokasi_ujian == "Kampus C")
                    <hr />
                    <p class="mb-0">Lokasi</p>
                    <h5 class="mb-3 font-weight-bold">Kampus C</h5>

                    <p class="mb-0">Alamat</p>
                    <h5 class="mb-3 font-weight-bold">Jl. Tanah Merah Jembatan 2, Tanah Merah, Belitang Madang Raya, OKU Timur</h5>
                @endif

                <hr />
                <h3>Lokasi Ujian</h3>
                <form class="needs-validation" novalidate action="/set-lokasi-ujian" method="post">
                    @csrf
                <div class="form-group row">
                    <label class="col-md-2">Pilih Lokasi Tes</label>
                    <div class="col-md-4">
                        <select class="form-control" name="lokasi_ujian" required>
                            <option {{ !$peserta->lokasi_ujian ? "selected" : ""}} value="" disabled>-- Pilih --</option>
                            <option {{ $peserta->lokasi_ujian == "Kampus A" ? "selected" : ""}} value="Kampus A">Kampus A (Sukaraja)</option>
                            <option {{ $peserta->lokasi_ujian == "Kampus C" ? "selected" : ""}} value="Kampus C">Kampus C (Tanah Merah)</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
