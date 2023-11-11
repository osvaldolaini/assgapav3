<div class="w-100">
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
                                            Categoria
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
                                                    @if ($data->active == 2)
                                                        <div class="badge badge-error gap-2 mx-1">
                                                            Excluido
                                                        </div>
                                                    @endif
                                                </td>

                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                    <svg class="h-6 w-6 mx-auto" fill="{{ $data->color }}"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7 14.0014H17M7 14.0014V11.6014C7 11.0413 7 10.7613 7.10899 10.5474C7.20487 10.3592 7.35785 10.2062 7.54601 10.1104C7.75992 10.0014 8.03995 10.0014 8.6 10.0014H15.4C15.9601 10.0014 16.2401 10.0014 16.454 10.1104C16.6422 10.2062 16.7951 10.3592 16.891 10.5474C17 10.7613 17 11.0413 17 11.6014V14.0014M7 14.0014V18.0014V21.0014M17 14.0014V18.0014V21.0014M18.3466 6.17468L14.1466 4.07468C13.3595 3.68113 12.966 3.48436 12.5532 3.40691C12.1876 3.33832 11.8124 3.33832 11.4468 3.40691C11.034 3.48436 10.6405 3.68113 9.85338 4.07468L5.65337 6.17468C4.69019 6.65627 4.2086 6.89707 3.85675 7.25631C3.5456 7.574 3.30896 7.95688 3.16396 8.37725C3 8.85262 3 9.39106 3 10.4679V19.4014C3 19.9614 3 20.2414 3.10899 20.4554C3.20487 20.6435 3.35785 20.7965 3.54601 20.8924C3.75992 21.0014 4.03995 21.0014 4.6 21.0014H19.4C19.9601 21.0014 20.2401 21.0014 20.454 20.8924C20.6422 20.7965 20.7951 20.6435 20.891 20.4554C21 20.2414 21 19.9614 21 19.4014V10.4679C21 9.39106 21 8.85262 20.836 8.37725C20.691 7.95688 20.4544 7.574 20.1433 7.25631C19.7914 6.89707 19.3098 6.65627 18.3466 6.17468Z"
                                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
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


                    <div class="col-span-2 ">
                        <label for="color" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Cor</label>
                        <div class="flex">
                            <input type="color" wire:model.live="color" placeholder="Cor" required
                                class="bg-gray-50 h-10  border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-primary-600 focus:border-primary-600 block w-full
                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md dark:bg-gray-700">
                                <svg class="h-8 w-8" fill="{{ $color }}" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 14.0014H17M7 14.0014V11.6014C7 11.0413 7 10.7613 7.10899 10.5474C7.20487 10.3592 7.35785 10.2062 7.54601 10.1104C7.75992 10.0014 8.03995 10.0014 8.6 10.0014H15.4C15.9601 10.0014 16.2401 10.0014 16.454 10.1104C16.6422 10.2062 16.7951 10.3592 16.891 10.5474C17 10.7613 17 11.0413 17 11.6014V14.0014M7 14.0014V18.0014V21.0014M17 14.0014V18.0014V21.0014M18.3466 6.17468L14.1466 4.07468C13.3595 3.68113 12.966 3.48436 12.5532 3.40691C12.1876 3.33832 11.8124 3.33832 11.4468 3.40691C11.034 3.48436 10.6405 3.68113 9.85338 4.07468L5.65337 6.17468C4.69019 6.65627 4.2086 6.89707 3.85675 7.25631C3.5456 7.574 3.30896 7.95688 3.16396 8.37725C3 8.85262 3 9.39106 3 10.4679V19.4014C3 19.9614 3 20.2414 3.10899 20.4554C3.20487 20.6435 3.35785 20.7965 3.54601 20.8924C3.75992 21.0014 4.03995 21.0014 4.6 21.0014H19.4C19.9601 21.0014 20.2401 21.0014 20.454 20.8924C20.6422 20.7965 20.7951 20.6435 20.891 20.4554C21 20.2414 21 19.9614 21 19.4014V10.4679C21 9.39106 21 8.85262 20.836 8.37725C20.691 7.95688 20.4544 7.574 20.1433 7.25631C19.7914 6.89707 19.3098 6.65627 18.3466 6.17468Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
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
        <x-slot name="title">Editar</x-slot>
        <x-slot name="content">
            <form wire:submit="update">
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


                    <div class="col-span-2 ">
                        <label for="color" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Cor</label>
                        <div class="flex">
                            <input type="color" wire:model.live="color" placeholder="Cor" required
                                class="bg-gray-50 h-10  border border-gray-300 text-gray-900 text-sm rounded-lg
                                focus:ring-primary-600 focus:border-primary-600 block w-full
                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md dark:bg-gray-700">
                                <svg class="h-8 w-8" fill="{{ $color }}" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 14.0014H17M7 14.0014V11.6014C7 11.0413 7 10.7613 7.10899 10.5474C7.20487 10.3592 7.35785 10.2062 7.54601 10.1104C7.75992 10.0014 8.03995 10.0014 8.6 10.0014H15.4C15.9601 10.0014 16.2401 10.0014 16.454 10.1104C16.6422 10.2062 16.7951 10.3592 16.891 10.5474C17 10.7613 17 11.0413 17 11.6014V14.0014M7 14.0014V18.0014V21.0014M17 14.0014V18.0014V21.0014M18.3466 6.17468L14.1466 4.07468C13.3595 3.68113 12.966 3.48436 12.5532 3.40691C12.1876 3.33832 11.8124 3.33832 11.4468 3.40691C11.034 3.48436 10.6405 3.68113 9.85338 4.07468L5.65337 6.17468C4.69019 6.65627 4.2086 6.89707 3.85675 7.25631C3.5456 7.574 3.30896 7.95688 3.16396 8.37725C3 8.85262 3 9.39106 3 10.4679V19.4014C3 19.9614 3 20.2414 3.10899 20.4554C3.20487 20.6435 3.35785 20.7965 3.54601 20.8924C3.75992 21.0014 4.03995 21.0014 4.6 21.0014H19.4C19.9601 21.0014 20.2401 21.0014 20.454 20.8924C20.6422 20.7965 20.7951 20.6435 20.891 20.4554C21 20.2414 21 19.9614 21 19.4014V10.4679C21 9.39106 21 8.85262 20.836 8.37725C20.691 7.95688 20.4544 7.574 20.1433 7.25631C19.7914 6.89707 19.3098 6.65627 18.3466 6.17468Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
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
