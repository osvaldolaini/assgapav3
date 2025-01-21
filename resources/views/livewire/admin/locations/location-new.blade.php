<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    {{ $breadcrumb_title }}

                </h3>
            </div>
            <div class="flex justify-end col-span-2 text-right">
                @livewire('admin.locations.pre-reserve')
            </div>
        </div>
    </x-breadcrumb>
    <div class="px-4">
        @livewire('admin.registers.other-fast', ['url' => 'new-location'])
    </div>
    <section class="container flex flex-col px-4 mx-auto space-y-12 dark:bg-gray-800 dark:text-gray-50">
        <form wire:submit="save_out">
            <fieldset class="grid items-start grid-cols-12 gap-2 pb-6 rounded-md dark:bg-gray-900">
                <div class="grid grid-cols-12 col-span-6 gap-2">
                    <div class="col-span-12 ">
                        <label class="flex w-full" for="partner">*Nome completo</label>
                        <div class="grid grid-cols-1 gap-4 mb-1">
                            <fieldset class="w-full col-span-1 space-y-1 dark:text-gray-100"
                                wire:click="openModalSearch('partner')" wire:ignore>
                                <label for="Search" class="hidden">Pesquisar </label>
                                <div class="relative w-full">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <button type="button" title="search" class="p-1 focus:outline-none focus:ring">
                                            <svg fill="currentColor" viewBox="0 0 512 512"
                                                class="w-4 h-4 dark:text-gray-100">
                                                <path
                                                    d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </span>
                                    <input type="text" readonly placeholder="Pesquisar" wire:model.live="partner"
                                        class="w-full py-3 pl-10 text-sm text-gray-900 border-blue-500 rounded-2xl focus:ring-primary-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
                                        autofocus />
                                </div>
                                @error('partner_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                    </div>
                    @if ($partner_id)
                        <div class="col-span-8">
                            <label for="ambience_id">*Ambiente </label>
                            <Select wire:model.lazy="ambience_id" required
                                class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                <option value="">Selecione...</option>
                                @foreach ($ambiences as $ambience)
                                    <option value="{{ $ambience->id }}">
                                        {{ $ambience->title }}
                                    </option>
                                @endforeach
                            </Select>
                            @error('ambience_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-4">
                            <label for="location_date">*Data</label>
                            <div class="flex">
                                <input readonly type="text" wire:model="location_date" required x-mask="99/99/9999"
                                    placeholder="99/99/9999"
                                    class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                <span
                                    class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                                    <svg class="w-4 h-4 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </span>
                            </div>
                            @error('location_date')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($multiple == 1)
                            <div class="col-span-6">
                                <label for="location_hour_start">*Hora início</label>
                                <input placeholder="Hora início" x-mask="99:99"
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    wire:model="location_hour_start" required>
                                @error('location_hour_start')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label for="location_hour_end">*Hora termino</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    placeholder="Hora termino" x-mask="99:99" wire:model="location_hour_end" required>
                                @error('location_hour_end')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if ($ambience_id)
                            <div class="col-span-12">
                                <label for="ambience_tenant_id">*Tipo de locatário </label>
                                <Select wire:model.lazy="ambience_tenant_id" required
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                    <option value="">Selecione...</option>
                                    @foreach ($ambienceTenants as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </Select>
                                @error('ambience_tenant_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="reason_event_id">*Tipo de evento</label>
                                <Select wire:model="reason_event_id" required
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                    <option value="">Selecione...</option>
                                    @foreach ($eventTypes as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </Select>
                                @error('reason_event_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="event_benefited">*Beneficiado do evento</label>
                                @if ($typeTenant == 1)
                                    <Select wire:model="event_benefited" required
                                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                        <option value="">Selecione...</option>
                                        <option value="PRÓPRIO">PRÓPRIO</option>
                                        @foreach ($dependents as $item)
                                            <option value="{{ $item->name }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </Select>
                                @else
                                    <input
                                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900" "Beneficiado do evento "
                                        placeholder="Beneficiado do evento " wire:model="event_benefited" required>
                                @endif
                                @error('event_benefited')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label for="value">*Valor da locação</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    x-mask:dynamic="$money($input, ',')" placeholder="Valor da locação"
                                    wire:model="value" required>
                                @error('value')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label for="deposit">*Valor da caução</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    x-mask:dynamic="$money($input, ',')" placeholder="Valor da caução "
                                    wire:model="deposit" required>
                                @error('deposit')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 ">
                                <label for="indication">Indicação</label>

                                <div class="grid grid-cols-1 gap-4 mb-1">
                                    <fieldset class="w-full col-span-1 space-y-1 dark:text-gray-100"
                                        wire:click="openModalSearch('indication')">
                                        <label for="Search" class="hidden">Pesquisar </label>
                                        <div class="relative w-full">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                                <button type="button" title="search"
                                                    class="p-1 focus:outline-none focus:ring">
                                                    <svg fill="currentColor" viewBox="0 0 512 512"
                                                        class="w-4 h-4 dark:text-gray-100">
                                                        <path
                                                            d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </span>
                                            <input type="text" readonly placeholder="Pesquisar"
                                                wire:model.live="indication"
                                                class="w-full py-3 pl-10 text-sm text-gray-900 border-blue-500 rounded-2xl focus:ring-primary-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
                                                autofocus />
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-span-12 ">
                                <label for="loc_time">Horário</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    placeholder="Horário" wire:model="loc_time">
                            </div>
                            <div class="col-span-6">
                                <label for="guests">Convidados</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    wire:model="guests" placeholder="Qtd de convidados">
                            </div>
                            <div class="col-span-6">
                                <label for="value_extra">Valor extra</label>
                                <input x-mask:dynamic="$money($input, ',')"
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    id="value_extra" wire:model="value_extra">
                            </div>
                        @endif
                    @endif

                </div>
                <div class="col-span-6">
                    @livewire('admin.schedule.location-calendar', [null])
                </div>
        </form>
        <div class="flex items-center justify-end mt-10 space-x-4 col-span-full">
            <button class="btn btn-success">Salvar</button>
        </div>
        </fieldset>

    </section>
    <x-dialog-modal wire:model="modalSearch" class="mt-0">
        <x-slot name="title">Pesquisar</x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 mb-1">
                <fieldset class="w-full col-span-1 space-y-1 dark:text-gray-100">
                    <label for="Search" class="hidden">Pesquisar </label>
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <button type="button" title="search" class="p-1 focus:outline-none focus:ring">
                                <svg fill="currentColor" viewBox="0 0 512 512" class="w-4 h-4 dark:text-gray-100">
                                    <path
                                        d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z">
                                    </path>
                                </svg>
                            </button>
                        </span>
                        <input type="text" placeholder="Pesquisar" wire:model.live="inputSearch"
                            class="w-full py-3 pl-10 text-sm text-gray-900 border-blue-500 rounded-2xl focus:ring-primary-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
                            autofocus />
                    </div>
                </fieldset>
                @isset($results)
                    <div class="overflow-x-auto">
                        <table class="table">
                            <tbody>
                                @if ($results)
                                    @foreach ($results as $item)
                                        <tr class="hover:bg-gray-200">
                                            <td>
                                                <div class="flex items-center gap-3 cursor-pointer "
                                                    wire:click="selectPartner({{ $item->id }})">
                                                    <div class="avatar">
                                                        <div class="w-12 h-12 mask mask-squircle">
                                                            @if ($item->imageTitle)
                                                                <picture>
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $item->imageTitle . '.jpg') }}" />
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $item->imageTitle . '.webp') }}" />
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $item->imageTitle . '.png') }}" />
                                                                    <img src="{{ url('storage/partners/' . $item->imageTitle . '.jpg') }}"
                                                                        alt="{{ $item->name }}">
                                                                </picture>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold">{{ $item->name }} -
                                                            {{ $item->partner_category_master }}</div>
                                                        <div class="text-sm opacity-50">{{ $item->cpf }} </div>
                                                        @if ($item->discount == 0)
                                                            @if ($item->lateMonthly())
                                                                <a href="{{ route('monthlys', $item->id) }}"
                                                                    class="flex px-3 py-2 transition-colors duration-200 hover:text-white dark:hover:bg-blue-500 hover:hover:bg-blue-500 whitespace-nowrap">
                                                                    <div style="background-color:red;"
                                                                        class="gap-2 mx-1 text-xs badge badge-error flex-warp ">
                                                                        {{ $data->category }}
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                @endisset

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalSearch')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>



</div>
