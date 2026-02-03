<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DetailPemesananController;
use App\Http\Controllers\PengirimanController;

Route::get('/', function () {
    return view('welcome');
});

// === API-like web routes (tanpa view dulu) ===
Route::resource('pelanggans', PelangganController::class);

Route::resource('detail-pemesanans', DetailPemesananController::class);
Route::resource('pengirimans', PengirimanController::class);
