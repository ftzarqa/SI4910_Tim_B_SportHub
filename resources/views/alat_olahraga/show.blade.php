@extends('layouts.app')

@section('title', 'Detail Alat Olahraga | ' . $alatOlahraga->nama_alat)

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb & Back Link -->
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-2 text-xs text-[#475569]">
            <a href="{{ route('alat-olahraga.index') }}" class="hover:text-[#009B5D] transition-colors duration-150">Rental Alat Olahraga</a>
            <span>/</span>
            <span class="text-[#1E293B] font-semibold">Detail Peralatan</span>
        </div>
        <a href="{{ route('alat-olahraga.index') }}"
           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white hover:bg-slate-50 text-[#475569] hover:text-[#1E293B] border border-[#E2E8F0] text-xs font-semibold shadow-sm transition-colors duration-150">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>Kembali ke Katalog</span>
        </a>
    </div>

    <!-- Main Detail Card (rounded-xl border border-[#E2E8F0] bg-white) -->
    <div class="bg-white rounded-xl shadow-sm border border-[#E2E8F0] overflow-hidden">
        @php
            $showImgUrl = null;
            if ($alatOlahraga->gambar) {
                $showImgUrl = str_starts_with($alatOlahraga->gambar, 'images/') 
                    ? asset($alatOlahraga->gambar) 
                    : asset('storage/' . $alatOlahraga->gambar);
            }

            $kLower = strtolower($alatOlahraga->kondisi);
            $isAvailable = $alatOlahraga->stok > 3 && !str_contains($kLower, 'rusak');
            $isLowStock = $alatOlahraga->stok > 0 && $alatOlahraga->stok <= 3 && !str_contains($kLower, 'rusak');
        @endphp

        <!-- Detail Header Banner (#0C2340 Deep Navy) -->
        <div class="bg-[#0C2340] p-5 sm:p-6 text-white">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    @if ($showImgUrl)
                        <img src="{{ $showImgUrl }}"
                             alt="{{ $alatOlahraga->nama_alat }}"
                             class="w-14 h-14 rounded-lg object-cover border border-white/20 shadow-sm shrink-0 bg-white/10">
                    @else
                        <div class="w-12 h-12 rounded-lg bg-white/10 border border-white/20 text-white flex items-center justify-center shrink-0">
                            <span class="font-mono tabular-nums text-xs font-bold text-slate-300">SPT-{{ str_pad($alatOlahraga->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center gap-2 text-xs text-emerald-300 font-semibold mb-0.5">
                            <span class="font-mono tabular-nums">SKU: SPT-{{ str_pad($alatOlahraga->id, 3, '0', STR_PAD_LEFT) }}</span>
                            <span>•</span>
                            <span>{{ $alatOlahraga->kategori }}</span>
                        </div>
                        <h1 class="text-lg sm:text-xl font-extrabold text-white tracking-tight">
                            {{ $alatOlahraga->nama_alat }}
                        </h1>
                    </div>
                </div>

                <!-- Status Badge (rounded-md) -->
                <div>
                    @if ($isAvailable)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-500/20 text-[#80fab2] text-xs font-bold border border-emerald-500/30">
                            Unit Tersedia
                        </span>
                    @elseif ($isLowStock)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-amber-500/20 text-amber-300 text-xs font-bold border border-amber-500/30">
                            Stok Menipis
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-red-500/20 text-red-300 text-xs font-bold border border-red-500/30">
                            {{ str_contains($kLower, 'rusak') ? 'Perlu Servis' : 'Stok Habis' }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        @if ($showImgUrl)
            <!-- Dedicated Product Photo Display -->
            <div class="w-full bg-[#F8FAFC] border-b border-[#E2E8F0] p-6 flex items-center justify-center">
                <img src="{{ $showImgUrl }}"
                     alt="{{ $alatOlahraga->nama_alat }}"
                     class="max-h-64 max-w-md w-full object-contain rounded-lg">
            </div>
        @endif

        <!-- Specifications & Metrics Grid -->
        <div class="p-5 sm:p-6 space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <!-- Stat 1: Tarif Sewa -->
                <div class="p-3.5 rounded-lg bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="text-xs text-[#475569] font-semibold mb-1">Tarif Sewa</div>
                    <div class="text-lg font-bold text-[#009B5D] font-mono tabular-nums">
                        Rp {{ number_format($alatOlahraga->tarif_sewa, 0, ',', '.') }}
                    </div>
                    <span class="text-[11px] text-[#475569]">Per hari pemakaian</span>
                </div>

                <!-- Stat 2: Stok Inventaris -->
                <div class="p-3.5 rounded-lg bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="text-xs text-[#475569] font-semibold mb-1">Stok Inventaris</div>
                    <div class="text-lg font-bold text-[#1E293B] font-mono tabular-nums">
                        {{ $alatOlahraga->stok }} Unit
                    </div>
                    <span class="text-[11px] text-[#475569]">Fisik tersedia di rak</span>
                </div>

                <!-- Stat 3: Kondisi Alat -->
                <div class="p-3.5 rounded-lg bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="text-xs text-[#475569] font-semibold mb-1">Kondisi Fisik</div>
                    <div class="text-base font-bold text-[#1E293B]">
                        {{ $alatOlahraga->kondisi }}
                    </div>
                    <span class="text-[11px] text-[#475569]">Hasil inspeksi rutin</span>
                </div>

                <!-- Stat 4: Lokasi Loker -->
                <div class="p-3.5 rounded-lg bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="text-xs text-[#475569] font-semibold mb-1">Lokasi Loker</div>
                    <div class="text-base font-bold text-[#1E293B] font-mono tabular-nums">
                        Rak {{ chr(65 + ($alatOlahraga->id % 6)) }}-0{{ ($alatOlahraga->id % 9) + 1 }}
                    </div>
                    <span class="text-[11px] text-[#475569]">Akses sensor loker</span>
                </div>
            </div>

            <!-- Operational Procedure Box -->
            <div class="rounded-lg bg-[#E6F2F8] border border-[#E2E8F0] p-4 text-xs text-[#1E293B]">
                <h3 class="font-bold text-[#0C2340] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base text-[#009B5D]">info</span>
                    <span>Ketentuan Peminjaman Peralatan</span>
                </h3>
                <ul class="text-xs text-[#475569] space-y-1.5 list-disc list-inside">
                    <li>Penyewa mengambil unit di loker venue dengan menunjukkan bukti transaksi sewa.</li>
                    <li>Peralatan wajib diperiksa kondisinya saat serah terima awal dan akhir.</li>
                    <li>Kerusakan akibat kelalaian pemakaian menjadi tanggung jawab penyewa.</li>
                    <li>Pembaruan status terakhir: <strong class="text-[#1E293B] font-mono tabular-nums">{{ $alatOlahraga->updated_at ? $alatOlahraga->updated_at->format('d/m/Y H:i') : '-' }} WIB</strong>.</li>
                </ul>
            </div>

            <!-- Footer Action Controls -->
            <div class="pt-4 border-t border-[#E2E8F0] flex flex-col sm:flex-row items-center justify-between gap-3">
                <a href="{{ route('alat-olahraga.index') }}"
                   class="inline-flex items-center gap-1 px-3.5 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-slate-50 font-semibold text-xs transition-colors duration-150 w-full sm:w-auto justify-center">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    <span>Kembali ke Katalog</span>
                </a>

                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    @if (auth()->user()?->role === 'admin')
                        <!-- Edit Button (Admin) -->
                        <a href="{{ route('alat-olahraga.edit', $alatOlahraga->id) }}"
                           class="inline-flex items-center gap-1 px-3.5 py-2 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold text-xs transition-colors duration-150 border border-amber-200">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            <span>Edit Alat</span>
                        </a>

                        <!-- Delete Button (Admin) -->
                        <form action="{{ route('alat-olahraga.destroy', $alatOlahraga->id) }}"
                              method="POST"
                              class="inline m-0"
                              onsubmit="return confirm('Hapus alat olahraga &quot;{{ $alatOlahraga->nama_alat }}&quot;?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 px-3.5 py-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs transition-colors duration-150 border border-red-200">
                                <span class="material-symbols-outlined text-sm">delete</span>
                                <span>Hapus</span>
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('alat-olahraga.index') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-sm transition-colors duration-150">
                        <span class="material-symbols-outlined text-sm">check</span>
                        <span>Selesai</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
