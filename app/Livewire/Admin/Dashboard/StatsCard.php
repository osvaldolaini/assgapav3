<?php

namespace App\Livewire\Admin\Dashboard;


use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Financial\Cashier;
use App\Models\Admin\Financial\Received;
use App\Models\Admin\Locations\Installment;
use App\Models\Admin\Locations\Location;
use App\Models\Admin\Pool\Pass;
use App\Models\Admin\Pool\Pool;
use App\Models\Admin\Registers\Partner;
use Livewire\Component;

class StatsCard extends Component
{
    public $partners;
    public $partnerLate;
    public $installmentLates;
    public $bill;
    public $locations;
    public $deleteLocations;
    public $cashier;
    public $reports;
    public $reportsTiny;
    public $charts;
    public $dailyreports;
    public $lastReceiveds;
    public $accessesPool = [];

    public function mount(
        $partners,
        $installmentLates,
        $bill,
        $partnerLate,
        $locations,
        $deleteLocations,
        $lastReceiveds,
        $cashier,
        $reports,
        $reportsTiny,
        $dailyreports,
        $accessesPool,
        $charts
    ) {
        $this->reports = $reports;
        $this->reportsTiny = $reportsTiny;
        $this->dailyreports = $dailyreports;
        $this->charts = $charts;

        if ($accessesPool) {
            $accesses = Pool::select('table', 'register_id', 'created_at')->orderBy('id', 'desc')->limit(5)->get();
            foreach ($accesses as $access) {
                if ($access->table == 'passes') {
                    $pass = Pass::where('id', $access->register_id)->first();
                    $pool[] = array(
                        'date'     => date('Y-m-d', strtotime($access->created_at)),
                        'hour'     => date('H:i', strtotime($access->created_at)),
                        'name'     => mb_strtoupper($pass->title),
                        'color'    => $pass->color,
                        'category' => 'PASSE ' . mb_strtoupper($pass->category),
                    );
                } elseif ($access->table == 'partners') {
                    $partner = Partner::select('id', 'name', 'partner_category_master', 'partner_category', 'registration_at')
                        ->where('id', $access->register_id)
                        ->first();
                    $pool[] = array(
                        'date'     => date('d/m/Y', strtotime($access->created_at)),
                        'hour'     => date('H:i', strtotime($access->created_at)),
                        'name'     => $partner->name,
                        'color'    => $partner->category->color,
                        'category' => $partner->category->title,
                    );
                }
                $this->accessesPool = json_encode($pool);
            };
        }


        /**Vencimento das contas e boletos */
        $venc = date("Y-m-d", strtotime('+2 days', strtotime(date('Y-m-d'))));

        if ($partners) {
            $this->partners = Partner::where('partner_category_master', 'Sócio')->count();
        }
        if ($partnerLate) {
            $this->partnerLate = count($this->partnerLate());

            // dd($this->partnerLate());
        }
        if ($locations) {
            /**Locações */
            $this->locations = Location::where('location_date', '>=', date('Y-m-d'))
                ->where('active', 1)->get()->count();
        }
        if ($deleteLocations) {
            /**Locações */
            $this->deleteLocations = Location::where('active', 2)->get()->count();
        }
        if ($bill) {
            /**Contas pagas no mês*/
            $month =  date('m');
            $year =  date('Y');
            $start = date('Y-m-d', strtotime($year . '-' . $month . '-01'));
            if ($month == 2) {
                $day = '28';
            } elseif ($month == '4' or $month == '6' or $month == '9' or $month == '11') {
                $day = '30';
            } else {
                $day = '31';
            }
            $end = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));
            /*Saídas de valor com user FIN  */
            $this->bill = Bill::whereBetween('paid_in', [$start, $end])
                ->where('active', 1)
                ->where('type', 'FIN')
                ->get()->count();
        }
        if ($installmentLates) {
            /**Pagamentos à receber */
            $this->installmentLates = Installment::where('active', 0)
                ->where('installment_maturity_date', '<', $venc)
                ->where('value', '>', 0)
                ->get()->count();
        }
        if ($lastReceiveds) {
            /**Ultimos boletos criados */
            $this->lastReceiveds = Received::orderBy('id', 'desc')->limit(5)->get();
        }
        if ($cashier) {
            $this->cashier = number_format($this->balance(), 2, ",", ".");
        }
    }
    public function render()
    {
        return view('livewire.admin.dashboard.stats-card');
    }
    public function partnerLate()
    {
        $row = array();
        $partners = Partner::select('id', 'registration_at', 'partner_category')
            ->where('active', 1)
            //->where('id',8246)
            ->with(['category'])
            ->where('discount', 0)
            ->where('partner_category_master', 'Sócio')
            ->orderBy('partner_category', 'asc')
            ->orderBy('name', 'asc')
            ->get();


        foreach ($partners as $partner) {
            $refs = array();
            $nrefs = array();
            $day = date('d', strtotime($partner->registration_at));
            if (date('Y', strtotime($partner->registration_at)) >= 2017) {
                $start = date('Y', strtotime($partner->registration_at));
                $mStart = date('m', strtotime($partner->registration_at)) + 1;
            } else {
                $start = 2017;
                $mStart = 1;
            }
            for ($i = $start; $i < date('Y') + 1; $i++) {
                if ($start == $i) {
                    for ($m = $mStart; $m < 13; $m++) {
                        if ($i . '-' . sprintf("%02d", $m) . '-' . date('d') <= date('Y-m') . '-' . $day) {
                            $refs[$i . '-' . sprintf("%02d", $m)] = $i . '-' . sprintf("%02d", $m);
                        }
                    }
                } else {
                    for ($m = 1; $m < 13; $m++) {
                        if ($i . '-' . sprintf("%02d", $m) . '-' . date('d') <= date('Y-m') . '-' . $day) {
                            $refs[$i . '-' . sprintf("%02d", $m)] = $i . '-' . sprintf("%02d", $m);
                        }
                    }
                }
            }

            // foreach ($partner->monthlys as $monthly) {
            //     if ($monthly->status != 0) {
            //         if (array_search($monthly->ref, $refs)) {
            //             unset($refs[$monthly->ref]);
            //         }
            //     }
            // }
            // if ($refs) {
            //     $row[] = $refs;
            // }
            foreach ($partner->monthlys as $monthly) {
                foreach ($partner->monthlys as $monthly) {
                    if ($monthly->status == 0) {
                        if (array_search($monthly->ref, $refs)) {

                            $nrefs[$monthly->ref] = $monthly->ref;
                        }
                    }
                }
                if ($nrefs) {
                    $row[] = $nrefs;
                }
            }
        }


        return $row;
    }
    public function balance()
    {
        $month =  date('m');
        $year =  date('Y');
        $day = date('d');
        $end = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));

        $oldBills = Bill::where('type', 'FIN')
            ->where('paid_in', '<=', $end)
            ->where('active', 1)
            ->get();
        $oldValues = 0;

        foreach ($oldBills as $oldBill) {
            $oldValues += $oldBill->convert_value($oldBill->value);
        }

        /*Caixa (entradas e saídas)*/
        $oldCashiers = Cashier::where('paid_in', '<=', $end)
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
        $tot = $oldEnter - $oldValues;
        return $tot;
    }
}
