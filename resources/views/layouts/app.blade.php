<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SportHub') | Sistem Manajemen Venue &amp; Rental Olahraga</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

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
                        "primary": "#009B5D",
                        "primary-hover": "#007F4B",
                        "deep-navy": "#0C2340",
                        "banner-start": "#65C14A",
                        "banner-end": "#39A845",
                        "ice-blue": "#E6F2F8",
                        "border-slate": "#E2E8F0",
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "md": "0.375rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
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
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] antialiased min-h-screen flex flex-col font-sans">

    <!-- 1. TOP UTILITY BAR (Deep Navy #0C2340) -->
    <header class="w-full">
        <div class="bg-[#0C2340] text-white py-1.5 px-4 sm:px-6 lg:px-8 border-b border-[#1c355e]">
            <div class="max-w-7xl mx-auto flex items-center justify-end text-xs gap-4 text-slate-300">
                <div class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-[#80fab2]">schedule</span>
                    <span>Jam Operasional: 06:00 - 23:00 WIB</span>
                </div>
                <div class="hidden sm:flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-[#80fab2]">call</span>
                    <span>+62 811-9876-5432</span>
                </div>
            </div>
        </div>

        <!-- 2. STICKY WHITE NAVBAR (#FFFFFF, border-b #E2E8F0) -->
        <div class="sticky top-0 z-40 bg-white border-b border-[#E2E8F0] shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center justify-between gap-4">
                    <!-- Clean Brand Logo pointing to url('/') -->
                    <a href="{{ url('/') }}" class="flex items-center shrink-0">
                        <span class="text-xl font-extrabold text-[#0C2340] tracking-tight hover:text-[#009B5D] transition-colors duration-150">SportHub</span>
                    </a>

                    <!-- Center: 4 Navigation Tabs (rounded-lg, NO rounded-full) -->
                    <nav class="hidden lg:flex items-center gap-1 bg-[#F1F5F9] p-1 rounded-lg border border-[#E2E8F0]">
                        <!-- 1. Lapangan & Area (Individu A) -->
                        <a href="{{ url('/lapangan') }}"
                           class="px-3.5 py-2 rounded-lg text-xs font-semibold transition-colors duration-150 {{ request()->is('lapangan*') ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#0C2340]' }}">
                            Lapangan &amp; Area
                        </a>

                        <!-- 2. Rental Alat Olahraga (Individu B) -->
                        @php
                            $isAlatActive = (request()->is('alat-olahraga*') || request()->is('/'))
                                && !request()->is('lapangan*')
                                && !request()->is('member*')
                                && !request()->is('instruktur*');
                        @endphp
                        <a href="{{ url('/alat-olahraga') }}"
                           class="px-3.5 py-2 rounded-lg text-xs font-semibold transition-colors duration-150 {{ $isAlatActive ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#0C2340]' }}">
                            Rental Alat Olahraga
                        </a>

                        <!-- 3. Pelanggan & Member (Individu C) -->
                        <a href="{{ url('/member') }}"
                           class="px-3.5 py-2 rounded-lg text-xs font-semibold transition-colors duration-150 {{ request()->is('member*') ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#0C2340]' }}">
                            Pelanggan &amp; Member
                        </a>

                        <!-- 4. Instruktur & Coach (Individu D) -->
                        <a href="{{ url('/instruktur') }}"
                           class="px-3.5 py-2 rounded-lg text-xs font-semibold transition-colors duration-150 {{ request()->is('instruktur*') ? 'bg-[#009B5D] text-white font-bold shadow-sm' : 'text-[#475569] hover:bg-white hover:text-[#0C2340]' }}">
                            Instruktur &amp; Coach
                        </a>
                    </nav>

                    <!-- Right Controls: Role Badge, User Info, & Logout Form -->
                    <div class="flex items-center gap-3 shrink-0">
                        @auth
                            <!-- Role Badge (rounded-md, no decorative dots) -->
                            @if (auth()->user()->role === 'admin' || auth()->user()->isAdmin())
                                <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-50 text-[#007F4B] text-xs font-bold border border-emerald-200">
                                    Admin Fasilitas
                                </span>
                            @else
                                <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-md bg-slate-100 text-[#475569] text-xs font-semibold border border-[#E2E8F0]">
                                    Member
                                </span>
                            @endif

                            <!-- User Avatar & Details -->
                            <div class="flex items-center gap-2 pl-1">
                                <div class="w-8 h-8 rounded-lg bg-[#0C2340] text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden xl:flex flex-col text-left">
                                    <span class="text-xs font-bold text-[#1E293B] leading-tight">{{ auth()->user()->name }}</span>
                                    <span class="text-[11px] text-[#475569]">{{ auth()->user()->role === 'admin' ? 'ATMINT' : 'Aku raja kau user' }}</span>
                                </div>
                            </div>

                            <!-- Logout Form (POST /logout dengan @csrf) -->
                            <form action="{{ route('logout') }}" method="POST" class="inline m-0">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white hover:bg-red-50 text-[#475569] hover:text-red-600 border border-[#E2E8F0] hover:border-red-200 transition-colors duration-150 text-xs font-semibold shadow-sm"
                                        title="Keluar dari sistem">
                                    <span class="material-symbols-outlined text-base">logout</span>
                                    <span class="hidden sm:inline">Keluar</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-sm transition-colors duration-150">
                                <span class="material-symbols-outlined text-base">login</span>
                                <span>Masuk</span>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile Responsive Navigation Strip (rounded-lg) -->
                <div class="lg:hidden pb-3 pt-1 border-t border-[#F1F5F9] flex items-center justify-between gap-1 overflow-x-auto text-xs">
                    <a href="{{ url('/lapangan') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap transition-colors duration-150 {{ request()->is('lapangan*') ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569] hover:bg-slate-100' }}">
                        Lapangan &amp; Area
                    </a>
                    <a href="{{ url('/alat-olahraga') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap transition-colors duration-150 {{ $isAlatActive ?? false ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569] hover:bg-slate-100' }}">
                        Rental Alat Olahraga
                    </a>
                    <a href="{{ url('/member') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap transition-colors duration-150 {{ request()->is('member*') ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569] hover:bg-slate-100' }}">
                        Pelanggan &amp; Member
                    </a>
                    <a href="{{ url('/instruktur') }}"
                       class="px-3 py-1.5 rounded-lg whitespace-nowrap transition-colors duration-150 {{ request()->is('instruktur*') ? 'bg-[#009B5D] text-white font-bold' : 'text-[#475569] hover:bg-slate-100' }}">
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
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="text-emerald-700 hover:text-emerald-900 transition-colors duration-150">
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
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="text-red-700 hover:text-red-900 transition-colors duration-150">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- 4. DEEP NAVY FOOTER (#0C2340) -->
    <footer class="w-full bg-[#0C2340] text-white mt-auto border-t border-[#1c355e]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Col 1: Brand Info -->
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#009B5D] flex items-center justify-center text-white shadow-sm">
                            <span class="material-symbols-outlined text-xl">stadium</span>
                        </div>
                        <span class="text-lg font-extrabold text-white tracking-tight">SportHub</span>
                    </div>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Platform manajemen fasilitas, persewaan lapangan, dan inventaris peralatan olahraga terintegrasi.
                    </p>
                </div>

                <!-- Col 2: Navigasi Modul Tim -->
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-1">Navigasi Modul Tim</span>
                    <a href="{{ url('/lapangan') }}" class="text-xs text-slate-300 hover:text-white transition-colors duration-150 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">stadium</span>
                        <span>Lapangan &amp; Area (Individu A)</span>
                    </a>
                    <a href="{{ url('/alat-olahraga') }}" class="text-xs text-[#80fab2] font-semibold hover:text-white transition-colors duration-150 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">sports_tennis</span>
                        <span>Rental Alat Olahraga (Individu B)</span>
                    </a>
                    <a href="{{ url('/member') }}" class="text-xs text-slate-300 hover:text-white transition-colors duration-150 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">badge</span>
                        <span>Pelanggan &amp; Member (Individu C)</span>
                    </a>
                    <a href="{{ url('/instruktur') }}" class="text-xs text-slate-300 hover:text-white transition-colors duration-150 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">sports</span>
                        <span>Instruktur &amp; Coach (Individu D)</span>
                    </a>
                </div>

                <!-- Col 3: Fasilitas Venue -->
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-1">Fasilitas Venue</span>
                    <span class="text-xs text-slate-300">Indoor Futsal (Vinyl &amp; Interlock)</span>
                    <span class="text-xs text-slate-300">Badminton Hall (6 Karpet BWF)</span>
                    <span class="text-xs text-slate-300">Lapangan Tenis (Outdoor Hardcourt)</span>
                    <span class="text-xs text-slate-300">Olympic Pool &amp; Water Center</span>
                </div>

                <!-- Col 4: Dukungan & Bantuan -->
                <div class="flex flex-col gap-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-200 mb-1">Dukungan Operasional</span>
                    <span class="text-xs text-slate-300">Hotline Resepsionis:</span>
                    <span class="text-sm font-bold text-[#80fab2] font-mono tabular-nums">+62 811-9876-5432</span>
                    <span class="text-xs text-slate-300 mt-1">Layanan Meja Bantuan 06:00 - 23:00 WIB</span>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-400 text-xs">
                <p>&copy; 2026 SportHub Venue Management System. Hak Cipta Dilindungi.</p>
                <span class="text-xs text-slate-400">Praktikum Modul 4 WAD 2026</span>
            </div>
        </div>
    </footer>

</body>
</html>
