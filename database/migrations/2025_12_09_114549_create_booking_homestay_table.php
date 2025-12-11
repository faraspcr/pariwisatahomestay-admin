<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CreateBookingHomestayDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil semua kamar yang tersedia
        $kamars = DB::table('kamar_homestay')->pluck('kamar_id')->toArray();

        // Ambil semua warga yang tersedia
        $wargas = DB::table('warga')->pluck('warga_id')->toArray();

        // Jika tidak ada kamar atau warga, tampilkan pesan error
        if (empty($kamars) || empty($wargas)) {
            $this->command->error('Seeder Booking Homestay: Tidak ada data kamar_homestay atau warga!');
            $this->command->info('Harap jalankan seeder untuk kamar_homestay dan warga terlebih dahulu.');
            return;
        }

        $bookingData = [];

        // Array status booking dalam bahasa Indonesia
        $statusOptions = ['pending', 'confirmed', 'paid', 'cancelled', 'completed'];

        // Array metode pembayaran
        $metodeBayarOptions = ['cash', 'transfer', 'qris', 'other'];

        // Buat 50 data dummy booking
        for ($i = 1; $i <= 50; $i++) {
            // Pilih kamar dan warga secara random
            $kamarId = $faker->randomElement($kamars);
            $wargaId = $faker->randomElement($wargas);

            // Generate tanggal checkin (1-30 hari dari sekarang)
            $checkin = Carbon::now()->addDays($faker->numberBetween(1, 30));

            // Generate checkout (1-7 hari setelah checkin)
            $checkout = $checkin->copy()->addDays($faker->numberBetween(1, 7));

            // Generate harga per malam antara 150k - 500k
            $hargaPerMalam = $faker->numberBetween(150000, 500000);

            // Hitung jumlah hari
            $jumlahHari = $checkin->diffInDays($checkout);

            // Hitung total harga
            $total = $hargaPerMalam * $jumlahHari;

            // Pilih status booking
            $status = $faker->randomElement($statusOptions);

            // Tentukan metode bayar berdasarkan status
            $metodeBayar = null;
            if (in_array($status, ['paid', 'completed'])) {
                $metodeBayar = $faker->randomElement($metodeBayarOptions);
            } elseif ($status === 'confirmed') {
                $metodeBayar = $faker->optional(0.7)->randomElement($metodeBayarOptions);
            }

            // Nama-nama dummy dalam bahasa Indonesia
            $namaWarga = $faker->name();
            $jenisKamar = $faker->randomElement(['Standar', 'Deluxe', 'Suite', 'Family', 'VIP']);

            $bookingData[] = [
                'kamar_id'      => $kamarId,
                'warga_id'      => $wargaId,
                'checkin'       => $checkin->format('Y-m-d'),
                'checkout'      => $checkout->format('Y-m-d'),
                'total'         => $total,
                'status'        => $status,
                'metode_bayar'  => $metodeBayar,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];

            // Tampilkan progress setiap 10 data
            if ($i % 10 === 0) {
                $this->command->info("Membuat data booking ke-$i...");
            }
        }

        // Insert data ke database
        DB::table('booking_homestay')->insert($bookingData);

        // Hitung statistik
        $totalBooking = count($bookingData);
        $totalPendapatan = array_sum(array_column($bookingData, 'total'));
        $totalPendapatanFormatted = number_format($totalPendapatan, 0, ',', '.');

        // Tampilkan informasi hasil seeder
        $this->command->info('=============================================');
        $this->command->info('SEEDER BOOKING HOMESTAY BERHASIL DIBUAT!');
        $this->command->info('=============================================');
        $this->command->info("Total data booking: $totalBooking");
        $this->command->info("Total pendapatan dummy: Rp $totalPendapatanFormatted");
        $this->command->info('');
        $this->command->info('Detail Status Booking:');

        // Hitung jumlah per status
        $statusCount = [];
        foreach ($bookingData as $booking) {
            $status = $booking['status'];
            if (!isset($statusCount[$status])) {
                $statusCount[$status] = 0;
            }
            $statusCount[$status]++;
        }

        foreach ($statusCount as $status => $count) {
            $this->command->info("  - $status: $count booking");
        }

        $this->command->info('');
        $this->command->info('Range tanggal checkin:');
        $tanggalAwal = min(array_column($bookingData, 'checkin'));
        $tanggalAkhir = max(array_column($bookingData, 'checkout'));
        $this->command->info("  $tanggalAwal s/d $tanggalAkhir");
        $this->command->info('=============================================');
    }
}
