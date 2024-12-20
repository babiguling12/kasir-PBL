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
        
        $lastYearSales = Transaksi::getDataSales('YEAR',$lastYear);
        $thisYearSales = Transaksi::getDataSales('YEAR',$currentYear);
        $transaksi = Transaksi::getDataSales('DATE',$currentDate)->first() ?? (object) ['total_revenue' => 0, 'total_transaksi' => 0];
        $stokMasuk = StokMasuk::getStokMasuk($currentDate)->first() ?? (object) ['total_stokmasuk' => 0];

        return view('dashboard',[
            'SalesData' => Produk::all(),
            'thisYearSales'=>$thisYearSales, 
            'lastYearSales'=>$lastYearSales,
            'transaksi'=>$transaksi,
            'stokMasuk'=>$stokMasuk,
        ]);
    }
}
