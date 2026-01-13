<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirm Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Trip Details</h3>
                <div class="grid grid-cols-2 gap-4 mb-6 border-b pb-6">
                    <div>
                        <span class="block text-gray-500 text-sm">Route</span>
                        <span class="block font-semibold">{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</span>
                    </div>
                    <div>
                        <span class="block text-gray-500 text-sm">Date</span>
                        <span class="block font-semibold">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('M d, Y - H:i') }}</span>
                    </div>
                    <div>
                        <span class="block text-gray-500 text-sm">Bus</span>
                        <span class="block font-semibold">{{ $schedule->bus->name }}</span>
                    </div>
                    <div>
                        <span class="block text-gray-500 text-sm">Price per Ticket</span>
                        <span class="block font-semibold text-indigo-600">${{ $schedule->price }}</span>
                    </div>
                </div>

                <form action="{{ route('bookings.store', $schedule) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Number of Seats</label>
                        <select name="quantity" id="quantity" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @for($i = 1; $i <= min(10, $schedule->stock_available); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Total: <span id="total-price" class="font-bold">${{ $schedule->price }}</span></p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                            Proceed to Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const quantitySelect = document.getElementById('quantity');
        const totalPriceDisplay = document.getElementById('total-price');
        const unitPrice = {{ $schedule->price }};

        quantitySelect.addEventListener('change', function() {
            const quantity = parseInt(this.value);
            totalPriceDisplay.textContent = '$' + (quantity * unitPrice).toFixed(2);
        });
    </script>
</x-app-layout>
