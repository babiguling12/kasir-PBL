<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\LoginController;


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

    // dashboard
    Route::get('dashboard/core', [DashboardController::class, 'core'])->name('core.dashboard')->middleware('checkRole');
    Route::get('dashboard/kasir', [DashboardController::class, 'kasir'])->name('kasir.dashboard')->middleware('checkRole');

    // pengguna
    Route::get('pengguna', [PenggunaController::class, 'index'])->name('page.pengguna')->middleware('isKasir');
    
    // supplier
    Route::get('supplier', [SupplierController::class, 'index'])->name('page.supplier')->middleware('isKasir');

    // produk
    Route::get('produk', [ProdukController::class, 'index'])->name('page.produk')->middleware('isKasir');

    // satuan
    Route::get('satuan', [SatuanController::class, 'index'])->name('page.satuan')->middleware('isKasir');

    // kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('page.kategori')->middleware('isKasir');

    // stok masuk
    Route::get('stok-masuk', [StokMasukController::class, 'index'])->name('page.stokmasuk')->middleware('isKasir');

    // stok keluar
    Route::get('stok-keluar', [StokKeluarController::class, 'index'])->name('page.stokkeluar')->middleware('isKasir');

    // histori
    Route::get('histori', [LaporanController::class, 'histori'])->name('page.histori');

    Route::get('logout', LogoutController::class)->name('logout');

});



