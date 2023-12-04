<?php

namespace App\Livewire\Admin\Monthly;

use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Registers\Partner;
use Livewire\Attributes\On;
use Livewire\Component;

class MonthlyPaid extends Component
{
    public $partner;
    public $monthlys;

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
    }
    #[On('checkoutReturn')]
    public function render()
    {
        $this->monthlys = $this->partner->monthlys->where('status', 1)->sortByDesc('ref');
        return view('livewire.admin.monthly.monthly-paid');
    }
}
