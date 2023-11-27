<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Admin\Configs;
use App\Models\Admin\Locations\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LocationButtons extends Component
{
    public $id;
    public $location;
    public $config;
    public function mount(Location $location)
    {
       $this->location = $location;
       $this->id = $location->id;
       $this->config = Configs::find(1);
    }
    public function render()
    {
        return view('livewire.admin.locations.location-buttons');
    }
    //CONTRACT
    public function printContract()
    {
            // Crie uma instância do mPDF
            $mpdf = new Mpdf([
                'mode'          => 'utf-8',
                // 'format'        => 'L',
                'margin_left'   => 10,
                'margin_top'    => 10,
                'default_font_size'  => 9,
                'default_font'  => 'arial',
            ]);
            $today = Carbon::parse(now())->locale('pt-BR');



            // Renderize a view do Livewire
            $html = view('livewire.admin.locations.location-contract',
            [
                'location'          => $this->location,
                'config'            => $this->config,
                'contract_number'   => 'Contrato nº '.str_pad($this->location->id, 5, '0', STR_PAD_LEFT),
                'subtext'           => 'Contrato de locação do(a) – ' .mb_strtoupper($this->location->ambiences->title),
                'responsible'       => Auth::user()->name,
                'today'             => $today->translatedFormat('d F Y'),
            ])->render();

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
            $down = storage_path('app/public/livewire-tmp/contract.pdf');
            $pdfPath = url('storage/livewire-tmp/contract.pdf');

            $mpdf->Output($down, 'F');

            $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);

    }
    //TERM
    public function printTerm()
    {
            // Crie uma instância do mPDF
            $mpdf = new Mpdf([
                'mode'          => 'utf-8',
                // 'format'        => 'L',
                'margin_left'   => 10,
                'margin_top'    => 10,
                'default_font_size'  => 9,
                'default_font'  => 'arial',
            ]);
            $today = Carbon::parse(now())->locale('pt-BR');

            // Renderize a view do Livewire
            $html = view('livewire.admin.locations.location-term',
            [
                'location'          => $this->location,
                'config'            => $this->config,
                'contract_number'   => 'Contrato nº '.str_pad($this->location->id, 5, '0', STR_PAD_LEFT),
                'subtext'           => 'Contrato de locação do(a) – ' .mb_strtoupper($this->location->ambiences->title),
                'responsible'       => Auth::user()->name,
                'today'             => $today->translatedFormat('d F Y'),
            ])->render();

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
            $down = storage_path('app/public/livewire-tmp/contract.pdf');
            $pdfPath = url('storage/livewire-tmp/contract.pdf');

            $mpdf->Output($down, 'F');

            $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);

    }
}
