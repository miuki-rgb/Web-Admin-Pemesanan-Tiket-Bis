<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-p-navy text-white overflow-hidden shadow-xl border-b-4 border-p-red">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-30 mix-blend-overlay" src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2069&auto=format&fit=crop" alt="Bus Travel">
        </div>
        <div class="relative max-w-7xl mx-auto py-28 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl mb-6 text-white drop-shadow-lg">
                Jelajahi Kota, <span class="text-p-cream underline decoration-p-red decoration-4">Tanpa Ribet</span>
            </h1>
            <p class="mt-4 text-xl text-gray-200 max-w-3xl mx-auto font-light">
                Pesan tiket bus antar kota dengan mudah, cepat, dan aman dari kenyamanan rumah Anda.
            </p>
        </div>
    </div>

    <!-- Search Box Section (Overlapping Hero) -->
    <div class="relative -mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8 border border-gray-100">
            <h2 class="text-xl font-bold text-p-navy mb-6 flex items-center border-b pb-4 border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-p-red" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari Jadwal Keberangkatan
            </h2>
            <form action="{{ route('bookings.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Origin -->
                <div class="relative">
                    <label for="origin" class="block text-sm font-bold text-p-navy mb-1">Dari Mana?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <select name="origin" id="origin" class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white shadow-sm focus:border-p-navy focus:ring-p-navy transition duration-200">
                            <option value="">Pilih Kota Asal</option>
                            @foreach($origins as $org)
                                <option value="{{ $org }}" {{ request('origin') == $org ? 'selected' : '' }}>{{ $org }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Destination -->
                <div class="relative">
                    <label for="destination" class="block text-sm font-bold text-p-navy mb-1">Mau Kemana?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.806-.984A1 1 0 0121 6.618c0-.62-.516-1.12-1.153-1.077L15 7m0 13V7" />
                            </svg>
                        </div>
                        <select name="destination" id="destination" class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white shadow-sm focus:border-p-navy focus:ring-p-navy transition duration-200">
                            <option value="">Pilih Kota Tujuan</option>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest }}" {{ request('destination') == $dest ? 'selected' : '' }}>{{ $dest }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Date -->
                <div class="relative">
                    <label for="date" class="block text-sm font-bold text-p-navy mb-1">Tanggal Pergi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="date" name="date" id="date" value="{{ request('date') }}" class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white shadow-sm focus:border-p-navy focus:ring-p-navy transition duration-200">
                    </div>
                </div>

                <!-- Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-p-red hover:bg-p-maroon text-white font-bold py-2.5 px-4 rounded-lg shadow-lg shadow-red-200 transform hover:-translate-y-0.5 transition duration-200 flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Cari Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(request()->has('origin') || request()->has('destination'))
            <h3 class="text-2xl font-bold text-p-navy mb-6 flex items-center">
                <span class="w-2 h-8 bg-p-red mr-3 rounded-full"></span>
                Hasil Pencarian
            </h3>
        @else
            <h3 class="text-2xl font-bold text-p-navy mb-6 flex items-center">
                <span class="w-2 h-8 bg-p-red mr-3 rounded-full"></span>
                Jadwal Populer
            </h3>
        @endif

        <div class="grid grid-cols-1 gap-6">
            @forelse($schedules as $schedule)
            <div class="bg-white rounded-xl shadow-lg shadow-gray-200/50 overflow-hidden hover:shadow-xl transition duration-300 border border-gray-100 group">
                <div class="md:flex">
                    <!-- Image Section -->
                    <div class="md:shrink-0 relative">
                        @if($schedule->route->photo)
                            <img class="h-48 w-full md:w-64 object-cover transition duration-300 group-hover:scale-105" src="{{ asset('storage/' . $schedule->route->photo) }}" alt="Route">
                        @else
                            <div class="h-48 w-full md:w-64 bg-p-blue/20 flex items-center justify-center">
                                <svg class="h-12 w-12 text-p-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-0 left-0 bg-p-navy text-white text-xs font-bold px-3 py-1.5 m-3 rounded shadow-md">
                            {{ $schedule->bus->name }}
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-6 w-full flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center text-sm text-p-red font-bold tracking-wide uppercase mb-1">
                                    {{ \Carbon\Carbon::parse($schedule->departure_time)->format('D, d M Y') }}
                                </div>
                                <div class="flex items-center text-2xl font-bold text-p-navy">
                                    {{ $schedule->route->origin }} 
                                    <svg class="h-5 w-5 mx-3 text-p-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                    {{ $schedule->route->destination }}
                                </div>
                                <div class="mt-3 text-gray-500 text-sm flex items-center bg-gray-50 w-fit px-3 py-1 rounded-full">
                                    <svg class="h-4 w-4 mr-2 text-p-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-semibold text-p-navy">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }}</span>
                                    <span class="mx-2 text-gray-300">|</span>
                                    Tiba: {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('H:i') }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-extrabold text-p-navy">Rp {{ number_format($schedule->price, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-400 mt-1 uppercase tracking-wider font-semibold">Per Kursi</div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Tersedia: <span class="font-bold ml-1 text-lg {{ $schedule->stock_available < 5 ? 'text-p-red' : 'text-p-navy' }}">{{ $schedule->stock_available }}</span> <span class="ml-1 text-gray-400">Kursi</span>
                            </div>
                            <a href="{{ route('bookings.create', $schedule) }}" class="inline-flex items-center justify-center px-8 py-2.5 border border-transparent text-sm font-bold rounded-lg text-white bg-p-red hover:bg-p-maroon transition duration-200 shadow-md shadow-red-100 hover:shadow-lg">
                                Pesan Tiket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                @if(request()->has('origin'))
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center border border-gray-100">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-lg font-bold text-p-navy">Tidak ada jadwal ditemukan</h3>
                        <p class="mt-1 text-gray-500">Coba cari dengan tanggal atau rute yang berbeda.</p>
                    </div>
                @else
                    <div class="bg-white/50 rounded-xl p-12 text-center border-2 border-dashed border-p-blue/30">
                        <p class="text-p-navy font-medium text-lg">Silakan gunakan formulir di atas untuk mencari tiket bus.</p>
                    </div>
                @endif
            @endforelse
        </div>
    </div>
</x-app-layout>
