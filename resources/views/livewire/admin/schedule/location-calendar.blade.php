<div>
    <div class="py-0 pl-0 pr-1 w-100" id="calendar" wire:ignore wire:model.live='events'></div>

    {{-- MODAL READ --}}
    <x-dialog-modal wire:model="showModalView">
        <x-slot name="title">Detalhes</x-slot>
        <x-slot name="content">
            <dl class="text-gray-900 divide-y divide-gray-200 max-w dark:text-white dark:divide-gray-700">
                @if ($detail)
                    @foreach ($detail as $item => $value)
                        @if ($value)
                            @if ($item == 'Foto')
                                <figure class="w-48">
                                    <img class="photo" src="{{ $value }}" alt="Movie" />
                                </figure>
                            @else
                                <div class="flex flex-col pb-1">
                                    <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $item }}:</dt>
                                    <dd class="text-lg font-semibold">
                                        {{ $value }}
                                    </dd>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endif
                {{-- @if ($logs)
                    {!! $logs !!}
                @endif --}}
            </dl>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showModalView')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <script>
        document.addEventListener('livewire:initialized', function() {
            var calendarEl = document.getElementById('calendar');

            @this.on('calendar', (event) => {
                var events = event[0];
                var calendar = new Calendar(calendarEl, {
                    plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
                    navLinks: true,
                    selectable: true,
                    buttonText: {
                        today: 'Hoje'
                    },
                    weekends: true,
                    showNonCurrentDates: false,
                    eventColor: '#D30E28',
                    locale: 'br',
                    timeZone: 'local',
                    initialView: 'dayGridMonth',
                    height: 650,
                    eventDisplay: 'block',
                    events: events,

                    eventClick: function(info) {
                        Livewire.dispatch('showModalRead', {
                            id: info.event.id,
                            type: info.event.extendedProps.type_event
                        })
                    },
                    navLinkDayClick: function(date, jsEvent) {
                        Livewire.dispatch('checkDate', {
                            location_date: date.toISOString()
                        })
                    }

                });
                // console.log(events)
                calendar.render();
            });
            var calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
                navLinks: true,
                selectable: true,
                buttonText: {
                    today: 'Hoje'
                },
                weekends: true,
                showNonCurrentDates: false,
                eventColor: '#D30E28',
                locale: 'br',
                timeZone: 'local',
                initialView: 'dayGridMonth',
                height: 650,
                eventDisplay: 'block',
                events: @this.events,

                eventClick: function(info) {
                    // console.log(info.event)
                    Livewire.dispatch('showModalRead', {
                        id: info.event.id,
                        type: info.event.extendedProps.type_event
                    })
                },
                navLinkDayClick: function(date, jsEvent) {
                    Livewire.dispatch('checkDate', {
                        location_date: date.toISOString()
                    })
                },

            });
            calendar.render();
        });
    </script>
</div>
