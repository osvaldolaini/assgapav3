<?php

namespace App\Livewire\Admin\Financial;

use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Received;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Receiveds extends Component
{
    public Received $received;
    public $config;
    public $breadcrumb_title = 'ENTRADAS';

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
    public $model = "App\Models\Admin\Financial\Received"; //Model principal
    public $modelId = "receiveds.id as id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "partners,partners.id,receiveds.partner_id"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch = 'paid_in'; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'paid_in,value,receiveds.active as active,receiveds.partner_id,partners.name,receiveds.title';
    public $searchable = 'receiveds.id,receiveds.title,partners.name,paid_in'; //Colunas pesquisadas no banco de dados
    public $sort = "receiveds.id,desc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    public $deleted_because;
    public $deleted_at;

    public function render()
    {
        return view('livewire.admin.financial.receiveds', [
            'dataTable' => $this->getData(),
        ]);
    }
    //CONTRACT
    public function printVoucher(Received $received)
    {
        $this->dispatch('printReceived', $received);
    }

    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;
        if (isset($id)) {
            $data = Received::where('id', $id)->first();
            $this->detail = [
                'Criada'            => $data->created,
                'Criada por'        => $data->created_by,
                'Atualizada'        => $data->updated,
                'Atualizada por'    => $data->updated_by,
                'Excluida'          => $data->deleted_at,
                'Excluida por'      => $data->deleted_by,
                'Motivo'            => $data->deleted_because,
            ];
            $this->logs = logging($data->id, $this->model);
        } else {
            $this->detail = '';
        }
    }
    //CREATE
    public function modalCreate()
    {
        redirect()->route('new-received');
    }
    public function showModalUpdate(Received $received)
    {
        redirect()->route('edit-received', $received);
    }

    //DELETE
    public function showModalDelete($id)
    {
        $this->showJetModal = true;

        if (isset($id)) {
            $this->registerId = $id;
        } else {
            $this->registerId = '';
        }
    }

    public function delete($id)
    {
        $this->rules = [
            'deleted_because' => 'required',
        ];

        $this->validate();

        $data = Received::where('id', $id)->first();
        $data->deleted_because = $this->deleted_because;
        $data->deleted_at = date('Y-m-d');
        $data->active = 2;
        $data->save();

        $this->openAlert('success', 'Registro excluido com sucesso.');

        $this->showJetModal = false;
    }
    //ACTIVE
    public function buttonActive($id)
    {
        $data = Received::where('id', $id)->first();
        if ($data->active == 1) {
            $data->active = 0;
            $data->save();
        } else {
            $data->active = 1;
            $data->save();
        }
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
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
        $selects = array($this->modelId . ' as id');
        if ($this->columnsInclude) {
            foreach (explode(',', $this->columnsInclude) as $key => $value) {
                array_push($selects, $value);
            }
        } else {
            $selects = '*';
        }
        // dd($selects);
        $query->select($selects);

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
