<?php

namespace App\Livewire\Admin\Marketing;

use App\Models\Admin\Marketing\Email;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailPromoNew extends Component
{
    public $category;
    public $rules;

    //Campos
    public $title;
    public $text;

    public function render()
    {
        return view('livewire.admin.marketing.email-promo-new');
    }

    public function save_out()
    {
        $this->rules = [
            'title' => 'required',
            'text'  => 'required',
        ];

        $this->validate();
        Email::create([
            'active' =>1,
            'title'                 => $this->title,
            'text'                  => $this->text,
            'created_by'            =>Auth::user()->name,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
        redirect()->route('emails-promo');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
