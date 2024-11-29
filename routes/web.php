<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;


Route::middleware(['guest'])->group(function () {
    
    Route::get('/', fn() => view('auth.login'));

    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});


Route::middleware(['auth'])->group(function (){

    Route::get('logout', LogoutController::class)->name('logout');

    Route::get('dashboard', DashboardController::class)->name('dashboard');
});



