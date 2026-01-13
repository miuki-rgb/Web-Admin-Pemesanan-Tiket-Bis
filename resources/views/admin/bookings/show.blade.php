@extends('layouts.admin')

@section('header')
    Booking Details #{{ $booking->id }}
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Booking Info -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Transaction Information</h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Customer Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $booking->user->name }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $booking->user->email }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Route</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $booking->schedule->route->origin }} -> {{ $booking->schedule->route->destination }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Bus</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $booking->schedule->bus->name }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Departure</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('M d, Y - H:i') }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Quantity</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $booking->quantity }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-bold">${{ $booking->total_price }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Current Status</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 uppercase font-bold">{{ $booking->status }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Payment Proof & Actions -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Payment Verification</h3>
        
        @if($booking->payment_proof)
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-2">Proof of Payment:</p>
                <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank">
                    <img src="{{ asset('storage/' . $booking->payment_proof) }}" alt="Payment Proof" class="w-full rounded shadow hover:opacity-75 transition">
                </a>
            </div>
        @else
            <div class="mb-6 bg-gray-100 p-4 rounded text-center text-gray-500">
                No payment proof uploaded yet.
            </div>
        @endif

        @if($booking->status === 'paid' || $booking->status === 'pending')
            <div class="flex space-x-4">
                <form action="{{ route('admin.bookings.verify', $booking) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="action" value="accept">
                    <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700" onclick="return confirm('Confirm payment? This will generate a ticket.')">
                        Accept & Confirm
                    </button>
                </form>
                <form action="{{ route('admin.bookings.verify', $booking) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="action" value="reject">
                    <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700" onclick="return confirm('Reject payment? This will cancel the booking.')">
                        Reject
                    </button>
                </form>
            </div>
        @elseif($booking->status === 'confirmed')
            <div class="bg-green-100 text-green-800 p-4 rounded text-center font-semibold">
                Booking Confirmed. Ticket Generated.
            </div>
        @elseif($booking->status === 'cancelled')
            <div class="bg-red-100 text-red-800 p-4 rounded text-center font-semibold">
                Booking Cancelled.
            </div>
        @endif
    </div>
</div>
@endsection
