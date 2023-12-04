<?php

namespace App\Livewire\Admin\Financial;

use App\Models\Admin\Configs\CostCenter;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Registers\Partner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BillEdit extends Component
{

    public $rules;
    public $categories;

    public $breadcrumb_title;

    //Search
    public $modalSearch = false;
    public $inputSearch;
    public $typeSearch;
    public $results;

    //Campos
    public $title;
    public $status = 0;
    public $paid_in;
    public $value;
    public $cost_center_id;
    public $type;
    public $creditor;
    public $creditor_id;
    public $creditor_document;
    public $updated_because;

    public $bill;
    public $id;

    public function mount(Bill $bill)
    {
        $this->bill = $bill;
        $this->breadcrumb_title = 'PAGO À: ' . $bill->creditor;
        $this->id = $bill->id;

        $this->title =  $bill->title;
        $this->paid_in =  $bill->paid_in;
        $this->value =  $bill->value;
        $this->cost_center_id =  $bill->cost_center_id;
        $this->type =  $bill->type;

        $this->creditor =  $bill->creditor;
        $this->creditor_id =  $bill->creditor_id;
        $this->creditor_document =  $bill->creditor_document;
        $this->updated_because =  $bill->updated_because;

        $this->categories = CostCenter::select('title', 'id')->get();
    }
    public function render()
    {
        if ($this->inputSearch != '') {
            $this->results = Partner::select('id', 'name', 'cpf', 'image', 'partner_category_master')
                ->where('name', 'LIKE', '%' . $this->inputSearch . '%')
                ->limit(5)->get();
        }
        return view('livewire.admin.financial.bill-edit');
    }
    public function openModalSearch($typeSearch)
    {
        $this->modalSearch = true;
        $this->typeSearch = $typeSearch;
    }

    public function selectPartner($id)
    {
        $partner = Partner::find($id);

        $this->creditor          = $partner->name;
        $this->creditor_id       = $partner->id;
        if ($partner->pf_pj == 'pf') {
            $this->creditor_document       = $partner->cpf;
        } else {
            $this->creditor_document       = $partner->cnpj;
        }

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
        redirect()->route('bills');
    }
    public function persist()
    {
        $this->rules = [
            'title' => 'required',
            'creditor' => 'required',
            'paid_in' => 'required|date_format:d/m/Y',
            'value' => 'required',
            'cost_center_id' => 'required',
            'type' => 'required',
            'updated_because'       => 'required',
        ];

        $this->validate();
        Bill::updateOrCreate([
            'id' => $this->id,
        ], [
            'updated_by' => Auth::user()->name,
            'title' => $this->title,
            'paid_in' => $this->paid_in,
            'value' => $this->value,
            'cost_center_id' => $this->cost_center_id,
            'type' => $this->type,
            'creditor' => $this->creditor,
            'creditor_id' => $this->creditor_id,
            'creditor_document' => $this->creditor_document,
            'updated_because' => $this->updated_because,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }

    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
