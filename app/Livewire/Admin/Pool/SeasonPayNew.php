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
    public $type = '';
    public $paid_id;
    public $season_id;

    public $bracelets = [];
    public $rows = [];


    public function mount()
    {
        $this->paid_in = date('d/m/Y');
    }

    public function render()
    {
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
            $this->value = $season->value ?? '00,0';
            $this->type = $season->type ?? '';
        }
    }
    public function updatedType($value)
    {
        $this->seasons = Season::select('id', 'title', 'type')
            ->orderBy('title', 'asc')
            ->where('type', $value)
            ->where('start', '<=', now())
            ->where('end', '>', now())
            ->where('active', 1)->get();
        $this->season_id =  '';
        $this->form_payment =  '';

        if ($value == 'Diário') {
            $this->addRow();
        } else {
            $this->bracelets = [];
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
            'title'         => 'PAGAMENTO REFERENTE À ' . Season::find($this->season_id)->title,
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
            'bracelets'     => $this->bracelets,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');

        redirect()->route('seasonPays');
    }

    //bracelets
    public function addRow()
    {
        $this->bracelets[] = ['number' => '', 'name' => ''];
        // $this->dispatch('bracelets', $this->bracelets);
    }
    public function removeRow($index)
    {
        unset($this->bracelets[$index]);
        $this->bracelets = array_values($this->bracelets);
        // $this->dispatch('bracelets', $this->bracelets);
        $this->recalculateSeasonTotal();
    }
    //função alterar valor do diário
    public function updateSeasonValue($index)
    {
        $seasonId = $this->bracelets[$index]['season_id'] ?? null;

        if ($seasonId) {
            $value = $this->getSeasonValue($seasonId);
            // guarda o valor por índice (útil para mostrar ao lado do item também)
            $this->bracelets[$index]['season_value'] = $value;
        } else {
            $this->bracelets[$index]['season_value'] = 0;
        }

        // recalcula a soma total
        $this->recalculateSeasonTotal();
    }
    protected function getSeasonById($id)
    {
        if (!$id) return null;

        // se $this->seasons for Collection/array de arrays ou models
        $found = collect($this->seasons)->firstWhere('id', $id);
        return $found;
    }
    protected function getSeasonValue($id): float
    {
        $s = $this->getSeasonById($id);
        if (!$s) {
            // fallback: buscar no DB se não estiver em $this->seasons (opcional)
            // return \App\Models\Season::find($id)?->value ?? 0;
            return 0.0;
        }

        // $s pode ser um model (objeto) ou array
        $val = $s->value ?? ($s['value'] ?? ($s->price ?? null));

        return $this->normalizeNumber($val);
    }
    //Recalcula valor ao excluir
    /** Recalcula o total somando season_value de todos os itens */
    public function recalculateSeasonTotal()
    {
        $sum = 0.0;
        foreach ($this->bracelets as $item) {
            $val = $item['season_value'] ?? 0;
            $sum += $this->normalizeNumber($val);
        }
        $this->value = number_format($sum, 2, ',', '.');
    }
    protected function normalizeNumber($val): float
    {
        if ($val === null || $val === '') return 0.0;
        if (is_numeric($val)) return (float) $val;

        // Remove espaços
        $v = trim($val);

        // Se contém vírgula como separador decimal, transforma: 1.234,56 -> 1234.56
        if (strpos($v, ',') !== false) {
            // remove pontos (separador de milhar) e troca vírgula por ponto
            $v = str_replace('.', '', $v);
            $v = str_replace(',', '.', $v);
        } else {
            // caso 1.234.56 (estranho) apenas remove espaços
            $v = str_replace(' ', '', $v);
        }

        return is_numeric($v) ? (float) $v : 0.0;
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
