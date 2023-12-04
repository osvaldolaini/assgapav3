<div
    class="flex flex-col items-center justify-between px-4
                space-y-3 md:flex-row md:space-y-0 md:space-x-4 ">
    <div class="w-full py-2 px-4 shadow-md bg-blue-200 rounded-t-md ">
        <div class="w-full flex justify-between border-bottom">
            <h3 class="mb-5 text-2xl font-bold tracki text-gray-600">Pagas</h3>
        </div>
        <div class="space-y-4 w-full mt-1">
            <div class="grid grid-cols-3 gap-1 w-full">
                @foreach ($monthlys as $item)
                    <div class="stats shadow col-span-1">
                        <div class="stat">
                            <div class="stat-figure text-primary">
                                @if ($item->status == 1 && $item->receiveds)
                                    @livewire('admin.financial.voucher', ['data' => $item->receiveds, 'type' => 'received'], key($item->id))
                                @endif
                            </div>
                            <div class="stat-title">{{ $item->monthlyRef }}</div>
                            <div class="stat-value text-primary">R${{ $item->value }}</div>
                            <div class="stat-desc">Forma de pagamento: {{ $item->Payment }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
