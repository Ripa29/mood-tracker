<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mood Tracker Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Streak Badge -->
            @if($streakCount >= 3)
                <div class="mb-6">
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-lg p-4 text-white text-center">
                        <h3 class="text-lg font-bold">🔥 Streak Badge!</h3>
                        <p>{{ $streakCount }} days in a row! Keep it up!</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Today's Mood -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Today's Mood</h3>
                        @if($todayEntry)
                            <div class="text-center">
                                <div class="text-4xl mb-2">{{ \App\Models\MoodEntry::getMoodEmojis()[$todayEntry->mood] }}</div>
                                <div class="font-medium text-gray-900">{{ $todayEntry->mood }}</div>
                                @if($todayEntry->note)
                                    <p class="text-sm text-gray-600 mt-2">{{ $todayEntry->note }}</p>
                                @endif
                                <div class="mt-4 space-x-2">
                                    <a href="{{ route('mood.edit', $todayEntry) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form method="POST" action="{{ route('mood.destroy', $todayEntry) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="text-center">
                                <p class="text-gray-500 mb-4">No mood logged today</p>
                                <a href="{{ route('mood.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Log Today's Mood
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('mood.create') }}" class="block w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center">
                                📝 New Entry
                            </a>
                            <a href="{{ route('mood.history') }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                📖 View History
                            </a>
                            <a href="{{ route('mood.weekly') }}" class="block w-full bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-center">
                                📊 Weekly Chart
                            </a>
                            <a href="{{ route('mood.deleted') }}" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                                🗑️ Deleted Entries
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Entries -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Entries</h3>
                        @if($recentEntries->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentEntries as $entry)
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-lg">{{ \App\Models\MoodEntry::getMoodEmojis()[$entry->mood] }}</span>
                                            <div>
                                                <div class="font-medium">{{ $entry->mood }}</div>
                                                <div class="text-xs text-gray-500">{{ $entry->entry_date->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No entries yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
