<?php

namespace App\Livewire\Admin\Ambiences;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceTenantPivot;
use App\Models\Admin\Configs\AmbienceTenant;
use Livewire\Component;

class AmbienceValues extends Component
{
    public $breadcrumb_title;

    public $showJetModal = false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $alertSession = false;

    public $pivots;
    public $rules;
    public $tenants;
    public $ambiencePivot;
    public $ambienceTenantPivot_id;

    public $ambienceTenant_id;
    public $ambience_id;

    public $value;
    public $deposit;

    public function mount(Ambience $ambience)
    {
        $this->breadcrumb_title = $ambience->title;
        $this->ambience_id = $ambience->id;
        $this->pivots = $ambience->pivots->unique('ambienceTenant_id')->pluck('ambienceTenant_id')->toArray();
        $this->ambiencePivot = AmbienceTenantPivot::select('id','ambienceTenant_id','ambience_id','value','deposit')
        ->where('ambience_id',$ambience->id)
        ->orderBy('id','desc')->get();
        // dd($this->ambiencePivot);
        // dd();
        $this->tenants = AmbienceTenant::select('id','title')->where('active',1)->orderBy('title','asc')->get();
    }
    public function render()
    {
        return view('livewire.admin.ambiences.ambience-values');
    }
    public function resetAll()
    {
        $this->reset(
            'value',
            'deposit',
        );

    }

    //UPDATE
    public function showModalUpdate(AmbienceTenant $ambienceTenant,$ambienceTenantPivot = null)
    {
        $this->resetAll();
        $this->ambienceTenant_id = $ambienceTenant->id;
        if ($ambienceTenantPivot) {
            $this->ambienceTenantPivot_id         = $ambienceTenantPivot;
            $ambiencePivotItem      = AmbienceTenantPivot::find($ambienceTenantPivot);
            $this->value            = $ambiencePivotItem->value;
            $this->deposit          = $ambiencePivotItem->deposit;
        }
        // dd($this->deposit);
        $this->showModalEdit = true;
    }
    public function update()
    {

         AmbienceTenantPivot::updateOrCreate([
            'id' => $this->ambienceTenantPivot_id,
        ], [
            'ambience_id'       => $this->ambience_id,
            'ambienceTenant_id' => $this->ambienceTenant_id,
            'value'             => valueDB($this->value),
            'deposit'           => ($this->deposit != "" ? valueDB($this->deposit) : '0.00'),
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
        $this->showModalEdit = false;

        redirect()->route('ambience-values',$this->ambience_id);
        $this->resetAll();
    }
     //MESSAGE
     public function openAlert($status, $msg)
     {
         $this->dispatch('openAlert', $status, $msg);
     }


}
