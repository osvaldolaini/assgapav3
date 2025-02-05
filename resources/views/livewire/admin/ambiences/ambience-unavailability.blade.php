<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    INDISPONIBILIDADES
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
                                            Ambiente
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                text-center text-gray-500
                                                dark:text-gray-400">
                                            Tipo
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Motivo
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Período / Data
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
                                                    {{ $data->ambience->title }}
                                                    @if ($data->active == 2)
                                                        <div class="gap-2 mx-1 badge badge-error">
                                                            Excluido
                                                        </div>
                                                    @endif
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    {{ $data->type_list }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    {{ $data->motive }}
                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    @if ($data->type == 0)
                                                        {{ $data->start }}
                                                    @else
                                                        {{ $data->start }} à {{ $data->end }}
                                                    @endif
                                                </td>
                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                                    <x-table-buttons id="{{ $data->id }}" :update="true"
                                                        :delete="true" :view="true" :active="$data->active">
                                                    </x-table-buttons>
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
        <x-slot name="title">Inserir novo </x-slot>
        <x-slot name="content">
            <form wire:submit="store">
                <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="col-span-full ">
                        <label for="type" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Tipo</label>
                        <Select wire:model.live="type" required
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <option value="">Selecione</option>
                            <option value="0">Pré reserva</option>
                            <option value="1">Indisponibilidade</option>
                        </Select>
                        @error('type')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full ">
                        <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Motivo</label>
                        <input type="text" wire:model="title" placeholder="Motivo" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($type != '')
                        <div class="{{ $type == 0 ? 'sm:col-span-1' : 'col-span-full sm:col-span-2' }}">
                            <label for="ambience_id" class="text-sm">*Ambiente</label>
                            <Select wire:model.live="ambience_id" required
                                class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                <option value="">Selecione...</option>
                                @foreach ($ambience as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </Select>
                        </div>
                        @if ($type == 0 && $ambience_id)
                            <div class="col-span-2 sm:col-span-1">
                                <label for="start" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Data <span class="text-red-500">{{ $alert }}</span></label>
                                <input type="text" x-mask="99/99/9999" wire:model.live="start" placeholder="Data"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('start')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="validity" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Validade</label>
                                <input type="text" x-mask="99/99/9999" wire:model="validity" placeholder="Data"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('validity')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if ($type == 1 && $ambience_id)
                            <div class="col-span-2 sm:col-span-1">
                                <label for="start" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Início <span class="text-red-500">{{ $alert }}</span></label>
                                <input type="text" x-mask="99/99/9999" wire:model.live="start"
                                    placeholder="Início" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="end" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Término</label>
                                <input type="text" x-mask="99/99/9999" wire:model="end" placeholder="Término"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                    @endif


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
                <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="col-span-full ">
                        <label for="type" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Tipo</label>
                        <Select wire:model.live="type" required
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <option value="">Selecione</option>
                            <option value="0">Pré reserva</option>
                            <option value="1">Indisponibilidade</option>
                        </Select>
                        @error('type')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full ">
                        <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">
                            *Motivo</label>
                        <input type="text" wire:model="title" placeholder="Motivo" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($type != '')
                        <div class="{{ $type == 0 ? 'sm:col-span-1' : 'col-span-full sm:col-span-2' }}">
                            <label for="ambience_id" class="text-sm">*Ambiente</label>
                            <Select wire:model.live="ambience_id" required
                                class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                <option value="">Selecione...</option>
                                @foreach ($ambience as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </Select>
                        </div>
                        @if ($type == 0 && $ambience_id)
                            <div class="col-span-2 sm:col-span-1">
                                <label for="start" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Data <span class="text-red-500">{{ $alert }}</span></label>
                                <input type="text" x-mask="99/99/9999" wire:model.live="start" placeholder="Data"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('start')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if ($type == 1 && $ambience_id)
                            <div class="col-span-2 sm:col-span-1">
                                <label for="start" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Início <span class="text-red-500">{{ $alert }}</span></label>
                                <input type="text" x-mask="99/99/9999" wire:model.live="start"
                                    placeholder="Início" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="end" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Término</label>
                                <input type="text" x-mask="99/99/9999" wire:model="end" placeholder="Término"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @error('title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                    @endif


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
</div>
