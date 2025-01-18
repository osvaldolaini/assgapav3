<?php

namespace App\Livewire\Admin\Registers;

use App\Exports\AllExports;
use App\Models\Admin\Configs;
use App\Models\Admin\Configs\PartnerCategory;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use Maatwebsite\Excel\Facades\Excel;

class PartnersLate extends Component
{
    public Partner $partner;

    public $partnerLate;
    public $breadcrumb_title = 'SÓCIOS EM ATRASO';

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
    public $model = "App\Models\Admin\Registers\Partner"; //Model principal
    public $modelId = "partners.id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "partner_categories,partner_categories.id,partners.partner_category"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'partners.name,partners.cpf,partner_category_master,partners.discount,partner_categories.title as category,partner_categories.color as color,partners.active';
    public $searchable = 'partners.name,partners.cpf,partner_categories.title'; //Colunas pesquisadas no banco de dados
    public $sort = "partners.name,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 15; //Qtd de registros por página

    public function render()
    {
        // $this->partnerLate = $this->partnerLate();
        // // dd($this->partnerLate);
        return view('livewire.admin.registers.partners-late', [
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
                'name' => $item->name,
                'category' => $item->category,
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
                'heads'         => array('Sócio', 'Categoria'),
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
        $data[] =  array('Sócio', 'Categoria');
        foreach ($this->getData() as $item) {
            $data[] = [
                'name' => $item->name,
                'category' => $item->category,
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
            $data = Partner::where('id', $id)->first();
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
        redirect()->route('new-partner');
    }
    public function showModalUpdate(Partner $Partner)
    {
        redirect()->route('edit-partner', $Partner);
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
        $data = Partner::where('id', $id)->first();
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
        $master = PartnerCategory::where('parent_category', 'Não sócio')->first();
        $data = Partner::where('id', $id)->first();
        $data->partner_category = $master->id;
        $data->active = 0;
        $data->save();

        $this->openAlert('success', 'Registro excluido com sucesso.');

        $this->showJetModal = false;
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

        //Verifica os devedores
        $query->whereIn('partners.id', $this->partnerLate());

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

    public function partnerLate()
    {
        $row = array();
        $late = array();
        $partners = Partner::select('id', 'registration_at', 'partner_category')
            ->where('active', 1)
            //->where('id',8246)
            ->with(['category'])
            ->where('discount', 0)
            ->where('partner_category_master', 'Sócio')
            ->orderBy('partner_category', 'asc')
            ->orderBy('name', 'asc')
            ->get();


        foreach ($partners as $partner) {
            $refs = array();
            $day = date('d', strtotime($partner->registration_at));
            if (date('Y', strtotime($partner->registration_at)) >= 2017) {
                $start = date('Y', strtotime($partner->registration_at));
                $mStart = date('m', strtotime($partner->registration_at)) + 1;
            } else {
                $start = 2017;
                $mStart = 1;
            }
            for ($i = $start; $i < date('Y') + 1; $i++) {
                if ($start == $i) {
                    for ($m = $mStart; $m < 13; $m++) {
                        if ($i . '-' . sprintf("%02d", $m) . '-' . date('d') <= date('Y-m') . '-' . $day) {
                            $refs[$i . '-' . sprintf("%02d", $m)] = $i . '-' . sprintf("%02d", $m);
                        }
                    }
                } else {
                    for ($m = 1; $m < 13; $m++) {
                        if ($i . '-' . sprintf("%02d", $m) . '-' . date('d') <= date('Y-m') . '-' . $day) {
                            $refs[$i . '-' . sprintf("%02d", $m)] = $i . '-' . sprintf("%02d", $m);
                        }
                    }
                }
            }

            // foreach ($partner->monthlys as $monthly) {
            //     if ($monthly->status != 0) {
            //         if (array_search($monthly->ref, $refs)) {
            //             unset($refs[$monthly->ref]);
            //         }
            //     }
            // }
            // if ($refs) {
            //     $row[] = $refs;
            //     $late[] = $partner->id;
            // }
            /**Modificação feita por solicitação do clube em 17/01/25 */
            foreach ($partner->monthlys as $monthly) {
                foreach ($partner->monthlys as $monthly) {
                    if ($monthly->status == 0) {
                        if (array_search($monthly->ref, $refs)) {
                            $nrefs[$monthly->ref] = $monthly->ref;
                        }
                    }
                }
            }
            if ($nrefs) {
                $row[] = $nrefs;
                $late[] = $partner->id;
            }
        }


        return $late;
    }
}
