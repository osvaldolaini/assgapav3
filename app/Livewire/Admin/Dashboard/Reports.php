<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Configs;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Financial\Cashier;
use App\Models\Admin\Financial\Received;
use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Pool\Pass;
use App\Models\Admin\Pool\Pool;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mpdf\Mpdf;

class Reports extends Component
{
    public $year;
    public $mounth;
    public $html;
    public $config;
    public $today;
    public $title;

    public $start;
    public $end;
    public $day;

    public $type;

    public function mount($type)
    {
        $this->mounth = date('m');
        $this->year = date('Y');
        $this->type = $type;
    }
    public function render()
    {
        if ($this->type == 'full') {
            return view('livewire.admin.dashboard.reports');
        }else{
            return view('livewire.admin.dashboard.reportsTiny');
        }
    }
    public function report($report)
    {

        $this->config = Configs::find(1);
        $this->today = Carbon::parse(now())->locale('pt-BR');
        $this->today = $this->today->translatedFormat('d F Y');

        $dataCarbon = Carbon::create($this->year, $this->mounth, 1);
        $dataCarbon->locale('pt-BR');
        $this->title = 'PRESTAÇÃO DE CONTAS DO MÊS DE ' . mb_strtoupper($dataCarbon->isoFormat('MMMM [de] YYYY')) . ': ';

        $this->start = date('Y-m-d', strtotime($this->year . '-' . $this->mounth . '-01'));
        if ($this->mounth == 2) {
            $this->day = '28';
        } elseif ($this->mounth == '4' or $this->mounth == '6' or $this->mounth == '9' or $this->mounth == '11') {
            $this->day = '30';
        } else {
            $this->day = '31';
        }
        $this->end = date('Y-m-d', strtotime($this->year . '-' . $this->mounth . '-' . $this->day));

        switch ($report) {
            case 'financial':
                $this->title .= 'FINANCEIRO';
                $this->financial();
                $orientation = 'P';
                break;
            case 'spendingBySector':
                $this->title .= 'GASTOS POR SETOR';
                $this->spendingBySector();
                $orientation = 'P';
                break;
            case 'revenueBySector':
                $this->title .= 'RECEITAS POR SETOR';
                $this->revenueBySector();
                $orientation = 'L';
                break;
            case 'cardMachine':
                $this->title .= 'MAQUINHINHA';
                $this->cardMachine();
                $orientation = 'P';
                break;
            case 'tickets':
                $this->title .= 'BOLETOS';
                $this->tickets();
                $orientation = 'P';
                break;
            case 'receipts':
                $this->title = 'RECIBOS EM ABERTO';
                $this->receipts();
                $orientation = 'P';
                break;
            case 'monthlyPayment':
                $this->title = 'MENSALIDADES DO ANO ' . $this->year;
                $this->monthlyPayment();
                $orientation = 'P';
                break;
            case 'pix':
                $this->title .= 'PIX';
                $this->pix();
                $orientation = 'P';
                break;
            case 'accessPool':
                $dataCarbon = Carbon::create($this->year, $this->mounth, 1);
                $dataCarbon->locale('pt-BR');
                $this->title = 'ACESSOS DE PISCINA DE ' . mb_strtoupper($dataCarbon->isoFormat('MMMM [de] YYYY'));
                $this->accessPool();
                $orientation = 'P';
                break;
        }
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'orientation'   =>  $orientation,
            'margin_left'   => 10,
            'margin_right'  => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);

        // Adicione o conteúdo HTML ao PDF
        $mpdf->WriteHTML($this->html);

        // Salve o PDF temporariamente
        $down = storage_path('app/public/livewire-tmp/relatorio-financeiro.pdf');
        $pdfPath = url('storage/livewire-tmp/relatorio-financeiro.pdf');

        $mpdf->Output($down, 'F');

        $this->dispatch('openPdfReports', pdfPath: $pdfPath);
    }
    /*Relatório financeiro por mês */
    public function financial()
    {
        $spending = array();
        /*Saídas de valor com user FIN  */
        $bills = Bill::whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('type', 'FIN')
            ->get();
        $oldBills = Bill::where('type', 'FIN')
            ->where('paid_in', '<', $this->start)
            ->where('active', 1)
            ->get();
        $oldValues = 0;
        foreach ($oldBills as $oldBill) {
            $oldValues += $oldBill->convert_value($oldBill->value);
        }
        $billValue = 0;
        foreach ($bills as $bill) {
            if ($bill->partner) {
                $creditor = $bill->partner->name;
            } else {
                $creditor = $bill->creditor;
            }
            $spending[] = array(
                'paid_in' => date('d', strtotime($bill->paid_in)),
                'id' => str_pad($bill->id, 5, '0', STR_PAD_LEFT),
                'color' => 'background-color:#fff;',
                'title' => mb_strtoupper($bill->title . " ( " . $creditor . " )"),
                'enter' => '',
                'exits' => 'R$ ' . $bill->value,
            );
            $billValue += $bill->convert_value($bill->value);
        }
        /*Caixa (entradas e saídas)*/
        $cashiers = Cashier::whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('status', 1)
            ->get();
        $oldCashiers = Cashier::where('paid_in', '<', $this->start)
            ->where('active', 1)
            ->get();
        $oldEnter = 0;
        $oldExits = 0;
        foreach ($oldCashiers as $oldCashier) {
            if ($oldCashier->type == 1) {
                if ($oldCashier->status == 1) {
                    $oldEnter += $oldCashier->convert_value($oldCashier->value);
                }
            }
            if ($oldCashier->type == 2) {
                $oldExits += $oldCashier->convert_value($oldCashier->value);
            }
        }

        $cashierValue = 0;
        foreach ($cashiers as $cashier) {
            $spending[] = array(
                'paid_in' => date('d', strtotime($cashier->paid_in)),
                'id' => 'XXXXX',
                'color' => 'background-color:#888;',
                'title' => mb_strtoupper($cashier->title),
                'enter' => 'R$ ' . $cashier->value,
                'exits' => '',
            );
            $cashierValue += $cashier->convert_value($cashier->value);
        }

        $transported = $oldEnter - $oldValues;
        $tot = $transported + $cashierValue - $billValue;
        $cashierValue = $transported + $cashierValue;
        if ($spending != '') {
            array_multisort($spending);
        }
        $this->html = view('livewire.admin.reports.financial',
            [
                'title_postfix' => 'Relatório financeiro',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'spendings'     => $spending,
                'billValue'     => 'R$ ' . number_format($billValue, 2, ",", "."),
                'cashierValue'  => 'R$ ' . number_format($cashierValue, 2, ",", "."),
                'transported'   => $transported,
                'total'         => 'R$ ' . number_format($tot, 2, ",", "."),

            ]
        )->render();
    }
    /*Relatório de gastos por setor */
    public function spendingBySector()
    {
        $spending = array();
        $tot = 0;
        $categories = array();
        $bills = Bill::select('*')
            ->whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->orderBy('paid_in', 'asc')
            ->get();

        $cashiers = Cashier::select('*')
            ->whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('type', 2)
            ->orderBy('paid_in', 'asc')
            ->get();


        foreach ($bills as $bill) {

            $spending[] = array(
                'category' => $bill->cost_center->title,
                'id' => $bill->id,
                'color' => $bill->cost_center->color,
                'title' => mb_strtoupper($bill->title),
                'value' => 'R$ ' . $bill->value,
            );
            $categories[] = array(
                'category' => $bill->cost_center->title,
                'color' => $bill->cost_center->color,
                'val' => $bill->convert_value($bill->value),
            );

            $tot += $bill->convert_value($bill->value);
        }
        foreach ($cashiers as $cashier) {
            if ($cashier->cost_center_id == '') {
                $spending[] = array(
                    'category' => 'OUTROS',
                    'id' => '',
                    'color' => '#fff',
                    'title' => mb_strtoupper($cashier->title),
                    'value' => 'R$ ' . $cashier->value,
                );
                $categories[] = array(
                    'category' => 'OUTROS',
                    'color' => '#fff',
                    'val' => $cashier->value,
                );
            } else {
                $spending[] = array(
                    'category' => $cashier->cost_center->title,
                    'id' => '',
                    'color' => $cashier->cost_center->color,
                    'title' => mb_strtoupper($cashier->title),
                    'value' => 'R$ ' . $cashier->value,
                );
                $categories[] = array(
                    'category' => $cashier->cost_center->title,
                    'color' => $cashier->cost_center->color,
                    'val' => $cashier->convert_value($cashier->value),
                );
            }
            $tot += $cashier->convert_value($cashier->value);
        }
        if ($spending != '') {
            array_multisort($spending);
        }
        $category = array();
        //soma os valores das categorias iguais dentro da array RESULT
        foreach ($categories as $a) {
            if (!isset($category[$a['category']])) {
                $category[$a['category']] = $a;
            } else {
                if ($category[$a['category']]['category'] == $a['category']) {
                    $category[$a['category']]['val'] = strval($a['val'] + $category[$a['category']]['val']);
                }
            }
        }
        array_multisort($category);

        $this->html = view(
            'livewire.admin.reports.spendingBySector',
            [
                'title_postfix' => 'Relatório financeiro',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'spendings'     => $spending,
                'categories'    => $category,
                'total'         => 'R$ ' . number_format($tot, 2, ",", "."),
            ]
        )->render();
    }
    /*Relatório de receitas por setor */
    public function revenueBySector()
    {
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");

        $totais = array();
        $dates = array();

        $this->start = date('Y-m-d', strtotime($this->year . '-' . $this->mounth . '-01'));
        if ($this->mounth == 2) {
            $this->day = '28';
        } elseif ($this->mounth == '4' or $this->mounth == '6' or $this->mounth == '9' or $this->mounth == '11') {
            $this->day = '30';
        } else {
            $this->day = '31';
        }
        $this->end = date('Y-m-d', strtotime($this->year . '-' . $this->mounth . '-' . $this->day));

        $cashiers = Cashier::select('title', 'value')
            ->whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('type', 1)
            ->where('status', 0)
            ->get()
            ->groupBy('title')
            ->sort();
        foreach ($cashiers as $key => $value) {
            $val = 0;
            foreach ($value->toArray() as $key) {
                str_replace(' ', '', $key['value']);
                ltrim($key['value']);
                $key['value'] = str_replace('.', '', $key['value']);
                $key['value'] = str_replace(',', '.', $key['value']);
                $val += str_replace(' ', '', $key['value']);
            }
            $lauchs[] = array(
                'ambience' => $key['title'],
                'value' => $val,
            );
        }
        $receiveds = Received::select('ambience_id', 'value')
            ->whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->with(['ambiences'])
            ->where('form_payment', 'DIN')
            ->get()
            ->groupBy('ambience_id')
            ->sort();

        foreach ($receiveds as $key => $value) {
            $val = 0;
            foreach ($value->toArray() as $key) {
                str_replace(' ', '', $key['value']);
                ltrim($key['value']);
                $key['value'] = str_replace('.', '', $key['value']);
                $key['value'] = str_replace(',', '.', $key['value']);
                $val += str_replace(' ', '', $key['value']);

                if ($key['ambience_id']) {
                    $ambience = Ambience::select('title')->find($key['ambience_id'])->title;
                } else {
                    $ambience = 'OUTROS';
                }
            }
            $lauchs[] = array(
                'ambience' => $ambience,
                'value' => $val,
            );
        }
        // array_multisort($lauchs);

        /*Valor das entradas por dia*/
        $cashierDatas = Cashier::select('title', 'value', 'paid_in')
            ->whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('type', 1)
            ->where('status', 0)
            ->get()
            ->groupBy('paid_in')
            ->sort();

        foreach ($cashierDatas as $key => $value) {
            $val = 0;

            foreach ($value->toArray() as $key) {
                str_replace(' ', '', $key['value']);
                ltrim($key['value']);
                $key['value'] = str_replace('.', '', $key['value']);
                $key['value'] = str_replace(',', '.', $key['value']);
                $d = implode("-", array_reverse(explode("/", $key['paid_in'])));

                $dates[] = array(
                    'ambience' => $key['title'],
                    'value' => str_replace(' ', '', $key['value']),
                    'paid_in' => date('d', strtotime($d)),
                );
                $totEnter = 0;
                $totEnter += str_replace(' ', '', $key['value']);
                $totais[] = array(
                    'paid_in'  => date('d', strtotime($d)),
                    'totEnter' => $totEnter,
                    'totExit'  => 0,
                );
            }
        }

        $receivedData = Received::select('ambience_id', 'value', 'paid_in')
            ->whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->with(['ambiences'])
            ->where('form_payment', 'DIN')
            ->get()
            ->groupBy('ambience_id', 'paid_in');

        foreach ($receivedData as $key => $value) {
            $val = 0;
            $totEnter = 0;
            foreach ($value->toArray() as $key) {
                str_replace(' ', '', $key['value']);
                ltrim($key['value']);
                $key['value'] = str_replace('.', '', $key['value']);
                $key['value'] = str_replace(',', '.', $key['value']);

                if ($key['ambience_id']) {
                    $ambience = Ambience::select('title')->find($key['ambience_id'])->title;
                } else {
                    $ambience = 'OUTROS';
                }
                $d = implode("-", array_reverse(explode("/", $key['paid_in'])));

                $dates[] = array(
                    'ambience' => $ambience,
                    'value' => str_replace(' ', '', $key['value']),
                    'paid_in' => date('d', strtotime($d)),
                );
                $totEnter = 0;
                $totEnter += str_replace(' ', '', $key['value']);
                $totais[] = array(
                    'paid_in' => date('d', strtotime($d)),
                    'totEnter'  => $totEnter,
                    'totExit'  => 0,
                );
            }
        }

        /*Valor das saídas por dia*/
        $bills = Bill::select('value', 'paid_in')
            ->whereBetween('paid_in', [$this->start, $this->end])
            ->where('type', '!=', 'FIN')
            ->where('active', 1)
            ->get()
            ->groupBy('title');

        foreach ($bills as $key => $value) {
            $val = 0;
            foreach ($value->toArray() as $key) {
                str_replace(' ', '', $key['value']);
                ltrim($key['value']);
                $key['value'] = str_replace('.', '', $key['value']);
                $key['value'] = str_replace(',', '.', $key['value']);

                $totExits = 0;
                $totExits = str_replace(' ', '', $key['value']);
                $d = implode("-", array_reverse(explode("/", $key['paid_in'])));
                $totais[] = array(
                    'paid_in' => date('d', strtotime($d)),
                    'totEnter'  => 0,
                    'totExit'  => $totExits,
                );
            }
        }

        array_multisort($dates);
        $newDates = [];
        // Itera sobre o array original
        foreach ($dates as $item) {
            // Cria uma chave única baseada em ambience e paid_in
            $chave = $item['ambience'] . '-' . $item['paid_in'];

            // Adiciona o valor ao array de somas consolidadas
            if (!isset($newDates[$chave])) {
                $newDates[$chave] = $item;
            } else {
                // Soma os valores
                $newDates[$chave]['value'] += $item['value'];
            }
        }

        array_multisort($totais);

        /*echo '<pre>';
                print_r($totais);*/
        // dd($dates);

        $this->html = view(
            'livewire.admin.reports.revenueBySector',
            [
                'title_postfix' => 'Relatório financeiro',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'lauchs'        => $lauchs,
                'dates'         => $newDates,
                'totais'        => $totais,
                'month'         => $this->mounth,
                'year'          => $this->year,
            ]
        )->render();
    }
    /*Relatório de pagamentos com maquininha */
    public function cardMachine()
    {

        $receiveds = Received::whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('form_payment', 'CAR')
            ->orderBy('paid_in', 'asc')
            ->get();
        $tot = 0;
        $itens = 0;
        foreach ($receiveds as $received) {
            $itens += 1;
            $tot += $received->convert_value($received->value);
            if ($received->location_id) {
                $contact = str_pad($received->location->id, 6, '0', STR_PAD_LEFT);
                $text = " - " . $received->ambiences->title . '  ( Contrato nº ' . $contact . ' )';
            } else {
                $text = '';
            }
            $listReceiveds[] = [
                'item'    => str_pad($itens, 3, '0', STR_PAD_LEFT),
                'paid_in' => date('d/m/Y', strtotime($received->paid_in)),
                'title'   => $received->title . $text,
                'number'  => str_pad($received->id, 6, '0', STR_PAD_LEFT),
                'value'   => 'R$ ' . $received->value,
            ];
        }
        $this->html = view(
            'livewire.admin.reports.cardMachine',
            [
                'title_postfix' => 'Relatório financeiro',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'receiveds'     => $listReceiveds,
                'total'         => 'R$ ' . number_format($tot, 2, ",", "."),
            ]
        )->render();
    }
    /*Relatório de pagamentos com boleto */
    public function tickets()
    {
        $listReceiveds = array();
        $receiveds = Received::whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('form_payment', 'BOL')
            ->orderBy('paid_in', 'asc')
            ->get();
        $tot = 0;
        $itens = 0;
        foreach ($receiveds as $received) {
            $itens += 1;
            $tot += $received->convert_value($received->value);
            if ($received->location_id) {
                $contact = str_pad($received->location->id, 6, '0', STR_PAD_LEFT);
                $text = " - " . $received->ambiences->title . '  ( Contrato nº ' . $contact . ' )';
            } else {
                $text = '';
            }
            $listReceiveds[] = [
                'item'    => str_pad($itens, 3, '0', STR_PAD_LEFT),
                'paid_in' => date('d/m/Y', strtotime($received->paid_in)),
                'title'   => $received->title . $text,
                'number'  => str_pad($received->id, 6, '0', STR_PAD_LEFT),
                'value'   => 'R$ ' . $received->value,
            ];
        }
        $this->html = view(
            'livewire.admin.reports.tickets',
            [
                'title_postfix' => 'Relatório boletos',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'receiveds'     => $listReceiveds,
                'total'         => 'R$ ' . number_format($tot, 2, ",", "."),
            ]
        )->render();
    }
    /*Relatório de recibos em aberto */
    public function receipts()
    {
        $this->start = '2021-03-31';
        $openReceiveds = array();
        //$receiveds = Received::orderBy('id','asc')->get(); mudança feita em 26/12/22 por solicitação do presidente
        $receiveds = Received::select('id', 'title', 'active', 'paid_in', 'location_id', 'deleted_because', 'ambience_id')->orderBy('id', 'asc')->where('paid_in', '>', $this->start)->get();

        $bills = Bill::select('paid_in', 'id', 'deleted_because')->where('active', 3)->orderBy('id', 'asc')->where('paid_in', '>', $this->start)->get();
        $cashiers = Cashier::where('active', 3)->orderBy('id', 'asc')->where('paid_in', '>', $this->start)->get();

        foreach ($receiveds as $received) {
            if ($received->location_id) {
                $contact = str_pad($received->location->id, 5, '0', STR_PAD_LEFT);
                $text = " - " . $received->ambiences->title . '  ( Contrato nº ' . $contact . ' )';
            } else {
                $text = '';
            }
            if ($received->active == 0) {
                $openReceiveds[] = [
                    'number'  => str_pad($received->id, 6, '0', STR_PAD_LEFT),
                    'paid_in' => date('d/m/Y', strtotime($received->paid_in)),
                    'title'   => $received->title . $text,
                ];
            } elseif ($received->active == 3) {
                $inutilizedReceiveds[] = [
                    'number'  => str_pad($received->id, 6, '0', STR_PAD_LEFT),
                    'paid_in' => date('d/m/Y', strtotime($received->paid_in)),
                    'title'   => $received->deleted_because,
                ];
            }
        }
        $this->html = view(
            'livewire.admin.reports.receipts',
            [
                'title_postfix' => 'Relatório de recibos em aberto',
                'subtext' => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'openReceiveds'         => $openReceiveds,
                'inutilizedReceiveds'   => $inutilizedReceiveds,
                'bills'                 => $bills,
                'cashiers'              => $cashiers,
            ]
        )->render();
    }
    /*Relatório de pagamentos de mensalidade */
    public function monthlyPayment()
    {
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        $this->start = date('Y-m-d', strtotime($this->year . '-01-01'));
        $this->end = date('Y-m-d', strtotime($this->year . '-12-31'));

        $partners = Partner::select('name', 'partner_category_master', 'partner_category', 'id', 'registration_at')
            ->where('active', 1)
            ->where('discount', 0)
            ->where('partner_category_master', 'Sócio')
            ->orderBy('partner_category', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $tr = '';
        $row = array();
        foreach ($partners as $partner) {
            $line = '';

            $line = array(
                'name' => $partner->name,
                'color' => $partner->category->color,
                'category' => $partner->category->title,
                'value' => $partner->category->value,
                'registration_at' => date('Y-m-d', strtotime($partner->registration_at)),
            );
            $monthlyPayment = MonthlyPayment::select('paid_in', 'partner_id', 'ref', 'status')
                ->where('partner_id', $partner->id)
                ->where('status', '!=', 0)
                ->whereBetween('paid_in', [$this->start, $this->end])
                ->orderBy('paid_in', 'asc')
                ->get();
            foreach ($monthlyPayment as $mon) {
                // $paid = date('Y-m-d', strtotime($mon->paid_in));
                $paid = $mon->ref;
                if ($mon->status == 1) {
                    $line[$paid] = 'PG';
                } elseif ($mon->status == 2) {
                    $line[$paid] = 'LB';
                }
            }
            $row[] = $line;
        }
        // echo '<pre>';
        // print_r($row);
        // exit;

        $this->html = view(
            'livewire.admin.reports.mounthlyPayment',
            [
                'title_postfix' => 'Relatório de mensalidades',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'partners'      => $row,
                'year'          => $this->year,
            ]
        )->render();
    }
    /*Relatório de pagamentos com pix */
    public function pix()
    {
        $receiveds = Received::whereBetween('paid_in', [$this->start, $this->end])
            ->where('active', 1)
            ->where('form_payment', 'PIX')
            ->orderBy('paid_in', 'asc')
            ->get();
        $tot = 0;
        $itens = 0;
        foreach ($receiveds as $received) {
            $itens += 1;
            $tot += $received->convert_value($received->value);
            if ($received->location_id) {
                $contact = str_pad($received->location->id, 6, '0', STR_PAD_LEFT);
                $text = " - " . $received->ambiences->title . '  ( Contrato nº ' . $contact . ' )';
            } else {
                $text = '';
            }
            $listReceiveds[] = [
                'item'    => str_pad($itens, 3, '0', STR_PAD_LEFT),
                'paid_in' => $received->paid_in,
                'title'   => $received->title . $text,
                'number'  => str_pad($received->id, 6, '0', STR_PAD_LEFT),
                'value'   => 'R$ ' . $received->value,
            ];
        }

        $this->html = view(
            'livewire.admin.reports.pix',
            [
                'title_postfix' => 'Relatório de pagamentos com pix',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'receiveds'     => $listReceiveds,
                'total'   => 'R$ ' . number_format($tot, 2, ",", "."),
            ]
        )->render();
    }
    /*Relatório de acesso à piscina */
    public function accessPool()
    {
        $line = array();
        $accesses = Pool::whereBetween('created_at', [$this->start, $this->end])
            ->orderBy('id', 'desc')->get();
        foreach ($accesses as $access) {
            if ($access->table == 'passes') {
                $pass = Pass::where('id', $access->register_id)->first();
                $line[] = array(
                    'date'     => date('d/m/Y', strtotime($access->created_at)),
                    'hour'     => date('H:i', strtotime($access->created_at)),
                    'name'     => mb_strtoupper($pass->title),
                    'color'    => $pass->color,
                    'category' => 'PASSE ' . mb_strtoupper($pass->category),
                );
            } elseif ($access->table == 'partners') {
                $partner = Partner::select('id', 'name', 'partner_category_master', 'partner_category', 'registration_at')
                    ->where('id', $access->register_id)
                    ->first();
                $line[] = array(
                    'date'     => date('d/m/Y', strtotime($access->created_at)),
                    'hour'     => date('H:i', strtotime($access->created_at)),
                    'name'     => $partner->name,
                    'color'    => $partner->category->color,
                    'category' => $partner->category->title,
                );
            }
        }

        // echo '<pre>';
        // print_r($line);
        // exit;

        $this->html = view('livewire.admin.reports.accessPool',
            [
                'title_postfix' => 'Relatório de acesso das piscinas',
                'subtext'       => $this->title,
                'today'         => $this->today,
                'responsible'   => Auth::user()->name,
                'config'        => $this->config,

                'data'          => $line,
                'year'          => $this->year,
            ]
        )->render();

    }
}
