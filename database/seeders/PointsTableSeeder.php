<?php

namespace Database\Seeders;

use App\Models\Point;
use App\Models\Program;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $ProgramIds = Program::pluck('id')->toArray();

        for ($i=0; $i < 10; $i++){
            Point::create([
                'program_id' => $faker->randomElement($ProgramIds),
                'min_points' => 100,
                'reward' => 'Reward'.$faker->randomLetter,
                'amount' => $faker->numberBetween(1, 20),
                'point_type' => $faker->randomElement(['multiple','one_time']),
                'start_at' => Carbon::now(),
                'expired_at' => Carbon::now()->addDays(30),
                'converted' => false,
            ]);
        }
    }
}
