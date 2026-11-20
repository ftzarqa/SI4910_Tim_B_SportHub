# Panduan Integrasi Modul & Arsitektur Merge — Praktikum Modul 4 WAD 2026
**Studi Kasus 03:** Sistem Venues / Lapangan Olahraga (`SportHub`)  
**Tech Stack:** Laravel 13, Docker Sail, MySQL, Tailwind CSS  
**Repositori Pusat:** `WAD-ALMA-IFFAT-102022500174`

---

## 1. Memahami Konsep "Saling Terintegrasi" pada Modul Otonom
Dalam Studi Kasus 03, keempat modul anggota memang **otonom secara data** (tidak saling bergantung lewat *foreign key* antartabel). Namun, saat praktikum Modul 4 berlangsung, syarat **"bagian website dari masing-masing anggota kelompok sudah saling terintegrasi"** berarti keempat modul tersebut harus beroperasi sebagai **satu aplikasi web Laravel yang utuh** di dalam satu repositori—bukan 4 folder proyek terpisah.

### Perbandingan Kondisi Terpisah vs. Terintegrasi

| Aspek Sistem | Kondisi Belum Terintegrasi (Salah) | Kondisi Terintegrasi (Target Praktikum) |
| :--- | :--- | :--- |
| **Repositori & Database** | 4 repo/proyek terpisah; tiap anggota punya file migrasi `users` sendiri-sendiri. | **1 repositori GitHub** & **1 database**; `migrate:fresh --seed` membentuk tabel `users` beserta 4 tabel modul sekaligus tanpa bentrok. |
| **Autentikasi & Sesi** | Tiap anggota membuat halaman `/login` dan `AuthController` versi sendiri. | **1 pintu `/login`**, **1 tabel `users`**, dan **1 session global**; login sekali langsung berlaku untuk seluruh modul. |
| **Middleware & RBAC** | Pengecekan role berbeda-beda atau hanya dipasang di sebagian rute. | **1 middleware `CheckRole` (`role:admin`)** yang melindungi rute `create`, `store`, `edit`, `update`, dan `destroy` secara seragam di semua modul. |
| **Navigasi & UI/UX** | Tiap modul memiliki warna, navbar, dan struktur HTML berbeda; link antarmodul mati (404). | **1 Master Layout (`layouts/app.blade.php`)** dengan desain **SportHub** (`#009B5D`, `#0C2340`, `#E6F2F8`) dan Navbar sticky yang menghubungkan keempat rute modul secara mulus. |
| **Alur Git Merge** | Anggota mengedit file inti yang sama secara acak sehingga terjadi *merge conflict* berat di kelas. | **Isolasi file per modul**; PR di-merge ke `main` dengan perubahan minimal hanya pada registrasi route & seeder. |

---

## 2. Pembagian 4 Modul & Peta Integrasi Tim

| Anggota | Nama Modul | Prefix Route | Controller & Model | Folder View | Tabel Database |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Individu A** | Modul Lapangan & Area | `/lapangan` | `LapanganController` / `Lapangan` | `resources/views/lapangan/*` | `lapangans` |
| **Individu B** | Modul Rental Alat Olahraga | `/alat-olahraga` | `AlatOlahragaController` / `AlatOlahraga` | `resources/views/alat-olahraga/*` | `alat_olahragas` |
| **Individu C** | Modul Pelanggan & Member | `/member` | `MemberController` / `Member` | `resources/views/member/*` | `members` |
| **Individu D** | Modul Instruktur & Coach | `/instruktur` | `InstrukturController` / `Instruktur` | `resources/views/instruktur/*` | `instrukturs` |

---

## 3. Lima Pilar Teknis Integrasi yang Diuji Asisten Praktikum

1. **Single Entry Point (`/login`) & Unified Redirect:**
   - Rute `GET /` mengarah ke halaman utama/dashboard terpadu atau modul default setelah user terautentikasi (`auth`), bukan terkunci mati hanya pada satu modul milik satu orang.
   - Akun demo standar tersedia di `DatabaseSeeder`:
     - Admin: `admin@gmail.com` / `admin123` (`role = 'admin'`)
     - User Biasa: `user@gmail.com` / `user123` (`role = 'user'`)
2. **Cross-Module Navigation via Master Layout (`resources/views/layouts/app.blade.php`):**
   - Sticky Navbar menampilkan 4 tab navigasi utama (`/lapangan`, `/alat-olahraga`, `/member`, `/instruktur`) dengan indikator tab aktif (`#009B5D`).
   - Selama proses pengembangan sebelum seluruh PR di-merge, rute modul rekan tim yang belum masuk ke branch lokal wajib memiliki *graceful fallback* / halaman *placeholder* agar klik pada Navbar tidak menghasilkan error 404 atau `RouteNotFoundException`.
3. **Standarisasi Proteksi Middleware (`CheckRole`):**
   - Middleware `app/Http/Middleware/CheckRole.php` terdaftar sebagai `'role'` di `bootstrap/app.php`.
   - Seluruh rute `index` dan `show` pada keempat modul dibungkus `middleware('auth')`.
   - Seluruh rute `create`, `store`, `edit`, `update`, dan `destroy` pada keempat modul dibungkus `middleware(['auth', 'role:admin'])` (mengembalikan `abort(404, 'Unauthorized')` bagi non-admin).
   - Tombol aksi CRUD di Blade dibungkus `@if(auth()->user()->role === 'admin')`.
4. **Collision-Free Migrations & Modular Seeders:**
   - Hanya boleh ada **satu** file migrasi `create_users_table` di seluruh repositori.
   - `DatabaseSeeder.php` memanggil seeder terpisah per modul (`UserSeeder`, `LapanganSeeder`, `AlatOlahragaSeeder`, `MemberSeeder`, `InstrukturSeeder`) menggunakan `$this->call([...])` agar tidak saling menimpa saat *merge*.
5. **Isolasi File Siap Merge (Anti-Conflict Protocol):**
   - **File Inti Bersama (Jangan Diubah Sembarangan oleh Branch Modul):**
     - `bootstrap/app.php`
     - `app/Http/Middleware/CheckRole.php`
     - `app/Http/Controllers/AuthController.php`
     - `app/Models/User.php`
     - `resources/views/layouts/app.blade.php`
     - `resources/views/auth/login.blade.php`
   - **Titik Integrasi Terkontrol (Satu-satunya file yang digabung saat PR):**
     - `routes/web.php` (penambahan blok rute modul masing-masing)
     - `database/seeders/DatabaseSeeder.php` (penambahan pemanggilan seeder modul masing-masing)