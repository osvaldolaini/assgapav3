<?php

namespace App\Livewire\Admin\Monthly;

use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class MonthlyUnpaid extends Component
{

    public $showModalPay = false;
    public $showModalEdit = false;

    public $monthlys;
    public $partner;
    public $label;
    public $rules;
    public $pay = [];
    public $values = [];
    public $pays;
    public $title;
    public $form_payment;
    public $value;
    public $paid_in;
    public $received;
    public $status;
    public $monthly_id;

    public $received_id;

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
    }
    public function render()
    {
        $this->monthlys = $this->partner->monthlys->where('status', 0)->sortByDesc('ref');
        return view('livewire.admin.monthly.monthly-unpaid');
    }
    public function resetAll()
    {
        $this->reset(
            'form_payment',
            'value',
            'received',
            'monthly_id',
            'status'
        );
    }
    public function paid()
    {
        $this->paid_in = date('d/m/Y');
        $c = count($this->pay);
        $tot = 0;
        if ($c == 0) {
            $this->openAlert('error', 'Nenhuma mensalidade selecionada.');
            return;
        }
        $i = 0;
        if ($c > 1) {
            $pl = 's';
        } else {
            $pl = '';
        }
        $this->title = 'Referente a' . $pl . ' mensalidade' . $pl . ' de: ';
        foreach ($this->pay as $item) {
            $i++;
            $m = MonthlyPayment::find($item);
            $this->pays[] = $m;
            if ($i == $c) {
                $this->title .= $m->monthlyRef . '.';
            } else {
                $this->title .= $m->monthlyRef . ', ';
            }
            // $this->values[]=$m->monthlyRef;
            $tot += $m->convert_value($m->value);
        }
        $this->value = number_format($tot, 2, ',', '.');
        $this->showModalPay = true;
    }
    //UPDATE
    public function showModalUpdate($id)
    {
        $this->resetAll();
        $this->monthly_id = $id;
        $m = MonthlyPayment::find($id);
        $this->value = $m->value;
        $this->label = $m->monthlyRef;
        $this->status = $m->status;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'value' => 'required',
        ];

        $this->validate();
        MonthlyPayment::updateOrCreate([
            'id' => $this->monthly_id,
        ], [
            'updated_by' => Auth::user()->name,
            'value' => $this->value,
            'status' => $this->status,
        ]);
        $this->resetAll();
        $this->showModalEdit = false;

        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    public function checkout()
    {
        $this->rules = [
            'received' => 'required',
            'paid_in' => 'required|date_format:d/m/Y',
            'value' => 'required',
            'form_payment' => 'required',
        ];

        $this->validate();
        foreach ($this->pay as $item) {
            $m = MonthlyPayment::find($item);
            MonthlyPayment::updateOrCreate([
                'id' => $item,
            ], [
                'updated_by' => Auth::user()->name,
                'title' => 'Ref: ' . $m->monthlyRef,
                'paid_in' => $this->paid_in,
                'form_payment' => $this->form_payment,
                'received' => $this->received,
                'status' => 1,
            ]);
        }

        if ($this->received) {
            $data = [
                'active' => 1,
                'title' => $this->title,
                'paid_in' => $this->paid_in,
                'value' => $this->value,
                'form_payment' => $this->form_payment,
                'partner_id' => $this->partner->id,
                'partner' => $this->partner->name,
                'created_by' => Auth::user()->name,
            ];

            $this->dispatch('createReceived', json_encode($data));
        } else {
            $this->openAlert('success', 'Registro atualizado com sucesso.');
        }
    }

    #[On('checkoutReturn')]
    public function checkoutReturn($received_id)
    {
        foreach ($this->pay as $item) {
            MonthlyPayment::updateOrCreate([
                'id' => $item,
            ], [
                'received_id' => $received_id,
            ]);
        }
        $this->resetAll();
        $this->showModalPay = false;
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
