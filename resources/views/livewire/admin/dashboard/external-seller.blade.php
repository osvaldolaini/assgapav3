<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    AGENDA
                </h3>
            </div>
            <div class="flex justify-end col-span-2 text-right">
                {{-- <x-action-loading-calendar></x-action-loading-calendar> --}}

            </div>
        </div>
    </x-breadcrumb>

    <div class="pt-3 bg-white dark:bg-gray-800 sm:rounded-lg">
        <div>
            <div
                class="flex flex-col items-end justify-start grid-cols-3 gap-1 px-4 space-y-3 md:flex-row md:space-y-0 md:space-x-1">

                <div class="col-span-1">
                    <label for="ambience_id">Ambiente </label>
                    <Select wire:model="ambience_id"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="">Todos</option>
                        @foreach ($ambiences as $ambience)
                            <option value="{{ $ambience->id }}">
                                {{ $ambience->title }}
                            </option>
                        @endforeach
                    </Select>
                </div>
                <div class="flex items-end col-span-1">
                    <label>&nbsp; </label>
                    <div class="justify-end p-0 tooltip tooltip-top" data-tip="Atualizar">
                        <button wire:click="updateCalendar()"
                            class="flex justify-end px-3 py-2 text-white transition-colors duration-200 bg-blue-500 rounded-md hover:bg-white hover:text-blue-500 whitespace-nowrap">Atualizar
                            <svg class="w-6 h-6 ml-1" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.6091 5.89092L15.5 9H21.5V3L18.6091 5.89092ZM18.6091 5.89092C16.965 4.1131 14.6125 3 12 3C7.36745 3 3.55237 6.50005 3.05493 11M5.39092 18.1091L2.5 21V15H8.5L5.39092 18.1091ZM5.39092 18.1091C7.03504 19.8869 9.38753 21 12 21C16.6326 21 20.4476 17.5 20.9451 13"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

            <div class="px-4 my-6 bg-white dark:bg-gray-800 sm:rounded-lg">
                <div class="py-0 pl-0 pr-1 w-100 " id="calendar" wire:ignore wire:model.live='events'>
                </div>

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
                                                <dt class="text-gray-500 md:text-lg dark:text-gray-400">
                                                    {{ $item }}:</dt>
                                                <dd class="text-lg font-semibold">
                                                    {{ $value }}
                                                </dd>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
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
                                plugins: [dayGridPlugin, timeGridPlugin, listPlugin, multiMonthPlugin],
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
                                initialDate: @this.date,
                                initialView: @this.typeGrid,
                                multiMonthMinWidth: @this.mounthWidth,
                                eventDisplay: 'block',
                                events: @this.events,
                                eventClick: function(info) {
                                    Livewire.dispatch('showModalRead', {
                                        id: info.event.id
                                    })
                                },
                            });
                            calendar.render();
                        });

                        var calendar = new Calendar(calendarEl, {
                            plugins: [dayGridPlugin, timeGridPlugin, listPlugin, multiMonthPlugin],
                            navLinks: true,
                            selectable: true,
                            buttonText: {
                                today: 'Hoje'
                            },

                            date: @this.date,
                            weekends: true,
                            showNonCurrentDates: false,
                            eventColor: '#D30E28',
                            locale: 'br',
                            timeZone: 'local',
                            initialView: @this.typeGrid,
                            multiMonthMinWidth: @this.mounthWidth,
                            eventDisplay: 'block',
                            events: @this.events,
                            eventClick: function(info) {
                                Livewire.dispatch('showModalRead', {
                                    id: info.event.id
                                })
                            },
                        });
                        calendar.render();
                    });

                    document.addEventListener('livewire:init', () => {
                        Livewire.on('openPdfInNewTab', ({
                            pdfPath
                        }) => {
                            window.open(pdfPath, '_blank');
                        })
                    })
                </script>
            </div>
        </div>
    </div>

</div>
