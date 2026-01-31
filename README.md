# Busket - Web Admin & API System 🚌

[![Laravel](https://img.shields.io/badge/Framework-Laravel%2012-red)](https://laravel.com)
[![PostgreSQL](https://img.shields.io/badge/Database-Supabase%20(Postgres)-blue)](https://supabase.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

**Busket** (Bus Ticket System) adalah sistem manajemen pemesanan tiket bus berbasis web yang berfungsi sebagai pusat kendali (Admin Panel) sekaligus penyedia layanan API untuk aplikasi mobile pelanggan. Sistem ini dirancang untuk memudahkan operasional perusahaan otobus dalam mengelola armada, rute, jadwal, hingga validasi tiket secara real-time.

---

## 🚀 Fitur Utama (Web Admin)

- **Dashboard Statistik**: Ringkasan data pemesanan dan operasional bus.
- **Manajemen Armada**: Pengelolaan data bus (nama, plat nomor, kapasitas).
- **Manajemen Rute**: Pengaturan titik keberangkatan dan tujuan.
- **Penjadwalan Otomatis**: Pengaturan jam keberangkatan, harga tiket, dan stok kursi.
- **Verifikasi Pembayaran**: Sistem konfirmasi pembayaran tiket pelanggan.
- **Validasi Tiket (QR Scan)**: Fitur scan QR Code tiket pelanggan yang terintegrasi untuk mencegah penggunaan tiket ganda.
- **Sistem Pengumuman**: Posting berita, promo, atau info delay yang langsung muncul di aplikasi mobile pelanggan.
- **Keamanan Berlapis**: Middleware akses khusus Admin dan proteksi CSRF/HTTPS.

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.3)
- **Database**: Supabase / PostgreSQL (Cloud Database)
- **Authentication**: Laravel Sanctum (Token-based API Auth)
- **Styling**: Tailwind CSS & Alpine.js
- **Deployment**: Railway.app / Ubuntu Server
- **Security**: Cloudflare Tunnel & HTTPS Encryption

---

## 📱 Integrasi Mobile

Project ini bertindak sebagai backend untuk aplikasi **Busket Mobile (Flutter)**. Endpoint API yang disediakan meliputi:
- `POST /api/register` & `POST /api/login`
- `GET /api/schedules` (Daftar jadwal bus)
- `POST /api/bookings` (Pemesanan tiket)
- `GET /api/my-tickets` (Daftar tiket pengguna)
- `POST /api/profile` (Update profil & foto)

---

## ⚙️ Instalasi Lokal

1. **Clone Repository**
   ```bash
   git clone https://github.com/miuki-rgb/Web-Admin-Pemesanan-Tiket-Bis.git
   cd Web-Admin-Pemesanan-Tiket-Bis
   ```

2. **Install Dependensi**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` ke `.env` dan sesuaikan kredensial database (Supabase/MySQL).
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan Migrasi & Server**
   ```bash
   php artisan migrate --seed
   php artisan serve
   ```

---

## 👨‍💻 Identitas Pengembang

Project ini dikembangkan sebagai bagian dari tugas besar / UAS oleh:
- **Nama**: Luki Solihin
- **NIM**: 23552011413
- **Kelas**: TIFRP23CNSB
- **Mata Kuliah**: UAS Pemrograman Web
