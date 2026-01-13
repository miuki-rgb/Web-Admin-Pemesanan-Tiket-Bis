<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TiketBus') }}</title>

        <!-- Fonts: Poppins -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS (CDN) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'p-maroon': '#780000',
                            'p-red': '#c1121f',
                            'p-cream': '#fdf0d5',
                            'p-navy': '#003049',
                            'p-blue': '#669bbc',
                        }
                    }
                }
            }
        </script>

        <style>
            body { font-family: 'Poppins', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-p-navy">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-p-navy relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-p-red/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-p-blue/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

            <div class="z-10 text-center mb-6">
                <a href="/" class="flex flex-col items-center">
                    <div class="p-3 bg-p-red rounded-xl shadow-lg shadow-red-900/50 mb-3">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white tracking-wide">TiketBus</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border-t-4 border-p-red">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-p-blue text-sm">
                &copy; {{ date('Y') }} TiketBus System
            </div>
        </div>
    </body>
</html>
