<?php

namespace App\Livewire\Admin\Charts;

use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewPartner extends Component
{
    public $labels;
    public $data;
    public $datasets;

    public function render()
    {
        $this->chart();
        // dd($this->datasets);
        return view('livewire.admin.charts.new-partner');
    }
    public function chart()
    {
        $months = [];
        $labels = [];

        $dataNew = [];
        $dataLeft = [];
        $dataReturned = [];

        for ($i = 0; $i < 12; $i++) {
            $m = new DateTime("-$i months");
            $months[] = $m->format('Y-m');
        }

        sort($months);

        foreach ($months as $value) {

            $date = Carbon::parse($value)->locale('pt-BR');
            $labels[] = $date->translatedFormat('M');

            // 🟢 NOVOS (criou já como Sócio)
            $new = Partner::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$value])
                ->where('partner_category_master', 'Sócio')
                ->count();

            // 🔴 SAÍRAM (virou Não Sócio)
            $left = Partner::whereRaw("DATE_FORMAT(active_changed_at, '%Y-%m') = ?", [$value])
                ->where('partner_category_master', 'Não Sócio')
                ->count();
            // $left = DB::table('activity_log')
            //     ->where('subject_type', Partner::class)
            //     ->where('description', 'update')
            //     ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$value])
            //     ->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(properties, '$.old.partner_category_master'))) = 'não sócio'")
            //     ->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(properties, '$.attributes.partner_category_master'))) = 'não sócio'")
            //     ->count();

            // 🔵 VOLTARAM (voltou a ser Sócio)
            $returned = Partner::whereRaw("DATE_FORMAT(active_changed_at, '%Y-%m') = ?", [$value])
                ->where('partner_category_master', 'Sócio')
                ->whereColumn('created_at', '<', 'active_changed_at') // garante que não é cadastro novo
                ->count();

            // $returned = DB::table('activity_log')
            //     ->where('subject_type', Partner::class)
            //     ->where('description', 'update')
            //     ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$value])
            //     ->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(properties, '$.old.partner_category_master'))) = 'não sócio'")
            //     ->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(properties, '$.attributes.partner_category_master'))) = 'sócio'")
            //     ->count();

            $dataNew[] = $new;
            $dataLeft[] = $left;
            $dataReturned[] = $returned;
        }

        $this->labels = $labels;

        $this->datasets = [
            [
                'label' => 'Novos',
                'data' => $dataNew,
            ],
            [
                'label' => 'Saíram',
                'data' => $dataLeft,
            ],
            [
                'label' => 'Voltaram',
                'data' => $dataReturned,
            ],
        ];
    }
}
