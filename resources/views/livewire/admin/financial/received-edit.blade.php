<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="flex justify-end col-span-2">
            </div>
        </div>
    </x-breadcrumb>
    <section class="container flex flex-col px-4 mx-auto space-y-12 dark:bg-gray-800 dark:text-gray-50">

        <fieldset>
            <form wire:submit="save_out" class="grid grid-cols-12 gap-2 py-6 rounded-md dark:bg-gray-900">
                <div class="col-span-full">
                    <label for="partner">*Cliente</label>
                    <div class="grid grid-cols-1 gap-4 mb-1">
                        <fieldset class="w-full col-span-1 space-y-1 dark:text-gray-100"
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
                                <input type="text" readonly placeholder="Pesquisar" wire:model.live="partner"
                                    class="w-full py-3 pl-10 text-sm text-gray-900 border-blue-500 rounded-2xl focus:ring-primary-500 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
                                    autofocus />
                            </div>
                            @error('partner_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </fieldset>
                    </div>
                </div>
                <div class="col-span-6 text-left">
                    <label for="form_payment">*Forma de pagamento</label>
                    <Select wire:model="form_payment" required
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value=''>Selecione...</option>
                        <option value='DIN'>Dinheiro</option>
                        <option value='CAR'>Cartões</option>
                        <option value='BOL'>Boleto</option>
                        <option value='PIX'>PIX caixa</option>
                        <option value='PIXM'>PIX maquina</option>
                    </Select>
                    @error('form_payment')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="value">*Valor</label>
                    <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Valor" wire:model="value" id="value" required>
                    @error('value')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <script>
                        // Receber o seletor do campo valor
                        let inputValor = document.getElementById('value');

                        // Aguardar o usuário digitar valor no campo
                        inputValor.addEventListener('input', function() {
                            // Obter o valor atual removendo qualquer caractere que não seja número
                            let valueValor = this.value.replace(/[^\d]/g, '');

                            // Adicionar os separadores de milhares
                            var formattedValor = (valueValor.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valueValor
                                .slice(-2);

                            // Adicionar a vírgula e até dois dígitos se houver centavos
                            formattedValor = formattedValor.slice(0, -2) + ',' + formattedValor.slice(-2);

                            // Atualizar o valor do campo
                            this.value = formattedValor;

                        });
                    </script>
                </div>
                <div class="col-span-full sm:col-span-3">
                    <label for="paid_in">*Pagamento / vencimento</label>
                    <x-datepicker id='paid_in' :required="true"></x-datepicker>
                    @error('paid_in')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full">
                    <label for="title">*Descrição</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                        placeholder="Descrição" wire:model="title" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full">
                    <label for="obs">Observação</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                        placeholder="Observação" wire:model="obs">
                    @error('obs')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full">
                    <label for="updated_because">*Motivo da alteração</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                        placeholder="Motivo" wire:model="updated_because" required>
                    @error('updated_because')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </form>
            <div class="flex items-center justify-end mt-10 space-x-4 col-span-full">
                <button class="btn btn-neutral" wire:click="save">Salvar</button>
                <button class="btn btn-success" wire:click="save_out">Salvar e sair</button>
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
                                                        <div class="w-12 h-12 mask mask-squircle">
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
</div>
