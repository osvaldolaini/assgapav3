<?php

namespace App\Livewire\Admin\Sellers;

use App\Enums\Payments\PaymentStatus;
use App\Enums\Payments\PaymentType;
use App\Models\Admin\Configs;
use App\Models\Admin\Configs\CostCenter;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Jewels\Jewel;
use App\Models\Admin\Locations\Location;
use App\Models\Admin\Registers\Partner;
use App\Models\Admin\Sellers\SellerPayment;
use App\Models\Admin\Sellers\SellerPaymentItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\DB;


class Payments extends Component
{
    public $partner;
    public $indications;
    public $registers;
    public $jewels;

    public $showJetModal = false;
    public $showModalView = false;
    public $showModalPaid = false;
    public $showModalReleased = false;
    public $alertSession = false;
    public $rules;
    public $detail;
    public $logs;
    public $model_id;
    public $registerId;

    public $items;
    public $status;
    public $pay = [];
    public $selectedItems = [];

    //Campos
    public $title;
    public $paid_in;
    public $value;
    public $cost_center_id;
    public $type;
    public $creditor;
    public $creditor_id;
    public $creditor_document;
    public $pf_pj = 'pf';


    public $modalFavorites = false;
    public $inputFavorites;
    public $categories;
    public $favorites;
    public $pages;

    public string $search = '';


    public function mount(Partner $partner)
    {
        $this->partner = $partner;
        $this->indications = $partner->indications->count();
        $this->registers = $partner->registers->count();

        $this->creditor = $this->partner->name;
        $this->creditor_id = $this->partner->id;
        $this->creditor_document = $this->partner->pf_pj == 'pf' ? $this->partner->cpf : $this->partner->cnpj;
        $this->pf_pj = $this->partner->pf_pj;
        // dd($this->partner);

        $this->paid_in = date('d/m/Y');
        $this->categories = CostCenter::select('title', 'id')->get();

        $this->pages = Auth::user()->access->pluck('page_id')->toArray();
    }
    public function render()
    {
        $this->payments();
        // dd($this->items);
        return view('livewire.admin.sellers.payments');
    }
    //favoritos
    public function openModalFavorites()
    {
        $this->favorites = Bill::select('title', 'id')
            ->orderBy('title', 'ASC')
            ->limit(7)->get()
            ->groupBy('title')->toArray();
        $this->modalFavorites = true;
    }

    public function selectFavorites($id)
    {
        $this->title = mb_strtoupper(Bill::find($id)->title);
        $this->modalFavorites = false;
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
            return (object) [
                'type' => PaymentType::JEWEL,
                'model' => $jewel,
                'partner' => Partner::findOrFail($jewel->partner_id),
                'date' => $jewel->paid_in,
                'value' => $jewel->value,
                'value_db' => $jewel->value_db,
                'status' => match (true) {
                    !$paymentItem => PaymentStatus::WAITING,
                    $paymentItem->status => PaymentStatus::RELEASED,
                    default => PaymentStatus::PAID,
                },
                'bill' => $paymentItem?->bills ?? '',
                'payment_item' => $paymentItem,
                'payment_value' => $paymentItem?->value,
            ];
        });

        $rentals = $rentals->map(function ($rental) use ($paymentItems) {
            $key = Location::class . ':' . $rental->id;
            $paymentItem = $paymentItems->get($key);
            return (object) [
                'type' => PaymentType::RENTAL,
                'model' => $rental,
                'partner' => Partner::findOrFail($rental->partner_id),
                'date' => $rental->location_date,
                'value' => $rental->value,
                'value_db' => $rental->value_db,
                'status' => match (true) {
                    !$paymentItem => PaymentStatus::WAITING,
                    $paymentItem->status === PaymentStatus::RELEASED => PaymentStatus::RELEASED,
                    default => PaymentStatus::PAID,
                },
                'payment_item' => $paymentItem,
                'bill' => $paymentItem?->bills ?? '',
                'payment_value' => $paymentItem?->value,
            ];
        });

        $this->items = $jewels
            ->concat($rentals)
            ->sortByDesc('date')
            ->values();

        $this->items = $this->items;
        // dd($this->items);
    }
    //SEARCH
    public function getFilteredItemsProperty()
    {
        if (blank($this->search)) {
            return $this->items;
        }

        $search = mb_strtolower(trim($this->search));

        return $this->items->filter(function ($item) use ($search) {

            return str_contains(
                mb_strtolower($item->partner->name ?? ''),
                $search
            )
                || str_contains(
                    mb_strtolower($item->partner->cpf ?? ''),
                    $search
                );
        });
    }

    //BILL
    public function printBill(SellerPaymentItem $paymentItem)
    {
        $bill = $paymentItem->bills;
        // dd($bill);
        $config = Configs::find(1);
        // Crie uma instância do mPDF
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            // 'format'        => 'L',
            'margin_left'   => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);

        // Renderize a view do Livewire
        $html = view(
            'livewire.admin.financial.bill-pdf',
            [
                'bill'              => $bill,
                'config'            => $config,
                'title_postfix'     => 'Recibo',
                'subtext'           => 'Recibo nº' . str_pad($bill->id, 6, '0', STR_PAD_LEFT),
                'responsible'       => Auth::user()->name,
            ]
        )->render();

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
        $down = storage_path('app/public/livewire-tmp/recibo.pdf');
        $pdfPath = url('storage/livewire-tmp/recibo.pdf');

        $mpdf->Output($down, 'F');

        $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);
    }
    //LIBERAR
    public function modalPaid()
    {
        $this->showModalPaid = true;

        if ($this->inputFavorites != '') {
            $this->favorites = Bill::select('title', 'id')
                ->where('title', 'LIKE', '%' . $this->inputFavorites . '%')
                ->orderBy('title', 'ASC')
                ->limit(7)->get()
                ->groupBy('title')->toArray();
        }
        $this->selectedItems = $this->getSelectedItemsProperty();
        $this->value = number_format($this->selectedItems->sum(fn($item) => (float) $item->value), 2, ',', '.');
    }
    //LIBERAR
    public function modalReleased()
    {
        $this->selectedItems = $this->getSelectedItemsProperty();
        $this->showModalReleased = true;
    }
    public function getSelectedItemsProperty()
    {
        return collect($this->items)->filter(function ($item) {
            // dd($item);
            $key = $item->type->value . ':' . $item->model->id;
            return in_array($key, $this->pay);
        });;
    }
    //Save 

    public function checkout($status)
    {
        $this->status = $status;
        if (empty($this->pay)) {
            return;
        }
        DB::transaction(function () {

            $payment = SellerPayment::create([
                'seller_id'     => $this->partner->id,
                'date'          => now(),
                'value'         => 0,
                'form_payment'  => null,
                'observation'   => null,
                'created_by'    => auth()->id(),
            ]);

            $total = 0;

            foreach ($this->pay as $item) {

                [$type, $id] = explode(':', $item);

                if ($type === 'joia') {
                    $model = Jewel::find($id);
                } elseif ($type === 'locacao') {
                    $model = Location::find($id);
                } else {
                    continue;
                }

                if (!$model) {
                    continue;
                }

                // Garante que o item ainda não foi pago
                $alreadyPaid = SellerPaymentItem::where('item_type', $model::class)
                    ->where('item_id', $model->id)
                    ->exists();

                if ($alreadyPaid) {
                    continue;
                }

                $value = (float) $model->value;

                SellerPaymentItem::create([
                    'seller_payment_id' => $payment->id,
                    'item_type'         => $model::class,
                    'item_id'           => $model->id,
                    'status'            => $this->status,
                    'value'             => $value,
                ]);

                $total += $value;
            }

            $payment->update([
                'value' => $total,
            ]);

            if ($this->status) {
                $payment->update([
                    'bill_id' => $this->save_out(),
                ]);
                foreach ($payment->items as $item) {
                    $item->update([
                        'bill_id' => $this->save_out(),
                    ]);
                }
            }
        });

        $this->pay = [];

        $this->payments();
        $this->showModalReleased = false;
        $this->showModalPaid = false;
        $this->openAlert('success', 'Registro atualizado com sucesso.');
    }

    public function save_out()
    {
        $this->rules = [
            'title' => 'required',
            'creditor' => 'required',
            'paid_in' => 'required|date_format:d/m/Y',
            'value' => 'required',
            'cost_center_id' => 'required',
            'type' => 'required',
            'creditor_document' => 'required',
        ];

        $this->validate();
        $bill = Bill::create([
            'active' => 1,
            'title' => $this->title,
            'paid_in' => $this->paid_in,
            'value' => $this->value,
            'cost_center_id' => $this->cost_center_id,
            'type' => $this->type,
            'creditor' => $this->creditor,
            'creditor_id' => $this->creditor_id,
            'creditor_document' => $this->creditor_document,
            'created_by' => Auth::user()->name,
        ]);

        return $bill->id;
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
}
