<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki sm:text-3xl dark:text-gray-50">
                    <a class="no-underline "
                        @if ($partner->partner_category_master == 'Sócio') href="{{ route('edit-partner', $partner->id) }}"
                        @else
                            href="{{ route('edit-other', $partner->id) }}" @endif>
                        {{ $breadcrumb_title }}
                    </a>
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                @if ($partner->partner_category_master == 'Sócio')
                    <x-table-register-buttons id="{{ $partner->id }}" :card="false" :dependent="true"
                        :history="true" :discount="$partner->discount">
                    </x-table-register-buttons>
                @else
                    <x-table-register-buttons id="{{ $partner->id }}" :card="false" :dependent="true"
                        :history="true" :discount="true">
                    </x-table-register-buttons>
                @endif
            </div>
        </div>
    </x-breadcrumb>
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div>
            <div class=" bg-white dark:bg-gray-800 sm:rounded-lg my-6 px-4">
                <div class="-mx-4  overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table style="width:100%" class='min-w-full divide-y divide-gray-200 dark:divide-gray-700'>
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr scope="col"
                                        class="py-3.5 px-4 text-xs font-normal text-left text-gray-500
                                        dark:text-gray-400">
                                        <th scope="col"
                                            class="py-3.5 px-4 text-xs font-normal
                                                    text-left text-gray-500
                                                    dark:text-gray-400">
                                            Nome
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Idade
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Parantesco
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Validade carteirinha
                                        </th>
                                        <th scope="col"
                                            class=" py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    <tr>
                                        <td
                                            class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">

                                            <a class="no-underline hover:underline hover:decoration-blue-300 hover:decoration-2"
                                                @if ($partner->partner_category_master == 'Sócio') href="{{ route('edit-partner', $partner->id) }}"
                                                @else
                                                    href="{{ route('edit-other', $partner->id) }}" @endif>
                                                {{ $partner->name }}
                                            </a>
                                        </td>

                                        <td
                                            class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                            {{ $partner->age }}
                                        </td>
                                        <td
                                            class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                            {{ $partner->kinship }}
                                        </td>
                                        <td
                                            class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                            {{ $partner->validity_of_card }}
                                        </td>

                                        <td
                                            class="  py-1.5 px-4 text-sm font-normal flex
                                                    text-gray-500 dark:text-gray-400 mx-auto">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" value="{{ $partner->id }}" wire:model="print"
                                                    class="sr-only peer">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>

                                            </label>
                                        </td>
                                    </tr>
                                    @if ($partner->dependents)
                                        @foreach ($partner->dependents as $dependent)
                                            @if ($dependent->date_of_birth)
                                                @php
                                                    $c = strtotime(date('Y-m-d')) - strtotime($dependent->convertDate($dependent->date_of_birth));
                                                    $age = floor($c / (60 * 60 * 24) / 365.25);
                                                @endphp
                                            @else
                                                @php
                                                    $age = '';
                                                @endphp
                                            @endif
                                            <tr>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">

                                                    <a class="no-underline hover:underline hover:decoration-blue-300 hover:decoration-2"
                                                        href="{{ route('edit-dependent', $dependent->id) }}" >
                                                        {{ $dependent->name }}
                                                    </a>

                                                </td>

                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                                    {{ $dependent->age }}

                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                                    {{ $dependent->kinship }}

                                                </td>
                                                <td
                                                    class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                                    {{ $dependent->validity_of_card }}
                                                </td>

                                                <td
                                                    class="  py-1.5 px-4 text-sm font-normal flex
                                                    text-gray-500 dark:text-gray-400 mx-auto">
                                                    @if ($dependent->date_of_birth)

                                                        @if ($dependent->age > 24)
                                                            @if ($dependent->needs == 1)
                                                                <label
                                                                    class="relative inline-flex items-center cursor-pointer">
                                                                    <input type="checkbox" value="{{ $dependent->id }}"
                                                                        wire:model="print" class="sr-only peer">
                                                                    <div
                                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                                    </div>

                                                                </label>
                                                            @else
                                                            <svg class='w-10 h-10 text-red-600' version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    viewBox="0 0 30.859 30.859"fill='currentColor' xml:space="preserve">
                                                                <g>
                                                                    <circle  cx="3.41" cy="5.149" r="0.974"/>
                                                                    <circle  cx="6.333" cy="5.149" r="0.974"/>
                                                                    <path  d="M9.317,6.123c0.535,0,0.971-0.434,0.971-0.973S9.852,4.176,9.317,4.176
                                                                        c-0.539,0-0.978,0.436-0.978,0.975S8.778,6.123,9.317,6.123z"/>
                                                                    <path  d="M22.92,12.27c0.84,0,1.645,0.133,2.404,0.375V7.608H1.95v16.535h14.09
                                                                        c-0.668-1.162-1.057-2.5-1.057-3.936C14.983,15.832,18.547,12.27,22.92,12.27z"/>
                                                                    <path  d="M26.954,25.203c-0.428,0.346-0.904,0.639-1.414,0.869C26.129,26.002,26.643,25.677,26.954,25.203z"
                                                                        />
                                                                    <path  d="M27.27,13.574v-8.91c0-1.08-0.875-1.949-1.945-1.949H1.95C0.872,2.715,0,3.584,0,4.664v19.479
                                                                        c0,1.076,0.872,1.947,1.95,1.947h15.664c1.406,1.271,3.268,2.055,5.307,2.055c4.377,0,7.938-3.562,7.938-7.938
                                                                        C30.858,17.436,29.43,14.996,27.27,13.574z M9.317,4.176c0.535,0,0.971,0.436,0.971,0.975S9.852,6.123,9.317,6.123
                                                                        c-0.539,0-0.978-0.434-0.978-0.973S8.778,4.176,9.317,4.176z M6.333,4.176c0.536,0,0.976,0.436,0.976,0.975
                                                                        s-0.44,0.972-0.976,0.972c-0.54,0-0.976-0.434-0.976-0.973S5.793,4.176,6.333,4.176z M3.41,4.176c0.538,0,0.975,0.436,0.975,0.975
                                                                        S3.948,6.123,3.41,6.123c-0.537,0-0.973-0.434-0.973-0.973S2.873,4.176,3.41,4.176z M1.95,24.142V7.608h23.375v5.037
                                                                        c-0.76-0.242-1.564-0.375-2.404-0.375c-4.373,0-7.938,3.562-7.938,7.938c0,1.436,0.389,2.773,1.057,3.936H1.95V24.142z
                                                                        M26.954,25.203c-0.311,0.475-0.824,0.799-1.414,0.869c-0.799,0.355-1.686,0.559-2.619,0.559c-0.912,0-1.783-0.195-2.57-0.541
                                                                        c-0.986-0.432-1.84-1.107-2.494-1.947c-0.848-1.088-1.359-2.451-1.359-3.936c0-3.541,2.883-6.424,6.424-6.424
                                                                        c0.85,0,1.66,0.17,2.404,0.469c0.725,0.293,1.381,0.719,1.945,1.242c1.271,1.174,2.074,2.85,2.074,4.713
                                                                        C29.344,22.225,28.411,24.021,26.954,25.203z"/>
                                                                    <path  d="M22.958,12.449c-4.275,0-7.742,3.465-7.742,7.738c0,4.275,3.467,7.744,7.742,7.744
                                                                        c4.277,0,7.744-3.469,7.744-7.744C30.702,15.914,27.235,12.449,22.958,12.449z M28.348,20.188c0,1.062-0.309,2.053-0.84,2.889
                                                                        l-7.436-7.438c0.836-0.533,1.826-0.842,2.885-0.842C25.932,14.797,28.348,17.216,28.348,20.188z M17.567,20.188
                                                                        c0-1.061,0.311-2.049,0.842-2.885l7.438,7.436c-0.836,0.529-1.826,0.842-2.889,0.842C19.985,25.58,17.567,23.162,17.567,20.188z"/>
                                                                </g>
                                                                </svg>
                                                            @endif
                                                        @else
                                                            <label
                                                                class="relative inline-flex items-center cursor-pointer">
                                                                <input type="checkbox" value="{{ $dependent->id }}"
                                                                    wire:model="print" class="sr-only peer">
                                                                <div
                                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                                </div>

                                                            </label>
                                                        @endif
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex col-span-full items-center space-x-4 mt-10 justify-end">

                    <button wire:click="printCards()"
                        class="flex items-center justify-center w-1/2 px-5
                            py-3 text-sm tracking-wide text-white transition-colors
                            duration-200 bg-blue-500 rounded-lg sm:w-auto hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                        <svg class="h-6 w-6 mr-2" fill="currentColor" viewBox="0 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.656 6.938l-0.344 2.688h11.781l-0.344-2.688c0-0.813-0.656-1.438-1.469-1.438h-8.188c-0.813 0-1.438 0.625-1.438 1.438zM1.438 11.094h19.531c0.813 0 1.438 0.625 1.438 1.438v8.563c0 0.813-0.625 1.438-1.438 1.438h-2.656v3.969h-14.219v-3.969h-2.656c-0.813 0-1.438-0.625-1.438-1.438v-8.563c0-0.813 0.625-1.438 1.438-1.438zM16.875 25.063v-9.281h-11.344v9.281h11.344zM15.188 18.469h-8.125c-0.188 0-0.344-0.188-0.344-0.375v-0.438c0-0.188 0.156-0.344 0.344-0.344h8.125c0.188 0 0.375 0.156 0.375 0.344v0.438c0 0.188-0.188 0.375-0.375 0.375zM15.188 21.063h-8.125c-0.188 0-0.344-0.188-0.344-0.375v-0.438c0-0.188 0.156-0.344 0.344-0.344h8.125c0.188 0 0.375 0.156 0.375 0.344v0.438c0 0.188-0.188 0.375-0.375 0.375zM15.188 23.656h-8.125c-0.188 0-0.344-0.188-0.344-0.375v-0.438c0-0.188 0.156-0.344 0.344-0.344h8.125c0.188 0 0.375 0.156 0.375 0.344v0.438c0 0.188-0.188 0.375-0.375 0.375z">
                            </path>
                        </svg>
                        <span>Imprimir </span>
                    </button>

                </div>
            </div>
        </div>
    </div>
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
