<div class="w-100">

    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">
                @if ($partner_category_master == 'Sócio')
                    <x-table-register-buttons id="{{ $id }}" :card="true" :dependent="true"
                        :history="true" :discount="true">
                    </x-table-register-buttons>
                @else
                    @if ($partner_category_master == 'Dependente')
                        <x-table-register-buttons id="{{ $id }}" :card="true" :dependent="false"
                            :history="true" :discount="true">
                        </x-table-register-buttons>
                    @else
                        <x-table-register-buttons id="{{ $id }}" :card="true" :dependent="true"
                            :history="true" :discount="true">
                        </x-table-register-buttons>
                    @endif
                @endif
            </div>
        </div>
    </x-breadcrumb>
    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg ">
        @livewire('admin.monthly.monthly-unpaid', ['partner' => $partner])
        @livewire('admin.monthly.monthly-paid', ['partner' => $partner])
    </div>
</div>
