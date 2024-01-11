<?php

namespace App\Livewire\Admin\Material;

use App\Models\Admin\Material\Stock;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use App\Exports\AllExports;
use App\Models\Admin\Configs;
use Carbon\Carbon;

class MovementStock extends Component

{
    public Stock $stock;
    public $breadcrumb_title = 'MOVIMENTOS DO MATERIAL DE CONSUMO';

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
    public $model = "App\Models\Admin\Material\Stock"; //Model principal
    public $modelId="stocks.id as id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "products,products.id,stocks.product_id"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch = 'date'; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'stocks.quantity,stocks.status,date,stocks.product_id,stocks.created_by as criador,products.title as product';
    public $searchable = 'date,products.title,stocks.created_by'; //Colunas pesquisadas no banco de dados
    public $sort = "stocks.date,desc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

       public function render()
    {
        return view('livewire.admin.material.movement-stock', [
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
                'date' => $item->date,
                'product'  => $item->product,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'criador' => $item->criador,
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
                'heads'         => array('Data','Produtos', 'Qtd', 'Movimentação', 'Responsável'),
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
        $data[] =  array('Data','Produtos', 'Qtd', 'Movimentação', 'Responsável');
        foreach ($this->getData() as $item) {
            $data[] = [
                'date' => $item->date,
                'product'  => $item->product,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'criador' => $item->criador,
            ];
        }
        $this->paginate = 15;
        return Excel::download(new AllExports($data), 'exportar-em-excel.xlsx');
    }
    //END EXPORT

    //SEARCH PERSONALIZADO
    private function getData()
    {

        if (Auth::user()->group->level <= 5) {
            $query = $this->model::query();
        } else {
            $query = $this->model::query();
            $query = $query->where('active', '<=', 1);
        }
        $query = $query->where('type', 'consumo');
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
