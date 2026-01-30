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
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
            [x-cloak] { display: none !important; }
            .fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-p-cream text-p-navy">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm z-10 relative border-b border-p-cream">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 fade-in">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-p-navy text-white py-12 mt-12 border-t-4 border-p-red">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-2xl font-bold mb-4 text-p-cream">TiketBus</h3>
                        <p class="text-p-blue text-sm leading-relaxed">
                            Mitra perjalanan terpercaya Anda. Menghubungkan kota, menyatukan cerita dengan kenyamanan dan keamanan armada terbaik.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4 text-lg border-b border-p-blue inline-block pb-1">Tautan Cepat</h4>
                        <ul class="space-y-3 text-sm text-gray-300">
                            <li><a href="{{ route('home') }}" class="hover:text-p-cream hover:underline transition">Cari Tiket</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-p-cream hover:underline transition">Masuk Akun</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-p-cream hover:underline transition">Daftar Baru</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4 text-lg border-b border-p-blue inline-block pb-1">Hubungi Kami</h4>
                        <p class="text-gray-300 text-sm mb-2">
                            <strong class="text-p-cream">Email:</strong> support@tiketbus.com
                        </p>
                        <p class="text-gray-300 text-sm">
                            <strong class="text-p-cream">Telp:</strong> (021) 555-0123
                        </p>
                    </div>
                </div>
                <div class="mt-12 pt-8 border-t border-white/10 text-center text-sm text-p-blue">
                    &copy; copyright by 23552011413_Luki Solihin_TIFRP23CNSB_UASWEB!
                </div>
            </footer>
        </div>
    </body>
</html>
