<?php

namespace Database\Seeders;

use App\Models\coach;
use App\Models\member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoachMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = member::all();
        $coaches = coach::all();
        $statuses = ['pending', 'Rejected', 'Accepted'];

        // Ensure there are members and coaches to work with
        if ($members->isNotEmpty() && $coaches->isNotEmpty()) {
            foreach ($members as $member) {
                DB::table('coach_member')->insert([
                    'member_id' => $member->id,
                    'coach_id' => $coaches->random()->id, // Randomly pick a coach
                    'status' => $statuses[array_rand($statuses)], // Randomly pick a status
                ]);
            }
        }
    }
}
