<?php

namespace App\Livewire\Admin\Registers;

use App\Models\Admin\Configs;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Mpdf\Mpdf;

class Dependents extends Component
{
    use WithPagination;
    public Partner $partner;
    public $breadcrumb_title;

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
    public $responsible;

    //Dados da tabela
    public $model = "App\Models\Admin\Registers\Partner"; //Model principal
    public $modelId="partners.id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "partner_categories,partner_categories.id,partners.partner_category"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'partners.name,partners.cpf,partner_categories.title as category,partner_categories.color as color,partners.active';
    public $searchable = 'partners.name,partners.cpf,partner_categories.title'; //Colunas pesquisadas no banco de dados
    public $sort = "partners.name,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 10; //Qtd de registros por página

    public function mount(Partner $partner)
    {
        $this->breadcrumb_title = 'DEPENDENTES DE: '.$partner->name;
        $this->responsible = $partner->id;
    }
    public function render()
    {
        return view('livewire.admin.registers.dependents', [
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
            $this->logs = logging($data->id,$this->model);
        } else {
            $this->detail = '';
        }
    }
    //CREATE
    public function modalCreate()
    {
        redirect()->route('new-dependent');
    }
    public function showModalUpdate(Partner $Partner)
    {
        redirect()->route('edit-dependent',$Partner);
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
        $data = Partner::where('id', $id)->first();
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
            $query = $query->where('active', '<=', 1);
        }
        $query = $query->where('partner_category_master','Dependente');
        $query->where('responsible', $this->partner->id);

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
