<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UlasanWisata;
use App\Models\DestinasiWisata;
use App\Models\Warga;
use Faker\Factory as Faker;

class CreateUlasanWisataDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // KOMENTAR BAHASA INDONESIA - TETAP PAKAI INI
        $komentarIndonesia = [
            'Tempatnya sangat bagus dan bersih, cocok untuk keluarga.',
            'Pemandangan yang menakjubkan, worth it untuk dikunjungi.',
            'Pelayanan ramah tapi fasilitas perlu ditingkatkan lagi.',
            'Harga tiket terjangkau dengan pemandangan yang indah.',
            'Lokasi strategis dan mudah dijangkau dengan kendaraan umum.',
            'Wisata yang recommended untuk anak-anak dan keluarga.',
            'Kebersihan terjaga dengan baik, staff sangat profesional.',
            'Parkir luas dan toilet bersih, sangat memuaskan.',
            'Pemandangan sunsetnya luar biasa, wajib dikunjungi.',
            'Tempatnya nyaman dan teduh, perfect untuk bersantai.',
            'Harga makanan sedikit mahal tapi rasanya enak.',
            'Akses jalan agak sulit tapi pemandangan sepadan.',
            'Wisata edukatif yang menyenangkan untuk anak-anak.',
            'Tiket masuk murah meriah dengan fasilitas lengkap.',
            'Suasana tenang dan damai, cocok untuk melepas penat.',
        ];

        // Ambil ID destinasi wisata dan warga yang ada
        $destinasiIds = DestinasiWisata::pluck('destinasi_id')->toArray();
        $wargaIds = Warga::pluck('warga_id')->toArray();

        // CEK JIKA DATA KOSONG
        if (empty($destinasiIds) || empty($wargaIds)) {
            $this->command->error('ERROR: Data destinasi atau warga masih kosong!');
            return;
        }

        $ulasanData = [];

       for ($i = 1; $i <= 100; $i++) {
            $ulasanData[] = [
                'destinasi_id' => $faker->randomElement($destinasiIds),
                'warga_id'     => $faker->randomElement($wargaIds),
                'rating'       => $faker->numberBetween(1, 5),
                'komentar'     => $faker->randomElement($komentarIndonesia), // INI YANG BIKIN BAHASA INDONESIA
                'waktu'        => $faker->dateTimeBetween('-1 year', 'now'),
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        UlasanWisata::insert($ulasanData);
        $this->command->info('Seeder Ulasan Wisata Dummy berhasil dijalankan!');
    }
}
