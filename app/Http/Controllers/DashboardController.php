<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function core() {
        return view('core.dashboard');
    }

    public function kasir() {
        return view('kasir.dashboard');
    }
}
