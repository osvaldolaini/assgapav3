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
    public function updated($property)
    {
        if ($property === 'value') {
            // Remove tudo que não for número
            $rawValue = preg_replace('/[^\d]/', '', $this->value);

            // Adapte conforme a quantidade de caracteres
            if (strlen($rawValue) <= 2) {
                $this->value = $rawValue;
            } elseif (strlen($rawValue) <= 5) {
                $this->value = substr($rawValue, 0, -2) . ',' . substr($rawValue, -2);
            } else {
                $this->value = substr($rawValue, 0, -5) . '.' . substr($rawValue, -5, 3) . ',' . substr($rawValue, -2);
            }
        }
        $this->dispatch('updateAmount', ['value' => $this->value]);
    }


    public function save_out()
    {
        $this->rules = [
            'title' => 'required',
            'status' => 'required',
            'paid_in' => 'required|date_format:d/m/Y',
            'value' => 'required',
            'type' => 'required',
        ];

        if ($this->type == 2) {
            $this->rules = [
                'cost_center_id' => 'required',
            ];
        }

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
