<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                @livewire('admin.locations.location-buttons', ['location' => $location], key($location->id))
            </div>
        </div>
    </x-breadcrumb>
    <section class="px-4 dark:bg-gray-800 dark:text-gray-50
        container flex flex-col mx-auto space-y-6">
        <div class="stats shadow mb-0">
            <div class="stat">
                {{-- <div class="stat-figure text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
              </div> --}}
                <div class="stat-title">Contrato nº:</div>
                <div class="stat-value text-primary">{{ str_pad($location->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Valor dos extras</div>
                <div class="stat-value text-green-500" wire:model.live="total">R$ {{ $total }}</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-secondary">
                    @if ($extras->active == 0)
                        <h2 class="mb-4 text-2xl font-semibold leadi">
                            <button wire:click="showCheckoutModal()"
                                class="flex items-center justify-center w-1/2 px-5
                            py-3 text-sm tracking-wide text-white transition-colors
                            duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2
                            hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                                <span>Pagar </span>
                            </button>
                        </h2>
                    @else
                        <h2 class="mb-4 text-2xl font-semibold leadi flex">
                            <div
                                class="flex items-center justify-center w-1/2 px-5
                            py-3 text-sm tracking-wide text-white transition-colors
                            duration-200 bg-green-500 rounded-lg sm:w-auto gap-x-2
                            hover:bg-green-600 dark:hover:bg-green-500 dark:bg-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.5 0h11A1.5 1.5 0 0117 1.5v18.223a.2.2 0 01-.335.148l-1.662-1.513a.5.5 0 00-.673 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.674 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.673 0L3.335 19.87A.2.2 0 013 19.723V1.5A1.5 1.5 0 014.5 0zm4.207 11.293c.667.667 1.29.706 1.316.707.528 0 .977-.448.977-1 0-.646-.128-.751-1.243-1.03h-.001C8.725 9.712 7 9.28 7 7a2.993 2.993 0 012-2.815V4a1 1 0 012 0v.2c.645.23 1.228.604 1.707 1.093a1 1 0 01-1.414 1.414c-.667-.667-1.291-.706-1.317-.707C9.448 6 9 6.448 9 7c0 .646.127.751 1.242 1.03h.002C11.274 8.288 13 8.72 13 11a2.995 2.995 0 01-2 2.815V14a1 1 0 01-2 0v-.2a4.49 4.49 0 01-1.707-1.093 1 1 0 111.414-1.414z"
                                        fill="currentColor" />
                                </svg>
                                <span>PAGO </span>
                            </div>
                            <div class="tooltip tooltip-bottom p-0" data-tip="Apagar">
                                <button wire:click="showModalDelete()"
                                    class="flex items-center justify-center w-1/2 px-5 ml-1
                                    py-3 text-sm tracking-wide text-white transition-colors
                                    duration-200 bg-red-500 rounded-lg sm:w-auto gap-x-2
                                    hover:bg-red-600 dark:hover:bg-red-500 dark:bg-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="container mx-auto dark:text-gray-100">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <div class="min-w-full overflow-hidden rounded-lg shadow text-left">
                        <div>
                            @if ($extras->active == 0)
                                <form class="grid grid-cols-12 space-x-1 gap-0 text-center bg-gray-200 p-2">
                                    <div class="col-span-3 text-left">
                                        <label for="date_payment">Forma de pagamento</label>
                                        <div class="flex">
                                            <input type="text" wire:model="date_payment" wire:change='updateDay()'
                                                required x-mask="99/99/9999" placeholder="99/99/9999"
                                                class="w-full  rounded-l-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                                            <span
                                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md bg-green-700">
                                                <svg class="w-4 h-4 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="form_payment">Forma de pagamento</label>
                                        <Select wire:model="form_payment" required wire:change='updatePayment()'
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                                            <option value=''>Selecione...</option>
                                            <option value='DIN'>Dinheiro</option>
                                            <option value='CAR'>Cartões</option>
                                            <option value='BOL'>Boleto</option>
                                            <option value='PIX'>PIX</option>
                                        </Select>
                                    </div>
                                    <div class="col-span-6">

                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="qtd_security">Seguranças</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                            dark:text-gray-900"
                                            placeholder="Seguranças" wire:change="changeValue()"
                                            wire:model="qtd_security">
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="security">Valor dos Seguranças</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                 dark:text-gray-900"
                                            x-mask:dynamic="$money($input, ',')" id="security"
                                            placeholder="Valor dos Seguranças" wire:change="changeValue()"
                                            wire:model="security">
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="qtd_janitor">Zeladores</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                 dark:text-gray-900"
                                            placeholder="Zeladores" wire:change="changeValue()"
                                            wire:model="qtd_janitor">
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="janitor">Valor dos Zeladores</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                 dark:text-gray-900"
                                            x-mask:dynamic="$money($input, ',')" placeholder="Valor dos Zeladores"
                                            wire:change="changeValue()" wire:model.live="janitor">
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="qtd_brigade">Brigadistas</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                 dark:text-gray-900"
                                            wire:change="changeValue()" wire:model="qtd_brigade"
                                            placeholder="Brigadistas">
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="brigade">Valor dos Brigadistas</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                 dark:text-gray-900"
                                            x-mask:dynamic="$money($input, ',')" data-name="Valor dos Brigadistas"
                                            placeholder="Valor dos Brigadistas" wire:change="changeValue()"
                                            wire:model.live="brigade">
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="qtd_inflatable">Infláveis</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                 dark:text-gray-900"
                                            wire:change="changeValue()" wire:model="qtd_inflatable"
                                            placeholder="Infláveis">
                                    </div>
                                    <div class="col-span-3 text-left">
                                        <label for="inflatable">Valor dos Infláveis</label>
                                        <input
                                            class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700
                                 dark:text-gray-900"
                                            x-mask:dynamic="$money($input, ',')" placeholder="Valor dos Infláveis"
                                            wire:change="changeValue()" wire:model="inflatable">
                                    </div>
                                </form>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="table table-xs">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Descrição</th>
                                                <th>Quantidade</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Seguranças</td>
                                                <td>{{ $extras->qtd_security }}</td>
                                                <td>{{ $extras->security }}</td>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <td>Zeladores</td>
                                                <td>{{ $extras->qtd_janitor }}</td>
                                                <td>{{ $extras->janitor }}</td>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <td>Brigadistas</td>
                                                <td>{{ $extras->qtd_brigade }}</td>
                                                <td>{{ $extras->brigade }}</td>
                                            </tr>
                                            <tr>
                                                <th>4</th>
                                                <td>Infláveis</td>
                                                <td>{{ $extras->qtd_inflatable }}</td>
                                                <td>{{ $extras->inflatable }}</td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th class='flex justify-end text-right'>Valor total</th>
                                                <th>{{ $total }}</th>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL DELETE --}}
    <x-confirmation-modal wire:model="showJetModal">
        <x-slot name="title">
            Excluir registro
        </x-slot>

        <x-slot name="content">
            <h2 class="h2">Deseja realmente excluir o registro?</h2>
            <p>Não será possível reverter esta ação!</p>
            <h3 class="text-red-500">*Apagar o pagamento dos extras não exclui o recibo anterior criado!</h3>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showJetModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete()" wire:loading.attr="disabled">
                Apagar registro
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
    {{-- MODAL PAGAR --}}
    <x-confirmation-modal wire:model="checkoutModal">
        <x-slot name="title">
            Realizar pagamento
        </x-slot>

        <x-slot name="content">
            <h2 class="h2">Deseja realmente realizar o pagamento?</h2>
            <p>Por favor confira os dados informados!</p>
            <p>Valor: R$ <span class="font-semibold text-red-500">{{ $total }}</span></p>
            <p>Data: <span class="font-semibold text-red-500">{{ $date_payment }}</span></p>
            <p>Forma de pagamento: {{ $form_payment }}</p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('checkoutModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="checkout()" wire:loading.attr="disabled">
                Pagar
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
