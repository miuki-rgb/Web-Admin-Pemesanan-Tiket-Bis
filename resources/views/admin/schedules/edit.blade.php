@extends('layouts.admin')

@section('header')
    Edit Schedule
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="route_id">Route</label>
            <select name="route_id" id="route_id" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
                @foreach($routes as $route)
                    <option value="{{ $route->id }}" {{ $schedule->route_id == $route->id ? 'selected' : '' }}>
                        {{ $route->origin }} -> {{ $route->destination }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="bus_id">Bus</label>
            <select name="bus_id" id="bus_id" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
                @foreach($buses as $bus)
                    <option value="{{ $bus->id }}" {{ $schedule->bus_id == $bus->id ? 'selected' : '' }}>
                        {{ $bus->name }} ({{ $bus->capacity }} seats)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="departure_time">Departure Time</label>
                <input type="datetime-local" name="departure_time" id="departure_time" value="{{ \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
            </div>

            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="arrival_time">Arrival Time</label>
                <input type="datetime-local" name="arrival_time" id="arrival_time" value="{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('Y-m-d\TH:i') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $schedule->price) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
            </div>

            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="stock_available">Stock Available</label>
                <input type="number" name="stock_available" id="stock_available" value="{{ old('stock_available', $schedule->stock_available) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
            </div>
        </div>

        <div class="mb-8">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $schedule->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-p-red shadow-sm focus:border-p-red focus:ring focus:ring-p-red focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600 font-semibold">Active Schedule</span>
            </label>
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.schedules.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-4">Cancel</a>
            <button class="bg-p-red hover:bg-p-maroon text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5" type="submit">
                Update Schedule
            </button>
        </div>
    </form>
</div>
@endsection
