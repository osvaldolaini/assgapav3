<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Master extends Component
{
    public function render()
    {
        $dataAtual = Carbon::now();
        if ($dataAtual->day <= 7) {
            $this->generateMonthly();
        }else{
            Log::info('Já passou do período de criação');
        }

        switch (Auth::user()->dashboard) {
            case 1:
                return view('livewire.admin.dashboard.master');
                break;
            case 2:
                return view('livewire.admin.dashboard.financial');
                break;
            case 3:
                return view('livewire.admin.dashboard.secretary');
                break;
            case 4:
                return view('livewire.admin.dashboard.director');
                break;
            default:
                return view('livewire.admin.dashboard.director');
                break;
        }
    }
    public function generateMonthly()
    {
        $tot = 0;
        $partners = Partner::select('id','partner_category')
        ->where('active', 1)
        ->with(['category'])
        ->where('discount', 0)
        ->where('partner_category_master', 'Sócio')
        ->orderBy('partner_category', 'asc')
        ->orderBy('name', 'asc')
        // ->limit(20)
        ->get();

        $ref = date('Y-m');

        foreach ($partners as $partner) {
            $monthlys[] = [
                'partner_id'    => $partner->id,
                'value'         => $partner->category->value,
            ];
        }
        foreach ($monthlys as $monthly) {
            // Verifica se já existe uma mensalidade para o mês desejado
            if (!MonthlyPayment::monthlyExists($ref,$monthly['partner_id'])) {
                MonthlyPayment::create([
                    'partner_id'    => $monthly['partner_id'],
                    'status'        => 0,
                    'ref'           => date('Y-m'),
                    'paid_in'       => date('Y-m').'-02',
                    'value'         => $monthly['value'],
                    'created_by'    => 'automático',
                ]);
                $tot++;
            }
        }
        Log::info('Criadas '.$tot.' novas mensalidades');
    }
}
