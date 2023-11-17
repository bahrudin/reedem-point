<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use App\Models\Point;
use App\Models\Program;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Instance generator
        $faker = Faker::create();

        // Ambil ID semua user
        $AuthorIds = Admin::pluck('id')->toArray();
        $CategoryIds = Category::pluck('id')->toArray();

        //article sample
        $program = Program::query()->where('name','article')->first();
        $point = Point::query()->where('program_id',$program->id)->first();

        // Buat 10 data dummy
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence;
            $slug = Str::slug($title);
            Article::create([
                'author_id' => $faker->randomElement($AuthorIds),
                'category_id' => $faker->randomElement($CategoryIds),
                'title' => $title,
                'slug' => $slug,
                'contents' => $faker->paragraph,
                'is_publish' => $faker->boolean,
                'point_type'=>  $faker->randomElement(['one_time','multiple']),
                'point_id' => $point->id,
                'program_id' => $program->id,
            ]);
        }
    }
}
