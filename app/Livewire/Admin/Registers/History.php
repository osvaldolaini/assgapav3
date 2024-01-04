<?php

namespace App\Livewire\Admin\Registers;

use App\Exports\AllExports;
use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Livewire\Component;

use App\Models\Admin\Financial\Received;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class History extends Component
{
    public $breadcrumb_title;
    //Campos
    public $partner;
    public $dataTable = [];
    public $export = [];

    public function mount(Partner $partner)
    {
        $this->breadcrumb_title = $partner->name;
        $this->partner = $partner;

        if ($partner->locations->where('active', 1)) {
            foreach ($partner->locations as $location) {
                $this->dataTable[] = [
                    'description'   => 'Locação do ambiente: ' . $location->ambiences->title,
                    'type'          => 'Locações',
                    'received'      => '',
                    'bill'          => '',
                    'date'          => $location->location_date,
                    'realDate'      => implode("-",array_reverse(explode("/",$location->location_date))),
                    'link'          => route('edit-location', $location->id)
                ];
            }
        }
        if ($partner->monthlys->where('status','!=', 0)) {
            foreach ($partner->monthlys as $monthly) {
                if ($monthly->status == 1) {
                    $text = 'Pagamento da mendalidade de: ' . $monthly->monthlyRef;
                }else{
                    $text = 'Liberação da mendalidade de: ' . $monthly->monthlyRef;
                }
                $this->dataTable[] = [
                    'description'   => $text,
                    'type'          => 'Mensalidades',
                    'received'      => '',
                    'bill'          => '',
                    'date'          => $monthly->paid_in,
                    'realDate'      => implode("-",array_reverse(explode("/",$monthly->paid_in))),
                    'link'          => route('monthlys', $monthly->partner_id)
                ];
            }
        }
        if ($partner->receiveds->where('active', 1)) {
            foreach ($partner->receiveds as $received) {
                $this->dataTable[] = [
                    'description'   => 'Pago devido: ' . $received->title,
                    'type'          => 'Mensalidades',
                    'received'      => $received->id,
                    'bill'          => '',
                    'date'          => $received->paid_in,
                    'realDate'      => implode("-",array_reverse(explode("/",$received->paid_in))),
                    'link'          => ''
                ];
            }
        }
        if ($partner->bills->where('active', 1)) {
            foreach ($partner->bills as $bill) {
                $this->dataTable[] = [
                    'description'   => 'Recebido por: ' . $bill->title,
                    'type'          => 'Recebidos',
                    'received'      => '',
                    'bill'          => $bill->id,
                    'date'          => $bill->paid_in,
                    'realDate'      => implode("-",array_reverse(explode("/",$bill->paid_in))),
                    'link'          => ''
                ];
            }
        }
        $this->export = collect($this->dataTable)->sortByDesc('realDate');
        $this->dataTable = json_encode(collect($this->dataTable)->sortByDesc('realDate'));
    }
    public function render()
    {
        return view('livewire.admin.registers.history');
    }
    //EXPORT
    public function printExport()
    {
        $title = $this->breadcrumb_title;
        $config = Configs::find(1);
        $today = Carbon::parse(now())->locale('pt-BR');
        $today = $today->translatedFormat('d F Y');
        $body = array();

        foreach ($this->export as $item) {
            $body[] = [
                'type'          => $item['type'],
                'description'   => $item['description'],
                'received'      => $item['received'],
                'bill'          => $item['bill'],
                'date'          => $item['date'],
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
                'heads'         => array('Tipo', 'Motivo','Receita','Despesa','data'),
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
    }
    public function excelExport()
    {
        $data[] = array('Tipo', 'Motivo','Receita','Despesa','data');
        foreach ($this->export as $item) {
            $data[] = [
                'type'          => $item['type'],
                'description'   => $item['description'],
                'received'      => $item['received'],
                'bill'          => $item['bill'],
                'date'          => $item['date'],
            ];
        }

        return Excel::download(new AllExports($data), 'exportar-em-excel.xlsx');
    }
    //END EXPORT
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
