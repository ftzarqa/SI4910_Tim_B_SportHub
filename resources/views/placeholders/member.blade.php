@extends('layouts.app')

@section('title', 'Manajemen Pelanggan & Member - Modul Tim C')

@section('content')
<div class="flex flex-col gap-6">
    <!-- Hero Gradient Banner (SportHub Style) -->
    <div class="relative w-full overflow-hidden rounded-2xl bg-gradient-to-br from-[#65C14A] to-[#39A845] p-6 md:p-8 text-white shadow-md">
        <div class="absolute inset-0 pointer-events-none opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur text-white text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="material-symbols-outlined text-sm">badge</span>
                    <span>Modul Individu C • Membership &amp; Komunitas</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                    Manajemen Pelanggan &amp; Member
                </h1>
                <p class="text-white/90 text-sm mt-1 max-w-2xl">
                    Data keanggotaan venue, loyalitas pelanggan, kartu akses RFID, dan tingkatan member (Basic, Gold, VIP).
                </p>
            </div>
            <div class="flex items-center gap-3 bg-white/15 backdrop-blur-md px-4 py-3 rounded-xl self-start md:self-auto border border-white/20">
                <span class="material-symbols-outlined text-[#80fab2] text-2xl">info</span>
                <div class="flex flex-col">
                    <span class="text-[11px] text-white/80 uppercase font-semibold">Status Integrasi</span>
                    <span class="text-xs font-bold text-white">Menunggu Merge Branch C</span>
                </div>
            </div>
        </div>

        <!-- 4 Spec Stat Cards Preview (DESIGN.md) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
            <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B]">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-[#475569] font-semibold">Total Member</span>
                    <span class="p-2 rounded-lg bg-emerald-50 text-[#009B5D] material-symbols-outlined text-lg">groups</span>
                </div>
                <div class="text-2xl font-bold mt-2">1,842 Orang</div>
                <span class="text-xs text-[#475569] mt-1 block">Aktif Berlangganan</span>
            </div>

            <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B]">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-[#475569] font-semibold">Member VIP</span>
                    <span class="p-2 rounded-lg bg-purple-50 text-purple-600 material-symbols-outlined text-lg">workspace_premium</span>
                </div>
                <div class="text-2xl font-bold text-purple-600 mt-2">240 Orang</div>
                <span class="text-xs text-[#475569] mt-1 block">Akses All-Venue</span>
            </div>

            <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B]">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-[#475569] font-semibold">Member Gold</span>
                    <span class="p-2 rounded-lg bg-amber-50 text-amber-500 material-symbols-outlined text-lg">military_tech</span>
                </div>
                <div class="text-2xl font-bold text-amber-500 mt-2">685 Orang</div>
                <span class="text-xs text-[#475569] mt-1 block">Prioritas Booking</span>
            </div>

            <div class="bg-white rounded-xl p-4 shadow-sm text-[#1E293B]">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-[#475569] font-semibold">Member Basic</span>
                    <span class="p-2 rounded-lg bg-slate-100 text-[#475569] material-symbols-outlined text-lg">person</span>
                </div>
                <div class="text-2xl font-bold text-[#1E293B] mt-2">917 Orang</div>
                <span class="text-xs text-[#475569] mt-1 block">Reguler Pay-per-Use</span>
            </div>
        </div>
    </div>

    <!-- Informative Merge Placeholder Card -->
    <div class="bg-white rounded-2xl p-8 border border-[#E2E8F0] shadow-sm text-center flex flex-col items-center max-w-2xl mx-auto">
        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-[#009B5D] flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-3xl">merge_type</span>
        </div>
        <h2 class="text-xl font-bold text-[#1E293B] mb-2">Modul Pelanggan &amp; Member (Individu C)</h2>
        <p class="text-sm text-[#475569] leading-relaxed mb-6">
            Halaman ini merupakan placeholder arsitektur integrasi tim SportHub. Rute <code class="px-2 py-0.5 rounded bg-slate-100 text-[#0C2340] font-mono text-xs">/member</code> telah diamankan dengan middleware autentikasi dan siap digantikan oleh branch rekan <strong>Individu C</strong> saat proses merge tanpa risiko konflik.
        </p>
        <a href="{{ route('alat-olahraga.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-sm shadow-md transition-all">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
            <span>Kembali ke Modul Rental Alat Olahraga</span>
        </a>
    </div>
</div>
@endsection
