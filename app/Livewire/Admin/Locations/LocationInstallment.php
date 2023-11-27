<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Locations\Installment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LocationInstallment extends Component
{
    public $rules;
    public $showJetModal = false;
    public $checkoutModal = false;

    //Campos
    public $installment;
    public $title;
    public $value;
    public $form_payment;
    public $installment_maturity_date;
    public $received_id;
    public $location_id;
    public $id;

    public function mount(Installment $installment)
    {
        $this->id = $installment->id;
        $this->installment = $installment;
        $this->title = $installment->title;
        $this->value = $installment->value;
        $this->form_payment = $installment->form_payment;
        $this->installment_maturity_date = $installment->installment_maturity_date;
        $this->received_id = $installment->received_id;
        $this->location_id = $installment->location_id;


    }
    public function render()
    {
        return view('livewire.admin.locations.location-installment');
    }

    public function updateValue()
    {
        Installment::updateOrCreate([
            'id' => $this->id,
        ], [
            'value' => $this->value,
        ]);
    }
    public function updatePayment()
    {
        Installment::updateOrCreate([
            'id' => $this->id,
        ], [
            'form_payment' => $this->form_payment,
        ]);
    }
    public function updateDay()
    {
        Installment::updateOrCreate([
            'id' => $this->id,
        ], [
            'installment_maturity_date' => $this->installment_maturity_date,
        ]);
    }
    //PAGAR
    public function showCheckoutModal()
    {
        $this->checkoutModal = true;

    }

    public function checkout()
    {
        $this->rules = [
            'location_id'   => 'required',
            'form_payment'  => 'required',
            'installment_maturity_date'    => 'required',
            'value'         => 'required',
        ];

        $this->validate();
        if ($this->installment->value > $this->installment->location->convert_value($this->installment->location->remaining) ) {
            $this->openAlert('error', 'O valor informado é de R$ '.$this->installment->value.'. Portanto maior que o valor restante!');
            $this->value = $this->installment->location->remaining;
            return;

        }
        Installment::updateOrCreate([
            'id' => $this->id,
        ], [
            'active' => 1,
            'updated_by' => Auth::user()->name,
        ]);

        redirect()->route('installments-location',$this->location_id);

    }
    //DELETE
    public function showModalDelete()
    {
        $this->showJetModal = true;

    }
    public function delete()
    {
        $data = Installment::where('id',$this->id)->first();
        if ($data->title == 'Sinal') {
            $data->active = 0;
        }else{
            $data->active = 3;
        }

        $data->save();
        $this->showJetModal = false;
        $this->openAlert('success', 'Registro excluido com sucesso.');
        redirect()->route('installments-location',$this->location_id);

    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
