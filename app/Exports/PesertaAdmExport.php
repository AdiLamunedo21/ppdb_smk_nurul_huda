<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PesertaAdmExport implements FromCollection, WithHeadings, WithColumnWidths
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
        $data = Peserta::selectRaw('peserta.no_pendaftaran, peserta.nama_lengkap, jurusan.nama, peserta.no_hp, peserta.asal_sekolah')
            ->join('jurusan', 'peserta.jurusan_id', '=', 'jurusan.jurusan_id');

        if (isset($this->param['asal_sekolah']))
        {
            $data->where('peserta.asal_sekolah', 'like', "%{$this->param['asal_sekolah']}%");
        }

        $result = $data->get();

        return $result;
    }

    public function headings(): array
    {
        return [
            'No Pendaftaran',
            'Nama Siswa',
            'Jurusan Pilihan',
            'No. Handphone',
            'Asal Sekolah'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 30,
            'D' => 25,
            'E' => 35,
        ];
    }
}
