<?php

namespace App\Livewire\Admin\Financial;

use App\Models\Admin\Configs\CostCenter;
use App\Models\Admin\Financial\Cashier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CashierEdit extends Component
{
    public $rules;
    public $dependents;
    public $categories;

    public $breadcrumb_title = 'NOVA MOVIMENTAÇÃO';

    //Campos
    public $id;
    public $title;
    public $status = 0;
    public $paid_in;
    public $value;
    public $cost_center_id;
    public $type;
    public $updated_because;


    public function mount(Cashier $cashier)
    {

        $this->categories = CostCenter::select('title', 'id')->get();
        $this->id = $cashier->id;
        $this->title = $cashier->title;
        $this->status = $cashier->status;
        $this->paid_in = $cashier->paid_in;
        $this->value = $cashier->value;
        $this->cost_center_id = $cashier->cost_center_id;
        $this->type = $cashier->type;

        $this->breadcrumb_title = $cashier->title;
    }
    public function render()
    {
        return view('livewire.admin.financial.cashier-edit');
    }
    public function save()
    {
        $this->persist();
    }
    public function save_out()
    {
        $this->persist();
        redirect()->route('cashier');
    }
    public function persist()
    {
        $this->rules = [
            'title' => 'required',
            'status' => 'required',
            'paid_in' => 'required',
            'value' => 'required',
            'cost_center_id' => 'required',
            'type' => 'required',
            'updated_because' => 'required',
        ];

        $this->validate();
        Cashier::updateOrCreate([
            'id' => $this->id,
        ], [
            'title' => $this->title,
            'updated_because' => $this->updated_because,
            'status' => $this->status,
            'paid_in' => $this->paid_in,
            'value' => $this->value,
            'cost_center_id' => $this->cost_center_id,
            'type' => $this->type,
            'created_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
