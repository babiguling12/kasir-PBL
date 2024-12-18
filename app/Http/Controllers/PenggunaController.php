<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('core.pengguna', ['users' => Pengguna::latest()->paginate(5)]);
        
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
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:pengguna,username|max:255',
            'password' => 'required|string|min:8',
            'profile' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $profilePath = null;
        if($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('img', 'public');
        }

        Pengguna::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'foto' => $request->profile,
        ]);

        flash()->success('Pengguna berhasil ditambahkan');
        return redirect()->route('page.pengguna');
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
