<?php
// database/seeders/MoodEntrySeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MoodEntry;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MoodEntrySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'phone' => '+8801234567890',
                'password' => bcrypt('password'),
            ]);
        }

        $moods = ['Happy', 'Sad', 'Angry', 'Excited', 'Calm', 'Stressed', 'Anxious', 'Content'];

        for ($i = 30; $i >= 0; $i--) {
            MoodEntry::create([
                'user_id' => $user->id,
                'mood' => $moods[array_rand($moods)],
                'note' => 'Sample note for day ' . $i,
                'entry_date' => Carbon::now()->subDays($i),
            ]);
        }
    }
}
