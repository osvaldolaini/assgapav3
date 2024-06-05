<div class="bg-white dark:bg-gray-800 pt-0 sm:rounded-lg">
    <div class=" bg-white dark:bg-gray-800 sm:rounded-lg my-2 px-4">
            @livewire('admin.dashboard.stats-card', [
                'partners'          => true,
                'installmentLates'  => true,
                'bill'              => true,
                'partnerLate'       => true,
                'locations'         => true,
                'deleteLocations'   => true,
                'lastReceiveds'     => true,
                'cashier'           => false,
                'reports'           => false,
                'reportsTiny'       => true,
                'dailyreports'      => true,
                'accessesPool'      => true,
                'charts'            => false,
            ])
    </div>
</div>
