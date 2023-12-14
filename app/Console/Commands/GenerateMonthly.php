<?php

namespace App\Console\Commands;

use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Registers\Partner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateMonthly extends Command
{
    public $monthlys;
    public $test;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tot = 0;
        $partners = Partner::select('id','partner_category')
        ->where('active', 1)
        ->with(['category'])
        ->where('discount', 0)
        ->where('partner_category_master', 'Sócio')
        ->orderBy('partner_category', 'asc')
        ->orderBy('name', 'asc')
        // ->limit(20) teste
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
