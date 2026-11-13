# Sistem Perpustakaan Digital Kampus (`app-perpustakaan`)

Aplikasi manajemen perpustakaan kampus berbasis **Laravel 12** (PHP 8.3, MySQL). Fitur utama: autentikasi petugas/admin, CRUD buku, kategori, anggota, transaksi peminjaman, REST API, serta Dashboard dan Laporan Peminjaman yang mengonsumsi API internal.

## Kebutuhan

- PHP 8.3+ dan Composer
- MySQL (misalnya lewat Laragon)
- Git

## Cara Instalasi

```bash
# 1. Clone repository dan pindah ke branch utama
git clone https://github.com/Unknown32232/app-perpustakaan.git
cd app-perpustakaan

# 2. Install dependency
composer install

# 3. Salin file environment lalu generate key
cp .env.example .env
php artisan key:generate
```

## Setup `.env`

Buat database kosong bernama `db_perpustakaan` di MySQL, lalu sesuaikan `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_perpustakaan
DB_USERNAME=root
DB_PASSWORD=

APP_FAKER_LOCALE=id_ID

# Base URL server kedua, khusus panggilan API internal (Dashboard & Laporan)
INTERNAL_API_URL=http://127.0.0.1:8011
```

## Migrate dan Seed Database

```bash
php artisan migrate:fresh --seed
```

Perintah ini membuat seluruh tabel lalu mengisi data demo: 3 user, 5 kategori, 20 buku, 15 anggota, dan 10 transaksi peminjaman.

## Menjalankan Aplikasi (WAJIB 2 Server)

Dashboard dan Laporan Peminjaman memanggil `GET /api/stats` dan `GET /api/loans` lewat HTTP ke aplikasi sendiri. `php artisan serve` hanya memproses satu request pada satu waktu, jadi memanggil port yang sama akan deadlock. Karena itu jalankan **dua terminal** sekaligus:

```bash
# Terminal 1 - server utama (browser)
php artisan serve --port=8000

# Terminal 2 - server khusus API internal
php artisan serve --port=8011
```

Buka aplikasi di <http://127.0.0.1:8000>. Kalau server port 8011 mati, Dashboard dan Laporan tetap tampil tetapi angkanya nol dan tabel laporan kosong.

## Akun Login (hasil seeder)

| Role    | Email                 | Password   |
| ------- | --------------------- | ---------- |
| Admin   | `admin@pens.ac.id`    | `password` |
| Petugas | `petugas1@pens.ac.id` | `password` |
| Petugas | `petugas2@pens.ac.id` | `password` |

Menu **Kategori** hanya tampil untuk admin.

## REST API

Dokumentasi endpoint lengkap ada di [API.md](API.md). Base URL: `http://127.0.0.1:8000/api`. Wajib kirim header `Accept: application/json`.

## Skenario Demo

Lihat [DEMO.md](DEMO.md).
