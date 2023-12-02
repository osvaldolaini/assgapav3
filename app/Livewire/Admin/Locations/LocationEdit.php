<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceTenantPivot;
use App\Models\Admin\Ambiences\AmbienceUnavailability;
use App\Models\Admin\Configs\AmbienceTenant;
use App\Models\Admin\Configs\ReasonEvent;
use App\Models\Admin\Locations\Location;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LocationEdit extends Component
{

    public $rules;
    public $dependents;
    public $location;

    public $breadcrumb_title;
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
    public $id;
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

    public $reason_event_id;
    public $loc_time;

    protected $listeners =
    [
        'checkDate',
        'insertDate'
    ];
    public function mount(Location $location)
    {
        $this->location = $location;
        $this->breadcrumb_title = 'LOCAÇÃO DE: ' . $location->partners->name;
        $this->id = $location->id;

        $this->ambience_id = $location->ambience_id;
        $this->partner = $location->partners->name;
        $this->partner_id = $location->partner_id;
        $this->ambience_tenant = $location->ambience_tenant;
        $this->ambience_tenant_id = $location->ambience_tenant_id;
        $this->location_date = $location->location_date;
        $this->location_hour_start = $location->location_hour_start;
        $this->location_hour_end = $location->location_hour_end;
        $this->event_type = $location->event_type;
        $this->event_benefited = $location->event_benefited;
        $this->value = $location->value;
        $this->deposit = $location->deposit;
        $this->value_extra = $location->value_extra;
        $this->indication_id = $location->indication_id;
        $this->indication = ($location->indication_id != NULL ? $location->indication->name : '');

        $this->reason_event_id = $location->reason_event_id;
        $this->loc_time = $location->loc_time;

        $this->multiple = $location->ambiences->multiple;

        $this->typeTenant = AmbienceTenant::select('type')->find($this->ambience_tenant_id)->type;

        if ($this->typeTenant == 1) {
            $this->dependents = Partner::find($this->partner_id)->dependents;
        }
    }

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
            $this->results = Partner::select('id', 'name', 'cpf', 'image', 'partner_category_master')
                ->where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->limit(5)->get();
        }

        // dd($this->events);
        return view('livewire.admin.locations.location-edit');
    }

    public function openModalSearch($typeSearch)
    {
        $this->modalSearch = true;
        $this->typeSearch = $typeSearch;
    }
    public function clean()
    {
        $this->indication = NULL;
        $this->indication_id = NULL;
    }

    public function updated($property)
    {
        if ($property === 'ambience_id') {
            $selectAmbience = Ambience::select('id', 'title', 'multiple')->find($this->ambience_id);
            $this->multiple = $selectAmbience->multiple;
            $this->ambience_tenant_id = '';
            $this->value = '';
            $this->deposit = '';
            $this->value_extra = '';
            $this->dependents = '';
            $this->location_date = '';

            $this->dispatch('changeAmbience', $this->ambience_id,$this->partner_id);
        }
        if ($property === 'ambience_tenant_id') {
            $this->typeTenant = AmbienceTenant::select('type')->find($this->ambience_tenant_id)->type;
            $pivot = AmbienceTenantPivot::select('value', 'deposit')
                ->where('ambience_id', $this->ambience_id)
                ->where('ambienceTenant_id', $this->ambience_tenant_id)
                ->first();
            $this->value = $pivot->value;
            $this->deposit = $pivot->deposit;

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


    public function save()
    {
        $this->persist();
    }
    public function save_out()
    {
        $this->persist();
        redirect()->route('locations');
    }
    public function persist()
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
        Location::updateOrCreate([
            'id' => $this->id,
        ], [
            'updated_by' => Auth::user()->name,
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

        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
