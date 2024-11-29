<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;


// jika route memiliki url yang sama, cukup menambahkan name pada salah satu route nya saja
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
