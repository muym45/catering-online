<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananController;

Route::apiResource('pemesanans', PemesananController::class);
