<?php

namespace App\Livewire\Admin\Ambiences;

use App\Models\Admin\Ambiences\AmbienceUnavailability;
use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Locations\Location;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AmbienceUnavailabilities extends Component
{
    public AmbienceUnavailability $AmbienceUnavailability;

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
    public $model = "App\Models\Admin\Ambiences\AmbienceUnavailability"; //Model principal
    public $modelId = "unavailabilities.id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "ambiences,ambiences.id,unavailabilities.ambience_id"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'unavailabilities.title as motive,type,start,end,ambience_id,ambiences.title,validity';
    public $searchable = 'unavailabilities.title'; //Colunas pesquisadas no banco de dados
    public $sort = "unavailabilities.end,desc|ambiences.title,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    //Campos
    public $active = 1;
    public $title;
    public $start;
    public $end;
    public $ambience_id;
    public $type = '';
    public $ambience;
    public $alert;
    public $validity;

    public function mount()
    {
        $this->ambience = Ambience::select('id', 'title')->orderBy('title', 'asc')
            ->where('active', 1)->get();
        $this->validity = date('d/m/Y', strtotime(date('Y-m-d') . ' +1 day'));
    }

    public function render()
    {
        return view('livewire.admin.ambiences.ambience-unavailability', [
            'dataTable' => $this->getData(),
        ]);
    }
    public function resetAll()
    {
        $this->reset(
            'title',
            'start',
            'end',
            'ambience_id',
        );
    }
    //CREATE
    public function modalCreate()
    {
        $this->resetAll();
        $this->showModalCreate = true;
    }
    public function updated()
    {
        if ($this->start) {
            $this->validates();
        }
    }
    public function store()
    {
        if ($this->type == 0) {
            $this->rules = [
                'type' => 'required',
                'title' => 'required',
                'start' => 'required',
                'ambience_id' => 'required',
            ];
            $this->end = $this->start;
        } else {
            $this->rules = [
                'type' => 'required',
                'title' => 'required',
                'start' => 'required',
                'end' => 'required',
                'ambience_id' => 'required',
                'validity' => 'required'
            ];
        }


        $this->validate();

        $this->validates();

        // dd($this->start);
        if ($this->validates() == true) {
            AmbienceUnavailability::create([
                'title'          => $this->title,
                'type'           => $this->type,
                'start'          => $this->start,
                'end'            => $this->end,
                'ambience_id'    => $this->ambience_id,
                'validity'       => $this->validity,
                'active'         => 1,
                'created_by' => Auth::user()->name,
            ]);

            $this->openAlert('success', 'Registro criado com sucesso.');

            $this->showModalCreate = false;
            $this->resetAll();
        }
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;
        if (isset($id)) {
            $data = AmbienceUnavailability::where('id', $id)->first();
            $this->detail = [
                'Criada'            => $data->created,
                'Criada por'        => $data->created_by,
                'Atualizada'        => $data->updated,
                'Atualizada por'    => $data->updated_by,
            ];
            $this->logs = logging($data->id, $this->model);
        } else {
            $this->detail = '';
        }
    }
    //UPDATE
    public function showModalUpdate(AmbienceUnavailability $ambienceUnavailability)
    {
        $this->resetAll();

        $this->model_id         = $ambienceUnavailability->id;
        $this->title            = $ambienceUnavailability->title;
        $this->start            = $ambienceUnavailability->start;
        $this->end              = $ambienceUnavailability->end;
        $this->ambience_id      = $ambienceUnavailability->ambience_id;
        $this->type             = $ambienceUnavailability->type;
        $this->validity         = $ambienceUnavailability->validity;
        $this->showModalEdit    = true;
    }
    public function update()
    {
        if ($this->type == 0) {
            $this->rules = [
                'type' => 'required',
                'title' => 'required',
                'start' => 'required',
                'ambience_id' => 'required',
            ];
        } else {
            $this->rules = [
                'type' => 'required',
                'title' => 'required',
                'start' => 'required',
                'end' => 'required',
                'ambience_id' => 'required',
                'validity' => 'required',
            ];
        }

        $this->validate();
        $this->validates();

        // dd($this->validates());
        if ($this->validates() == true) {
            AmbienceUnavailability::updateOrCreate([
                'id' => $this->model_id,
            ], [
                'title'          => $this->title,
                'start'          => $this->start,
                'type'           => $this->type,
                'end'            => $this->end,
                'ambience_id'    => $this->ambience_id,
                'validity'       => $this->validity,

                'updated_by' => Auth::user()->name,
            ]);

            $this->openAlert('success', 'Registro atualizado com sucesso.');

            $this->showModalEdit = false;
            $this->resetAll();
        }
    }
    public function validates()
    {
        $start = implode("-", array_reverse(explode("/", $this->start))) . ' 00:00:00';
        $end = implode("-", array_reverse(explode("/", $this->end))) . ' 00:00:00';
        $now = date('Y-m-d H:i:s');

        if ($this->type == 1) {
            if ($start > $end) {
                $this->openAlert('error', 'Término maior que a data de início');
                $this->alert = 'Término maior que a data de início.';
                return false;
            }
        }
        if ($start <= $now) {
            $this->openAlert('error', 'A ação não pode ser realizada com data inferior ao dia atual.');
            $this->alert = 'A data deve ser maior que o dia de hoje.';
            return false;
        }

        $replay = AmbienceUnavailability::where('start', $start)
            ->where('id', '!=', $this->model_id)
            ->where('active', 1)
            ->where('ambience_id', $this->ambience_id)
            ->first();
        if ($replay) {
            $this->openAlert('error', 'Essa data "' . $replay->start . '" já está ocupada para: ' . $replay->title);
            $this->alert = 'Já existe pré reserva nessa data.';
            return false;
        }

        $location = Location::where('location_date', $start)
            ->where('active', 1)
            ->where('ambience_id', $this->ambience_id)
            ->first();
        if ($location) {
            $this->openAlert('error', 'Existe uma locação nesta data "' . $location->location_date . '" para: ' . $location->partners->name);
            $this->alert = 'Já existe reserva nessa data.';
            return false;
        }
        $this->alert = '';
        return true;
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
        $data = AmbienceUnavailability::where('id', $id)->first();
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
        $data = AmbienceUnavailability::where('id', $id)->first();
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
            $query = $query->where('unavailabilities.active', '<=', 1);
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
