<?php

namespace App\Livewire\Admin\Charts;

use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Financial\Cashier;
use App\Models\Admin\Financial\Received;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class IncomeExpenses extends Component
{

    public $labels;
    public $enter;
    public $out;

    public function render()
    {
        $this->chart();
        return view('livewire.admin.charts.income-expenses');
    }
    public function chart()
    {
        $month = array();
        for ($i = 0; $i < 6; $i++) {
            $m = new DateTime("-" . $i . " months");
            $month[] = $m->format('Y-m');
        }

        sort($month);
        foreach ($month as $key => $value) {

            // $month_br[] = date('M', strtotime($value));
            $today = Carbon::parse($value)->locale('pt-BR');
            $month_br[] = $today->translatedFormat('M');
            $e = 0;
            $o = 0;
            $bill = 0;
            // MODIFICADO EM 06/07/2021
            $cashierDatas =  Cashier::where(Cashier::raw("DATE_FORMAT(paid_in, '%Y-%m')"), $value)
                ->where('active', 1)
                ->where('type', 1)
                ->where('status', 0)
                ->get();
            foreach ($cashierDatas as $key) {
                $e += $key->convert_value($key->value);
            }
            $receivedData = Received::where(Received::raw("DATE_FORMAT(paid_in, '%Y-%m')"), $value)
                ->where('active', 1)
                ->where('form_payment', 'DIN')
                ->get();
            foreach ($receivedData as $key) {
                $e += $key->convert_value($key->value);
            }
            // FIM MODIFICADO EM 06/07/2021
            $enter[] = $e;
            $cashierOut = Cashier::where(Cashier::raw("DATE_FORMAT(paid_in, '%Y-%m')"), $value)
                ->where('active', 1)
                ->where('type', 2)
                ->get();
            foreach ($cashierOut as $key) {
                $o += $key->convert_value($key->value);
            }
            $BillOut = Bill::where(Bill::raw("DATE_FORMAT(paid_in, '%Y-%m')"), $value)
                ->where('active', 1)
                ->get();
            foreach ($BillOut as $key) {
                $bill += $key->convert_value($key->value);
            }
            $out[] = $o + $bill;
        }
        $this->labels =  $month_br;
        $this->enter =  $enter;
        $this->out =  $out;
    }
}
