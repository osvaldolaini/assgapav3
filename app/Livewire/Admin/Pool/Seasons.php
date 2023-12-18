<?php

namespace App\Livewire\Admin\Pool;

use App\Models\Admin\Configs;
use App\Models\Admin\Pool\Season;
use App\Models\Admin\Pool\SeasonPay;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Mpdf\Mpdf;

class Seasons extends Component
{
    use WithPagination;
    public Season $season;

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
    public $model = "App\Models\Admin\Pool\Season"; //Model principal
    public $modelId = "id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables; //Relacionamentos ( table , key , foreingKey )
    public $customSearch = "start|end"; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'title,start,end,active,value';
    public $searchable = 'title'; //Colunas pesquisadas no banco de dados
    public $sort = "title,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    //Campos
    public $active = 1;
    public $title;
    public $value;
    public $start;
    public $end;
    public $updated_because;

    public function render()
    {
        return view('livewire.admin.pool.seasons', [
            'dataTable' => $this->getData(),
        ]);
    }
    public function resetAll()
    {
        $this->reset(
            'title',
            'value',
            'start',
            'end',
        );
    }
    public function printSeason(Season $season)
    {
        $payed = SeasonPay::where('season_id',$season->id)
        ->with(['partners','received'])
        ->where('active',1)
        ->get();
        // Crie uma instância do mPDF
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'orientation' => 'L',
            'margin_left'   => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);
        $today = Carbon::parse(now())->locale('pt-BR');

        // Renderize a view do Livewire
        $html = view('livewire.admin.pool.season-pdf',
        [
            'data'              => $payed,
            'config'            => Configs::find(1),
            'contract_number'   => $season->title,
            'subtext'           => 'Pagamentos da ' .mb_strtoupper($season->title),
            'responsible'       => Auth::user()->name,
            'today'             => $today->translatedFormat('d F Y'),
        ])->render();

        // Adicione o conteúdo HTML ao PDF
        $mpdf->WriteHTML($html);
        $mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
                <td width="66%">Impressão realizada em {DATE j/m/Y} às {DATE H:i:s}</td>
                <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
            </tr>
        </table>');

        // Salve o PDF temporariamente
        $down = storage_path('app/public/livewire-tmp/relacao-pagamentos-temporada.pdf');
        $pdfPath = url('storage/livewire-tmp/relacao-pagamentos-temporada.pdf');

        $mpdf->Output($down, 'F');

        $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);

}
    //CREATE
    public function modalCreate()
    {
        $this->resetAll();
        $this->showModalCreate = true;
    }
    public function updated($property)
    {
        if ($property === 'end') {

            $start =implode("-", array_reverse(explode("/", $this->start)));
            $end = implode("-", array_reverse(explode("/", $this->end)));

            if ($end < $start) {
                $this->showModalCreate = false;
                $this->showModalEdit = false;
                $this->openAlert('error', 'A data final é menor que a inicial.');
                return;
            }
        }
        if ($property === 'start') {
            $this->end = '';
        }
    }

    public function store()
    {
        $this->rules = [
            'title' => 'required',
            'value' => 'required',
            'start' => 'required|date_format:d/m/Y',
            'end' => 'required|date_format:d/m/Y',
        ];
        $this->validate();

        Season::create([
            'title'         => $this->title,
            'value'         => $this->value,
            'start'         => $this->start,
            'end'           => $this->end,
            'active'        => 1,
            'created_by'    => Auth::user()->name,
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
            $data = Season::where('id', $id)->first();
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
    public function showModalUpdate(Season $season)
    {
        $this->resetAll();

        $this->title    = $season->title;
        $this->value    = $season->value;
        $this->start    = $season->start;
        $this->end      = $season->end;
        $this->model_id = $season->id;
        $this->title    = $season->title;
        $this->updated_because = $season->updated_because;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'title' => 'required',
            'value' => 'required',
            'start' => 'required|date_format:d/m/Y',
            'end' => 'required|date_format:d/m/Y',
            'updated_because' => 'required',
        ];

        $this->validate();

        Season::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'title'         => $this->title,
            'value'         => $this->value,
            'start'         => $this->start,
            'end'           => $this->end,
            'updated_because' => $this->updated_because,
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
        $data = Season::where('id', $id)->first();
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
        $data = Season::where('id', $id)->first();
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
