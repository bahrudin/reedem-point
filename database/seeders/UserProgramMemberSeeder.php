<?php

namespace Database\Seeders;

use App\Models\ProgramMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProgramMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::factory(10)->create();
        $programMembers = ProgramMember::factory( 5)->create();

        // Loop untuk mengaitkan user dengan program member
        $users->each(function ($user) use ($programMembers) {
            $user->programMembers()->attach(
                $programMembers->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
