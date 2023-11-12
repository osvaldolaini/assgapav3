<?php

namespace App\Livewire\Admin\Ambiences;

use App\Models\Admin\Ambiences\Ambience;
use Livewire\Component;

class AmbienceContracts extends Component
{
    public $breadcrumb_title;

    public $category;
    public $rules;
    //Campos
    public $id;
    public $contract;
    public $term;

    public function mount(Ambience $ambience)
    {
        $this->id = $ambience->id;
        $this->contract = $ambience->contract;
        $this->term = $ambience->term;
        $this->breadcrumb_title = $ambience->title;
    }
    public function render()
    {
        return view('livewire.admin.ambiences.ambience-contracts');
    }
    public function save()
    {
        $this->persist();
    }
    public function save_out()
    {
        $this->persist();
        redirect()->route('ambiences');
    }
    public function persist()
    {
        Ambience::updateOrCreate([
            'id' => $this->id,
        ], [
            'term'=> $this->term,
            'contract'=> $this->contract,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
