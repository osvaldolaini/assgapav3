<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.admin.nav-bar');
    }
    public function openModalSearch()
    {
        $this->emit('openModalSearch');
    }
}
