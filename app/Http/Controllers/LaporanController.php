<?php

namespace App\Http\Controllers;


use App\Models\Produk;
use App\Models\Pengguna;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function histori()
    {
        return view('core.laporan.histori.all_histori', ['histori' => Transaksi::latest()->paginate(5)]);
    }

    public function all_laporan()
    {
        return view('core.laporan.all_laporan');
    }

    public function Detail($id)
    {
        $transaction = Transaksi::find($id);
        $histori_detail = TransaksiDetail::where('transaksi_id', $id)->latest()->get();
        

        if (!$transaction) {
            return redirect()->route('page.histori')->with('error', 'Transaction not found.');
        }

        return view('core.laporan.histori.detail',[
            'histori' => $transaction,
            'histori_detail' => $histori_detail
            ] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
    
}
