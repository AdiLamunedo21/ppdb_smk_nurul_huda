<?php

namespace App\Exports;

use App\Models\Peserta;
use App\Models\Gelombang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;

class PesertaLulusExport implements FromCollection, WithHeadings, WithStyles
{

    public function __construct($param = [])
    {
        $this->param = $param;
    }

    public function collection()
    {
        $tahun = (new Gelombang)->currentyear();

        $peserta = Peserta::selectRaw('
            peserta.no_pendaftaran,
            peserta.nik,
            peserta.nisn,
            peserta.nis,
            peserta.nama_lengkap as nama_peserta,
            jurusan.nama as jurusan,
            CASE peserta.sudah_lulus
                WHEN "proses" THEN "Proses"
                WHEN "lulus" THEN "Lulus"
                WHEN "tidak_lulus" THEN "Tidak Lulus"
            END AS status_daftar_ulang
        ')
        ->join('jurusan', 'peserta.jurusan_id', 'jurusan.jurusan_id')
        ->where('peserta.cek_ulang_data', true)
        ->whereYear('peserta.created_at', $tahun);

        if (isset($this->param['jurusan_id'])) {
            $peserta->where('peserta.jurusan_id', $this->param['jurusan_id']);
        }

        return $peserta->get();
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'NIK',
            'NISN',
            'NIS',
            'Nama Peserta',
            'Jurusan',
            'Status Daftar Ulang'
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

        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Auto-size columns for all data rows
        foreach (range('A', 'G') as $column) {
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
        ];
    }
}
