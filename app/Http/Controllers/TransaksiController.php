<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class TransaksiController extends Controller
{
    public function index()
    {
        Cart::instance('sale')->destroy();

        return view('kasir.transaksi');
    }
}
