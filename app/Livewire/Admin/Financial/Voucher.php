<?php

namespace App\Livewire\Admin\Financial;

use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Received;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Voucher extends Component
{
    public $type;
    public $data;

    public function mount($data,$type)
    {
        $this->type = $type;
        $this->data = $data;
    }
    public function render()
    {
        return view('livewire.admin.financial.voucher');
    }
    //RECEIVED
    public function printReceived()
    {
        $received = $this->data;
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
    public function printBill()
    {
        $bill = $this->data;
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
    //CASHIER
    public function printCashier()
    {
        $cashier = $this->data;
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
            'livewire.admin.financial.cashier-pdf',
            [
                'cashier'           => $cashier,
                'config'            => $config,
                'title_postfix'     => 'Recibo',
                'subtext'           => 'Recibo nº' . str_pad($cashier->id, 6, '0', STR_PAD_LEFT),
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
