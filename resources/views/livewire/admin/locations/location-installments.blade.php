<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                @livewire('admin.locations.location-buttons', ['location' => $location,'update'=>true], key($location->id))
            </div>
        </div>
    </x-breadcrumb>
    <section class="px-4 dark:bg-gray-800 dark:text-gray-50
        container flex flex-col mx-auto space-y-6" wire:model.live="location">
        <div class="stats shadow mb-0" >
            <div class="stat">
                {{-- <div class="stat-figure text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
              </div> --}}
                <div class="stat-title">Contrato nº:</div>
                <div class="stat-value text-primary">{{ str_pad($location->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="stat-desc">Valor total: R$ {{ $location->value }}</div>
            </div>
            <div class="stat">
                <div class="stat-title">Valor restante</div>
                <div class="stat-value text-green-500">R$ {{ $location->remaining }}</div>
                <div class="stat-desc">Valor pago: R$ {{ $location->paid }}</div>
            </div>
            <div class="stat">
                <div class="stat-figure text-secondary">
                    @if ($location->convert_value($location->value) > 0)
                        @if ($installments->count() < 3 && $location->convert_value($location->remaining) > 0)
                            <h2 class="mb-4 text-2xl font-semibold leadi">
                                <button wire:click="insertParcel()"
                                    class="flex items-center justify-center w-1/2 px-5
                                py-3 text-sm tracking-wide text-white transition-colors
                                duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2
                                hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    <span>Nova parcela </span>
                                </button>
                            </h2>
                        @elseif($location->convert_value($location->remaining) <= 0)
                            <h2 class="mb-4 text-2xl font-semibold leadi">
                                <div
                                    class="flex items-center justify-center w-1/2 px-5
                                    py-3 text-sm tracking-wide text-white transition-colors
                                    duration-200 bg-green-500 rounded-lg sm:w-auto gap-x-2
                                    hover:bg-green-600 dark:hover:bg-green-500 dark:bg-green-600">
                                    <span>PAGO </span>
                                </div>
                            </h2>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="container mx-auto dark:text-gray-100">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <div class="min-w-full overflow-hidden rounded-lg shadow">
                        <div class="grid grid-cols-12 space-x-0 gap-0 text-center bg-gray-200 p-2">
                            <div class="py-2 pl-1 flex font-semibold items-center justify-start col-span-1">
                                Recibo</div>
                            <div class="py-2 pl-1 flex font-semibold items-center justify-start col-span-2">Parcela
                            </div>
                            <div class="py-2 pl-1 flex font-semibold items-center justify-center col-span-2">Valor</div>
                            <div class="py-2 pl-1 flex font-semibold items-center justify-center col-span-3">Vencimento
                                / Pagamento</div>
                            <div class="py-2 pl-1 flex font-semibold items-center justify-center col-span-2">Forma de
                                pagamento</div>
                            <div class="py-2 pl-1 flex font-semibold items-center justify-center col-span-2">Opções
                            </div>
                        </div>
                        <div wire:model.live='installments' wire:ignore>
                            @foreach ($installments as $installment)
                                @livewire('admin.locations.location-installment', ['installment' => $installment], key($installment->id))
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
