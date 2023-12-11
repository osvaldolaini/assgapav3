<?php

namespace App\Livewire\Admin\Charts;

use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Financial\Cashier;
use DateTime;
use Livewire\Component;

class SpendingBySector extends Component
{
    public $labels;
    public $color;
    public $data;
    public function render()
    {
        $this->chart();
        return view('livewire.admin.charts.spending-by-sector');
    }

    public function chart()
    {
        $start = new DateTime("-1 months");
        $end = date('Y-m-d');
        $total = 0;
        $bills = Bill::select('*')
            ->whereBetween('paid_in', [$start, $end])
            ->where('active', 1)
            ->orderBy('paid_in', 'asc')
            ->get();

        $cashiers = Cashier::select('*')
            ->whereBetween('paid_in', [$start, $end])
            ->where('active', 1)
            ->where('type', 2)
            ->orderBy('paid_in', 'asc')
            ->get();


        foreach ($bills as $bill) {
            $data[] = array(
                'value' => $bill->convert_value($bill->value),
                'category' => $bill->cost_center->category,
                'color' => $bill->cost_center->color,
            );
        }

        foreach ($cashiers as $cashier) {
            if ($cashier->cost_center_id == '') {
                $data[] = array(
                    'value' => $cashier->convert_value($cashier->value),
                    'category' => 'OUTROS',
                    'color' => '#fff'
                );
            } else {
                $data[] = array(
                    'value' => $cashier->convert_value($cashier->value),
                    'category' => $cashier->cost_center->category,
                    'color' => $cashier->cost_center->color,
                );
            }
        }

        $category = array();
        //soma os valores das categorias iguais dentro da array RESULT
        foreach ($data as $a) {
            $total += $a['value'];
            if (!isset($category[$a['category']])) {
                $category[$a['category']] = $a;
            } else {
                if ($category[$a['category']]['category'] == $a['category']) {
                    $category[$a['category']]['value'] = strval($a['value'] + $category[$a['category']]['value']);
                }
            }
        }
        foreach ($category as $key) {
            $val = ($key['value'] * 100) / $total;
            //$val = number_format($val, 2, '.', '');
            $this->color[] = $key['color'];
            $this->labels[] = $key['category'];
            $this->data[] = number_format($val, 0, '.', '');
        }
    }
}
