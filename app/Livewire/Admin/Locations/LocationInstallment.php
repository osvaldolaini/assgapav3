<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Received;
use App\Models\Admin\Locations\Installment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Mpdf\Mpdf;

class LocationInstallment extends Component
{
    public $rules;
    public $partner;
    public $showJetModal = false;
    public $checkoutModal = false;

    //Campos
    public $installment;
    public $title;
    public $value;
    public $form_payment;
    public $installment_maturity_date;
    public $received_id;
    public $location_id;
    public $id;
    public $remaining;
    public $active;

    public function mount(Installment $installment)
    {
        $this->id = $installment->id;
        $this->installment = $installment;
        if ($this->installment->title == 'Sinal' && $this->installment->location->convert_value($this->installment->location->value) == $this->installment->location->convert_value($this->installment->value)) {
            $this->title = 'Total';
            $this->installment->title = 'Total';
            $this->installment->save();
        }
        if ($this->installment->title == 'Total' && $this->installment->location->convert_value($this->installment->location->value) != $this->installment->location->convert_value($this->installment->value)) {
            $this->title = 'Sinal';
            $this->installment->title = 'Sinal';
            $this->installment->save();
        }
        $this->value = $this->installment->value;
        $this->form_payment = $this->installment->form_payment;
        $this->installment_maturity_date = $this->installment->installment_maturity_date;
        $this->received_id = $this->installment->received_id;
        $this->location_id = $this->installment->location_id;
        $this->partner = $this->installment->location->partners;
        $this->remaining = $this->installment->location->convert_value($this->installment->location->remaining);
    }
    #[On('updateInstallments')]
    public function render()
    {
        $this->active = $this->installment->active;
        return view('livewire.admin.locations.location-installment');
    }
    //RECEIVED
    public function printReceived($id)
    {
        $received = Received::find($id);
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
            'livewire.admin.financial.received-pdf',
            [
                'received'          => $received,
                'config'            => $config,
                'title_postfix'     => 'Recibo',
                'subtext'           => 'Recibo nº' . str_pad($received->id, 6, '0', STR_PAD_LEFT),
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
    public function updated($property)
    {
        if ($property === 'value') {
        }
    }

    public function updateValue()
    {
        Installment::updateOrCreate([
            'id' => $this->id,
        ], [
            'value' => $this->value,
        ]);
    }
    public function updatePayment()
    {
        Installment::updateOrCreate([
            'id' => $this->id,
        ], [
            'form_payment' => $this->form_payment,
        ]);
    }
    public function updateDay()
    {
        $this->rules = [
            'installment_maturity_date'    => 'required|date_format:d/m/Y',
        ];

        $this->validate();

        Installment::updateOrCreate([
            'id' => $this->id,
        ], [
            'installment_maturity_date' => $this->installment_maturity_date,
        ]);
        $this->dispatch('closeAlert');

        $future = date('Y-m-d', strtotime("+1 year", strtotime(date('Y-m-d'))));
        $test = implode("-", array_reverse(explode("/", $this->installment_maturity_date)));
        if ($test < date('Y-m-d')) {
            $this->openAlert('info', 'A data informada ( ' . $this->installment_maturity_date . ' ) é menor que a data de hoje, tem certeza que está correta?');
        }
        if ($test > $future) {
            $this->openAlert('info', 'A data informada ( ' . $this->installment_maturity_date . ' ) excede um ano, tem certeza que está correta?');
        }
    }
    //PAGAR
    public function showCheckoutModal()
    {
        $this->checkoutModal = true;
    }

    public function checkout()
    {
        $this->rules = [
            'location_id'   => 'required',
            'form_payment'  => 'required',
            'installment_maturity_date'    => 'required|date_format:d/m/Y',
            'value'         => 'required',
        ];

        $this->validate();

        if ($this->installment->location->convert_value($this->installment->value) > $this->installment->location->convert_value($this->installment->location->remaining)) {
            $this->openAlert('error', 'O valor informado é de R$ ' . $this->installment->value . '. Portanto maior que o valor restante!');
            $this->value = $this->installment->location->remaining;

            $this->checkoutModal = false;
            return;
        }
        if ($this->form_payment != 'BOL') {
            $received = Received::create([
                'active'        => 1,
                'title'         => $this->title . ' DO CONTRATO Nº ' . $this->location_id,
                'paid_in'       => $this->installment_maturity_date,
                'value'         => $this->value,
                'form_payment'  => $this->form_payment,
                'partner_id'    => $this->partner->id,
                'partner'       => $this->partner->name,
                'created_by'    => Auth::user()->name,
            ]);
            Installment::updateOrCreate([
                'id' => $this->id,
            ], [
                'active' => 1,
                'received_id' => $received->id,
                'updated_by' => Auth::user()->name,
            ]);
        }else{
            Installment::updateOrCreate([
                'id' => $this->id,
            ], [
                'active' => 1,
                // 'received_id' => $received->,
                'updated_by' => Auth::user()->name,
            ]);
        }


        $this->openAlert('success', 'Registro atualizado com sucesso.');
        $this->dispatch('updateInstallments', $this->location_id);
        $this->checkoutModal = false;
        // redirect()->route('installments-location', $this->location_id);
    }
    //DELETE
    public function showModalDelete()
    {
        $this->showJetModal = true;
    }
    public function delete()
    {
        $data = Installment::where('id', $this->id)->first();
        if ($data->title == 'Sinal' or $data->title == 'Total') {
            $data->active = 0;
        } else {
            $data->active = 3;
        }

        $data->save();
        $this->showJetModal = false;
        $this->openAlert('success', 'Registro excluido com sucesso.');
        $this->openAlert('error', 'Excluir esse registro não exclui o
        recibo ' . $data->received_id . '
        automaticamente.');
        redirect()->to('/locações/' . $this->location_id . '/parcelas')->with('success', 'Registro excluido com sucesso.')->with('error', 'Excluir esse registro não exclui o
        recibo ' . $data->received_id . '
        automaticamente.');
        // $this->dispatch('updateInstallments',$this->location_id);
        // redirect()->to('installments-location', $this->location_id);
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
