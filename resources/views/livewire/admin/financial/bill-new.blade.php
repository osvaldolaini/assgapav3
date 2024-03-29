<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 flex justify-end">
            </div>
        </div>
    </x-breadcrumb>
    <div class="px-4">
        @livewire('admin.registers.other-fast',['url' =>'new-bill'])
    </div>
    <section class="px-4 dark:bg-gray-800 dark:text-gray-50 container flex flex-col mx-auto space-y-12">

        <fieldset>
            <form wire:submit="save_out" class="grid grid-cols-12 gap-2 pb-6 rounded-md dark:bg-gray-900">
                <div class="col-span-full">
                    <label for="creditor" class="flex w-full">*Fornecedor / colaborador</label>
                    <div class="grid gap-4 mb-1 grid-cols-1">
                        <fieldset class="col-span-1 w-full space-y-1 dark:text-gray-100"
                            wire:click="openModalSearch('creditor')" wire:ignore>
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
                                <input type="text" readonly placeholder="Pesquisar" wire:model.live="creditor"
                                    class="w-full border-blue-500 py-3 pl-10 text-sm text-gray-900
                                    rounded-2xl  focus:ring-primary-500 dark:bg-gray-700
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
                                    autofocus />
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="col-span-full sm:col-span-6">
                    <label for="creditor">*Fornecedor / colaborador</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"="Valor "
                        placeholder="Fornecedor / colaborador" wire:model="creditor" required>
                    @error('creditor')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full sm:col-span-3">
                    <label class="text-sm" for="pf_pj">*Tipo de cadastro</label>
                    <Select wire:model.live="pf_pj" required
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="pf">Pessoa física</option>
                        <option value="pj">Pessoa jurídica</option>
                    </Select>
                </div>
                @if ($pf_pj == 'pf')
                <div class="col-span-full sm:col-span-3" x-data x-init="Inputmask({
                    'mask': '999.999.999-99'
                    }).mask($refs.creditor_document)">
                        <label class="text-sm" for="creditor_document">*CPF</label>
                        <input x-ref="creditor_document" placeholder="000.000.000-00" required
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                            wire:model="creditor_document">
                </div>
                @else
                    <div class="col-span-full sm:col-span-3" x-data x-init="Inputmask({
                        'mask': '99.999.999/9999-99'
                    }).mask($refs.creditor_document)">
                        <label class="text-sm" for="creditor_document">*CNPJ</label>
                        <input x-ref="creditor_document" placeholder="00.000.000/0000-00" required
                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                             dark:text-gray-900"
                            wire:model="creditor_document">
                    </div>
                @endif
                <div class="col-span-full sm:col-span-4">
                    <label for="cost_center_id">Motivo da despesa</label>
                    <select wire:model="cost_center_id"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="">Selecione...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('cost_center_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-3">
                    <label for="type">*Setor responsável</label>
                    <select wire:model="type"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        required>
                        <option value="">Selecione</option>
                        <option value="SEC">SECRETARIA</option>
                        @if (in_array(12, $pages) == true)
                            <option value="FIN">FINANCEIRO</option>
                        @endif
                        <option value="DIR">DIRETOR</option>
                    </select>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-6" >
                    <label for="value">*Valor</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Valor" wire:model="value" id="value" required >
                    @error('value')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <script>
                        // Receber o seletor do campo valor
                        let inputValor = document.getElementById('value');

                        // Aguardar o usuário digitar valor no campo
                        inputValor.addEventListener('input', function(){
                            // Obter o valor atual removendo qualquer caractere que não seja número
                            let valueValor = this.value.replace(/[^\d]/g, '');

                            // Adicionar os separadores de milhares
                            var formattedValor = (valueValor.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valueValor.slice(-2);

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
                    <div class="w-full mx-0 px-0 flex">
                        <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                        dark:text-gray-900 mr-2"
                        placeholder="Descrição" wire:model="title" required>
                        <div class="tooltip tooltip-top p-0" data-tip="Favoritos">
                            <button class="btn btn-square btn-outline hover:text-white" wire:click="openModalFavorites()" wire:ignore>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.537,9.488a1,1,0,0,0,.326,1.041l4.805,3.963-1.515,6.79a1,1,0,0,0,1.56,1.03L12,18.509l5.287,3.8a1,1,0,0,0,1.56-1.03l-1.515-6.79,4.805-3.963a1,1,0,0,0-.492-1.761l-5.817-.849L12.9,2.053a1.042,1.042,0,0,0-1.79,0L8.172,7.919l-5.817.849A1,1,0,0,0,1.537,9.488Zm7.441.335a1,1,0,0,0,.75-.542L12,4.736l2.272,4.545a1,1,0,0,0,.75.542l4.1.6L15.586,13.34a1,1,0,0,0-.339.989l1.076,4.826-3.739-2.69a1,1,0,0,0-1.168,0l-3.739,2.69,1.076-4.826a1,1,0,0,0-.339-.989L4.876,10.421Z"/></svg>
                            </button>
                        </div>
                    </div>

                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            <div class="flex col-span-full items-center space-x-4 mt-10 justify-end">
                <button class="btn btn-neutral">Salvar</button>
            </div>
        </form>
        </fieldset>

    </section>
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
    <x-dialog-modal wire:model="modalFavorites" class="mt-0">
        <x-slot name="title">Pesquisar</x-slot>
        <x-slot name="content">
            <div class="grid gap-4 mb-1 grid-cols-1">
                <fieldset class="col-span-1 w-full space-y-1 dark:text-gray-100">
                    <label for="Favorites" class="hidden">Pesquisar </label>
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <button type="button" title="Favorites" class="p-1 focus:outline-none focus:ring">
                                <svg fill="currentColor" viewBox="0 0 512 512" class="w-4 h-4 dark:text-gray-100">
                                    <path
                                        d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z">
                                    </path>
                                </svg>
                            </button>
                        </span>
                        <input type="text" placeholder="Pesquisar" wire:model.live="inputFavorites"
                            class="w-full border-blue-500 py-3 pl-10 text-sm text-gray-900
                            rounded-2xl  focus:ring-primary-500 dark:bg-gray-700
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500"
                            autofocus />
                    </div>
                </fieldset>
                @isset($favorites)
                    <div class="overflow-x-auto">
                        <table class="table">
                            <tbody>
                                @if ($favorites)
                                    @foreach ($favorites as $key => $value)
                                    @if ($value[0])
                                    <tr class="hover:bg-gray-200">
                                        <td>
                                            <div class="flex items-center gap-3 cursor-pointer "
                                                wire:click="selectFavorites({{ $value[0]['id'] }})">
                                                {{ mb_strtoupper($key) }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif

                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                @endisset

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalFavorites')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    @section('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('refresh', (event) => {
                alert()
                window.reload();
            })
        })
    </script>
    @endsection
</div>
