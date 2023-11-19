<div>

    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki sm:text-3xl dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                @if($partner->partner_category_master == 'Sócio')
                    <x-table-register-buttons id="{{ $partner->id }}"
                    :card="true"
                    :dependent="true"
                    :history="false"
                    :discount="$partner->discount"
                    >
                    </x-table-register-buttons>
                @else
                    <x-table-register-buttons id="{{ $partner->id }}"
                    :card="true"
                    :dependent="true"
                    :history="false"
                    :discount="true"
                        >
                    </x-table-register-buttons>
                @endif
            </div>
        </div>
    </x-breadcrumb>
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <div>
            <x-table-buttons-relatories
            :pdf="true"
            :print="true"
            :excel="true">
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
                                            Data
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal
                                                    text-center text-gray-500
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
                                {{-- <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
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
                                                    class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                                    {{ $data->name }}
                                                    @if ($data->category)
                                                        <div style="background-color:{{ $data->color }};"
                                                            class="badge flex-warp gap-2 mx-1 text-xs ">
                                                            {{ $data->category }}
                                                        </div>
                                                    @endif
                                                </td>

                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center
                                                     text-gray-500 dark:text-gray-400 flex-nowrap">
                                                    @if($data->partner_category_master == 'Sócio')
                                                        <x-table-register-buttons id="{{ $data->id }}"
                                                        :card="true"
                                                        :dependent="true"
                                                        :history="true"
                                                        :discount="$data->discount"
                                                         >
                                                        </x-table-register-buttons>
                                                        @else
                                                        <x-table-register-buttons id="{{ $data->id }}"
                                                           :card="true"
                                                           :dependent="true"
                                                           :history="true"
                                                           :discount="true"
                                                            >
                                                       </x-table-register-buttons>
                                                   @endif
                                                </td>

                                                <td
                                                    class="w-1/6 py-1.5 px-4 text-sm font-normal text-center text-gray-500 dark:text-gray-400">
                                                    <x-table-buttons id="{{ $data->id }}" :update="true"
                                                        :delete="true" :view="true" >
                                                    </x-table-buttons>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
{{--
                <div class="items-center justify-between  py-4">
                    {{ $dataTable->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
