<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Gelombang;
use Carbon\Carbon;

class GelombangUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gelombang = Gelombang::whereNull('tahun')->get();

        if (count($gelombang) > 0) {
            foreach($gelombang as $val) {
                $update = Gelombang::find($val->gelombang_id);
                $update->tahun = Carbon::parse($val->mulai)->format('Y');
                $update->save();
            }
        }
    }
}
