<?php

namespace App\Livewire;

use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Livewire\Forms\SupplierForm;
use LivewireUI\Modal\ModalComponent;

class DataDelete extends ModalComponent
{
    public $model;

    public function mount($model, $id)
    {
        $class = "App\\Models\\" . Str::studly(Str::singular($model));
        if(class_exists($class)) {
            $this->model = new $class;
            $this->model = $this->model->find($id);
        }
    }

    public function destroy()
    {
        $this->model->delete();

        flash()->success('Data berhasil dihapus');

        $this->closeModal();
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.delete-modal');
    }

    public static function modalMaxWidth(): string
{
    return 'md';
}
}
