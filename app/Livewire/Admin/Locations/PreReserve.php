<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceUnavailability;
use App\Models\Admin\Locations\Location;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PreReserve extends Component
{
    public $showModalCreate = false;
    public $alertSession = false;
    public $rules;
    public $model_id;
    public $registerId;

    //Campos
    public $active = 1;
    public $title;
    public $start;
    public $end;
    public $ambience_id;
    public $type = 0;
    public $ambience;
    public $alert;

    public function mount()
    {
        $this->ambience = Ambience::select('id', 'title')->orderBy('title', 'asc')
            ->where('active', 1)->get();
    }
    public function resetAll()
    {
        $this->reset(
            'title',
            'start',
            'end',
            'ambience_id',
        );
    }

    public function render()
    {
        return view('livewire.admin.locations.pre-reserve');
    }
    //CREATE
    public function modalCreate()
    {
        $this->resetAll();
        $this->showModalCreate = true;
    }
    public function updated()
    {
        if ($this->start) {
            $this->validates();
        }
    }
    public function store()
    {
        if ($this->type == 0) {
            $this->rules = [
                'type' => 'required',
                'title' => 'required',
                'start' => 'required',
                'ambience_id' => 'required',
            ];
            $this->end = $this->start;
        } else {
            $this->rules = [
                'type' => 'required',
                'title' => 'required',
                'start' => 'required',
                'end' => 'required',
                'ambience_id' => 'required',
            ];
        }


        $this->validate();

        $this->validates();

        // dd($this->start);
        if ($this->validates() == true) {
            AmbienceUnavailability::create([
                'title'          => $this->title,
                'type'           => $this->type,
                'start'          => $this->start,
                'end'            => $this->end,
                'ambience_id'    => $this->ambience_id,
                'active'         => 1,
                'created_by' => Auth::user()->name,
            ]);

            $this->openAlert('success', 'Pré reserva criada com sucesso.');

            $this->showModalCreate = false;
            $this->resetAll();
        }
    }
    public function validates()
    {
        $start = implode("-", array_reverse(explode("/", $this->start))) . ' 00:00:00';
        $end = implode("-", array_reverse(explode("/", $this->end))) . ' 00:00:00';
        $now = date('Y-m-d H:i:s');

        if ($start <= $now) {
            $this->openAlert('error', 'A ação não pode ser realizada com data inferior ao dia atual.');
            $this->alert = 'A data deve ser maior que o dia de hoje.';
            return false;
        }

        $replay = AmbienceUnavailability::where('start', $start)
            ->where('id', '!=', $this->model_id)
            ->where('active', 1)
            ->where('ambience_id', $this->ambience_id)
            ->first();
        if ($replay) {
            $this->openAlert('error', 'Essa data "' . $replay->start . '" já está ocupada para: ' . $replay->title);
            $this->alert = 'Já existe pré reserva nessa data.';
            return false;
        }

        $location = Location::where('location_date', $start)
            ->where('active', 1)
            ->where('ambience_id', $this->ambience_id)
            ->first();
        if ($location) {
            $this->openAlert('error', 'Existe uma locação nesta data "' . $location->location_date . '" para: ' . $location->partners->name);
            $this->alert = 'Já existe reserva nessa data.';
            return false;
        }
        $this->alert = '';
        return true;
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
