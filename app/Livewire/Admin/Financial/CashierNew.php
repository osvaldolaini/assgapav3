<?php

namespace App\Livewire\Admin\Financial;

use App\Models\Admin\Configs\CostCenter;
use App\Models\Admin\Financial\Cashier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CashierNew extends Component
{

    public $rules;
    public $dependents;
    public $categories;

    public $breadcrumb_title = 'NOVA MOVIMENTAÇÃO';

    //Campos
    public $title;
    public $status = 0;
    public $paid_in;
    public $value;
    public $cost_center_id;
    public $type;

    public function mount()
    {
        $this->paid_in = date('d/m/Y');
        $this->categories = CostCenter::select('title', 'id')->get();
    }
    public function render()
    {
        return view('livewire.admin.financial.cashier-new');
    }

    public function save_out()
    {
        $this->rules = [
            'title' => 'required',
            'status' => 'required',
            'paid_in' => 'required',
            'value' => 'required',
            'cost_center_id' => 'required',
            'type' => 'required',
        ];

        $this->validate();
        Cashier::create([
            'active' => 1,
            'title' => $this->title,
            'status' => $this->status,
            'paid_in' => $this->paid_in,
            'value' => $this->value,
            'cost_center_id' => $this->cost_center_id,
            'type' => $this->type,
            'created_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
        redirect()->route('cashier');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
