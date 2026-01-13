# BusKet - Sistem Pemesanan Tiket Bus

BusKet adalah aplikasi berbasis web yang dirancang untuk mempermudah proses pemesanan tiket bus secara online. Aplikasi ini mengintegrasikan fungsi backend dan frontend dalam satu sistem (monolith) untuk menghubungkan operator bus (Admin) dengan penumpang (Pelanggan).

Proyek ini dikembangkan secara individual sebagai demonstrasi kemampuan pengembangan full-stack menggunakan framework Laravel, mencakup manajemen data, pelaporan sistem, dan antarmuka pengguna yang responsif.

## Fitur Utama

Aplikasi ini memiliki dua peran pengguna utama dengan fitur sebagai berikut:

1. Dashboard Admin
   - Pusat informasi dan statistik sistem.
   - Manajemen data Bus, Rute, dan Jadwal (CRUD).
   - Pengelolaan data pengguna dan pesanan.
   - Fitur pelaporan (Laporan Penjualan/Pemesanan) yang dapat diekspor ke format PDF dan Excel.

2. Fitur Pelanggan
   - Pencarian jadwal keberangkatan bus.
   - Pemesanan tiket secara online.
   - Melihat riwayat pemesanan.

3. Sistem & Keamanan
   - Autentikasi pengguna dan manajemen sesi (Session & Cookies).
   - Validasi data di sisi frontend dan backend.

## Teknologi yang Digunakan

- Backend: Laravel (PHP Framework)
- Frontend: Blade Templates
- Styling: Tailwind CSS
- Database: Postgresql
- Tools Tambahan: DomPDF (Export PDF), Laravel Excel (Export Excel)

**Disclaimer projek ini masih dalam tahap pengembangan dan kemungkinan masih banyak bug atau error ditemukan**
