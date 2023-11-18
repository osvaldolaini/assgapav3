<?php

namespace App\Livewire\Admin\Registers;

use Livewire\Component;

class Card extends Component
{
    public $nome;
    public function mount($nome)
    {
        dd($nome);
        $this->nome = $nome;
    }
    public function render()
    {
        return view('livewire.admin.registers.card');
    }

}
