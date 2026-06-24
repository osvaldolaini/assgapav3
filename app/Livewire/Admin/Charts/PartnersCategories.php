<?php

namespace App\Livewire\Admin\Charts;

use App\Models\Admin\Configs\PartnerCategory;
use App\Models\Admin\Registers\Partner;

use Livewire\Component;

class PartnersCategories extends Component
{
    public $labels;
    public $color;
    public $data;

    public function render()
    {
        $this->chart();
        return view('livewire.admin.charts.partners-categories');
    }
    public function chart()
    {
        $this->labels = [];
        $this->data = [];

        $categories = PartnerCategory::where('active', 1)->get();

        foreach ($categories as $category) {
            $total = Partner::where('partner_category_master', 'Sócio')
                ->where('partner_category', $category->id)
                ->count();
            if ($total > 0) {
                $this->labels[] = $category->title;
                $this->data[] = $total;
            }
        }
    }
}
