<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Log Your Mood
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('mood.store') }}">
                        @csrf

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="entry_date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input
                                type="date"
                                name="entry_date"
                                id="entry_date"
                                value="{{ old('entry_date', date('Y-m-d')) }}"
                                max="{{ date('Y-m-d') }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                            @error('entry_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mood Selection -->
                        <div class="mb-4">
                            <label class="block mb-3 text-sm font-medium text-gray-700">How are you feeling?</label>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach(['Happy', 'Sad', 'Angry', 'Excited', 'Calm', 'Stressed', 'Anxious', 'Content'] as $mood)
                                    <label class="relative">
                                        <input
                                            type="radio"
                                            name="mood"
                                            value="{{ $mood }}"
                                            class="sr-only peer"
                                            {{ old('mood') == $mood ? 'checked' : '' }}
                                        >
                                        <div
                                            class="p-4 text-center border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50"
                                        >
                                            <div class="mb-1 text-2xl">{{ \App\Models\MoodEntry::getMoodEmojis()[$mood] }}</div>
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
                            <textarea
                                name="note"
                                id="note"
                                rows="3"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Add a note about your day..."
                            >{{ old('note') }}</textarea>
                            @error('note')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
                            <button
                                type="submit"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                            >
                                Save Mood
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
