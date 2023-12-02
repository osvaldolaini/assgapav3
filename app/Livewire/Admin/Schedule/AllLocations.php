<?php

namespace App\Livewire\Admin\Schedule;

use App\Models\Admin\Ambiences\Ambience;
use App\Models\Admin\Ambiences\AmbienceUnavailability;
use App\Models\Admin\Configs;
use App\Models\Admin\Locations\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mpdf\Mpdf;

use Livewire\Attributes\On;

class AllLocations extends Component
{
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
        $this->dispatch('calendar', $this->getCalendarReservation());
    }

    public function mount()
    {
        $this->ambiences = Ambience::select('id', 'title')->orderBy('title', 'asc')
            ->where('active', 1)->get();
        $this->events = $this->getCalendarReservation();
        $this->year = date('Y');
        $this->date = now();
        $this->nextyear = date('Y') + 1;
    }

    public function render()
    {
        $this->ambiences = Ambience::select('id', 'title')->orderBy('title', 'asc')
            ->where('active', 1)->get();
        $this->events = $this->getCalendarReservation();
        return view('livewire.admin.schedule.all-locations');
    }

    #[On('printSchedule')]
    public function printSchedule()
    {
        // Crie uma instância do mPDF
        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'orientation' => 'L',
            'margin_left'   => 10,
            'margin_right'   => 10,
            'margin_top'    => 10,
            'default_font_size'  => 9,
            'default_font'  => 'arial',
        ]);

        $today = Carbon::parse(now())->locale('pt-BR');

        if ($this->mounth) {
            $date = date($this->year . '-' . $this->mounth);
        } else {
            $date = date($this->year);
        }

        if ($this->ambience_id) {
            $events = Location::select(
                'id',
                'ambience_id',
                'partner_id',
                'location_date',
                'event_benefited',
                'location_hour_start',
                'location_hour_end',
                'reason_event_id'
            )
                ->orderBy('location_date', 'asc')
                ->where('ambience_id', $this->ambience_id)
                ->where('active', 1)
                ->where('location_date', 'LIKE', '%' . $date . '%')
                ->get();
        } else {
            $events = Location::select(
                'id',
                'ambience_id',
                'partner_id',
                'location_date',
                'location_hour_start',
                'location_hour_end',
                'event_benefited',
                'reason_event_id'
            )
                ->orderBy('location_date', 'asc')
                ->where('active', 1)
                ->where('location_date', 'LIKE', '%' . $date . '%')
                ->get();
        }

        // dd($events);
        // Renderize a view do Livewire
        $html = view(
            'livewire.admin.schedule.print',
            [
                'data'              => $events,
                'config'            => Configs::find(1),
                'contract_number'   => 'Agenda de locações',
                'subtext'           => 'Agenda de locações',
                'responsible'       => Auth::user()->name,
                'today'             => $today->translatedFormat('d F Y'),
            ]
        )->render();
        // Adicione o conteúdo HTML ao PDF
        $mpdf->WriteHTML($html);

        // Salve o PDF temporariamente
        $down = storage_path('app/public/livewire-tmp/agenda.pdf');
        $pdfPath = url('storage/livewire-tmp/agenda.pdf');

        $mpdf->Output($down, 'F');

        $this->dispatch('openPdfInNewTab', pdfPath: $pdfPath);
    }

    public function getCalendarReservation()
    {
        $events = [];
        $calendar = array();
        if ($this->mounth) {
            $this->typeGrid =  'dayGridMonth';
            $this->date = date($this->year . '-' . $this->mounth . '-01');
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
                ->where('location_date', 'LIKE', '%' . $this->year . '%')
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
                ->where('location_date', 'LIKE', '%' . $this->year . '%')
                ->get();
        }
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
            $date = date('Y-m-d', strtotime($event->location_date));
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
        $unavailabilities = AmbienceUnavailability::where('active', 1)
            ->get();

        foreach ($unavailabilities as $key) {
            $calendar[] = array(
                'color' => '#dc3545',
                'title' => 'Motivo: ' . $key->title,
                'start' => $key->start,
                'end' => $key->end,
                'id'  => $key->id,
            );
        }

        return $calendar;
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
        // $this->getFullCalendar();
    }
    //MESSAGE
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }
}
