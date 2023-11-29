<div>
    <x-breadcrumb>
        <div class="grid grid-cols-7 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>
        </div>
    </x-breadcrumb>
    <section class="px-4 dark:bg-gray-800 dark:text-gray-50 container flex flex-col mx-auto space-y-12">
        <form wire:submit="save_out">
            <fieldset class="grid grid-cols-12 gap-2 py-6 rounded-md dark:bg-gray-900">
                <div class="col-span-full sm:col-span-6">
                    <label for="title">*Nome</label>
                    <input class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Nome " wire:model="title" required maxlength="100">
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-4">
                    <label for="ambience_category" class="text-sm">*Categoria</label>
                    <Select wire:model="ambience_category" required
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="">Selecione...</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </Select>
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="multiple" class="text-sm">*Multiplas locações</label>
                    <Select wire:model="multiple" required
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </Select>
                </div>
                <div class="col-span-full sm:col-span-8">
                    <label for="time_week">*Dias úteis</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Dias úteis" wire:model="time_week" required maxlength="100">
                    @error('time_week')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="capacity">*Capacidade</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Capacidade" wire:model="capacity" required maxlength="4">
                    @error('capacity')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="cashback">*Cashback ( % )</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Cashback ( % )" wire:model="cashback" required maxlength="4">
                    @error('cashback')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-10">
                    <label for="time_weekend">*Dias não úteis</label>
                    <input
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                        placeholder="Dias não úteis" wire:model="time_weekend" required maxlength="100">
                    @error('time_weekend')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full sm:col-span-2">
                    <label for="need">*Exige carência?</label>
                    <Select wire:model="need" required
                        class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </Select>
                    @error('need')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-full " wire:ignore>
                    <label for="obs">Descrição</label>
                    <textarea id="obs" class="w-full" wire:model="obs">
                            {{ old('obs', $obs ?? '') }}
                        </textarea>
                </div>

        </form>
        <div class="flex col-span-full items-center space-x-4 mt-10 justify-end">
            <button class="btn btn-success">Salvar</button>
        </div>
        </fieldset>

    </section>
</div>
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        // JAVASCRIPT
        $('#obs').summernote({
            tabsize: 2,
            height: 200,
            toolbar: [
                // ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('obs', contents);
                }
            }
        });
    </script>
@endsection
