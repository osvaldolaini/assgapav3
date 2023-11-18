<?php

namespace App\Livewire\Admin\Registers;

use App\Models\Admin\Registers\Partner;
use Livewire\Component;

class History extends Component
{
    public $breadcrumb_title;
    //Campos
    public $partner;

    public function mount(Partner $partner)
    {
        $this->breadcrumb_title = $partner->name;
        $this->partner = $partner;
    }
    public function render()
    {
        return view('livewire.admin.registers.history');
    }
}
