<?php

namespace App\Livewire\Admin\Registers;

use App\Models\Admin\Configs;
use App\Models\Admin\Registers\Partner;
use Livewire\Component;

use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SelectCards extends Component
{
    public $breadcrumb_title = 'SÓCIOS';

    public $partner;
    public $print = [];
    public $mpdf;
    public $config;

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
        $this->print[] = $partner->id;
        if ($partner->partner_category_master == 'Dependente') {
            $this->partner = Partner::find($partner->responsible);
        }
        $this->breadcrumb_title = $this->breadcrumb_title = 'DEPENDENTES DE: ' . $this->partner->name;

        // dd($this->partner);
        $this->config = Configs::find(1);
    }
    public function render()
    {
        return view('livewire.admin.registers.select-cards');
    }

    public function printCards()
    {
        $this->print;

        if (count($this->print) == 0) {
            $this->openAlert('error', 'Nenhuma carteirinha selecionada');
        } else {
            $cards = [];
            for ($i = 0; $i < count($this->print); $i++) {
                $partner = Partner::find($this->print[$i]);
                $partner->version_card += 1;
                $partner->save();
                if ($partner->partner_category_master == 'Dependente') {
                    $responsável = $partner->parent->name;
                } else {
                    $responsável = "";
                }

                $cards[] = array(
                    'id'  => $partner->id,
                    'version' => $partner->version_card,
                    'name'  => $partner->name,
                    'category'  => $partner->category->title,
                    'cpf'  => $partner->cpf,
                    'date_of_birth'  => $partner->date_of_birth,
                    'validity_of_card'  => $partner->validity_of_card,
                    'color' => $partner->category->color,
                    'responsavel' =>  $responsável,
                    'qrcode' => 'qrcode-' . $i . '.png',
                    'image' => $partner->image,
                );
                QrCode::backgroundColor(255, 255, 255, 10)->generate(
                    url('piscina/' . $partner->id),
                    storage_path('app/public/livewire-tmp/qrcode-' . $i . '.png')
                );
            }
            // Crie uma instância do mPDF
            $mpdf = new Mpdf([
                'mode'          => 'utf-8',
                // 'format'        => 'L',
                'margin_left'   => 5,
                'margin_right'   => 0,
                'margin_top'    => 10,
                'default_font_size'  => 9,
                'default_font'  => 'arial',
            ]);

            // Renderize a view do Livewire
            $html = view('livewire.admin.registers.card', ['cards' => $cards, 'config' => $this->config])->render();

            // Adicione o conteúdo HTML ao PDF
            $mpdf->WriteHTML($html);

            // Salve o PDF temporariamente
            $down = storage_path('app/public/livewire-tmp/documento.pdf');
            $pdfPath = url('storage/livewire-tmp/documento.pdf');

            $mpdf->Output($down, 'F');

            $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);
        }
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
