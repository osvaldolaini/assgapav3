<div class="relative overflow-hidden bg-blue-500 text-white rounded-lg shadow-md w-full ">
    <div class="col-span-2 flex justify-end">
        <x-action-loading-calendar></x-action-loading-calendar>

    </div>
    <div class="flex items-center justify-between p-3">
        <div class="flex items-center space-x-2">
            <div class="-space-y-1">
                <h2 class="text-sm font-semibold leadi">Prestação de contas (financeiro)</h2>
            </div>
        </div>
        <span title="Open options">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 5.00005C7.01165 5.00082 6.49359 5.01338 6.09202 5.21799C5.71569 5.40973 5.40973 5.71569 5.21799 6.09202C5 6.51984 5 7.07989 5 8.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.07989 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V8.2C19 7.07989 19 6.51984 18.782 6.09202C18.5903 5.71569 18.2843 5.40973 17.908 5.21799C17.5064 5.01338 16.9884 5.00082 16 5.00005M8 5.00005V7H16V5.00005M8 5.00005V4.70711C8 4.25435 8.17986 3.82014 8.5 3.5C8.82014 3.17986 9.25435 3 9.70711 3H14.2929C14.7456 3 15.1799 3.17986 15.5 3.5C15.8201 3.82014 16 4.25435 16 4.70711V5.00005M16 11H14M16 16H14M8 11L9 12L11 10M8 16L9 17L11 15"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
    </div>
    <div class="p-0 m-0 bg-white w-full h-auto rounded-b-md ">

        <form action="">
        <div class="flex w-full items-start justify-center p-3 text-gray-900">
            <select class="rounded-l-md w-1/2 " wire:model.live="mounth">
                <option value="1" >Janeiro</option>
                <option value="2" >Fevereiro</option>
                <option value="3" >Março</option>
                <option value="4" >Abril</option>
                <option value="5" >Maio</option>
                <option value="6" >Junho</option>
                <option value="7" >Julho</option>
                <option value="8" >Agosto</option>
                <option value="9" >Setembro</option>
                <option value="10" >Outubro</option>
                <option value="11" >Novembro</option>
                <option value="12" >Dezembro</option>
            </select>
            <select class="rounded-r-md w-1/2 " wire:model.live="year">
                @for ($i = 2017; $i <= date('Y'); $i++)
                    <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </form>
        <div class="w-full px-3">
            <button wire:click="report('financial')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Financeiro">
                Financeiro
            </button>
            <button wire:click="report('spendingBySector')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Gastos por setor">
                Gastos por setor
            </button>
            <button  wire:click="report('revenueBySector')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Receitas por setor">
                Receitas por setor
            </button>
            <button  wire:click="report('cardMachine')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Maquininha">
                Maquininha
            </button>
            <button  wire:click="report('tickets')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Boletos">
                Boletos
            </button>
            <button  wire:click="report('receipts')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Recibos">
                Recibos
            </button>
            <button  wire:click="report('monthlyPayment')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Mensalidade">
                Mensalidade
            </button>
            <button  wire:click="report('pix')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Pix">
                Pix
            </button>
            <button  wire:click="report('accessPool')" class="btn-search btn btn-sm btn-info text-white shadow mx-1 my-1" data-trigger="hover" data-tooltip="tooltip" data-placement="top" title="Acesso Piscina">
                Acessos Piscina
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openPdfReports', ({
                pdfPath
            }) => {
                window.open(pdfPath, '_blank');
            })
        })
    </script>
</div>
