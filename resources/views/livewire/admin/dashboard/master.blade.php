<div class="pt-0 bg-white dark:bg-gray-800 sm:rounded-lg">
    <div class="px-4 my-2 bg-white dark:bg-gray-800 sm:rounded-lg">
        @livewire('admin.dashboard.stats-card', [
            'partners' => true,
            'installmentLates' => true,
            'bill' => true,
            'partnerLate' => true,
            'locations' => true,
            'deleteLocations' => false,
            'lastReceiveds' => true,
            'cashier' => true,
            'reports' => true,
            'reportsTiny' => false,
            'dailyreports' => true,
            'accessesPool' => false,
            'releasePool' => false,
            'charts' => true,
        ])
    </div>
    {{-- <x-confirmation-modal wire:model="showJetModal">
        <x-slot name="title">
            Dependentes para remover
        </x-slot>

        <x-slot name="content">
            <h2 class="h2">Existem {{ $remove }} dependentes para remover</h2>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showJetModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="go_to()" wire:loading.attr="disabled">
                Lista de dependentes
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal> --}}
</div>
