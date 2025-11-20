<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create first admin user hanya dengan faras@gmail.com
        User::create([
            'name' => 'Admin',
            'email' => 'zakia@gmail.com',
            'password' => Hash::make('faraszak123')
        ]);
    }
}
