<?php

use App\Models\MoodEntry;
use App\Policies\MoodEntryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        MoodEntry::class => MoodEntryPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
