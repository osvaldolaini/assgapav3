<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        redirect()->route('dashboard');
        // return view('livewire.admin.homepage')->layout('layouts.page');
    }
}
