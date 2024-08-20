// Call the dataTables jQuery plugin
    $(document).ready(function() {
        var filter_peserta_lulus = ""
        if (typeof(filter_data) !== "undefined")
        {
            filter_peserta_lulus = filter_data
        }

        var filter_asal_sekolah = ""
        if (typeof(filter_nama_sekolah) !== "undefined" && filter_nama_sekolah !== null)
        {
            filter_asal_sekolah = filter_nama_sekolah
        }

        var filter_siswa = ""
        if (typeof(filter_data_s) !== "undefined")
        {
            filter_siswa = filter_data_s
        }

        var filter_tahun_daftar = ""
        if (typeof(filter_data_tahun) !== "undefined")
        {
            filter_tahun_daftar = filter_data_tahun
        }

        var filter_gelombang_id = ""
        if (typeof(filter_data_gelombang) !== "undefined")
        {
            filter_gelombang_id = filter_data_gelombang
        }

    // $('#stepPesertaTable').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax : '/dashboard/json?filter=0',
    //     columns: [
    //         { data: 'no_pendaftaran', name: 'no_pendaftaran' },
    //         { data: 'nama_lengkap', name: 'nama_lengkap' },
    // ]
    // });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



    $('#pesertaTable').DataTable({
        processing: true,
        serverSide: true,
        ajax : '/peserta/json?filter=0' + filter_asal_sekolah + filter_tahun_daftar,
        order: [[0, 'desc']],
        columns: [
        { data: 'no_pendaftaran', name: 'no_pendaftaran' },
        { data: 'nama_lengkap', name: 'nama_lengkap' },
        { data: 'jurusan.nama', name: 'jurusan.nama' },
        { data: 'asal_sekolah', name: 'asal_sekolah' },
        // { data: 'pembayaran.status'},
        { data: 'progres',
            orderable: true,
            name: 'progres',
            render: function(data) {
                let status_daftar = '';
                let badge_daftar = 'badge-dark';

                if (data === 'sudah_buat_akun') {
                    status_daftar = 'Sudah Membuat Akun';
                    badge_daftar = 'badge-info';
                } else if (data === 'biodata_lengkap') {
                    status_daftar = 'Biodata Lengkap';
                    badge_daftar = 'badge-success';
                } else if (data === 'berkas_lengkap') {
                    status_daftar = 'Berkas Lengkap';
                    badge_daftar = 'badge-success';
                } else if (data === 'sudah_daftar') {
                    status_daftar = 'Sudah daftar Ulang';
                    badge_daftar = 'badge-success';
                } else {
                    status_daftar = 'Belum ada';
                    badge_daftar = 'badge-warning';
                }

                return '<span class="badge ' + badge_daftar + '">' + status_daftar + '</span>';
            }
        },

        { data: null, orderable : false, render: function(data) {
            let btn = '<a href="/peserta/edit/'+ data.peserta_id +'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> <a href="https://wa.me/'+ data.no_wa +'" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>';
            btn += '<button type="button" class="btn btn-sm btn-danger ml-2 btn-delete" data-id="'+data.peserta_id+'" data-name="'+data.nama_lengkap+'" onclick="delete_peserta(this);"><i class="fa fa-trash"></i></a>';
            return btn;
        } },
        ]
    });

    $('#berkasIjazahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/status-ijazah/json?filter=0' + filter_tahun_daftar,
                order: [[5, 'desc']],
                columns: [
                    { data: 'peserta.no_pendaftaran', name: 'peserta.no_pendaftaran' },
                    { data: 'peserta.nama_lengkap', name: 'peserta.nama_lengkap' },
                    { data: 'peserta.created_at', name: 'peserta.created_at', render: function(data) {
                        var dataTgl = new Date(data)
                        var d = dataTgl.getDate()
                        d = parseInt(d) < 10 ? "0" + d : d

                        var m = parseInt(dataTgl.getMonth()) + 1
                        m = m < 10 ? "0" + m : m

                        var y = dataTgl.getFullYear()

                        var tgl = d + "-" + m + "-" + y

                        return '<span>' + tgl + '</span>'
                    }},
                    { data: 'path_ijazah', orderable: false, render: function(data) {
                        return '<a href="' + data + '" target="_blank"><i class="fas fa-file-alt"></i></a>'
                    }},
                    { data: null, name: 'status_konfirmasi', render: function(data) {
                        var prosesSelected = data.status_konfirmasi == "proses" ? "selected" : ""
                        var diterimaSelected = data.status_konfirmasi == "diterima" ? "selected" : ""
                        var ditolakSelected = data.status_konfirmasi == "ditolak" ? "selected" : ""

                        var token = $('meta[name="csrf-token"]').attr('content');

                        var elem = '<form action="/status-konfirm-ijazah" method="post">'
                        elem += '<select class="form-control form-control-sm" name="status_konfirmasi" onchange="this.form.submit()">'
                        elem += '<option ' + prosesSelected + ' value="proses">-- Pilih --</option>'
                        elem += '<option ' + diterimaSelected + ' value="diterima">Diterima</option>'
                        elem += '<option ' + ditolakSelected + ' value="ditolak">Ditolak</option>'
                        elem += '</select>'
                        elem += '<input type="hidden" name="ijazah_id" value="'+data.ijazah_id+'">'
                        elem += '<input type="hidden" name="_token" value="'+token+'">'
                        elem += '</form>'

                        return elem
                    }},
                    { data: null, orderable: false, render: function(data) {
                        return '<a href="https://wa.me/' + data.peserta.no_wa + '" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>'
                    }},
                ]
            });

    $('#berkasSkLulusTable').DataTable({
        processing: true,
        serverSide: true,
        ajax : '/status-sk-lulus/json?filter=0' + filter_tahun_daftar,
        order: [[5, 'desc']],
        columns: [
            { data: 'peserta.no_pendaftaran', name : 'peserta.no_pendaftaran'},
            { data: 'peserta.nama_lengkap', name : 'peserta.nama_lengkap'},
            { data: 'peserta.created_at', name: 'peserta.created_at', render: function(data) {
                var dataTgl = new Date(data);
                var d = dataTgl.getDate();  // Perbaikan, harusnya getDate bukan getDay
                d = parseInt(d) < 10 ? "0" + d : d;

                var m = parseInt(dataTgl.getMonth()) + 1;
                m = m < 10 ? "0" + m : m;

                var y = dataTgl.getFullYear();

                var tgl = d + "-" + m + "-" + y;

                return '<span>' + tgl + '</span>';
            }},
            { data: 'path_sk_lulus', orderable : false, render: function(data) {
                return '<a href="' + data + '" target="_blank"><i class="fas fa-file-alt"></i></a>';
            }},
            { data: null, name: 'status_konfirmasi', render : function(data) {
                if (!data || !data.status_konfirmasi) {
                    return '<span>Tidak Ada Data</span>';
                }

                var prosesSelected = data.status_konfirmasi == "proses" ? "selected" : "";
                var diterimaSelected = data.status_konfirmasi == "diterima" ? "selected" : "";
                var ditolakSelected = data.status_konfirmasi == "ditolak" ? "selected" : "";

                var token = $('meta[name="csrf-token"]').attr('content');  // Ambil token CSRF dari meta tag

                var elem = '<form action="/status-konfirm-sk-lulus" method="post">';
                elem += '<select class="form-control form-control-sm" name="status_konfirmasi" onchange="this.form.submit()">';
                elem += '<option ' + prosesSelected + ' value="proses">-- Pilih --</option>';
                elem += '<option ' + diterimaSelected + ' value="diterima">Diterima</option>';
                elem += '<option ' + ditolakSelected + ' value="ditolak">Ditolak</option>';
                elem += '</select>';
                elem += '<input type="hidden" name="sk_lulus_id" value="'+data.sk_lulus_id+'">';
                elem += '<input type="hidden" name="_token" value="'+token+'">';
                elem += '</form>';

                return elem;
            }},
            { data: null, orderable : false, render: function(data) {
                return '<a href="https://wa.me/' + data.peserta.no_wa + '" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>';
            }},
        ]
    });

    $('#pesertaLulusTable').DataTable({
        processing: true,
        serverSide: true,
        ajax : '/peserta-lulus/json?filter=0' + filter_peserta_lulus + filter_tahun_daftar + filter_gelombang_id,
        columns: [
        { data: 'no_pendaftaran', name : 'no_pendaftaran'},
        { data: 'nama_lengkap', name : 'nama_lengkap'},
        { data: 'siswa', orderable : false, name: 'siswa', render : function(data) {
            let nisn = '';
            if (data != null || data != undefined)
            {
            nisn = data.nisn
            } else {
            nisn = 'Belum Ada'
            }

            return '<span>'+nisn+'</span>';
        } },
        { data: 'jurusan.nama', name : 'jurusan.nama'},
        { data: 'sudah_lulus', name : 'sudah_lulus', render: function(data) {
            var str;
            if (data == 'lulus') {
            str = '<label class="badge badge-success" style="font-size: 11px;">Lulus</label>'
            } else {
            str = '<label class="badge badge-warning" style="font-size: 11px;">Belum Daftar</label>'
            }

            return str
        }},
        { data: 'status_kelulusan_berkas', name : 'status_kelulusan_berkas', render: function(data) {
            var str;
            if (data == 'lulus') {
            str = '<label class="badge badge-success" style="font-size: 11px;">Diterima</label>'
            } else {
            str = '<label class="badge badge-warning" style="font-size: 11px;">Belum Upload</label>'
            }

            return str
        }},
        { data: null, orderable : false, render: function(data) {
            var btn = '<a href="https://wa.me/'+ data.no_wa +'" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>';
            // btn += '<a href="/peserta/daftar-ulang/'+ data.no_pendaftaran +'" class="btn btn-sm btn-primary ml-2">Daftar Ulang</a>';

            return btn;
        } },
        ]
    });

$('#pesertaDaftarUlang').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/peserta-sudah-daftar-ulang/json',
    columns: [
        { data: 'no_pendaftaran', name: 'no_pendaftaran' },
        { data: 'nama_lengkap', name: 'nama_lengkap' },
        { data: 'jurusan.nama', name: 'jurusan.nama' },
        {
            data: null,
            name: 'sudah_lulus',
            render: function(data) {
                if (!data || !data.sudah_lulus) {
                    return '<span>Tidak Ada Data</span>';
                }
                var prosesSelected = data.sudah_lulus == "proses" ? "selected" : "";
                var diterimaSelected = data.sudah_lulus == "lulus" ? "selected" : "";
                var ditolakSelected = data.sudah_lulus == "tidak_lulus" ? "selected" : "";

                var token = $('meta[name="csrf-token"]').attr('content');  // Ambil token CSRF dari meta tag

                var elem = '<form action="/status-konfirm-daftar-ulang" method="post">';
                elem += '<select class="form-control form-control-sm" name="sudah_lulus" onchange="this.form.submit()">';
                elem += '<option ' + prosesSelected + ' value="proses">-- Pilih --</option>';
                elem += '<option ' + diterimaSelected + ' value="lulus">Diterima</option>';
                elem += '<option ' + ditolakSelected + ' value="tidak_lulus">Ditolak</option>';
                elem += '</select>';
                elem += '<input type="hidden" name="peserta_id" value="' + data.peserta_id + '">';
                elem += '<input type="hidden" name="_token" value="'+token+'">';
                elem += '</form>';

                return elem;
            }
        },
        {
            data: null,
            orderable: false,
            render: function(data) {
                var btn = '<a href="https://wa.me/'+ data.no_wa +'" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>';
                // if (user_keu) {
                //     btn += '<a href="/peserta/daftar-ulang/'+ data.no_pendaftaran +'" class="btn btn-sm btn-primary ml-2">Edit</a>';
                // }

                return btn;
            }
        },
    ]
});



    $('#pesertaBatalSekolah').DataTable({
        processing: true,
        serverSide: true,
        ajax : '/peserta-batal-sekolah/json',
        columns: [
        { data: 'no_pendaftaran', name : 'no_pendaftaran'},
        { data: 'nama_lengkap', name : 'nama_lengkap'},
        { data: 'jurusan.nama', name : 'jurusan.nama'},
        { data: null, orderable : false, render: function(data) {
            var btn = '<a href="https://wa.me/'+ data.no_wa +'" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>';

            return btn;
        } },
        ]
    });

    $('#siswaTable').DataTable({
        processing: true,
        serverSide: true,
        ajax : '/siswa/json' + filter_siswa,
        columns: [
        { data: 'peserta.no_pendaftaran', name : 'peserta.no_pendaftaran'},
        { data: 'nisn', name : 'nisn'},
        { data: 'peserta.nama_lengkap', name : 'peserta.nama_lengkap'},
        { data: 'jurusan.nama', name : 'jurusan.nama'},
        { data: null, orderable : false, render: function(data) {
            var btn = '<a href="https://wa.me/'+ data.no_wa +'" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>';

            return btn;
        } },
        ]
    });


    //   $('#pendampingTable').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax : '/pendamping/daftarJson',
    //     order: [[0, 'desc']],
    //     columns: [
    //       { data: 'kode_referal', name: 'kode_referal' },
    //       { data: 'nama_lengkap', name: 'nama_lengkap' },
    //       { data: 'tipe', name: 'tipe' },
    //       { data: null, orderable : true, render : function(data) {

    //         if (data.tipe === "mahasiswa") {
    //           return data.jurusan === null ? "--Belum mengisi--" : data.jurusan.nama
    //         } else if (data.tipe === "guru" || data.tipe === "kepala_sekolah"){
    //           return data.asal_sekolah === null ? "--Belum mengisi--" : data.asal_sekolah
    //         }
    //         else {
    //           return "-"
    //         }
    //       } },
    //       { data: 'email', name: 'email' },
    //       { data: 'no_hp', name: 'no_hp' },
    //       { data: null, orderable : false, render: function(data) {

    //         var btn = '<a href="https://wa.me/'+ data.no_wa +'" class="btn btn-sm btn-success ml-2" target="_blank"><i class="fab fa-whatsapp"></i></a>'
    //         btn += '<a href="/pendamping/detail/'+ data.pendamping_id +'" class="btn btn-sm btn-primary ml-2"><i class="fa fa-eye"></i></a>'
    //         btn += '<a href="/pendamping/edit/'+ data.pendamping_id +'" class="btn btn-sm btn-info ml-2"><i class="fa fa-edit"></i></a>'
    //         btn += '<button class="btn btn-sm btn-danger btn-hapus ml-2" id="btn-hapus-'+data.pendamping_id+'" data-url="/pendamping/hapus" data-id="'+data.pendamping_id+'" data-name="pendamping" data-title="'+data.nama_lengkap+'"><i class="fa fa-trash"></i></button>'

    //         return btn
    //       } },
    //     ]
    //   });

    $('#pesertaReferalTable').DataTable({
        processing: true,
        serverSide: true,
        ajax : '/peserta-referal/json',
        order: [[0, 'desc']],
        columns: [
        { data: 'nama_lengkap', name: 'nama_lengkap' },
        { data: 'jenis_pendaftaran', name: 'jenis_pendaftaran' },
        { data: 'jurusan.nama', name: 'jurusan.nama' },
        { data: 'asal_sekolah', name: 'asal_sekolah' },
        { data: null, orderable : false, render : function(data) {
            var badge = "default"
            var status_pembayaran = "";
            if (data.pembayaran === null) {
            badge = "dark"
            status_pembayaran = "Belum Bayar"
            } else if (data.pembayaran.status_konfirmasi == "proses") {
            badge = "info"
            status_pembayaran = "Proses Validasi"
            } else if (data.pembayaran.status_konfirmasi == "diterima") {
            badge = "success"
            status_pembayaran = "Diterima"
            } else {
            badge = "danger"
            status_pembayaran = "Ditolak"
            }
            var result = "<label class='badge badge-"+badge+"'>"+status_pembayaran+"</label>"
            return result

        } },
        { data: 'pendamping.nama_lengkap', name: 'pendamping.nama_lengkap' },
        { data: 'pendamping.no_hp', name: 'pendamping.no_hp', orderable:false },
        { data: null, orderable : false, render: function(data) {
            var sudah_diklaim = "-";
            if (data.pembayaran === null || (data.pembayaran != null && data.pembayaran.status_konfirmasi === 'ditolak')) return "-";

            if (data.komisi === null) {
            sudah_diklaim == "-"
            }
            else if (data.komisi.sudah_diklaim == true) {
            sudah_diklaim = "<label class='badge badge-success'>Sudah</label>"
            }else {
            sudah_diklaim = "<label class='badge badge-dark'>Belum</label>"
            }

            return sudah_diklaim
        } },
        ]
    });
    });

    function delete_peserta(elem) {
    let dataId = $(elem).attr('data-id')
    let dataNama = $(elem).attr('data-name')

    $(".data-title").text(dataNama)
    $("#deleteId").val(dataId)
    $("#deleteId").attr("name", "peserta_id")
    $("#formDelete").attr("action", "/peserta/hapus")

    $("#modalDelete").modal('show');
    }
