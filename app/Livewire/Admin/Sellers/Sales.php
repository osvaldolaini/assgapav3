<?php

namespace App\Livewire\Admin\Sellers;

// use App\Models\Admin\Locations\Location;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sales extends Component
{
    public $sales;
    public $showModalCreate = false;

    public function modalRegister()
    {
        $this->showModalCreate = true;
        $this->sales = Auth::user()->partner->indications;
        // dd($this->sales, Auth::user()->partner->id);
    }
    public function render()
    {
        return view('livewire.admin.sellers.sales');
    }
}
