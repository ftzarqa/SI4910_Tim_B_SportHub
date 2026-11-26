<?php

use App\Http\Controllers\AlatOlahragaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LapanganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route untuk User Terautentikasi (Semua Role: Admin & User)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Portal / Redirect Utama Bersama
    Route::get('/', function () {
        return redirect()->route('alat-olahraga.index');
    })->name('home');

    // === MODUL INDIVIDU B: RENTAL ALAT OLAHRAGA ===
    Route::get('/alat-olahraga', [AlatOlahragaController::class, 'index'])->name('alat-olahraga.index');

    // Route Khusus Admin: Aksi manipulasi data (create, store, edit, update, destroy)
    Route::middleware('role:admin')->group(function () {
        Route::get('/alat-olahraga/create', [AlatOlahragaController::class, 'create'])->name('alat-olahraga.create');
        Route::post('/alat-olahraga', [AlatOlahragaController::class, 'store'])->name('alat-olahraga.store');
        Route::get('/alat-olahraga/{id}/edit', [AlatOlahragaController::class, 'edit'])->name('alat-olahraga.edit');
        Route::put('/alat-olahraga/{id}', [AlatOlahragaController::class, 'update'])->name('alat-olahraga.update');
        Route::delete('/alat-olahraga/{id}', [AlatOlahragaController::class, 'destroy'])->name('alat-olahraga.destroy');
    });

    Route::get('/alat-olahraga/{id}', [AlatOlahragaController::class, 'show'])->name('alat-olahraga.show')->whereNumber('id');
    // === END MODUL INDIVIDU B: RENTAL ALAT OLAHRAGA ===

    // === ROUTE FALLBACK / PLACEHOLDER LINTAS MODUL (A, C, D) ===
    // === MODUL INDIVIDU A: CRUD LAPANGAN ===
    Route::get('/lapangan', [LapanganController::class, 'index'])->name('lapangan.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
        Route::post('/lapangan', [LapanganController::class, 'store'])->name('lapangan.store');
        Route::get('/lapangan/{id}/edit', [LapanganController::class, 'edit'])->name('lapangan.edit');
        Route::put('/lapangan/{id}', [LapanganController::class, 'update'])->name('lapangan.update');
        Route::delete('/lapangan/{id}', [LapanganController::class, 'destroy'])->name('lapangan.destroy');
    });
// === END MODUL INDIVIDU A ===
    Route::get('/member', function () {
        return view('placeholders.member');
    })->name('member.index');

    Route::get('/instruktur', function () {
        return view('placeholders.instruktur');
    })->name('instruktur.index');
});
