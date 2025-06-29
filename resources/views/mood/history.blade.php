<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Mood History
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <div class="mb-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('mood.history') }}" class="flex flex-wrap items-end gap-4">
                        <div class="flex flex-col">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="self-end px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                Filter
                            </button>
                            <a href="{{ route('mood.history') }}" class="self-end px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Entries List -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($entries->count() > 0)
                        <div class="space-y-4">
                            @foreach($entries as $entry)
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-50">
                                    <div class="flex items-center space-x-4">
                                        <div class="text-3xl">{{ \App\Models\MoodEntry::getMoodEmojis()[$entry->mood] }}</div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $entry->mood }}</div>
                                            <div class="text-sm text-gray-600">{{ $entry->entry_date->format('F d, Y') }}</div>
                                            @if($entry->note)
                                                <div class="mt-1 text-sm text-gray-700">{{ $entry->note }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('mood.edit', $entry) }}" class="text-sm text-blue-600 hover:text-blue-800">Edit</a>
                                        <form method="POST" action="{{ route('mood.destroy', $entry) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $entries->appends(request()->query())->links() }}
                        </div>
                    @else
                        <p class="py-8 text-center text-gray-500">No mood entries found for the selected period.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
