<div class="pt-0 bg-white dark:bg-gray-800 sm:rounded-lg">
    <div class="px-4 my-2 bg-white  dark:bg-gray-800 sm:rounded-lg">
        @livewire('admin.dashboard.stats-card', [
            'partners' => true,
            'installmentLates' => true,
            'bill' => false,
            'partnerLate' => false,
            'locations' => true,
            'deleteLocations' => false,
            'lastReceiveds' => true,
            'cashier' => false,
            'reports' => false,
            'reportsTiny' => false,
            'dailyreports' => true,
            'accessesPool' => true,
            'releasePool' => true,
            'charts' => false,
        ])
    </div>
</div>
