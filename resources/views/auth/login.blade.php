@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white text-center py-4 border-0">
                <div class="mb-2">
                    <i class="bi bi-shield-lock-fill text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Masuk ke SportRent</h4>
                <p class="text-muted small mb-0">Silakan masukkan akun Anda untuk melanjutkan</p>
            </div>

            <div class="card-body p-4 pt-0">
                {{-- Proteksi XSS: Semua pesan error & old input dirender dengan kurung kurawal ganda Blade --}}
                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3" role="alert">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold small text-secondary">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-envelope text-muted"></i>
                            </span>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control border-start-0 @error('email') is-invalid @enderror"
                                   placeholder="nama@email.com"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">
                                <i class="bi bi-x-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold small text-secondary">Kata Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-key text-muted"></i>
                            </span>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control border-start-0 @error('password') is-invalid @enderror"
                                   placeholder="••••••••"
                                   required>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">
                                <i class="bi bi-x-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small text-muted" for="remember">
                                Ingat saya di perangkat ini
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </button>
                </form>
            </div>

            <div class="card-footer bg-light border-top text-center py-3">
                <small class="text-muted d-block">
                    <strong>Akun Demo Tersedia:</strong><br>
                    Admin: <code>admin@gmail.com</code> / <code>admin123</code><br>
                    User: <code>user@gmail.com</code> / <code>user123</code>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
