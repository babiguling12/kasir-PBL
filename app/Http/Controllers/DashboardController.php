<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;
        $currentDate = now()->toDateString();
        
        $lastYearSales = Transaksi::getYearlySales($lastYear);
        $thisYearSales = Transaksi::getYearlySales($currentYear);
        $transaksi = Transaksi::getTodaySales($currentDate)->first();
        $stokMasuk = StokMasuk::getTodayStokMasuk($currentDate)->first();

        return view('dashboard',[
            'SalesData' => Produk::all(),
            'thisYearSales'=>$thisYearSales, 
            'lastYearSales'=>$lastYearSales,
            'transaksi'=>$transaksi,
            'stokMasuk'=>$stokMasuk,
        ]);
    }
}
