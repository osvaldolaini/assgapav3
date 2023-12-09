<div class="bg-white dark:bg-gray-800 pt-0 sm:rounded-lg">
    <div class=" bg-white dark:bg-gray-800 sm:rounded-lg my-2 px-4">
            @livewire('admin.dashboard.stats-card', [
                'partners' => true,
                'installmentLates' => true,
                'bill' => true,
                'partnerLate' => true,
                'locations' => true,
                'lastReceiveds' => true,
                'cashier' => true,
                'reports' => true,
                'reportsTiny' => false,
                'dailyreports' => true,
                'accessesPool' => false,
            ])
    </div>
</div>
