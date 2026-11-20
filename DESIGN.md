# Design System & UI Component Specification — SportHub
**Proyek:** Sistem Manajemen Venue & Lapangan Olahraga (Studi Kasus 03)  
**Referensi Visual:** Stitch Project — *Sports Venue Management System*

---

## 1. Identitas & Prinsip Visual
- **Nama Sistem / Brand:** SportHub (*Sistem Manajemen Venue & Lapangan Olahraga*)
- **Gaya Antarmuka:** Clean Modern SaaS / Dashboard Operasional dengan kontras tinggi, sudut membulat (`rounded-xl` / `rounded-full`), latar putih bersih, dan aksen hijau olahraga.
- **Aturan Emas Tim:** Individu A, B, C, dan D **dilarang** mengubah warna utama, struktur Navbar, Banner Statistik, Filter Bar, maupun Footer. Setiap anggota hanya menyesuaikan konten kartu/tabel dan field form sesuai modul masing-masing.

---

## 2. Color Tokens (Kode Warna Wajib)

| Token Name | Hex Code | Penggunaan Spesifik di Antarmuka |
| :--- | :--- | :--- |
| **Primary Emerald** | `#009B5D` | Tombol CTA utama (`+ Tambah Data ...`, `Masuk ke Sistem`, `Simpan`), tab modul aktif, ikon brand, dan badge status tersedia |
| **Primary Hover** | `#007F4B` | State `:hover` pada seluruh tombol utama Emerald |
| **Banner Gradient Start** | `#65C14A` | Titik awal gradasi linear (`135deg`) pada Hero Summary Banner modul |
| **Banner Gradient End** | `#39A845` | Titik akhir gradasi linear pada Hero Summary Banner modul |
| **Deep Navy** | `#0C2340` | Top announcement bar paling atas, header brand pada card Login, dan Footer multi-kolom |
| **Pure White Surface** | `#FFFFFF` | Latar belakang utama halaman, Navbar sticky, kartu statistik, kartu item CRUD, dan modal dialog |
| **Soft Ice Blue** | `#E6F2F8` | Latar belakang halaman Login dan panel container Pencarian & Filter di bawah banner |
| **Border & Divider** | `#E2E8F0` | Garis tepi halus (`1px solid`) pada card, input form, dropdown, dan pemisah tabel |
| **Heading Text** | `#1E293B` | Judul halaman, nama item/entitas, angka statistik utama, dan label form |
| **Muted Body Text** | `#475569` | Subjudul, kode SKU/ID, deskripsi singkat, dan teks sekunder |

---

## 3. Tipografi, Radius, & Elevasi
- **Font Family:** `Plus Jakarta Sans` atau `Inter` (sans-serif).
- **Border Radius:**
  - Card & Container Utama: `12px` (`rounded-xl`)
  - Input Form & Modal: `8px`–`12px` (`rounded-lg` / `rounded-xl`)
  - Navigasi Tab, Search Bar, & Badge Status: `9999px` (`rounded-full` / pill-shaped)
- **Shadow:** `0 1px 3px rgba(15, 23, 42, 0.08)` (`shadow-sm`) pada kartu putih di atas banner hijau dan grid data.

---

## 4. Spesifikasi Struktur Komponen Bersama

### A. Unified Login Page (`Screen A`)
- **Background:** Full-screen Soft Ice Blue (`#E6F2F8`) dengan card putih terpusat (`max-w-md rounded-xl shadow-md overflow-hidden`).
- **Card Header:** Blok Deep Navy (`#0C2340`) berisi logo **SportHub** dan subtitle *"Sistem Manajemen Venue & Lapangan Olahraga"*.
- **Body:** Heading *"Selamat Datang Kembali"*, input Email & Password, tombol submit full-width Emerald Green (`#009B5D`), serta kotak informasi akun demo di bagian bawah.

### B. Top Utility Bar & Sticky Navbar
- **Top Utility Bar:** Bar tipis Deep Navy (`#0C2340`) dengan teks informasi sistem berwarna putih.
- **Sticky Navbar (`#FFFFFF`, border bawah `#E2E8F0`):**
  - **Kiri:** Logo **SportHub**.
  - **Tengah (Pill Navigation Tabs):** Menu navigasi ke 4 modul kelompok:
    1. `Lapangan & Area` (`/lapangan`) — Individu A
    2. `Rental Alat Olahraga` (`/alat-olahraga`) — Individu B
    3. `Pelanggan & Member` (`/member`) — Individu C
    4. `Instruktur & Coach` (`/instruktur`) — Individu D
    *(Tab modul yang sedang dibuka menggunakan background `#009B5D` teks putih; tab lainnya teks `#475569` hover `#F1F5F9`).*
  - **Kanan:** Badge Role aktif (`Admin` / `User`), nama akun, dan tombol `Logout`.

### C. Gradient Summary Banner & 4 Stat Cards
- **Container:** Blok full-width berlatar gradasi `#65C14A` ke `#39A845` (`rounded-2xl p-6 text-white`).
- **Header Banner:** Judul modul di kiri dan informasi ringkas/waktu di kanan.
- **4 Kartu Statistik Putih (`grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4`):**
  - Kartu berlatar `#FFFFFF`, sudut `rounded-xl`, berisi ikon kecil dengan badge status di pojok kanan atas, angka metrik besar (`#1E293B`), dan label keterangan (`#475569`).

### D. Ice-Blue Filter & Action Panel
- **Container:** Kotak Soft Ice Blue (`#E6F2F8`, `rounded-xl p-4 border border-[#E2E8F0]`).
- **Baris Atas:** Input pencarian berbentuk pill (`rounded-full bg-white`) di sisi kiri, diikuti filter kategori/status, dan tombol aksi utama Emerald Green (`#009B5D`) **`+ Tambah Data [Nama Entitas]`** di ujung kanan *(hanya tampil untuk role `admin`)*.
- **View Switcher:** Tab kecil di bawah panel filter untuk berpindah antara `Tampilan Grid Kartu` dan `Tampilan Tabel Data`.

### E. Area Konten CRUD & Footer
- **Tampilan Grid / Tabel:** Menampilkan daftar data modul dengan badge status berwarna (Tersedia/Aktif = hijau lembut, Dipakai/Disewa = biru/kuning lembut, Maintenance/Nonaktif = merah lembut) serta tombol aksi `Detail`, `Edit`, dan `Hapus` (khusus Admin).
- **Footer:** Blok Deep Navy (`#0C2340`) multi-kolom berisi profil SportHub, navigasi cepat 4 modul, dan informasi hak cipta sistem.

---

## 5. Panduan Penyesuaian Konten per Anggota

| Anggota | Judul Banner Modul | 4 Kartu Statistik Banner | Contoh Field Utama Card / Tabel |
| :--- | :--- | :--- | :--- |
| **Individu A** | Manajemen Lapangan & Area | Total Lapangan, Tersedia, Sedang Digunakan, Perbaikan | Nama Lapangan, Jenis Rumput/Lantai, Ukuran, Tarif/Jam, Status Fisik |
| **Individu B** | Inventaris & Rental Peralatan Olahraga | Total Unit, Tersedia, Sedang Disewa, Servis/Rusak | Nama Alat, SKU, Kategori, Kondisi, Tarif Sewa, Lokasi Loker |
| **Individu C** | Manajemen Pelanggan & Member | Total Member, Member VIP, Member Gold, Member Basic | Nama Pelanggan, ID Member, Level (`Basic`/`Gold`/`VIP`), Kontak, Status |
| **Individu D** | Direktori Instruktur & Coach | Total Instruktur, Tersedia, Sesi Aktif, Cuti/Off | Nama Coach, Nomor Lisensi, Cabang Olahraga, Pengalaman, Tarif Sesi |
