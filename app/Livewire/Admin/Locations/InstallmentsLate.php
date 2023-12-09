<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Locations\Installment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class InstallmentsLate extends Component
{
    public Installment $installment;
    public $breadcrumb_title = 'PARCELAS EM ATRASO';

    public $showJetModal = false;
    public $showModalView = false;
    public $showModalCreate = false;
    public $showModalEdit = false;
    public $alertSession = false;
    public $rules;
    public $detail;
    public $logs;
    public $model_id;
    public $registerId;

    //Dados da tabela
    public $model = "App\Models\Admin\Locations\Installment"; //Model principal
    public $modelId="locations.id as id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "locations,locations.id,installments.location_id | ambiences,ambiences.id,locations.ambience_id | partners,partners.id,locations.partner_id"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch='location_date,partners.name,ambiences.title as ambiente, locations.active as active_location'; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'installment_maturity_date,installments.location_id,partners.name,ambiences.title,installments.location_id';
    public $searchable = 'installment_maturity_date,installments.value,ambiences.title,partners.name'; //Colunas pesquisadas no banco de dados
    public $sort = "installments.installment_maturity_date,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    public $deleted_because;
    public $deleted_at;

    public function render()
    {
        // dd($this->getData());
        return view('livewire.admin.locations.installments-late', [
            'dataTable' => $this->getData(),
        ]);
    }
        //SEARCH PERSONALIZADO
    private function getData()
    {

        if (Auth::user()->group->level <= 5) {
            $query = $this->model::query();
        } else {
            $query = $this->model::query();
            $query = $query->where('active', '<=', 1);
        }
        $selects = array($this->modelId .' as id');
        if ($this->columnsInclude) {
            foreach (explode(',', $this->columnsInclude) as $key => $value) {
                array_push($selects, $value);
            }
        } else {
            $selects = '*';
        }
        // dd($selects);
        $query->select($selects);

        $venc=date("Y-m-d",strtotime('+2 days',strtotime(date('Y-m-d'))));
        $query->where('installments.active', 0);
        $query->where('installments.installment_maturity_date', '<', $venc);
        $query->where('installments.value', '>', 0);

        if ($this->relationTables != "") {
            $query = $this->relationTables($query);
        }
        if ($this->sort != "") {
            $query = $this->sort($query);
        }
        if ($this->searchable && $this->search) {
            $this->search($query);
        }

        // dd($query);
        return $query->paginate($this->paginate);
    }
    #PRICIPAL FUNCTIONS
        public function search($query)
        {
            $searchTerms = explode(',', $this->searchable);
            $query->where(function ($innerQuery) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    if ($this->customSearch) {
                        $fields = explode('|', $this->customSearch);
                        if (in_array($term, $fields)) {
                            $search = array($term => $this->search);
                            $formattedSearch = $this->model::filterFields($search);
                            if ($formattedSearch['converted'] != '%0%') {
                                $innerQuery->orWhere($term, $formattedSearch['f'], $formattedSearch['converted']);
                            } else {
                                $innerQuery->orWhere($term, 'LIKE', '%' . $this->search . '%');
                            }
                        } else {
                            $innerQuery->orWhere($term, 'LIKE', '%' . $this->search . '%');
                        }
                    } else {
                        $innerQuery->orWhere($term, 'LIKE', '%' . $this->search . '%');
                    }
                }
            });
            // dd($query);
        }
    #END PRICIPAL FUNCTIONS
    #EXTRA FUNCTIONS
        //SORT
        public function sort($query)
        {
            $this->sort = str_replace(' ', '', $this->sort);
            $sortData = explode('|', $this->sort);
            $c = count($sortData);
            for ($i = 0; $i < $c; $i++) {
                $s = explode(',', $sortData[$i]);
                if (count($s) === 2) {
                    $query->orderBy($s[0], $s[1]);
                }
            }
            return $query;
        }
        //RELATIONSHIPS
        public function relationTables($query)
        {
            $this->relationTables = str_replace(' ', '', $this->relationTables);
            $relationTables = explode('|', $this->relationTables);
            $crt = count($relationTables);
            for ($i = 0; $i < $crt; $i++) {
                $rt = explode(',', $relationTables[$i]);
                if (count($rt) === 3) {
                    $query->leftJoin($rt[0], $rt[1], '=', $rt[2]);
                }
            }
            return $query;
        }
}
