@extends('layouts.default-dashboard')

@section('title', 'Daftar Peserta Lulus')

@section('content')
<div class="row">
    <div class="col-md-10">
        <h1 class="h3 mb-1 text-gray-800">Daftar Peserta Lulus</h1>
        <p class="mb-4">Daftar peserta lulus untuk jalur umum dan prestasi</p>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <form action="" method="get">
                <select class="form-control" name="tahun" onchange="this.form.submit()">
                    @foreach($daftar_tahun as $val)
                    <option {{ $tahun && $tahun == $val->tahun ? "selected" : ""}} value="{{ $val->tahun }}">{{ $val->tahun }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card border-0 shadow">
            <div class="card-header border-0 bg-white pb-0">
                <div class="rows">
                    <div class="col-md-3">
                        <form method="get" action="">
                            <select class="form-control" name="jurusan_id" onchange="this.form.submit()">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusan as $val)
                                <option {{ $jurusan_id && $jurusan_id == $val->jurusan_id ? "selected" : ""}} value="{{ $val->jurusan_id }}">{{ $val->nama }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <a href="/peserta-lulus" class="btn btn-info">Reset</a>
                    <a href="/excel/peserta-lulus-daftar-ulang{{ $jurusan_id ? '?jurusan_id='.$jurusan_id : ''}}{{ $gelombang_id ? '?gelombang_id='.$gelombang_id : ''}}" class="btn btn-success ml-2">Download</a>
                    <div class="btn-group ml-auto" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="/excel/peserta-lulus?sudah_lulus=lulus" target="_blank">Lulus Daftar Ulang</a>
                            <a class="dropdown-item" href="/excel/peserta-lulus" target="_blank">Sudah Daftar Ulang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="pesertaLulusTable" width="100%" cellspacing="0" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>Nama</th>
                                <th>Nisn</th>
                                <th>Jurusan Pilihan</th>
                                <th>Daftar Ulang</th>
                                <th>Status Berkas</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var user_keu = Boolean({{ auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('keuangan') ? true : false }});
    var filter_jurusan = "{{ $jurusan_id }}";
    var filter_data = filter_jurusan ? "&jurusan_id="+filter_jurusan : null;
    var filter_tahun = "{{ $tahun }}";
    var filter_data_tahun = filter_tahun ? "&tahun="+String(filter_tahun) : "";
    var filter_gelombang = "{{ $gelombang_id }}";
    var filter_data_gelombang = filter_gelombang ? "&gelombang_id="+filter_gelombang : "";
</script>
@stop
