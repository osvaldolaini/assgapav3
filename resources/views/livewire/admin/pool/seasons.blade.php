<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    TEMPORADAS
                </h3>
            </div>
        </div>
    </x-breadcrumb>
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
                                            Início
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Término
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Valor
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Pagantes
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
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    {{ $data->type }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    {{ $data->start }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    {{ $data->end }}
                                                </td>

                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    {{ $data->value }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    <button wire:click="printSeason({{ $data->id }})"
                                                        class="flex px-3 py-2 mx-auto transition-colors duration-200 hover:text-white dark:hover:bg-blue-500 hover:hover:bg-blue-500 whitespace-nowrap">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 "
                                                            fill="currentColor" viewBox="-64 0 512 512"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z" />
                                                        </svg>
                                                    </button>

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
                <div class="grid gap-4 mb-1 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="col-span-3">
                        <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Título</label>
                        <input type="text" wire:model="title" placeholder="Título" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="value">*Valor</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Valor "
                            placeholder="Valor" x-mask:dynamic="$money($input, ',')" wire:model="value" required>
                        @error('value')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="start">Início</label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="start" required x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                        </div>
                        @error('start')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="end">Término</label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="end" required x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                        </div>
                        @error('end')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="type">*Período</label>
                        <select wire:model="type"
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <option value="Diário">DIÁRIO</option>
                            <option value="Mensal">MENSAL</option>
                            <option value="Temporada">TEMPORADA</option>
                        </select>
                        @error('type')
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
        <x-slot name="title">Editar</x-slot>
        <x-slot name="content">
            <form wire:submit="update">
                <div class="grid gap-4 mb-1 sm:grid-cols-3 sm:gap-6 sm:mb-5">
                    <div class="col-span-3 ">
                        <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Título</label>
                        <input type="text" wire:model="title" placeholder="Título" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="value">*Valor</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Valor "
                            placeholder="Valor" x-mask:dynamic="$money($input, ',')" wire:model="value" required>
                        @error('value')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="start">Início</label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="start" required x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                        </div>
                        @error('start')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="end">Término</label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="end" required x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                        </div>
                        @error('end')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="type">*Período</label>
                        <select wire:model="type"
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <option value="Diário">DIÁRIO</option>
                            <option value="Mensal">MENSAL</option>
                            <option value="Temporada">TEMPORADA</option>
                        </select>
                        @error('type')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-3">
                        <label for="updated_because">*Motivo da alteração</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                            placeholder="Motivo" wire:model="updated_because" required>
                        @error('updated_because')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
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
