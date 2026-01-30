@extends('layouts.admin')

@section('header')
    Buat Pengumuman Baru
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
    <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="title">Judul Pengumuman</label>
            <input type="text" name="title" id="title" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required placeholder="Contoh: Diskon Liburan Akhir Tahun">
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="image">Gambar Pengumuman (Opsional)</label>
            <input type="file" name="image" id="image" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks 2MB.</p>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="type">Tipe</label>
            <select name="type" id="type" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition">
                <option value="info">Informasi Biasa (Biru)</option>
                <option value="promo">Promosi (Kuning)</option>
                <option value="delay">Peringatan/Delay (Merah)</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="content">Isi Konten</label>
            <textarea name="content" id="content" rows="4" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition" required></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-p-navy text-sm font-bold mb-2" for="valid_until">Berlaku Sampai (Opsional)</label>
            <input type="date" name="valid_until" id="valid_until" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-p-blue focus:border-transparent transition">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika berlaku selamanya.</p>
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.announcements.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-4">Batal</a>
            <button class="bg-p-red hover:bg-p-maroon text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200 transform hover:-translate-y-0.5" type="submit">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
