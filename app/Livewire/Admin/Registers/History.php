<?php

namespace App\Livewire\Admin\Registers;

use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Livewire\Component;

use App\Models\Admin\Financial\Received;
use Illuminate\Support\Facades\Auth;

use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class History extends Component
{
    public $breadcrumb_title;
    //Campos
    public $partner;
    public $dataTable = [];

    public function mount(Partner $partner)
    {
        $this->breadcrumb_title = $partner->name;
        $this->partner = $partner;

        if ($partner->locations->where('active',1)) {
            foreach ($partner->locations as $location) {
                $this->dataTable[] = [
                    'description'   => 'Locação do ambiente: '. $location->ambiences->title,
                    'type'          => 'Locações',
                    'received'      => '',
                    'bill'          => '',
                    'date'          => $location->location_date,
                    'link'          => route('edit-location',$location->id)
                ];
            }
        }
        if ($partner->monthlys->where('active',1)) {
            foreach ($partner->monthlys as $monthly) {
                $this->dataTable[] = [
                    'description'   => 'Mendalidade de: '. $monthly->monthlyRef,
                    'type'          => 'Mensalidades',
                    'received'      => '',
                    'bill'          => '',
                    'date'          => $monthly->paid_in,
                    'link'          => route('monthlys',$monthly->partner_id)
                ];
            }
        }
        if ($partner->receiveds->where('active',1)) {
            foreach ($partner->receiveds as $received) {
                $this->dataTable[] = [
                    'description'   => 'Pago devido: '. $received->title,
                    'type'          => 'Mensalidades',
                    'received'      => $received->id,
                    'bill'          => '',
                    'date'          => $received->paid_in,
                    'link'          => ''
                ];
            }
        }
        if ($partner->bills->where('active',1)) {
            foreach ($partner->bills as $bill) {
                $this->dataTable[] = [
                    'description'   => 'Recebido por: '. $bill->title,
                    'type'          => 'Recebidos',
                    'received'      => '',
                    'bill'          => $bill->id,
                    'date'          => $bill->paid_in,
                    'link'          => ''
                ];
            }
        }
        $this->dataTable = json_encode(collect($this->dataTable)->sortByDesc('date'));
    }
    public function render()
    {

        return view('livewire.admin.registers.history');
    }
    public function convertDate($value)
    {
        Carbon::createFromFormat('Y-m-d H:i:s', $value)
            ->format('d/m/Y');
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

     //BILL
     public function printBill($id)
     {
         $bill = Bill::find($id);
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
}
