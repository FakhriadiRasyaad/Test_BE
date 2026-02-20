# Katalog Kursus API

Backend REST API untuk aplikasi **Katalog Kursus** yang dibangun menggunakan **Laravel 12** dengan autentikasi berbasis token menggunakan **Laravel Sanctum**. API ini mendukung manajemen kursus, topik, dan bahasa dengan sistem role **USER** dan **ADMIN**.

---

## 📋 Daftar Isi

- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Fitur](#fitur)
- [Struktur Proyek](#struktur-proyek)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi Environment](#konfigurasi-environment)
- [Menjalankan Proyek](#menjalankan-proyek)
- [Database Seeding](#database-seeding)
- [API Endpoints](#api-endpoints)
- [Autentikasi](#autentikasi)
- [Role & Permission](#role--permission)
- [Skema Database](#skema-database)
- [Testing](#testing)
- [Postman Collection](#postman-collection)

---

## 🛠 Teknologi yang Digunakan

- **PHP** >= 8.2
- **Laravel** 12.x
- **Laravel Sanctum** 4.x (Token-based Authentication)
- **SQLite** (default) / MySQL / PostgreSQL
- **Composer** (PHP Dependency Manager)
- **Node.js** & **NPM** (untuk asset frontend)
- **PHPUnit** 11.x (Testing)

---

## ✨ Fitur

- Registrasi dan Login pengguna dengan token Sanctum
- Sistem role: `USER` dan `ADMIN`
- Katalog kursus publik (dapat diakses tanpa login)
- CRUD Kursus, Topik, dan Bahasa (khusus Admin)
- Middleware `is_admin` untuk proteksi route admin
- Relasi antar tabel: Course ↔ Topic, Course ↔ Language, Course ↔ User

---

## 📁 Struktur Proyek

```
Test_BE/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php         # Register, Login, Logout
│   │   │   ├── CourseController.php        # CRUD Kursus
│   │   │   ├── TopicController.php         # CRUD Topik
│   │   │   ├── LanguageController.php      # CRUD Bahasa
│   │   │   ├── AdminController.php         # Admin management
│   │   │   ├── WebAuthController.php       # Web Auth
│   │   │   └── WebCourseController.php     # Web Course view
│   │   └── Middleware/
│   │       └── IsAdmin.php                 # Middleware cek role admin
│   └── Models/
│       ├── User.php
│       ├── Course.php
│       ├── Topic.php
│       └── Language.php
├── database/
│   ├── migrations/                         # Skema tabel database
│   └── seeders/
│       └── DatabaseSeeder.php              # Data awal
├── routes/
│   ├── api.php                             # Semua API routes
│   └── web.php
├── .env.example                            # Contoh konfigurasi environment
├── Katalog Kursus API.postman_collection.json
└── composer.json
```

---

## ✅ Persyaratan Sistem

Pastikan sistem kamu sudah memiliki software berikut sebelum instalasi:

| Software | Versi Minimum |
|----------|---------------|
| PHP | 8.2+ |
| Composer | 2.x |
| Node.js | 18.x+ |
| NPM | 9.x+ |
| SQLite | 3.x (atau MySQL/PostgreSQL) |
| Git | Latest |

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/FakhriadiRasyaad/Test_BE.git
cd Test_BE
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Install Dependency Node.js

```bash
npm install
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Buat File Database SQLite (jika menggunakan SQLite)

```bash
touch database/database.sqlite
```

> **Catatan:** Jika menggunakan MySQL/PostgreSQL, lewati langkah ini dan sesuaikan konfigurasi di `.env` (lihat bagian [Konfigurasi Environment](#konfigurasi-environment)).

### 7. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 8. (Opsional) Build Asset Frontend

```bash
npm run build
```

---

> **Shortcut:** Semua langkah instalasi di atas (kecuali clone) bisa dijalankan sekaligus dengan:
> ```bash
> composer setup
> ```

---

## ⚙️ Konfigurasi Environment

Buka file `.env` dan sesuaikan konfigurasi berikut:

### Konfigurasi Aplikasi

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=          # Diisi otomatis setelah php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost
```

### Konfigurasi Database

**SQLite (Default):**
```env
DB_CONNECTION=sqlite
# File database ada di database/database.sqlite
```

**MySQL:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=katalog_kursus
DB_USERNAME=root
DB_PASSWORD=your_password
```

**PostgreSQL:**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=katalog_kursus
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Konfigurasi Lainnya

```env
SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

---

## ▶️ Menjalankan Proyek

### Development Mode (Semua Service Sekaligus)

Perintah berikut akan menjalankan server Laravel, queue listener, log watcher, dan Vite dev server secara bersamaan:

```bash
composer dev
```

### Atau Jalankan Server Saja

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

Semua API dapat diakses melalui: **http://127.0.0.1:8000/api/**

---

## 🌱 Database Seeding

Untuk mengisi database dengan data awal (dummy user), jalankan:

```bash
php artisan db:seed
```

Ini akan membuat satu user dengan data:
- **Name:** Test User
- **Email:** test@example.com
- **Password:** 123456

Untuk membuat akun **Admin**, daftarkan user secara manual lalu update role-nya melalui Tinker:

```bash
php artisan tinker
```

```php
// Di dalam tinker
\App\Models\User::where('email', 'your@email.com')->update(['role' => 'ADMIN']);
```

Untuk reset dan isi ulang database dari awal:

```bash
php artisan migrate:fresh --seed
```

---

## 📡 API Endpoints

Base URL: `http://127.0.0.1:8000/api`

### 🔓 Public Routes (Tanpa Autentikasi)

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/register` | Registrasi user baru |
| POST | `/login` | Login dan dapat token |
| GET | `/courses` | Lihat semua kursus |
| GET | `/courses/{id}` | Lihat detail kursus |

### 🔒 Authenticated Routes (Memerlukan Token)

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/logout` | Logout user |

### 🛡️ Admin Routes (Memerlukan Token + Role ADMIN)

#### Kursus

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/courses` | Tambah kursus baru |
| PUT | `/courses/{id}` | Update kursus |
| DELETE | `/courses/{id}` | Hapus kursus |

#### Topik

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/topics` | Lihat semua topik |
| GET | `/topics/{id}` | Lihat detail topik |
| POST | `/topics` | Tambah topik baru |
| PUT | `/topics/{id}` | Update topik |
| DELETE | `/topics/{id}` | Hapus topik |

#### Bahasa

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/languages` | Lihat semua bahasa |
| GET | `/languages/{id}` | Lihat detail bahasa |
| POST | `/languages` | Tambah bahasa baru |
| PUT | `/languages/{id}` | Update bahasa |
| DELETE | `/languages/{id}` | Hapus bahasa |

---

## 🔑 Autentikasi

API ini menggunakan **Laravel Sanctum** dengan metode **Bearer Token**.

### Registrasi

**POST** `/api/register`

Request Body:
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secret123"
}
```

Response (201 Created):
```json
{
  "message": "Register berhasil",
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxx",
  "user": { "id": 1, "name": "John Doe", "email": "john@example.com", "role": "USER" }
}
```

### Login

**POST** `/api/login`

Request Body:
```json
{
  "email": "john@example.com",
  "password": "secret123"
}
```

Response (200 OK):
```json
{
  "message": "Login berhasil",
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxx",
  "user": { "id": 1, "name": "John Doe", "email": "john@example.com", "role": "USER" }
}
```

### Menggunakan Token

Sertakan token di header setiap request yang memerlukan autentikasi:

```
Authorization: Bearer {token_kamu}
```

### Logout

**POST** `/api/logout`

Header:
```
Authorization: Bearer {token_kamu}
```

Response:
```json
{
  "message": "Logout berhasil"
}
```

---

## 👥 Role & Permission

Sistem ini memiliki dua role pengguna:

| Role | Akses |
|------|-------|
| `USER` | Registrasi, login, logout, lihat kursus publik |
| `ADMIN` | Semua akses USER + CRUD kursus, topik, dan bahasa |

Role diatur melalui field `role` pada tabel `users`. Saat registrasi, user otomatis mendapatkan role `USER`. Untuk menjadi `ADMIN`, harus diubah secara manual via Tinker atau langsung di database.

---

## 🗄️ Skema Database

### Tabel `users`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | varchar | Nama user |
| email | varchar | Email unik |
| password | varchar | Password (hashed) |
| role | varchar | `USER` atau `ADMIN` |
| created_at | timestamp | |
| updated_at | timestamp | |

### Tabel `courses`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| topic_id | bigint (FK) | Relasi ke tabel `topics` |
| language_id | bigint (FK) | Relasi ke tabel `languages` |
| created_by_id | bigint (FK) | Relasi ke tabel `users` |
| title | varchar | Judul kursus |
| description | text | Deskripsi lengkap |
| short_description | varchar | Deskripsi singkat |
| price | decimal(18,2) | Harga kursus |
| discount_rate | decimal(5,2) | Persentase diskon |
| thumbnail_url | varchar | URL gambar thumbnail |
| level | enum | `ALL LEVEL`, `BEGINNER`, `INTERMEDIATE`, `ADVANCE` |
| created_at | timestamp | |
| updated_at | timestamp | |

### Tabel `topics`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | varchar | Nama topik |
| created_at | timestamp | |
| updated_at | timestamp | |

### Tabel `languages`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | varchar | Nama bahasa |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## 🧪 Testing

Jalankan semua test dengan perintah:

```bash
composer test
```

Atau langsung menggunakan artisan:

```bash
php artisan test
```

Untuk menjalankan test tertentu:

```bash
php artisan test --filter NamaTest
```

---



## 📝 Catatan Tambahan

- Pastikan direktori `storage` dan `bootstrap/cache` dapat ditulis (writable):
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```
- Jika ada error `key not set`, jalankan ulang `php artisan key:generate`
- Jika menggunakan MySQL dan terjadi error saat migrasi, pastikan database sudah dibuat terlebih dahulu sebelum menjalankan `php artisan migrate`

---

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).
