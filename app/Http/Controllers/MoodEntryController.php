<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MoodEntry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MoodEntryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();
        $todayEntry = $user->moodEntries()
            ->whereDate('entry_date', today())
            ->whereNull('deleted_at')
            ->first();

        $recentEntries = $user->moodEntries()
            ->whereNull('deleted_at')
            ->orderBy('entry_date', 'desc')
            ->take(5)
            ->get();

        $streakCount = $user->streak_count;

        return view('dashboard', compact('todayEntry', 'recentEntries', 'streakCount'));
    }

    public function create()
    {
        $today = today()->format('Y-m-d');
        $existingEntry = Auth::user()->moodEntries()
            ->whereDate('entry_date', $today)
            ->whereNull('deleted_at')
            ->first();

        if ($existingEntry) {
            return redirect()->route('mood.edit', $existingEntry->id);
        }

        return view('mood.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|in:Happy,Sad,Angry,Excited,Calm,Stressed,Anxious,Content',
            'note' => 'nullable|string|max:500',
            'entry_date' => [
                'required',
                'date',
                'before_or_equal:today',
                Rule::unique('mood_entries')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);

        Auth::user()->moodEntries()->create(
            $request->only('mood', 'note', 'entry_date')
        );

        return redirect()->route('dashboard')->with('success', 'Mood entry created successfully!');
    }

    public function edit(MoodEntry $moodEntry)
    {
        $this->authorize('update', $moodEntry);
        return view('mood.edit', compact('moodEntry'));
    }

    public function update(Request $request, MoodEntry $moodEntry)
    {
        $this->authorize('update', $moodEntry);

        $request->validate([
            'mood' => 'required|in:Happy,Sad,Angry,Excited,Calm,Stressed,Anxious,Content',
            'note' => 'nullable|string|max:500',
        ]);

        $moodEntry->update($request->only(['mood', 'note']));

        return redirect()->route('dashboard')->with('success', 'Mood entry updated successfully!');
    }

    public function destroy(MoodEntry $moodEntry)
    {
        $this->authorize('delete', $moodEntry);
        $moodEntry->delete();

        return redirect()->back()->with('success', 'Mood entry deleted successfully!');
    }

    public function history(Request $request)
    {
        $query = Auth::user()->moodEntries()->whereNull('deleted_at');

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('entry_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('entry_date', '<=', $request->end_date);
        }

        $entries = $query->orderBy('entry_date', 'desc')->paginate(10);

        return view('mood.history', compact('entries'));
    }

    public function weekly()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyData = Auth::user()->moodEntries()
            ->whereNull('deleted_at')
            ->whereBetween('entry_date', [$startOfWeek, $endOfWeek])
            ->selectRaw('mood, COUNT(*) as count')
            ->groupBy('mood')
            ->get();

        return view('mood.weekly', compact('weeklyData'));
    }

    public function deleted()
    {
        $deletedEntries = Auth::user()->moodEntries()
            ->onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('mood.deleted', compact('deletedEntries'));
    }

    public function restore($id)
    {
        $entry = Auth::user()->moodEntries()->withTrashed()->findOrFail($id);
        $entry->restore();

        return redirect()->back()->with('success', 'Mood entry restored successfully!');
    }
}
