<?php

namespace App\Livewire\Admin\Schedule;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceUnavailability;
use App\Models\Admin\Locations\Location;
use App\Models\Admin\Registers\Partner;
use Carbon\Carbon;
use Livewire\Component;

class LocationCalendar extends Component
{
    public $location_date;
    public $ambience_id = '';
    public $partner_id = '';
    public $multiple = '';
    public $grace_period = false;
    public $events;
    public $detail;
    public $showModalView = false;

    protected $listeners =
    [
        'changeAmbience',
        'showModalRead',
        'checkDate'
    ];
    public function mount($ambience_id)
    {
        if ($ambience_id) {
            $this->ambience_id = $ambience_id;
            $this->events = $this->getCalendarReservation($this->ambience_id);
        }
    }

    public function render()
    {
        if ($this->ambience_id) {
            $this->events = $this->getCalendarReservation($this->ambience_id);
        }
        return view('livewire.admin.schedule.location-calendar');
    }
    public function changeAmbience($ambience_id,$partner_id)
    {
        $this->ambience_id = $ambience_id;
        $this->partner_id = $partner_id;
        $selectAmbience = Ambience::select('id', 'title', 'multiple')->
        find($this->ambience_id);
        $this->multiple = $selectAmbience->multiple;
        $this->dispatch('calendar', $this->getCalendarReservation($this->ambience_id));
    }


    public function getCalendarReservation($ambience_id)
    {
        $events = [];

        $calendar = array();
        $now = date('Y-m-d');
        $events = Location::select('id', 'ambience_id', 'partner_id', 'location_hour_start', 'location_hour_end', 'location_date')
            ->where('active', 1)
            ->where('ambience_id', $ambience_id)
            // ->where('location_date', '<=', $now)
            ->get();
        $amb = Ambience::where('id', $ambience_id)->first();

        $status = true;
        foreach ($events as $event) {
            if ($event->ambience_id) {
                $ambience = $amb->title;
                $color = $amb->category->color;
            } else {
                $color = '#0001ff';
                $ambience = $event->ambience;
            }
            if ($event->partner_id) {
                $partner = ($event->partners ? $event->partners->name:$event->partner);
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

            $calendar[] = array(
                'color' => $color,
                'title' => $partner,
                'start' => $start,
                'end' => $end,
                'id' => $event->id,
                'ambience_id' => $ambience_id,
            );
        }
        $unavailabilities = AmbienceUnavailability::where('active', 1)
            ->where('ambience_id', $ambience_id)
            ->get();

        foreach ($unavailabilities as $key) {
            $calendar[] = array(
                'color' => '#dc3545',
                'title' => 'Motivo: ' . $key->title,
                'start' => $key->start,
                'end' => $key->end,
                'id'  => $key->id,
                'ambience_id' => '',
            );
        }

        return $calendar;
    }
    public function checkDate($location_date)
    {
        $limit = date('Y-m-d', strtotime("+12 month", strtotime(now())));
        $initial = date('Y-m-d',  strtotime($location_date));
        $start = date('Y-m-d');
        if ($initial > $limit) {
            $this->openAlert('error', 'A data excede o limite de um ano.');
            return;
        }
        if ($initial < $start) {
            $this->openAlert('error', 'A data é menor do que o autorizado.');
            return;
        }
        if ($this->partner_id) {
            if ($this->verifyGracePeriod()) {
                $this->openAlert('error', 'Sócio em período de carência até '. $this->grace_period);
                return;
            }
        }

            $this->location_date = Carbon::parse($location_date)
                ->format('d/m/Y');

            $calendar = [];
            if ($this->multiple == 0) {
                $this->location_date = implode("-", array_reverse(explode("/", $this->location_date)));

                    $event = Location::where('active', 1)
                        ->where('ambience_id', $this->ambience_id)
                        ->where('location_date', $this->location_date)
                        ->first();
                    $unavailabilities = AmbienceUnavailability::where('active', 1)
                        ->where('ambience_id', $this->ambience_id)
                        ->get();
                    foreach ($unavailabilities as $key) {
                        $c = strtotime($key->end) - strtotime($key->start);
                        $dias = floor($c / (60 * 60 * 24));
                        $calendar[] = $key->start->format('Y-m-d');
                        for ($i = 0; $i < $dias; $i++) {
                            $date = date('Y-m-d', strtotime($key->end . '-' . $i . ' day'));
                            $calendar[] = $date;
                        }
                    }
                    if (!empty($calendar)) {
                        array_multisort($calendar);
                    }

                    if ($event) {
                        $this->openAlert('error', 'Infelizmente já existe uma locação neste dia.');
                    } else {
                        if (in_array($this->location_date, $calendar)) {
                            $this->openAlert('error', 'Infelizmente já existe uma locação neste dia.');
                        } else {
                            $this->dispatch('insertDate', $location_date);
                        }
                    }

            } else {
                $this->dispatch('insertDate', $location_date);
            }

    }
     //Testar carência
     public function verifyGracePeriod()
     {
         if (isset($this->ambience_id)) {
             $ambience = Ambience::where('active', 1)
                 ->where('id', $this->ambience_id)
                 ->first();
             if ($ambience->need == 0) {
                 return false;
             } else {
                 if (isset($this->partner_id)) {
                     $partner = Partner::select('grace_period')
                         ->find($this->partner_id);
                        $period = date('Y-m-d', strtotime(implode("-",array_reverse(explode("/",$partner->grace_period)))));

                     if ($period > date('Y-m-d')) {
                        $this->grace_period = $partner->grace_period;
                        return true;
                     } else {
                         return false;
                     }
                 } else {
                     return false;
                 }
             }
         }
     }
    public function getFullCalendar()
    {
        $calendar = array();
        $start_qry = date('Y-m-') . '01';
        // $LIKE = date('Y-m');

        $now = date('Y-m-d', strtotime("+2 month", strtotime($start_qry)));
        $events = Location::select('id', 'ambience_id', 'partner_id', 'location_hour_start', 'location_hour_end', 'location_date')
            ->where('active', 1)
            ->whereBetween('location_date', [$start_qry, $now])
            // ->where('location_date', 'LIKE','%'. $LIKE . '%')
            ->get();

        // dd($calendar);
        foreach ($events as $event) {
            $date = implode("-", array_reverse(explode("/", $event->location_date)));

            if ($event->ambience_id) {
                $amb = Ambience::where('id', $event->ambience_id)->first();
                $ambience = $amb->title;
                $color = $amb->category->color;
            } else {
                $color = '#0001ff';
                $ambience = $event->ambience;
            }
            if ($event->partner_id) {
                $partner = $event->partner;
            } else {
                $partner = $event->partner;
            }

            if ($event->location_hour_start != '') {
                if ($event->location_hour_start == '00:00:00') {
                    $start = $date;
                } else {
                    $start = $date . 'T' . date('h:i:s', strtotime($event->location_hour_start));
                }
            } else {
                $start = $date;
            }
            if ($event->location_hour_end != '') {
                if ($event->location_hour_end == '00:00:00') {
                    $end = $date;
                } else {
                    $end = $date . 'T' . date('h:i:s', strtotime($event->location_hour_end));
                }
            } else {
                $end = $date;
            }

            $calendar[] = array(
                'color' => $color,
                'title' => $ambience . '( ' . $partner . ' )',
                'start' => $start,
                'end' => $end,
                'id' => $event->id,
            );
        }
        // dd($calendar);
        return json_encode($calendar);
    }
    //READ
    public function showModalRead($id)
    {
        $this->showModalView = true;
        if (isset($id)) {
            $data = Location::where('id', $id)->first();
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
        $this->getFullCalendar();
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
