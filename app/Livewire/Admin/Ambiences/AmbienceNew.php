<?php

namespace App\Livewire\Admin\Ambiences;

use App\Models\Admin\Configs\AmbienceCategory;
use App\Models\Admin\Ambiences\Ambience;
use Livewire\Component;

class AmbienceNew extends Component
{
    public $category;
    public $rules;

    public $breadcrumb_title = 'NOVO AMBIENTE';
    //Campos
    public $title;
    public $id;
    public $capacity;
    public $cashback;
    public $time_week;
    public $time_weekend;
    public $obs;
    public $contract;
    public $term;
    public $term_return;
    public $multiple = '0';
    public $need = '0';
    public $ambience_category;

    public function mount()
    {
        $this->category = AmbienceCategory::select('id','title')->orderBy('title','asc')
        ->where('active',1)->get();
    }
    public function render()
    {
        return view('livewire.admin.ambiences.ambience-new');
    }

    public function save_out()
    {
        $this->rules = [
            'title' => 'required',
            'ambience_category'  => 'required',
            'time_week'  => 'required',
            'time_weekend'  => 'required',
            'need'  => 'required',
            'multiple'  => 'required',
            'cashback'  => 'required',
            'multiple'  => 'required',
        ];

        $this->validate();
        $ambience = Ambience::create([
            'active' =>1,
            'title' => $this->title,
            'capacity' => $this->capacity,
            'cashback' => $this->cashback,
            'time_week' => $this->time_week,
            'time_weekend' => $this->time_weekend,
            'multiple' => $this->multiple,
            'need' => $this->need,
            'ambience_category' => $this->ambience_category,
            'obs'=> $this->obs,
            'term'=> $this->term,
            'contract'=> $this->contract,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
        redirect()->route('ambience-values',$ambience->id);
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}

