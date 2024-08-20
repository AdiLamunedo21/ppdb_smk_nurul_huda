@extends('layouts.default-dashboard')

@section('title', 'Daftar Peserta')

@section('content')

<div class="row">
    <div class="col-md-10">
        <h1 class="h3 mb-1 text-gray-800">Daftar Peserta PMB</h1>
        <p class="mb-4">Semua peserta PMB</p>
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
            <div class="card-body">
                <form action="" method="get">
                <div class="form-group row">
                    <label class="col-md-3 my-auto">Sekolah</label>
                    <div class="col-md-5">
                        <select class="form-control" id="kecamatan" name="asal_sekolah" data-live-search="true" onchange="this.form.submit()">
                            <option value="" disabled selected>--Pilih--</option>
                            @if(count($sekolah) > 0)
                                @foreach($sekolah as $key => $val)
                                <option data-tokens="{{ $val->asal_sekolah }}" {{ $nama_sekolah && $nama_sekolah == $val->asal_sekolah ? "selected" : ""}} value="{{$val->asal_sekolah}}">{{$val->asal_sekolah}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                    <a href="/peserta" class="btn btn-info">Reset</a>
                    <a href="/excel/peserta{{ $nama_sekolah ? '?asal_sekolah='.$nama_sekolah : ''}}" class="btn btn-success ml-2">Download</a>
                    </div>
                </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered" id="pesertaTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Asal Sekolah</th>
                                <th>Progres Daftar</th>
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
    var filter_sekolah = "{{ $nama_sekolah }}"
    var filter_nama_sekolah = filter_sekolah ? "&asal_sekolah="+String(filter_sekolah) : null

    var filter_tahun = "{{ $tahun }}"
    var filter_data_tahun = filter_tahun ? "&tahun="+String(filter_tahun) : ""
</script>

@endsection
