# Busket - Web Admin & API System 🚌

[![Laravel](https://img.shields.io/badge/Framework-Laravel%2012-red)](https://laravel.com)
[![PostgreSQL](https://img.shields.io/badge/Database-Supabase%20(Postgres)-blue)](https://supabase.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

**Busket** (Bus Ticket System) adalah sistem manajemen pemesanan tiket bus berbasis web yang berfungsi sebagai pusat kendali (Admin Panel) sekaligus penyedia layanan API untuk aplikasi mobile pelanggan. Sistem ini dirancang untuk memudahkan operasional perusahaan otobus dalam mengelola armada, rute, jadwal, hingga validasi tiket secara real-time.

[Busket Admin](web-admin-pemesanan-tiket-bis-production.up.railway.app)
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

## 📸 Tampilan website

<img width="1914" height="921" alt="image" src="https://github.com/user-attachments/assets/2f6ce841-2a0e-4f31-aef5-7748a2524d82" />

<img width="1915" height="916" alt="image" src="https://github.com/user-attachments/assets/bb21c319-a34d-4694-a86b-fb3015c4c3fe" />

<img width="1918" height="917" alt="image" src="https://github.com/user-attachments/assets/5a3026e6-c052-425c-a365-f9b85da98208" />

<img width="1919" height="925" alt="image" src="https://github.com/user-attachments/assets/1b9ddc3a-31a2-41d5-be09-bc521c6c3568" />

<img width="1917" height="914" alt="image" src="https://github.com/user-attachments/assets/34fe0ccc-b49e-4322-aa79-e6c78a01e7c4" />

<img width="1914" height="923" alt="image" src="https://github.com/user-attachments/assets/025357ac-eecc-4b94-a4dd-683d1731297c" />

<img width="1916" height="919" alt="image" src="https://github.com/user-attachments/assets/6c33d7b1-531e-4778-b081-10c30df87cc8" />

<img width="1919" height="916" alt="image" src="https://github.com/user-attachments/assets/e1152f32-b133-4f2d-83d3-01d9671f798c" />

<img width="1919" height="920" alt="image" src="https://github.com/user-attachments/assets/f13454f6-4a35-4f7a-84a8-b3edd00b3a56" />

<img width="1919" height="922" alt="image" src="https://github.com/user-attachments/assets/bd94c9ca-8078-40d3-9f79-f55fb2d9182b" />

<img width="1919" height="925" alt="image" src="https://github.com/user-attachments/assets/8caad035-5055-4911-a129-77aed0f7f34b" />

<img width="1914" height="920" alt="image" src="https://github.com/user-attachments/assets/8df63f39-1a36-4a03-9fda-6df76a0690a7" />

<img width="1919" height="930" alt="image" src="https://github.com/user-attachments/assets/ae24928a-116d-4f28-948c-8bab215e21eb" />

<img width="1914" height="918" alt="image" src="https://github.com/user-attachments/assets/905176ba-035a-44cb-b73f-8cdf86ed5655" />

<img width="1909" height="920" alt="image" src="https://github.com/user-attachments/assets/fab63c6d-e485-4c01-9e66-308fa4ed1d2a" />

## 👨‍💻 Identitas Pengembang

Project ini dikembangkan sebagai bagian dari tugas besar / UAS oleh:
- **Nama**: Luki Solihin
- **NIM**: 23552011413
- **Kelas**: TIFRP23CNSB
- **Mata Kuliah**: UAS Pemrograman Web
