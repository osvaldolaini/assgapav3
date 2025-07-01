<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
        </div>
    </x-breadcrumb>
    <section class="container flex flex-col px-4 mx-auto space-y-12 dark:bg-gray-800 dark:text-gray-50">
        <fieldset class="grid grid-cols-4 gap-4 p-6 rounded-md dark:bg-gray-900">

            <div class="space-y-2 col-span-full lg:col-span-1">
                <p class="font-medium">Informações</p>
                <p class="text-xs">*Dados obrigatórios.</p>
                @livewire('admin.registers.upload-image', [''])
            </div>
            <form wire:submit="#" class="grid grid-cols-8 gap-2 col-span-full lg:col-span-3">
                <div class="col-span-full sm:col-span-6">
                    <label class="text-sm" for="name">*Nome completo</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Nome completo" wire:model="name" required maxlength="100">
                    @error('name')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="date_of_birth" class="text-sm">*Data nascimento </label>
                    <x-datepicker id='date_of_birth' :required="true"></x-datepicker>
                    @error('date_of_birth')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="partner_category_master" class="text-sm">Sócio?</label>
                    <Select wire:model.live="partner_category_master" required
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="Sócio">Sim</option>
                        <option value="Não sócio">Não</option>
                        <option value="Dependente">Dependente</option>
                    </Select>
                </div>
                <div class="col-span-full sm:col-span-6">
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
                    @error('partner_category')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="deceased">Falecido?</label>
                    <Select wire:model="deceased"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </Select>
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="discount">Desconto de folha</label>
                    <Select wire:model="discount"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </Select>
                </div>
                @if ($partner_category_master == 'Dependente' or $seeResponsible == true)
                    <div class="col-span-full sm:col-span-4">
                        <label class="text-sm" for="responsible_name">*Responsável </label>
                        <x-search-responsible name="{{ $responsible_name }}"></x-search-responsible>
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label class="text-sm" for="kinship">*Parentesco</label>
                        <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                            placeholder="Parentesco" wire:model="kinship" required maxlength="100">
                        @error('kinship')
                            <span class="text-red-500 error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="needs" class="text-sm">Carteirinha?</label>
                        <Select wire:model="needs"
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </Select>
                    </div>
                @endif

                {{-- <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="rg">RG</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        maxlength="10" placeholder="RG" wire:model="rg">
                </div> --}}
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="pf_pj">*Tipo de cadastro</label>
                    <Select wire:model.live="pf_pj" required
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="pf">Pessoa física</option>
                        <option value="pj">Pessoa jurídica</option>
                    </Select>
                    @error('pf_pj')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-4 {{ $pf_pj == 'pf' ? 'block' : 'hidden' }}">
                    <label class="text-sm" for="cpf">*CPF</label>
                    <input x-mask="999.999.999-99" placeholder="000.000.000-00" required
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        wire:model="cpf">
                    @error('cpf')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full sm:col-span-4 {{ $pf_pj == 'pj' ? 'block' : 'hidden' }}">
                    <label class="text-sm" for="cnpj">*CNPJ</label>
                    <input x-mask="99.999.999/9999-99" placeholder="00.000.000/0000-00" required
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        wire:model="cnpj">
                    @error('cnpj')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="rg">RG</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        maxlength="10" placeholder="RG" wire:model="rg">
                </div> --}}
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="saram">SARAM</label>
                    <input x-mask="999999-9" placeholder="000000-0"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        maxlength="8" placeholder="saram" wire:model="saram">
                </div>
                {{-- Saram novo --}}
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="saram_novo">NOVO SARAM</label>
                    <input x-mask="99999999-99" placeholder="00000000-00"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        maxlength="11" placeholder="saram_novo" wire:model="saram_novo">
                </div>

                <div class="col-span-full sm:col-span-4">
                    <label class="text-sm" for="email">E-mail</label>
                    <input type="email"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="E-mail" wire:model="email" value="{{ old('email', $email ?? '') }}">
                    @error('email')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="send_email_barthday" class="text-sm">Enviar email</label>
                    <Select wire:model="send_email_barthday"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </Select>
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="registration_at" class="text-sm">*Data cadastro</label>
                    <x-datepicker id='registration_at' :required="false"></x-datepicker>
                    @error('registration_at')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror

                </div>
                <div class="col-span-full sm:col-span-4">
                    <label class="text-sm" for="phone_first">*Contato primário</label>
                    <input x-mask="(99) 9 9999-9999" type="text"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="(99) 9 9999-9999" wire:model="phone_first">
                    @error('phone_first')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="phone_second">Contato secundário</label>
                    <input type="text" x-mask="(99) 9 9999-9999"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="(99) 9 9999-9999" wire:model="phone_second">

                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="validity_of_card" class="text-sm">Val Carteirinha</label>
                    <div class="flex">
                        <input type="text" wire:model="validity_of_card" x-mask="99/99/9999"
                            placeholder="99/99/9999"
                            class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <span class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </span>
                    </div>
                    @error('validity_of_card')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="access_pool" class="text-sm">Prazo piscinas</label>
                    <div class="flex">
                        <input type="text" wire:model="access_pool" x-mask="99/99/9999" placeholder="99/99/9999"
                            class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <span class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </span>
                    </div>
                    @error('access_pool')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="print_date" class="text-sm">Data impressão</label>
                    <div class="flex">
                        <input type="text" wire:model="print_date" x-mask="99/99/9999" placeholder="99/99/9999"
                            class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <span class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </span>
                    </div>
                    @error('print_date')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="grace_period" class="text-sm">Carência</label>
                    <div class="flex">
                        <input type="text" wire:model="grace_period" x-mask="99/99/9999" placeholder="99/99/9999"
                            class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <span class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </span>
                    </div>
                    @error('grace_period')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="postalCode">CEP</label>
                    <input x-mask="99999-999"
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        maxlength="10" placeholder="CEP" wire:model.lazy="postalCode"
                        value="{{ old('postalCode', $postalCode ?? '') }}">
                </div>

                <div class="col-span-full sm:col-span-6">
                    <label class="text-sm" for="address">Rua</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Rua, Av, Travessa, etc" wire:model="address"
                        value="{{ old('address', $address ?? '') }}">
                </div>
                <div class="col-span-full sm:col-span-4">
                    <label class="text-sm" for="number">Número</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="nº" wire:model="number" value="{{ old('number', $number ?? '') }}">
                </div>
                <div class="col-span-full sm:col-span-4">
                    <label class="text-sm" for="about">Bairro</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Bairro" wire:model="district" value="{{ old('district', $district ?? '') }}">
                </div>
                <div class="col-span-full sm:col-span-6">
                    <label class="text-sm" for="city">Cidade</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Cidade" wire:model="city" value="{{ old('city', $city ?? '') }}">
                </div>

                <div class="col-span-full sm:col-span-2">
                    <label class="text-sm" for="state">Estado</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="UF" x-mask="aa" wire:model="state" maxlength="2"
                        value="{{ old('state', $state ?? '') }}">
                </div>
                <div class="col-span-full">
                    <label class="text-sm" for="obs">Observações</label>
                    <textarea wire:model="obs" class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        rows="5"></textarea>
                </div>
            </form>
            <div class="col-span-full">
                <div class="flex items-center justify-end w-full mt-0 space-x-4">
                    <button class="btn btn-success" wire:click="save_out">Salvar</button>
                </div>
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
                @isset($responsible_search)
                    <div class="overflow-x-auto">
                        <table class="table">
                            <tbody>
                                @if ($responsible_search)
                                    @foreach ($responsible_search as $partner)
                                        <tr class="hover:bg-gray-200">
                                            <td>
                                                <div class="flex items-center gap-3 cursor-pointer "
                                                    wire:click="selectResponsible({{ $partner->id }})">
                                                    <div class="avatar">
                                                        <div class="w-12 h-12 mask mask-squircle">
                                                            @if ($partner->imageTitle)
                                                                <picture>
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $partner->imageTitle . '.jpg') }}" />
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $partner->imageTitle . '.webp') }}" />
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $partner->imageTitle . '.png') }}" />
                                                                    <img src="{{ url('storage/partners/' . $partner->imageTitle . '.jpg') }}"
                                                                        alt="{{ $partner->name }}">
                                                                </picture>
                                                            @else
                                                                <picture>
                                                                    <source
                                                                        srcset="{{ url('storage/logos/assgapa.png') }}" />
                                                                    <source
                                                                        srcset="{{ url('storage/logo/assgapa.webp') }}" />
                                                                    <img src="{{ url('storage/logo/assgapa.png') }}"
                                                                        alt="{{ $partner->name }}">
                                                                </picture>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold">{{ $partner->name }}</div>
                                                        <div class="text-sm opacity-50">{{ $partner->cpf }}</div>
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
