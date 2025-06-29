<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Weekly Mood Summary
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">This Week's Mood Distribution</h3>

                    @if($weeklyData->count() > 0)
                        <div style="height: 400px;">
                            <canvas id="weeklyChart"></canvas>
                        </div>

                        <!-- Data Summary -->
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($weeklyData as $data)
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl mb-1">{{ \App\Models\MoodEntry::getMoodEmojis()[$data->mood] }}</div>
                                    <div class="font-medium">{{ $data->mood }}</div>
                                    <div class="text-sm text-gray-600">{{ $data->count }} day{{ $data->count > 1 ? 's' : '' }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">No mood entries for this week yet.</p>
                            <a href="{{ route('mood.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Log Your First Mood
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($weeklyData->count() > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('weeklyChart').getContext('2d');

                const data = {
                    labels: {!! json_encode($weeklyData->pluck('mood')) !!},
                    datasets: [{
                        label: 'Days',
                        data: {!! json_encode($weeklyData->pluck('count')) !!},
                        backgroundColor: [
                            '#FDE047', // Happy - Yellow
                            '#60A5FA', // Sad - Blue
                            '#EF4444', // Angry - Red
                            '#FB923C', // Excited - Orange
                            '#4ADE80', // Calm - Green
                            '#A855F7', // Stressed - Purple
                            '#6B7280', // Anxious - Gray
                            '#EC4899', // Content - Pink
                        ],
                        borderColor: [
                            '#F59E0B',
                            '#3B82F6',
                            '#DC2626',
                            '#EA580C',
                            '#059669',
                            '#7C3AED',
                            '#374151',
                            '#DB2777',
                        ],
                        borderWidth: 2
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Weekly Mood Distribution'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                };

                new Chart(ctx, config);
            });
        </script>
    @endif
</x-app-layout>
