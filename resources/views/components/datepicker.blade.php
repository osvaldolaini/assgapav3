@props(['id','required'])
<div>
    <div class="flex">
        <input datepicker datepicker-format="dd/mm/yyyy"
            id="{{ $id }}"
            type="text"
            wire:model="{{ $id }}"
            required={{ $required }}
            x-mask="99/99/9999"
            placeholder="99/99/9999"
            class="w-full  rounded-l-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
        <span
            class="flex items-center px-3 pointer-events-none sm:text-sm rounded-r-md bg-green-700">
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
        </span>
    </div>
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/datepicker.min.js"></script>
    @endsection

    <script>
        document.addEventListener('livewire:init', function () {
            var dateOf = document.getElementById('{{ $id }}');

            dateOf.addEventListener('changeDate', (event) => {
                var date = dataAtualFormatada(event.detail.date)
                @this.set('{{ $id }}',date)
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

</div>
