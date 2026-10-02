<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                <x-table-register-buttons id="{{ $id }}" :card="true" :dependent="true" :history="true"
                    :discount="true">
                </x-table-register-buttons>

            </div>
        </div>
    </x-breadcrumb>
    <div class="pt-3 bg-white dark:bg-gray-800 sm:rounded-lg ">
        <div
            class="flex flex-col items-center justify-between px-4 mb-5 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
            <div class="w-full px-4 py-2 bg-red-200 shadow-md rounded-t-md">
                <div class="grid grid-cols-8 gap-4 text-gray-600 ">
                    <div class="col-span-6 justify-items-start">
                        <h3 class="mb-5 text-2xl font-bold text-red-500 tracki">Não pagas</h3>
                    </div>
                    <div class="flex justify-end col-span-2 space-x-2">
                        <button wire:click="modalCreate()" class="text-white btn btn-info">Criar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 " fill="currentColor"
                                xviewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z" />
                            </svg>
                        </button>
                        <button wire:click="paid()" class="text-white btn btn-success">Pagar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 " fill="currentColor"
                                xviewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-full mt-2 space-y-4">
                    <div class="grid w-full grid-cols-3 gap-1">
                        @foreach ($jewels_not_paid as $item)
                            <div class="w-full indicator">
                                <span class="indicator-item indicator-center">
                                    {{-- <span class="cursor-pointer badge badge-primary"
                                        wire:click="showModalUpdate({{ $item->id }})">
                                        <svg class="w-4 h-4 mr-1 text-white" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8 9.00006H6.2C5.0799 9.00006 4.51984 9.00006 4.09202 9.21805C3.71569 9.40979 3.40973 9.71575 3.21799 10.0921C3 10.5199 3 11.08 3 12.2001V17.8001C3 18.9202 3 19.4802 3.21799 19.908C3.40973 20.2844 3.71569 20.5903 4.09202 20.7821C4.51984 21.0001 5.07989 21.0001 6.2 21.0001H17.787C18.9071 21.0001 19.4671 21.0001 19.895 20.7821C20.2713 20.5903 20.5772 20.2844 20.769 19.908C20.987 19.4802 20.987 18.9202 20.987 17.8001V12.0001M6 15.0001H6.01M10 15H10.01M11.5189 12.8946L12.8337 12.6347C13.5432 12.4945 13.8979 12.4244 14.2287 12.2953C14.5223 12.1807 14.8013 12.0318 15.06 11.8516C15.3514 11.6487 15.607 11.393 16.1184 10.8816L21.2668 5.73321C21.9541 5.04596 21.9541 3.9317 21.2668 3.24444C20.5796 2.55719 19.4653 2.55719 18.7781 3.24445L13.5416 8.48088C13.0625 8.96004 12.8229 9.19963 12.6294 9.47121C12.4576 9.71232 12.3131 9.97174 12.1986 10.2447C12.0696 10.5522 11.9921 10.8821 11.837 11.5417L11.5189 12.8946Z"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span class="">Editar</span>
                                    </span> --}}
                                    <span class="cursor-pointer badge badge-error"
                                        wire:click="showModalDelete({{ $item->id }})"">
                                        <svg class="w-4 h-4 mr-1 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        <span class="text-white">Excluir</span>
                                    </span>

                                </span>
                                <div class="flex w-full">
                                    <input type="checkbox" wire:model="pay" id="jewel-{{ $item->id }}-s"
                                        value="{{ $item->id }}" class="hidden peer" required="">
                                    <label for="jewel-{{ $item->id }}-s"
                                        class="inline-flex items-center justify-between w-full text-gray-500 bg-gray-200 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:hidden peer-checked:bg-blue-500 peer-checked:border-blue-500 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-blue-500 ">
                                        <div class="flex items-center justify-center h-full p-0 m-0 ">
                                            <svg class="w-12 h-12 p-2 " viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6 5C5.44772 5 5 5.44772 5 6V13V18C5 18.5523 5.44772 19 6 19H18C18.5523 19 19 18.5523 19 18V13V6C19 5.44772 18.5523 5 18 5H6ZM3 6C3 4.34315 4.34315 3 6 3H18C19.6569 3 21 4.34315 21 6V13V18C21 19.6569 19.6569 21 18 21H6C4.34315 21 3 19.6569 3 18V13V6Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </div>

                                        <div class=" flex-1 p-3 bg-white rounded-r-md">
                                            <div>
                                                <p class="text-xs font-semibold">{{ $item->title }}</p>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <p class="text-2xl font-semibold">R${{ $item->value }}</p>
                                                <p>{{ $item->paid_in }}</p>
                                            </div>

                                        </div>
                                    </label>
                                    <label for="jewel-{{ $item->id }}-s"
                                        class="items-center justify-between hidden w-full text-gray-500 bg-gray-200 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:inline-flex peer-checked:bg-blue-500 peer-checked:border-blue-500 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-blue-500 ">
                                        <div class="flex items-center justify-center h-full p-0 m-0 ">
                                            <svg class="w-12 h-12 p-2 text-white" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path id="Vector"
                                                    d="M8 12L11 15L16 9M4 16.8002V7.2002C4 6.08009 4 5.51962 4.21799 5.0918C4.40973 4.71547 4.71547 4.40973 5.0918 4.21799C5.51962 4 6.08009 4 7.2002 4H16.8002C17.9203 4 18.4796 4 18.9074 4.21799C19.2837 4.40973 19.5905 4.71547 19.7822 5.0918C20 5.5192 20 6.07899 20 7.19691V16.8036C20 17.9215 20 18.4805 19.7822 18.9079C19.5905 19.2842 19.2837 19.5905 18.9074 19.7822C18.48 20 17.921 20 16.8031 20H7.19691C6.07899 20 5.5192 20 5.0918 19.7822C4.71547 19.5905 4.40973 19.2842 4.21799 18.9079C4 18.4801 4 17.9203 4 16.8002Z"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="flex items-center justify-between flex-1 p-3 bg-white rounded-r-md">
                                            <p class="text-2xl font-semibold">R${{ $item->value }}</p>
                                            <p>{{ $item->paid_in }}</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- MODAL PAID --}}
            <x-dialog-modal wire:model="showModalPay">
                <x-slot name="title">Pagar</x-slot>
                <x-slot name="content">
                    <form wire:submit="store">
                        <div class="grid grid-cols-2 gap-2 mb-1 sm:gap-4 sm:mb-5">
                            <div class="col-span-full">
                                <label for="title">*Descrição</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                                    placeholder="Descrição" wire:model="title" required>
                                @error('title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-left col-span-full sm:col-span-1">
                                <label for="form_payment">*Forma de pagamento</label>
                                <Select wire:model="form_payment" required
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                    <option value=''>Selecione...</option>
                                    <option value='DIN'>Dinheiro</option>
                                    <option value='CAR'>Cartões</option>
                                    <option value='BOL'>Boleto</option>
                                    <option value='PIX'>PIX</option>
                                </Select>
                                @error('form_payment')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-1 text-left">
                                <label for="received">*Gerar recibo</label>
                                <Select wire:model="received" required
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                    <option value=''>Selecione...</option>
                                    <option value='1'>SIM</option>
                                    <option value='2'>NÃO</option>
                                </Select>
                                @error('received')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-full sm:col-span-1">
                                <label for="paid_in">*Pagamento / vencimento</label>
                                <x-datepicker id='paid_in' :required="true"></x-datepicker>
                                @error('paid_in')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-full sm:col-span-1">
                                <label for="value">*Valor total</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    x-mask:dynamic="$money($input, ',')" placeholder="Valor" wire:model="value"
                                    required>
                            </div>
                        </div>
                    </form>
                </x-slot>
                <x-slot name="footer">
                    <button type="submit" wire:click="checkout"
                        class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                        Pagar
                    </button>
                    <x-secondary-button wire:click="$toggle('showModalPay')" class="mx-2">
                        Fechar
                    </x-secondary-button>
                </x-slot>
            </x-dialog-modal>
            {{-- <x-dialog-modal wire:model="showModalEdit">
                <x-slot name="title">Editar</x-slot>
                <x-slot name="content">
                    <form wire:submit="update">
                        <div class="grid grid-cols-2 gap-2 mb-1 sm:gap-4 sm:mb-5">
                            <div class="col-span-1">
                                <label for="value">*Valor</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                                    placeholder="Valor" wire:model="value" id="value" required>
                                @error('value')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                               
                            </div>
                            <div class="col-span-1">
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
                            <div class="col-span-full sm:col-span-1">
                                <label for="status">*Liberar pagamento mês: {{ $label }}</label>
                                <Select wire:model="status" required
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                                    <option value='2'>SIM</option>
                                    <option value='0'>NÃO</option>
                                </Select>
                            </div>
                        </div>
                    </form>
                </x-slot>
                <x-slot name="footer">
                    <button type="submit" wire:click='update'
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
            </x-dialog-modal> --}}
            {{-- MODAL CREATE --}}
            <x-dialog-modal wire:model="showModalCreate">
                <x-slot name="title">Inserir nova jóia</x-slot>
                <x-slot name="content">
                    <form wire:submit="store">
                        <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                            <div class="col-span-1">
                                <label for="value">*Valor</label>
                                <input
                                    class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
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
                            <div class="col-span-1">
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
                        Criar
                    </button>
                    <x-secondary-button wire:click="$toggle('showModalCreate')" class="mx-2">
                        Fechar
                    </x-secondary-button>
                </x-slot>
            </x-dialog-modal>
            {{-- MODAL DELETE --}}
            <x-confirmation-modal wire:model="showJetModal">
                <x-slot name="title">
                    Excluir registro
                </x-slot>

                <x-slot name="content">
                    <h2 class="h2">Deseja realmente excluir a mensalidade?</h2>
                    <p>Não será possível reverter esta ação!</p>
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('showJetModal')" wire:loading.attr="disabled">
                        Cancelar
                    </x-secondary-button>

                    <x-danger-button class="ml-2" wire:click="delete({{ $jewel_id }})"
                        wire:loading.attr="disabled">
                        Apagar registro
                    </x-danger-button>
                </x-slot>
            </x-confirmation-modal>

        </div>

        {{-- PAGOS --}}
        <div class="flex flex-col items-center justify-between px-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4 ">
            <div class="w-full px-4 py-2 bg-blue-200 shadow-md rounded-t-md ">
                <div class="flex justify-between w-full border-bottom">
                    <h3 class="mb-5 text-2xl font-bold text-gray-600 tracki">Pagas</h3>
                </div>
                <div class="w-full mt-1 space-y-4">
                    <div class="grid w-full grid-cols-3 gap-1">
                        @foreach ($jewels_paid as $item)
                            <div class="col-span-1 shadow stats">
                                <div class="stat">
                                    <div class="stat-figure text-primary">
                                        @if ($item->status == 1 && $item->receiveds)
                                            @livewire('admin.financial.voucher', ['data' => $item->receiveds, 'type' => 'received'], key($item->id))
                                        @endif
                                    </div>
                                    <div class="stat-title">{{ $item->monthlyRef }}</div>
                                    <div class="stat-value text-primary">R${{ $item->value }}</div>
                                    <div class="stat-desc">
                                        <p>
                                            Forma de pagamento: {{ $item->Payment }}
                                        </p>
                                        <p>
                                            Data do pagamento: {{ $item->paid_in }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- LIBERADOS --}}
        <div
            class="flex flex-col items-center justify-between px-4 pt-3 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
            <div class="w-full px-4 py-2 bg-green-200 shadow-md rounded-t-md ">
                <div class="flex justify-between w-full border-bottom">
                    <h3 class="mb-5 text-2xl font-bold text-gray-600 tracki">Liberadas</h3>
                </div>
                <div class="w-full mt-1 space-y-4">
                    <div class="grid w-full grid-cols-3 gap-1">
                        @foreach ($jewels_released as $item)
                            <div class="col-span-1 shadow stats">
                                <div class="stat">
                                    <div class="stat-figure text-primary">

                                    </div>
                                    <div class="stat-title">{{ $item->title }}</div>
                                    <div class="stat-title">{{ $item->paid_in }}</div>
                                    <div class="stat-value text-primary">R${{ $item->value }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
