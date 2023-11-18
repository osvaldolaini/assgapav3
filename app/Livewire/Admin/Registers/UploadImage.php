<?php

namespace App\Livewire\Admin\Registers;

use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadImage extends Component
{
    use WithFileUploads;

    public $uploadimage;
    public $partner;
    public $photo;
    public $rules;
    public $valid = false;

    public function mount($id)
    {
        if ($id) {
            $this->partner = Partner::find($id);
            $this->photo = $this->partner->image;
        }
    }
    public function render()
    {
        return view('livewire.admin.registers.upload-image');
    }
    public function changePhoto()
    {
        $this->dispatch('submitForm');
    }
    public function updated($property)
    // public function uploadPhoto()
    {
        if ($property === 'uploadimage') {
            $this->rules = [
                'uploadimage'   => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            ];

            $this->validate();
            if (isset($this->uploadimage)) {
                $ext = $this->uploadimage->getClientOriginalExtension();
                $code = Str::uuid();
                $new_name = $code . '.jpg';
                $this->uploadimage->storeAs('public/livewire-tmp', $new_name);

                $this->dispatch('uploadingImage', $new_name);
                $this->valid = true;
                $this->openAlert('success', 'Foto validada com sucesso.');
            }
        }
    }
    public function excluirTemp()
    {
        $this->uploadimage = '';
    }
    public function excluirPhoto()
    {
        $this->partner->image = '';
        $this->partner->save();
        $name = explode('.', $this->photo);
        Storage::delete('public/partners/' . $this->photo);
        Storage::delete('public/partners/' . $name[0] . '.webp');
        Storage::delete('public/partners/' . $name[0] . '.jpg');
        $this->photo = $this->partner->image;
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
