<div>
    <div class="gap-1 py-1 text-white bg-blue-400 cursor-pointer badge" wire:click='modalRegister()'>
        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24" xml:space="preserve">
            <g id="article">
                <g>
                    <path
                        d="M20.5,22H4c-0.2,0-0.3,0-0.5,0C1.6,22,0,20.4,0,18.5V6h5V2h19v16.5C24,20.4,22.4,22,20.5,22z M6.7,20h13.8
                            c0.8,0,1.5-0.7,1.5-1.5V4H7v14.5C7,19,6.9,19.5,6.7,20z M2,8v10.5C2,19.3,2.7,20,3.5,20S5,19.3,5,18.5V8H2z" />
                </g>
                <g>
                    <rect x="15" y="6" width="5" height="6" />
                </g>
                <g>
                    <rect x="9" y="6" width="4" height="2" />
                </g>
                <g>
                    <rect x="9" y="10" width="4" height="2" />
                </g>
                <g>
                    <rect x="9" y="14" width="11" height="2" />
                </g>
            </g>
        </svg>
        Cadastro rápido
    </div>
    {{-- MODAL CREATE --}}
    <x-dialog-modal wire:model="showModalCreate">
        <x-slot name="title">Cadastro rápido</x-slot>
        <x-slot name="content">
            <form wire:submit="fast_create" class="grid grid-cols-4 gap-2" wire:ignore>
                <div class="col-span-full sm:col-span-4">
                    <label class="text-sm" for="name">*Nome completo</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Nome completo" wire:model="name" required maxlength="100">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="date_of_birth" class="text-sm">Data nascimento </label>
                    <input type="text" wire:model="date_of_birth" x-mask="99/99/9999" placeholder="99/99/9999"
                        class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                    <span class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </span>
                </div>

                <div class="col-span-full sm:col-span-2">
                    <label for="partner_category" class="text-sm">*Categoria sócio</label>
                    <Select wire:model.live="partner_category" required
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="">Selecione...</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </Select>
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="pf_pj">*Tipo de cadastro</label>
                    <Select wire:model.live="pf_pj" required
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="pf">Pessoa física</option>
                        <option value="pj">Pessoa jurídica</option>
                    </Select>
                </div>
                @if ($pf_pj == 'pf')
                    <div class="col-span-full sm:col-span-2">
                        <label class="text-sm" for="cpf">*CPF</label>
                        <input x-mask="999.999.999-99" placeholder="000.000.000-00" required
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                            wire:model="cpf">
                    </div>
                @else
                    <div class="col-span-full sm:col-span-2">
                        <label class="text-sm" for="cnpj">*CNPJ</label>
                        <input x-mask="99.999.999/9999-99" placeholder="00.000.000/0000-00" required
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                            wire:model="cnpj">
                    </div>
                @endif
                <div class="col-span-full sm:col-span-2">
                    <label for="registration_at" class="text-sm">*Data cadastro</label>
                    <input type="text" wire:model="registration_at" x-mask="99/99/9999" placeholder="99/99/9999"
                        class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                    <span class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </span>
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="phone_first">Contato primário</label>
                    <input x-mask="(99) 9 9999-9999" type="text"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="(99) 9 9999-9999" wire:model="phone_first">
                </div>
                <div class="col-span-full sm:col-span-4">
                    <label class="text-sm" for="email">E-mail</label>
                    <input type="email"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="E-mail" wire:model="email" value="{{ old('email', $email ?? '') }}">
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="fast_create"
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


</div>
