<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateKamarHomestayDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil semua homestay yang ada
        $homestays = DB::table('homestay')->pluck('homestay_id')->toArray();

        if (empty($homestays)) {
            $this->command->error('Tidak ada data homestay. Jalankan seeder homestay terlebih dahulu!');
            return;
        }

        $kamarData = [];

        // Array nama kamar dalam Bahasa Indonesia
        $namaKamar = [
            'Deluxe Room', 'Standard Room', 'Suite Room', 'Family Room',
            'Executive Room', 'Presidential Suite', 'Garden View Room',
            'Pool View Room', 'Sea View Room', 'Mountain View Room',
            'Studio Room', 'Loft Room', 'Penthouse', 'Bungalow',
            'Villa', 'Cottage', 'Double Room', 'Single Room',
            'Twin Room', 'Triple Room'
        ];

        // Array fasilitas kamar dalam format JSON
        $fasilitasOptions = [
            '{"ac": true, "tv": true, "wifi": true, "kamar_mandi_dalam": true, "balkon": false, "kulkas": false}',
            '{"ac": true, "tv": false, "wifi": true, "kamar_mandi_dalam": true, "balkon": true, "kulkas": true}',
            '{"ac": true, "tv": true, "wifi": true, "kamar_mandi_dalam": true, "balkon": true, "kulkas": true, "bathup": true}',
            '{"ac": true, "tv": true, "wifi": true, "kamar_mandi_dalam": true, "balkon": false, "kulkas": false, "teh_kopi": true}',
            '{"ac": false, "tv": true, "wifi": true, "kamar_mandi_dalam": true, "balkon": true, "kulkas": false}'
        ];

        for ($i = 1; $i <= 50; $i++) {
            $kamarData[] = [
                'homestay_id'   => $faker->randomElement($homestays),
                'nama_kamar'    => $faker->randomElement($namaKamar) . ' ' . $faker->numberBetween(101, 999),
                'kapasitas'     => $faker->numberBetween(1, 6),
                'fasilitas_json'=> $faker->randomElement($fasilitasOptions),
                'harga'         => $faker->numberBetween(250000, 2000000),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('kamar_homestay')->insert($kamarData);

        $this->command->info('Seeder Kamar Homestay Dummy berhasil dijalankan!');
        $this->command->info('Total data kamar: ' . count($kamarData));
        $this->command->info('Perintah: php artisan db:seed --class=CreateKamarHomestayDummy');
    }
}
