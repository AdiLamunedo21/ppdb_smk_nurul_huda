@extends('layouts.default-dashboard')

@section('title', 'Upload Berkas Pribadi')

@section('content')

<div id="alert-container"></div>

<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link" href="/bukti-berkas"><i class="bx bx-user me-1"></i>Berkas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/berkas/upload"><i class="bx bx-edit me-1"></i>Upload Berkas</a>
    </li>
</ul>

<div class="accordion" id="accordionExample">
    <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne" role="tabpanel">
                Upload Foto Ijazah
            </button>
        </h2>

        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <form id="uploadForm" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" class="form-control" id="foto-ijazah" name="foto-ijazah" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-primary" type="submit" id="upload-button">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo" role="tabpanel">
                Upload Foto Surat Keterangan Lulus
            </button>
        </h2>

        <div id="accordionTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <form id="uploadForm2" method="POST" enctype="multipart/form-data" action="/berkas/upload-sk-lulus">
                    @csrf
                    <div class="input-group">
                        <input type="file" class="form-control" id="foto-sk-lulus" name="foto-sk-lulus" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-primary" type="submit" id="upload-button">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@stop
