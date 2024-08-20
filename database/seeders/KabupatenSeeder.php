<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kabupaten = [
            ['kode' => '', 'nama' => 'Kab. Banyuasin', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Empat Lawang', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Lahat', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Muara Enim', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Musi Banyu Asin', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Musi Rawas', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Musi Rawas Utara', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Ogan Ilir', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Ogan Komering Ilir', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Ogan Komering Ulu', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Ogan Komering Ulu Selatan', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Ogan Komering Ulu Timur', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kab. Penukal Abab Lematang Ilir', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kota Lubuk Linggau', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kota Pagar Alam', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kota Palembang', 'provinsi_id' => 1],
            ['kode' => '', 'nama' => 'Kota Prabumulih', 'provinsi_id' => 1],
        ];

        foreach($kabupaten as $val) {
        DB::table('kabupaten')->insert([
                'kode' => $val['kode'],
                'nama' => $val['nama'],
                'provinsi_id' => $val['provinsi_id']
            ]);
        }
    }
}
