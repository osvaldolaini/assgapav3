<?php

namespace App\Livewire\Admin\Jewels;

use App\Models\Admin\Financial\Received;
use App\Models\Admin\Jewels\Jewel as JewelModel;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Jewel extends Component
{
    public $showModalPay = false;
    public $showModalEdit = false;
    public $showModalCreate = false;
    public $showJetModal = false;

    public $partner;
    public $jewels_not_paid;
    public $jewels_paid;
    public $jewels_released;
    public $breadcrumb_title;
    public $id;

    //fields
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
    public $jewel_id;

    public $received_id;

    public $year;

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
        $this->jewels_not_paid = $partner->jewels->where('active', 0);
        $this->jewels_paid = $partner->jewels->where('active', 1);
        $this->jewels_released = $partner->jewels->where('status', 2);

        $this->breadcrumb_title = 'JÓIA: ' . $partner->name;
        $this->id = $partner->id;
    }

    public function render()
    {
        $this->jewels_not_paid = $this->partner->jewels->where('status', 0);
        $this->jewels_paid = $this->partner->jewels->where('status', 1);
        $this->jewels_released = $this->partner->jewels->where('status', 2);
        return view('livewire.admin.jewels.jewel');
    }
    public function resetAll()
    {
        $this->reset(
            'form_payment',
            'value',
            'received',
            'jewel_id',
            'status',
            'title'
        );
    }

    public function modalCreate()
    {
        $this->showModalCreate = true;
    }
    public function store()
    {
        $this->rules = [
            'value' => 'required',
            'paid_in' => 'required',
            'title' => 'required',
        ];

        $this->validate();

        JewelModel::create([
            'partner_id'    => $this->partner->id,
            'status'        => 0,
            'paid_in'       => $this->paid_in,
            'title'         => $this->title,
            'value'         => $this->value,
            'created_by'    => Auth::user()->name,
        ]);
        $this->openAlert('success', 'Registro criado com sucesso.');

        $this->resetAll();
        $this->showModalCreate = false;
    }
    //UPDATE
    public function showModalUpdate($id)
    {
        $this->resetAll();
        $this->jewel_id = $id;
        $m = JewelModel::find($id);
        $this->value = $m->value;
        $this->status = $m->status;
        $this->paid_in = $m->paid_in;
        $this->title = $m->title;
        $this->showModalEdit = true;
    }

    public function update()
    {
        $this->rules = [
            'value' => 'required',
            'paid_in' => 'required',
            'title' => 'required',
        ];

        if ($this->status == 2) {
            $this->paid_in =  date('d/m/Y');
        }

        $this->validate();
        JewelModel::updateOrCreate([
            'id' => $this->jewel_id,
        ], [
            'updated_by' => Auth::user()->name,
            'paid_in'       => $this->paid_in,
            'title'         => $this->title,
            'value'         => $this->value,
            'status'        => $this->status,
        ]);

        $this->resetAll();
        $this->showModalEdit = false;
        $this->dispatch('checkoutReturn');
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }

    //PAGAR
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

        $this->title = 'Referente a jóia -' . $this->title;
        foreach ($this->pay as $item) {
            $i++;
            $m = JewelModel::find($item);
            $this->pays[] = $m;

            // $this->values[]=$m->monthlyRef;
            $tot += $m->convert_value($m->value);
        }
        $this->value = number_format($tot, 2, ',', '.');
        $this->showModalPay = true;
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
            $m = JewelModel::find($item);
            JewelModel::updateOrCreate([
                'id' => $item,
            ], [
                'updated_by' => Auth::user()->name,
                'title' => 'Jóia - ' . $this->title,
                'paid_in' => $this->paid_in,
                'form_payment' => $this->form_payment,
                'received' => $this->received,
                'status' => 1,
            ]);
        }

        if ($this->received == 1) {
            $this->validate();
            $received = Received::create([
                'active' => 1,
                'title' => $this->title,
                'paid_in' => $this->paid_in,
                'value' => $this->value,
                'form_payment' => $this->form_payment,
                'partner_id' => $this->partner->id,
                'partner' => $this->partner->name,
                'created_by' => Auth::user()->name,
            ]);

            $this->checkoutReturn($received->id);
        } else {
            $this->showModalPay = false;
            $this->pay = [];
            $this->openAlert('success', 'Registro atualizado com sucesso.');
        }
    }

    public function checkoutReturn($received_id)
    {
        foreach ($this->pay as $item) {
            JewelModel::updateOrCreate([
                'id' => $item,
            ], [
                'received_id' => $received_id,
            ]);
        }
        $this->resetAll();
        $this->showModalPay = false;
        $this->openAlert('success', 'Registro atualizado com sucesso.');
        $this->dispatch('checkoutReturn');
        redirect()->route('receiveds');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
    //DELETE
    public function showModalDelete($id)
    {
        $this->showJetModal = true;

        if (isset($id)) {
            $this->jewel_id = $id;
        } else {
            $this->jewel_id = $id;
        }
    }

    public function delete($id)
    {
        $data = JewelModel::find($id);
        $data->delete();
        $this->openAlert('success', 'Registro excluido com sucesso.');
        $this->showJetModal = false;
    }
}
