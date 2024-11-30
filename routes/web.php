<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;


Route::get('/', function() {
    if(auth()->check()) {
        if(auth()->user()->role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        } else {
            return redirect()->route('core.dashboard');
        }
    }

    return view('auth.login');
})->name('home'); 


Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});


Route::middleware(['auth'])->group(function (){

    Route::get('dashboard/core', [DashboardController::class, 'core'])->name('core.dashboard')->middleware('checkRole');
    Route::get('dashboard/kasir', [DashboardController::class, 'kasir'])->name('kasir.dashboard')->middleware('checkRole');

    Route::get('logout', LogoutController::class)->name('logout');

});



