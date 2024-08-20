<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Peserta Didik Baru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times;
        }
        .header {
            text-align: center;
            margin-top: 45px;
        }
        .header img {
            width: 80px;
        }
        .header table {
            width: 100%;
            table-layout: fixed;
        }
        .header h2, .header h3 {
            margin: 0;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .header .logo-left, .header .logo-right {
            width: 15%;
            text-align: center;
        }
        .header .text {
            width: 80%;
            text-align: center;
        }
        .line {
            width: 100%;
            height: 2px;
            background-color: black;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .content {
            margin-top: 10px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content th, .content td {
            border: 1px solid black;
            padding: 4px;
            font-size: 15px;
            min-width: 150px;
            padding-left: 10px;
        }
        .content th {
            background-color: #f2f2f2;
        }
        .content h2 {
            margin-top: 18px;
            font-size: 14px;
            font-weight: bold;
        }
        .signature-table {
            width: 100%;
            margin-top: 20px;
            text-align: center;
        }
        .signature-table td {
            height: 60px;
        }
        .content td:not(:last-child) {
            border-right: none;
        }
        .content td + td {
            border-left: 2px solid black;
        }
        .lain-lain p {
            margin-bottom: 10px;
        }
        .signature-section {
            margin-top: 40px;
            text-align: center;
            width: 100%;
        }
        .signature-section .sign-box {
            display: inline-block;
            width: 45%;
            text-align: center;
        }
        .signature-section .sign-box p {
            margin-bottom: 60px;
            margin-top: 0;
        }
        .signature-section .sign-box .name {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td class="logo-left"><img src="{{ public_path().'/assets/images/logo.png' }}" alt="School Logo"></td>
                <td class="text">
                    <h2>FORMULIR PESERTA DIDIK BARU</h2>
                    <h2>SMK NURUL HUDA SUKARAJA BUAY MADANG OKU TIMUR</h2>
                    <h2>TAHUN PELAJARAN 2022/2023</h2>
                </td>
                <td class="logo-right"><img src="{{ public_path().'/assets/images/tutwuri1.png' }}" alt="School Logo"></td>
            </tr>
        </table>
        <div class="line"></div>
    </div>

    <div class="content">
        <table>
            <tr>
                <td>Nomor Pendaftaran</td>
                <td>{{ $peserta->no_pendaftaran }}</td>
            </tr>
            <tr>
                <td>Jurusan Pilihan</td>
                <td>{{ $peserta->jurusan->nama }}</td>
            </tr>
        </table>

        <h2>A. BIODATA DIRI</h2>
        <table>
            <tr>
                <th colspan="2">Informasi Pribadi</th>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>{{ $peserta->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>{{ $peserta->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>{{ $peserta->nisn }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>{{ $peserta->nis }}</td>
            </tr>
            <tr>
                <td>Nomor Akte Kelahiran</td>
                <td>{{ $peserta->no_akte_kelahiran }}</td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>{{ $peserta->asal_sekolah }}</td>
            </tr>
            <tr>
                <td>Nomor Seri Ijazah SMP/MTs</td>
                <td>{{ $peserta->no_seri_ijazah_smp }}</td>
            </tr>
            <tr>
                <td>Nomor Seri SHUN SMP/MTs</td>
                <td><{{ $peserta->no_seri_shun_smp }}</td>
            </tr>
            <tr>
                <td>Nomor Ujian SMP/MTs</td>
                <td>{{ $peserta->no_ujian_smp }}</td>
            </tr>
            <tr>
                <td>No. Induk Kependudukan (NIK)</td>
                <td>{{ $peserta->nik }}</td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>{{ $peserta->tempat_lahir }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>{{ $peserta->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>{{ $peserta->agama }}</td>
            </tr>
            <tr>
                <td>Kebutuhan Khusus</td>
                <td>{{ $peserta->kebutuhan_khusus }}</td>
            </tr>
            <tr>
                <th colspan="2">Alamat Rumah</th>
            </tr>
            <tr>
                <td>a. Dusun</td>
                <td>{{ $peserta->dusun }}</td>
            </tr>
            <tr>
                <td>b. Kelurahan/Desa</td>
                <td>{{ $peserta->kelurahan }}</td>
            </tr>
            <tr>
                <td>c. Kecamatan</td>
                <td>{{ $peserta->kecamatan }}</td>
            </tr>
            <tr>
                <td>d. Kabupaten</td>
                <td>{{ $peserta->kabupaten }}</td>
            </tr>
            <tr>
                <td>e. Provinsi</td>
                <td>{{ $peserta->provinsi }}</td>
            </tr>
            <tr>
                <td>f. Kode Pos</td>
                <td>{{ $peserta->kode_pos }}</td>
            </tr>
            <tr>
                <th colspan="2">Data Lainnya</th>
            </tr>
            <tr>
                <td>Alat Transportasi ke Sekolah</td>
                <td>{{ $peserta->alat_tranportasi_kesekolah }}</td>
            </tr>
            <tr>
                <td>Jenis Tinggal</td>
                <td>{{ $peserta->jenis_tinggal }}</td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>{{ $peserta->no_hp }}</td>
            </tr>
            <tr>
                <td>Email Pribadi</td>
                <td>{{ $peserta->email }}</td>
            </tr>
            <tr>
                <td>Apakah Sebagai Penerima KPS/PIP</td>
                <td>{{ $peserta->penerima_kps_pip }}</td>
            </tr>
            <tr>
                <td>Nomor KPS/PIP</td>
                <td>{{ $peserta->nomor_kps_pip }}</td>
            </tr>
            <tr>
                <td>Tinggi Badan</td>
                <td>{{ $peserta->tinggi_badan }}</td>
            </tr>
            <tr>
                <td>Berat Badan</td>
                <td>{{ $peserta->berat_badan }}</td>
            </tr>
            <tr>
                <td>Jumlah Saudara Kandung</td>
                <td>{{ $peserta->jumlah_saudara }}</td>
            </tr>
            <tr>
                <td>Jarak Tempat Tinggal ke Sekolah</td>
                <td>{{ $peserta->jarak_tempat_tinggal_kesekolah }}</td>
            </tr>
            <tr>
                <td>Waktu Tempuh Berangkat ke Sekolah</td>
                <td>{{ $peserta->waktu_tempat_berangkat_kesekolah }}</td>
            </tr>
        <tr>
            <th colspan="2">Catatan Prestasi</th>
        </tr>
            @forelse($peserta->catatan_prestasi as $prestasi)

            <tr>
                <td>Nama Prestasi</td>
                <td>{{ $prestasi->nama_prestasi }}</td>
            </tr>
            <tr>
                <td>Tingkat</td>
                <td>{{ $prestasi->tingkat }}</td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>{{ $prestasi->tahun }}</td>
            </tr>
            <tr>
                <td>Penyelenggara</td>
                <td>{{ $prestasi->penyelenggara }}</td>
            </tr>
            @empty

            <tr>
                <td colspan="2">Tidak ada data prestasi.</td>
            </tr>

            @endforelse
        </table>

        <h2>B. BIODATA ORANG TUA</h2>
        <table>
            <tr>
                <th colspan="2">Ayah Kandung</th>
            </tr>
            @forelse($peserta->namaAyah as $ayah)
            <tr>
                <td>a. Nama Lengkap</td>
                <td>{{ $ayah->nama_lengkap_ayah }}</td>
            </tr>
            <tr>
                <td>Tahun Lahir</td>
                <td>{{ $ayah->tahun_lahir_ayah }}</td>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>{{ $ayah->pendidikan_terakhir_ayah }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>{{ $ayah->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td>Penghasilan Perbulan</td>
                <td>{{ $ayah->penghasilan_perbulan_ayah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">Tidak Mempunyai Ayah</td>
            </tr>
            @endforelse
            <tr>
                <th colspan="2">Ibu Kandung</th>
            </tr>
            @forelse($peserta->namaIbu as $ibu)
            <tr>
                <td>Nama Ibu</td>
                <td>{{ $ibu->nama_lengkap_ibu }}</td>
            </tr>
            <tr>
                <td>Tahun Lahir</td>
                <td>{{ $ibu->tahun_lahir_ibu }}</td>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>{{ $ibu->pendidikan_terakhir_ibu }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>{{ $ibu->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td>Penghasilan Perbulan</td>
                <td>{{ $ibu->penghasilan_perbulan_ibu }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">Tidak Mempunyai Ibu</td>
            </tr>
            @endforelse
        </table>

        <h2>C. BIODATA WALI</h2>
        <table>
            <tr>
                <th colspan="2">Data Wali</th>
            </tr>
            @forelse($peserta->namaWali as $wali)
            <tr>
                <td>Nama Lengkap</td>
                <td>{{ $wali->nama_lengkap_wali }}</td>
            </tr>
            <tr>
                <td>Tahun Lahir</td>
                <td>{{ $wali->tahun_lahir_wali }}</td>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>{{ $wali->pendidikan_terakhir_wali }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>{{ $wali->pekerjaan_wali }}</td>
            </tr>
            <tr>
                <td>Penghasilan Perbulan</td>
                <td>{{ $wali->penghasilan_perbulan_wali }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">Tidak Mempunyai Wali</td>
            </tr>
            @endforelse
        </table>

        <h2 style="margin-top: 40px" >LAIN-LAIN</h2>
        <div class="lain-lain">
            <p>1. Kami menyerahkan Putra / Putri kami tersebut di atas untuk dididik pada Yayasan Pondok Pesantren Nurul Huda (SMK Nurul Huda) dan kami sanggup untuk mengikuti seluruh aturan yang berlaku.</p>
            <p>2. Apabila Putra / putri kami melanggar peraturan, bersedia diberi sanksi.</p>
        </div>

        <div class="signature-section">
            <div class="sign-box">
                <p>Calon Santri</p>
                <p>_________________________</p>
            </div>
            <div class="sign-box">
                <p style="margin-top: 50px">Sukaraja, ........................................</p>
                <p>Orang Tua/Wali</p>
                <p>_________________________</p>
            </div>
        </div>

    </div>
</body>
</html>
