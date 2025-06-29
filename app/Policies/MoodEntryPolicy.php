<?php


namespace App\Policies;

use App\Models\User;
use App\Models\MoodEntry;

class MoodEntryPolicy
{
    public function update(User $user, MoodEntry $moodEntry): bool
    {
        return $user->id === $moodEntry->user_id;
    }

    public function delete(User $user, MoodEntry $moodEntry): bool
    {
        return $user->id === $moodEntry->user_id;
    }
}
