<?php

namespace App\Livewire\Admin\Pool;

use App\Models\Admin\Financial\Received;
use App\Models\Admin\Pool\Season;
use App\Models\Admin\Pool\SeasonPay;
use App\Models\Admin\Registers\Partner;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class SeasonPayNew extends Component
{
    public $rules;
    public $seasons;

    public $breadcrumb_title = 'NOVO PAGAMENTO';
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
    public $title;
    public $active = 1;
    public $paid_in;
    public $value;
    public $form_payment;
    public $partner_id;
    public $type = 'Diário';
    public $paid_id;
    public $season_id;


    public function mount()
    {
        $this->paid_in = date('d/m/Y');
    }

    public function render()
    {
        $this->seasons = Season::select('id', 'title')
            ->orderBy('title', 'asc')
            ->where('start', '<=', now())
            ->where('end', '>', now())
            ->where('active', 1)->get();

        if ($this->inputSearch != '') {
            $this->results = Partner::select('id', 'name', 'cpf', 'image', 'partner_category_master')
                ->where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->limit(5)->get();
        }
        return view('livewire.admin.pool.season-pay-new');
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

    public function save_out()
    {
        $this->rules = [
            'paid_in'       => 'required|date_format:d/m/Y',
            'value'         => 'required',
            'form_payment'  => 'required',
            'partner_id'    => 'required',
            'type'          => 'required',
            'season_id'     => 'required',
        ];

        $this->validate();
        $received = Received::create([
            'active'        => 1,
            'title'         => 'PAGAMENTO REFERENTE À '. Season::find($this->season_id)->title,
            'paid_in'       => $this->paid_in,
            'value'         => $this->value,
            'form_payment'  => $this->form_payment,
            'partner_id'    => $this->partner_id,
            'partner'       => $this->partner,
            'created_by'    => Auth::user()->name,
        ]);

        $season = SeasonPay::create([
            'active'        => 1,
            'created_by'    => Auth::user()->name,
            'paid_in'       => $this->paid_in,
            'value'         => $this->value,
            'form_payment'  => $this->form_payment,
            'partner_id'    => $this->partner_id,
            'type'          => $this->type,
            'season_id'     => $this->season_id,
            'received_id'   => $received->id,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');

        redirect()->route('seasonPays');
    }


    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
