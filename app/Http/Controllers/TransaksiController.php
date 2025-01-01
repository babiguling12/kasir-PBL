<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\TransaksiDetail;

class TransaksiController extends Controller
{
    public function index()
    {
        Cart::instance('sale')->destroy();

        return view('kasir.transaksi');
    }

    public function struk($id) {
        $transaction = Transaksi::find($id);
        $histori_detail = TransaksiDetail::where('transaksi_id', $id)->latest()->get();
        

        if (!$transaction) {
            return redirect()->route('page.histori')->with('error', 'Transaction not found.');
        }

        return view('kasir.struk',[
            'histori' => $transaction,
            'histori_detail' => $histori_detail
            ] );
    }
}
