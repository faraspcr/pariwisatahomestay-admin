<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateDestinasiWisataDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $destinasiData = [];

        // Array nama tempat wisata Indonesia
        $namaWisata = [
            'Pantai', 'Gunung', 'Candi', 'Museum', 'Air Terjun', 'Danau', 'Taman', 'Goa',
            'Bukit', 'Pulau', 'Teluk', 'Sungai', 'Kebun', 'Hutan', 'Kolam Renang'
        ];

        // Array kota di Indonesia
        $kotaIndonesia = [
            'Bali', 'Yogyakarta', 'Jakarta', 'Bandung', 'Lombok', 'Surabaya', 'Malang',
            'Semarang', 'Medan', 'Makassar', 'Palembang', 'Bogor', 'Batam', 'Manado'
        ];

        // Array deskripsi dalam Bahasa Indonesia
        $deskripsiIndonesia = [
            'Tempat wisata yang menawarkan pemandangan alam yang menakjubkan dan udara segar.',
            'Destinasi perfect untuk keluarga dengan berbagai fasilitas yang lengkap.',
            'Wisata budaya yang kaya akan sejarah dan nilai tradisional Indonesia.',
            'Lokasi yang cocok untuk berfoto dengan pemandangan yang instagramable.',
            'Tempat rekreasi yang menyenangkan dengan berbagai wahana permainan.',
            'Wisata alam yang masih alami dan terjaga keasriannya.',
            'Destinasi favorit wisatawan lokal maupun mancanegara.',
            'Tempat yang tepat untuk melepas penat dan menikmati ketenangan alam.',
            'Wisata edukasi yang memberikan pengalaman belajar yang menyenangkan.',
            'Lokasi dengan pemandangan sunset yang sangat indah dan romantis.'
        ];

        // Array alamat jalan di Indonesia
        $jalanIndonesia = [
            'Jl. Merdeka No. 123', 'Jl. Sudirman No. 45', 'Jl. Thamrin No. 67',
            'Jl. Gatot Subroto No. 89', 'Jl. Hayam Wuruk No. 12', 'Jl. MH Thamrin No. 34',
            'Jl. Asia Afrika No. 56', 'Jl. Pahlawan No. 78', 'Jl. Diponegoro No. 90',
            'Jl. Ahmad Yani No. 11', 'Jl. Sisingamangaraja No. 22', 'Jl. Teuku Umar No. 33',
            'Jl. Imam Bonjol No. 44', 'Jl. Pattimura No. 55', 'Jl. Antasari No. 66'
        ];

        for ($i = 1; $i <= 100 $i++) {
            $namaDestinasi = $faker->randomElement($namaWisata) . ' ' . $faker->randomElement($kotaIndonesia);

            $destinasiData[] = [
                'nama'          => $namaDestinasi,
                'deskripsi'     => $faker->randomElement($deskripsiIndonesia),
                'alamat'        => $faker->randomElement($jalanIndonesia) . ', ' . $faker->randomElement($kotaIndonesia),
                'rt'            => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'rw'            => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'jam_buka'      => '08:00:00',
                'tiket'         => $faker->numberBetween(10000, 100000),
                'kontak'        => $faker->phoneNumber(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('destinasi_wisata')->insert($destinasiData);

        $this->command->info('Seeder Destinasi Wisata Dummy berhasil dijalankan!');
        $this->command->info('Total data destinasi: ' . count($destinasiData));
    }
}
