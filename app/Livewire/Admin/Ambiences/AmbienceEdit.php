<?php

namespace App\Livewire\Admin\Ambiences;

use App\Models\Admin\Configs\AmbienceCategory;
use App\Models\Admin\Ambiences\Ambience;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AmbienceEdit extends Component
{
    public $category;
    public $rules;
    public $breadcrumb_title;
    //Campos
    public $active = 1;
    public $title = '';
    public $id;
    public $capacity;
    public $cashback;
    public $time_week;
    public $time_weekend;
    public $obs;
    public $contract;
    public $term;
    public $term_return;
    public $multiple;
    public $need;
    public $ambience_category;

    public function mount(Ambience $ambience)
    {
        $this->category = AmbienceCategory::select('id','title')->orderBy('title','asc')
        ->where('active',1)->get();
        $this->id = $ambience->id;
        $this->title = $ambience->title;
        $this->capacity = $ambience->capacity;
        $this->cashback = $ambience->cashback;
        $this->time_week = $ambience->time_week;
        $this->time_weekend = $ambience->time_weekend;
        $this->obs = $ambience->obs;
        $this->contract = $ambience->contract;
        $this->term = $ambience->term;
        $this->multiple = $ambience->multiple;
        $this->need = $ambience->need;
        $this->ambience_category = $ambience->ambience_category;

        $this->breadcrumb_title = $ambience->title;
    }
    public function render()
    {
        return view('livewire.admin.ambiences.ambience-edit');
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

        Ambience::updateOrCreate([
            'id' => $this->id,
        ], [
            'title'                 => $this->title,
            'capacity'              => $this->capacity,
            'cashback'              => $this->cashback,
            'time_week'             => $this->time_week,
            'time_weekend'          => $this->time_weekend,
            'multiple'              => $this->multiple,
            'need'                  => $this->need,
            'ambience_category'     => $this->ambience_category,
            'obs'                   => $this->obs,
            'term'                  => $this->term,
            'contract'              => $this->contract,
            'updated_by'            =>Auth::user()->name,
        ]);
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
