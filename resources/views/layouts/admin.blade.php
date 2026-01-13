<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TiketBus') }} - Admin</title>

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
        body { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        aside::-webkit-scrollbar { width: 6px; }
        aside::-webkit-scrollbar-track { background: #003049; }
        aside::-webkit-scrollbar-thumb { background: #669bbc; border-radius: 3px; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-p-navy">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-p-navy text-white min-h-screen fixed top-0 left-0 bottom-0 overflow-y-auto z-30 shadow-2xl">
            <div class="p-6 flex items-center justify-center border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-p-red rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-wide text-p-cream">BusAdmin</span>
                </div>
            </div>

            <nav class="mt-6 px-4 space-y-1">
                <p class="px-4 text-xs font-bold text-p-blue uppercase tracking-wider mb-2 mt-4">Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-p-red text-white shadow-lg shadow-red-900/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-p-blue group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>

                <p class="px-4 text-xs font-bold text-p-blue uppercase tracking-wider mb-2 mt-6">Master Data</p>
                
                <a href="{{ route('admin.buses.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.buses.*') ? 'bg-p-red text-white shadow-lg shadow-red-900/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('admin.buses.*') ? 'text-white' : 'text-p-blue group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Armada Bus
                </a>
                
                <a href="{{ route('admin.routes.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.routes.*') ? 'bg-p-red text-white shadow-lg shadow-red-900/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('admin.routes.*') ? 'text-white' : 'text-p-blue group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.806-.984A1 1 0 0121 6.618c0-.62-.516-1.12-1.153-1.077L15 7m0 13V7"></path>
                    </svg>
                    Rute Perjalanan
                </a>
                
                <a href="{{ route('admin.schedules.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.schedules.*') ? 'bg-p-red text-white shadow-lg shadow-red-900/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('admin.schedules.*') ? 'text-white' : 'text-p-blue group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Jadwal & Tiket
                </a>

                <p class="px-4 text-xs font-bold text-p-blue uppercase tracking-wider mb-2 mt-6">Operasional</p>

                <a href="{{ route('admin.bookings.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.bookings.*') ? 'bg-p-red text-white shadow-lg shadow-red-900/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('admin.bookings.*') ? 'text-white' : 'text-p-blue group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Pemesanan
                </a>
                
                <a href="{{ route('admin.scanner') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.scanner') ? 'bg-p-red text-white shadow-lg shadow-red-900/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('admin.scanner') ? 'text-white' : 'text-p-blue group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 17h.01M9 17h.01M19 17h.01M3 13h2.25a1 1 0 01.996 1.002L6.25 15H8v2H6.25a2 2 0 00-1.991 1.991l-.009.009H3V13zm3-3V9h4v5H6zM6 5v4h4V5H6z"></path>
                    </svg>
                    Scan Tiket
                </a>
                
                <a href="{{ route('admin.reports.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reports.*') ? 'bg-p-red text-white shadow-lg shadow-red-900/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('admin.reports.*') ? 'text-white' : 'text-p-blue group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Laporan
                </a>
            </nav>
            
            <div class="absolute bottom-0 w-full p-4 bg-black/20 border-t border-white/5">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-p-red flex items-center justify-center text-white font-bold border-2 border-p-cream">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-p-blue">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 min-h-screen flex flex-col bg-gray-50">
            <!-- Topbar -->
            <header class="bg-white/80 backdrop-blur-md shadow-sm z-10 sticky top-0 border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-4 px-8 flex justify-between items-center">
                    <h2 class="font-bold text-2xl text-p-navy leading-tight tracking-tight flex items-center">
                        @yield('header')
                    </h2>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-p-red flex items-center transition-colors" target="_blank">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Lihat Website
                        </a>
                        <div class="h-6 w-px bg-gray-300"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-p-red hover:text-p-maroon hover:bg-red-50 px-4 py-2 rounded-lg transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="py-8 px-8 flex-1 overflow-y-auto fade-in">
                @if(session('success'))
                    <div class="bg-p-cream border-l-4 border-green-500 text-p-navy p-4 mb-6 rounded-r-lg shadow-sm flex justify-between items-center" role="alert">
                        <div>
                            <p class="font-bold text-green-700">Berhasil!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-p-red text-red-700 p-4 mb-6 rounded-r-lg shadow-sm flex justify-between items-center" role="alert">
                        <div>
                            <p class="font-bold text-p-red">Gagal!</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>