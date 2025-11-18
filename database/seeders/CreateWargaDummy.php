<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Tambahkan ini

class CreateWargaDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $wargaData = [];

        for ($i = 1; $i <= 50; $i++) {
            $gender = $faker->randomElement(['L', 'P']);
            $agama  = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);

            $wargaData[] = [
                'no_ktp'        => $faker->unique()->numerify('###############'),
                'nama'          => $faker->name($gender == 'L' ? 'male' : 'female'),
                'jenis_kelamin' => $gender,
                'agama'         => $agama,
                'pekerjaan'     => $faker->jobTitle(),
                'telp'          => $faker->phoneNumber(),
                'email'         => $faker->unique()->safeEmail(),
                'created_at'    => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at'    => now(),
            ];
        }

        DB::table('warga')->insert($wargaData);

        $this->command->info('Seeder Warga Dummy Simple berhasil dijalankan!');
        $this->command->info('Total data warga: ' . count($wargaData));
    }
}
