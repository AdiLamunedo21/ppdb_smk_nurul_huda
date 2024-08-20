<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $jurusan = [
            ['kode' => '', 'nama' => 'Akuntasi & Keuangan Lembaga'],
            ['kode' => '', 'nama' => 'Otomatisasi & Tata Kelola Perkantoran'],
            ['kode' => '', 'nama' => 'Multimedia'],
        ];

        foreach($jurusan as $val) {
        DB::table('jurusan')->insert([
                'kode' => $val['kode'],
                'nama' => $val['nama'],
            ]);
        }
    }

}
