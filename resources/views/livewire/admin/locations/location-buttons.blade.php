<div>
    <div class="w-full">
        <div class="flex justify-end font-medium duration-200 ">
            @if ($update == true)
                <div class="tooltip tooltip-top p-0" data-tip="Editar">
                    <a href="{{ route('edit-location',$id) }}"
                    class="py-2 px-3 flex
                    hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                    duration-200 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </a>
                </div>
            @endif
            <div class="tooltip tooltip-top p-0" data-tip="Extras">
                <a href="{{ route('extras-location',$id) }}"
                    class="py-2 px-3 flex
                        hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                        duration-200 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 9.5C5.38071 9.5 6.5 10.6193 6.5 12C6.5 13.3807 5.38071 14.5 4 14.5C2.61929 14.5 1.5 13.3807 1.5 12C1.5 10.6193 2.61929 9.5 4 9.5Z" fill="currentColor"/>
                        <path d="M12 9.5C13.3807 9.5 14.5 10.6193 14.5 12C14.5 13.3807 13.3807 14.5 12 14.5C10.6193 14.5 9.5 13.3807 9.5 12C9.5 10.6193 10.6193 9.5 12 9.5Z" fill="currentColor"/>
                        <path d="M22.5 12C22.5 10.6193 21.3807 9.5 20 9.5C18.6193 9.5 17.5 10.6193 17.5 12C17.5 13.3807 18.6193 14.5 20 14.5C21.3807 14.5 22.5 13.3807 22.5 12Z" fill="currentColor"/>
                        </svg>
                </a>
            </div>

            <div class="tooltip tooltip-top p-0" data-tip="Parcelas">
                <a href="{{ route('installments-location',$id) }}"
                    class="py-2 px-3 flex
                        hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                        duration-200 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 "  viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                        <g>
                            <path fill="currentColor" d="M0,32v20c0,2.211,1.789,4,4,4h56c2.211,0,4-1.789,4-4V32H0z M24,44h-8c-2.211,0-4-1.789-4-4s1.789-4,4-4h8
                                c2.211,0,4,1.789,4,4S26.211,44,24,44z"/>
                            <path fill="currentColor" d="M64,24V12c0-2.211-1.789-4-4-4H4c-2.211,0-4,1.789-4,4v12H64z"/>
                        </g>
                        </svg>
                </a>
            </div>

            <div class="tooltip tooltip-top p-0" data-tip="Termo de vistoria">
                <button wire:click="printTerm() "
                    class="py-2 px-3 flex
                            hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                            duration-200 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="currentColor" viewBox="-64 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z"/></svg>
                </button>
            </div>

            <div class="tooltip tooltip-top p-0" data-tip="Contrato">
                <button wire:click="printContract() "
                    class="py-2 px-3 flex
                            hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                            duration-200 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="currentColor"version="1.1"
                        id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 204.376 204.376" xml:space="preserve">
                        <path d="M110.397,47.736V0H33.13c-2.485,0-4.5,2.015-4.5,4.5v195.376c0,2.485,2.015,4.5,4.5,4.5h138.117c2.485,0,4.5-2.015,4.5-4.5
                       V61.35h-51.744C116.501,61.35,110.397,55.243,110.397,47.736z M108.499,168.626h-46.5v-10h46.5V168.626z M143.499,143.626h-81.5v-10
                       h81.5V143.626z M143.499,118.627h-81.5v-10h81.5V118.627z M143.499,93.627h-81.5v-10h81.5V93.627z M120.397,47.736v-37.34
                       L164.2,51.35h-40.197C122.014,51.35,120.397,49.729,120.397,47.736z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('openPdfInNewTab', ({
                    pdfPath
                }) => {
                    window.open(pdfPath, '_blank');
                })
            })
        </script>
    @endsection
</div>
