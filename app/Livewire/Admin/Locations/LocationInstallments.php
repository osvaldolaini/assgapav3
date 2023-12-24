<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Locations\Installment;
use App\Models\Admin\Locations\Location;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class LocationInstallments extends Component
{
    public $id;
    public $location;
    public $config;
    public $installments;
    public $breadcrumb_title;

    public function mount(Location $location)
    {
        // dd('mount');
        $this->location = $location;
        $this->id = $location->id;
        $this->breadcrumb_title = 'LOCAÇÃO DE: ' . $location->partners->name;
        $this->installments = $this->location->installments->where('active','!=',3);
    }

    #[On('updateInstallments')]
    public function updateInstallments(Location $location)
    {
        $this->location = $location;
        $this->installments = $this->location->installments->where('active','!=',3);
    }

    #[On('updateInstallments')]
    public function render()
    {
        if($this->location->installments->count() < 1 && $this->location->convert_value($this->location->value) > 0){
            Installment::create([
                'active'        => 0,
                'title'         => 'Sinal',
                'value'         => $this->location->value,
                'location_id'   => $this->id,
                'created_by'    => Auth::user()->name
            ]);
        }
        return view('livewire.admin.locations.location-installments',[
            'location' => $this->location,
            'installments' => $this->installments->where('active','!=',3)
        ]);
    }
    public function insertParcel()
    {
        Installment::create([
            'active'        => 0,
            'title'         => $this->installments->count(). 'ª parcela',
            'location_id'   => $this->id,
            'created_by'    => Auth::user()->name
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
        redirect()->route('installments-location',$this->id);

    }


    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
