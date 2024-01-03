<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    USUÁRIOS
                </h3>
            </div>
        </div>
    </x-breadcrumb>
    <div class="flex flex-col items-center justify-between px-4 mt-4
    space-y-3 md:flex-row md:space-y-0 md:space-x-4">
        <div
            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
            <div class="group flex ">
                <button wire:click="modalCreate"
                    class="flex items-center justify-center w-1/2 px-5
                        py-3 text-sm tracking-wide text-white transition-colors
                        duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2
                        hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    <span>Novo </span>
                </button>
            </div>
        </div>
    </div>
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
                                            text-left
                                                    text-gray-500 dark:text-gray-400">
                                    Nome
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center
                                                    text-gray-500 dark:text-gray-400">
                                    Nível de acesso
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center
                                            text-gray-500 dark:text-gray-400">
                                    Opções
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($users as $user)
                            @if ($user->group->level <= Auth::user()->group->level)
                            <tr>
                                <td
                                    class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                    {{ $user->name }}
                                </td>
                                <td
                                    class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500
                                    dark:text-gray-400">
                                    @livewire('admin.change-user-groups', ['user' => $user], key($user->id))
                                </td>
                                <td
                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                    <div class="w-full">
                                        <div class="flex justify-between font-medium duration-200 ">
                                            <div class="tooltip tooltip-top p-0" data-tip="Editar">
                                                <button wire:click="showModalUpdate({{ $user->id }})"
                                                    class="py-2 px-3
                                                hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                                                duration-200 whitespace-nowrap">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="tooltip tooltip-top p-0" data-tip="Apagar">
                                                <button wire:click="showModalDelete({{ $user->id }})"
                                                    class="py-2 px-3
                                                    transition-colors dark:hover:bg-red-500 hover:hover:bg-red-500
                                                    duration-200 hover:text-white -ml-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="tooltip tooltip-top p-0" data-tip="Acessos">
                                                <a href="{{ route('user.access',$user->id) }}"
                                                    class="py-2 px-3 transition-colors flex
                                                dark:hover:bg-teal-500 hover:hover:bg-teal-500
                                                duration-200 hover:text-white -ml-1">
                                                <svg class="h-6 w-6" viewBox="0 -1.5 20.412 20.412" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="check-lists" transform="translate(-1.588 -2.588)">
                                                        <path id="primary" d="M7,4,4.33,7,3,5.5" fill="none" stroke="currentColor"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                        <path id="primary-2" data-name="primary" d="M3,11.5,4.33,13,7,10" fill="none"
                                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                        <path id="primary-3" data-name="primary" d="M3,17.5,4.33,19,7,16" fill="none"
                                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                        <path id="primary-4" data-name="primary" d="M11,6H21M11,12H21M11,18H21" fill="none"
                                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                    </g>
                                                </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="items-center justify-between  py-4">
            {{ $users->links() }}
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
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Nome</label>
                        <input type="text" wire:model="name" placeholder="Nome" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Nome</label>
                        <input type="email" wire:model="email" placeholder="Email" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Senha</label>
                        <input type="password" wire:model="password" placeholder="Senha" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="user_groups_id" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Nível de acesso
                        </label>
                        <select wire:model="user_groups_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('user_groups_id')
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
                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Nome</label>
                        <input type="text" wire:model="name" placeholder="Nome" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Nome</label>
                        <input type="email" wire:model="email" placeholder="Email" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Senha</label>
                        <input type="password" wire:model="password" placeholder="Senha" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="user_groups_id" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Nível de acesso
                        </label>
                        <select wire:model="user_groups_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecione uma opção</option>
                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('user_groups_id')
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
