<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-2 text-gray-600 ">
            <div class="col-span-6 justify-items-validity_of_card">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    AGENDA
                </h3>
            </div>
            <div class="col-span-2 flex justify-end">
                <x-action-loading-calendar></x-action-loading-calendar>
            </div>
        </div>
    </x-breadcrumb>
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div>
            <div
                class="flex flex-col grid-cols-3 gap-1 items-end justify-start px-4
                        space-y-3 md:flex-row md:space-y-0 md:space-x-1">
                <div class="col-span-1">
                    <label for="year">Ano </label>
                    <Select wire:model="year"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        @for ($i = 2018; $i <= $nextyear; $i++)
                            <option value='{{ $i }}'>{{ $i }}</option>
                        @endfor

                    </Select>
                </div>
                <div class="col-span-1">
                    <label for="mounth">Mes </label>
                    <Select wire:model="mounth"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="">Todos</option>
                        <option value="01" {{ date('m') == 1 ? 'selected' : '' }}>Janeiro</option>
                        <option value="02" {{ date('m') == 2 ? 'selected' : '' }}>Fevereiro</option>
                        <option value="03" {{ date('m') == 3 ? 'selected' : '' }}>Março</option>
                        <option value="04" {{ date('m') == 4 ? 'selected' : '' }}>Abril</option>
                        <option value="05" {{ date('m') == 5 ? 'selected' : '' }}>Maio</option>
                        <option value="06" {{ date('m') == 6 ? 'selected' : '' }}>Junho</option>
                        <option value="07" {{ date('m') == 7 ? 'selected' : '' }}>Julho</option>
                        <option value="08" {{ date('m') == 8 ? 'selected' : '' }}>Agosto</option>
                        <option value="09" {{ date('m') == 9 ? 'selected' : '' }}>Setembro</option>
                        <option value="10" {{ date('m') == 10 ? 'selected' : '' }}>Outubro</option>
                        <option value="11" {{ date('m') == 11 ? 'selected' : '' }}>Novembro</option>
                        <option value="12" {{ date('m') == 12 ? 'selected' : '' }}>Dezembro</option>

                    </Select>
                </div>
                <div class="col-span-1">
                    <label for="mounthWidth">Formato </label>
                    <Select wire:model="mounthWidth"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value='200'>3X4</option>
                        <option value='350'>2X6</option>
                        <option value='650'>1X12</option>
                    </Select>
                </div>
                <div class="col-span-1">
                    <label for="ambience_id">Ambiente </label>
                    <Select wire:model="ambience_id"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="">Todos</option>
                        @foreach ($ambiences as $ambience)
                            <option value="{{ $ambience->id }}">
                                {{ $ambience->title }}
                            </option>
                        @endforeach
                    </Select>
                </div>
                <div class="col-span-1 flex items-end">
                    <label>&nbsp; </label>
                    <div class="tooltip tooltip-top p-0 justify-end" data-tip="Atualizar">
                        <button wire:click="updateCalendar()"
                        class="py-2 px-3 flex justify-end
                        text-white rounded-md bg-blue-500 transition-colors hover:bg-white hover:text-blue-500
                        duration-200 whitespace-nowrap">Atualizar
                            <svg class="h-6 w-6 ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.6091 5.89092L15.5 9H21.5V3L18.6091 5.89092ZM18.6091 5.89092C16.965 4.1131 14.6125 3 12 3C7.36745 3 3.55237 6.50005 3.05493 11M5.39092 18.1091L2.5 21V15H8.5L5.39092 18.1091ZM5.39092 18.1091C7.03504 19.8869 9.38753 21 12 21C16.6326 21 20.4476 17.5 20.9451 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </button>
                    </div>
                </div>

                    <div class="col-span-1 flex items-end">
                        <label>&nbsp; </label>
                        <div class="tooltip tooltip-top p-0 justify-end" data-tip="Imprimir">
                            <button wire:click='printSchedule()'
                                class="py-2 px-3 flex justify-end
                                    text-white rounded-md bg-blue-500 transition-colors hover:bg-white hover:text-blue-500
                                    duration-200 whitespace-nowrap">Imprimir
                                <svg class="h-6 w-6 ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 17H5C3.89543 17 3 16.1046 3 15V11C3 9.34315 4.34315 8 6 8H7M7 17V14H17V17M7 17V18C7 19.1046 7.89543 20 9 20H15C16.1046 20 17 19.1046 17 18V17M17 17H19C20.1046 17 21 16.1046 21 15V11C21 9.34315 19.6569 8 18 8H17M7 8V6C7 4.89543 7.89543 4 9 4H15C16.1046 4 17 4.89543 17 6V8M7 8H17M15 11H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                            </button>
                        </div>

                    </div>
            </div>

            <div class=" bg-white dark:bg-gray-800 sm:rounded-lg my-6 px-4">
                <div class="w-100 py-0 pl-0 pr-1 " id="calendar" wire:ignore wire:model.live='events'>
                </div>

                {{-- MODAL READ --}}
                <x-dialog-modal wire:model="showModalView">
                    <x-slot name="title">Detalhes</x-slot>
                    <x-slot name="content">
                        <dl class="max-w text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
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
