<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

Route::get('/', [JadwalController::class, 'index']);