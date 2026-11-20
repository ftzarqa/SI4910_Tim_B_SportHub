@extends('layouts.app')

@section('title', 'Detail Alat Olahraga — ' . $alatOlahraga->nama_alat)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb & Back Button -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2 text-xs text-[#475569]">
            <a href="{{ route('alat-olahraga.index') }}" class="hover:text-[#009B5D] transition-colors">Rental Alat Olahraga</a>
            <span>/</span>
            <span class="text-[#1E293B] font-semibold">Detail Peralatan</span>
        </div>
        <a href="{{ route('alat-olahraga.index') }}"
           class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white hover:bg-slate-50 text-[#475569] hover:text-[#1E293B] border border-[#E2E8F0] transition-colors text-xs font-semibold shadow-sm">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            <span>Kembali ke Katalog</span>
        </a>
    </div>

    <!-- Main Detail Card (SportHub White Surface #FFFFFF & Border #E2E8F0) -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#E2E8F0] overflow-hidden">
        <!-- Detail Visual Banner -->
        <div class="relative bg-gradient-to-r from-[#0C2340] to-[#1c355e] p-6 sm:p-8 text-white overflow-hidden">
            <div class="absolute inset-0 pointer-events-none opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[#009B5D] to-[#65C14A] flex items-center justify-center text-white shadow-lg ring-4 ring-white/10 shrink-0">
                        <span class="material-symbols-outlined text-3xl">sports_tennis</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 text-xs text-emerald-300 font-semibold mb-1">
                            <span class="font-mono">SKU: SPT-{{ str_pad($alatOlahraga->id, 3, '0', STR_PAD_LEFT) }}</span>
                            <span>•</span>
                            <span>{{ $alatOlahraga->kategori }}</span>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                            {{ $alatOlahraga->nama_alat }}
                        </h1>
                    </div>
                </div>

                <!-- Status Badge -->
                @php
                    $kLower = strtolower($alatOlahraga->kondisi);
                    $isAvailable = $alatOlahraga->stok > 3 && !str_contains($kLower, 'rusak');
                    $isLowStock = $alatOlahraga->stok > 0 && $alatOlahraga->stok <= 3 && !str_contains($kLower, 'rusak');
                @endphp
                <div>
                    @if ($isAvailable)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#009B5D] text-white text-xs font-bold shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-[#80fab2]"></span>
                            <span>Unit Tersedia</span>
                        </span>
                    @elseif ($isLowStock)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500 text-white text-xs font-bold shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-white"></span>
                            <span>Stok Terbatas</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600 text-white text-xs font-bold shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-white"></span>
                            <span>{{ str_contains($kLower, 'rusak') ? 'Dalam Perawatan' : 'Stok Habis' }}</span>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Specifications & Metrics Grid -->
        <div class="p-6 sm:p-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Stat 1: Tarif Sewa -->
                <div class="p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="flex items-center justify-between text-xs text-[#475569] mb-1">
                        <span class="font-semibold">Tarif Sewa</span>
                        <span class="material-symbols-outlined text-base text-[#009B5D]">payments</span>
                    </div>
                    <div class="text-xl font-bold text-[#009B5D]">
                        Rp {{ number_format($alatOlahraga->tarif_sewa, 0, ',', '.') }}
                    </div>
                    <span class="text-[11px] text-[#475569]">Tarif pemakaian per hari</span>
                </div>

                <!-- Stat 2: Stok Tersedia -->
                <div class="p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="flex items-center justify-between text-xs text-[#475569] mb-1">
                        <span class="font-semibold">Stok Inventaris</span>
                        <span class="material-symbols-outlined text-base text-blue-600">inventory_2</span>
                    </div>
                    <div class="text-xl font-bold text-[#1E293B]">
                        {{ $alatOlahraga->stok }} Unit
                    </div>
                    <span class="text-[11px] text-[#475569]">Tersimpan di loker venue</span>
                </div>

                <!-- Stat 3: Kondisi Fisik -->
                <div class="p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="flex items-center justify-between text-xs text-[#475569] mb-1">
                        <span class="font-semibold">Kondisi Alat</span>
                        <span class="material-symbols-outlined text-base text-[#39A845]">verified</span>
                    </div>
                    <div class="text-lg font-bold text-[#1E293B]">
                        {{ $alatOlahraga->kondisi }}
                    </div>
                    <span class="text-[11px] text-[#475569]">Standar kelaikan BWF/FIFA</span>
                </div>

                <!-- Stat 4: Loker Penyimpanan -->
                <div class="p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                    <div class="flex items-center justify-between text-xs text-[#475569] mb-1">
                        <span class="font-semibold">Lokasi Loker</span>
                        <span class="material-symbols-outlined text-base text-purple-600">lock</span>
                    </div>
                    <div class="text-lg font-bold text-[#1E293B]">
                        Rak {{ chr(65 + ($alatOlahraga->id % 6)) }}-0{{ ($alatOlahraga->id % 9) + 1 }}
                    </div>
                    <span class="text-[11px] text-[#475569]">Akses sensor RFID</span>
                </div>
            </div>

            <!-- Detailed Information Box -->
            <div class="rounded-xl bg-[#E6F2F8]/70 border border-[#E2E8F0] p-5">
                <h3 class="text-xs font-bold text-[#0C2340] uppercase tracking-wider mb-3 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base text-[#009B5D]">info</span>
                    <span>Prosedur Pengambilan &amp; Pengembalian Unit</span>
                </h3>
                <ul class="text-xs text-[#475569] space-y-2 list-disc list-inside">
                    <li>Penyewa wajib menunjukkan kartu member atau bukti transaksi digital di meja resepsionis peralatan.</li>
                    <li>Peralatan olahraga diinspeksi bersama petugas venue sebelum dan setelah sesi permainan selesai.</li>
                    <li>Kerusakan atau kehilangan unit dikenakan biaya pemulihan sesuai ketentuan operasional SportHub.</li>
                    <li>Data terakhir diperbarui pada: <strong class="text-[#1E293B]">{{ $alatOlahraga->updated_at ? $alatOlahraga->updated_at->format('d M Y, H:i') : '-' }} WIB</strong>.</li>
                </ul>
            </div>

            <!-- Footer Action Controls -->
            <div class="pt-4 border-t border-[#E2E8F0] flex flex-col sm:flex-row items-center justify-between gap-3">
                <a href="{{ route('alat-olahraga.index') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl border border-[#E2E8F0] text-[#475569] hover:bg-slate-50 font-semibold text-xs transition-colors w-full sm:w-auto justify-center">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    <span>Kembali ke Daftar</span>
                </a>

                <div class="flex items-center gap-2.5 w-full sm:w-auto justify-end">
                    @if (auth()->user()?->role === 'admin' || auth()->user()?->isAdmin())
                        <!-- Edit Button (Admin) -->
                        <a href="{{ route('alat-olahraga.edit', $alatOlahraga->id) }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold text-xs transition-colors border border-amber-200">
                            <span class="material-symbols-outlined text-base">edit</span>
                            <span>Edit Data</span>
                        </a>

                        <!-- Delete Button (Admin) -->
                        <form action="{{ route('alat-olahraga.destroy', $alatOlahraga->id) }}"
                              method="POST"
                              class="inline m-0"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat olahraga &quot;{{ $alatOlahraga->nama_alat }}&quot;?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs transition-colors border border-red-200">
                                <span class="material-symbols-outlined text-base">delete</span>
                                <span>Hapus Data</span>
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('alat-olahraga.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-md transition-all">
                        <span class="material-symbols-outlined text-base">shopping_bag</span>
                        <span>{{ auth()->user()?->isAdmin() ? 'Selesai Melihat' : 'Ajukan Sewa Alat' }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
