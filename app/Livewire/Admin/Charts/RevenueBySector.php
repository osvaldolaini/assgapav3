<?php

namespace App\Livewire\Admin\Charts;

use App\Models\Admin\Financial\Cashier;
use DateTime;
use Livewire\Component;

class RevenueBySector extends Component
{
    public $labels;
    public $color;
    public $data;

    public function render()
    {
        $this->chart();
        return view('livewire.admin.charts.revenue-by-sector');
    }
    public function chart()
    {
        $start=new DateTime("-1 months");
        $end=date('Y-m-d');
        $data = array();
        $total=0;


        $cashiers = Cashier::select('title', 'value')
        ->whereBetween('paid_in',[$start,$end])
        ->where('active', 1)
        ->where('type', 1)
        ->where('status', 0)
        ->get()
        ->groupBy('title')
        ->sort();

        $sangrias = Cashier::select('title', 'value')
            ->whereBetween('paid_in',[$start,$end])
            ->where('active', 1)
            ->where('status', 1)
            ->get()
            ->groupBy('title');
            $val = 0;

            foreach ($sangrias as $key => $value) {
                $val = 0;
                foreach ($value->toArray() as $key) {
                    str_replace(' ', '', $key['value']);
                    ltrim($key['value']);
                    $key['value'] = str_replace('.', '', $key['value']);
                    $key['value'] = str_replace(',', '.', $key['value']);
                    $val += str_replace(' ', '', $key['value']);
                }
                $data[0]=array(
                    'value'=>$val,
                    'category'=>'SANGRIAS',
                );
                $total += $val;
            }
            // dd($data)
            foreach ($cashiers as $key => $value) {
                $val = 0;
                foreach ($value->toArray() as $key) {
                    str_replace(' ', '', $key['value']);
                    ltrim($key['value']);
                    $key['value'] = str_replace('.', '', $key['value']);
                    $key['value'] = str_replace(',', '.', $key['value']);
                    $val += str_replace(' ', '', $key['value']);
                }
                $data[]=array(
                    'value'=>$val,
                    'category'=>$key['title'],
                );
                $total += $val;
            }

            foreach ($data as $key) {
                $val = ($key['value'] * 100) / $total;
                $this->labels[] = $key['category'];
                $this->data[] = number_format($val, 0, '.', '');
            }
    }

}
