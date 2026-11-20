@extends('layouts.app')

@section('title', 'Edit Data Alat Olahraga | SportHub')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb & Back Link -->
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-2 text-xs text-[#475569]">
            <a href="{{ route('alat-olahraga.index') }}" class="hover:text-[#009B5D] transition-colors duration-150">Rental Alat Olahraga</a>
            <span>/</span>
            <span class="text-[#1E293B] font-semibold">Edit Data Alat</span>
        </div>
        <a href="{{ route('alat-olahraga.index') }}"
           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white hover:bg-slate-50 text-[#475569] hover:text-[#1E293B] border border-[#E2E8F0] text-xs font-semibold shadow-sm transition-colors duration-150">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Main Card Container (rounded-xl border border-[#E2E8F0] bg-white) -->
    <div class="bg-white rounded-xl shadow-sm border border-[#E2E8F0] overflow-hidden">
        <!-- Header -->
        <div class="p-5 sm:p-6 border-b border-[#E2E8F0] bg-[#F8FAFC] flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center shrink-0 border border-amber-200">
                    <span class="material-symbols-outlined text-xl">edit</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-[#1E293B]">Edit Data Alat Olahraga</h1>
                    <p class="text-xs text-[#475569] mt-0.5">
                        Memperbarui rincian item: <strong class="text-[#1E293B]">{{ $alatOlahraga->nama_alat }}</strong>
                    </p>
                </div>
            </div>
            <span class="px-2.5 py-1 rounded-md bg-[#F1F5F9] text-[#475569] font-mono tabular-nums text-xs font-semibold border border-[#E2E8F0]">
                SKU: SPT-{{ str_pad($alatOlahraga->id, 3, '0', STR_PAD_LEFT) }}
            </span>
        </div>

        <!-- Form Body -->
        <div class="p-5 sm:p-6">
            <form action="{{ route('alat-olahraga.update', $alatOlahraga->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama Alat -->
                <div>
                    <label for="nama_alat" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-1.5">
                        Nama Alat Olahraga <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="nama_alat"
                           id="nama_alat"
                           class="w-full h-10 px-3 rounded-lg bg-[#F8FAFC] border @error('nama_alat') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] transition-colors duration-150"
                           placeholder="Contoh: Raket Badminton Yonex Nanoray"
                           value="{{ old('nama_alat', $alatOlahraga->nama_alat) }}"
                           required
                           autofocus>
                    @error('nama_alat')
                        <p class="text-xs text-red-600 mt-1 flex items-center gap-1 font-medium">
                            <span class="material-symbols-outlined text-sm">cancel</span>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-1.5">
                            Kategori Peralatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="kategori"
                               id="kategori"
                               list="kategori-list"
                               class="w-full h-10 px-3 rounded-lg bg-[#F8FAFC] border @error('kategori') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] transition-colors duration-150"
                               placeholder="Pilih atau ketik kategori..."
                               value="{{ old('kategori', $alatOlahraga->kategori) }}"
                               required>
                        <datalist id="kategori-list">
                            <option value="Bulu Tangkis">
                            <option value="Sepak Bola & Futsal">
                            <option value="Bola Basket">
                            <option value="Tenis Lapangan">
                            <option value="Fitness & Gym">
                            <option value="Renang">
                        </datalist>
                        @error('kategori')
                            <p class="text-xs text-red-600 mt-1 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Kondisi -->
                    <div>
                        <label for="kondisi" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-1.5">
                            Kondisi Fisik Alat <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            @php
                                $currentKondisi = old('kondisi', $alatOlahraga->kondisi);
                            @endphp
                            <select name="kondisi"
                                    id="kondisi"
                                    class="w-full h-10 pl-3 pr-8 rounded-lg bg-[#F8FAFC] border @error('kondisi') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] appearance-none focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] cursor-pointer transition-colors duration-150"
                                    required>
                                <option value="" disabled>Pilih Kondisi Alat</option>
                                <option value="Baru" {{ $currentKondisi == 'Baru' ? 'selected' : '' }}>Baru</option>
                                <option value="Sangat Baik" {{ $currentKondisi == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                                <option value="Baik" {{ $currentKondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Cukup" {{ $currentKondisi == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                <option value="Perlu Perbaikan" {{ $currentKondisi == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                            </select>
                            <span class="material-symbols-outlined text-base absolute right-2.5 top-2.5 pointer-events-none text-slate-400">expand_more</span>
                        </div>
                        @error('kondisi')
                            <p class="text-xs text-red-600 mt-1 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tarif Sewa -->
                    <div>
                        <label for="tarif_sewa" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-1.5">
                            Tarif Sewa (Per Hari) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-xs text-slate-500 font-bold">
                                Rp
                            </span>
                            <input type="number"
                                   name="tarif_sewa"
                                   id="tarif_sewa"
                                   min="0"
                                   step="500"
                                   class="w-full h-10 pl-9 pr-14 rounded-lg bg-[#F8FAFC] border @error('tarif_sewa') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] font-mono tabular-nums placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] transition-colors duration-150"
                                   placeholder="25000"
                                   value="{{ old('tarif_sewa', $alatOlahraga->tarif_sewa) }}"
                                   required>
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-xs text-[#475569]">
                                / hari
                            </span>
                        </div>
                        @error('tarif_sewa')
                            <p class="text-xs text-red-600 mt-1 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Jumlah Stok -->
                    <div>
                        <label for="stok" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-1.5">
                            Jumlah Stok Unit <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number"
                                   name="stok"
                                   id="stok"
                                   min="0"
                                   class="w-full h-10 px-3 pr-14 rounded-lg bg-[#F8FAFC] border @error('stok') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] font-mono tabular-nums placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] transition-colors duration-150"
                                   placeholder="10"
                                   value="{{ old('stok', $alatOlahraga->stok) }}"
                                   required>
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-xs text-[#475569]">
                                Unit
                            </span>
                        </div>
                        @error('stok')
                            <p class="text-xs text-red-600 mt-1 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons: Emerald Green #009B5D -->
                <div class="pt-5 border-t border-[#E2E8F0] flex items-center justify-end gap-2.5">
                    <a href="{{ route('alat-olahraga.index') }}"
                       class="px-4 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-slate-50 font-semibold text-xs transition-colors duration-150">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-sm transition-colors duration-150 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base">save</span>
                        <span>Perbarui Data Alat</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
