<?php

namespace App\Livewire\Admin\Charts;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Locations\Location;
use Livewire\Component;

class LocationByEnvironment extends Component
{

    public $labels;
    public $dataLocations;

    public function render()
    {
        $this->chart();
        // dd($this->dataLocations);
        return view('livewire.admin.charts.location-by-environment');
    }
    public function chart()
    {
        $locations = Location::where('active', 1)
            ->pluck('ambience_id')->unique();
        $total = Location::where('active', 1)->count();

        foreach ($locations as $key => $value) {
            $loc = Ambience::where('active',1)->find($value);
            $count = Location::where('active', 1)
                ->where('ambience_id', $value)
                ->count();
                $val = ($count * 100) / $total;
            if ($loc) {
                $this->labels[]=$loc->title;
                $data[] = number_format($val, 2, '.', '');
            }else{
                $this->labels[]='OUTROS';
                $data[] = number_format($val, 2, '.', '');
            }
        }
        $numericData = array_map('floatval', $data);
        $this->dataLocations = $numericData;
    }
}
