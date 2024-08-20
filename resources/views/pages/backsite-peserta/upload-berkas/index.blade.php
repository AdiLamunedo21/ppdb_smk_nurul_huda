@extends('layouts.default-dashboard')

@section('title', 'Berkas Pribadi')

@section('content')

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="/bukti-berkas"><i class="bx bx-user me-1"></i>Berkas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/bukti-berkas/upload"><i class="bx bx-edit me-1"></i>Upload Berkas</a>
            </li>
        </ul>
        <div class="card">
            <!-- Notifications -->
            <h3 class="card-header">Berkas Pribadi</h3>
            <div class="table-responsive" style="padding: 1rem">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Berkas</th>
                            <th>Status</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Berkas Ijazah</td>
                            <td>
                                @if ($ijazah && $ijazah->status_konfirmasi == 'diterima')
                                    <span class="badge bg-label-success me-1">Diterima</span>
                                @elseif ($ijazah && $ijazah->status_konfirmasi == 'proses')
                                    <span class="badge bg-label-warning me-1">Masih Proses</span>
                                @else
                                    <span class="badge bg-label-primary me-1">Belum Upload</span>
                                @endif
                            </td>
                            <td>
                                @if ($ijazah)
                                    <a href="{{ asset('/storage/ijazah/' . $ijazah->ijazah) }}" target="blank">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                @else
                                    <span>Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Surat Keterangan Lulus</td>
                            <td>
                                @if ($sk_lulus && $sk_lulus->status_konfirmasi == 'diterima')
                                    <span class="badge bg-label-success me-1">Diterima</span>
                                @elseif ($sk_lulus && $sk_lulus->status_konfirmasi == 'proses')
                                    <span class="badge bg-label-warning me-1">Masih Proses</span>
                                @else
                                    <span class="badge bg-label-primary me-1">Belum Upload</span>
                                @endif
                            </td>
                            <td>
                                @if ($sk_lulus)
                                    <a href="{{ asset('/storage/sklulus/' . $sk_lulus->sk_lulus) }}" target="blank">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                @else
                                    <span>Belum Upload</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /Notifications -->
        </div>
    </div>
</div>

{{-- <!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Lihat Berkas</h5>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <img id="modalImage" src="" alt="Berkas" class="img-fluid">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
        </div>
    </div>
</div> --}}

@stop
