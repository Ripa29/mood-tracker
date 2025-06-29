<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoodEntryController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MoodEntryController::class, 'index'])->name('dashboard');

    //  MoodEntry
    Route::resource('mood', MoodEntryController::class)->parameters([
        'mood' => 'moodEntry'
        ,])->except(['show']);

    Route::get('/mood-history', [MoodEntryController::class, 'history'])->name('mood.history');
    Route::get('/mood-weekly', [MoodEntryController::class, 'weekly'])->name('mood.weekly');
    Route::get('/mood-deleted', [MoodEntryController::class, 'deleted'])->name('mood.deleted');
    Route::post('/mood-restore/{id}', [MoodEntryController::class, 'restore'])->name('mood.restore');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

