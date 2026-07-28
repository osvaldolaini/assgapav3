<?php

namespace App\Livewire\Admin\Registers;

use Livewire\Component;

use Mpdf\Mpdf;

use App\Models\Admin\Configs;
use Carbon\Carbon;

class Pdf extends Component
{
    public function render()
    {
        return view('livewire.admin.registers.pdf');
    }
    //EXPORT
    public function printExport()
    {
        $config = Configs::find(1);
        $today = Carbon::parse(now())->locale('pt-BR');
        $today = $today->translatedFormat('d F Y');
        $body = array();

        $html = view(
            'livewire.admin.exports.register',
            [
                'title_postfix' => 'Cadastro',
                'subtext'       => 'Cadastro',
                'today'         => $today,
                'config'        => $config,
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
        $down = storage_path('app/public/livewire-tmp/cadastro.pdf');
        $pdfPath = url('storage/livewire-tmp/cadastro.pdf');
        $mpdf->Output($down, 'F');
        $this->dispatch('openPdfExports', pdfPath: $pdfPath);
    }
}
