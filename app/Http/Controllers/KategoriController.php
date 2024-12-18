<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProduk;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('core.produk.kategori', ['kategori' => KategoriProduk::latest()->paginate(5)]);
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
        $validate = $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        KategoriProduk::create([
            'nama_kategori' => $request->kategori, // jika ingin menggunakan validate di dalam create, dpt menuliskan $validate['kategori']
        ]);

        flash()->success('Kategori berhasil ditambahkan');
        return redirect()->route('page.kategori');
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
        $kategori = KategoriProduk::findOrFail($request->id); // klo tidak ditemukan data, langsung diarahkan ke halaman 404

        $validate = $request->validate([
            'id' => 'required|exists:kategori_produk,id',
            'kategori' => 'required|string|max:255',
        ]);

        $kategori->update([
            'nama_kategori' => $request->kategori,
        ]);

        flash()->success('Kategori berhasil diupdate');
        return redirect()->route('page.kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
