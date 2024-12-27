<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
     
        return view('dashboard',[
            
        ]);
    }
}
