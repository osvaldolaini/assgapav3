<?php

namespace App\Livewire\Admin\Financial;

use App\Models\Admin\Financial\Received;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReceivedNew extends Component
{

    public $rules;

    public $breadcrumb_title = 'NOVA ENTRADA';

    //Search
    public $modalSearch = false;
    public $inputSearch;
    public $typeSearch;
    public $results;

    //Favorites
    public $modalFavorites = false;
    public $inputFavorites;
    public $favorites;

    //Campos
    public $title;
    public $paid_in;
    public $value;
    public $form_payment;
    public $partner_id;
    public $partner;
    public $obs;


    public function mount()
    {
        $this->paid_in = date('d/m/Y');
    }
    public function render()
    {
        if ($this->inputFavorites != '') {
            $this->favorites = Received::select('title','id')
                ->where('title', 'LIKE', '%' . $this->inputFavorites . '%')
                ->orderBy('title','ASC')
                ->limit(7)->get()
                ->groupBy('title')->toArray();
        }

        if ($this->inputSearch != '') {
            $this->results = Partner::select('id', 'name', 'cpf', 'image', 'partner_category_master')
                ->where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->limit(5)->get();
        }
        return view('livewire.admin.financial.received-new');
    }
    public function openModalSearch($typeSearch)
    {
        $this->modalSearch = true;
        $this->typeSearch = $typeSearch;
    }

    public function selectPartner($id)
    {
        $partner = Partner::find($id);

        $this->partner          = $partner->name;
        $this->partner_id       = $partner->id;

        $this->typeSearch = '';
        $this->inputSearch = '';
        $this->results = '';

        $this->modalSearch = false;
    }

    //favoritos
    public function openModalFavorites()
    {
        $this->favorites = Received::select('title','id')
            ->orderBy('title','ASC')
            ->limit(7)->get()
            ->groupBy('title')->toArray();
        $this->modalFavorites = true;
    }

    public function selectFavorites($id)
    {
        $this->title = mb_strtoupper(Received::find($id)->title);
        $this->modalFavorites = false;
    }

    public function save_out()
    {
        $this->rules = [
            'title' => 'required',
            'paid_in' => 'required|date_format:d/m/Y',
            'value' => 'required',
            'form_payment' => 'required',
            'partner_id' => 'required',
            'partner' => 'required',
        ];

        $this->validate();
        Received::create([
            'active' => 1,
            'title' => $this->title,
            'paid_in' => $this->paid_in,
            'value' => $this->value,
            'form_payment' => $this->form_payment,
            'partner_id' => $this->partner_id,
            'partner' => $this->partner,
            'obs' => $this->obs,
            'created_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
        redirect()->route('receiveds');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
