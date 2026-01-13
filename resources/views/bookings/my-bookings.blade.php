<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($bookings->isEmpty())
                        <p class="text-center text-gray-500">You have no bookings yet.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($bookings as $booking)
                                <div class="border rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center">
                                    <div class="flex-1">
                                        <div class="text-xs text-gray-500 mb-1">Booking #{{ $booking->id }} &bull; {{ $booking->created_at->format('M d, Y') }}</div>
                                        <div class="text-lg font-bold text-gray-900 mb-1">
                                            {{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}
                                        </div>
                                        <div class="text-gray-700 mb-1">
                                            {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('D, M d - H:i') }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $booking->quantity }} Seat(s) | Total: ${{ number_format($booking->total_price, 2) }}
                                        </div>
                                    </div>

                                    <div class="mt-4 md:mt-0 md:ml-6 flex flex-col items-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold mb-2
                                            {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                               ($booking->status === 'paid' ? 'bg-blue-100 text-blue-800' : 
                                               ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>

                                        @if($booking->status === 'pending')
                                            <a href="{{ route('bookings.payment', $booking) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold">
                                                Complete Payment
                                            </a>
                                        @elseif($booking->status === 'confirmed' && $booking->qr_code_data)
                                            <div class="mt-2 text-center">
                                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $booking->qr_code_data }}" alt="QR Code" class="w-24 h-24">
                                                <p class="text-xs text-gray-500 mt-1">Show to driver</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
