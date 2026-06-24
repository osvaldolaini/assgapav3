<?php

namespace App\Livewire\Admin\Dashboard;

use App\Livewire\Admin\Registers\Partners;
use App\Models\Admin\Configs;
use App\Models\Admin\Monthly\MonthlyPayment;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;


use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceUnavailability;
use App\Models\Admin\Locations\Location;
use Mpdf\Mpdf;

use Livewire\Attributes\On;

class Master extends Component
{
    public  $showJetModal = false;
    public $remove = 0;



    public $location_date;
    public $ambience_id = '';
    public $partner_id = '';
    public $multiple = '';
    public $year;
    public $mounth = '';
    public $nextyear;
    public $mounthWidth = 200;
    public $typeGrid = 'multiMonthYear';
    public $date;
    public $ambiences;
    public $events;
    public $detail;
    public $showModalView = false;

    protected $listeners =
    [
        'changeAmbience',
        'showModalRead',
        'checkDate'
    ];
    public function updateCalendar()
    {
        $this->dispatch('calendar', $this->getCalendarReservation($this->year));
    }

    public function mount()
    {
        $dependentOut = Partner::select('id', 'partner_category', 'student', 'date_of_birth')
            ->where('active', 1)
            ->with(['category'])
            ->where('partner_category_master', 'Dependente')
            ->where('remove_at', '>=', 21)->get();


        foreach ($dependentOut as $data) {
            if ((!$data->student && $data->age > 21) || ($data->student && $data->age > 24)) {
                $this->remove += 1;
            }
        }
        // dd($remove, $dependentOut);
        if ($this->remove > 0) {
            $this->showJetModal = true;
        }
    }
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
        if (Auth::user()->group->level <= 100) {
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
        } else {
            $this->calendar();
            $this->ambiences = Ambience::select('id', 'title')->orderBy('title', 'asc')
                ->where('active', 1)->get();
            $this->events = $this->getCalendarReservation($this->year);
            return view('livewire.admin.dashboard.external-seller');
        }
    }
    public function generateMonthly()
    {
        $tot = 0;
        $partners = Partner::select('id', 'partner_category')
            ->where('active', 1)
            ->with(['category'])
            ->where('discount', '!=', 1)
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

    public function go_to()
    {
        redirect()->route('dependentes-out');
    }
    //Vendedor Externo
    public function calendar()
    {
        $this->year = date('Y');
        $this->ambiences = Ambience::select('id', 'title')->orderBy('title', 'asc')
            ->where('active', 1)->get();
        $this->events = $this->getCalendarReservation($this->year);
        $this->date = now();
        $this->nextyear = date('Y') + 1;
        $this->mounth = date('m'); // Ateração realizada em 31/01/2024 solicitação do clube
    }

    public function getCalendarReservation($year)
    {
        $events = [];
        $calendar = array();
        if ($this->mounth) {
            $this->typeGrid =  'dayGridMonth';
            $this->date = date($year . '-' . $this->mounth . '-01');
        }

        if ($this->ambience_id) {
            $events = Location::select(
                'id',
                'ambience_id',
                'partner_id',
                'location_hour_start',
                'location_hour_end',
                'location_date'
            )
                ->where('ambience_id', $this->ambience_id)
                ->where('active', 1)
                // ->where('location_date', 'LIKE', '%' . $year . '%')
                ->where('location_date', '>=', date('Y-m-d'))
                ->get();
        } else {
            $events = Location::select(
                'id',
                'ambience_id',
                'partner_id',
                'location_hour_start',
                'location_hour_end',
                'location_date'
            )
                ->where('active', 1)
                // ->where('location_date', 'LIKE', '%' . $year . '%')
                ->where('location_date', '>=', date('Y-m-d'))
                ->get();
        }

        // dd($events,$this->year);
        foreach ($events as $event) {
            if ($event->ambience_id) {
                $ambience = $event->ambiences->title;
                $color = $event->ambiences->category->color;
            } else {
                $color = '#0001ff';
                $ambience = $event->ambience;
            }
            if ($event->partner_id) {
                $partner = ($event->partners ? $event->partners->name : $event->partner);
            } else {
                $partner = $event->partner;
            }
            $date = implode("-", array_reverse(explode("/", $event->location_date)));

            if ($event->location_hour_start != '') {
                if ($event->location_hour_start == '00:00:00') {
                    $start = $date;
                } else {
                    $start = $date . ' ' . date('h:i:s', strtotime($event->location_hour_start));
                }
            } else {
                $start = $date;
            }
            if ($event->location_hour_end != '') {
                if ($event->location_hour_end == '00:00:00') {
                    $end = $date;
                } else {
                    $end = $date . ' ' . date('h:i:s', strtotime($event->location_hour_end));
                }
            } else {
                $end = $date;
            }

            if ($this->ambience_id) {
                $title = $partner;
            } else {
                $title = $ambience . ' - ' . $partner;
            }

            $calendar[] = array(
                'color' => $color,
                'title' => $title,
                'start' => $start,
                'end' => $end,
                'id' => $event->id,
            );
        }
        // // dd($calendar);
        // $unavailabilities = AmbienceUnavailability::where('active', 1)
        //     ->get();

        // foreach ($unavailabilities as $key) {
        //     $calendar[] = array(
        //         'color' => '#dc3545',
        //         'title' => 'Motivo: ' . $key->title,
        //         'start' => $key->start,
        //         'end' => $key->end,
        //         'id'  => $key->id,
        //     );
        // }
        //  // dd($calendar);
        if ($this->ambience_id) {
            $unavailabilities = AmbienceUnavailability::where('active', 1)
                ->where('ambience_id', $this->ambience_id)
                ->where('validity', '>=', date('Y-m-d'))
                ->get();
        } else {
            $unavailabilities = AmbienceUnavailability::where('active', 1)
                ->where('validity', '>=', date('Y-m-d'))
                ->get();
        }

        // dd($unavailabilities);
        if ($unavailabilities) {
            foreach ($unavailabilities as $key) {

                $start = implode("-", array_reverse(explode("/", $key->start))) . ' 00:00:00';
                $end = implode("-", array_reverse(explode("/", $key->end))) . ' 23:59:59';

                if ($key->type == 0) {
                    $text = 'Pré-reserva: ' . $key->title;
                } else {
                    $text = 'Motivo: ' . $key->title;
                }
                $calendar[] = array(
                    'color' => '#dc3545',
                    'title' => $text,
                    'start' => $start,
                    'end' => $end,
                    'id'  => $key->id,
                    'type_event' => 0
                );
            }
        }

        return $calendar;
    }

    public function showModalRead($id)
    {

        $this->showModalView = true;
        if (isset($id)) {
            $data = Location::find($id);
            $this->detail = [
                'Locatário'         => $data->partners->name,
                'Motivo'            => ($data->reasons ? $data->reasons->title : $data->event_type),
                'Beneficiado'       => $data->event_benefited,
                'Criada em'         => $data->updated,
                'Criada por'        => $data->created_by,
                'Atualizada'        => $data->updated,
                'Atualizada por'    => $data->updated_by,
            ];
            //   $this->logs = logging($data->id,$this->model);
        } else {
            $this->detail = '';
        }
        // $this->getFullCalendar();
    }
}
