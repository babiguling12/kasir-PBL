<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Pengguna;
use Livewire\WithFileUploads;

class PenggunaForm extends Component
{
    use WithFileUploads;
    
    public $nama;
    public $username;
    public $password;
    public $profile;

    public function store() {
        $rules = [
            'nama' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|min:8|max:12',
            'profile' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];

        $validated = $this->validate($rules);
        Pengguna::created($validated);
        flash()->success('Pengguna berhasil ditambahkan');
    }
    public function render()
    {
        return view('livewire.pengguna-form');
    }
}
