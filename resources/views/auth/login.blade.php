@extends('layouts.app')

@section('title', 'Masuk ke Sistem — SportHub')

@section('content')
<div class="w-full min-h-[calc(100vh-220px)] bg-[#E6F2F8] py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-md w-full">
        <!-- Main Login Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-[#E2E8F0] overflow-hidden">
            <!-- Card Header: Deep Navy (#0C2340) with SportHub Brand -->
            <div class="bg-[#0C2340] text-white p-7 text-center relative overflow-hidden">
                <!-- Subtle Athletic Pitch Pattern Overlay -->
                <div class="absolute inset-0 pointer-events-none opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#009B5D] to-[#65C14A] flex items-center justify-center text-white shadow-lg mb-3 ring-4 ring-white/10">
                        <span class="material-symbols-outlined text-3xl">stadium</span>
                    </div>
                    <h1 class="text-2xl font-extrabold text-white tracking-tight">SportHub</h1>
                    <p class="text-xs text-slate-300 font-medium mt-1 tracking-wide">
                        Sistem Manajemen Venue &amp; Lapangan Olahraga
                    </p>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 sm:p-8">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-bold text-[#1E293B]">Selamat Datang Kembali</h2>
                    <p class="text-xs text-[#475569] mt-1">
                        Silakan masukkan kredensial akun Anda untuk mengakses sistem
                    </p>
                </div>

                <!-- Global Error Alert -->
                @if ($errors->any())
                    <div class="mb-5 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold flex items-start gap-2.5 shadow-sm" role="alert">
                        <span class="material-symbols-outlined text-lg shrink-0 text-red-600">error</span>
                        <div class="flex-1">
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-1.5">
                            Alamat Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-lg">mail</span>
                            </div>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="w-full h-11 pl-10 pr-4 rounded-xl bg-[#F8FAFC] border @error('email') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-all"
                                   placeholder="nama@email.com"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus>
                        </div>
                        @error('email')
                            <p class="text-xs text-red-600 mt-1 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-[#1E293B] uppercase tracking-wider mb-1.5">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-lg">lock</span>
                            </div>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="w-full h-11 pl-10 pr-10 rounded-xl bg-[#F8FAFC] border @error('password') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-all"
                                   placeholder="••••••••"
                                   required>
                            <button type="button"
                                    onclick="togglePasswordVisibility()"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600"
                                    title="Tampilkan kata sandi">
                                <span class="material-symbols-outlined text-lg" id="passwordIcon">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-600 mt-1 flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox"
                                   name="remember"
                                   id="remember"
                                   class="w-4 h-4 rounded border-slate-300 text-[#009B5D] focus:ring-[#009B5D]">
                            <span class="text-xs text-[#475569] font-medium select-none">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <!-- Submit Button: Emerald Green (#009B5D) -->
                    <button type="submit"
                            class="w-full h-12 mt-2 rounded-xl bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-sm shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xl">login</span>
                        <span>Masuk ke Sistem</span>
                    </button>
                </form>

                <!-- Demo Accounts Information Card -->
                <div class="mt-6 pt-5 border-t border-[#E2E8F0]">
                    <div class="rounded-xl bg-[#E6F2F8]/70 border border-[#E2E8F0] p-4 text-xs text-[#1E293B]">
                        <div class="flex items-center gap-1.5 font-bold text-[#0C2340] mb-2">
                            <span class="material-symbols-outlined text-sm text-[#009B5D]">key</span>
                            <span>Informasi Akun Demo Siap Pakai:</span>
                        </div>
                        <div class="space-y-2 font-mono">
                            <div class="flex items-center justify-between p-2 rounded-lg bg-white border border-[#E2E8F0]">
                                <div>
                                    <div class="font-bold text-[#007F4B]">admin@gmail.com</div>
                                    <div class="text-[11px] text-[#475569]">Sandi: admin123 <span class="text-slate-400 font-sans">(Role: Admin Fasilitas)</span></div>
                                </div>
                                <button type="button"
                                        onclick="fillCredentials('admin@gmail.com', 'admin123')"
                                        class="px-2.5 py-1 rounded bg-emerald-100 hover:bg-emerald-200 text-[#007F4B] font-sans font-bold text-[11px] transition-colors">
                                    Pakai
                                </button>
                            </div>
                            <div class="flex items-center justify-between p-2 rounded-lg bg-white border border-[#E2E8F0]">
                                <div>
                                    <div class="font-bold text-[#0C2340]">user@gmail.com</div>
                                    <div class="text-[11px] text-[#475569]">Sandi: user123 <span class="text-slate-400 font-sans">(Role: Member / Penyewa)</span></div>
                                </div>
                                <button type="button"
                                        onclick="fillCredentials('user@gmail.com', 'user123')"
                                        class="px-2.5 py-1 rounded bg-slate-100 hover:bg-slate-200 text-[#475569] font-sans font-bold text-[11px] transition-colors">
                                    Pakai
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('password');
        const icon = document.getElementById('passwordIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }

    function fillCredentials(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
@endsection
