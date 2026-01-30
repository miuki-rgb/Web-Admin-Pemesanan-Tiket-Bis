@extends('layouts.admin')

@section('header')
    Edit Route
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <form action="{{ route('admin.routes.update', $route) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="origin">Origin</label>
                <input type="text" name="origin" id="origin" value="{{ old('origin', $route->origin) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
            </div>

            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="destination">Destination</label>
                <input type="text" name="destination" id="destination" value="{{ old('destination', $route->destination) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="distance_km">Distance (km)</label>
                <input type="number" step="0.01" name="distance_km" id="distance_km" value="{{ old('distance_km', $route->distance_km) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition">
            </div>

            <div>
                <label class="block text-p-navy text-sm font-bold mb-2" for="duration_minutes">Duration (minutes)</label>
                <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', $route->duration_minutes) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition">
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-p-navy text-sm font-bold mb-2" for="photo">Photo (Optional)</label>
            @if($route->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $route->photo) }}" alt="Current Photo" class="h-24 w-full object-cover rounded-lg">
                </div>
            @endif
            <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-p-blue/10 file:text-p-navy hover:file:bg-p-blue/20">
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.routes.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-4">Cancel</a>
            <button class="bg-p-red hover:bg-p-maroon text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5" type="submit">
                Update Route
            </button>
        </div>
    </form>
</div>
@endsection
