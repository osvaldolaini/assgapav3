<div wire:key="{{ $installment->id }}">
    @if ($installment->active == 1 or $installment->location->remaining != 0)
        <div class="grid grid-cols-12 space-x-1 text-center bg-white border-b border-gray-200">
            <div class="flex items-center justify-start col-span-1 px-1 py-2">
                @if ($installment->received_id)
                    <div class="p-0 tooltip tooltip-top" data-tip="Recibo">
                        <button wire:click="printReceived({{ $installment->received_id }})"
                            class="px-3 py-2 text-blue-500 transition-colors duration-200 hover:bg-blue-500 hover:text-white whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 " viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.5 0h11A1.5 1.5 0 0117 1.5v18.223a.2.2 0 01-.335.148l-1.662-1.513a.5.5 0 00-.673 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.674 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.673 0L3.335 19.87A.2.2 0 013 19.723V1.5A1.5 1.5 0 014.5 0zm4.207 11.293c.667.667 1.29.706 1.316.707.528 0 .977-.448.977-1 0-.646-.128-.751-1.243-1.03h-.001C8.725 9.712 7 9.28 7 7a2.993 2.993 0 012-2.815V4a1 1 0 012 0v.2c.645.23 1.228.604 1.707 1.093a1 1 0 01-1.414 1.414c-.667-.667-1.291-.706-1.317-.707C9.448 6 9 6.448 9 7c0 .646.127.751 1.242 1.03h.002C11.274 8.288 13 8.72 13 11a2.995 2.995 0 01-2 2.815V14a1 1 0 01-2 0v-.2a4.49 4.49 0 01-1.707-1.093 1 1 0 111.414-1.414z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            <div class="flex items-center justify-start col-span-2 px-1 py-2">
                <p>{{ $installment->title }}</p>
            </div>
            <div class="flex items-center justify-center col-span-2 px-1 py-2 text-center">
                <p>
                    @if ($installment->active == 1)
                        R$ {{ $installment->value }}
                    @else
                        <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                            x-mask:dynamic="$money($input, ',')" placeholder="Valor" wire:model="value"
                            wire:change='updateValue()' required>
                    @endif

                </p>
            </div>
            <div class="flex items-center justify-center col-span-3 px-1 py-2 text-center w-2/8">
                @if ($installment->active == 1)
                    <p>{{ $installment->installment_maturity_date }}</p>
                @else
                    <p>
                    <div class="flex">
                        <input type="text" wire:model="installment_maturity_date" wire:change='updateDay()' required
                            x-mask="99/99/9999" placeholder="99/99/9999"
                            class="w-full rounded-l-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <span class="flex items-center px-3 bg-green-700 pointer-events-none sm:text-sm rounded-r-md">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </span>
                    </div>
                    </p>
                @endif
            </div>
            <div class="flex items-center justify-center col-span-2 px-1 py-2 text-center">
                @if ($installment->active == 1)
                    {{ $installment->payment }}
                @else
                    <Select wire:model="form_payment" required wire:change='updatePayment()'
                        class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value=''>Selecione...</option>
                        <option value='DIN'>Dinheiro</option>
                        <option value='CAR'>Cartões</option>
                        <option value='BOL'>Boleto</option>

                        <option value='PIX'>PIX caixa</option>
                        <option value='PIXM'>PIX maquina</option>
                    </Select>
                @endif

            </div>
            <div class="flex items-center justify-center col-span-2 px-1 py-2">
                @if ($installment->active == 1 or $installment->location->remaining == 0)
                    <div class="gap-2 px-3 py-2 badge badge-success">
                        PAGO
                    </div>
                @else
                    @if ($remaining > 0)
                        <button wire:click="showCheckoutModal()"
                            class="px-3 py-2 text-white transition-colors duration-200 bg-blue-500 hover:hover:bg-600-500">
                            <span>Pagar </span>
                        </button>
                    @endif
                @endif
                <div class="p-0 tooltip tooltip-top" data-tip="Apagar">
                    <button wire:click="showModalDelete()"
                        class="px-3 py-2 ml-1 transition-colors duration-200 dark:hover:bg-red-500 hover:hover:bg-red-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
                <div>
                    @livewire('admin.locations.location-installment-obs', ['installment' => $installment], key($installment->id))
                </div>
            </div>
        </div>
    @endif
    {{-- MODAL DELETE --}}
    <x-confirmation-modal wire:model="showJetModal">
        <x-slot name="title">
            Excluir registro
        </x-slot>

        <x-slot name="content">
            <h2 class="h2">Deseja realmente excluir o registro?</h2>
            <p>Não será possível reverter esta ação!</p>
            <h3 class="text-red-500">*Apagar o pagamento não exclui o recibo anterior criado!</h3>
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
            <p>Valor: R$ <span class="font-semibold text-red-500">{{ $value }}</span></p>
            <p>Data: <span class="font-semibold text-red-500">{{ $installment_maturity_date }}</span></p>
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
