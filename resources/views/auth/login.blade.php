@extends('layouts.app')

@section('title', 'Masuk ke Sistem | SportHub')

@section('content')
<div class="w-full min-h-[calc(100vh-220px)] bg-[#E6F2F8] py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-md w-full">
        <!-- Main Login Card (rounded-xl border border-[#E2E8F0] bg-white shadow-sm) -->
        <div class="bg-white rounded-xl shadow-sm border border-[#E2E8F0] overflow-hidden">
            <!-- Card Header: Deep Navy (#0C2340) -->
            <div class="bg-[#0C2340] text-white p-6 text-center">
                <div class="w-12 h-12 rounded-lg bg-[#009B5D] flex items-center justify-center text-white mx-auto mb-3 shadow-sm">
                    <span class="material-symbols-outlined text-2xl">stadium</span>
                </div>
                <h1 class="text-xl font-extrabold text-white tracking-tight">SportHub</h1>
                <p class="text-xs text-slate-300 mt-1">
                    Sistem Manajemen Venue &amp; Rental Olahraga
                </p>
            </div>

            <!-- Card Body -->
            <div class="p-6 sm:p-8">
                <div class="mb-5 text-center">
                    <h2 class="text-lg font-bold text-[#1E293B]">Masuk ke Sistem</h2>
                    <p class="text-xs text-[#475569] mt-0.5">
                        Masukkan kredensial akun Anda untuk mengakses fasilitas
                    </p>
                </div>

                <!-- Global Error Alert -->
                @if ($errors->any())
                    <div class="mb-5 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-xs font-semibold flex items-start gap-2 shadow-sm" role="alert">
                        <span class="material-symbols-outlined text-base shrink-0 text-red-600">error</span>
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
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-base">mail</span>
                            </div>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="w-full h-10 pl-9 pr-3 rounded-lg bg-[#F8FAFC] border @error('email') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-colors duration-150"
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
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <span class="material-symbols-outlined text-base">lock</span>
                            </div>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="w-full h-10 pl-9 pr-10 rounded-lg bg-[#F8FAFC] border @error('password') border-red-400 ring-1 ring-red-400 @else border-[#E2E8F0] @enderror text-sm text-[#1E293B] placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#009B5D] focus:border-transparent transition-colors duration-150"
                                   placeholder="••••••••"
                                   required>
                            <button type="button"
                                    onclick="togglePasswordVisibility()"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors duration-150"
                                    title="Tampilkan kata sandi">
                                <span class="material-symbols-outlined text-base" id="passwordIcon">visibility</span>
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

                    <!-- Submit Button: Emerald Green (#009B5D, hover #007F4B) -->
                    <button type="submit"
                            class="w-full h-11 mt-2 rounded-lg bg-[#009B5D] hover:bg-[#007F4B] text-white font-bold text-xs shadow-sm transition-colors duration-150 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">login</span>
                        <span>Masuk ke Sistem</span>
                    </button>
                </form>

                <!-- Demo Accounts Information Card -->
                <div class="mt-6 pt-5 border-t border-[#E2E8F0]">
                    <div class="rounded-lg bg-[#E6F2F8] border border-[#E2E8F0] p-3.5 text-xs text-[#1E293B]">
                        <div class="flex items-center gap-1.5 font-bold text-[#0C2340] mb-2">
                            <span class="material-symbols-outlined text-base text-[#009B5D]">key</span>
                            <span>Akun Demo Siap Pakai:</span>
                        </div>
                        <div class="space-y-2 font-mono">
                            <div class="flex items-center justify-between p-2 rounded-lg bg-white border border-[#E2E8F0]">
                                <div>
                                    <div class="font-bold text-[#007F4B]">admin@gmail.com</div>
                                    <div class="text-[11px] text-[#475569]">Sandi: admin123 <span class="text-slate-500 font-sans">(Admin)</span></div>
                                </div>
                                <button type="button"
                                        onclick="fillCredentials('admin@gmail.com', 'admin123')"
                                        class="px-2.5 py-1 rounded-md bg-emerald-50 hover:bg-emerald-100 text-[#007F4B] font-sans font-bold text-[11px] border border-emerald-200 transition-colors duration-150">
                                    Pakai
                                </button>
                            </div>
                            <div class="flex items-center justify-between p-2 rounded-lg bg-white border border-[#E2E8F0]">
                                <div>
                                    <div class="font-bold text-[#0C2340]">user@gmail.com</div>
                                    <div class="text-[11px] text-[#475569]">Sandi: user123 <span class="text-slate-500 font-sans">(User)</span></div>
                                </div>
                                <button type="button"
                                        onclick="fillCredentials('user@gmail.com', 'user123')"
                                        class="px-2.5 py-1 rounded-md bg-slate-100 hover:bg-slate-200 text-[#475569] font-sans font-bold text-[11px] border border-[#E2E8F0] transition-colors duration-150">
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
