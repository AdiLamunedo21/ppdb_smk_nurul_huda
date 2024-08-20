@extends('layouts.default-dashboard')

@section('title', 'Status Konfirmasi Berkas')

@section('content')
<div class="rows">
    <div class="col-md-10">
        <h1 class="h3 mb-1 text-gray-800">Status Pembayaran</h1>
        <p class="mb-4">Pembayaran biaya pendaftaran calon siswa baru</p>
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

<div class="rows">
    <div class="col-md-12">

        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="berkasIjazahTable" width="100%" cellspacing="0" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>Nama</th>
                                <th>Tgl Daftar</th>
                                <th>Ijazah</th>
                                <th>Konfirmasi</th>
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
    var filter_tahun = "{{ $tahun }}"
    var filter_data_tahun = filter_tahun ? "&tahun="+String(filter_tahun) : ""
</script>
@stop
