<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
            <div class="col-span-2 flex justify-end">
            </div>
        </div>
    </x-breadcrumb>
    <section class="px-4 dark:bg-gray-800 dark:text-gray-50 container flex flex-col mx-auto space-y-12">

        <fieldset>
            <form wire:submit="save_out" class="grid grid-cols-12 gap-2 py-6 rounded-md dark:bg-gray-900">
                <div class="col-span-full">
                    <label for="title">*Motivo</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                        placeholder="Motivo" wire:model="title" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full sm:col-span-6">
                    <label for="value">*Valor</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"="Valor "
                        placeholder="Valor" x-mask:dynamic="$money($input, ',')" wire:model="value" required>
                    @error('value')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-6">
                    <label for="paid_in">*Pagamento / vencimento</label>
                    <x-datepicker id='paid_in' :required="true"></x-datepicker>
                    @error('paid_in')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-6">
                    <label for="cost_center_id">Motivo da despesa</label>
                    <select wire:model="cost_center_id"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="">Selecione...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('cost_center_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-3">
                    <label for="type">*Tipo</label>
                    <select wire:model="type"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        required>
                        <option value="">Selecione...</option>
                        <option value="1">Receita</option>
                        <option value="2">Despesa</option>
                    </select>
                    @error('type')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-3">
                    <label for="status">*Retirada de caixa</label>
                    <select wire:model="status"
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        required>
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

            <div class="flex col-span-full items-center space-x-4 mt-10 justify-end">
                <button class="btn btn-neutral">Salvar</button>
            </div>
        </form>
        </fieldset>

    </section>
</div>
