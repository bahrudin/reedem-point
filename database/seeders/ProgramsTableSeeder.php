<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $programNames = ['article','games','film','ticket'];

        for ($i = 0; $i < 10; $i++) {
            $programName = $faker->randomElement($programNames);
             Program::firstOrCreate(['name' => $programName]);
        }
    }
}
