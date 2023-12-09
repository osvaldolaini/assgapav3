<div class="relative overflow-hidden bg-blue-500 text-white rounded-lg shadow-md h-32 col-span-1">
    <div class="flex items-center justify-between p-3">
        <div class="flex items-center space-x-2">
            <div class="-space-y-1">
                <h2 class="text-sm font-semibold leadi">Relatório diário</h2>
            </div>
        </div>
        <span title="Open options">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 5.00005C7.01165 5.00082 6.49359 5.01338 6.09202 5.21799C5.71569 5.40973 5.40973 5.71569 5.21799 6.09202C5 6.51984 5 7.07989 5 8.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.07989 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V8.2C19 7.07989 19 6.51984 18.782 6.09202C18.5903 5.71569 18.2843 5.40973 17.908 5.21799C17.5064 5.01338 16.9884 5.00082 16 5.00005M8 5.00005V7H16V5.00005M8 5.00005V4.70711C8 4.25435 8.17986 3.82014 8.5 3.5C8.82014 3.17986 9.25435 3 9.70711 3H14.2929C14.7456 3 15.1799 3.17986 15.5 3.5C15.8201 3.82014 16 4.25435 16 4.70711V5.00005M16 11H14M16 16H14M8 11L9 12L11 10M8 16L9 17L11 15"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <div class="p-0 m-0 bg-white w-full h-32 rounded-b-md flex items-center justify-center">
        <fieldset class="space-y-1 h-28 w-full px-2">
            <label for="Search" class="hidden">Search</label>
            <div class="relative w-full">
                <div class="flex w-full">
                    <input
                    datepicker datepicker-format="dd/mm/yyyy"
                    wire:model="search"
                    id="search"
                    placeholder="Pesquisar..."
                    class="text-sm w-full rounded-l-md text-gray-900 focus:outline-none focus:border-blue-400">
                    <button wire:click="getDaily()" class="flex items-center px-1 cursor-pointer text-sm rounded-r-md bg-blue-500">
                        <svg fill="currentColor" viewBox="0 0 512 512" class="w-6 h-6 text-white px-1">
                            <path d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </fieldset>
    </div>
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/datepicker.min.js"></script>
    @endsection

    <script>
        document.addEventListener('livewire:init', function () {
            var dateOf = document.getElementById('search');

            dateOf.addEventListener('changeDate', (event) => {
                var date = dataAtualFormatada(event.detail.date)
                @this.set('search',date)
            });

            function dataAtualFormatada(date){
                var data = date,
                    dia  = data.getDate().toString(),
                    diaF = (dia.length == 1) ? '0'+dia : dia,
                    mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
                    mesF = (mes.length == 1) ? '0'+mes : mes,
                    anoF = data.getFullYear();
                return diaF+"/"+mesF+"/"+anoF;
            }
        })
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openPdfInNewTab', ({
                pdfPath
            }) => {
                window.open(pdfPath, '_blank');
            })
        })
    </script>
</div>
