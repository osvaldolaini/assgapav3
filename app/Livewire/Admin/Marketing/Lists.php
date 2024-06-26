<?php

namespace App\Livewire\Admin\Marketing;

use App\Exports\AllExports;
use App\Models\Admin\Configs;
use App\Models\Admin\Configs\PartnerCategory;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class Lists extends Component
{

    public Partner $partner;
    public $breadcrumb_title = 'LISTAS';

    public $pf_pj = false;
    public $email = false;
    public $phone = false;
    public $address = false;
    public $rg = false;
    public $date_of_birth = false;

    public $model_id;

    //Dados da tabela
    public $model = "App\Models\Admin\Registers\Partner"; //Model principal
    public $modelId = "partners.id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "partner_categories,partner_categories.id,partners.partner_category"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'partners.name,date_of_birth,partners.cpf,pf_pj,cnpj,rg,phone_first,address,city,state,number,email,partner_category_master,partners.discount,partner_categories.title as category,partner_categories.color as color,partners.active';
    public $searchable = 'partners.name,partners.cpf,partner_categories.title'; //Colunas pesquisadas no banco de dados
    public $sort = "partners.name,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 15; //Qtd de registros por página

    public function render()
    {
        return view('livewire.admin.marketing.lists', [
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
        $heads = array('Sócio');

        foreach ($this->getData() as $item) {
            $id = $item->id;

            // Initialize $body[$id] if it doesn't exist
            if (!isset($body[$id])) {
                $body[$id] = [];
            }

            $body[$id] = [
                'name' => $item->name,
            ];
            if ($this->date_of_birth) {
                $body[$id]['date_of_birth'] =
                    ($item->date_of_birth ? $item->date_of_birth . ' ( ' .  $item->age . ' anos)' : '');
            }
            if ($this->pf_pj) {
                if ($item->pf_pj == 'pf') {
                    $body[$id]['cpf'] = $item->cpf;
                } else {
                    $body[$id]['cnpj'] = $item->cnpj;
                }
            }
            if ($this->email) {
                $body[$id]['email'] = $item->email;
            }
            if ($this->phone) {
                $body[$id]['phone'] = $item->phone_first;
            }
            if ($this->address) {
                $body[$id]['address'] = $item->address . ' ' . $item->number . ',' . $item->city . '-' . $item->state;
            }
            if ($this->rg) {
                $body[$id]['phone_first'] = $item->rg;
            }
        }
        if ($this->date_of_birth) {
            $heads[] = 'Data de Nascimento';
        }
        if ($this->pf_pj) {
            $heads[] = 'CPF / CNPJ';
        }
        if ($this->email) {
            $heads[] = 'email';
        }
        if ($this->phone) {
            $heads[] = 'Telefones';
        }
        if ($this->address) {
            $heads[] = 'Endereço';
        }
        if ($this->rg) {
            $heads[] = 'RG';
        }

        $html = view(
            'livewire.admin.exports.pdf',
            [
                'title_postfix' => 'Relatório financeiro',
                'subtext'       => $title,
                'today'         => $today,
                'responsible'   => Auth::user()->name,
                'config'        => $config,
                'heads'         => $heads,
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
        $data[0] =  array('Sócio');
        if ($this->date_of_birth) {
            array_push($data[0], 'Data de Nascimento');
        }
        if ($this->pf_pj) {
            array_push($data[0], 'CPF / CNPJ');
        }
        if ($this->email) {
            array_push($data[0], 'email');
        }
        if ($this->phone) {
            array_push($data[0], 'Telefones');
        }
        if ($this->address) {
            array_push($data[0], 'Endereço');
        }
        if ($this->rg) {
            array_push($data[0], 'RG');
        }
        foreach ($this->getData() as $item) {
            $id = $item->id;

            // Initialize $body[$id] if it doesn't exist
            if (!isset($data[$id])) {
                $data[$id] = [];
            }

            $data[$id] = [
                'name' => $item->name,
            ];
            if ($this->date_of_birth) {
                $body[$id]['date_of_birth'] =
                    ($item->date_of_birth ? $item->date_of_birth . ' ( ' .  $item->age . ' anos)' : '');
            }
            if ($this->pf_pj) {
                if ($item->pf_pj == 'pf') {
                    $data[$id]['cpf'] = $item->cpf;
                } else {
                    $data[$id]['cnpj'] = $item->cnpj;
                }
            }
            if ($this->email) {
                $data[$id]['email'] = $item->email;
            }
            if ($this->phone) {
                $data[$id]['phone'] = $item->phone_first;
            }
            if ($this->address) {
                $data[$id]['address'] = $item->address . ' ' . $item->number . ',' . $item->city . '-' . $item->state;
            }
            if ($this->rg) {
                $data[$id]['phone_first'] = $item->rg;
            }
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
            $query = $query->where('partners.active', '<=', 1);
        }
        $query->where('partner_category_master', 'Sócio');

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

        // dd($query->paginate($this->paginate));
        // $query->take(3);
        // return $query->simplePaginate($this->paginate);
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
