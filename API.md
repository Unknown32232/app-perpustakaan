# Dokumentasi REST API - Sistem Perpustakaan Digital Kampus

Dokumentasi endpoint REST API `app-perpustakaan` (Laravel 12). Seluruh response contoh di bawah adalah hasil asli dari Postman.

### Status Code yang Dipakai

| Kode | Arti                  | Contoh Kasus                                    |
| ---- | --------------------- | ----------------------------------------------- |
| 200  | OK                    | Berhasil membaca, memperbarui, atau menghapus   |
| 201  | Created               | Berhasil membuat buku atau peminjaman baru      |
| 404  | Not Found             | ID yang diminta tidak ada                       |
| 422  | Unprocessable Content | Validasi gagal (field kosong atau format salah) |

---

## Ringkasan Endpoint

| Method | URL                          | Body (jika ada)        | Contoh Response                                                            |
| :----- | :--------------------------- | :--------------------- | :------------------------------------------------------------------------- |
| GET    | `/api/books`                 | -                      | 200 - menampilkan semua buku                                               |
| GET    | `/api/books?judul=laskar`    | -                      | 200 - menampilkan buku yang judulnya laskar                                |
| GET    | `/api/books?category_id=2`   | -                      | 200 - menampilkan buku dengan kategori 2                                   |
| POST   | `/api/books`                 | JSON lengkap data buku | 201 - menambahkan buku baru                                                |
| POST   | `/api/books`                 | `{}` (kosong)          | 422 - gagal menambahkan buku karena body kosong                            |
| PUT    | `/api/books/{id}`            | JSON data update       | 200 - merubah informasi buku (update)                                      |
| DELETE | `/api/books/{id}`            | -                      | 200 - berhasil menghapus buku                                              |
| GET    | `/api/books/999`             | -                      | 404 - buku dengan id 999 tidak ditemukan                                   |
| GET    | `/api/members`               | -                      | 200 - menampilkan semua member                                             |
| GET    | `/api/members/{id}`          | -                      | 200 - menampilkan member sesuai ID                                         |
| GET    | `/api/loans`                 | -                      | 200 - menampilkan semua loans                                              |
| POST   | `/api/loans`                 | JSON sesuai            | 201 - menambahkan loans/peminjaman buku                                    |
| PUT    | `/api/loans/{id}/kembalikan` | -                      | 200 - mengembalikan buku                                                   |
| GET    | `/api/stats`                 | -                      | 200 - menampilkan status, total buku, total anggota, peminjaman yang aktif |

---

## Hasil Request

### 1. GET `/api/books`

**Status:** 200

```json
{
    "data": [
        {
            "id": 1,
            "judul": "Try",
            "penulis": "aku",
            "penerbit": "SEGA",
            "tahun_terbit": "2001",
            "isbn": "67",
            "stok": 67,
            "sampul": null,
            "category": {
                "id": 1,
                "nama_kategori": "Komik"
            },
            "created_at": "2026-09-27T17:32:38.000000Z",
            "updated_at": "2026-09-27T17:33:06.000000Z"
        },
        {
            "id": 4,
            "judul": "Kancil",
            "penulis": "orang",
            "penerbit": "aku",
            "tahun_terbit": "2000",
            "isbn": "68",
            "stok": 76,
            "sampul": null,
            "category": {
                "id": 3,
                "nama_kategori": "Cerita Rakyat"
            },
            "created_at": "2026-09-30T02:21:59.000000Z",
            "updated_at": "2026-09-30T02:21:59.000000Z"
        },
        {
            "id": 5,
            "judul": "Seporsi mie ayam sebelum es teh manis",
            "penulis": "orang",
            "penerbit": "Umbrella Corporation",
            "tahun_terbit": "2000",
            "isbn": "66",
            "stok": 100,
            "sampul": null,
            "category": {
                "id": 2,
                "nama_kategori": "Novel"
            },
            "created_at": "2026-09-30T02:23:19.000000Z",
            "updated_at": "2026-09-30T02:23:19.000000Z"
        },
        {
            "id": 6,
            "judul": "IPS",
            "penulis": "orang sosial",
            "penerbit": "Umbrella Corporation",
            "tahun_terbit": "2001",
            "isbn": "1",
            "stok": 12,
            "sampul": null,
            "category": {
                "id": 4,
                "nama_kategori": "Pendidikan"
            },
            "created_at": "2026-09-30T02:23:54.000000Z",
            "updated_at": "2026-09-30T02:23:54.000000Z"
        },
        {
            "id": 7,
            "judul": "Laskar Pelangi",
            "penulis": "Andrea Hirata",
            "penerbit": "Bentang Pustaka",
            "tahun_terbit": "2005",
            "isbn": "9789793062792",
            "stok": 5,
            "sampul": null,
            "category": {
                "id": 1,
                "nama_kategori": "Komik"
            },
            "created_at": "2026-10-20T10:11:48.000000Z",
            "updated_at": "2026-10-20T10:38:18.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/books?page=1",
        "last": "http://127.0.0.1:8000/api/books?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/books?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/books",
        "per_page": 10,
        "to": 5,
        "total": 5
    }
}
```

---

### 2. GET `/api/books?judul=laskar`

**Status:** 200

```json
{
    "data": [
        {
            "id": 7,
            "judul": "Laskar Pelangi",
            "penulis": "Andrea Hirata",
            "penerbit": "Bentang Pustaka",
            "tahun_terbit": "2005",
            "isbn": "9789793062792",
            "stok": 5,
            "sampul": null,
            "category": {
                "id": 1,
                "nama_kategori": "Komik"
            },
            "created_at": "2026-10-20T10:11:48.000000Z",
            "updated_at": "2026-10-20T10:38:18.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/books?page=1",
        "last": "http://127.0.0.1:8000/api/books?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/books?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/books",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

---

### 3. GET `/api/books?category_id=2`

**Status:** 200

```json
{
    "data": [
        {
            "id": 5,
            "judul": "Seporsi mie ayam sebelum es teh manis",
            "penulis": "orang",
            "penerbit": "Umbrella Corporation",
            "tahun_terbit": "2000",
            "isbn": "66",
            "stok": 100,
            "sampul": null,
            "category": {
                "id": 2,
                "nama_kategori": "Novel"
            },
            "created_at": "2026-09-30T02:23:19.000000Z",
            "updated_at": "2026-09-30T02:23:19.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/books?page=1",
        "last": "http://127.0.0.1:8000/api/books?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/books?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/books",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

---

### 4. POST `/api/books` (data lengkap)

**Body:**

```json
{
    "judul": "Laut Bercerita",
    "penulis": "Leila Chudori",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": 2017,
    "isbn": "978979236436",
    "stok": 5,
    "category_id": 2
}
```

**Status:** 201

**Response:**

```json
{
    "data": {
        "id": 9,
        "judul": "Laut Bercerita",
        "penulis": "Leila Chudori",
        "penerbit": "Bentang Pustaka",
        "tahun_terbit": 2017,
        "isbn": "978979236436",
        "stok": 5,
        "sampul": null,
        "category": {
            "id": 2,
            "nama_kategori": "Novel"
        },
        "created_at": "2026-11-04T06:45:26.000000Z",
        "updated_at": "2026-11-04T06:45:26.000000Z"
    }
}
```

---

### 5. POST `/api/books` (body kosong)

**Body:**

```json
{}
```

**Status:** 422

**Response:**

```json
{
    "message": "Judul buku wajib diisi. (and 5 more errors)",
    "errors": {
        "judul": ["Judul buku wajib diisi."],
        "penulis": ["Nama penulis wajib diisi."],
        "penerbit": ["Nama penerbit wajib diisi."],
        "tahun_terbit": ["Tahun terbit wajib diisi."],
        "stok": ["Stok wajib diisi."],
        "category_id": ["Kategori wajib dipilih."]
    }
}
```

---

### 6. PUT `/api/books/{id}`

**Body:**

```json
{
    "judul": "Laskar Pelangi (Edisi Baru)",
    "penulis": "Andrea Hirata",
    "penerbit": "Bentang Pustaka",
    "tahun_terbit": 2005,
    "isbn": "9789793134792",
    "stok": 11,
    "category_id": 1
}
```

**Status:** 200

**Response:**

```json
{
    "data": {
        "id": 7,
        "judul": "Laskar Pelangi (Edisi Baru)",
        "penulis": "Andrea Hirata",
        "penerbit": "Bentang Pustaka",
        "tahun_terbit": 2005,
        "isbn": "9789793134792",
        "stok": 11,
        "sampul": null,
        "category": {
            "id": 1,
            "nama_kategori": "Komik"
        },
        "created_at": "2026-10-20T10:11:48.000000Z",
        "updated_at": "2026-11-04T06:46:41.000000Z"
    }
}
```

---

### 7. DELETE `/api/books/{id}`

**Status:** 200 / 204

**Response:**

```json
{
    "message": "Buku berhasil dihapus."
}
```

---

### 8. GET `/api/books/999`

**Status:** 404

**Response:**

```json
{
    "message": "No query results for model [App\\Models\\Book] 999",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException",
    "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Exceptions\\Handler.php",
    "line": 668,
    "trace": [
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Exceptions\\Handler.php",
            "line": 616,
            "function": "prepareException",
            "class": "Illuminate\\Foundation\\Exceptions\\Handler",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 51,
            "function": "render",
            "class": "Illuminate\\Foundation\\Exceptions\\Handler",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 182,
            "function": "handleException",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php",
            "line": 50,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 137,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 821,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 800,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 764,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 753,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 200,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 180,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull.php",
            "line": 31,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TrimStrings.php",
            "line": 51,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TrimStrings",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance.php",
            "line": 109,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\HandleCors.php",
            "line": 74,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Http\\Middleware\\HandleCors",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\TrustProxies.php",
            "line": 58,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Http\\Middleware\\TrustProxies",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks.php",
            "line": 22,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Http\\Middleware\\ValidatePathEncoding.php",
            "line": 26,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 219,
            "function": "handle",
            "class": "Illuminate\\Http\\Middleware\\ValidatePathEncoding",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 137,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 175,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 144,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php",
            "line": 1220,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\public\\index.php",
            "line": 20,
            "function": "handleRequest",
            "class": "Illuminate\\Foundation\\Application",
            "type": "->"
        },
        {
            "file": "E:\\laragon\\www\\modul-framework\\app-perpustakaan\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\resources\\server.php",
            "line": 23,
            "function": "require_once"
        }
    ]
}
```

---

### 9. GET `/api/members`

**Status:** 200

```json
{
    "data": [
        {
            "id": 1,
            "nama": "Fawwaz Al Ghifari",
            "nim": "3125600024",
            "email": "pau@gmail.com",
            "nomor_telepon": "081234567890",
            "alamat": "Jombang Tengah-tengah",
            "status": "aktif",
            "created_at": "2026-09-27T17:45:43.000000Z",
            "updated_at": "2026-09-27T17:45:43.000000Z"
        },
        {
            "id": 2,
            "nama": "Laudy Kartika Buchori",
            "nim": "3125600022",
            "email": "lau@gmail.com",
            "nomor_telepon": "08987654321",
            "alamat": "Surabaya Selatan",
            "status": "aktif",
            "created_at": "2026-09-27T17:46:28.000000Z",
            "updated_at": "2026-09-27T17:46:28.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/members?page=1",
        "last": "http://127.0.0.1:8000/api/members?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/members?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/members",
        "per_page": 10,
        "to": 2,
        "total": 2
    }
}
```

---

### 10. GET `/api/members/{id}`

**Status:** 200

```json
{
    "data": {
        "id": 1,
        "nama": "Fawwaz Al Ghifari",
        "nim": "3125600024",
        "email": "pau@gmail.com",
        "nomor_telepon": "081234567890",
        "alamat": "Jombang Tengah-tengah",
        "status": "aktif",
        "created_at": "2026-09-27T17:45:43.000000Z",
        "updated_at": "2026-09-27T17:45:43.000000Z"
    }
}
```

---

### 11. GET `/api/loans`

**Status:** 200

```json
{
    "data": [
        {
            "id": 2,
            "member": {
                "id": 1,
                "nama": "Fawwaz Al Ghifari"
            },
            "petugas": {
                "id": 2,
                "name": "Petugas Perpus"
            },
            "tanggal_pinjam": "2026-09-30",
            "tanggal_kembali": "2026-10-15",
            "tanggal_dikembalikan": "2026-09-30",
            "status": "dikembalikan",
            "books": [
                {
                    "id": 5,
                    "judul": "Seporsi mie ayam sebelum es teh manis"
                }
            ]
        },
        {
            "id": 3,
            "member": {
                "id": 1,
                "nama": "Fawwaz Al Ghifari"
            },
            "petugas": {
                "id": 4,
                "name": "Petugas Satu"
            },
            "tanggal_pinjam": "2026-10-14",
            "tanggal_kembali": "2026-11-30",
            "tanggal_dikembalikan": null,
            "status": "dipinjam",
            "books": [
                {
                    "id": 5,
                    "judul": "Seporsi mie ayam sebelum es teh manis"
                }
            ]
        },
        {
            "id": 4,
            "member": {
                "id": 1,
                "nama": "Fawwaz Al Ghifari"
            },
            "petugas": {
                "id": 2,
                "name": "Petugas Perpus"
            },
            "tanggal_pinjam": "2026-10-20",
            "tanggal_kembali": "2026-10-27",
            "tanggal_dikembalikan": null,
            "status": "dipinjam",
            "books": [
                {
                    "id": 1,
                    "judul": "Try"
                }
            ]
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/loans?page=1",
        "last": "http://127.0.0.1:8000/api/loans?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "page": null,
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/loans?page=1",
                "label": "1",
                "page": 1,
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "page": null,
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/loans",
        "per_page": 10,
        "to": 3,
        "total": 3
    }
}
```

---

### 12. POST `/api/loans`

**Body:**

```json
{
    "member_id": 2,
    "user_id": 2,
    "tanggal_pinjam": "2026-10-20",
    "tanggal_kembali": "2026-11-27",
    "book_ids": [9]
}
```

**Status:** 201

**Response:**

```json
{
    "data": {
        "id": 5,
        "member": {
            "id": 2,
            "nama": "Laudy Kartika Buchori"
        },
        "petugas": {
            "id": 2,
            "name": "Petugas Perpus"
        },
        "tanggal_pinjam": "2026-10-20",
        "tanggal_kembali": "2026-11-27",
        "tanggal_dikembalikan": null,
        "status": "dipinjam",
        "books": [
            {
                "id": 9,
                "judul": "Laut Bercerita"
            }
        ]
    }
}
```

---

### 13. PUT `/api/loans/{id}/kembalikan`

**Status:** 200

**Response:**

```json
{
    "data": {
        "id": 5,
        "member": {
            "id": 2,
            "nama": "Laudy Kartika Buchori"
        },
        "petugas": {
            "id": 2,
            "name": "Petugas Perpus"
        },
        "tanggal_pinjam": "2026-10-20",
        "tanggal_kembali": "2026-11-27",
        "tanggal_dikembalikan": "2026-11-04",
        "status": "dikembalikan",
        "books": [
            {
                "id": 9,
                "judul": "Laut Bercerita"
            }
        ]
    }
}
```

---

### 14. GET `/api/stats`

**Status:** 200

```json
{
    "total_buku": 6,
    "total_anggota": 2,
    "peminjaman_aktif": 2
}
```

---
