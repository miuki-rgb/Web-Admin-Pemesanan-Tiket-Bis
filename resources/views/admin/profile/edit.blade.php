@extends('layouts.admin')

@section('header')
    Profil Saya
@endsection

@section('content')
<div class="space-y-6">
    <!-- Update Profile Information -->
    <div class="p-4 sm:p-8 bg-white shadow-lg rounded-xl border border-gray-100">
        <div class="max-w-xl">
            <h2 class="text-lg font-bold text-p-navy mb-4">Informasi Profil</h2>
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password -->
    <div class="p-4 sm:p-8 bg-white shadow-lg rounded-xl border border-gray-100">
        <div class="max-w-xl">
            <h2 class="text-lg font-bold text-p-navy mb-4">Ganti Password</h2>
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account -->
    <div class="p-4 sm:p-8 bg-white shadow-lg rounded-xl border border-gray-100">
        <div class="max-w-xl">
            <h2 class="text-lg font-bold text-red-600 mb-4">Hapus Akun</h2>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
