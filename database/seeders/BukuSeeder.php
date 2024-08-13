<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        $data = [];

        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'nomor_rak' => $faker->word,
                'nama_rak' => $faker->word,
                'judul' => $faker->sentence,
                'pengarang' => $faker->name,
                'tahun_terbit' => $faker->year,
                'jenis_buku' => $faker->word,
                'stok_tersedia' => $faker->numberBetween(1, 100),
                'keterangan' => $faker->text,
                'foto_sampul' => $faker->imageUrl(200, 300, 'books', true),
                'file_buku' => $faker->word . '.pdf',
            ];
        }

        DB::table('bukus')->insert($data);
    }
}
