<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Component;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class PenggunaForm extends Form
{
    use WithFileUploads;

    public ?Pengguna $pengguna = null;
    
    public $nama = '';
    public $username = '';
    public $role = 'kasir';
    public $password = '';
    public $foto;

    public function rules() {

        // supaya tidak error ketika mengedit dengan username yang sama
        $uniqueUsernameRule = $this->pengguna ? 
        'required|unique:pengguna,username,' . $this->pengguna->id . '|max:100' 
        : 'required|unique:pengguna,username|max:100';

        return [
            'nama' => 'required|max:255',
            'username' => $uniqueUsernameRule,
            'password' => 'required|min:8|max:12',
            'foto' => $this->pengguna ? 'nullable|image|mimes:jpeg,jpg,png|max:2048' : 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    protected $messages = [
        'nama.required' => 'Nama wajib diisi',
        'username.required' => 'Username wajib diisi',
        'username.unique' => 'Username sudah ada',
        'username.max' => 'Username maksimal 100 karakter',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.max' => 'Password maksimal 12 karakter',
        'foto.required' => 'foto wajib diisi',
        'foto.image' => 'foto harus berupa gambar',
        'foto.mimes' => 'foto harus berupa jpeg, jpg, atau png',
        'foto.max' => 'foto maksimal 2MB',
    ];

    public function tambahPengguna(Pengguna $pengguna) {
        $this->pengguna = $pengguna;
        $this->role ='kasir';
        $this->nama = $pengguna->nama;
        $this->username = $pengguna->username;
        $this->password = '';
        $this->foto = $pengguna->foto;
    }

    public function tambahData() {
        $this->validate();

        if($this->foto) {
            $originalFileName = $this->foto->getClientOriginalName();
            $uniqueFileName = uniqid() . '-' . $originalFileName;
            $storeFilePath = $this->foto->storeAs('img/profile', $uniqueFileName, 'public'); // disimpan di folder storage/app/public
        }

        if (!$this->pengguna) {
            Pengguna::create([
                'nama' => $this->nama,
                'username' => $this->username,
                'role' => $this->role,
                'password' => bcrypt($this->password),
                'foto' => $storeFilePath ?? null,
            ]);
            flash()->success('Pengguna berhasil ditambahkan');
        } else {

            if($this->foto && $this->pengguna->foto) {
                if (Storage::disk('public')->exists($this->pengguna->foto)) {
                    Storage::disk('public')->delete($this->pengguna->foto);
                }

            }

            $this->pengguna->update([
                'nama' => $this->nama,
                'username' => $this->username,
                'role' => $this->role,
                'password' => bcrypt($this->password),
                'foto' => $storeFilePath ?? $this->pengguna->foto,
            ]);
            flash()->success('Pengguna berhasil diubah');
        }

        $this->reset();
    }

    
}
