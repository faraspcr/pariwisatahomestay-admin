<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateHomestayDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $homestayData = [];

        // Array nama homestay Indonesia
        $namaHomestay = [
            'Homestay Sawah Indah', 'Villa Bukit Asri', 'Penginapan Desa Damai',
            'Rumah Tinggal Sungai Jernih', 'Bungalow Panorama Gunung',
            'Homestay Pantai Permai', 'Villa Kebun Raya', 'Penginapan Hutan Pinus',
            'Rumah Tradisional Jawa', 'Bungalow Tepi Danau',
            'Homestay Perkebunan Teh', 'Villa Kolam Renang', 'Penginapan Murah Meriah',
            'Rumah Kayu Minimalis', 'Bungalow Taman Bunga',
            'Homestay Kota Tua', 'Villa Modern', 'Penginapan Keluarga',
            'Rumah Bambu Asri', 'Bungalow Sunset View'
        ];

        // Array lokasi Indonesia
        $lokasiIndonesia = [
            'Bali', 'Yogyakarta', 'Lombok', 'Bandung', 'Bogor', 'Malang',
            'Surabaya', 'Semarang', 'Medan', 'Makassar', 'Manado', 'Batam',
            'Palembang', 'Padang', 'Solo', 'Denpasar', 'Cirebon', 'Magelang',
            'Wonosobo', 'Puncak'
        ];

        // Array nama jalan di Indonesia
        $jalanIndonesia = [
            'Jl. Raya', 'Jl. Merdeka', 'Jl. Sudirman', 'Jl. Thamrin',
            'Jl. Gatot Subroto', 'Jl. Hayam Wuruk', 'Jl. MH Thamrin',
            'Jl. Asia Afrika', 'Jl. Pahlawan', 'Jl. Diponegoro',
            'Jl. Ahmad Yani', 'Jl. Sisingamangaraja', 'Jl. Teuku Umar',
            'Jl. Imam Bonjol', 'Jl. Pattimura', 'Jl. Antasari',
            'Jl. Veteran', 'Jl. Prof. Dr. Satrio', 'Jl. Wolter Monginsidi',
            'Jl. Rasuna Said'
        ];

        // Array nama kampung/desa
        $namaKampung = [
            'Kampung Sawah', 'Desa Sukamaju', 'Kampung Cempaka',
            'Desa Sejahtera', 'Kampung Mawar', 'Desa Makmur',
            'Kampung Melati', 'Desa Asri', 'Kampung Kenanga',
            'Desa Sentosa', 'Kampung Anggrek', 'Desa Harmoni',
            'Kampung Dahlia', 'Desa Damai', 'Kampung Flamboyan'
        ];

        // Ambil semua warga yang ada untuk dijadikan pemilik
        $wargas = DB::table('warga')->get();

        if ($wargas->isEmpty()) {
            // Buat 20 warga dummy jika belum ada
            $this->command->info('⚠️  Tabel warga kosong, membuat data warga dummy...');

            $wargaDummy = [];
            for ($j = 1; $j <= 20; $j++) {
                $wargaDummy[] = [
                    'nama' => $faker->name,
                    'nik' => $faker->numerify('################'),
                    'alamat' => $faker->address,
                    'telepon' => '08' . $faker->numerify('##########'),
                    'email' => $faker->email,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('warga')->insert($wargaDummy);
            $wargas = DB::table('warga')->get();
            $this->command->info('✅ 20 data warga dummy berhasil dibuat!');
        }

        $wargaIds = $wargas->pluck('warga_id')->toArray();

        // Buat 30 data homestay
        for ($i = 1; $i <= 30; $i++) {
            $nama = $faker->randomElement($namaHomestay);

            // Buat alamat lengkap
            $alamat = $faker->randomElement($jalanIndonesia) . ' No. ' .
                     $faker->numberBetween(1, 200) . ', ' .
                     $faker->randomElement($namaKampung) . ', ' .
                     $faker->randomElement($lokasiIndonesia);

            // Buat fasilitas JSON dengan variasi
            $fasilitas = $this->generateFasilitas($faker);

            // Tentukan harga berdasarkan fasilitas dan lokasi
            $hargaPerMalam = $this->generateHarga($fasilitas, $faker);

            // Status dengan distribusi: 60% aktif, 25% pending, 15% nonaktif
            $statusRand = $faker->numberBetween(1, 100);
            if ($statusRand <= 60) {
                $status = 'aktif';
            } elseif ($statusRand <= 85) {
                $status = 'pending';
            } else {
                $status = 'nonaktif';
            }

            $homestayData[] = [
                'pemilik_warga_id' => $faker->randomElement($wargaIds),
                'nama' => $nama,
                'alamat' => $alamat,
                'rt' => str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
                'fasilitas_json' => json_encode($fasilitas),
                'harga_per_malam' => $hargaPerMalam,
                'status' => $status,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ];
        }

        // Insert data
        DB::table('homestay')->insert($homestayData);

        // Hitung statistik
        $aktif = 0; $pending = 0; $nonaktif = 0;
        $totalHarga = 0;

        foreach ($homestayData as $data) {
            if ($data['status'] == 'aktif') $aktif++;
            if ($data['status'] == 'pending') $pending++;
            if ($data['status'] == 'nonaktif') $nonaktif++;
            $totalHarga += $data['harga_per_malam'];
        }

        $rataHarga = $totalHarga / count($homestayData);

        $this->command->info('==========================================');
        $this->command->info('✅ SEEDER HOMESTAY DUMMY SELESAI!');
        $this->command->info('==========================================');
        $this->command->info('📊 STATISTIK DATA HOMESTAY:');
        $this->command->info('   Total Data: ' . count($homestayData) . ' homestay');
        $this->command->info('   Status Aktif: ' . $aktif . ' (' . round(($aktif/count($homestayData))*100) . '%)');
        $this->command->info('   Status Pending: ' . $pending . ' (' . round(($pending/count($homestayData))*100) . '%)');
        $this->command->info('   Status Nonaktif: ' . $nonaktif . ' (' . round(($nonaktif/count($homestayData))*100) . '%)');
        $this->command->info('   Rata-rata Harga: Rp ' . number_format($rataHarga, 0, ',', '.') . '/malam');
        $this->command->info('   Rentang Harga: Rp ' .
            number_format(min(array_column($homestayData, 'harga_per_malam')), 0, ',', '.') . ' - Rp ' .
            number_format(max(array_column($homestayData, 'harga_per_malam')), 0, ',', '.'));
        $this->command->info('');

        // Tampilkan 5 contoh data
        $this->command->info('📝 CONTOH DATA HOMESTAY YANG DIBUAT:');
        $this->command->info('=====================================');
        for ($k = 0; $k < 5; $k++) {
            $sample = $homestayData[$k];
            $fasilitasArray = json_decode($sample['fasilitas_json'], true);
            $fasilitasList = [];

            foreach ($fasilitasArray as $key => $value) {
                if ($value === true) {
                    $fasilitasList[] = str_replace('_', ' ', $key);
                }
            }

            $this->command->info(($k+1) . '. ' . $sample['nama']);
            $this->command->info('   📍 Alamat: ' . $sample['alamat']);
            $this->command->info('   🏘️  RT/RW: ' . $sample['rt'] . '/' . $sample['rw']);
            $this->command->info('   💰 Harga: Rp ' . number_format($sample['harga_per_malam'], 0, ',', '.') . '/malam');
            $this->command->info('   📊 Status: ' . strtoupper($sample['status']));
            $this->command->info('   🛏️  Fasilitas: ' . implode(', ', array_slice($fasilitasList, 0, 5)));
            if (count($fasilitasList) > 5) {
                $this->command->info('              +' . (count($fasilitasList) - 5) . ' fasilitas lainnya');
            }
            $this->command->info('');
        }

        $this->command->info('🎯 Data siap digunakan!');
    }

    /**
     * Generate fasilitas JSON secara acak
     */
    private function generateFasilitas($faker)
    {
        // Fasilitas dasar (hampir selalu ada)
        $fasilitas = [
            'tempat_tidur' => true,
            'kamar_mandi' => true,
            'meja' => true,
            'kursi' => true,
            'lemari' => true,
        ];

        // Fasilitas tambahan (acak)
        $fasilitasTambahan = [
            'wifi' => $faker->boolean(80), // 80% punya wifi
            'ac' => $faker->boolean(60),   // 60% punya AC
            'kipas_angin' => $faker->boolean(40), // 40% punya kipas
            'tv' => $faker->boolean(70),   // 70% punya TV
            'parkir' => $faker->boolean(90), // 90% punya parkir
            'dapur' => $faker->boolean(50), // 50% punya dapur
            'laundry' => $faker->boolean(30), // 30% punya laundry
            'kolam_renang' => $faker->boolean(20), // 20% punya kolam renang
            'balkon' => $faker->boolean(40), // 40% punya balkon
            'teras' => $faker->boolean(60), // 60% punya teras
            'sarapan' => $faker->boolean(40), // 40% termasuk sarapan
            'air_panas' => $faker->boolean(70), // 70% air panas
            'kulkas' => $faker->boolean(50), // 50% punya kulkas
            'microwave' => $faker->boolean(30), // 30% punya microwave
            'setrika' => $faker->boolean(40), // 40% punya setrika
        ];

        // Tambahkan fasilitas tambahan yang true
        foreach ($fasilitasTambahan as $key => $value) {
            if ($value) {
                $fasilitas[$key] = true;
            }
        }

        return $fasilitas;
    }

    /**
     * Generate harga berdasarkan fasilitas
     */
    private function generateHarga($fasilitas, $faker)
    {
        $hargaBase = 150000; // Harga dasar

        // Tambahan harga berdasarkan fasilitas
        if (isset($fasilitas['ac']) && $fasilitas['ac']) $hargaBase += 50000;
        if (isset($fasilitas['wifi']) && $fasilitas['wifi']) $hargaBase += 30000;
        if (isset($fasilitas['kolam_renang']) && $fasilitas['kolam_renang']) $hargaBase += 200000;
        if (isset($fasilitas['tv']) && $fasilitas['tv']) $hargaBase += 25000;
        if (isset($fasilitas['dapur']) && $fasilitas['dapur']) $hargaBase += 40000;
        if (isset($fasilitas['sarapan']) && $fasilitas['sarapan']) $hargaBase += 35000;
        if (isset($fasilitas['laundry']) && $fasilitas['laundry']) $hargaBase += 20000;

        // Tambahkan variasi acak
        $variasi = $faker->numberBetween(-50000, 100000);
        $harga = $hargaBase + $variasi;

        // Bulatkan ke ribuan terdekat
        $harga = round($harga / 1000) * 1000;

        // Pastikan minimal harga 100.000
        return max($harga, 100000);
    }
}
