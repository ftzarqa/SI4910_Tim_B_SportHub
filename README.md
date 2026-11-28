# SportHub — Sistem Manajemen Venue & Lapangan Olahraga

Aplikasi web berbasis Laravel untuk pengelolaan venue olahraga terpadu yang mencakup **Manajemen Lapangan & Area**, **Rental Alat Olahraga**, **Manajemen Pelanggan & Member**, serta **Direktori Instruktur & Coach**.

- **Repositori Resmi Tim:** `https://github.com/PAW-Ganjil-2627-SI/4910_Tim_B_SportHub.git`
- **Kelas / Kelompok:** SI-49-10 — Tim B (Kelompok 3)

---

## 1. Pembagian Modul & Branch Anggota

Keempat anggota sudah terdaftar sebagai **Contributors** pada repositori ini. Setiap anggota wajib bekerja pada branch modul masing-masing sesuai tabel berikut:

| Anggota | GitHub Username | Peran & Modul | Route Utama | Nama Branch |
| :--- | :--- | :--- | :--- | :--- |
| **Iffat** (Ketua / Maintainer) | `@ftzarqa` | Rental Alat Olahraga | `/alat-olahraga` | `main` *(sudah terintegrasi)* |
| **Orel** | `@aurelnisaw` | Manajemen Lapangan & Area | `/lapangan` | `feature/lapangan` |
| **Yogi** | `@yogwhoss` | Manajemen Pelanggan & Member | `/member` | `feature/member` |
| **Alpi** | `@alfifauzanmaulana-sys` | Direktori Instruktur & Coach | `/instruktur` | `feature/instruktur` |

---

## 2. Aturan Wajib Anti-Konflik (Wajib Dibaca Sebelum Coding & Merge)

Agar proses penggabungan (*merging*) keempat modul ke branch `main` berjalan mulus tanpa *merge conflict*, seluruh anggota wajib mematuhi aturan isolasi file berikut:

### A. File Inti yang Dilarang Diubah atau Dihapus
1. **`resources/views/layouts/app.blade.php`**: Layout utama (navbar & footer) sudah dikonfigurasi dengan 4 menu navigasi yang mengarah ke `route('lapangan.index')`, `route('alat-olahraga.index')`, `route('member.index')`, dan `route('instruktur.index')`. Seluruh halaman modul wajib memakai `@extends('layouts.app')` dan `@section('content')`.
2. **Autentikasi & Role Middleware**: Jangan mengubah `LoginController`, `RoleMiddleware`, file migration tabel `users`, maupun `UserSeeder`.
3. **Kode Modul Anggota Lain**: Jangan memodifikasi Controller, Model, Migration, Seeder, atau folder View milik anggota lain.

### B. Isolasi Penamaan File per Modul
Setiap anggota hanya membuat dan mengubah file di dalam ruang lingkup modulnya masing-masing:

| Komponen | Orel (`/lapangan`) | Yogi (`/member`) | Alpi (`/instruktur`) |
| :--- | :--- | :--- | :--- |
| **Controller** | `app/Http/Controllers/LapanganController.php` | `app/Http/Controllers/MemberController.php` | `app/Http/Controllers/InstrukturController.php` |
| **Model** | `app/Models/Lapangan.php` | `app/Models/Member.php` | `app/Models/Instruktur.php` |
| **Migration** | `*_create_lapangans_table.php` | `*_create_members_table.php` | `*_create_instrukturs_table.php` |
| **Seeder** | `database/seeders/LapanganSeeder.php` | `database/seeders/MemberSeeder.php` | `database/seeders/InstrukturSeeder.php` |
| **Views** | `resources/views/lapangan/*.blade.php` | `resources/views/member/*.blade.php` | `resources/views/instruktur/*.blade.php` |

### C. Cara Aman Mengedit 2 File Bersama
Hanya ada **dua file bersama** yang boleh disentuh oleh setiap anggota:

1. **`routes/web.php`**
   Cari blok route *placeholder* milik modulmu saja, lalu ganti dengan `Route::resource(...)` milikmu. **Jangan menghapus atau menggeser baris route milik anggota lain.**
   ```php
   // Contoh untuk Orel (cukup ubah bagian /lapangan saja):
   Route::resource('lapangan', LapanganController::class);
   ```

2. **`database/seeders/DatabaseSeeder.php`**
   Tambahkan pemanggilan seeder modulmu di baris paling bawah di dalam method `run()` tanpa menghapus `UserSeeder` dan `AlatOlahragaSeeder`:
   ```php
   $this->call([
       UserSeeder::class,
       AlatOlahragaSeeder::class,
       LapanganSeeder::class,   // tambahkan seeder modulmu di sini
   ]);
   ```

---

## 3. Instalasi & Menjalankan Proyek Lokal

### Opsi A — Menggunakan Docker Sail (Linux / macOS / WSL2)
```bash
cp .env.example .env
./start-dev.sh
./vendor/bin/sail artisan migrate:fresh --seed
```
Buka di browser: **`http://localhost:8080/login`**

### Opsi B — Menggunakan PHP & MySQL Lokal (Laragon / XAMPP Windows)
1. Buka phpMyAdmin / MySQL dan buat database baru bernama **`sporthub_db`**.
2. Jalankan perintah berikut di terminal proyek:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
3. Sesuaikan konfigurasi database pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sporthub_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Jalankan migrasi, seeder, build aset frontend, dan server lokal:
   ```bash
   php artisan migrate:fresh --seed
   npm install && npm run build
   php artisan serve
   ```
Buka di browser: **`http://127.0.0.1:8000/login`**

### Akun Demo Login
| Role | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `admin123` | Kelola penuh (Tambah, Edit, Hapus data) |
| **User / Member** | `user@gmail.com` | `user123` | Melihat katalog & detail layanan |

---

## 4. Alur Kerja Git (Clone, Branch, Sync, & Pull Request)

**Dilarang melakukan `git push` langsung ke branch `main`.**

### Langkah 1 — Clone & Sinkronisasi `main`
```bash
git clone https://github.com/PAW-Ganjil-2627-SI/4910_Tim_B_SportHub.git
cd 4910_Tim_B_SportHub
git switch main
git pull origin main
```

### Langkah 2 — Buat Branch Baru Sebelum `git switch`
Buat branch baru terlebih dahulu sebelum berpindah ke branch tersebut sesuai pembagian tugas:
```bash
# Pilih sesuai tugas masing-masing:
git branch feature/lapangan && git switch feature/lapangan       # Orel
git branch feature/member && git switch feature/member           # Yogi
git branch feature/instruktur && git switch feature/instruktur   # Alpi
```

### Langkah 3 — Simpan & Push Perubahan ke Branch Modul
Pastikan file `.env` tidak ikut ter-commit, lalu kirim perubahan ke branch masing-masing:
```bash
git status
git add .
git commit -m "feat: tambah modul [nama-modul]"
git push -u origin feature/[nama-modul]
```

### Langkah 4 — Sinkronisasi Wajib Sebelum Pull Request (Anti-Konflik)
Sebelum membuat Pull Request—atau setiap kali ada anggota lain yang baru selesai di-*merge* ke `main`—tarik pembaruan terbaru dari `main` ke branch fiturmu terlebih dahulu:
```bash
git fetch origin
git switch feature/[nama-modul]
git merge origin/main
```
- Jika muncul *conflict* pada `routes/web.php` atau `DatabaseSeeder.php`, buka file tersebut dan **pertahankan kode milikmu beserta kode milik anggota lain** (jangan hapus salah satunya).
- Setelah dirapikan, jalankan kembali:
  ```bash
  git add .
  git commit -m "fix: selaraskan route dan seeder dengan main"
  git push origin feature/[nama-modul]
  ```

### Langkah 5 — Buat Pull Request (PR) & Merging Berurutan
1. Buka `https://github.com/PAW-Ganjil-2627-SI/4910_Tim_B_SportHub`.
2. Klik tab **Pull requests** → **New pull request**.
3. Pastikan arah penggabungan sudah benar: **base:** `main` ← **compare:** `feature/[nama-modul]`.
4. Klik **Create pull request**.
5. **Proses Merge Bareng:** Maintainer akan meninjau *compare code* dan melakukan **Merge pull request** satu per satu secara berurutan (setelah 1 PR di-*merge*, anggota berikutnya menjalankan **Langkah 4** sebelum PR-nya di-*merge*).

---

## 5. Checklist Sebelum Mengajukan Pull Request

- [ ] Seluruh view modul sudah memakai `@extends('layouts.app')`.
- [ ] Route *placeholder* lama untuk modul sendiri di `routes/web.php` sudah diganti tanpa menyentuh route anggota lain.
- [ ] Seeder modul sudah didaftarkan di `DatabaseSeeder.php` dan lulus uji `migrate:fresh --seed`.
- [ ] Sudah menjalankan `git merge origin/main` di branch fitur sehingga status PR di GitHub bertuliskan **Able to merge**.