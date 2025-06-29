<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mood Entry
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('mood.update', $moodEntry) }}">
                        @csrf
                        @method('PUT')

                        <!-- Date (Read-only) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Date</label>
                            <div class="mt-1 p-2 bg-gray-100 rounded-md">
                                {{ $moodEntry->entry_date->format('F d, Y') }}
                            </div>
                        </div>

                        <!-- Mood Selection -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-3">How are you feeling?</label>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach(['Happy', 'Sad', 'Angry', 'Excited', 'Calm', 'Stressed', 'Anxious', 'Content'] as $mood)
                                    <label class="relative">
                                        <input type="radio" name="mood" value="{{ $mood }}" class="sr-only peer" {{ (old('mood', $moodEntry->mood) == $mood) ? 'checked' : '' }}>
                                        <div class="p-4 text-center rounded-lg border-2 border-gray-200 cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50">
                                            <div class="text-2xl mb-1">{{ \App\Models\MoodEntry::getMoodEmojis()[$mood] }}</div>
                                            <div class="text-sm font-medium">{{ $mood }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('mood')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Note -->
                        <div class="mb-4">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note (Optional)</label>
                            <textarea name="note" id="note" rows="3" class="mt-1 block w-full rounded-md border-gray-300
                            shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Add a note about your day...">{{ old('note', $moodEntry->note) }}</textarea>
                            @error('note')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Mood
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
