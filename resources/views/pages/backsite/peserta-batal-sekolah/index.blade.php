@extends('layouts.default-dashboard')

@section('title', 'Peserta Batal Sekolah')

@section('content')
<h1 class="h3 mb-1 text-gray-800">Peserta Batal Kuliah</h1>

<div class="row">
    <div class="col-md-12">

        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="pesertaBatalSekolah" width="100%" cellspacing="0" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Jalur</th>
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
@stop
