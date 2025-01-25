<div class="pt-0 bg-white dark:bg-gray-800 sm:rounded-lg">
    <div class="px-4 my-2 bg-white  dark:bg-gray-800 sm:rounded-lg">
        @livewire('admin.dashboard.stats-card', [
            'partners' => true,
            'installmentLates' => true,
            'bill' => true,
            'partnerLate' => true,
            'locations' => true,
            'deleteLocations' => true,
            'lastReceiveds' => true,
            'cashier' => false,
            'reports' => false,
            'reportsTiny' => true,
            'dailyreports' => true,
            'accessesPool' => true,
            'releasePool' => false,
            'charts' => false,
        ])
    </div>
</div>
