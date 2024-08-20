<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\Gelombang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;

class SiswaExport implements FromCollection, WithHeadings, WithStyles
{
    public function __construct($param = [])
    {
        $this->param = $param;
    }

    public function collection()
    {
        $tahun = (new Gelombang)->currentyear();

        $siswa = Siswa::selectRaw('
            peserta.no_pendaftaran,
            peserta.nik,
            siswa.nisn,
            peserta.nis,
            peserta.nama_lengkap,
            jurusan.nama as jurusan,
            peserta.tempat_lahir,
            peserta.tanggal_lahir,
            CASE peserta.jenis_kelamin
                WHEN "laki-laki" THEN "L"
                WHEN "perempuan" THEN "P"
            END AS jenis_kelamin,
            peserta.email,
            peserta.no_hp,
            peserta.agama,
            peserta.asal_sekolah,
            nama_ibu_kandung.nama_lengkap_ibu,
            nama_ayah_kandung.nama_lengkap_ayah
        ')
        ->join('peserta', 'siswa.peserta_id', 'peserta.peserta_id')
        ->join('jurusan', 'siswa.jurusan_id', 'jurusan.jurusan_id')
        ->leftJoin('nama_ayah_kandung', 'peserta.peserta_id', 'nama_ayah_kandung.peserta_id')
        ->leftJoin('nama_ibu_kandung', 'peserta.peserta_id', 'nama_ibu_kandung.peserta_id')
        ->where('peserta.cek_ulang_data', true)
        ->whereYear('peserta.created_at', $tahun);

        if (isset($this->param['jurusan_id'])) {
            $siswa->where('siswa.jurusan_id', $this->param['jurusan_id']);
        }

        return $siswa->get();
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'NIK',
            'NISN',
            'NIS',
            'Nama Siswa',
            'Jurusan',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Email',
            'No. Handphone',
            'Agama',
            'Asal Sekolah',
            'Nama Ibu Kandung',
            'Nama Ayah Kandung',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => 'FF00B050'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ];

        $sheet->getStyle('A1:O1')->applyFromArray($headerStyle);

        // Auto-size columns for all data rows
        foreach (range('A', 'O') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [
            // Center align all columns
            'A' => ['alignment' => ['horizontal' => 'center']],
            'B' => ['alignment' => ['horizontal' => 'center']],
            'C' => ['alignment' => ['horizontal' => 'center']],
            'D' => ['alignment' => ['horizontal' => 'center']],
            'E' => ['alignment' => ['horizontal' => 'center']],
            'F' => ['alignment' => ['horizontal' => 'center']],
            'G' => ['alignment' => ['horizontal' => 'center']],
            'H' => ['alignment' => ['horizontal' => 'center']],
            'I' => ['alignment' => ['horizontal' => 'center']],
            'J' => ['alignment' => ['horizontal' => 'center']],
            'K' => ['alignment' => ['horizontal' => 'center']],
            'L' => ['alignment' => ['horizontal' => 'center']],
            'M' => ['alignment' => ['horizontal' => 'center']],
            'N' => ['alignment' => ['horizontal' => 'center']],
            'O' => ['alignment' => ['horizontal' => 'center']],
        ];
    }
}
