<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deleted Mood Entries
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($deletedEntries->count() > 0)
                        <div class="space-y-4">
                            @foreach($deletedEntries as $entry)
                                <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="text-3xl opacity-50">{{ \App\Models\MoodEntry::getMoodEmojis()[$entry->mood] }}</div>
                                        <div>
                                            <div class="font-semibold text-gray-700">{{ $entry->mood }}</div>
                                            <div class="text-sm text-gray-500">{{ $entry->entry_date->format('F d, Y') }}</div>
                                            <div class="text-xs text-red-600">Deleted: {{ $entry->deleted_at->format('M d, Y H:i') }}</div>
                                            @if($entry->note)
                                                <div class="text-sm text-gray-600 mt-1">{{ $entry->note }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <form method="POST" action="{{ route('mood.restore', $entry->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                Restore
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $deletedEntries->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No deleted entries found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
