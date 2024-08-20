@extends('layouts.default-dashboard')

@section('title', 'Daftar Siswa')

@section('content')
<h1 class="h3 mb-1 text-gray-800">Daftar Siswa</h1>
<p class="mb-4">Daftar peserta lulus untuk jalur umum dan prestasi</p>

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
                    <a href="/siswa" class="btn btn-info">Reset</a>
                    <a href="/excel/siswa{{ $jurusan_id ? '?jurusan_id='.$jurusan_id : ''}}" class="btn btn-success ml-2">Download</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="siswaTable" width="100%" cellspacing="0" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
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
    var filter_jurusan_s = {{ $jurusan_id }}
    var filter_data_s = filter_jurusan_s ? "?jurusan_id="+filter_jurusan_s : null
</script>
@stop
