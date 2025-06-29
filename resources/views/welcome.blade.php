<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daily Mood Tracker - Track Your Emotional Journey</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

<!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .mood-float {
                animation: float 3s ease-in-out infinite;
            }
            .mood-float:nth-child(2) {
                animation-delay: 0.5s;
            }
            .mood-float:nth-child(3) {
                animation-delay: 1s;
            }
            .mood-float:nth-child(4) {
                animation-delay: 1.5s;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            .fade-in {
                animation: fadeIn 1s ease-in;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex items-center flex-shrink-0">
                            <img src="Moodtracker logo.avif" alt="MoodTracker Logo" class="w-20 h-13 ">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors rounded-md hover:text-indigo-600">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors rounded-md hover:text-indigo-600">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-md hover:bg-indigo-700">Get Started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
       <!-- Hero Section -->
<section class="text-white gradient-bg">
    <div class="px-4 py-20 mx-auto sm:py-24 max-w-7xl sm:px-6 lg:px-8">
        <div class="text-center fade-in">
            <!-- Emoji Row -->
            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-4 mb-6">
                    <span class="text-5xl sm:text-6xl mood-float">😊</span>
                    <span class="text-5xl sm:text-6xl mood-float">🤗</span>
                    <span class="text-5xl sm:text-6xl mood-float">😌</span>
                    <span class="text-5xl sm:text-6xl mood-float">🥰</span>
                </div>
            </div>

            <!-- Headline -->
            <h1 class="mb-4 text-4xl font-bold leading-tight sm:text-5xl md:text-6xl">
                Track Your <span class="text-yellow-300">Emotional Journey</span>
            </h1>

            <!-- Subheadline -->
            <p class="max-w-3xl mx-auto mb-8 text-lg text-gray-200 sm:text-xl md:text-2xl">
                Monitor your daily moods, discover patterns, and build better emotional habits with our intuitive mood tracking platform.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col items-center justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-8 py-4 text-lg font-semibold text-indigo-600 transition-all duration-300 transform bg-white rounded-lg hover:bg-gray-100 hover:scale-105">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="inline-block px-8 py-4 text-lg font-semibold text-indigo-600 transition-all duration-300 transform bg-white rounded-lg hover:bg-gray-100 hover:scale-105">
                        Start Tracking Free
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-block px-8 py-4 text-lg font-semibold text-white transition-all duration-300 border-2 border-white rounded-lg hover:bg-white hover:text-indigo-600">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>



        <!-- Features Section -->
        <section class="py-20 bg-gray-50">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-bold text-gray-900">Why Choose MoodTracker?</h2>
                    <p class="max-w-2xl mx-auto text-xl text-gray-600">
                        Simple, powerful tools to help you understand and improve your emotional well-being.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="p-8 text-center transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
                        <div class="mb-4 text-4xl">📱</div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Easy Daily Logging</h3>
                        <p class="text-gray-600">
                            Log your mood in seconds with our intuitive interface. One tap, one mood, endless insights.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 text-center transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
                        <div class="mb-4 text-4xl">📊</div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Visual Analytics</h3>
                        <p class="text-gray-600">
                            Beautiful charts and graphs help you identify patterns and trends in your emotional journey.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 text-center transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
                        <div class="mb-4 text-4xl">🏆</div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Streak Rewards</h3>
                        <p class="text-gray-600">
                            Stay motivated with streak badges and achievements for consistent mood tracking.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-8 text-center transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
                        <div class="mb-4 text-4xl">🔒</div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Private & Secure</h3>
                        <p class="text-gray-600">
                            Your emotional data is completely private and secure. Only you can access your mood history.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="p-8 text-center transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
                        <div class="mb-4 text-4xl">📝</div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Personal Notes</h3>
                        <p class="text-gray-600">
                            Add context to your moods with personal notes and reflections for deeper self-awareness.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="p-8 text-center transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
                        <div class="mb-4 text-4xl">📱</div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Mobile Friendly</h3>
                        <p class="text-gray-600">
                            Track your moods anywhere, anytime with our fully responsive mobile-optimized design.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-20 bg-white">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-bold text-gray-900">How It Works</h2>
                    <p class="text-xl text-gray-600">
                        Getting started is simple and takes less than a minute.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full">
                            <span class="text-2xl font-bold text-indigo-600">1</span>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Sign Up</h3>
                        <p class="text-gray-600">
                            Create your free account using just your phone number and password. No email required.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full">
                            <span class="text-2xl font-bold text-indigo-600">2</span>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Log Your Mood</h3>
                        <p class="text-gray-600">
                            Select your daily mood from our emoji-based interface and add optional notes.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full">
                            <span class="text-2xl font-bold text-indigo-600">3</span>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900">Track Progress</h3>
                        <p class="text-gray-600">
                            View your mood history, weekly charts, and earn streak badges for consistency.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 text-white gradient-bg">
            <div class="max-w-4xl px-4 mx-auto text-center sm:px-6 lg:px-8">
                <h2 class="mb-6 text-4xl font-bold">Ready to Start Your Journey?</h2>
                <p class="mb-8 text-xl text-gray-200">
                    Join thousands of users who are already tracking their emotional well-being and building better habits.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="inline-block px-8 py-4 text-lg font-semibold text-indigo-600 transition-all duration-300 transform bg-white rounded-lg hover:bg-gray-100 hover:scale-105">
                        Get Started Today - It's Free!
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-4 text-lg font-semibold text-indigo-600 transition-all duration-300 transform bg-white rounded-lg hover:bg-gray-100 hover:scale-105">
                        Continue Your Journey
                    </a>
                @endguest
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 text-white bg-gray-900">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                    <div class="col-span-2">
                        <div class="flex items-center mb-4">
                            <img src="Moodtracker logo.avif" alt="MoodTracker Logo" class="w-40 h-20 ">
                        </div>
                        <p class="mb-4 text-gray-400">
                            Your personal companion for emotional well-being and mental health awareness.
                        </p>
                        <div class="flex gap-3 space-x-3 sm:space-x-4">
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-gray-400 transition-all duration-300 transform bg-gray-700 rounded-full hover:bg-indigo-600 hover:text-white hover:-translate-y-1" aria-label="Facebook">
                                <i class="text-lg fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-gray-400 transition-all duration-300 transform bg-gray-700 rounded-full hover:bg-blue-500 hover:text-white hover:-translate-y-1" aria-label="Twitter">
                                <i class="text-lg fab fa-twitter"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-gray-400 transition-all duration-300 transform bg-gray-700 rounded-full hover:bg-pink-600 hover:text-white hover:-translate-y-1" aria-label="Instagram">
                                <i class="text-lg fab fa-instagram"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-gray-400 transition-all duration-300 transform bg-gray-700 rounded-full hover:bg-blue-700 hover:text-white hover:-translate-y-1" aria-label="LinkedIn">
                                <i class="text-lg fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Features</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>Daily Mood Logging</li>
                            <li>Mood History</li>
                            <li>Weekly Analytics</li>
                            <li>Streak Tracking</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="mb-4 text-lg font-semibold">Support</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>Help Center</li>
                            <li>Privacy Policy</li>
                            <li>Terms of Service</li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                </div>

                <div class="pt-8 mt-8 text-center text-gray-400 border-t border-gray-800">
                    <p>&copy; {{ date('Y') }} MoodTracker. All rights reserved. Made with ❤️ for better mental health.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
