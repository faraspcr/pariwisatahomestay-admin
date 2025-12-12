<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        // // User Admin
        // User::create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@binadesa.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password123'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // Generate user dummy
        foreach (range(1, 100) as $index) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => $faker->randomElement([now(), null]),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
