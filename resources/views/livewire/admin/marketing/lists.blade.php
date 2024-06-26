<div class="w-100">
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
            </div>
        </div>
    </x-breadcrumb>
    <x-table-buttons-relatories :pdf="true" :print="true" :excel="true">
    </x-table-buttons-relatories>

    <div>
        <div class="pt-3 bg-white dark:bg-gray-800 sm:rounded-lg">
            <x-table-search></x-table-search>

            <div class="p-4 col-span-full lg:col-span-3">
                <ul
                    class="grid items-center w-full grid-cols-5 gap-4 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li
                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 ">
                        <div class="flex items-center justify-around px-3">
                            <label
                                class="flex items-center w-full py-3 mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{-- <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg> --}}
                                <span class="ml-2">CPF / CNPJ</span>
                            </label>
                            <input id="vue-checkbox-list" type="checkbox" value="" wire:model.lazy="pf_pj"
                                class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 rounded cursor-pointer focus:ring-blue-400 dark:focus:ring-blue-400 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                    </li>
                    <li
                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 ">
                        <div class="flex items-center justify-around px-3">
                            <label
                                class="flex items-center w-full py-3 mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{-- <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg> --}}
                                <span class="ml-2">Email</span>
                            </label>
                            <input id="vue-checkbox-list" type="checkbox" value="" wire:model.lazy="email"
                                class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 rounded cursor-pointer focus:ring-blue-400 dark:focus:ring-blue-400 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                    </li>
                    <li
                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 ">
                        <div class="flex items-center justify-around px-3">
                            <label
                                class="flex items-center w-full py-3 mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{-- <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg> --}}
                                <span class="ml-2">Endereço</span>
                            </label>
                            <input id="vue-checkbox-list" type="checkbox" value="" wire:model.lazy="address"
                                class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 rounded cursor-pointer focus:ring-blue-400 dark:focus:ring-blue-400 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                    </li>
                    <li
                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 ">
                        <div class="flex items-center justify-around px-3">
                            <label
                                class="flex items-center w-full py-3 mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{-- <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg> --}}
                                <span class="ml-2">RG</span>
                            </label>
                            <input id="vue-checkbox-list" type="checkbox" value="" wire:model.lazy="rg"
                                class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 rounded cursor-pointer focus:ring-blue-400 dark:focus:ring-blue-400 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                    </li>
                    <li
                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 ">
                        <div class="flex items-center justify-around px-3">
                            <label
                                class="flex items-center w-full py-3 mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{-- <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg> --}}
                                <span class="ml-2">Telefones</span>
                            </label>
                            <input id="vue-checkbox-list" type="checkbox" value="" wire:model.lazy="phone"
                                class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 rounded cursor-pointer focus:ring-blue-400 dark:focus:ring-blue-400 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                    </li>
                </ul>
                <ul
                class="grid items-center w-full grid-cols-5 gap-4 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li
                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 ">
                    <div class="flex items-center justify-around px-3">
                        <label
                            class="flex items-center w-full py-3 mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{-- <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg> --}}
                            <span class="ml-2">Data Nascimento</span>
                        </label>
                        <input id="vue-checkbox-list" type="checkbox" value="" wire:model.lazy="date_of_birth"
                            class="w-4 h-4 text-blue-500 bg-gray-100 border-gray-300 rounded cursor-pointer focus:ring-blue-400 dark:focus:ring-blue-400 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    </div>
                </li>

            </ul>
            </div>
            <div class="px-4 my-6 bg-white dark:bg-gray-800 sm:rounded-lg">
                <div class="-mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                                            Sócio
                                        </th>
                                        @if ($date_of_birth)
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal
                                                        text-center text-gray-500
                                                        dark:text-gray-400">
                                                Data de Nascimento
                                            </th>
                                        @endif
                                        @if ($pf_pj)
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal
                                                        text-center text-gray-500
                                                        dark:text-gray-400">
                                                CPF / CNPJ
                                            </th>
                                        @endif
                                        @if ($email)
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal
                                                        text-center text-gray-500
                                                        dark:text-gray-400">
                                                Email
                                            </th>
                                        @endif
                                        @if ($phone)
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal
                                                        text-center text-gray-500
                                                        dark:text-gray-400">
                                                Telefones
                                            </th>
                                        @endif
                                        @if ($address)
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal
                                                        text-center text-gray-500
                                                        dark:text-gray-400">
                                                Endereço
                                            </th>
                                        @endif
                                        @if ($rg)
                                            <th scope="col"
                                                class="py-3.5 px-4 text-sm font-normal
                                                        text-center text-gray-500
                                                        dark:text-gray-400">
                                                RG
                                            </th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900 ">
                                    @if ($dataTable->isEmpty())
                                        <tr>
                                            <td colspan="5"
                                                class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                                Nenhum resultado encontrado.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($dataTable as $data)
                                            <tr>
                                                <td
                                                    class="py-1.5 px-4 text-xs font-normal  text-left text-gray-500 dark:text-gray-400">
                                                    {{ $data->name }}
                                                    @if ($data->category)
                                                        <div style="background-color:{{ $data->color }};"
                                                            class="gap-2 mx-1 text-xs badge flex-warp ">
                                                            {{ $data->category }}
                                                        </div>
                                                    @endif
                                                </td>
                                                @if ($date_of_birth)
                                                    <td
                                                        class="py-1.5 px-4 text-xs font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                        {{ ($data->date_of_birth ? $data->date_of_birth .' ( '.  $data->age .' anos)' : '')}}
                                                    </td>
                                                @endif
                                                @if ($pf_pj)
                                                    <td
                                                        class="py-1.5 px-4 text-xs font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                        @if ($data->pf_pj == 'pf')
                                                            {{ $data->cpf }}
                                                        @else
                                                            {{ $data->cnpj }}
                                                        @endif
                                                    </td>
                                                @endif
                                                @if ($email)
                                                    <td
                                                        class="py-1.5 px-4 text-xs font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                        {{ $data->email }}
                                                    </td>
                                                @endif
                                                @if ($phone)
                                                    <td
                                                        class="py-1.5 px-4 text-xs font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                        {{ $data->phone_first }}
                                                    </td>
                                                @endif
                                                @if ($address)
                                                    <td
                                                        class="py-1.5 px-4 text-xs font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                        {{ $data->address }},{{ $data->number }},{{ $data->city }}-{{ $data->state }}
                                                    </td>
                                                @endif
                                                @if ($rg)
                                                    <td
                                                        class="py-1.5 px-4 text-xs font-normal text-center itens-center text-gray-500 dark:text-gray-400">
                                                        {{ $data->rg }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="items-center justify-between py-4">
                    {{ $dataTable->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
