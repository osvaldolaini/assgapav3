<?php

namespace App\Livewire\Admin\Pool;

use App\Models\Admin\Pool\SeasonPay;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class SeasonPays extends Component
{
    use WithPagination;
    public SeasonPay $season;

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
    public $model = "App\Models\Admin\Pool\SeasonPay"; //Model principal
    public $modelId = "season_pays.id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = 'partners,partners.id,season_pays.partner_id | seasons,seasons.id,season_pays.season_id'; //Relacionamentos ( table , key , foreingKey )
    public $customSearch = "paid_in"; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'season_pays.title,received_id,season_pays.active,season_pays.paid_in,partners.name,season_pays.value,seasons.title as season';
    public $searchable = 'partners.name,season_pays.paid_in,seasons.title'; //Colunas pesquisadas no banco de dados
    public $sort = "season_pays.id,desc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    //Campos
    public $active = 1;
    public $deleted_because;

    public function render()
    {
        return view('livewire.admin.pool.season-pays', [
            'dataTable' => $this->getData(),
        ]);
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;
        if (isset($id)) {
            $data = SeasonPay::where('id', $id)->first();
            $this->detail = [
                'Criada'            => $data->created,
                'Criada por'        => $data->created_by,
                'Atualizada'        => $data->updated,
                'Atualizada por'    => $data->updated_by,
                'Excluida'          => $data->deleted_at,
                'Excluida por'      => $data->deleted_by,
                'Motivo'            => $data->deleted_because,
            ];
            $this->logs = logging($data->id,$this->model);
        } else {
            $this->detail = '';
        }
    }
    //CREATE
    public function modalCreate()
    {
        redirect()->route('new-seasonPay');
    }
    public function showModalUpdate(SeasonPay $seasonPay)
    {
        redirect()->route('edit-seasonPay',$seasonPay);
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

       $data = SeasonPay::where('id', $id)->first();
       $data->deleted_because = $this->deleted_because;
       $data->deleted_at = date('Y-m-d');
       $data->active = 2;
       $data->save();

       $this->openAlert('success', 'Registro excluido com sucesso.');
       $this->openAlert('error', 'Excluir esse registro não exclui o
       recibo '.$data->received_id.'
       automaticamente.');

       $this->showJetModal = false;
   }
   //ACTIVE
   public function buttonActive($id)
   {
       $data = SeasonPay::where('id', $id)->first();
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
