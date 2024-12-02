<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function histori() {
        return view('core.laporan.histori');
    }
}
