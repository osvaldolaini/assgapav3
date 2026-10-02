<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    Vendedor: {{ $partner->name }}
                </h3>
            </div>

        </div>
    </x-breadcrumb>
    {{-- @livewire('admin.exports.buttons') --}}
    {{-- <x-table-buttons-relatories :pdf="true" :print="true" :excel="true">
    </x-table-buttons-relatories> --}}
    <div class="pt-3 bg-white dark:bg-gray-800 sm:rounded-lg">
        <div>
            <x-table-search></x-table-search>
            {{-- <div class="px-4 my-6 bg-white dark:bg-gray-800 sm:rounded-lg">
                <div class="-mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table style="width:100%" class='min-w-full divide-y divide-gray-200 dark:divide-gray-700'>
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr scope="col"
                                        class="py-3.5 px-4 text-xs font-normal text-left text-gray-500
                                        dark:text-gray-400">

                                        <th scope="col"
                                            class="py-3.5 px-4 text-xs font-normal
                                                    text-left text-gray-500
                                                    dark:text-gray-400">
                                            Usuário
                                        </th>

                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Cadastro vinculado
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Extras
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @if ($dataTable->isEmpty())
                                        <tr>
                                            <td colspan="5"
                                                class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                                Nenhum resultado encontrado.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($dataTable as $data)
                                            <tr>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                                    {{ $data->title }}
                                                </td>
                                                <td>
                                                    @if ($data?->partner)
                                                        <div class="flex items-center gap-3 cursor-pointer "
                                                            wire:click="goTo({{ $data?->partner->id }})">
                                                            <div class="avatar">
                                                                <div class="w-12 h-12 mask mask-squircle">
                                                                    @if ($data?->partner->imageTitle)
                                                                        <picture>
                                                                            <source
                                                                                srcset="{{ url('storage/partners/' . $data?->partner->imageTitle . '.jpg') }}" />
                                                                            <source
                                                                                srcset="{{ url('storage/partners/' . $data?->partner->imageTitle . '.webp') }}" />

                                                                            <source
                                                                                srcset="{{ url('storage/partners/' . $data?->partner->imageTitle . '.png') }}" />
                                                                            <img src="{{ url('storage/partners/' . $data?->partner->imageTitle . '.jpg') }}"
                                                                                alt="{{ $data?->partner->name }}">
                                                                        </picture>
                                                                    @else
                                                                        <picture>
                                                                            <source
                                                                                srcset="{{ url('storage/logos/assgapa.png') }}" />
                                                                            <source
                                                                                srcset="{{ url('storage/logo/assgapa.webp') }}" />
                                                                            <img src="{{ url('storage/logo/assgapa.png') }}"
                                                                                alt="{{ $data?->partner->name }}">
                                                                        </picture>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="text-sm font-bold">
                                                                    {{ $data?->partner->name }}
                                                                </div>
                                                                <div class="text-sm opacity-50">
                                                                    {{ $data?->partner->partner_category_master }}
                                                                </div>
                                                                <div class="text-sm opacity-50">
                                                                    {{ $data?->partner->cpf }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        Não vinculado
                                                    @endif
                                                </td>

                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center
                                                     text-gray-500 dark:text-gray-400 flex-nowrap">

                                                    @if ($data?->partner)
                                                        <x-table-seller-buttons id="{{ $data->id }}"
                                                            align="justify-center">
                                                        </x-table-seller-buttons>
                                                    @else
                                                        Vincular
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="items-center justify-between py-4">
                    {{ $dataTable->links() }}
                </div>
            </div> --}}
        </div>
    </div>
</div>
