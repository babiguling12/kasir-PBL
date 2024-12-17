<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $totalSales = Produk::getMonthlySales($currentMonth, $currentYear);

        return view('dashboard',['SalesData' => Produk::all(),'TotalSales'=>$totalSales]);
    }
}
