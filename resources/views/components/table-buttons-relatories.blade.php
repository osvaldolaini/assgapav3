@props(['pdf', 'excel'])
<div>
    <div class="flex col-span-full items-center space-x-4 mt-2 justify-start px-4 pb-0 mb-0">
        @if (isset($pdf))
        <button wire:click="printCards()"
            class="flex items-center justify-center w-1/2 px-2 py-1
                 text-sm tracking-wide text-white transition-colors
                duration-200 bg-blue-500 rounded-lg sm:w-auto hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
            <svg class="h-8 w-8 " fill="currentColor" viewBox="0 0 32 32" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.656 6.938l-0.344 2.688h11.781l-0.344-2.688c0-0.813-0.656-1.438-1.469-1.438h-8.188c-0.813 0-1.438 0.625-1.438 1.438zM1.438 11.094h19.531c0.813 0 1.438 0.625 1.438 1.438v8.563c0 0.813-0.625 1.438-1.438 1.438h-2.656v3.969h-14.219v-3.969h-2.656c-0.813 0-1.438-0.625-1.438-1.438v-8.563c0-0.813 0.625-1.438 1.438-1.438zM16.875 25.063v-9.281h-11.344v9.281h11.344zM15.188 18.469h-8.125c-0.188 0-0.344-0.188-0.344-0.375v-0.438c0-0.188 0.156-0.344 0.344-0.344h8.125c0.188 0 0.375 0.156 0.375 0.344v0.438c0 0.188-0.188 0.375-0.375 0.375zM15.188 21.063h-8.125c-0.188 0-0.344-0.188-0.344-0.375v-0.438c0-0.188 0.156-0.344 0.344-0.344h8.125c0.188 0 0.375 0.156 0.375 0.344v0.438c0 0.188-0.188 0.375-0.375 0.375zM15.188 23.656h-8.125c-0.188 0-0.344-0.188-0.344-0.375v-0.438c0-0.188 0.156-0.344 0.344-0.344h8.125c0.188 0 0.375 0.156 0.375 0.344v0.438c0 0.188-0.188 0.375-0.375 0.375z">
                </path>
            </svg>
            <span>Imprimir </span>
        </button>
        @endif
        @if (isset($excel))
        <button wire:click="printCards()"
            class="flex items-center justify-center w-1/2 px-2 py-1
                 text-sm tracking-wide text-white transition-colors
                duration-200 bg-green-500 rounded-lg sm:w-auto hover:bg-green-600 dark:hover:bg-green-500 dark:bg-green-600">
            <svg class="h-8 w-8 text-white mr-1" fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><title>file_type_excel2</title><path d="M28.781,4.405H18.651V2.018L2,4.588V27.115l16.651,2.868V26.445H28.781A1.162,1.162,0,0,0,30,25.349V5.5A1.162,1.162,0,0,0,28.781,4.405Zm.16,21.126H18.617L18.6,23.642h2.487v-2.2H18.581l-.012-1.3h2.518v-2.2H18.55l-.012-1.3h2.549v-2.2H18.53v-1.3h2.557v-2.2H18.53v-1.3h2.557v-2.2H18.53v-2H28.941Z" style="fill:#20744a;fill-rule:evenodd"/><rect x="22.487" y="7.439" width="4.323" height="2.2" /><rect x="22.487" y="10.94" width="4.323" height="2.2" /><rect x="22.487" y="14.441" width="4.323" height="2.2" /><rect x="22.487" y="17.942" width="4.323" height="2.2" /><rect x="22.487" y="21.443" width="4.323" height="2.2" /><polygon points="6.347 10.673 8.493 10.55 9.842 14.259 11.436 10.397 13.582 10.274 10.976 15.54 13.582 20.819 11.313 20.666 9.781 16.642 8.248 20.513 6.163 20.329 8.585 15.666 6.347 10.673" /></svg>
            <span>Exportar </span>
        </button>
        @endif
    </div>
</div>
