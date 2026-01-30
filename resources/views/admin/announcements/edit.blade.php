@extends('layouts.admin')

@section('header')
    Edit Pengumuman
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="title">Judul Pengumuman</label>
            <input type="text" name="title" id="title" value="{{ $announcement->title }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="image">Gambar Pengumuman</label>
            @if($announcement->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $announcement->image) }}" alt="Preview" class="w-48 h-auto rounded-lg shadow-sm">
                </div>
            @endif
            <input type="file" name="image" id="image" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Pilih file jika ingin mengganti gambar. Maks 2MB.</p>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="type">Tipe</label>
            <select name="type" id="type" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition">
                <option value="info" {{ $announcement->type == 'info' ? 'selected' : '' }}>Informasi Biasa (Biru)</option>
                <option value="promo" {{ $announcement->type == 'promo' ? 'selected' : '' }}>Promosi (Kuning)</option>
                <option value="delay" {{ $announcement->type == 'delay' ? 'selected' : '' }}>Peringatan/Delay (Merah)</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="content">Isi Konten</label>
            <textarea name="content" id="content" rows="4" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required>{{ $announcement->content }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="valid_until">Berlaku Sampai (Opsional)</label>
            <input type="date" name="valid_until" id="valid_until" value="{{ $announcement->valid_until ? $announcement->valid_until->format('Y-m-d') : '' }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition">
        </div>

        <div class="mb-8">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $announcement->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-p-red shadow-sm focus:border-p-red focus:ring focus:ring-p-red focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600 font-semibold">Tampilkan Pengumuman (Aktif)</span>
            </label>
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.announcements.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-4">Batal</a>
            <button class="bg-p-red hover:bg-p-maroon text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5" type="submit">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
