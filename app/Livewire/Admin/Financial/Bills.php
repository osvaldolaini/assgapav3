<?php

namespace App\Livewire\Admin\Financial;

use App\Exports\AllExports;
use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Bill;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class Bills extends Component
{
    use WithPagination;
    public Bill $bill;
    public $breadcrumb_title = 'CAIXA';

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
    public $model = "App\Models\Admin\Financial\Bill"; //Model principal
    public $modelId = "bills.id as id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "cost_centers,cost_centers.id,bills.cost_center_id"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch = 'paid_in|type'; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'paid_in,value,bills.active as active,creditor,type,bills.title as Bills_title,cost_centers.category,cost_centers.color';
    public $searchable = 'bills.id,bills.title,creditor,cost_centers.category,paid_in,type'; //Colunas pesquisadas no banco de dados
    public $sort = "bills.id,desc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    public $deleted_because;
    public $deleted_at;

    public function render()
    {
        return view('livewire.admin.financial.bills', [
            'dataTable' => $this->getData(),
        ]);
    }
    //EXPORT
    public function printExport()
    {
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        $title = $this->breadcrumb_title;
        $config = Configs::find(1);
        $today = Carbon::parse(now())->locale('pt-BR');
        $today = $today->translatedFormat('d F Y');
        $body = array();
        $this->paginate = 'single';
        $this->paginate = $this->getData()->count();
        foreach ($this->getData() as $item) {
            $body[] = [
                'id'        => $item->id,
                'title'     => $item->Bills_title,
                'value'     => $item->value,
                'paid_in'   => $item->paid_in,
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
                'heads'         => array('Nº', 'Motivo','Valor','Vencimento / pagamento'),
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
        $data[] = array('Nº', 'Motivo','Valor','Vencimento / pagamento');
        foreach ($this->getData() as $item) {
            $data[] = [
                'id'        => $item->id,
                'title'     => $item->Bills_title,
                'value'     => $item->value,
                'paid_in'   => $item->paid_in,
            ];
        }
        $this->paginate = 15;
        return Excel::download(new AllExports($data), 'exportar-em-excel.xlsx');
    }
    //END EXPORT

    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;
        if (isset($id)) {
            $data = Bill::where('id', $id)->first();
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
        redirect()->route('new-bill');
    }
    public function showModalUpdate(Bill $bill)
    {
        redirect()->route('edit-bill', $bill);
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

        $data = Bill::where('id', $id)->first();
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
        $data = Bill::where('id', $id)->first();
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
            $query = $query->where('bills.active', '<=', 1);
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
