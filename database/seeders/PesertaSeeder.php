<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

use App\Models\Peserta;
use App\Models\User;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        for($i = 0; $i < 300; $i++) {
            $peserta = Peserta::create([
                'gelombang_id' => 1,
                'jenis_pendaftaran' => $faker->randomElement(['tes', 'prestasi']),
                'no_pendaftaran' => $faker->numerify('######'),
                'nik' => $faker->numerify('################'),
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tempat_lahir' => 'Belitang',
                'tanggal_lahir' => date('Y-m-d'),
                'no_hp' => $faker->numerify('############'),
                'email' => $faker->email,
                'jurusan_id' => mt_rand(1, 3),
            ]);

            $user = User::create([
                'name' => $peserta->nama_lengkap,
                'email' => $peserta->email,
                'password' => Hash::make("test123"),
                'nik' => $peserta->nik,
                'peserta_id' => $peserta->peserta_id
            ]);

            $user->assignRole('peserta');
        }
    }
}
