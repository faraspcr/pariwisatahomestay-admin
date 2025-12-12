<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan foreign key biar TRUNCATE aman
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus semua data lama + reset auto increment
        User::truncate();

        // Aktifkan kembali foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Buat Admin
        User::create([
            'name' => 'adminpariwisatadesa',
            'email' => 'adminpariwisatadesa@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Buat Pemilik Homestay
        User::create([
            'name' => 'Faras Zakia',
            'email' => 'Far@gmail.com',
            'password' => Hash::make('Far123'),
            'role' => 'pemilik',
        ]);

        // Pemilik 2
        User::create([
            'name' => 'Siti Pemilik',
            'email' => 'siti@desa.id',
            'password' => Hash::make('pemilik123'),
            'role' => 'pemilik',
        ]);

        // Warga
        User::create([
            'name' => 'Zakia Pemilik',
            'email' => 'Zakia@gmail.com',
            'password' => Hash::make('Zakia123'),
            'role' => 'warga',
        ]);
    }
}
