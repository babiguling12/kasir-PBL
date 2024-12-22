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
    public $password = '';
    public $profile = '';

    public function rules() {

        // supaya tidak error ketika mengedit dengan username yang sama
        $uniqueUsernameRule = $this->pengguna ? 
        'required|unique:pengguna,username,' . $this->pengguna->id . '|max:100' 
        : 'required|unique:pengguna,username|max:100';

        return [
            'nama' => 'required|max:255',
            'username' => $uniqueUsernameRule,
            'password' => 'required|min:8|max:12',
            'profile' => $this->pengguna ? 'nullable|image|mimes:jpeg,jpg,png|max:2048' : 'required|image|mimes:jpeg,jpg,png|max:2048',
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
        'profile.required' => 'Profile wajib diisi',
        'profile.image' => 'Profile harus berupa gambar',
        'profile.mimes' => 'Profile harus berupa jpeg, jpg, atau png',
        'profile.max' => 'Profile maksimal 2MB',
    ];

    public function tambahPengguna(Pengguna $pengguna) {
        $this->pengguna = $pengguna;

        $this->nama = $pengguna->nama;
        $this->username = $pengguna->username;
        $this->password = $pengguna->password;
        $this->profile = $pengguna->foto;
    }

    public function tambahData() {
        $this->validate();

        if($this->profile) {
            $originalFileName = $this->profile->getClientOriginalName();
            $uniqueFileName = uniqid() . '-' . $originalFileName;
            $storeFilePath = $this->profile->storeAs('img/profile', $uniqueFileName, 'public'); // disimpan di folder storage/app/public
        }

        if (!$this->pengguna) {
            Pengguna::create([
                'nama' => $this->nama,
                'username' => $this->username,
                'password' => bcrypt($this->password),
                'foto' => $storeFilePath ?? null,
            ]);
            flash()->success('Pengguna berhasil ditambahkan');
        } else {

            if($this->profile && $this->pengguna->foto) {
                if (Storage::disk('public')->exists($this->pengguna->foto)) {
                    Storage::disk('public')->delete($this->pengguna->foto);
                }

            }

            $this->pengguna->update([
                'nama' => $this->nama,
                'username' => $this->username,
                'password' => bcrypt($this->password),
                'foto' => $storeFilePath ?? $this->pengguna->foto,
            ]);
            flash()->success('Pengguna berhasil diubah');
        }

        $this->reset();
    }

    
}
