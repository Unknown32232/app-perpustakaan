# Skenario Demo - Sistem Perpustakaan Digital Kampus

## Persiapan Sebelum Demo

- [ ] `php artisan migrate:fresh --seed` sudah dijalankan.
- [ ] Dua server menyala: `php artisan serve --port=8000` dan `php artisan serve --port=8011`.
- [ ] Browser terbuka di `http://127.0.0.1:8000/login`.
- [ ] Postman terbuka dengan header `Accept: application/json` pada setiap request.
- [ ] Kredensial siap: `admin@pens.ac.id` / `password`.

## Langkah Demo

| No  | Langkah                  | Yang Dilakukan                                                                      | Hasil yang Ditunjukkan                                                                                                                    |
| --- | ------------------------ | ----------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------- |
| 1   | Login                    | Buka `/login`, masuk sebagai `admin@pens.ac.id` / `password`                        | Redirect ke Dashboard, nama "Bambang Sutrisno (Admin)" tampil di navbar                                                                   |
| 2   | Dashboard                | Lihat halaman `/`                                                                   | 3 kartu statistik (Total Buku 20, Total Anggota 15, Peminjaman Aktif sesuai seeder). Data diambil lewat `Http::get()` ke `GET /api/stats` |
| 3   | Tambah kategori          | Menu Kategori, klik tambah, isi form, simpan                                        | Kategori baru muncul di index dengan pesan sukses                                                                                         |
| 4   | Tambah buku              | Menu Buku, klik tambah, pilih kategori baru dari dropdown                           | Buku tersimpan, kolom kategori menampilkan nama (bukan `category_id`)                                                                     |
| 5   | Tambah anggota           | Menu Anggota, klik tambah, simpan. Coba NIM/email duplikat                          | Data tersimpan, validasi unik menolak data duplikat                                                                                       |
| 6   | Buat peminjaman          | Menu Peminjaman, buat baru: pilih anggota dan buku (termasuk yang baru ditambahkan) | Petugas pencatat terisi otomatis dari sesi login                                                                                          |
| 7   | Daftar peminjaman aktif  | Buka `/loans`                                                                       | Transaksi baru berstatus `dipinjam`, lengkap dengan anggota, petugas, dan daftar buku                                                     |
| 8   | Pengembalian buku        | Klik tombol kembalikan pada transaksi langkah 6                                     | Status berubah menjadi `dikembalikan`                                                                                                     |
| 9   | Laporan                  | Buka `/loans/report`                                                                | Tabel seluruh transaksi dari `GET /api/loans`, dengan navigasi halaman                                                                    |
| 10  | Demo API di Postman      | `GET http://127.0.0.1:8000/api/books` dan `GET http://127.0.0.1:8000/api/stats`     | JSON `data/links/meta` untuk books, tiga angka statistik untuk stats                                                                      |
| 11  | Uji ketahanan (opsional) | Matikan server port 8011, refresh Dashboard dan Laporan                             | Halaman tetap tampil (angka 0 / tabel kosong), bukan error 500                                                                            |

## Catatan untuk Tanya Jawab

- **Kenapa butuh 2 server?** `php artisan serve` hanya memproses satu request pada satu waktu. Request browser ke Dashboard sedang berjalan sambil menunggu balasan dari `/api/stats`. Kalau API dipanggil di port yang sama, keduanya saling menunggu (deadlock). Di produksi (Nginx + PHP-FPM) masalah ini tidak muncul karena banyak request diproses bersamaan.
- **Kenapa `try/catch ConnectionException`?** Supaya halaman tidak error 500 kalau server API tidak bisa dihubungi.
- **Kenapa `updateOrCreate` di Seeder?** Supaya aman dijalankan berulang tanpa membuat data duplikat.
