<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Locations\Installment;
use Livewire\Component;

class LocationInstallmentObs extends Component
{
    public $showModal = false;
    public $logs;
    public $installment;
    public $obs;
    public $model = "App\Models\Admin\Locations\Installment"; //Model principal

    public function mount(Installment $installment)
    {
        $this->installment = $installment;
    }
    public function render()
    {
        return view('livewire.admin.locations.location-installment-obs');
    }
    public function openObs()
    {
        // dd($this->installment);
        $this->showModal = true;
        if (isset($id)) {
            $data = Installment::where('id', $id)->first();
            $this->logs = logging($data->id, $this->model);
        }
    }
    public function updatedObservation($value)
    {
        // salva automaticamente ao atualizar
        $this->installment->update(['obs' => $value]);
    }
}
