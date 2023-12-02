<?php

namespace App\Livewire\Admin\Pool;

use App\Models\Admin\Configs;
use App\Models\Admin\Pool\Pass;
use App\Models\Admin\Pool\Pool;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Passes extends Component
{
    public Pass $pass;

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
    public $model = "App\Models\Admin\Pool\Pass"; //Model principal
    public $modelId = "id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables; //Relacionamentos ( table , key , foreingKey )
    public $customSearch = "validity_of_card"; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'title,validity_of_card,category,active,color';
    public $searchable = 'title,category'; //Colunas pesquisadas no banco de dados
    public $sort = "id,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    //Campos
    public $active = 1;
    public $title;
    public $category = 'Diário';
    public $validity = 0;
    public $color;
    public $validity_of_card;


    public function render()
    {
        return view('livewire.admin.pool.passes', [
            'dataTable' => $this->getData(),
        ]);
    }
    public function printCards(Pass $pass)
    {
        $config = Configs::find(1);
        $cards[] = array(
            'id'  => $pass->id,
            'name'  => $pass->title,
            'category'  => $pass->category,
            'validity' => $pass->validity,
            'validity_of_card'  => $pass->validity_of_card,
            'color' => $pass->color,
            'qrcode' => 'qrcode-pass' . $pass->id . '.png',
        );

        QrCode::backgroundColor(255, 255, 255, 10)->generate(
            url('passe-piscina/' . $pass->id),
            storage_path('app/public/livewire-tmp/qrcode-pass' . $pass->id . '.png')
        );

        // Crie uma instância do mPDF
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            // 'format'        => 'L',
            'margin_left'   => 5,
            'margin_right'   => 0,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);

        // Renderize a view do Livewire
        $html = view('livewire.admin.pool.card', ['cards' => $cards, 'config' => $config])->render();

        // Adicione o conteúdo HTML ao PDF
        $mpdf->WriteHTML($html);

        // Salve o PDF temporariamente
        $down = storage_path('app/public/livewire-tmp/passe.pdf');
        $pdfPath = url('storage/livewire-tmp/passe.pdf');

        $mpdf->Output($down, 'F');

        $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);
    }
    public function printHistory(Pass $pass)
    {
        $access = Pool::where('register_id',$pass->id)->get();

        // Crie uma instância do mPDF
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            // 'format'        => 'L',
            'margin_left'   => 10,
            'margin_right'   => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);

        $today = Carbon::parse(now())->locale('pt-BR');

        // Renderize a view do Livewire
        $html = view('livewire.admin.pool.card-history',
        [
            'data'              => $access,
            'config'            => Configs::find(1),
            'contract_number'   => $pass->title,
            'subtext'           => 'Histórico de acessos de ' .mb_strtoupper($pass->title),
            'responsible'       => Auth::user()->name,
            'today'             => $today->translatedFormat('d F Y'),
        ])->render();
        // Adicione o conteúdo HTML ao PDF
        $mpdf->WriteHTML($html);

        // Salve o PDF temporariamente
        $down = storage_path('app/public/livewire-tmp/passe.pdf');
        $pdfPath = url('storage/livewire-tmp/passe.pdf');

        $mpdf->Output($down, 'F');

        $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);
    }
    public function resetAll()
    {
        $this->reset(
            'title',
            'category',
            'validity',
            'color',
            'validity_of_card',
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
            'category' => 'required',
            'validity' => 'required',
            'color' => 'required',
            'validity_of_card' => 'required|date_format:d/m/Y',
        ];
        $this->validate();

        Pass::create([
            'title' => $this->title,
            'category' => $this->category,
            'validity' => $this->validity,
            'color' => $this->color,
            'validity_of_card' => $this->validity_of_card,
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
            $data = Pass::where('id', $id)->first();
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
    public function showModalUpdate(Pass $pass)
    {
        $this->resetAll();

        $this->model_id = $pass->id;
        $this->title = $pass->title;
        $this->category = $pass->category;
        $this->validity = $pass->validity;
        $this->color = $pass->color;
        $this->validity_of_card = $pass->validity_of_card;
        $this->showModalEdit = true;
    }
    public function update()
    {
        $this->rules = [
            'title' => 'required',
            'category' => 'required',
            'validity' => 'required',
            'color' => 'required',
            'validity_of_card' => 'required|date_format:d/m/Y',
        ];

        $this->validate();

        Pass::updateOrCreate([
            'id' => $this->model_id,
        ], [
            'title' => $this->title,
            'category' => $this->category,
            'validity' => $this->validity,
            'color' => $this->color,
            'validity_of_card' => $this->validity_of_card,
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
        $data = Pass::where('id', $id)->first();
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
        $data = Pass::where('id', $id)->first();
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
