<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kecamatan;

class KecamatanController extends Controller
{
        public function json($kabupaten_id)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();

        return response()->json(['data' => $kecamatan]);
    }
}
