<?php

namespace App\Livewire\Admin\Sellers;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Indications extends Component
{
    public $indications;
    public $showModalCreate = false;


    public function modalRegister()
    {

        $this->showModalCreate = true;
        $this->indications = Auth::user()->indications;
    }
    public function render()
    {
        return view('livewire.admin.sellers.indications');
    }
}
