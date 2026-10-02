<?php

namespace App\Livewire\Admin\Sellers;

use App\Exports\AllExports;
use App\Models\Admin\Configs;

use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

use Maatwebsite\Excel\Facades\Excel;

class Payments extends Component
{
    public $partner;
    public function mount(Partner $partner)
    {
        $this->partner = $partner;
    }

    public function render()
    {
        // dd($this->getData());
        return view('livewire.admin.sellers.payments');
    }
}
