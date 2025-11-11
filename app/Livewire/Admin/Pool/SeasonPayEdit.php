<?php

namespace App\Livewire\Admin\Pool;

use App\Models\Admin\Pool\Season;
use App\Models\Admin\Pool\SeasonPay;
use App\Models\Admin\Registers\Partner;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SeasonPayEdit extends Component
{
    public $rules;
    public $seasons;
    public $breadcrumb_title;
    public $seasonPay;

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
    public $partner;

    //Campos
    public $id;
    public $title;
    public $active = 1;
    public $paid_in;
    public $value;
    public $form_payment;
    public $partner_id;
    public $type = 'Diário';
    public $received_id;
    public $season_id;
    public $bracelets;

    public function mount(SeasonPay $seasonPay)
    {
        $this->seasonPay = $seasonPay;
        $this->breadcrumb_title = 'Pago por: ' . $seasonPay->partners->name;
        $this->id = $seasonPay->id;
        $this->partner = $seasonPay->partners->name;
        $this->partner_id = $seasonPay->partner_id;
        $this->paid_in = $seasonPay->paid_in;
        $this->value = $seasonPay->value;
        $this->form_payment = $seasonPay->form_payment;
        $this->partner_id = $seasonPay->partner_id;
        $this->type = $seasonPay->type;
        $this->season_id = $seasonPay->season_id;

        $this->bracelets     = $seasonPay->bracelets;

        $this->seasons = Season::select('id', 'title')
            ->orderBy('title', 'asc')
            ->where('start', '<=', now())
            ->where('end', '>', now())
            ->where('active', 1)->get();
    }

    public function render()
    {
        if ($this->inputSearch != '') {
            $this->results = Partner::select('id', 'name', 'cpf', 'image', 'partner_category_master')
                ->where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->limit(5)->get();
        }
        // dd($this->events);
        return view('livewire.admin.pool.season-pay-edit');
    }

    public function openModalSearch($typeSearch)
    {
        $this->modalSearch = true;
        $this->typeSearch = $typeSearch;
    }

    public function updated($property)
    {
        if ($property === 'season_id') {
            $season = Season::find($this->season_id);
            $this->value = $season->value;
        }
    }
    public function selectPartner($id)
    {
        $partner = Partner::find($id);
        $this->partner = $partner->name;
        $this->partner_id = $partner->id;

        $this->typeSearch = '';
        $this->inputSearch = '';
        $this->results = '';

        $this->modalSearch = false;
    }


    public function save()
    {
        $this->persist();
    }
    public function save_out()
    {
        $this->persist();
        redirect()->route('seasonPays');
    }
    public function persist()
    {
        $this->rules = [
            'paid_in'         => 'required|date_format:d/m/Y',
            'value' => 'required',
            'form_payment' => 'required',
            'partner_id' => 'required',
            'type' => 'required',
            'season_id' => 'required',
        ];

        $this->validate();

        $this->validate();
        SeasonPay::updateOrCreate([
            'id' => $this->id,
        ], [
            'updated_by' => Auth::user()->name,
            'paid_in'         => $this->paid_in,
            'value' => $this->value,
            'form_payment' => $this->form_payment,
            'partner_id' => $this->partner_id,
            'type' => $this->type,
            'season_id' => $this->season_id,
            'bracelets'     => $this->bracelets,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
