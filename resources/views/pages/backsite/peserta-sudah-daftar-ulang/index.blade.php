@extends('layouts.default-dashboard')

@section('title', 'Peserta Sudah Daftar Ulang')

@section('content')
<h1 class="h3 mb-1 text-gray-800">Peserta Sudah Daftar Ulang</h1>
<p class="mb-4">Daftar peserta lulus untuk jalur umum dan prestasi</p>

<div class="row">
    <div class="col-md-12">

        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="pesertaDaftarUlang" width="100%" cellspacing="0" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Status Lulus</th>
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
<script>
    var user_keu = {{ auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('keuangan') ? true : false }}
</script>
@stop
