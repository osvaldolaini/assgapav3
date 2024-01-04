<?php

namespace App\Livewire\Admin\Monthly;

use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Registers\Partner;
use Livewire\Attributes\On;
use Livewire\Component;

class MonthlyReleased extends Component
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
        $this->monthlys = $this->partner->monthlys->where('status', 2)->sortByDesc('ref');
        return view('livewire.admin.monthly.monthly-released');
    }
}
