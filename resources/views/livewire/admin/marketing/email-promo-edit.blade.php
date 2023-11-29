<div>

    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    EMAIL PROMOCIONAL
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">

            </div>
        </div>
    </x-breadcrumb>
    <fieldset class="grid grid-cols-4 gap-4 p-6 rounded-md dark:bg-gray-900">
        <form wire:submit="#" class="grid grid-cols-8 gap-2 col-span-full ">
            <div class="col-span-full ">
                <label for="title">*Título</label>
                <input class="w-full rounded-md focus:ring focus:ri focus:ri dark:border-gray-700 dark:text-gray-900"
                    placeholder="Título " wire:model="title" required maxlength="100">
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-full " wire:ignore>
                <label for="text">Email</label>
                <textarea id="text" class="w-full " wire:model="text">
                        {{ old('text', $text ?? '') }}
                </textarea>
            </div>
        </form>
        <div class="col-span-full">
            <div class="flex w-full items-center space-x-4 mt-0 justify-end">
                <button class="btn btn-neutral" wire:click="save">Salvar</button>
                <button class="btn btn-success" wire:click="save_out">Salvar e sair</button>
            </div>
        </div>
    </fieldset>
    </section>
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

            $('#text').summernote({
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
                        @this.set('text', contents);
                    }
                }
            });
        </script>
    @endsection
</div>
