<?php

namespace App\Exports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PesertaTesExport implements FromCollection, WithHeadings, WithColumnWidths
{

    public function __construct($param = [])
    {
        $this->param = $param;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Jadwal::selectRaw('peserta.no_pendaftaran, peserta.nama_lengkap, jurusan.nama, peserta.lokasi_ujian, jadwal.tanggal')
            ->join('peserta', 'jadwal.peserta_id', 'peserta.peserta_id')
            ->leftJoin('jurusan', 'peserta.jurusan_id', 'jurusan.jurusan_id')
            ->where('peserta.sudah_tes', 0);

        if (isset($this->param['lokasi_ujian']))
        {
            $data->where('peserta.lokasi_ujian', $this->param['lokasi_ujian']);
        }

        $result = $data->get();

        return $result;
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Nama',
            'Jurusan',
            'Lokasi',
            'Tanggal Ujian'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 30,
            'D' => 25,
            'E' => 25
        ];
    }
}
