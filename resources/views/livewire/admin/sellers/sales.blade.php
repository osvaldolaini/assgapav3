<div>
    <div class="tooltip tooltip-top" data-tip="Minhas vendas">
        <button wire:click='modalRegister()'
            class="flex px-3 py-2 transition-colors duration-200 btn btn-outline btn-success">
            Minhas vendas <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-1" fill="currentColor"
                viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M480 106.667c-117.82 0-213.333 95.512-213.333 213.333v1280c0 117.82 95.512 213.333 213.333 213.333h960c117.82 0 213.333-95.512 213.333-213.333V320c0-117.82-95.512-213.333-213.333-213.333H480ZM480 0h960c176.731 0 320 143.269 320 320v1280c0 176.731-143.269 320-320 320H480c-176.731 0-320-143.269-320-320V320C160 143.269 303.269 0 480 0Zm106.667 320C527.757 320 480 367.756 480 426.667v106.666C480 592.243 527.756 640 586.667 640h746.666c58.91 0 106.667-47.756 106.667-106.667V426.667c0-58.91-47.756-106.667-106.667-106.667H586.667Zm0-106.667h746.666c117.821 0 213.334 95.513 213.334 213.334v106.666c0 117.821-95.513 213.334-213.334 213.334H586.667c-117.821 0-213.334-95.513-213.334-213.334V426.667c0-117.821 95.513-213.334 213.334-213.334ZM480 853.333h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666C1072.243 853.333 1120 901.09 1120 960c0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1066.667 800 1018.91 800 960c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Zm-853.333 320h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1386.667 800 1338.91 800 1280c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Zm-853.333 320h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1706.667 800 1658.91 800 1600c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Z" />
            </svg>
        </button>
    </div>
    {{-- MODAL CREATE --}}
    <x-dialog-modal wire:model="showModalCreate">
        <x-slot name="title">Minhas Vendas</x-slot>
        <x-slot name="content">
            @isset($sales)
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr scope="col"
                                class="py-3.5 px-4 text-xs font-normal text-left text-gray-500
                                dark:text-gray-400">

                                <th scope="col"
                                    class="py-3.5 px-4 text-xs font-normal
                                            text-left text-gray-500
                                            dark:text-gray-400">
                                    Contrato
                                </th>

                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-left text-gray-500
                                            dark:text-gray-400">
                                    Espaço
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-left text-gray-500
                                            dark:text-gray-400">
                                    Locatário
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center text-gray-500
                                            dark:text-gray-400">
                                    Data / hora
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center text-gray-500
                                            dark:text-gray-400">
                                    Valor
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                            @if ($sales)
                                @foreach ($sales as $item)
                                    <tr wire:key="locations-row-{{ $item->id }}">
                                        <td
                                            class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                            {{ $item->id }}
                                            @if ($item->active == 2)
                                                <div class="gap-2 mx-1 badge badge-error">
                                                    Excluido
                                                </div>
                                            @endif
                                        </td>

                                        <td
                                            class="py-1.5 px-4 text-sm font-normal text-left itens-center text-gray-500 dark:text-gray-400">
                                            {{ $item->ambience_name->title }}
                                        </td>
                                        <td
                                            class="py-1.5 px-4 text-sm font-normal text-left itens-center text-gray-500 dark:text-gray-400">
                                            {{ $item->partner }}
                                        </td>
                                        <td
                                            class="py-1.5 px-4 text-sm font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                            {{ $item->location_date }}
                                            <p>
                                                @if ($item->location_hour_start)
                                                    <div style="background-color:green;"
                                                        class="gap-2 mx-1 text-xs badge flex-warp ">
                                                        {{ $item->location_hour_start }} -
                                                        {{ $item->location_hour_end }}</div>
                                                @endif

                                            </p>
                                        </td>
                                        <td
                                            class="py-1.5 px-4 text-sm font-normal text-left itens-center text-gray-500 dark:text-gray-400">
                                            {{ $item->value }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            @endisset
        </x-slot>
        <x-slot name="footer">

            <x-secondary-button wire:click="$toggle('showModalCreate')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
