<div>

    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki sm:text-3xl dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                @if ($partner->partner_category_master == 'Sócio')
                    <x-table-register-buttons id="{{ $partner->id }}" :card="true" :dependent="true"
                        :history="false" :discount="$partner->discount">
                    </x-table-register-buttons>
                @else
                    <x-table-register-buttons id="{{ $partner->id }}" :card="true" :dependent="true"
                        :history="false" :discount="true">
                    </x-table-register-buttons>
                @endif
            </div>
        </div>
    </x-breadcrumb>
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div>
            <x-table-buttons-relatories :pdf="true" :print="true" :excel="true">
            </x-table-buttons-relatories>
            <div class=" bg-white dark:bg-gray-800 sm:rounded-lg mb-6 mt-1 px-4">
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
                                            Tipo
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-xs font-normal
                                                    text-left text-gray-500
                                                    dark:text-gray-400">
                                            Data
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-left text-gray-500
                                                    dark:text-gray-400">
                                            Motivo
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
                                                    dark:text-gray-400">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @if (!isset($dataTable))
                                        <tr>
                                            <td colspan="5"
                                                class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                                Nenhum resultado encontrado.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach (json_decode($dataTable) as $data)
                                            <tr>
                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                                    {{ $data->type }}
                                                </td>
                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                                    {{ $data->date }}
                                                </td>

                                                <td
                                                    class="w-3/6 py-1.5 px-4 text-sm font-normal text-justify
                                                     text-gray-500 dark:text-gray-400 flex-nowrap">
                                                    {{ $data->description }}
                                                </td>

                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center
                                                     text-gray-500 dark:text-gray-400 flex-nowrap">
                                                    @if (!empty($data->link))
                                                        <div class="tooltip tooltip-top p-0" data-tip="Link">
                                                            <a href="{{ $data->link }}"
                                                                class="py-2 px-3 flex
                                                            hover:text-white dark:hover:bg-blue-500 transition-colors
                                                            hover:hover:bg-blue-500 duration-200 ">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.16488 17.6505C8.92513 17.8743 8.73958 18.0241 8.54996 18.1336C7.62175 18.6695 6.47816 18.6695 5.54996 18.1336C5.20791 17.9361 4.87912 17.6073 4.22153 16.9498C3.56394 16.2922 3.23514 15.9634 3.03767 15.6213C2.50177 14.6931 2.50177 13.5495 3.03767 12.6213C3.23514 12.2793 3.56394 11.9505 4.22153 11.2929L7.04996 8.46448C7.70755 7.80689 8.03634 7.47809 8.37838 7.28062C9.30659 6.74472 10.4502 6.74472 11.3784 7.28061C11.7204 7.47809 12.0492 7.80689 12.7068 8.46448C13.3644 9.12207 13.6932 9.45086 13.8907 9.7929C14.4266 10.7211 14.4266 11.8647 13.8907 12.7929C13.7812 12.9825 13.6314 13.1681 13.4075 13.4078M10.5919 10.5922C10.368 10.8319 10.2182 11.0175 10.1087 11.2071C9.57284 12.1353 9.57284 13.2789 10.1087 14.2071C10.3062 14.5492 10.635 14.878 11.2926 15.5355C11.9502 16.1931 12.279 16.5219 12.621 16.7194C13.5492 17.2553 14.6928 17.2553 15.621 16.7194C15.9631 16.5219 16.2919 16.1931 16.9495 15.5355L19.7779 12.7071C20.4355 12.0495 20.7643 11.7207 20.9617 11.3787C21.4976 10.4505 21.4976 9.30689 20.9617 8.37869C20.7643 8.03665 20.4355 7.70785 19.7779 7.05026C19.1203 6.39267 18.7915 6.06388 18.4495 5.8664C17.5212 5.3305 16.3777 5.3305 15.4495 5.8664C15.2598 5.97588 15.0743 6.12571 14.8345 6.34955"
                                                                        stroke="#000000" stroke-width="2"
                                                                        stroke-linecap="round" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if (!empty($data->received))
                                                        <div class="tooltip tooltip-top p-0" data-tip="Recibo">
                                                            <button wire:click="printReceived({{ $data->received }})"
                                                                class=" py-2 px-3 hover:bg-blue-500 text-blue-500 hover:text-white transition-colors
                                                            duration-200 whitespace-nowrap">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "
                                                                    viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4.5 0h11A1.5 1.5 0 0117 1.5v18.223a.2.2 0 01-.335.148l-1.662-1.513a.5.5 0 00-.673 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.674 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.673 0L3.335 19.87A.2.2 0 013 19.723V1.5A1.5 1.5 0 014.5 0zm4.207 11.293c.667.667 1.29.706 1.316.707.528 0 .977-.448.977-1 0-.646-.128-.751-1.243-1.03h-.001C8.725 9.712 7 9.28 7 7a2.993 2.993 0 012-2.815V4a1 1 0 012 0v.2c.645.23 1.228.604 1.707 1.093a1 1 0 01-1.414 1.414c-.667-.667-1.291-.706-1.317-.707C9.448 6 9 6.448 9 7c0 .646.127.751 1.242 1.03h.002C11.274 8.288 13 8.72 13 11a2.995 2.995 0 01-2 2.815V14a1 1 0 01-2 0v-.2a4.49 4.49 0 01-1.707-1.093 1 1 0 111.414-1.414z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @if (!empty($data->bill))
                                                        <div class="tooltip tooltip-top p-0" data-tip="Recibo">
                                                            <button wire:click="printBill({{ $data->bill }})"
                                                                class=" py-2 px-3 hover:bg-blue-500 text-blue-500 hover:text-white transition-colors
                                                            duration-200 whitespace-nowrap">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "
                                                                    viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4.5 0h11A1.5 1.5 0 0117 1.5v18.223a.2.2 0 01-.335.148l-1.662-1.513a.5.5 0 00-.673 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.674 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.673 0L3.335 19.87A.2.2 0 013 19.723V1.5A1.5 1.5 0 014.5 0zm4.207 11.293c.667.667 1.29.706 1.316.707.528 0 .977-.448.977-1 0-.646-.128-.751-1.243-1.03h-.001C8.725 9.712 7 9.28 7 7a2.993 2.993 0 012-2.815V4a1 1 0 012 0v.2c.645.23 1.228.604 1.707 1.093a1 1 0 01-1.414 1.414c-.667-.667-1.291-.706-1.317-.707C9.448 6 9 6.448 9 7c0 .646.127.751 1.242 1.03h.002C11.274 8.288 13 8.72 13 11a2.995 2.995 0 01-2 2.815V14a1 1 0 01-2 0v-.2a4.49 4.49 0 01-1.707-1.093 1 1 0 111.414-1.414z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </button>
                                                        </div>
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
