<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6 border-b pb-6">
                    <h3 class="text-lg font-bold mb-4">Booking Summary #{{ $booking->id }}</h3>
                    <p class="mb-2"><span class="font-semibold">Route:</span> {{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</p>
                    <p class="mb-2"><span class="font-semibold">Date:</span> {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('M d, Y - H:i') }}</p>
                    <p class="mb-2"><span class="font-semibold">Seats:</span> {{ $booking->quantity }}</p>
                    <p class="text-xl font-bold text-indigo-600 mt-4">Total to Pay: ${{ number_format($booking->total_price, 2) }}</p>
                </div>

                <div class="mb-6">
                    <h4 class="font-semibold mb-2">Payment Instructions</h4>
                    <p class="text-gray-600 mb-2">Please transfer the total amount to the following bank account:</p>
                    <ul class="list-disc list-inside text-gray-600 bg-gray-50 p-4 rounded">
                        <li><strong>Bank:</strong> Example Bank</li>
                        <li><strong>Account Number:</strong> 123-456-7890</li>
                        <li><strong>Account Name:</strong> Bus Booking Corp</li>
                    </ul>
                </div>

                <form action="{{ route('bookings.process-payment', $booking) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-1">Upload Payment Proof</label>
                        <input type="file" name="payment_proof" id="payment_proof" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG. Max 2MB.</p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                            Submit Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
