<?php

namespace App\Livewire\Admin\Marketing;

use App\Models\Admin\Configs;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailBirth extends Component
{
    public $configs;
    public $email_happy;
    public $id;
    public function mount()
    {
        $this->configs = Configs::find(1);
        $this->id = $this->configs->id;
        $this->email_happy = $this->configs->email_happy;
    }
    public function render()
    {
        return view('livewire.admin.marketing.email-birth');
    }
    public function update()
    {
        Configs::updateOrCreate([
            'id' => $this->id,
        ], [
            'email_happy'=> $this->email_happy,
            'updated_by' => Auth::user()->name,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
