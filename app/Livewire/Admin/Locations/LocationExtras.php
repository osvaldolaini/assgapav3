<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Locations\Extras;
use App\Models\Admin\Locations\Location;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LocationExtras extends Component
{
    public $rules;
    public $showJetModal = false;
    public $checkoutModal = false;

    public $id;
    public $tot = 0;
    public $total = '0,00';
    public $extras;
    public $location;
    public $location_id;
    public $config;
    public $installments;
    public $breadcrumb_title;


    //Campos
    public $dressing_room;
    public $lighting;
    public $janitor;
    public $security;
    public $inflatable;
    public $brigade;
    public $qtd_dressing_room;
    public $qtd_lighting;
    public $qtd_janitor;
    public $qtd_security;
    public $qtd_inflatable;
    public $qtd_brigade;

    public $form_payment;
    public $date_payment;


    public function mount(Location $location)
    {
        $this->location = $location;
        $this->location_id = $location->id;

        $this->breadcrumb_title = 'LOCAÇÃO DE: ' . $location->partners->name;
        $this->extras = $this->location->extras;
        if (empty($this->extras)) {
            $this->extras = Extras::create([
                'active'        => 0,
                'location_id'   => $this->location_id,
                'created_by' => Auth::user()->name,
            ]);
        }

        $this->id = $this->extras->id;
        $this->dressing_room = $this->extras->dressing_room;
        $this->lighting = $this->extras->lighting;
        $this->janitor = $this->extras->janitor;
        $this->security = $this->extras->security;
        $this->inflatable = $this->extras->inflatable;
        $this->brigade = $this->extras->brigade;
        $this->qtd_dressing_room = $this->extras->qtd_dressing_room;
        $this->qtd_lighting = $this->extras->qtd_lighting;
        $this->qtd_janitor = $this->extras->qtd_janitor;
        $this->qtd_security = $this->extras->qtd_security;
        $this->qtd_inflatable = $this->extras->qtd_inflatable;
        $this->qtd_brigade = $this->extras->qtd_brigade;
        $this->date_payment = $this->extras->date_payment;
        $this->form_payment = $this->extras->form_payment;

        $this->upRender();

    }

    public function render()
    {
        $this->upRender();
        return view('livewire.admin.locations.location-extras');
    }
    public function upRender()
    {
        $this->tot = $this->extras->convert_value($this->extras->dressing_room)
                + $this->extras->convert_value($this->extras->lighting)
                + $this->extras->convert_value($this->extras->janitor)
                + $this->extras->convert_value($this->extras->security)
                + $this->extras->convert_value($this->extras->inflatable)
                + $this->extras->convert_value($this->extras->brigade);
                $this->total = number_format($this->tot, 2, ',', '.');
    }
    public function changeValue()
    {
        $this->extras = Extras::updateOrCreate([
            'id' => $this->id,
        ], [
            'active'        => 0,
            'dressing_room' => $this->dressing_room,
            'lighting'      => $this->lighting,
            'janitor'       => $this->janitor,
            'security'      => $this->security,
            'inflatable'    => $this->inflatable,
            'brigade'       => $this->brigade,
            'qtd_dressing_room' => $this->qtd_dressing_room,
            'qtd_lighting'  => $this->qtd_lighting,
            'qtd_janitor'   => $this->qtd_janitor,
            'qtd_security'  => $this->qtd_security,
            'qtd_inflatable' => $this->qtd_inflatable,
            'qtd_brigade'   => $this->qtd_brigade,
        ]);

    }
    public function updatePayment()
    {
        Extras::updateOrCreate([
            'id' => $this->id,
        ], [
            'form_payment' => $this->form_payment,
        ]);
    }
    public function updateDay()
    {
        $this->rules = [
            'date_payment'    => 'required|date_format:d/m/Y',
        ];

        $this->validate();
        Extras::updateOrCreate([
            'id' => $this->id,
        ], [
            'date_payment' => $this->date_payment,
        ]);
    }
    //PAGAR
    public function showCheckoutModal()
    {
        $this->checkoutModal = true;
    }

    public function checkout()
    {
        Extras::updateOrCreate([
            'id' => $this->id,
        ], [
            'active' => 1,
            'updated_by' => Auth::user()->name,
        ]);

        redirect()->route('extras-location',$this->location_id);

    }
    //DELETE
    public function showModalDelete()
    {
        $this->showJetModal = true;

    }
    public function delete()
    {
        $data = Extras::where('id',$this->id)->first();

        $data->active = 0;
        $data->save();
        $this->showJetModal = false;
        $this->openAlert('success', 'Registro excluido com sucesso.');
        $this->openAlert('error', 'Excluir esse registro não exclui o
        recibo '.$data->received_id.'
        automaticamente.');
        sleep(3);
        redirect()->route('extras-location',$this->location_id);

    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
