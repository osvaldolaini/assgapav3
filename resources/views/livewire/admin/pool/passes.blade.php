<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-validity_of_card">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    PASSES DA PISCINA
                </h3>
            </div>
        </div>
    </x-breadcrumb>
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div>
            <x-table-search></x-table-search>

            <div class=" bg-white dark:bg-gray-800 sm:rounded-lg my-6 px-4">
                <div class="-mx-4  overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table style="width:100%" class='min-w-full divide-y divide-gray-200 dark:divide-gray-700'>
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left text-gray-500
                                        dark:text-gray-400">

                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-left text-gray-500
                                                    dark:text-gray-400">
                                            Título
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Período
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Validade
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Cor
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Diversos
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Ações
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
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                                    {{ $data->category }}
                                                </td>

                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    {{ $data->validity_of_card }}
                                                </td>

                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    <svg class="h-6 w-6 mx-auto" fill="{{ $data->color }}"
                                                        viewBox="0 0 32 32" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 26.016q0 2.496 1.76 4.224t4.256 1.76h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-2.496-1.76-4.256t-4.224-1.76h-20q-2.496 0-4.256 1.76t-1.76 4.256v20zM4 24v-17.984q0-0.832 0.576-1.408t1.44-0.608h20q0.8 0 1.408 0.608t0.576 1.408v17.984h-24zM10.016 19.008q0 1.248 0.864 2.144t2.112 0.864h6.016q1.248 0 2.112-0.864t0.896-2.144q-0.256-1.344-1.088-2.464t-2.048-1.792q1.12-1.152 1.12-2.752v-1.984q0-1.664-1.184-2.848t-2.816-1.152-2.816 1.152-1.184 2.848v1.984q0 1.6 1.12 2.752-1.216 0.672-2.048 1.792t-1.056 2.464z">
                                                        </path>
                                                    </svg>
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    <div class="tooltip tooltip-top p-0" data-tip="Carteirinha">
                                                        <button wire:click="printCards({{ $data->id }})"
                                                            class="py-2 px-3 flex
                                                                hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                                                                duration-200 whitespace-nowrap">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "
                                                                fill="currentColor" viewBox="0 -32 576 576"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M528 32H48C21.5 32 0 53.5 0 80v16h576V80c0-26.5-21.5-48-48-48zM0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V128H0v304zm352-232c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zm0 64c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zm0 64c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zM176 192c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zM67.1 396.2C75.5 370.5 99.6 352 128 352h8.2c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h8.2c28.4 0 52.5 18.5 60.9 44.2 3.2 9.9-5.2 19.8-15.6 19.8H82.7c-10.4 0-18.8-10-15.6-19.8z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="tooltip tooltip-top p-0" data-tip="Acessos">

                                                        <button wire:click="printHistory({{ $data->id }})"
                                                            class="py-2 px-3 flex mx-auto
                                                                hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                                                                duration-200 whitespace-nowrap">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "
                                                                fill="currentColor" viewBox="-64 0 512 512"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>

                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                                    @if ($data->active > 1)
                                                        <x-table-buttons-deleted id="{{ $data->id }}"
                                                            :update="false" :delete="true" :view="true">
                                                        </x-table-buttons-deleted>
                                                    @else
                                                        <x-table-buttons id="{{ $data->id }}" :update="true"
                                                            :delete="true" :view="true" :active="$data->active">
                                                        </x-table-buttons>
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

                <div class="items-center justify-between  py-4">
                    {{ $dataTable->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL DELETE --}}
    <x-confirmation-modal wire:model="showJetModal">
        <x-slot name="title">
            Excluir registro
        </x-slot>

        <x-slot name="content">
            <h2 class="h2">Deseja realmente excluir o registro?</h2>
            <p>Não será possível reverter esta ação!</p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showJetModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete({{ $registerId }})" wire:loading.attr="disabled">
                Apagar registro
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

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
                                    <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $item }}:</dt>
                                    <dd class="text-lg font-semibold">
                                        {{ $value }}
                                    </dd>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endif
                @if ($logs)
                    {!! $logs !!}
                @endif
            </dl>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showModalView')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    {{-- MODAL CREATE --}}
    <x-dialog-modal wire:model="showModalCreate">
        <x-slot name="title">Inserir novo</x-slot>
        <x-slot name="content">
            <form wire:submit="store">
                <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="col-span-2 ">
                        <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Título</label>
                        <input type="text" wire:model="title" placeholder="Título" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full sm:col-span-1">
                        <label for="validity_of_card">Validade</label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="validity_of_card" required x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full  rounded-l-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md bg-green-700">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                        </div>
                        @error('validity_of_card')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="category">*Período</label>
                        <select wire:model="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Diário">DIÁRIO</option>
                            <option value="Mensal">MENSAL</option>
                            <option value="Temporada">TEMPORADA</option>
                        </select>
                        @error('category')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="validity" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Mostrar validade</label>
                        <select wire:model="validity" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            <option value="0">NÃO</option>
                            <option value="1">SIM</option>
                        </select>
                        @error('validity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="color" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Cor</label>
                        <div class="flex">
                            <input type="color" wire:model.live="color" placeholder="Cor" required
                                class="bg-gray-50 h-10 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-primary-600 focus:border-primary-600 block w-full
                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md dark:bg-gray-700">
                                <svg class="h-8 w-8" fill="{{ $color }}" viewBox="0 0 32 32" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>user-card</title>
                                    <path
                                        d="M0 26.016q0 2.496 1.76 4.224t4.256 1.76h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-2.496-1.76-4.256t-4.224-1.76h-20q-2.496 0-4.256 1.76t-1.76 4.256v20zM4 24v-17.984q0-0.832 0.576-1.408t1.44-0.608h20q0.8 0 1.408 0.608t0.576 1.408v17.984h-24zM10.016 19.008q0 1.248 0.864 2.144t2.112 0.864h6.016q1.248 0 2.112-0.864t0.896-2.144q-0.256-1.344-1.088-2.464t-2.048-1.792q1.12-1.152 1.12-2.752v-1.984q0-1.664-1.184-2.848t-2.816-1.152-2.816 1.152-1.184 2.848v1.984q0 1.6 1.12 2.752-1.216 0.672-2.048 1.792t-1.056 2.464z">
                                    </path>
                                </svg>
                            </span>
                        </div>

                        @error('color')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="store"
                class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                Salvar
            </button>
            <x-secondary-button wire:click="$toggle('showModalCreate')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    {{-- MODAL UPDATE --}}
    <x-dialog-modal wire:model="showModalEdit">
        <x-slot name="title">Editar: {{ $title }}
            <div class="badge bg-red-400 gap-1 py-1 text-white cursor-pointer"
                wire:click='clean()'>
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 32 32" xml:space="preserve">
                    <style type="text/css">
                        .st0 {
                            fill: none;
                            stroke: #FFFFFF;
                            stroke-width: 2;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-miterlimit: 10;
                        }
                    </style>
                    <g>
                        <path d="M18,14h-4c-0.6,0-1-0.4-1-1V3c0-1.7,1.3-3,3-3s3,1.3,3,3v10C19,13.6,18.6,14,18,14z" />
                    </g>
                    <g>
                        <path d="M24.7,20l-0.3-1.6C24,17,22.8,16,21.4,16H10.6c-1.4,0-2.6,1-2.9,2.4L7.3,20H24.7z" />
                        <path d="M6.9,22L5,30.8c-0.1,0.3,0,0.6,0.2,0.8C5.4,31.9,5.7,32,6,32h4v-5c0-0.6,0.4-1,1-1s1,0.4,1,1v5h8v-3c0-0.6,0.4-1,1-1
                        s1,0.4,1,1v3h4c0.3,0,0.6-0.1,0.8-0.4c0.2-0.2,0.3-0.5,0.2-0.8L25.1,22H6.9z" />
                    </g>
                </svg>
                Limpar
            </div>
        </x-slot>
        <x-slot name="content">
            <form wire:submit="update">
                <div class="grid grid-cols-6 gap-2 mb-3">
                    {{-- <div class="col-span-2 ">
                        <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Título</label>
                        <input type="text" wire:model="title" placeholder="Título" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="col-span-full sm:col-span-4">
                        <label for="partner" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Cliente</label>
                        <input type="text" wire:model="partner" placeholder="Cliente" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('partner')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="validity_of_card"
                            class="block text-sm font-medium text-gray-900 dark:text-white">Validade</label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="validity_of_card" required x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full  rounded-l-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md bg-green-700">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                        </div>
                        @error('validity_of_card')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full sm:col-span-6">
                        <label for="partner" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Indicado por</label>
                            <div class="grid gap-4 mb-1 grid-cols-1">
                                <fieldset class="col-span-1 w-full space-y-1 dark:text-gray-100"
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
                                        <input type="text" readonly placeholder="Pesquisar" wire:model.live="indication"
                                            class="w-full border-blue-500 py-3 pl-10 text-sm text-gray-900
                                            rounded-2xl  focus:ring-primary-500 dark:bg-gray-700
                                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
                                            autofocus />
                                    </div>
                                    @error('partner_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                        @error('partner_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 ">
                        <label for="obs" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Observação</label>
                        <input type="text" wire:model="obs" placeholder="Observação" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('obs')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- <div class="col-span-full sm:col-span-1">
                        <label for="validity">*Período</label>
                        <select wire:model="validity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Diário">DIÁRIO</option>
                            <option value="Mensal">MENSAL</option>
                            <option value="Temporada">TEMPORADA</option>
                        </select>
                        @error('validity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="validity" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Mostrar validade</label>
                        <select wire:model="validity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            <option value="0">NÃO</option>
                            <option value="1">SIM</option>
                        </select>
                        @error('validity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="color" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Cor</label>
                        <div class="flex">
                            <input type="color" wire:model.live="color" placeholder="Cor" required
                                class="bg-gray-50 h-10 border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-primary-600 focus:border-primary-600 block w-full
                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md dark:bg-gray-700">
                                <svg class="h-8 w-8" fill="{{ $color }}" viewBox="0 0 32 32" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>user-card</title>
                                    <path
                                        d="M0 26.016q0 2.496 1.76 4.224t4.256 1.76h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-2.496-1.76-4.256t-4.224-1.76h-20q-2.496 0-4.256 1.76t-1.76 4.256v20zM4 24v-17.984q0-0.832 0.576-1.408t1.44-0.608h20q0.8 0 1.408 0.608t0.576 1.408v17.984h-24zM10.016 19.008q0 1.248 0.864 2.144t2.112 0.864h6.016q1.248 0 2.112-0.864t0.896-2.144q-0.256-1.344-1.088-2.464t-2.048-1.792q1.12-1.152 1.12-2.752v-1.984q0-1.664-1.184-2.848t-2.816-1.152-2.816 1.152-1.184 2.848v1.984q0 1.6 1.12 2.752-1.216 0.672-2.048 1.792t-1.056 2.464z">
                                    </path>
                                </svg>
                            </span>
                        </div>

                        @error('color')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div> --}}

                </div>

            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="update"
                class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                Atualizar
            </button>
            <x-secondary-button wire:click="$toggle('showModalEdit')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="modalSearch" class="mt-0">
        <x-slot name="title">Pesquisar</x-slot>
        <x-slot name="content">
            <div class="grid gap-4 mb-1 grid-cols-1">
                <fieldset class="col-span-1 w-full space-y-1 dark:text-gray-100">
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
                            class="w-full border-blue-500 py-3 pl-10 text-sm text-gray-900
                            rounded-2xl  focus:ring-primary-500 dark:bg-gray-700
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
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
                                                        <div class="mask mask-squircle w-12 h-12">
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
    @section('scripts')
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('openPdfInNewTab', ({
                    pdfPath
                }) => {
                    window.open(pdfPath, '_blank');
                })
            })
        </script>
    @endsection
</div>
