<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceTenantPivot;
use App\Models\Admin\Configs\AmbienceTenant;
use App\Models\Admin\Configs\ReasonEvent;
use App\Models\Admin\Locations\Installment;
use App\Models\Admin\Locations\Location;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LocationNew extends Component
{

    public $rules;
    public $dependents;

    public $breadcrumb_title = 'NOVA LOCAÇÃO';
    //Calendar
    public $events = [];

    //Selects
    public $ambienceTenants = '';
    public $ambiences = '';
    public $eventTypes = '';
    public $eventBenefiteds = '';
    public $multiple = false;
    public $typeTenant = 2;

    //Search
    public $modalSearch = false;
    public $inputSearch;
    public $typeSearch;
    public $results;

    //Campos
    public $ambience;
    public $ambience_id;
    public $partner;
    public $partner_id;
    public $ambience_tenant;
    public $ambience_tenant_id;
    public $location_date;
    public $location_hour_start;
    public $location_hour_end;
    public $event_type;
    public $event_benefited;
    public $value;
    public $deposit;
    public $value_extra;
    public $indication_id;
    public $indication;
    public $guests;

    public $reason_event_id;
    public $loc_time;


    protected $listeners =
    [
        'checkDate',
        'insertDate'
    ];

    public function render()
    {
        $this->ambiences = Ambience::select('id', 'title')->orderBy('title', 'asc')
            ->where('active', 1)->get();
        $this->ambienceTenants = AmbienceTenant::select('id', 'title')
            ->orderBy('title', 'asc')
            ->where('active', 1)->get();
        $this->eventTypes = ReasonEvent::select('id', 'title')
            ->orderBy('title', 'asc')
            ->where('active', 1)->get();

        if ($this->inputSearch != '') {
            $this->results = Partner::select('id', 'name', 'cpf', 'image', 'partner_category_master', 'discount')
                ->where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->limit(5)->get();
        }
        return view('livewire.admin.locations.location-new');
    }

    public function openModalSearch($typeSearch)
    {
        $this->modalSearch = true;
        $this->typeSearch = $typeSearch;
    }

    public function updated($property)
    {
        if ($property === 'ambience_id') {
            $selectAmbience = Ambience::select('id', 'title', 'multiple')
                ->find($this->ambience_id);
            $this->multiple = $selectAmbience->multiple;
            $this->ambience_tenant_id = '';
            $this->value = '';
            $this->deposit = '';
            $this->value_extra = '';
            $this->dependents = '';
            $this->location_date = '';
            $this->ambience = $selectAmbience->title;

            $this->dispatch('changeAmbience', $this->ambience_id, $this->partner_id);
        }

        if ($property === 'ambience_tenant_id') {
            $this->typeTenant = AmbienceTenant::select('type')
                ->find($this->ambience_tenant_id)->type;
            $pivot = AmbienceTenantPivot::select('value', 'deposit')
                ->where('ambience_id', $this->ambience_id)
                ->where('ambienceTenant_id', $this->ambience_tenant_id)
                ->first();
            $this->value = $pivot->value ?? '0,00';
            $this->deposit = $pivot->deposit ?? '0,00';
            // $this->ambience_tenant = $this->typeTenant->title;

            if ($this->typeTenant == 1) {
                $this->dependents = Partner::find($this->partner_id)->dependents;
            }
        }
    }
    public function selectPartner($id)
    {
        $partner = Partner::find($id);

        if ($this->typeSearch == 'partner') {
            $this->partner = $partner->name;
            $this->partner_id = $partner->id;
        } else {
            $this->indication = $partner->name;
            $this->indication_id = $partner->id;
        }

        $this->typeSearch = '';
        $this->inputSearch = '';
        $this->results = '';

        $this->modalSearch = false;
    }
    public function insertDate($date)
    {
        $this->location_date = date('d/m/Y',  strtotime($date));
    }

    public function save_out()
    {
        $this->rules = [
            'ambience_id'           => 'required',
            'partner_id'            => 'required',
            'ambience_tenant_id'    => 'required',
            'location_date'         => 'required|date_format:d/m/Y',
            'event_benefited'       => 'required',
            'value'                 => 'required',
            'deposit'               => 'required',
            'reason_event_id'       => 'required',
        ];

        $this->validate();
        $location = Location::create([
            'active' => 1,
            'guests' => $this->guests,
            'created_by' => Auth::user()->name,
            'ambience' => $this->ambience,
            'ambience_id' => $this->ambience_id,
            'partner' => $this->partner,
            'partner_id' => $this->partner_id,
            'ambience_tenant' => $this->ambience_tenant,
            'ambience_tenant_id' => $this->ambience_tenant_id,
            'location_date' => $this->location_date,
            'location_hour_start' => $this->location_hour_start,
            'location_hour_end' => $this->location_hour_end,
            'event_type' => $this->event_type,
            'event_benefited' => $this->event_benefited,
            'value' => $this->value,
            'deposit' => $this->deposit,
            'value_extra' => $this->value_extra,
            'indication_id' => $this->indication_id,
            'indication' => $this->indication,
            'reason_event_id' => $this->reason_event_id,
            'loc_time' => $this->loc_time,
        ]);

        if ($location->convert_value($location->value) > 0) {
            Installment::create([
                'active'        => 0,
                'title'         => 'Sinal',
                'value'         => $location->value,
                'location_id'   => $location->id,
                'created_by'    => Auth::user()->name
            ]);
        }

        $this->openAlert('success', 'Registro atualizado com sucesso.');
        redirect()->route('locations');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
