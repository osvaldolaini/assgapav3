<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Admin\Configs;
use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Master extends Component
{
    public function render()
    {
        $dataAtual = Carbon::now();
        if (Auth::user()->dashboard == 3) {
            // $this->sentEmail();
        }
        if ($dataAtual->day <= 7) {
            $this->generateMonthly();
        } else {
            Log::info('Já passou do período de criação');
        }
        // dd(Auth::user()->dashboard);
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
        $partners = Partner::select('id', 'partner_category')
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
            if (!MonthlyPayment::monthlyExists($ref, $monthly['partner_id'])) {
                MonthlyPayment::create([
                    'partner_id'    => $monthly['partner_id'],
                    'status'        => 0,
                    'ref'           => date('Y-m'),
                    'paid_in'       => date('Y-m') . '-02',
                    'value'         => $monthly['value'],
                    'created_by'    => 'automático',
                ]);
                $tot++;
            }
        }
        Log::info('Criadas ' . $tot . ' novas mensalidades');
    }
    public function sentEmail()
    {
        // $email = Configs::find(1)->email_happy;
        $date = date('Y');
        // $date_of_birth = date('Y-m-d');
        $date_of_birth = '1984-01-23';
        $countMail = 0;
        $partners = Partner::select('id', 'email', 'name', 'email_birthday')
            ->where('email', '!=', '')
            ->where('email_birthday', '<', $date)
            ->where('date_of_birth', '=', $date_of_birth)
            ->where('send_email_barthday', 1)
            // ->where('partner_category_master', 'Sócio')
            // ->limit(10)
            ->get();
        $totalEmails = $partners->count();
        if ($partners->count() > 0) {
            foreach ($partners as $partner) {
                if (filter_var($partner->email, FILTER_VALIDATE_EMAIL)) {
                    Mail::send(
                        new \App\Mail\BirthdayNew([
                            'partner' => $partner
                        ])
                    );
                    $countMail++;
                }

                $partner->email_birthday = $date;
                $partner->save();
            }

            $error = $totalEmails - $countMail;
            Log::info('Enviados ' . $countMail . ' emails de aniversário');
            $this->openAlert('success', $countMail . ' emails de aniversário enviados com sucesso.');
            $this->openAlert('error', $error . ' emails não foram por erro no cadastro ou falta de email.');
        }
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
