@extends('layouts.app')

@section('title', 'Edit Data Alat Olahraga — SportHub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb & Back Button -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2 text-xs text-[#475569]">
            <a href="{{ route('alat-olahraga.index') }}" class="hover:text-[#009B5D] transition-colors">Rental Alat Olahraga</a>
            <span>/</span>
            <span class="text-[#1E293B] font-semibold">Edit Data Alat</span>
        </div>
        <a href="{{ route('alat-olahraga.index') }}"
           class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white hover:bg-slate-50 text-[#475569] hover:text-[#1E293B] border border-[#E2E8F0] transition-colors text-xs font-semibold shadow-sm">
            <span class="material-symbols-outlined text-base">arrow_back</span>
            <span>Kembali ke Katalog</span>
        </a>
    </div>

    <!-- Form Card Container (SportHub White Surface #FFFFFF & Border #E2E8F0) -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#E2E8F0] overflow-hidden">
        <!-- Card Header -->
        <div class="p-6 sm:p-8 border-b border-[#E2E8F0] bg-slate-50/50 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 shadow-sm border border-amber-100">
                    <span class="material-symbols-outlined text-2xl">edit_note</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-[#1E293B]">Edit Data Alat Olahraga</h1>
                    <p class="text-xs text-[#475569] mt-0.5">
                        Memperbarui rincian item: <strong class="text-[#1E293B] font-bold">{{ $alatOlahraga->nama_alat }}</strong>
                    </p>
                </div>
            </div>
            <span class="hidden sm:inline-flex px-3 py-1 rounded-full bg-slate-100 text-[#475569] font-mono text-xs font-semibold">
                SKU: SPT-{{ str_pad($alatOlahraga->id, 3, '0', STR_PAD_LEFT) }}
            </span>
        </div>

        <!-- Form Body -->
        <div class="p-6 sm:p-8">
            <form action="{{ route('alat-olahraga.update', $alatOlahraga->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Alat -->
                <div>
                    <label for="nama_alat" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-2">
                        Nama Alat Olahraga <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <span class="material-symbols-outlined text-lg">sports_tennis</span>
                        </div>
                        <input type="text"
                               name="nama_alat"
                               id="nama_alat"
                               class="w-full h-11 pl-10 pr-4 rounded-xl bg-[#F8FAFC] border @error('nama_alat') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-all"
                               placeholder="Contoh: Raket Badminton Yonex Astrox 88D Pro"
                               value="{{ old('nama_alat', $alatOlahraga->nama_alat) }}"
                               required
                               autofocus>
                    </div>
                    @error('nama_alat')
                        <p class="text-xs text-red-600 mt-1.5 flex items-center gap-1 font-medium">
                            <span class="material-symbols-outlined text-sm">cancel</span>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-2">
                            Kategori Peralatan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-lg">category</span>
                            </div>
                            <input type="text"
                                   name="kategori"
                                   id="kategori"
                                   list="kategori-list"
                                   class="w-full h-11 pl-10 pr-4 rounded-xl bg-[#F8FAFC] border @error('kategori') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-all"
                                   placeholder="Pilih atau ketik kategori..."
                                   value="{{ old('kategori', $alatOlahraga->kategori) }}"
                                   required>
                            <datalist id="kategori-list">
                                <option value="Bulu Tangkis">
                                <option value="Sepak Bola & Futsal">
                                <option value="Bola Basket">
                                <option value="Tenis Lapangan / Meja">
                                <option value="Fitness & Gym">
                                <option value="Renang & Air">
                                <option value="Outdoor & Camping">
                                <option value="Lari & Atletik">
                            </datalist>
                        </div>
                        @error('kategori')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Kondisi -->
                    <div>
                        <label for="kondisi" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-2">
                            Kondisi Fisik Alat <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-lg">verified</span>
                            </div>
                            @php
                                $currentKondisi = old('kondisi', $alatOlahraga->kondisi);
                            @endphp
                            <select name="kondisi"
                                    id="kondisi"
                                    class="w-full h-11 pl-10 pr-8 rounded-xl bg-[#F8FAFC] border @error('kondisi') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] appearance-none focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-all cursor-pointer"
                                    required>
                                <option value="" disabled>-- Pilih Kondisi Alat --</option>
                                <option value="Baru" {{ $currentKondisi == 'Baru' ? 'selected' : '' }}>Baru (100% Gress)</option>
                                <option value="Sangat Baik" {{ $currentKondisi == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik (90% - 98%)</option>
                                <option value="Baik" {{ $currentKondisi == 'Baik' ? 'selected' : '' }}>Baik (Siap Pakai)</option>
                                <option value="Cukup" {{ $currentKondisi == 'Cukup' ? 'selected' : '' }}>Cukup (Standar Latihan)</option>
                                <option value="Perlu Perbaikan" {{ $currentKondisi == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan / Servis</option>
                            </select>
                            <span class="material-symbols-outlined text-base absolute right-3 top-3 pointer-events-none text-slate-400">expand_more</span>
                        </div>
                        @error('kondisi')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tarif Sewa -->
                    <div>
                        <label for="tarif_sewa" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-2">
                            Tarif Sewa (Per Hari) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 font-bold text-xs">
                                Rp
                            </div>
                            <input type="number"
                                   name="tarif_sewa"
                                   id="tarif_sewa"
                                   min="0"
                                   step="500"
                                   class="w-full h-11 pl-10 pr-14 rounded-xl bg-[#F8FAFC] border @error('tarif_sewa') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-all"
                                   placeholder="Contoh: 35000"
                                   value="{{ old('tarif_sewa', $alatOlahraga->tarif_sewa) }}"
                                   required>
                            <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-xs text-[#475569]">
                                / hari
                            </span>
                        </div>
                        @error('tarif_sewa')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Jumlah Stok -->
                    <div>
                        <label for="stok" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-2">
                            Jumlah Stok Unit <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-lg">inventory</span>
                            </div>
                            <input type="number"
                                   name="stok"
                                   id="stok"
                                   min="0"
                                   class="w-full h-11 pl-10 pr-14 rounded-xl bg-[#F8FAFC] border @error('stok') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-all"
                                   placeholder="Contoh: 15"
                                   value="{{ old('stok', $alatOlahraga->stok) }}"
                                   required>
                            <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-xs text-[#475569]">
                                Unit
                            </span>
                        </div>
                        @error('stok')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons: Emerald Green #009B5D -->
                <div class="pt-6 border-t border-[#E2E8F0] flex items-center justify-end gap-3">
                    <a href="{{ route('alat-olahraga.index') }}"
                       class="px-5 py-2.5 rounded-xl border border-[#E2E8F0] text-[#475569] hover:bg-slate-50 font-semibold text-xs transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">save</span>
                        <span>Perbarui Data Alat</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
