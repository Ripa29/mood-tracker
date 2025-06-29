<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MoodEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'mood',
        'note',
        'entry_date',
    ];

    protected $casts = [
        'entry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getMoodColors()
    {
        return [
            'Happy' => 'bg-yellow-400',
            'Sad' => 'bg-blue-400',
            'Angry' => 'bg-red-500',
            'Excited' => 'bg-orange-400',
            'Calm' => 'bg-green-400',
            'Stressed' => 'bg-purple-500',
            'Anxious' => 'bg-gray-500',
            'Content' => 'bg-pink-400',
        ];
    }

    public static function getMoodEmojis()
    {
        return [
            'Happy' => '😊',
            'Sad' => '😢',
            'Angry' => '😠',
            'Excited' => '🤩',
            'Calm' => '😌',
            'Stressed' => '😰',
            'Anxious' => '😟',
            'Content' => '😌',
        ];
    }

}
