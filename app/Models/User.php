<?php


namespace App\Models;

use App\Models\MoodEntry;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function moodEntries()
    {
        return $this->hasMany(MoodEntry::class);
    }

    public function getStreakCountAttribute()
    {
        $entries = $this->moodEntries()
            ->whereNull('deleted_at')
            ->orderBy('entry_date', 'desc')
            ->get();

        $streak = 0;
        $currentDate = now()->format('Y-m-d');

        foreach ($entries as $entry) {
            if ($entry->entry_date === $currentDate) {
                $streak++;
                $currentDate = date('Y-m-d', strtotime($currentDate . ' -1 day'));
            } else {
                break;
            }
        }

        return $streak;
    }
}
