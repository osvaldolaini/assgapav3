<?php

namespace App\Livewire\Admin\Marketing;

use App\Models\Admin\Marketing\Email;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailPromoEdit extends Component
{
    public $category;
    public $rules;

    //Campos
    public $title;
    public $text;
    public $id;

    public function mount(Email $email)
    {
        $this->id       = $email->id;
        $this->title    = $email->title;
        $this->text     = $email->text;
    }
    public function render()
    {
        return view('livewire.admin.marketing.email-promo-edit');
    }
    public function save()
    {
        $this->persist();
    }
    public function save_out()
    {
        $this->persist();
        redirect()->route('emails-promo');
    }
    public function persist()
    {
        $this->rules = [
            'title' => 'required',
            'text'  => 'required',
        ];

        $this->validate();

        Email::updateOrCreate([
            'id' => $this->id,
        ], [
            'title'                 => $this->title,
            'text'                  => $this->text,
            'updated_by'            =>Auth::user()->name,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
