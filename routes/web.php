<?php

use App\Http\Controllers\AlatOlahragaController;
use App\Models\AlatOlahraga;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route utama mengarah langsung ke daftar alat olahraga
Route::get('/', [AlatOlahragaController::class, 'index']); //eror disini

// Resource route CRUD alat olahraga tanpa proteksi middleware
Route::resource('alat-olahraga', AlatOlahragaController::class);
