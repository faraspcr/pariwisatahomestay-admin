<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Homestay;
use App\Models\Warga;

class HomestaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa warga sebagai pemilik
        $wargas = Warga::take(10)->get();

        if ($wargas->isEmpty()) {
            $this->command->info('Tidak ada data warga! Jalankan WargaSeeder terlebih dahulu.');
            return;
        }

        $homestays = [
            [
                'nama' => 'Villa Sawah Indah',
                'alamat' => 'Jalan Raya Sawangan, Desa Sukamaju',
                'rt' => '01',
                'rw' => '02',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": true, "kolam_renang": true, "dapur": true}',
                'harga_per_malam' => 500000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Homestay Gunung Lestari',
                'alamat' => 'Jl. Gunung Merapi No. 15',
                'rt' => '03',
                'rw' => '01',
                'fasilitas_json' => '{"wifi": true, "ac": false, "parkir": true, "tv": true, "kamar_mandi_dalam": true}',
                'harga_per_malam' => 350000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Rumah Singgah Desa',
                'alamat' => 'Jl. Desa Wisata No. 8',
                'rt' => '02',
                'rw' => '03',
                'fasilitas_json' => '{"wifi": false, "ac": false, "parkir": true, "kipas_angin": true, "sarapan": true}',
                'harga_per_malam' => 200000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Penginapan Pantai Seruni',
                'alamat' => 'Jl. Pantai Indah KM 5',
                'rt' => '04',
                'rw' => '02',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": true, "view_pantai": true, "restoran": true}',
                'harga_per_malam' => 750000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Cottage Hutan Pinus',
                'alamat' => 'Kawasan Hutan Pinus, Desa Wisata Alam',
                'rt' => '05',
                'rw' => '01',
                'fasilitas_json' => '{"wifi": false, "ac": false, "parkir": true, "perapian": true, "trekking": true}',
                'harga_per_malam' => 450000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Guest House Kota Tua',
                'alamat' => 'Jl. Sejarah No. 25, Kawasan Kota Lama',
                'rt' => '01',
                'rw' => '04',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": false, "sepeda_gratis": true, "tur_kota": true}',
                'harga_per_malam' => 300000,
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Rumah Tradisional Jawa',
                'alamat' => 'Kompleks Budaya Jawa, Desa Adat',
                'rt' => '03',
                'rw' => '03',
                'fasilitas_json' => '{"wifi": true, "ac": false, "parkir": true, "pelatihan_budaya": true, "alat_musik": true}',
                'harga_per_malam' => 400000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Apartemen Harian Vista',
                'alamat' => 'Jl. Apartemen No. 12, Tower B',
                'rt' => '06',
                'rw' => '02',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": true, "gym": true, "kolam_renang": true, "dapur_lengkap": true}',
                'harga_per_malam' => 600000,
                'status' => 'pending',
            ],
            [
                'nama' => 'Bungalow Tepi Danau',
                'alamat' => 'Jl. Danau Toba No. 7',
                'rt' => '02',
                'rw' => '05',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": true, "perahu": true, "pancing": true, "bbq": true}',
                'harga_per_malam' => 550000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Kostel Backpacker',
                'alamat' => 'Jl. Backpacker No. 99',
                'rt' => '04',
                'rw' => '04',
                'fasilitas_json' => '{"wifi": true, "ac": false, "parkir": true, "dapur_bersama": true, "laundry": true, "locker": true}',
                'harga_per_malam' => 150000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Villa Keluarga Besar',
                'alamat' => 'Jl. Keluarga Harmoni No. 45',
                'rt' => '05',
                'rw' => '03',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": true, "5_kamar": true, "ruang_keluarga": true, "taman": true}',
                'harga_per_malam' => 850000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Glamping Luxury',
                'alamat' => 'Area Glamping, Desa Adventure Park',
                'rt' => '01',
                'rw' => '06',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": true, "tenda_mewah": true, "private_chef": true, "aktivitas_outdoor": true}',
                'harga_per_malam' => 1200000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Rumah Petani',
                'alamat' => 'Jl. Pertanian Organik No. 33',
                'rt' => '03',
                'rw' => '04',
                'fasilitas_json' => '{"wifi": false, "ac": false, "parkir": true, "kebun_sayur": true, "pelatihan_pertanian": true, "makanan_organik": true}',
                'harga_per_malam' => 250000,
                'status' => 'nonaktif',
            ],
            [
                'nama' => 'Studio Artist',
                'alamat' => 'Jl. Seni Rupa No. 88',
                'rt' => '02',
                'rw' => '02',
                'fasilitas_json' => '{"wifi": true, "ac": true, "parkir": true, "studio_lukis": true, "galeri": true, "workshop": true}',
                'harga_per_malam' => 480000,
                'status' => 'aktif',
            ],
            [
                'nama' => 'Pondok Baca',
                'alamat' => 'Jl. Literasi No. 10',
                'rt' => '04',
                'rw' => '01',
                'fasilitas_json' => '{"wifi": true, "ac": false, "parkir": true, "perpustakaan": true, "ruang_baca": true, "kopi_gratis": true}',
                'harga_per_malam' => 180000,
                'status' => 'pending',
            ],
        ];

        $this->command->info('Menambahkan data homestay...');

        $progressBar = $this->command->getOutput()->createProgressBar(count($homestays));

        foreach ($homestays as $key => $homestayData) {
            // Pilih pemilik secara acak dari warga yang tersedia
            $pemilik = $wargas->random();

            Homestay::create([
                'pemilik_warga_id' => $pemilik->warga_id,
                'nama' => $homestayData['nama'],
                'alamat' => $homestayData['alamat'],
                'rt' => $homestayData['rt'],
                'rw' => $homestayData['rw'],
                'fasilitas_json' => $homestayData['fasilitas_json'],
                'harga_per_malam' => $homestayData['harga_per_malam'],
                'status' => $homestayData['status'],
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('Seeder Homestay berhasil ditambahkan!');
        $this->command->info('Total: ' . count($homestays) . ' homestay');
    }
}
