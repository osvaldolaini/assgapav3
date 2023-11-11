<?php

namespace App\Livewire\Admin\Configs;

use App\Models\Admin\Configs\CostCenter;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class CostCenters extends Component
{
    public CostCenter $costCenter;

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
    public $model = "App\Models\Admin\Configs\CostCenter"; //Model principal
    public $modelId="id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables; //Relacionamentos ( table , key , foreingKey )
    public $customSearch; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'title,color,category,active';
    public $searchable = 'title,category'; //Colunas pesquisadas no banco de dados
    public $sort = "title,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página
    //Campos
    public $active = 1;
    public $title;
    public $color;
    public $category;

    public function render()
    {
        return view('livewire.admin.configs.cost-centers', [
            'dataTable' => $this->getData(),
        ]);
    }
    public function resetAll()
    {
        $this->reset(
            'title',
            'category',
            'color',
        );
    }
    //CREATE
    public function modalCreate()
    {
        $this->resetAll();
        $this->showModalCreate = true;
    }

    public function store()
    {
        $this->rules = [
            'title' => 'required',
            'category'  => 'required',
            'color' => 'required',
        ];
        $this->validate();

        CostCenter::create([
            'title'                 => $this->title,
            'category'              => $this->category,
            'color'                 => $this->color,
            'active'                => 1,
            'created_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro criado com sucesso.');

        $this->showModalCreate = false;
        $this->resetAll();
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;
        if (isset($id)) {
            $data = CostCenter::where('id', $id)->first();
            $this->detail = [
                'Criada'            => $data->created,
                'Criada por'        => $data->created_by,
                'Atualizada'        => $data->updated,
                'Atualizada por'    => $data->updated_by,
            ];
            $this->logs = logging($data->id,$this->model);
        } else {
            $this->detail = '';
        }
    }
    //UPDATE
    public function showModalUpdate(CostCenter $costCenter)
    {
        $this->resetAll();

        $this->model_id         = $costCenter->id;
        $this->title            = $costCenter->title;
        $this->category         = $costCenter->category;
        $this->color            = $costCenter->color;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'title' => 'required',
            'category'  => 'required',
            'color'  => 'required',
        ];

        $this->validate();

        CostCenter::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'title'                 => $this->title,
            'color'                 => $this->color,
            'category'              => $this->category,
            'updated_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro atualizado com sucesso.');

        $this->showModalEdit = false;
        $this->resetAll();
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
    //ACTIVE
    public function buttonActive($id)
    {
        $data = CostCenter::where('id', $id)->first();
        if ($data->active == 1) {
            $data->active = 0;
            $data->save();
        } else {
            $data->active = 1;
            $data->save();
        }
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }
    public function delete($id)
    {
        $data = CostCenter::where('id', $id)->first();
        $data->active = 2;
        $data->save();

        $this->openAlert('success', 'Registro excluido com sucesso.');

        $this->showJetModal = false;
        $this->resetAll();
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
