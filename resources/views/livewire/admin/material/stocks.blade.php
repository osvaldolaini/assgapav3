<div class="w-full">
    @if ($productStatus == 1)
        <div class="flex justify-between font-medium duration-200 ">
            <div class="tooltip tooltip-top p-0" data-tip="Entrada">
                <button wire:click="showModalIn()"
                    class="py-2 px-3
                    transition-colors dark:hover:bg-blue-500 hover:hover:bg-blue-500
                    duration-200 hover:text-white -ml-1">
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6" fill="none"
                        viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M0 26.016q0 2.496 1.792 4.256t4.224 1.728h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-2.496-1.76-4.256t-4.224-1.76h-4v4h4q0.8 0 1.408 0.608t0.576 1.408v20q0 0.832-0.576 1.408t-1.408 0.576h-20q-0.832 0-1.44-0.576t-0.576-1.408v-20q0-0.832 0.576-1.408t1.44-0.608h4v-4h-4q-2.496 0-4.256 1.76t-1.76 4.256v20zM6.016 26.016h20l-4-6.016h-12zM10.016 8l5.984 8 6.016-8h-4v-8h-4v8h-4z">
                        </path>
                    </svg>
                </button>
            </div>
            @if ($inStock > 0)
                <div class="tooltip tooltip-top p-0" data-tip="Saída">
                    <button wire:click="showModalOut()"
                        class="py-2 px-3 transition-colors
                dark:hover:bg-red-500 hover:hover:bg-red-500
                duration-200 hover:text-white -ml-1">
                        <svg fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0 26.016q0 2.496 1.76 4.224t4.256 1.76h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-2.496-1.76-4.256t-4.224-1.76h-5.024l2.496 4h2.528q0.8 0 1.408 0.608t0.576 1.408v20q0 0.832-0.576 1.408t-1.408 0.576h-20q-0.832 0-1.44-0.576t-0.576-1.408v-20q0-0.832 0.576-1.408t1.44-0.608h2.496l2.496-4h-4.992q-2.496 0-4.256 1.76t-1.76 4.256v20zM6.016 26.016h20l-4-6.016h-12zM10.016 8h4v8h4v-8h4l-6.016-8z">
                            </path>
                        </svg>
                    </button>
                </div>
            @endif

        </div>
    @endif

    {{-- MODAL INCREMENT --}}
    <x-dialog-modal wire:model="modalIn">
        <x-slot name="title">Inclusão de material:
            @isset($description)
                <p>{{ $description }}</p>
            @endisset
        </x-slot>
        <x-slot name="content">
            <form wire:submit="increment">
                <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="col-span-full sm:col-span-1">
                        <label for="date" class="text-sm">*Data</label>
                        <div class="flex">
                            <input required type="text" wire:model="date" x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full  rounded-l-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md bg-green-700">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                            @error('date')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-1 ">
                        <label for="quantity" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Qtd mínima</label>
                        <input type="number" wire:model="quantity" placeholder="Quantidade" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('quantity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="increment"
                class="text-white
                    bg-blue-700 hover:bg-blue-800
                    focus:ring-4 focus:outline-none focus:ring-blue-300
                    font-medium rounded-lg text-sm px-5 py-2.5
                    text-center dark:bg-blue-600 dark:hover:bg-blue-700
                    dark:focus:ring-blue-800">
                Salvar
            </button>
            <x-secondary-button wire:click="$toggle('modalIn')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    {{-- MODAL INCREMENT --}}
    <x-dialog-modal wire:model="modalOut">
        <x-slot name="title">Saída de material
            @isset($description)
                <p>{{ $description }}</p>
            @endisset
        </x-slot>
        <x-slot name="content">
            <form wire:submit="decrement">
                <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="col-span-full sm:col-span-1">
                        <label for="date" class="text-sm">*Data</label>
                        <div class="flex">
                            <input required type="text" wire:model="date" x-mask="99/99/9999"
                                placeholder="99/99/9999"
                                class="w-full  rounded-l-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                            <span
                                class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md bg-green-700">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </span>
                            @error('date')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-full sm:col-span-1 ">
                        <label for="quantity" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Qtd mínima</label>
                        <input type="number" wire:model="quantity" placeholder="Quantidade" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @error('quantity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="decrement"
                class="text-white
                    bg-blue-700 hover:bg-blue-800
                    focus:ring-4 focus:outline-none focus:ring-blue-300
                    font-medium rounded-lg text-sm px-5 py-2.5
                    text-center dark:bg-blue-600 dark:hover:bg-blue-700
                    dark:focus:ring-blue-800">
                Salvar
            </button>
            <x-secondary-button wire:click="$toggle('modalOut')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>


</div>
