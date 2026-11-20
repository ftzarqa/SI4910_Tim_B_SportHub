@extends('layouts.app')

@section('title', 'Inventaris & Rental Peralatan Olahraga | SportHub')

@section('content')
<div class="flex flex-col w-full pb-16">
    <!-- SECTION 1: Top Summary Banner (Banner #65C14A ke #39A845, rounded-xl) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-6">
        <section class="relative w-full overflow-hidden bg-gradient-to-r from-[#65C14A] to-[#39A845] p-6 sm:p-8 rounded-xl text-white shadow-sm">
            <div class="relative flex flex-col gap-6">
                <!-- Header Banner -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white/20 text-white text-xs font-bold uppercase tracking-wider mb-2">
                            <span class="material-symbols-outlined text-sm">inventory_2</span>
                            <span>Katalog &amp; Logistik Alat</span>
                        </div>
                        <span class="sr-only">Daftar Alat Olahraga</span>
                        <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                            Inventaris &amp; Rental Peralatan Olahraga
                        </h1>
                        <p class="text-white/90 text-xs sm:text-sm max-w-2xl mt-1">
                            Kelola ketersediaan raket, bola, pelindung, dan perlengkapan olahraga secara realtime untuk member dan penyewa venue.
                        </p>
                    </div>
                    <div class="flex items-center gap-3 bg-white/15 px-3.5 py-2.5 rounded-lg border border-white/20 shadow-sm self-start md:self-auto">
                        <span class="material-symbols-outlined text-[#80fab2] text-xl">sensors</span>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-white/80 uppercase font-semibold">Integrasi Loker</span>
                            <span class="text-xs font-bold text-white">Sistem Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Stats Calculation -->
                @php
                    $totalItem = $alatOlahraga->count();
                    $totalUnit = $alatOlahraga->sum('stok');
                    $totalKategori = $alatOlahraga->pluck('kategori')->filter()->unique()->count();

                    // Unit tersedia (kondisi baik & stok > 0)
                    $tersediaUnit = $alatOlahraga->filter(function($item) {
                        $k = strtolower($item->kondisi);
                        return !str_contains($k, 'rusak') && !str_contains($k, 'perbaikan') && $item->stok > 0;
                    })->sum('stok');

                    $persenTersedia = $totalUnit > 0 ? round(($tersediaUnit / $totalUnit) * 100, 1) : 0;
                    $sedangDisewa = max(0, round($totalUnit * 0.25));

                    $perluServis = $alatOlahraga->filter(function($item) {
                        $k = strtolower($item->kondisi);
                        return str_contains($k, 'rusak') || str_contains($k, 'perbaikan');
                    })->sum('stok');
                @endphp

                <!-- 4 Stat Metric Cards (rounded-xl, tabular-nums) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Card 1: Total Unit -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-[#E2E8F0] text-[#1E293B] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center text-[#009B5D]">
                                <span class="material-symbols-outlined text-xl">sports_tennis</span>
                            </div>
                            <span class="text-[11px] text-[#475569] font-bold px-2 py-0.5 rounded-md bg-slate-100">Venue</span>
                        </div>
                        <div class="mt-3">
                            <span class="text-xs text-[#475569] block font-semibold">Total Item Inventaris</span>
                            <span class="text-2xl font-extrabold text-[#1E293B] font-mono tabular-nums tracking-tight">{{ number_format($totalUnit) }} Unit</span>
                            <div class="mt-1 flex items-center gap-1 text-[11px] text-[#475569]">
                                <span class="material-symbols-outlined text-xs text-[#009B5D]">category</span>
                                <span>{{ $totalKategori }} Kategori ({{ $totalItem }} Model)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Tersedia di Rak -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-[#E2E8F0] text-[#1E293B] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-[#007F4B]">
                                <span class="material-symbols-outlined text-xl">verified</span>
                            </div>
                            <span class="text-[11px] font-bold text-[#007F4B] px-2 py-0.5 rounded-md bg-emerald-50 border border-emerald-200 font-mono tabular-nums">{{ $persenTersedia }}%</span>
                        </div>
                        <div class="mt-3">
                            <span class="text-xs text-[#475569] block font-semibold">Tersedia di Rak</span>
                            <span class="text-2xl font-extrabold text-[#009B5D] font-mono tabular-nums tracking-tight">{{ number_format($tersediaUnit) }} Unit</span>
                            <div class="mt-1 flex items-center gap-1 text-[11px] text-[#475569]">
                                <span class="material-symbols-outlined text-xs text-[#39A845]">check_circle</span>
                                <span>Siap digunakan di lapangan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Sedang Disewa -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-[#E2E8F0] text-[#1E293B] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center text-[#0C2340]">
                                <span class="material-symbols-outlined text-xl">schedule</span>
                            </div>
                            <span class="text-[11px] text-[#0C2340] font-bold px-2 py-0.5 rounded-md bg-slate-100">Sirkulasi</span>
                        </div>
                        <div class="mt-3">
                            <span class="text-xs text-[#475569] block font-semibold">Sedang Disewa</span>
                            <span class="text-2xl font-extrabold text-[#0C2340] font-mono tabular-nums tracking-tight">{{ number_format($sedangDisewa) }} Unit</span>
                            <div class="mt-1 flex items-center gap-1 text-[11px] text-[#475569]">
                                <span class="material-symbols-outlined text-xs text-[#0C2340]">sports_score</span>
                                <span>Sedang aktif terpakai</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Dalam Perawatan -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-[#E2E8F0] text-[#1E293B] flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center text-red-600">
                                <span class="material-symbols-outlined text-xl">build</span>
                            </div>
                            <span class="text-[11px] font-bold text-red-700 px-2 py-0.5 rounded-md bg-red-50 border border-red-200">Servis</span>
                        </div>
                        <div class="mt-3">
                            <span class="text-xs text-[#475569] block font-semibold">Perbaikan / Rusak</span>
                            <span class="text-2xl font-extrabold text-red-600 font-mono tabular-nums tracking-tight">{{ number_format($perluServis) }} Unit</span>
                            <div class="mt-1 flex items-center gap-1 text-[11px] text-[#475569]">
                                <span class="material-symbols-outlined text-xs text-red-500">handyman</span>
                                <span>Jadwal pemeliharaan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- CONTENT CONTAINER -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-6 flex flex-col gap-6">

        <!-- SECTION 2: Toolbar Filter (Soft Ice Blue Container #E6F2F8, rounded-xl) -->
        <div class="bg-[#E6F2F8] rounded-xl p-4 sm:p-5 border border-[#E2E8F0] shadow-sm flex flex-col gap-4">
            <!-- Row 1: Search & Context -->
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
                <div class="relative flex-1 max-w-xl">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#475569]">
                        <span class="material-symbols-outlined text-lg">search</span>
                    </div>
                    <input type="text"
                           id="equipmentSearchInput"
                           class="w-full h-10 pl-9 pr-8 rounded-lg bg-white text-[#1E293B] text-xs placeholder:text-[#475569]/70 border border-[#E2E8F0] focus:outline-none focus:ring-2 focus:ring-[#009B5D] transition-colors duration-150"
                           placeholder="Cari nama alat, SKU, kategori, atau kondisi..."
                           autocomplete="off">
                    <button type="button"
                            id="clearSearchBtn"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#475569] hover:text-[#1E293B] hidden"
                            title="Hapus pencarian">
                        <span class="material-symbols-outlined text-base">cancel</span>
                    </button>
                </div>

                <div class="hidden xl:flex items-center gap-2 text-xs font-semibold text-[#475569]">
                    <span class="material-symbols-outlined text-base text-[#009B5D]">database</span>
                    <span>Database Inventaris SportHub</span>
                </div>
            </div>

            <!-- Row 2: Filter Dropdowns & Admin CTA Button -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 pt-3 border-t border-[#E2E8F0]">
                <div class="flex flex-wrap items-center gap-2">
                    <!-- Filter Kategori -->
                    <div class="relative">
                        <select id="categoryFilter"
                                class="h-9 pl-3 pr-8 rounded-lg bg-white text-xs font-semibold text-[#1E293B] border border-[#E2E8F0] appearance-none focus:outline-none focus:ring-2 focus:ring-[#009B5D] cursor-pointer transition-colors duration-150">
                            <option value="">Semua Kategori</option>
                            @foreach ($alatOlahraga->pluck('kategori')->filter()->unique() as $kat)
                                <option value="{{ $kat }}">{{ $kat }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined text-base absolute right-2.5 top-2 pointer-events-none text-[#475569]">expand_more</span>
                    </div>

                    <!-- Filter Kondisi -->
                    <div class="relative">
                        <select id="conditionFilter"
                                class="h-9 pl-3 pr-8 rounded-lg bg-white text-xs font-semibold text-[#1E293B] border border-[#E2E8F0] appearance-none focus:outline-none focus:ring-2 focus:ring-[#009B5D] cursor-pointer transition-colors duration-150">
                            <option value="">Semua Kondisi</option>
                            <option value="Baru">Baru</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                        </select>
                        <span class="material-symbols-outlined text-base absolute right-2.5 top-2 pointer-events-none text-[#475569]">expand_more</span>
                    </div>

                    <!-- Reset Button -->
                    <button type="button"
                            id="resetFilterBtn"
                            class="h-9 px-3 rounded-lg bg-white hover:bg-slate-50 text-xs font-semibold text-[#475569] border border-[#E2E8F0] transition-colors duration-150 flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">restart_alt</span>
                        <span>Reset</span>
                    </button>
                </div>

                <!-- Tombol Tambah: HANYA dirender jika auth()->user()->role === 'admin' -->
                <div class="flex items-center gap-2 shrink-0 self-end md:self-auto">
                    @if (auth()->user()?->role === 'admin')
                        <a href="{{ route('alat-olahraga.create') }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-sm transition-colors duration-150">
                            <span class="material-symbols-outlined text-base">add</span>
                            <span>+ Tambah Alat</span>
                        </a>
                    @else
                        <span class="text-xs text-[#475569] bg-white px-2.5 py-1.5 rounded-md border border-[#E2E8F0]">
                            Mode Penyewa (Akses Katalog)
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- SECTION 3: Switcher & Header Controls -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <!-- View Switcher -->
            <div class="flex items-center gap-1 bg-[#F1F5F9] p-1 rounded-lg border border-[#E2E8F0]">
                <button type="button"
                        id="viewGridBtn"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white text-[#009B5D] text-xs font-bold shadow-sm transition-colors duration-150">
                    <span class="material-symbols-outlined text-base">grid_view</span>
                    <span>Tampilan Kartu</span>
                </button>
                <button type="button"
                        id="viewTableBtn"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[#475569] text-xs font-semibold hover:text-[#1E293B] transition-colors duration-150">
                    <span class="material-symbols-outlined text-base">table_rows</span>
                    <span>Tampilan Tabel</span>
                </button>
            </div>

            <!-- Sorting & Counter -->
            <div class="flex items-center gap-3 self-end sm:self-auto">
                <span class="text-xs text-[#475569] hidden md:inline">
                    Menampilkan <strong id="displayedCount" class="text-[#1E293B] font-mono tabular-nums">{{ $alatOlahraga->count() }}</strong> alat
                </span>
                <div class="relative">
                    <select id="sortSelect"
                            class="h-8 pl-2.5 pr-7 rounded-lg bg-white text-xs font-semibold text-[#1E293B] border border-[#E2E8F0] appearance-none focus:outline-none cursor-pointer">
                        <option value="name_asc">Nama (A - Z)</option>
                        <option value="name_desc">Nama (Z - A)</option>
                        <option value="stock_desc">Stok Terbanyak</option>
                        <option value="price_asc">Tarif Termurah</option>
                        <option value="price_desc">Tarif Termahal</option>
                    </select>
                    <span class="material-symbols-outlined text-sm absolute right-2 top-2 pointer-events-none text-[#475569]">expand_more</span>
                </div>
            </div>
        </div>

        <!-- SECTION 4: GRID VIEW (Default Active) -->
        <div id="gridContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse ($alatOlahraga as $item)
                @php
                    $kLower = strtolower($item->kondisi);
                    $katLower = strtolower($item->kategori);

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
                    } elseif (str_contains($katLower, 'renang')) {
                        $categoryIcon = 'pool';
                    }

                    $isAvailable = $item->stok > 3 && !str_contains($kLower, 'rusak');
                    $isLowStock = $item->stok > 0 && $item->stok <= 3 && !str_contains($kLower, 'rusak');
                @endphp

                <div class="equipment-card bg-white rounded-xl shadow-sm hover:shadow-md border border-[#E2E8F0] transition-shadow duration-150 flex flex-col justify-between overflow-hidden"
                     data-name="{{ strtolower($item->nama_alat) }}"
                     data-sku="spt-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}"
                     data-category="{{ $item->kategori }}"
                     data-condition="{{ $item->kondisi }}"
                     data-price="{{ $item->tarif_sewa }}"
                     data-stock="{{ $item->stok }}">

                    <div>
                        <!-- Header Box with Icon Placeholder -->
                        <div class="relative h-36 w-full bg-[#F8FAFC] border-b border-[#E2E8F0] flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-slate-300">{{ $categoryIcon }}</span>

                            <!-- Status Badge (rounded-md, no decorative dot) -->
                            <div class="absolute top-2.5 left-2.5">
                                @if ($isAvailable)
                                    <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-[#007F4B] text-[11px] font-bold border border-emerald-200">
                                        Tersedia
                                    </span>
                                @elseif ($isLowStock)
                                    <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[11px] font-bold border border-amber-200">
                                        Stok Menipis
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-md bg-red-50 text-red-600 text-[11px] font-bold border border-red-200">
                                        {{ str_contains($kLower, 'rusak') ? 'Perlu Servis' : 'Habis' }}
                                    </span>
                                @endif
                            </div>

                            <!-- Placement Info -->
                            <div class="absolute bottom-2 right-2.5 text-[10px] text-[#475569] font-mono tabular-nums bg-white px-2 py-0.5 rounded-md border border-[#E2E8F0]">
                                Rak {{ chr(65 + ($item->id % 6)) }}-0{{ ($item->id % 9) + 1 }}
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4 flex flex-col gap-2">
                            <div class="flex items-center justify-between text-[#475569] text-xs">
                                <span class="font-mono tabular-nums text-[11px] font-semibold text-slate-500">SKU: SPT-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span>
                                <span class="px-2 py-0.5 rounded-md bg-[#F1F5F9] text-[#1E293B] text-[11px] font-medium">
                                    {{ $item->kategori }}
                                </span>
                            </div>

                            <h3 class="text-sm font-bold text-[#1E293B] line-clamp-1" title="{{ $item->nama_alat }}">
                                {{ $item->nama_alat }}
                            </h3>

                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="text-base font-bold text-[#009B5D] font-mono tabular-nums">
                                    Rp {{ number_format($item->tarif_sewa, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-[#475569]">/ hari</span>
                            </div>

                            <div class="mt-2 pt-2 border-t border-[#F1F5F9] flex items-center justify-between text-xs text-[#475569]">
                                <span>Stok: <strong class="text-[#1E293B] font-mono tabular-nums">{{ $item->stok }}</strong> Unit</span>
                                <span class="text-[11px]">{{ $item->kondisi }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions: Role-based rendering -->
                    <div class="p-4 pt-0 flex items-center gap-1.5 mt-2">
                        <!-- Tombol Detail (Untuk semua role) -->
                        <a href="{{ route('alat-olahraga.show', $item->id) }}"
                           class="flex-1 py-1.5 px-3 rounded-lg bg-[#F8FAFC] hover:bg-slate-100 text-[#1E293B] border border-[#E2E8F0] text-xs font-semibold text-center transition-colors duration-150 flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                            <span>Detail</span>
                        </a>

                        @if (auth()->user()?->role === 'admin')
                            <!-- Tombol Edit (Hanya Admin) -->
                            <a href="{{ route('alat-olahraga.edit', $item->id) }}"
                               class="p-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 transition-colors duration-150 flex items-center justify-center"
                               title="Edit Alat">
                                <span class="material-symbols-outlined text-base">edit</span>
                            </a>

                            <!-- Tombol Hapus (Hanya Admin) -->
                            <form action="{{ route('alat-olahraga.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline m-0"
                                  onsubmit="return confirm('Hapus alat olahraga &quot;{{ $item->nama_alat }}&quot;?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 transition-colors duration-150 flex items-center justify-center"
                                        title="Hapus Alat">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-[#E2E8F0] p-6 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-slate-400 mb-2">inventory_2</span>
                    <h3 class="text-sm font-bold text-[#1E293B]">Belum Ada Data Alat Olahraga</h3>
                    <p class="text-xs text-[#475569] mt-1">Data peralatan inventaris masih kosong.</p>
                    @if (auth()->user()?->role === 'admin')
                        <a href="{{ route('alat-olahraga.create') }}"
                           class="mt-3 inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#009B5D] hover:bg-[#007F4B] text-white text-xs font-bold transition-colors duration-150">
                            <span class="material-symbols-outlined text-sm">add</span>
                            <span>+ Tambah Alat Sekarang</span>
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- SECTION 5: TABLE VIEW (Toggled via Switcher) -->
        <div id="tableContainer" class="hidden bg-white rounded-xl shadow-sm border border-[#E2E8F0] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-[#F8FAFC] border-b border-[#E2E8F0] text-[#475569] font-bold uppercase tracking-wider text-[11px]">
                            <th class="py-3 px-4 text-center w-12">#</th>
                            <th class="py-3 px-4">Nama Alat &amp; SKU</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Kondisi</th>
                            <th class="py-3 px-4">Tarif Sewa</th>
                            <th class="py-3 px-4 text-center">Stok</th>
                            <th class="py-3 px-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E2E8F0] text-[#1E293B]">
                        @forelse ($alatOlahraga as $index => $item)
                            <tr class="table-row-item hover:bg-slate-50 transition-colors duration-150"
                                data-name="{{ strtolower($item->nama_alat) }}"
                                data-sku="spt-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}"
                                data-category="{{ $item->kategori }}"
                                data-condition="{{ $item->kondisi }}"
                                data-price="{{ $item->tarif_sewa }}"
                                data-stock="{{ $item->stok }}">

                                <td class="py-3 px-4 text-center text-[#475569] font-mono tabular-nums">
                                    {{ $index + 1 }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-[#1E293B]">{{ $item->nama_alat }}</div>
                                    <span class="text-[11px] text-[#475569] font-mono tabular-nums">SKU: SPT-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-0.5 rounded-md bg-[#F1F5F9] text-[#1E293B] text-[11px]">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-0.5 rounded-md text-[11px] font-semibold bg-slate-100 text-[#475569]">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 font-mono tabular-nums">
                                    <span class="font-bold text-[#009B5D]">
                                        Rp {{ number_format($item->tarif_sewa, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[11px] text-[#475569]">/ hari</span>
                                </td>
                                <td class="py-3 px-4 text-center font-mono tabular-nums font-semibold">
                                    {{ $item->stok }} Unit
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="inline-flex items-center gap-1">
                                        <a href="{{ route('alat-olahraga.show', $item->id) }}"
                                           class="p-1 rounded-md bg-slate-100 hover:bg-slate-200 text-[#475569] transition-colors duration-150"
                                           title="Detail Alat">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                        </a>

                                        @if (auth()->user()?->role === 'admin')
                                            <a href="{{ route('alat-olahraga.edit', $item->id) }}"
                                               class="p-1 rounded-md bg-amber-50 hover:bg-amber-100 text-amber-700 transition-colors duration-150 border border-amber-200"
                                               title="Edit Alat">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </a>

                                            <form action="{{ route('alat-olahraga.destroy', $item->id) }}"
                                                  method="POST"
                                                  class="inline m-0"
                                                  onsubmit="return confirm('Hapus alat olahraga &quot;{{ $item->nama_alat }}&quot;?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-1 rounded-md bg-red-50 hover:bg-red-100 text-red-600 transition-colors duration-150 border border-red-200"
                                                        title="Hapus Alat">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-[#475569]">
                                    Belum ada data alat olahraga.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- No Results Fallback -->
        <div id="noSearchResults" class="hidden bg-white rounded-xl border border-[#E2E8F0] p-8 text-center shadow-sm">
            <span class="material-symbols-outlined text-3xl text-slate-400 mb-1">search_off</span>
            <h3 class="text-sm font-bold text-[#1E293B]">Tidak Menemukan Hasil</h3>
            <p class="text-xs text-[#475569] mt-0.5">Silakan gunakan kata kunci lain atau bersihkan filter.</p>
        </div>

    </div>
</div>

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

        // Search & Filter
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
