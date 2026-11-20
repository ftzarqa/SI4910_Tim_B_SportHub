<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SportHub') — Sistem Manajemen Venue &amp; Rental Olahraga</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Material Symbols Outlined -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        // SportHub Design Tokens (DESIGN.md)
                        "primary": "#009B5D",
                        "primary-hover": "#007F4B",
                        "primary-container": "#009B5D",
                        "on-primary": "#ffffff",
                        "on-primary-container": "#ffffff",
                        "primary-fixed": "#80fab2",
                        "primary-fixed-dim": "#63dd98",
                        "on-primary-fixed": "#002110",
                        "on-primary-fixed-variant": "#00522f",

                        // Banner Gradient Tokens
                        "tertiary": "#39A845",
                        "tertiary-fixed": "#65C14A",
                        "tertiary-container": "#39A845",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-container": "#f8ffef",
                        "tertiary-fixed-dim": "#7fdc61",

                        // Deep Navy Tokens
                        "deep-navy": "#0C2340",
                        "on-secondary-fixed": "#0C2340",
                        "on-secondary-fixed-variant": "#1c355e",
                        "secondary-fixed": "#d5e3ff",
                        "secondary-fixed-dim": "#b3c7ec",
                        "secondary": "#4b5f7f",
                        "secondary-container": "#c3d8fe",
                        "on-secondary-container": "#4a5e7e",

                        // Surface & Backgrounds
                        "surface": "#FAF8FF",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f8fafc",
                        "surface-container": "#f1f5f9",
                        "surface-container-high": "#E6F2F8",
                        "surface-container-highest": "#dae2fd",
                        "ice-blue": "#E6F2F8",
                        "soft-ice-blue": "#E6F2F8",

                        // Text & Borders
                        "on-surface": "#1E293B",
                        "on-surface-variant": "#475569",
                        "outline": "#6d7a70",
                        "outline-variant": "#E2E8F0",
                        "border-color": "#E2E8F0",

                        // Feedback Statuses
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-error": "#ffffff",
                        "on-error-container": "#93000a",
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    spacing: {
                        "space-xs": "0.25rem",
                        "space-sm": "0.5rem",
                        "space-md": "1rem",
                        "space-lg": "1.5rem",
                        "space-xl": "2.5rem",
                        "gutter": "1.5rem",
                        "gutter-sm": "1rem",
                        "margin": "2rem",
                    }
                }
            }
        };
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            line-height: 1;
        }
        .material-symbols-fill {
            font-variation-settings: 'FILL' 1, 'wght' 500, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            line-height: 1;
        }
    </style>
</head>
<body class="bg-[#FAF8FF] text-[#1E293B] antialiased min-h-screen flex flex-col font-sans">

    <!-- 1. TOP UTILITY BAR (Deep Navy #0C2340) -->
    <header class="w-full">
        <div class="bg-[#0C2340] text-white py-1.5 px-4 sm:px-6 lg:px-8 border-b border-[#1c355e]">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between text-xs gap-1 sm:gap-4">
                <div class="flex items-center gap-2 font-medium text-slate-300">
                    <span class="w-2 h-2 rounded-full bg-[#65C14A] animate-pulse"></span>
                    <span>Sistem Manajemen Venue Olahraga Terpadu • Gelora Nusantara Sports Complex</span>
                </div>
                <div class="flex items-center gap-4 text-slate-300">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm text-[#80fab2]">schedule</span>
                        <span>Jam Operasional: 06:00 - 23:00 WIB</span>
                    </div>
                    <div class="hidden md:flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm text-[#80fab2]">call</span>
                        <span>Hotline: +62 811-9876-5432</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. STICKY WHITE NAVBAR (#FFFFFF, border-b #E2E8F0) -->
        <div class="sticky top-0 z-40 bg-white border-b border-[#E2E8F0] shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-20 flex items-center justify-between gap-4">
                    <!-- Brand Logo -->
                    <a href="{{ route('alat-olahraga.index') }}" class="flex items-center gap-3 shrink-0 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#009B5D] to-[#65C14A] flex items-center justify-center text-white shadow-sm group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-2xl">stadium</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-extrabold text-[#0C2340] leading-none tracking-tight">SportHub</span>
                            <span class="text-[11px] text-[#475569] font-medium tracking-wide">Venue &amp; Asset Management</span>
                        </div>
                    </a>

                    <!-- Center: 4 Pill Navigation Tabs (Team Integration Architecture) -->
                    <nav class="hidden lg:flex items-center gap-1 bg-[#F1F5F9] p-1.5 rounded-full border border-[#E2E8F0]">
                        <!-- 1. Lapangan & Area (Individu A) -->
                        <a href="{{ url('/lapangan') }}"
                           class="px-4 py-2 rounded-full text-xs transition-all duration-200 {{ request()->is('lapangan*') ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#1E293B] font-semibold' }}">
                            Lapangan &amp; Area
                        </a>

                        <!-- 2. Rental Alat Olahraga (Individu B - Aktif Hijau #009B5D) -->
                        @php
                            $isAlatActive = (request()->is('alat-olahraga*') || request()->is('/'))
                                && !request()->is('lapangan*')
                                && !request()->is('member*')
                                && !request()->is('instruktur*');
                        @endphp
                        <a href="{{ route('alat-olahraga.index') }}"
                           class="px-4 py-2 rounded-full text-xs transition-all duration-200 {{ $isAlatActive ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#1E293B] font-semibold' }}">
                            Rental Alat Olahraga
                        </a>

                        <!-- 3. Pelanggan & Member (Individu C) -->
                        <a href="{{ url('/member') }}"
                           class="px-4 py-2 rounded-full text-xs transition-all duration-200 {{ request()->is('member*') ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#1E293B] font-semibold' }}">
                            Pelanggan &amp; Member
                        </a>

                        <!-- 4. Instruktur & Coach (Individu D) -->
                        <a href="{{ url('/instruktur') }}"
                           class="px-4 py-2 rounded-full text-xs transition-all duration-200 {{ request()->is('instruktur*') ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#1E293B] font-semibold' }}">
                            Instruktur &amp; Coach
                        </a>
                    </nav>

                    <!-- Right Controls: Role Badge, User Info, & Logout Form -->
                    <div class="flex items-center gap-3 shrink-0">
                        @auth
                            <!-- Role Badge -->
                            @if (auth()->user()->isAdmin())
                                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-[#007F4B] text-xs font-bold tracking-wide">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#009B5D]"></span>
                                    Admin Fasilitas
                                </span>
                            @else
                                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-[#475569] text-xs font-bold tracking-wide">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Member / Penyewa
                                </span>
                            @endif

                            <!-- User Avatar & Details -->
                            <div class="flex items-center gap-2.5 pl-1">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#0C2340] to-[#1c355e] text-white flex items-center justify-center font-bold text-sm shadow-sm ring-2 ring-emerald-500/20">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden xl:flex flex-col text-left">
                                    <span class="text-xs font-bold text-[#1E293B] leading-tight">{{ auth()->user()->name }}</span>
                                    <span class="text-[11px] text-[#475569]">{{ auth()->user()->role === 'admin' ? 'Duty Manager' : 'Verified Member' }}</span>
                                </div>
                            </div>

                            <!-- Logout Form (POST /logout dengan @csrf) -->
                            <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#F8FAFC] hover:bg-red-50 text-[#475569] hover:text-red-600 border border-[#E2E8F0] hover:border-red-200 transition-all text-xs font-semibold shadow-sm"
                                        title="Keluar dari sistem">
                                    <span class="material-symbols-outlined text-base">logout</span>
                                    <span class="hidden sm:inline">Keluar</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-sm transition-all">
                                <span class="material-symbols-outlined text-base">login</span>
                                <span>Masuk</span>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile Responsive Navigation Pill Strip -->
                <div class="lg:hidden pb-3 pt-1 border-t border-[#F1F5F9] flex items-center justify-between gap-1 overflow-x-auto text-xs">
                    <a href="{{ url('/lapangan') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->is('lapangan*') ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569]' }}">
                        Lapangan &amp; Area
                    </a>
                    <a href="{{ route('alat-olahraga.index') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ $isAlatActive ?? false ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569]' }}">
                        Rental Alat Olahraga
                    </a>
                    <a href="{{ url('/member') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->is('member*') ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569]' }}">
                        Pelanggan &amp; Member
                    </a>
                    <a href="{{ url('/instruktur') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap {{ request()->is('instruktur*') ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569]' }}">
                        Instruktur &amp; Coach
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- 3. MAIN CONTENT CONTAINER -->
    <main class="w-full flex-1">
        <!-- Flash Message Notification -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-center justify-between gap-3 shadow-sm text-[#007F4B]" role="alert">
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-xl text-[#009B5D]">check_circle</span>
                        <div class="text-sm font-semibold">
                            <strong>Berhasil:</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="text-emerald-700 hover:text-emerald-900 transition-colors">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center justify-between gap-3 shadow-sm text-red-700" role="alert">
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-xl text-red-600">error</span>
                        <div class="text-sm font-semibold">
                            <strong>Terjadi Kesalahan:</strong> {{ session('error') }}
                        </div>
                    </div>
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="text-red-700 hover:text-red-900 transition-colors">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- 4. DEEP NAVY FOOTER (#0C2340) -->
    <footer class="w-full bg-[#0C2340] text-white mt-auto border-t border-[#1c355e]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <!-- Col 1: Brand Info -->
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#009B5D] to-[#65C14A] flex items-center justify-center text-white shadow-sm">
                            <span class="material-symbols-outlined text-2xl">stadium</span>
                        </div>
                        <span class="text-xl font-extrabold text-white tracking-tight">SportHub</span>
                    </div>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Platform manajemen fasilitas, persewaan lapangan, dan inventaris olahraga modern terintegrasi untuk kenyamanan komunitas dan member.
                    </p>
                    <div class="inline-flex items-center gap-2 text-[#80fab2] text-xs font-semibold">
                        <span class="material-symbols-outlined text-base">verified</span>
                        <span>Operasional Terstandarisasi BWF &amp; FIFA</span>
                    </div>
                </div>

                <!-- Col 2: Navigasi Modul Tim -->
                <div class="flex flex-col gap-2.5">
                    <span class="text-xs font-bold text-white uppercase tracking-wider mb-1 text-slate-200">Navigasi Modul Tim</span>
                    <a href="{{ url('/lapangan') }}" class="text-xs text-slate-300 hover:text-[#80fab2] transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">stadium</span>
                        <span>Lapangan &amp; Area (Individu A)</span>
                    </a>
                    <a href="{{ route('alat-olahraga.index') }}" class="text-xs text-slate-300 hover:text-[#80fab2] transition-colors flex items-center gap-1.5 font-semibold text-[#80fab2]">
                        <span class="material-symbols-outlined text-sm">sports_tennis</span>
                        <span>Rental Alat Olahraga (Individu B)</span>
                    </a>
                    <a href="{{ url('/member') }}" class="text-xs text-slate-300 hover:text-[#80fab2] transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">badge</span>
                        <span>Pelanggan &amp; Member (Individu C)</span>
                    </a>
                    <a href="{{ url('/instruktur') }}" class="text-xs text-slate-300 hover:text-[#80fab2] transition-colors flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">sports</span>
                        <span>Instruktur &amp; Coach (Individu D)</span>
                    </a>
                </div>

                <!-- Col 3: Fasilitas Venue -->
                <div class="flex flex-col gap-2.5">
                    <span class="text-xs font-bold text-white uppercase tracking-wider mb-1 text-slate-200">Fasilitas Venue</span>
                    <span class="text-xs text-slate-300">Indoor Futsal (Vinyl &amp; Interlock)</span>
                    <span class="text-xs text-slate-300">Badminton Hall (6 Karpet BWF)</span>
                    <span class="text-xs text-slate-300">Lapangan Tenis (Outdoor Hardcourt)</span>
                    <span class="text-xs text-slate-300">Olympic Pool &amp; Water Center</span>
                </div>

                <!-- Col 4: Dukungan & Bantuan -->
                <div class="flex flex-col gap-2.5">
                    <span class="text-xs font-bold text-white uppercase tracking-wider mb-1 text-slate-200">Dukungan &amp; Bantuan</span>
                    <a href="#" class="text-xs text-slate-300 hover:text-white transition-colors">Pusat Bantuan &amp; FAQ Venue</a>
                    <a href="#" class="text-xs text-slate-300 hover:text-white transition-colors">Integrasi Loker RFID Pintar</a>
                    <div class="mt-2 pt-2 border-t border-slate-700/60 flex flex-col gap-0.5">
                        <span class="text-[11px] text-slate-400">Hotline Operasional:</span>
                        <span class="text-sm font-bold text-[#80fab2]">+62 811-9876-5432</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-400 text-xs">
                <p>© 2026 SportHub Venue Management System. Hak Cipta Dilindungi.</p>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800/80 text-slate-300 text-[11px] font-semibold border border-slate-700">
                    <span class="material-symbols-outlined text-xs text-[#80fab2]">shield</span>
                    <span>Verified System • ISO 27001 Security Standard</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
