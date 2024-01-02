<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Financial\Cashier;
use App\Models\Admin\Financial\Received;
use App\Models\Admin\Locations\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mpdf\Mpdf;

class DailyReport extends Component
{
    public $search;


    public function mount()
    {
        $this->search = date('d/m/Y');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.daily-report');
    }
    public function getDaily()
    {

        $d=implode("-",array_reverse(explode("/",$this->search)));
        /*Valor de ajusta do sistema antigo */
        $adjustmentSystem=4825.06;
        $config = Configs::find(1);

        $cashiers = Cashier::where('active',1)->where('status',1)->get();
        $oldCashiers=0;$dayCashiers=0;
        foreach ($cashiers  as $cashier ) {
            if(strtotime($cashier->paid_in) < strtotime($d)){
                /*Recolhimentos de caixa anteriores ao dia solicitado*/
                $oldCashiers += $cashier->convert_value($cashier->value);
            }elseif(strtotime($cashier->paid_in) == strtotime($d)){
                $dayCashiers += $cashier->convert_value($cashier->value);
            }
        }

        $itens=0;
        /*Entradas */
        $receiveds = Received::where('active',1)->get();

        $listReceiveds=array();$oldReceiveds=0;$dayReceiveds=0;
        foreach ($receiveds as $received) {

            if(strtotime($received->paid_in) < strtotime($d)){
                /*Entradas anteriores ao dia solicitado*/
                if($received->form_payment=='DIN'){
                    $oldReceiveds += $received->convert_value($received->value);
                }

            }elseif(strtotime($received->paid_in) == strtotime($d)){
                /*Entradas do dia solicitado*/
                $itens+=1;
                if(isset($received->location_id)){
                    $location = Location::where('id',$received->location_id)->first();
                    $tenant = $location->ambienceTenants->title;
                }else{
                    $tenant = '';
                }
                if($received->form_payment=='DIN'){
                    $dayReceiveds += $received->convert_value($received->value);
                }
                if($received->location_id){
                    $contact = str_pad($received->location->id, 5, '0', STR_PAD_LEFT);
                    $text = " - ".$received->ambiences->title .'  ( Contrato nº '.$contact.' )';
                }else{
                    $text = '';
                }
                $listReceiveds[]=[
                    'item'          => str_pad($itens, 3, '0', STR_PAD_LEFT),
                    'tenant'        => $tenant,
                    'title'         => $received->title.$text,
                    'receipts'      => 'ASSG'.str_pad($received->id, 5, '0', STR_PAD_LEFT).'RC',
                    'enter'         => 'R$ '. number_format($received->convert_value($received->value),2,",","."),
                    'value'         => $received->convert_value($received->value),
                    'exit'          => '',
                    'form_payment'  => $received->form_payment,
                    'payment'       => $received->payment,
                ];
            }
        }

        /*Saídas */
        $bills = Bill::where('active',1)->where('type','!=','FIN')->get();

        $listBill=array();$oldBills=0;$dayBills=0;
        foreach ($bills as $bill) {
            if(strtotime($bill->paid_in) < strtotime($d)){
                /*Saídas anteriores ao dia solicitado*/
                $oldBills += $bill->convert_value($bill->value);
            }elseif(strtotime($bill->paid_in) == strtotime($d)){
                /*Saídas do dia solicitado*/
                $itens+=1;
                if(isset($bill->creditors)){
                    $creditor =" ( ".$bill->creditors->name." )";
                }else{
                    $creditor = '';
                }

                $dayBills+=$bill->convert_value($bill->value);
                $listBill[]=[
                    'item'      => str_pad($itens, 3, '0', STR_PAD_LEFT),
                    'tenant'    => '',
                    'title'     => $bill->title.$creditor,
                    'receipts'  => 'ASSG'.str_pad($bill->id, 5, '0', STR_PAD_LEFT).'PG',
                    'enter'     => '',
                    'exit'      => 'R$ '. number_format($bill->convert_value($bill->value),2,",","."),
                ];
            }
        }
        $oldBalance = $oldReceiveds - $oldBills - $oldCashiers - $adjustmentSystem;
        $dayBalance = $oldBalance + $dayReceiveds - $dayCashiers - $dayBills;


        // dd($oldReceiveds,$oldBills,$oldCashiers,$adjustmentSystem);
        dd($d,$listReceiveds);

        // Crie uma instância do mPDF
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            // 'format'        => 'L',
            'margin_left'   => 10,
            'margin_right'   => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);

        $today = Carbon::parse(now())->locale('pt-BR');
        // Renderize a view do Livewire
        $html = view('livewire.admin.reports.daily',
        [
            'title_postfix' => 'Relatório diário',
            'subtext'       => 'MOVIMENTO DE CAIXA DO DIA '. $this->search,
            'responsible'   => Auth::user()->name,
            'day'           => $this->search,
            'config'        => $config,
            'receiveds'     => $listReceiveds,
            'dayReceiveds'  => $dayReceiveds,
            'bills'         => $listBill,
            'dayBills'      => $dayBills,
            'dayCashiers'   => $dayCashiers,
            'dayBalance'    => $dayBalance,
            'oldBalance'    => $oldBalance,
            'today'         => $today->translatedFormat('d F Y'),
        ])->render();
        // Adicione o conteúdo HTML ao PDF
        $mpdf->WriteHTML($html);

        // Salve o PDF temporariamente
        $down = storage_path('app/public/livewire-tmp/relatorio-diario.pdf');
        $pdfPath = url('storage/livewire-tmp/relatorio-diario.pdf');

        $mpdf->Output($down, 'F');

        $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);
    }
}
