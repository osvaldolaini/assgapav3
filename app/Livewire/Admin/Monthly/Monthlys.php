<?php

namespace App\Livewire\Admin\Monthly;

use App\Models\Admin\Registers\Partner;
use Livewire\Component;

class Monthlys extends Component
{
    public $category;
    public $rules;
    public $partner;
    public $partner_category_master;

    public $breadcrumb_title;
    //Campos
    public $id;

    public function mount(Partner $partner)
    {
        $this->breadcrumb_title = 'MENSALIDADES DE: '.$partner->name;
        $this->id = $partner->id;
        $this->partner = $partner;

        $this->partner_category_master = $partner->partner_category_master;
    }
    public function render()
    {
        return view('livewire.admin.monthly.monthlys');
    }
}
