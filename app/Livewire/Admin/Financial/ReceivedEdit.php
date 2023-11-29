<?php

namespace App\Livewire\Admin\Financial;

use App\Models\Admin\Financial\Received;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReceivedEdit extends Component
{

    public $rules;
    public $breadcrumb_title;
    //Search
    public $modalSearch = false;
    public $inputSearch;
    public $typeSearch;
    public $results;

    //Campos
    public $title;
    public $paid_in;
    public $value;
    public $form_payment;
    public $partner_id;
    public $partner;
    public $obs;
    public $updated_because;

    public $received;
    public $id;


    public function mount(Received $received)
    {
        $this->received = $received;
        $this->breadcrumb_title = 'PAGO POR: ' . $received->partners->name;
        $this->id = $received->id;

        $this->title = $received->title;
        $this->paid_in = $received->paid_in;
        $this->value = $received->value;
        $this->form_payment = $received->form_payment;
        $this->partner_id = $received->partner_id;
        $this->partner = $received->partner;
        $this->obs = $received->obs;
        $this->updated_because = $received->updated_because;

    }
    public function render()
    {
        if ($this->inputSearch != '') {
            $this->results = Partner::select('id', 'name', 'cpf', 'image', 'partner_category_master')
                ->where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->limit(5)->get();
        }
        return view('livewire.admin.financial.received-edit');
    }
    public function openModalSearch($typeSearch)
    {
        $this->modalSearch = true;
        $this->typeSearch = $typeSearch;
    }

    public function selectPartner($id)
    {
        $partner = Partner::find($id);

        $this->partner          = $partner->name;
        $this->partner_id       = $partner->id;

        $this->typeSearch = '';
        $this->inputSearch = '';
        $this->results = '';

        $this->modalSearch = false;
    }

    public function save()
    {
        $this->persist();
    }
    public function save_out()
    {
        $this->persist();
        redirect()->route('receiveds');
    }
    public function persist()
    {
        $this->rules = [
            'title' => 'required',
            'paid_in' => 'required',
            'value' => 'required',
            'form_payment' => 'required',
            'partner_id' => 'required',
            'partner' => 'required',
            'updated_because' => 'required',
        ];

        $this->validate();
        Received::updateOrCreate([
            'id' => $this->id,
        ], [
            'updated_by' => Auth::user()->name,
            'title' => $this->title,
            'paid_in' => $this->paid_in,
            'value' => $this->value,
            'form_payment' => $this->form_payment,
            'partner_id' => $this->partner_id,
            'partner' => $this->partner,
            'obs' => $this->obs,
            'updated_because' => $this->updated_because,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
