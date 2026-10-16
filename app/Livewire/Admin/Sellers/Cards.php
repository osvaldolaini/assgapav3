<?php

namespace App\Livewire\Admin\Sellers;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cards extends Component
{
    public $partner;
    public $indications;
    public $registers;
    public $jewels;
    public $totalPay;

    public function mount()
    {
        $partner = Auth::user()->partner;
        $this->indications = $partner->indications->count();
        $this->registers = $partner->registers->count();


        $this->totalPay = $partner->sales->sum(fn($sale) => (float) $sale->value);

        $this->jewels = collect();

        foreach ($partner->registers as $register) {
            $this->jewels = $this->jewels->concat(
                $register->jewels->where('status', 1)
            );
        }

        // dd($partner->sales);
    }
    public function render()
    {
        return view('livewire.admin.sellers.cards');
    }
}
