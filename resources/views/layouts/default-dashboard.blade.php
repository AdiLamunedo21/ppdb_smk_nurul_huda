<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('/assets/admin/')}}"
    data-template="vertical-menu-template-free"
>
<head>
    <!-- Required meta tags -->
    @include('includes.backsite.meta')
    <title>Dashboard</title>
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- plugins:css -->
    @include('includes.backsite.style')
</head>
<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
    <!-- Menu -->
            @include('component.backsite.menu')
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar header -->
            @include('component.backsite.header')
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{session('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

            @yield('content')
        </div>
        </div>
        <!-- / Content -->
        <!-- Footer -->

            @include('component.backsite.footer')
<!-- / Footer -->

        <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
    {{-- wa --}}
    @include('component.backsite.wa')
    {{-- wa-end --}}
    <!-- plugins:js -->
@include('includes.backsite.script')
<!-- End custom js for this page-->
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Apakah Anda Yakin Menghapus Data Ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="data-title font-weight-bold"></h5>
                    <form id="formDelete" action="" method="post">
                        @csrf
                        <input type="hidden" id="deleteId" name="" value="" required />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" id="submitFormDelete">Ya</button>
                </div>
                </div>
            </div>
        </div>
</body>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/datatables-demo.js?v=1.7.6') }}"></script>

    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('vendor/chart.js/Chart.min.js?v=1.0.0') }}"></script>
    <script src="{{ asset('assets/admin/js/chart-pie-demo.js?v=1.0.0') }}"></script>

    <script src="{{ asset('assets/admin/js/admin-pmb.js?v=1.0.0') }}"></script>

    <script src="{{ asset('assets/admin/js/wizard.js') }}"></script>

    <script>

        $(document).ready(function(){
            $("#alertsDropdown").click(function() {
                markAsRead();
            });

            function markAsRead() {
                $.ajax({
                    url: "/notifikasi/sudah-dibaca",
                    success: function() {
                        var currentNotifNum = parseInt($("#notifNum").text());
                        if (currentNotifNum > 1) {
                            $("#notifNum").text(currentNotifNum - 1);
                        } else {
                            $("#notifNum").text(0);
                        }
                    },
                    error: function(err){
                        console.log(err);
                    }
                });
            }

            const intervalNotif = setInterval(function(){
                notifikasi();
            }, 30000);

            function notifikasi() {
                $.ajax({
                    url: "/notifikasi",
                    success: function(result) {
                        var numNotif = result.length;
                        $("#notifNum").text(numNotif);

                        $("#notifList").empty();
                        $("#notifList").append($("<h6>", {class: "dropdown-header"}).text("Pemberitahuan"));

                        if (numNotif > 0) {
                            result.forEach((elem, index) => {
                                var link = elem.data.link ? elem.data.link : "#";
                                var message = elem.data.message ? elem.data.message : "Notifikasi baru";

                                $("#notifList").append(
                                    $("<a>", {class: "dropdown-item d-flex align-items-center", 'href' : link }).append([
                                        $("<div>", {class: "mr-3"}).append(
                                            $("<div>", {class : "icon-circle bg-primary"}).append(
                                                $("<i>", {class: "fas fa-file-alt text-white"})
                                            )
                                        ),
                                        $("<div>").append([
                                            $("<div>", {class: "small text-gray-500"}).text(elem.created_at),
                                            $("<span>", {class: "font-weight-bold"}).text(message),
                                        ]),
                                    ]).click(function() {
                                        // Kurangi jumlah notifikasi jika link diklik
                                        var currentNotifNum = parseInt($("#notifNum").text());
                                        if (currentNotifNum > 1) {
                                            $("#notifNum").text(currentNotifNum - 1);
                                        } else {
                                            $("#notifNum").text(0);
                                        }
                                    })
                                );
                            });
                        } else {
                            $("#notifList").append($("<span>", {class: "dropdown-item text-muted"}).text("Tidak ada notifikasi baru"));
                        }
                    },
                    error: function(err){
                        console.log(err);
                    }
                });
            }

            $("#logout").click(function() {
                stopNotif();
            });

            function stopNotif() {
                clearInterval(intervalNotif);
            }
        });

        (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);

        // Pilih kecamatan
        // $('#pendamping_id_select').selectpicker();

        $('.select-search').selectpicker();

        $("#kabupaten").change(function() {
            var kabupatenId = $(this).val()
            $.ajax({
                url : "/daftar-kecamatan/" + kabupatenId,
                success : function(result) {
                    $("#kecamatan").empty()
                    $("#kecamatan").append("<option value='' disabled selected>-- Pilih Kecamatan --</option>")
                    $.each( result.data, function(key, value) {
                        $("#kecamatan").append("<option data-tokens='"+value.nama+"' value='"+value.kecamatan_id+"'>"+value.nama+"</option>")
                    })

                }
            })
        })

        $("#submitFormDelete").click(function(){
            $("#formDelete").submit();
        });

        })();

        $(document).ready(function() {
        // Ketika pilihan kecamatan berubah
        $("#kecamatan").change(function() {
            // Ambil nilai kecamatan yang dipilih
            var kecamatanId = $(this).val();

            // Jika kecamatan terpilih, isi otomatis Provinsi menjadi "Sumatera Selatan"
            if (kecamatanId) {
                $("#provinsi").val("Sumatera Selatan");
            }
        });
    });

$(document).ready(function() {
    $('#uploadForm').submit(function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: '/berkas/upload-ijazah',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                showAlert('success', response.success);
            } else if (response.error) {
                showAlert('danger', response.error);
            }
        },
        error: function(response) {
            console.error(response);
            if (response.responseJSON && response.responseJSON.errors) {
                var errors = response.responseJSON.errors;
                if (errors['foto-ijazah']) {
                    showAlert('danger', errors['foto-ijazah'][0]);
                } else {
                    showAlert('danger', 'Upload gagal!');
                }
            } else {
                showAlert('danger', 'Upload gagal!');
            }
        }
    });
});


    function showAlert(type, message) {
        var alertBox = '<div class="alert alert-' + type + '">' + message + '</div>';
        $('#alert-container').html(alertBox);
    }

    $('#uploadForm2').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '/berkas/upload-sk-lulus',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.success);
                } else if (response.error) {
                    showAlert('danger', response.error);
                }
            },
            error: function(response) {
                console.error(response);
                if (response.responseJSON && response.responseJSON.errors) {
                    var errors = response.responseJSON.errors;
                    if (errors['foto-sk-lulus']) {
                        showAlert('danger', errors['foto-sk-lulus'][0]);
                    } else {
                        showAlert('danger', 'Upload gagal!');
                    }
                } else {
                    showAlert('danger', 'Upload gagal!');
                }
            }
        });
    });

    function showAlert(type, message) {
        var alertBox = '<div class="alert alert-' + type + '">' + message + '</div>';
        $('#alert-container').html(alertBox);
    }
});

    </script>

</html>
