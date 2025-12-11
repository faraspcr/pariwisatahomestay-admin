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

        // Ambil semua warga
        $wargas = DB::table('warga')->pluck('warga_id')->toArray();

        if (empty($kamars)) {
            $this->command->error('Tidak ada data kamar homestay. Jalankan seeder kamar homestay terlebih dahulu!');
            return;
        }

        if (empty($wargas)) {
            $this->command->error('Tidak ada data warga. Jalankan seeder warga terlebih dahulu!');
            return;
        }

        $bookingData = [];

        // Array status booking
        $statuses = ['pending', 'confirmed', 'paid', 'cancelled', 'completed'];

        // Array metode pembayaran
        $metodeBayar = ['cash', 'transfer', 'qris', 'other', null];

        // Generate 100 data dummy
        for ($i = 1; $i <= 100; $i++) {
            // Pilih kamar random
            $kamarId = $faker->randomElement($kamars);

            // Ambil harga kamar
            $hargaKamar = DB::table('kamar_homestay')
                ->where('kamar_id', $kamarId)
                ->value('harga');

            // Generate tanggal check-in (dari 30 hari yang lalu sampai 60 hari ke depan)
            $checkin = Carbon::now()
                ->subDays($faker->numberBetween(0, 30))
                ->addDays($faker->numberBetween(0, 60));

            // Generate tanggal check-out (1-14 hari setelah check-in)
            $checkout = $checkin->copy()->addDays($faker->numberBetween(1, 14));

            // Hitung jumlah hari
            $jumlahHari = $checkin->diffInDays($checkout);

            // Hitung total (harga kamar × jumlah hari + random fee)
            $total = ($hargaKamar * $jumlahHari) + $faker->numberBetween(0, 100000);

            // Pilih status random
            $status = $faker->randomElement($statuses);

            // Jika status bukan pending atau cancelled, set metode bayar
            $metode = null;
            if (!in_array($status, ['pending', 'cancelled'])) {
                $metode = $faker->randomElement($metodeBayar);
            }

            // Jika status completed, pastikan check-out sudah lewat
            if ($status === 'completed' && $checkout->isFuture()) {
                $checkout = $checkin->copy()->subDays($faker->numberBetween(1, 30));
                $jumlahHari = $checkin->diffInDays($checkout);
                $total = ($hargaKamar * $jumlahHari) + $faker->numberBetween(0, 100000);
            }

            // Jika status cancelled, kurangi kemungkinan punya metode bayar
            if ($status === 'cancelled' && $faker->boolean(30)) {
                $metode = $faker->randomElement($metodeBayar);
            }

            $bookingData[] = [
                'kamar_id'      => $kamarId,
                'warga_id'      => $faker->randomElement($wargas),
                'checkin'       => $checkin->format('Y-m-d'),
                'checkout'      => $checkout->format('Y-m-d'),
                'total'         => round($total, 2),
                'status'        => $status,
                'metode_bayar'  => $metode,
                'created_at'    => $checkin->copy()->subDays($faker->numberBetween(1, 10)),
                'updated_at'    => now(),
            ];
        }

        // Insert data ke database
        DB::table('booking_homestay')->insert($bookingData);

        $this->command->info('Seeder Booking Homestay Dummy berhasil dijalankan!');
        $this->command->info('Total data booking: ' . count($bookingData));
        $this->command->info('Perintah: php artisan db:seed --class=CreateBookingHomestayDummy');

        // Tampilkan statistik
        $this->command->info("\nStatistik Status Booking:");
        foreach ($statuses as $status) {
            $count = DB::table('booking_homestay')->where('status', $status)->count();
            $this->command->info("- {$status}: {$count} data");
        }
    }
}
