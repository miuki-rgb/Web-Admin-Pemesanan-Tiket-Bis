@extends('layouts.admin')

@section('header')
    Dasbor Utama
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Revenue -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-green-500">
        <div class="p-5 flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Total Pendapatan</p>
                <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($revenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Occupancy -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-blue-500">
        <div class="p-5 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Tingkat Okupansi</p>
                <p class="text-2xl font-bold text-gray-800">{{ number_format($occupancyRate, 1) }}%</p>
            </div>
        </div>
    </div>

    <!-- Total Buses -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-indigo-500">
        <div class="p-5 flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Total Armada</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalBuses }} Unit</p>
            </div>
        </div>
    </div>

    <!-- Total Routes -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-yellow-500">
        <div class="p-5 flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.806-.984A1 1 0 0121 6.618c0-.62-.516-1.12-1.153-1.077L15 7m0 13V7" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Rute Aktif</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalRoutes }} Rute</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white overflow-hidden shadow-lg rounded-xl">
    <div class="p-6 bg-white border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold leading-6 text-gray-800">Pemesanan Terbaru</h3>
        <a href="{{ route('admin.bookings.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Lihat Semua &rarr;</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Rute</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($recentBookings as $booking)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $booking->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $booking->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $booking->schedule->route->origin }} - {{ $booking->schedule->route->destination }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('d M, H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                               ($booking->status === 'paid' ? 'bg-blue-100 text-blue-800' : 
                               ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                            {{ ucfirst($booking->status === 'paid' ? 'Dibayar' : ($booking->status === 'confirmed' ? 'Dikonfirmasi' : ($booking->status === 'cancelled' ? 'Dibatalkan' : 'Menunggu'))) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded hover:bg-indigo-100 transition">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection