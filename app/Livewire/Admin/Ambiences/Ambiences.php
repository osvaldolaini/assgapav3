<?php

namespace App\Livewire\Admin\Ambiences;

use App\Exports\AllExports;
use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceUnavailability;
use App\Models\Admin\Configs;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class Ambiences extends Component
{
    use WithPagination;
    public Ambience $ambience;
    public $breadcrumb_title = 'AMBIENTES';

    public $showModalUnavailability = false;
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
    public $model = "App\Models\Admin\Ambiences\Ambience"; //Model principal
    public $modelId = "ambiences.id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "ambience_categories,ambience_categories.id,ambiences.ambience_category"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'ambiences.title,ambience_categories.title as category,ambiences.active,ambiences.capacity';
    public $searchable = 'ambiences.title,ambience_categories.title,capacity'; //Colunas pesquisadas no banco de dados
    public $sort = "ambiences.title,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    public $title;
    public $start;
    public $end;
    public $ambience_title = '';

    public function render()
    {
        return view('livewire.admin.ambiences.ambiences', [
            'dataTable' => $this->getData(),
        ]);
    }
    //EXPORT
    public function printExport()
    {
        $title = $this->breadcrumb_title;
        $config = Configs::find(1);
        $today = Carbon::parse(now())->locale('pt-BR');
        $today = $today->translatedFormat('d F Y');
        $body = array();
        $this->paginate = 'single';
        $this->paginate = $this->getData()->count();
        foreach ($this->getData() as $item) {
            $body[] = [
                'name' => $item->title,
                'category' => $item->category,
                'capacity'=> $item->capacity,
            ];
        }
        $html = view(
            'livewire.admin.exports.pdf',
            [
                'title_postfix' => 'Relatório financeiro',
                'subtext'       => $title,
                'today'         => $today,
                'responsible'   => Auth::user()->name,
                'config'        => $config,
                'heads'         => array('Ambiente', 'Categoria','Capacidade'),
                'body'          => $body,
            ]
        )->render();
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'margin_left'   => 10,
            'margin_right'  => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);
        // Adicione o conteúdo HTML ao PDF
        $mpdf->WriteHTML($html);
        // Salve o PDF temporariamente
        $down = storage_path('app/public/livewire-tmp/exportar-em-pdf.pdf');
        $pdfPath = url('storage/livewire-tmp/exportar-em-pdf.pdf');
        $mpdf->Output($down, 'F');
        $this->dispatch('openPdfExports', pdfPath: $pdfPath);
        $this->paginate = 15;
    }
    public function excelExport()
    {
        $this->paginate = 'single';
        $this->paginate = $this->getData()->count();
        $data[] = array('Ambiente', 'Categoria','Capacidade');
        foreach ($this->getData() as $item) {
            $data[] = [
                'name' => $item->title,
                'category' => $item->category,
                'capacity'=> $item->capacity,
            ];
        }
        $this->paginate = 15;
        return Excel::download(new AllExports($data), 'exportar-em-excel.xlsx');
    }
    //END EXPORT
    public function resetAll()
    {
        $this->reset(
            'title',
            'color',
        );
    }

    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;
        if (isset($id)) {
            $data = Ambience::where('id', $id)->first();
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
    //CREATE
    public function modalCreate()
    {
        redirect()->route('new-ambience');
    }
    public function showModalUpdate(Ambience $ambience)
    {
        redirect()->route('edit-ambience', $ambience);
    }

    public function update()
    {
        $this->rules = [
            'title' => 'required',
            'color'  => 'required',
        ];

        $this->validate();

        Ambience::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'title'                 => $this->title,
            'color'                 => $this->color,
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
        $data = Ambience::where('id', $id)->first();
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
        $data = Ambience::where('id', $id)->first();
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

    //Indisponibilidades
    public function modalUnavailability($id)
    {
        $data = Ambience::where('id', $id)->first();
        $this->ambience_title = $data->title;
        $this->reset(
            'title',
            'start',
            'end',
        );

        if (isset($id)) {
            $this->registerId = $id;
        } else {
            $this->registerId = '';
        }
        $this->showModalUnavailability = true;
    }

    public function store()
    {
        $this->rules = [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];
        $this->validate();

        AmbienceUnavailability::create([
            'title'          => $this->title,
            'start'          => $this->start,
            'end'            => $this->end,
            'ambience_id'    => $this->registerId,
            'active'         => 1,
            'created_by' => Auth::user()->name,
        ]);

        $this->openAlert('success', 'Registro criado com sucesso.');

        $this->showModalUnavailability = false;
        $this->reset(
            'title',
            'start',
            'end',
        );
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

        if ($this->paginate == 'single') {
            return $query;
        } else {
            return $query->paginate($this->paginate);
        }
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
