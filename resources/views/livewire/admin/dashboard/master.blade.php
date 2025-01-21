<div class="pt-0 bg-white dark:bg-gray-800 sm:rounded-lg">
    <div class="px-4 my-2 bg-white  dark:bg-gray-800 sm:rounded-lg">
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
</div>
