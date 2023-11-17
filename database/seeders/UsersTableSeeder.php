<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'people_card' => fake()->creditCardNumber(),
            'name' => "User",
            'last_name' => fake()->lastName(),
            'username' => 'user',
            'phone' => fake()->phoneNumber(),
            'email' => "user@user.com",
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'gender' => fake()->randomElement(['Male','Female']),
            'referral_id'=> fake()->numerify('######'),
        ]);

        // Buat 10 data dummy
        for ($i = 1; $i <= 10; $i++) {
            // Buat user dummy
            $user = User::create([
                'people_card' => fake()->creditCardNumber.$i,
                'name' => "User{$i}",
                'last_name' => fake()->lastName(),
                'username' => fake()->userName.$i,
                'phone' => fake()->phoneNumber.$i,
                'email' => "user{$i}@example.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'gender' => fake()->randomElement(['Male','Female']),
                'referral_id'=> fake()->numerify('#######').$i
            ]);

        }
    }
}
