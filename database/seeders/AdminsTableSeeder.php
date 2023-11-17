<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Master
        Admin::create([
            'name' => 'Bahrudin',
            'last_name' => 'Ardiansyah',
            'username' => 'bahrudin',
            'email' => 'bahrudin.no8@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'remember_token' => Str::random(10),
            'roles_id' => 1
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $role = Role::all()->pluck('id');
            Admin::create([
                'name' => "Admin{$i}",
                'last_name' => 'Lastname'.$i,
                'username' => 'admin'.$i,
                'email' => "admin{$i}@admin.com",
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'phone' => "0812345600{$i}",
                'remember_token' => Str::random(10),
                'roles_id' => fake()->randomElement($role),
            ]);
        }
    }
}
