<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GelombangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('gelombang')->insert([
        //     'nama' => "Gelombang I",
        //     'mulai' => "2022-01-01",
        //     'selesai' => "2022-03-20",
        //     'biaya' => "2500000",
        //     'aktif' => 1
        // ]);

        $gelombang = [
            ['nama' => 'Gelombang I', 'mulai' => '2024-01-10', 'selesai' => '2024-03-31', 'aktif' => true],
            ['nama' => 'Gelomabng II', 'mulai' => '2024-04-01', 'selesai' => '2024-06-30', 'aktif' => false],
            ['nama' => 'Gelomabng III', 'mulai' => '2024-07-01', 'selesai' => '2024-08-22', 'aktif' => false],
        ];

        foreach($gelombang as $val) {
            DB::table('gelombang')->insert([
                    'nama' => $val['nama'],
                    'mulai' => $val['mulai'],
                    'selesai' => $val['selesai'],
                    'aktif' => $val['aktif']
                ]);
        }
    }
}
