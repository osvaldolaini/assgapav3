<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                @if (Auth::user()->group->level <= 10)
                    <div
                        class="flex flex-col items-center justify-between px-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                        <div class="flex w-full">
                            <div
                                class="block w-full text-sm text-gray-900 focus:ring-blue-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 ">
                                <label for="simple-search" class="sr-only">
                                    Pesquisar
                                </label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-blue-500 dark:text-gray-400"
                                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Pesquisar" wire:model.live="searchExcluded"
                                        class="w-full py-3 pl-10 text-sm text-gray-900 border-blue-500 rounded-2xl bg-gray-50 focus:ring-primary-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500" />
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                            <div class="flex group ">
                                <button wire:click="modalCreate()"
                                    class="flex items-center justify-center w-1/2 px-5 py-3 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                                    <svg aria-hidden="true" class="w-5 h-5 text-white dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-breadcrumb>
    <x-table-buttons-relatories :pdf="true" :print="true" :excel="true">
    </x-table-buttons-relatories>
    <div class="pt-3 bg-white dark:bg-gray-800 sm:rounded-lg">
        <div>
            <x-table-search></x-table-search>
            <div class="px-4 my-6 bg-white dark:bg-gray-800 sm:rounded-lg">
                <div class="-mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table style="width:100%" class='min-w-full divide-y divide-gray-200 dark:divide-gray-700'>
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left text-gray-600
                                        dark:text-gray-400">

                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-left text-gray-600
                                                    dark:text-gray-400">
                                            Nº
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-left text-gray-600
                                                    dark:text-gray-400">
                                            Cliente
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-600
                                                    dark:text-gray-400">
                                            Motivo
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-600
                                                    dark:text-gray-400">
                                            Valor
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-600
                                                    dark:text-gray-400">
                                            Vencimento / pagamento
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-600
                                                    dark:text-gray-400">
                                            Recibo
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-600
                                                    dark:text-gray-400">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @if ($dataTable->isEmpty())
                                        <tr>
                                            <td colspan="5"
                                                class="py-1.5 px-4 text-sm font-normal  text-center text-gray-600 dark:text-gray-400">
                                                Nenhum resultado encontrado.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($dataTable as $data)
                                            <tr wire:key="data-row-{{ $data->id }}">
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal
                                                    text-left text-blue-500">
                                                    {{ $data->id }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm uppercase font-normal text-left itens-center text-gray-600 dark:text-gray-400">
                                                    {{ $data->name }}
                                                    @if ($data->partners->category)
                                                        <div style="background-color:{{ $data->partners->category->color }};"
                                                            class="gap-2 mx-1 text-xs badge flex-nowarp ">
                                                            {{ $data->partners->category->title }}
                                                        </div>
                                                    @else
                                                        <div style="background-color:#666;"
                                                            class="gap-2 mx-1 text-xs badge flex-nowarp">
                                                            CATEGORIA NÃO DEFINIDA
                                                        </div>
                                                    @endif
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-left itens-center text-gray-600 dark:text-gray-400">
                                                    {{ $data->title }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-600 dark:text-gray-400">
                                                    {{ $data->value }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-600 dark:text-gray-400">
                                                    {{ $data->paid_in }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center
                                                       flex-nowrap">
                                                    @if ($data->active == 1)
                                                        @livewire('admin.financial.voucher', ['data' => $data, 'type' => 'received'], key($data->id))
                                                    @endif
                                                </td>

                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center text-gray-600 dark:text-gray-400">
                                                    @if ($data->active > 1)
                                                        <x-table-buttons-deleted id="{{ $data->id }}"
                                                            :update="false" :delete="true" :view="true">
                                                        </x-table-buttons-deleted>
                                                    @else
                                                        <x-table-buttons id="{{ $data->id }}" :update="false"
                                                            :delete="true" :view="true">
                                                        </x-table-buttons>
                                                        {{-- <x-table-buttons id="{{ $data->id }}" :update="true"
                                                        :delete="true" :view="true" :active="$data->active">
                                                    </x-table-buttons> --}}
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
            <form>
                <div class="col-span-full">
                    <label for="deleted_because">*Motivo da exclusão</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                        placeholder="Descrição" wire:model="deleted_because" required>
                    @error('deleted_because')
                        <span class="error">{{ $message }}</span>
                    @enderror
            </form>
</div>
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
                                <dt class="text-gray-600 md:text-lg dark:text-gray-400">{{ $item }}:</dt>
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

</div>
