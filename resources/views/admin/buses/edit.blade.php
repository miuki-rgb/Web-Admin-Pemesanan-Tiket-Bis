@extends('layouts.admin')

@section('header')
    Edit Bus
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <form action="{{ route('admin.buses.update', $bus) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="name">Bus Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $bus->name) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="plate_number">Plate Number</label>
            <input type="text" name="plate_number" id="plate_number" value="{{ old('plate_number', $bus->plate_number) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="capacity">Capacity</label>
            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $bus->capacity) }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="photo">Photo (Optional)</label>
            @if($bus->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $bus->photo) }}" alt="Current Photo" class="h-20 w-20 object-cover rounded-lg">
                </div>
            @endif
            <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-p-blue/10 file:text-p-navy hover:file:bg-p-blue/20">
        </div>

        <div class="mb-8">
            <label class="block text-p-navy text-sm font-bold mb-2" for="status">Status</label>
            <select name="status" id="status" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition">
                <option value="active" {{ $bus->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="maintenance" {{ $bus->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.buses.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-4">Cancel</a>
            <button class="bg-p-red hover:bg-p-maroon text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5" type="submit">
                Update Bus
            </button>
        </div>
    </form>
</div>
@endsection
