<?php

namespace App\Livewire\Admin\Sellers;

use App\Enums\Payments\PaymentStatus;
use App\Enums\Payments\PaymentType;
use App\Models\Admin\Jewels\Jewel;
use App\Models\Admin\Locations\Location;
use App\Models\Admin\Registers\Partner;
use App\Models\Admin\Sellers\SellerPaymentItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Payments extends Component
{
    public $partner;
    public $indications;
    public $registers;
    public $jewels;

    public $showJetModal = false;
    public $showModalView = false;
    public $showModalPay = false;
    public $showModalEdit = false;
    public $alertSession = false;
    public $rules;
    public $detail;
    public $logs;
    public $model_id;
    public $registerId;

    //Dados da tabela
    public $model = "App\Models\Admin\Sellers\SellerPayment"; //Model principal
    public $modelId = "seller_payments.id"; //Ex: 'table.id' or 'id'
    public $search;
    public $relationTables = "partners,partners.id,seller_payments.seller_id"; //Relacionamentos ( table , key , foreingKey )
    public $customSearch; //Colunas personalizadas, customizar no model
    public $columnsInclude = 'partners.name,partners.cpf,partner_category_master,partners.discount,partner_categories.title as category,partner_categories.color as color,partners.active';
    public $searchable = 'partners.name,partners.cpf,seller_payments.title'; //Colunas pesquisadas no banco de dados
    public $sort = "partners.name,asc"; //Ordenação da tabela se for mais de uma dividir com "|"
    public $paginate = 15; //Qtd de registros por página

    public $items;


    public function mount(Partner $partner)
    {
        $this->partner = $partner;
        $this->indications = $partner->indications->count();
        $this->registers = $partner->registers->count();
    }
    public function render()
    {
        $this->payments();
        // dd($this->items);
        return view('livewire.admin.sellers.payments');
    }
    public function payments()
    {
        $this->jewels = collect();
        foreach ($this->partner->registers as $register) {
            $this->jewels = $this->jewels->concat(
                $register->jewels->where('status', 1)
            );
        }

        $rentals = $this->partner->indications;
        $jewelIds = $this->jewels->pluck('id');
        $rentalIds = $rentals->pluck('id');

        $paymentItems = SellerPaymentItem::where(function ($query) use ($jewelIds) {
            $query->where('item_type', Jewel::class)
                ->whereIn('item_id', $jewelIds);
        })
            ->orWhere(function ($query) use ($rentalIds) {
                $query->where('item_type', Location::class)
                    ->whereIn('item_id', $rentalIds);
            })
            ->get()
            ->keyBy(function ($item) {
                return $item->item_type . ':' . $item->item_id;
            });

        $jewels = $this->jewels->map(function ($jewel) use ($paymentItems) {
            $key = Jewel::class . ':' . $jewel->id;
            $paymentItem = $paymentItems->get($key);
            return [
                'type' => PaymentType::JEWEL,
                'model' => $jewel,
                'partner' => Partner::findOrFail($jewel->partner_id),
                'date' => $jewel->paid_in,
                'value' => $jewel->value,
                'status' => match (true) {
                    !$paymentItem => PaymentStatus::WAITING,
                    $paymentItem->payment->released => PaymentStatus::RELEASED,
                    default => PaymentStatus::PAID,
                },
                'payment_item' => $paymentItem,
                'payment_value' => $paymentItem?->value,
            ];
        });

        $rentals = $rentals->map(function ($rental) use ($paymentItems) {
            $key = Location::class . ':' . $rental->id;
            $paymentItem = $paymentItems->get($key);
            return [
                'type' => PaymentType::RENTAL,
                'model' => $rental,
                'partner' => Partner::findOrFail($rental->partner_id),
                'date' => $rental->location_date,
                'value' => $rental->value,
                'status' => match (true) {
                    !$paymentItem => PaymentStatus::WAITING,
                    $paymentItem->payment->released => PaymentStatus::RELEASED,
                    default => PaymentStatus::PAID,
                },
                'payment_item' => $paymentItem,
                'payment_value' => $paymentItem?->value,
            ];
        });

        $this->items = $jewels
            ->concat($rentals)
            ->sortByDesc('date')
            ->values()->toJson();

        $this->items = json_decode($this->items);
    }
    //CREATE
    public function modalCreate()
    {
        // $this->paid_in = date('d/m/Y');
        // $c = count($this->pay);
        // $tot = 0;
        // if ($c == 0) {
        //     $this->openAlert('error', 'Nenhuma mensalidade selecionada.');
        //     return;
        // }
        // $i = 0;
        // if ($c > 1) {
        //     $pl = 's';
        // } else {
        //     $pl = '';
        // }
        // $this->title = 'Referente a' . $pl . ' mensalidade' . $pl . ' de: ';
        // foreach ($this->pay as $item) {
        //     $i++;
        //     $m = MonthlyPayment::find($item);
        //     $this->pays[] = $m;
        //     if ($i == $c) {
        //         $this->title .= $m->monthlyRef . '.';
        //     } else {
        //         $this->title .= $m->monthlyRef . ', ';
        //     }
        //     // $this->values[]=$m->monthlyRef;
        //     $tot += $m->convert_value($m->value);
        // }
        // $this->value = number_format($tot, 2, ',', '.');
        $this->showModalPay = true;
    }
    public function showModalUpdate(Partner $partner)
    {
        redirect()->route('edit-other', $partner);
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
            $query = $query->where('partners.active', '<=', 1);
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
            // $this->resetPage();
        }

        // dd($query->paginate(10));
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
