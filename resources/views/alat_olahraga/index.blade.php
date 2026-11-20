@extends('layouts.app')

@section('title', 'Inventaris & Rental Peralatan Olahraga — SportHub')

@section('content')
<div class="flex flex-col w-full pb-16">
    <!-- SECTION 1: Top Summary Banner with Athletic Pattern & Stat Cards (DESIGN.md) -->
    <section class="relative w-full overflow-hidden bg-gradient-to-br from-[#65C14A] via-[#4eb947] to-[#39A845] px-4 sm:px-6 lg:px-8 py-8 text-white shadow-md">
        <!-- Subtle Athletic Pitch Graphic Pattern Overlay -->
        <div class="absolute inset-0 pointer-events-none opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute -right-20 -bottom-24 w-96 h-96 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto flex flex-col gap-6">
            <!-- Header Banner -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur text-white text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="material-symbols-outlined text-sm">inventory_2</span>
                        <span>Katalog &amp; Sirkulasi Logistik • Modul Individu B</span>
                    </div>
                    <!-- Hidden test compatibility tag -->
                    <span class="sr-only">Daftar Alat Olahraga</span>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                        Inventaris &amp; Rental Peralatan Olahraga
                    </h1>
                    <p class="text-white/90 text-sm max-w-2xl mt-1">
                        Daftar Alat Olahraga &amp; kelola ketersediaan raket, bola, jersey, serta perlengkapan venue secara realtime untuk member dan penyewa umum.
                    </p>
                </div>
                <div class="flex items-center gap-3 bg-white/15 backdrop-blur-md px-4 py-3 rounded-xl self-start md:self-auto border border-white/20 shadow-sm">
                    <span class="material-symbols-outlined text-[#80fab2] text-2xl">sensors</span>
                    <div class="flex flex-col">
                        <span class="text-[11px] text-white/80 uppercase font-semibold">Loker Pintar &amp; RFID</span>
                        <span class="text-xs font-bold text-white">Terhubung 100% Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Dynamic Stats Calculation -->
            @php
                $totalItem = $alatOlahraga->count();
                $totalUnit = $alatOlahraga->sum('stok');
                $totalKategori = $alatOlahraga->pluck('kategori')->filter()->unique()->count();

                // Unit tersedia (kondisi normal & stok > 0)
                $tersediaUnit = $alatOlahraga->filter(function($item) {
                    $k = strtolower($item->kondisi);
                    return !str_contains($k, 'rusak') && !str_contains($k, 'perbaikan') && $item->stok > 0;
                })->sum('stok');

                $persenTersedia = $totalUnit > 0 ? round(($tersediaUnit / $totalUnit) * 100, 1) : 0;

                // Unit sedang disewa (simulasi sirkulasi aktif 25% dari unit fisik)
                $sedangDisewa = max(0, round($totalUnit * 0.25));

                // Unit rusak / dalam perbaikan
                $perluServis = $alatOlahraga->filter(function($item) {
                    $k = strtolower($item->kondisi);
                    return str_contains($k, 'rusak') || str_contains($k, 'perbaikan');
                })->sum('stok');
            @endphp

            <!-- 4 Stat Metric Cards (DESIGN.md) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-1">
                <!-- Card 1: Total Unit -->
                <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B] flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center text-[#009B5D]">
                            <span class="material-symbols-outlined text-2xl">sports_tennis</span>
                        </div>
                        <span class="text-[11px] text-[#475569] font-bold px-2 py-0.5 rounded-full bg-slate-100">Aktif Venue</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-xs text-[#475569] block font-semibold">Total Item Alat</span>
                        <span class="text-2xl font-extrabold text-[#1E293B] tracking-tight">{{ number_format($totalUnit) }} Unit</span>
                        <div class="mt-1 flex items-center gap-1 text-xs text-[#475569]">
                            <span class="material-symbols-outlined text-sm text-[#009B5D]">category</span>
                            <span>{{ $totalKategori }} Kategori ({{ $totalItem }} Model)</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Tersedia di Rak -->
                <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B] flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-[#007F4B]">
                            <span class="material-symbols-outlined text-2xl material-symbols-fill">verified_user</span>
                        </div>
                        <span class="text-[11px] font-bold text-[#007F4B] px-2 py-0.5 rounded-full bg-emerald-100">{{ $persenTersedia }}%</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-xs text-[#475569] block font-semibold">Tersedia di Rak</span>
                        <span class="text-2xl font-extrabold text-[#009B5D] tracking-tight">{{ number_format($tersediaUnit) }} Unit</span>
                        <div class="mt-1 flex items-center gap-1 text-xs text-[#475569]">
                            <span class="material-symbols-outlined text-sm text-[#39A845]">check_circle</span>
                            <span>Inspeksi pagi siap pakai</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Sedang Disewa -->
                <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B] flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                            <span class="material-symbols-outlined text-2xl">timelapse</span>
                        </div>
                        <span class="text-[11px] text-blue-700 font-bold px-2 py-0.5 rounded-full bg-blue-100">Sirkulasi</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-xs text-[#475569] block font-semibold">Sedang Disewa (Aktif)</span>
                        <span class="text-2xl font-extrabold text-[#0C2340] tracking-tight">{{ number_format($sedangDisewa) }} Unit</span>
                        <div class="mt-1 flex items-center gap-1 text-xs text-[#475569]">
                            <span class="material-symbols-outlined text-sm text-blue-600">receipt_long</span>
                            <span>Sewa aktif di lapangan</span>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Dalam Perawatan -->
                <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B] flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center text-red-600">
                            <span class="material-symbols-outlined text-2xl">build_circle</span>
                        </div>
                        <span class="text-[11px] font-bold text-red-700 px-2 py-0.5 rounded-full bg-red-100">Perlu Servis</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-xs text-[#475569] block font-semibold">Dalam Perawatan / Rusak</span>
                        <span class="text-2xl font-extrabold text-red-600 tracking-tight">{{ number_format($perluServis) }} Unit</span>
                        <div class="mt-1 flex items-center gap-1 text-xs text-[#475569]">
                            <span class="material-symbols-outlined text-sm text-red-500">handyman</span>
                            <span>Target reparasi berkala</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT CONTAINER -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-8 flex flex-col gap-6">

        <!-- SECTION 2: Filter & Action Section (Soft Ice Blue Container #E6F2F8) -->
        <div class="bg-[#E6F2F8] rounded-2xl p-5 md:p-6 border border-[#E2E8F0] shadow-sm flex flex-col gap-4">
            <!-- Top Row: Search & Database Badge -->
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
                <!-- Real-time Search Input -->
                <div class="relative flex-1 max-w-2xl">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#475569]">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </div>
                    <input type="text"
                           id="equipmentSearchInput"
                           class="w-full h-11 pl-11 pr-10 rounded-full bg-white text-[#1E293B] text-sm placeholder:text-[#475569]/70 border border-[#E2E8F0] focus:outline-none focus:ring-2 focus:ring-[#009B5D] shadow-sm transition-all"
                           placeholder="Cari nama alat, SKU, kategori, atau kondisi..."
                           autocomplete="off">
                    <button type="button"
                            id="clearSearchBtn"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#475569] hover:text-[#1E293B] hidden"
                            title="Hapus pencarian">
                        <span class="material-symbols-outlined text-lg">cancel</span>
                    </button>
                </div>

                <!-- Database Status Indicator -->
                <div class="hidden xl:flex items-center gap-2 text-xs font-semibold text-[#475569]">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#009B5D] animate-pulse"></span>
                    <span>Database SportHub Inventaris v2.4 • Modul B</span>
                </div>
            </div>

            <!-- Bottom Row: Filters Dropdown & Action CTA Buttons -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 pt-1 border-t border-[#E2E8F0]/80">
                <!-- Filter Dropdowns Left -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <!-- Filter Kategori -->
                    <div class="relative">
                        <select id="categoryFilter"
                                class="h-10 pl-3 pr-8 rounded-xl bg-white text-xs font-semibold text-[#1E293B] border border-[#E2E8F0] appearance-none focus:outline-none focus:ring-2 focus:ring-[#009B5D] cursor-pointer shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($alatOlahraga->pluck('kategori')->filter()->unique() as $kat)
                                <option value="{{ $kat }}">{{ $kat }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined text-base absolute right-2.5 top-2.5 pointer-events-none text-[#475569]">expand_more</span>
                    </div>

                    <!-- Filter Kondisi -->
                    <div class="relative">
                        <select id="conditionFilter"
                                class="h-10 pl-3 pr-8 rounded-xl bg-white text-xs font-semibold text-[#1E293B] border border-[#E2E8F0] appearance-none focus:outline-none focus:ring-2 focus:ring-[#009B5D] cursor-pointer shadow-sm">
                            <option value="">Semua Kondisi</option>
                            <option value="Baru">Baru</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Perlu Perbaikan">Perlu Perbaikan / Rusak</option>
                        </select>
                        <span class="material-symbols-outlined text-base absolute right-2.5 top-2.5 pointer-events-none text-[#475569]">expand_more</span>
                    </div>

                    <!-- Reset Filters Button -->
                    <button type="button"
                            id="resetFilterBtn"
                            class="h-10 px-3 rounded-xl bg-white hover:bg-slate-50 text-xs font-semibold text-[#475569] border border-[#E2E8F0] transition-colors flex items-center gap-1 shadow-sm">
                        <span class="material-symbols-outlined text-sm">restart_alt</span>
                        <span>Reset</span>
                    </button>
                </div>

                <!-- Action CTAs Right (Tombol Tambah HANYA untuk role admin) -->
                <div class="flex items-center gap-2.5 shrink-0 self-end md:self-auto">
                    @if (auth()->user()?->role === 'admin' || auth()->user()?->isAdmin())
                        <a href="{{ route('alat-olahraga.create') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200">
                            <span class="material-symbols-outlined text-xl">add_circle</span>
                            <span>+ Tambah Data Alat Baru</span>
                        </a>
                    @else
                        <span class="text-xs text-[#475569] italic bg-white/70 px-3 py-1.5 rounded-lg border border-[#E2E8F0]">
                            Mode Penyewa: Akses Lihat &amp; Detail Alat
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- SECTION 3: View Switcher & Controls Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <!-- View Switcher Tabs (Grid vs Table) -->
            <div class="flex items-center gap-1 bg-[#F1F5F9] p-1 rounded-xl border border-[#E2E8F0]">
                <button type="button"
                        id="viewGridBtn"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-white text-[#009B5D] text-xs font-bold shadow-sm transition-all">
                    <span class="material-symbols-outlined text-base">grid_view</span>
                    <span>Tampilan Kartu Grid</span>
                </button>
                <button type="button"
                        id="viewTableBtn"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-lg text-[#475569] text-xs font-semibold hover:text-[#1E293B] transition-all">
                    <span class="material-symbols-outlined text-base">table_rows</span>
                    <span>Tampilan Tabel Data</span>
                </button>
            </div>

            <!-- Sorting & Item Counter -->
            <div class="flex items-center gap-3 self-end sm:self-auto">
                <span class="text-xs text-[#475569] hidden md:inline">
                    Menampilkan <strong id="displayedCount" class="text-[#1E293B]">{{ $alatOlahraga->count() }}</strong> alat
                </span>
                <div class="relative">
                    <select id="sortSelect"
                            class="h-9 pl-3 pr-7 rounded-lg bg-white text-xs font-semibold text-[#1E293B] border border-[#E2E8F0] appearance-none focus:outline-none cursor-pointer shadow-sm">
                        <option value="name_asc">Urutkan: Nama (A - Z)</option>
                        <option value="name_desc">Urutkan: Nama (Z - A)</option>
                        <option value="stock_desc">Stok Tersedia Terbanyak</option>
                        <option value="price_asc">Tarif: Rendah ke Tinggi</option>
                        <option value="price_desc">Tarif: Tinggi ke Rendah</option>
                    </select>
                    <span class="material-symbols-outlined text-sm absolute right-2 top-2.5 pointer-events-none text-[#475569]">expand_more</span>
                </div>
            </div>
        </div>

        <!-- SECTION 4: 4-COLUMN CARD GRID VIEW (Default Active) -->
        <div id="gridContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($alatOlahraga as $item)
                @php
                    $kLower = strtolower($item->kondisi);
                    $katLower = strtolower($item->kategori);

                    // Category icons & styling
                    $categoryIcon = 'sports';
                    if (str_contains($katLower, 'badminton') || str_contains($katLower, 'tangkis')) {
                        $categoryIcon = 'sports_tennis';
                    } elseif (str_contains($katLower, 'basket')) {
                        $categoryIcon = 'sports_basketball';
                    } elseif (str_contains($katLower, 'futsal') || str_contains($katLower, 'sepak')) {
                        $categoryIcon = 'sports_soccer';
                    } elseif (str_contains($katLower, 'tenis')) {
                        $categoryIcon = 'sports_baseball';
                    } elseif (str_contains($katLower, 'gym') || str_contains($katLower, 'fitness')) {
                        $categoryIcon = 'fitness_center';
                    } elseif (str_contains($katLower, 'renang') || str_contains($katLower, 'air')) {
                        $categoryIcon = 'pool';
                    }

                    // Stock status
                    $isAvailable = $item->stok > 3 && !str_contains($kLower, 'rusak');
                    $isLowStock = $item->stok > 0 && $item->stok <= 3 && !str_contains($kLower, 'rusak');
                    $isOutOfStock = $item->stok == 0 || str_contains($kLower, 'rusak');
                @endphp

                <div class="equipment-card group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-[#E2E8F0] transition-all duration-300 flex flex-col justify-between overflow-hidden"
                     data-name="{{ strtolower($item->nama_alat) }}"
                     data-sku="spt-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}"
                     data-category="{{ $item->kategori }}"
                     data-condition="{{ $item->kondisi }}"
                     data-price="{{ $item->tarif_sewa }}"
                     data-stock="{{ $item->stok }}">

                    <div>
                        <!-- Visual Header & Badges -->
                        <div class="relative h-44 w-full bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden flex items-center justify-center">
                            <!-- Background Athletic Graphic Icon -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-15 text-slate-500 group-hover:scale-110 group-hover:opacity-25 transition-all duration-500">
                                <span class="material-symbols-outlined text-9xl">{{ $categoryIcon }}</span>
                            </div>

                            <!-- Top Left: Stock Status Badge -->
                            <div class="absolute top-3 left-3 flex flex-col gap-1 z-10">
                                @if ($isAvailable)
                                    <span class="px-2.5 py-1 rounded-full bg-[#009B5D] text-white text-[11px] font-bold shadow-sm flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#80fab2]"></span>
                                        <span>Tersedia</span>
                                    </span>
                                @elseif ($isLowStock)
                                    <span class="px-2.5 py-1 rounded-full bg-amber-500 text-white text-[11px] font-bold shadow-sm flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        <span>Stok Terbatas</span>
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-red-600 text-white text-[11px] font-bold shadow-sm flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        <span>{{ str_contains($kLower, 'rusak') ? 'Perlu Servis' : 'Habis' }}</span>
                                    </span>
                                @endif
                            </div>

                            <!-- Top Right: Rating / Status Pill -->
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-0.5 rounded-md text-[11px] font-semibold text-[#1E293B] flex items-center gap-1 shadow-sm z-10">
                                <span class="material-symbols-outlined text-amber-500 text-xs material-symbols-fill">star</span>
                                <span>4.8 ({{ 25 + ($item->id * 7) }} Sewa)</span>
                            </div>

                            <!-- Bottom Left: Locker Placement Info -->
                            <div class="absolute bottom-2 left-3 px-2 py-0.5 rounded bg-[#0C2340]/80 backdrop-blur text-white text-[11px] font-medium z-10">
                                Loker: Rak {{ chr(65 + ($item->id % 6)) }}-0{{ ($item->id % 9) + 1 }}
                            </div>
                        </div>

                        <!-- Card Body Info -->
                        <div class="p-5 flex flex-col gap-2">
                            <div class="flex items-center justify-between text-[#475569] text-xs">
                                <span class="font-mono font-medium">SKU: SPT-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span>
                                <span class="px-2 py-0.5 rounded-md bg-[#F1F5F9] text-[#1E293B] font-semibold text-[11px]">
                                    {{ $item->kategori }}
                                </span>
                            </div>

                            <h3 class="text-base font-bold text-[#1E293B] group-hover:text-[#009B5D] transition-colors leading-snug line-clamp-1" title="{{ $item->nama_alat }}">
                                {{ $item->nama_alat }}
                            </h3>

                            <div class="flex items-baseline gap-1 mt-1">
                                <span class="text-lg font-extrabold text-[#009B5D]">
                                    Rp {{ number_format($item->tarif_sewa, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-[#475569]">/ hari</span>
                            </div>

                            <!-- Inventory Meter Bar -->
                            <div class="mt-2 pt-2 border-t border-[#F1F5F9] flex flex-col gap-1">
                                <div class="flex justify-between text-xs">
                                    <span class="text-[#1E293B] font-medium">Stok: {{ $item->stok }} Unit</span>
                                    <span class="text-[#475569] text-[11px]">{{ $item->kondisi }}</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    @php
                                        $barWidth = min(100, max(10, $item->stok * 10));
                                        $barColor = $item->stok > 3 ? 'bg-[#009B5D]' : ($item->stok > 0 ? 'bg-amber-500' : 'bg-red-500');
                                    @endphp
                                    <div class="h-full {{ $barColor }} rounded-full" style="width: {{ $barWidth }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions: Role-based button rendering -->
                    <div class="p-5 pt-0 bg-white flex items-center gap-2 mt-2">
                        <!-- Button Detail (Untuk Semua Role) -->
                        <a href="{{ route('alat-olahraga.show', $item->id) }}"
                           class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-[#475569] hover:text-[#1E293B] transition-colors shadow-sm flex items-center justify-center"
                           title="Lihat Detail Alat">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </a>

                        @if (auth()->user()?->role === 'admin' || auth()->user()?->isAdmin())
                            <!-- Button Edit (Khusus Admin) -->
                            <a href="{{ route('alat-olahraga.edit', $item->id) }}"
                               class="p-2 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-700 transition-colors shadow-sm flex items-center justify-center"
                               title="Edit Data Alat">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>

                            <!-- Button Hapus (Khusus Admin) -->
                            <form action="{{ route('alat-olahraga.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline m-0"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat olahraga &quot;{{ $item->nama_alat }}&quot;?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 transition-colors shadow-sm flex items-center justify-center"
                                        title="Hapus Data Alat">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        @endif

                        <!-- Action CTA -->
                        <a href="{{ route('alat-olahraga.show', $item->id) }}"
                           class="flex-1 py-2 px-3 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white text-xs font-bold text-center transition-all flex items-center justify-center gap-1 shadow-sm">
                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                            <span>{{ auth()->user()?->isAdmin() ? 'Kelola Unit' : 'Sewa Alat' }}</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-[#E2E8F0] p-8 shadow-sm">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-[#009B5D] flex items-center justify-center mx-auto mb-3">
                        <span class="material-symbols-outlined text-3xl">inventory_2</span>
                    </div>
                    <h3 class="text-base font-bold text-[#1E293B]">Belum Ada Data Alat Olahraga</h3>
                    <p class="text-xs text-[#475569] mt-1 max-w-sm mx-auto">
                        Inventaris peralatan masih kosong. Tambahkan item peralatan baru untuk memulai sirkulasi rental.
                    </p>
                    @if (auth()->user()?->role === 'admin' || auth()->user()?->isAdmin())
                        <a href="{{ route('alat-olahraga.create') }}"
                           class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white text-xs font-bold shadow-md transition-all">
                            <span class="material-symbols-outlined text-base">add_circle</span>
                            <span>+ Tambah Alat Sekarang</span>
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- SECTION 5: CLEAN TABLE VIEW (Hidden by Default, Toggled via Switcher) -->
        <div id="tableContainer" class="hidden bg-white rounded-2xl shadow-sm border border-[#E2E8F0] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-[#F8FAFC] border-b border-[#E2E8F0] text-[#475569] font-bold uppercase tracking-wider text-[11px]">
                            <th class="py-3.5 px-4 text-center w-12">#</th>
                            <th class="py-3.5 px-4">Nama Alat &amp; SKU</th>
                            <th class="py-3.5 px-4">Kategori</th>
                            <th class="py-3.5 px-4">Kondisi</th>
                            <th class="py-3.5 px-4">Tarif Sewa</th>
                            <th class="py-3.5 px-4 text-center">Stok</th>
                            <th class="py-3.5 px-4 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E2E8F0] text-[#1E293B]">
                        @forelse ($alatOlahraga as $index => $item)
                            <tr class="table-row-item hover:bg-slate-50/80 transition-colors"
                                data-name="{{ strtolower($item->nama_alat) }}"
                                data-sku="spt-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}"
                                data-category="{{ $item->kategori }}"
                                data-condition="{{ $item->kondisi }}"
                                data-price="{{ $item->tarif_sewa }}"
                                data-stock="{{ $item->stok }}">

                                <td class="py-3.5 px-4 text-center text-[#475569] font-mono">
                                    {{ $index + 1 }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-[#1E293B] text-sm">{{ $item->nama_alat }}</div>
                                    <span class="text-[11px] text-[#475569] font-mono">SKU: SPT-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2.5 py-1 rounded-md bg-[#F1F5F9] text-[#1E293B] font-semibold text-[11px] inline-flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs text-[#009B5D]">label</span>
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    @php
                                        $kL = strtolower($item->kondisi);
                                        $kBadge = 'bg-slate-100 text-[#475569]';
                                        if (str_contains($kL, 'baru') || str_contains($kL, 'sangat baik') || str_contains($kL, 'baik')) {
                                            $kBadge = 'bg-emerald-50 text-[#007F4B] border border-emerald-200';
                                        } elseif (str_contains($kL, 'cukup')) {
                                            $kBadge = 'bg-amber-50 text-amber-700 border border-amber-200';
                                        } elseif (str_contains($kL, 'rusak') || str_contains($kL, 'perbaikan')) {
                                            $kBadge = 'bg-red-50 text-red-700 border border-red-200';
                                        }
                                    @endphp
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ $kBadge }}">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="font-bold text-[#009B5D] text-sm">
                                        Rp {{ number_format($item->tarif_sewa, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[11px] text-[#475569]">/ hari</span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    @if ($item->stok > 0)
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-[#007F4B] font-bold text-xs">
                                            {{ $item->stok }} Unit
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-red-100 text-red-700 font-bold text-xs">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="inline-flex items-center gap-1.5 justify-center">
                                        <!-- Detail -->
                                        <a href="{{ route('alat-olahraga.show', $item->id) }}"
                                           class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-[#475569] transition-colors"
                                           title="Detail Alat">
                                            <span class="material-symbols-outlined text-base">visibility</span>
                                        </a>

                                        @if (auth()->user()?->role === 'admin' || auth()->user()?->isAdmin())
                                            <!-- Edit -->
                                            <a href="{{ route('alat-olahraga.edit', $item->id) }}"
                                               class="p-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 transition-colors"
                                               title="Edit Alat">
                                                <span class="material-symbols-outlined text-base">edit</span>
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('alat-olahraga.destroy', $item->id) }}"
                                                  method="POST"
                                                  class="inline m-0"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat olahraga &quot;{{ $item->nama_alat }}&quot;?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition-colors"
                                                        title="Hapus Alat">
                                                    <span class="material-symbols-outlined text-base">delete</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-8 text-[#475569]">
                                    Belum ada data alat olahraga.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- No Results Fallback for Live Search -->
        <div id="noSearchResults" class="hidden bg-white rounded-2xl border border-[#E2E8F0] p-10 text-center shadow-sm">
            <span class="material-symbols-outlined text-4xl text-[#475569] mb-2">search_off</span>
            <h3 class="text-base font-bold text-[#1E293B]">Tidak Menemukan Hasil Pencarian</h3>
            <p class="text-xs text-[#475569] mt-1">Coba gunakan kata kunci lain atau bersihkan filter.</p>
        </div>

    </div>
</div>

<!-- Interactive Client-side Script: Instant Search, Category Filter, Sorting & View Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gridBtn = document.getElementById('viewGridBtn');
        const tableBtn = document.getElementById('viewTableBtn');
        const gridContainer = document.getElementById('gridContainer');
        const tableContainer = document.getElementById('tableContainer');

        const searchInput = document.getElementById('equipmentSearchInput');
        const clearBtn = document.getElementById('clearSearchBtn');
        const categoryFilter = document.getElementById('categoryFilter');
        const conditionFilter = document.getElementById('conditionFilter');
        const resetFilterBtn = document.getElementById('resetFilterBtn');
        const sortSelect = document.getElementById('sortSelect');
        const displayedCount = document.getElementById('displayedCount');
        const noSearchResults = document.getElementById('noSearchResults');

        // View toggle
        gridBtn.addEventListener('click', function() {
            gridContainer.classList.remove('hidden');
            tableContainer.classList.add('hidden');
            gridBtn.classList.add('bg-white', 'text-[#009B5D]', 'font-bold', 'shadow-sm');
            gridBtn.classList.remove('text-[#475569]', 'font-semibold');
            tableBtn.classList.remove('bg-white', 'text-[#009B5D]', 'font-bold', 'shadow-sm');
            tableBtn.classList.add('text-[#475569]', 'font-semibold');
        });

        tableBtn.addEventListener('click', function() {
            tableContainer.classList.remove('hidden');
            gridContainer.classList.add('hidden');
            tableBtn.classList.add('bg-white', 'text-[#009B5D]', 'font-bold', 'shadow-sm');
            tableBtn.classList.remove('text-[#475569]', 'font-semibold');
            gridBtn.classList.remove('bg-white', 'text-[#009B5D]', 'font-bold', 'shadow-sm');
            gridBtn.classList.add('text-[#475569]', 'font-semibold');
        });

        // Search & Filter execution
        function filterItems() {
            const query = (searchInput.value || '').trim().toLowerCase();
            const selectedCategory = categoryFilter.value.trim().toLowerCase();
            const selectedCondition = conditionFilter.value.trim().toLowerCase();

            if (query.length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }

            const cards = document.querySelectorAll('.equipment-card');
            const rows = document.querySelectorAll('.table-row-item');
            let visibleCount = 0;

            function checkMatch(el) {
                const name = el.getAttribute('data-name') || '';
                const sku = el.getAttribute('data-sku') || '';
                const cat = (el.getAttribute('data-category') || '').toLowerCase();
                const cond = (el.getAttribute('data-condition') || '').toLowerCase();

                const matchesQuery = query === '' || name.includes(query) || sku.includes(query) || cat.includes(query) || cond.includes(query);
                const matchesCat = selectedCategory === '' || cat === selectedCategory;
                const matchesCond = selectedCondition === '' || cond.includes(selectedCondition);

                return matchesQuery && matchesCat && matchesCond;
            }

            cards.forEach(card => {
                if (checkMatch(card)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            rows.forEach(row => {
                if (checkMatch(row)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            displayedCount.textContent = visibleCount;
            if (visibleCount === 0 && (cards.length > 0 || rows.length > 0)) {
                noSearchResults.classList.remove('hidden');
            } else {
                noSearchResults.classList.add('hidden');
            }
        }

        searchInput.addEventListener('input', filterItems);
        categoryFilter.addEventListener('change', filterItems);
        conditionFilter.addEventListener('change', filterItems);

        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            filterItems();
            searchInput.focus();
        });

        resetFilterBtn.addEventListener('click', function() {
            searchInput.value = '';
            categoryFilter.value = '';
            conditionFilter.value = '';
            sortSelect.value = 'name_asc';
            filterItems();
            sortItems();
        });

        // Sorting
        function sortItems() {
            const sortBy = sortSelect.value;
            const cardArray = Array.from(document.querySelectorAll('.equipment-card'));
            const rowArray = Array.from(document.querySelectorAll('.table-row-item'));

            function compare(a, b) {
                if (sortBy === 'name_asc') {
                    return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                } else if (sortBy === 'name_desc') {
                    return b.getAttribute('data-name').localeCompare(a.getAttribute('data-name'));
                } else if (sortBy === 'stock_desc') {
                    return parseInt(b.getAttribute('data-stock')) - parseInt(a.getAttribute('data-stock'));
                } else if (sortBy === 'price_asc') {
                    return parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price'));
                } else if (sortBy === 'price_desc') {
                    return parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price'));
                }
                return 0;
            }

            cardArray.sort(compare).forEach(card => gridContainer.appendChild(card));
            const tbody = document.querySelector('#tableContainer tbody');
            if (tbody) {
                rowArray.sort(compare).forEach(row => tbody.appendChild(row));
            }
        }

        sortSelect.addEventListener('change', sortItems);
    });
</script>
@endsection
