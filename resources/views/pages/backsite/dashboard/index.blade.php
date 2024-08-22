@extends('layouts.default-dashboard')

@section('title', 'Dashboard')

@section('content')

        @if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('keuangan'))
        <div class="row">
            <div class="col-sm-8 mb-4 order-0">
                <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang Admin 🎉</h5>
                        <p class="mb-4">
                        Mari Terus Pantau Kegiatan <span class="fw-bold">PPDB </span> | SMK Nurul Huda
                        </p>


                    </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                            src="{{ asset('/assets/admin/img/illustrations/man-with-laptop-light.png')}}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                            />
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-4 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img
                        src="{{ asset('/assets/admin/img/icons/unicons/chart-success.png')}}"
                        alt="chart success"
                        class="rounded"
                        />
                    </div>
                    <div class="dropdown">
                        <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        </div>
                    </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">TOTAL PENDAFTAR</span>
                    <h3 class="card-title text-success mb-2 bx bx-up-arrow-alt">{{ $statistik->total_pendaftar }} Orang</h3>
                </div>
                </div>
            </div>
        </div>
        {{-- <h5 class="col-md-12">Pembayaran Biaya Pendaftaran</h5> --}}
        <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img
                                        src="{{ asset('/assets/admin/img/icons/unicons/wallet-info.png')}}"
                                        alt="Credit Card"
                                        class="rounded"
                                        />
                                    </div>
                                    <div class="dropdown">
                                        <button
                                        class="btn p-0"
                                        type="button"
                                        id="cardOpt6"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        >
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <p style="font-size: 14px">SUDAH MELENGKAPI BIODATA</p>
                                <h3 class="card-title text-success mb-1 bx bx-up-arrow-alt">{{ $statistik->sudah_lengkap_biodata }} Orang</h3>
                            </div>
                        </div>
                    </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src="{{ asset('/assets/admin/img/icons/unicons/wallet-info.png')}}"
                                            alt="Credit Card"
                                            class="rounded"
                                            />
                                        </div>
                                        <div class="dropdown">
                                            <button
                                            class="btn p-0"
                                            type="button"
                                            id="cardOpt6"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            >
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size: 14px" >SUDAH MELENGKAPI BERKAS</p>
                                    <h3 class="card-title text-success mb-1 bx bx-up-arrow-alt">{{ $statistik->status_kelulusan_berkas }} Orang</h3>
                                </div>
                            </div>
                        </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img
                                        src="{{ asset('/assets/admin/img/icons/unicons/wallet-info.png')}}"
                                        alt="Credit Card"
                                        class="rounded"
                                        />
                                    </div>
                                    <div class="dropdown">
                                        <button
                                        class="btn p-0"
                                        type="button"
                                        id="cardOpt6"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        >
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>

                                        </div>
                                    </div>
                                </div>
                                <p style="font-size: 14px">SUDAH DAFTAR ULANG</p>
                                <h3 class="card-title text-success mb-1 bx bx-up-arrow-alt">{{ $statistik->sudah_daftar_ulang }} Orang</h3>
                            </div>
                        </div>
                    </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src="{{ asset('/assets/admin/img/icons/unicons/wallet-info.png')}}"
                                            alt="Credit Card"
                                            class="rounded"
                                            />
                                        </div>
                                        <div class="dropdown">
                                            <button
                                            class="btn p-0"
                                            type="button"
                                            id="cardOpt6"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            >
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size: 14px">TOTAL LULUS</p>
                                    <h3 class="card-title text-success mb-1 bx bx-up-arrow-alt">{{ $statistik->total_lulus }} Orang</h3>
                                </div>
                            </div>
                        </div>
        </div>

        <!--Tabel Halaman Dashboard - Program Pilihan  -->
        <div class="card">
            <div class="card-header">
                <div class="card-header border-bottom">
                <h4> Peserta Perprogram </h4>
                {{-- <nav class="mt-3">
                    <div class="pagination justify-content-end">
                        <div style="padding-left: 14px;">
                            <a href="#" class="btn rounded-pill btn-info" >
                                <i class="bx bx-printer" ></i>
                                Cetak
                            </a>
                            <a href="#" class="btn rounded-pill btn-success" >
                                <i class="bx bx-download" ></i>
                                Unduh
                            </a>
                        </div>
                    </div>
                </nav> --}}
                </div>
                <div class="card-header" style="display: flex !important;">
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Program Pilihan</th>
                            <th>Jumlah</th>
                            <th>Lulus</th>
                            <th>Tidak Lulus</th>
                            <th>Sudah Daftar Ulang</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($statistik->peserta_per_jurusan as $row)
                        <tr>
                            <td><i scope="row"></i> <strong>1</strong></td>
                            <td><i class="fa-lg text-danger"></i> <strong>{{$row['nama_jurusan']}}</strong></td>
                            <td class="table-info">{{$row['jumlah']}}</td>
                            <td class="table-success">
                            {{$row['lulus']}}
                            </td>
                            <td class="table-danger">
                            {{$row['tidak_lulus']}}
                            </td>
                            <td class="table-warning">
                            {{$row['sudah_daftar_ulang']}}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- / Tabel Halaman Dasboard - Program Pilihan -->
    @else


                <div class="row">
                    <div class="mb-4 order-0">
                    <div class="card">
                        <div class="align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang {{$peserta->nama_lengkap}} 🎉</h5>
                            <p class="mb-4">
                                Kamu Telah Menyelesaikan Langkah Pertama Untuk <span class="fw-bold">Pendaftaran</span> Segera Selesaikan Tahap-tahapannya dan segera bergabung bersama kami.
                            </p>

                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                            <img
                                src="{{ asset('/assets/admin/img/illustrations/man-with-laptop-light.png')}}"
                                height="140"
                                alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png"
                            />
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" class="f1" style="text-align: center;">
                    <h3>Selesaikan Langkah-Langkah Pendaftaran</h3>
                    <p>Untuk Menjadi Bagian dari Siswa/i SMK Nurul-Huda Sukaraja</p>
                    <div class="f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4" style="width: 25%;"></div>
                        </div>
                        <div class="f1-step" data-step="1">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p class="mt-3">Tahap 1 Buat Akun</p>
                        </div>
                        <div class="f1-step" data-step="2">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p class="mt-3">Tahap 2 Biodata</p>
                        </div>
                        <div class="f1-step" data-step="3">
                            <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                            <p class="mt-3">Tahap 3 Berkas</p>
                        </div>
                        <div class="f1-step" data-step="4">
                            <div class="f1-step-icon"><i class="fa fa-check"></i></div>
                            <p class="mt-3">Tahap 4 Daftar</p>
                        </div>
                    </div>
                    <!-- step 1 -->
                    <fieldset data-step="1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Membuat Akun</h5>
                                <div class="alert alert-success" role="alert">
                                    Selamat anda sudah membuat akun, Silakan melanjutkan ke tahap berikutnya.
                                </div>
                            </div>
                        </div>
                        <div class="f1-buttons mt-3">
                            <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </fieldset>
                    <!-- step 2 -->
                    <fieldset data-step="2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Melengkapi Biodata</h5>
                                @if ($peserta->sudah_lengkap)
                                    <p class="card-text">
                                    Selamat Biodata sudah Lengkap, Anda dapat maju ke langkah selanjutnya.
                                    </p>
                                @else
                                <p class="card-text">
                                    Pastikan biodata Anda lengkap untuk memberikan gambaran yang jelas
                                    tentang siapa Anda. Nama lengkap, tanggal lahir, alamat, kontak, dan pendidikan
                                    adalah informasi yang penting. Dengan demikian, Anda dapat maju ke langkah selanjutnya.
                                </p>
                                <a href="/biodata" class="btn btn-primary">Isi Biodata</a>
                                @endif
                            </div>
                        </div>
                        @if ($peserta->sudah_lengkap)
                        <div class="f1-buttons mt-3">
                            <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                        </div>
                        @else
                        <div class="f1-buttons mt-3">
                            <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next disabled" aria-disabled="true">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                        </div>
                        @endif
                    </fieldset>
                    <!-- step 3 -->
                    <fieldset data-step="3">
                        @if ($peserta->sudah_cek_berkas == true)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mengupload Berkas</h5>
                                <div class="alert alert-success" role="alert">
                                    Selamat Berkas anda sudah Di Verifikasi, Silakan melanjutkan ke tahap berikutnya.
                                </div>
                            </div>
                        </div>
                        <div class="f1-buttons mt-3">
                            <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                        </div>
                        @else
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Mengupload Berkas</h5>
                                <p class="card-text">Unggah berkas yang diperlukan untuk melanjutkan pendaftaran.</p>
                                <a href="/bukti-berkas" class="btn btn-primary">Unggah Berkas</a>
                            </div>
                        </div>
                        <div class="f1-buttons mt-3">
                            <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                            <button type="button" class="btn btn-primary btn-next disabled" aria-disabled="true">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                        </div>
                        @endif
                    </fieldset>
                    <!-- step 4 -->
                    <fieldset data-step="4">
                        @if ($peserta->progres == 'sudah_daftar')
                            @if ($peserta->sudah_lulus == 'lulus')
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Daftar Ulang</h5>
                                    <div class="alert alert-success" role="alert">
                                        Selamat Daftar Ulang Anda Sudah Di terima. Segera Hub Untuk Info Lebih lanjut.
                                    </div>
                                </div>
                            </div>
                            <div class="f1-buttons mt-3">
                                <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                            </div>
                            @else
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Daftar Ulang</h5>
                                    <div class="alert alert-warning" role="alert">
                                        Selamat Pendaftaran Anda Sudah Di terima. Tunggu Pengumuman Lulus daftar Ualng
                                    </div>
                                </div>
                            </div>
                            <div class="f1-buttons mt-3">
                                <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                            </div>
                            @endif
                        @else
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Daftar Ulang</h5>
                                <p class="card-text">Silahkan Daftar Ulang untuk memenuhi beberapa syarat</p>
                                <a href="/daftar-ulang-peserta" class="btn btn-primary">Daftar Ulang</a>
                            </div>
                        </div>
                        <div class="f1-buttons mt-3">
                            <button type="button" class="btn btn-warning btn-previous"><i class="fa fa-arrow-left"></i> Sebelumnya</button>                        </div>
                        @endif
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


@endif
@if(auth()->user()->hasRole('peserta'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil nilai progres dari PHP
        var progres = @json($peserta->progres);

        // Langkah-langkah dalam wizard
        var steps = ['sudah_buat_akun', 'biodata_lengkap', 'berkas_lengkap', 'sudah_daftar'];

        // Tentukan langkah aktif berdasarkan progres
        var activeStep = 0;
        for (var i = 0; i < steps.length; i++) {
            if (progres === steps[i]) {
                activeStep = i + 1;
                break;
            }
            document.querySelector('.f1-step[data-step="' + (i + 1) + '"]').classList.add('activated');
        }
        document.querySelector('.f1-step[data-step="' + activeStep + '"]').classList.add('active');
        document.querySelector('fieldset[data-step="' + activeStep + '"]').classList.add('active');

        // Sembunyikan semua fieldset dan tampilkan hanya yang aktif
        var allFieldsets = document.querySelectorAll('fieldset');
        allFieldsets.forEach(function(fieldset) {
            fieldset.style.display = 'none';
        });
        var activeFieldset = document.querySelector('fieldset[data-step="' + activeStep + '"]');
        if (activeFieldset) {
            activeFieldset.style.display = 'block';
        }

        // Perbarui garis progres
        var progressLine = document.querySelector('.f1-progress-line');
        var numberOfSteps = progressLine.getAttribute('data-number-of-steps');
        var newWidth = (activeStep / numberOfSteps) * 100;
        progressLine.style.width = newWidth + '%';
        progressLine.setAttribute('data-now-value', newWidth);

        // Function to show fieldset based on step number
        function showStep(step) {
            allFieldsets.forEach(function(fieldset) {
                fieldset.style.display = 'none';
            });
            var currentStepFieldset = document.querySelector('fieldset[data-step="' + step + '"]');
            if (currentStepFieldset) {
                currentStepFieldset.style.display = 'block';
            }

            // Update progress bar
            var newWidth = (step / numberOfSteps) * 100;
            progressLine.style.width = newWidth + '%';
            progressLine.setAttribute('data-now-value', newWidth);

            // Update steps classes
            document.querySelectorAll('.f1-step').forEach(function(stepElem) {
                stepElem.classList.remove('active', 'activated');
            });
            for (var i = 1; i < step; i++) {
                document.querySelector('.f1-step[data-step="' + i + '"]').classList.add('activated');
            }
            document.querySelector('.f1-step[data-step="' + step + '"]').classList.add('active');
        }

        // Event listeners for next and previous buttons
        document.querySelectorAll('.btn-next').forEach(function(button) {
            button.addEventListener('click', function() {
                if (activeStep < numberOfSteps) {
                    activeStep++;
                    showStep(activeStep);
                }
            });
        });

        document.querySelectorAll('.btn-previous').forEach(function(button) {
            button.addEventListener('click', function() {
                if (activeStep > 1) {
                    activeStep--;
                    showStep(activeStep);
                }
            });
        });
    });
    </script>
@endif
@endsection
