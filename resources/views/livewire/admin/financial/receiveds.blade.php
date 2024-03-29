<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">

            </div>
        </div>
    </x-breadcrumb>
    <x-table-buttons-relatories :pdf="true" :print="true" :excel="true">
    </x-table-buttons-relatories>
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div>
            <x-table-search></x-table-search>
            <div class=" bg-white dark:bg-gray-800 sm:rounded-lg my-6 px-4">
                <div class="-mx-4  overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table style="width:100%" class='min-w-full divide-y divide-gray-200
                             dark:divide-gray-700'>
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
                                                    text-left text-blue-500"
                                                    >
                                                    {{ $data->id }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm uppercase font-normal text-left itens-center text-gray-600 dark:text-gray-400">
                                                    {{ $data->name}}
                                                    @if ($data->partners->category)
                                                        <div style="background-color:{{ $data->partners->category->color}};"
                                                            class="badge flex-nowarp gap-2 mx-1 text-xs ">
                                                            {{ $data->partners->category->title}}
                                                        </div>
                                                    @else
                                                        <div style="background-color:#666;"
                                                            class="badge flex-nowarp gap-2 mx-1 text-xs">
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
                                                        @livewire('admin.financial.voucher', ['data' => $data,'type'=>'received'], key($data->id))
                                                    @endif
                                                </td>

                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center text-gray-600 dark:text-gray-400">
                                                    @if ($data->active > 1)
                                                        <x-table-buttons-deleted id="{{ $data->id }}"
                                                            :update="false" :delete="true" :view="true"
                                                            >
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
            <form >
            <div class="col-span-full">
                <label for="deleted_because">*Motivo da exclusão</label>
                <input
                    class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
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
