<div>

    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki sm:text-3xl dark:text-gray-50">
                    EMAIL ANIVERSARIANTE
                </h3>
            </div>
            <div class="col-span-2 justify-items-end">

            </div>
        </div>
    </x-breadcrumb>
    <fieldset class="grid grid-cols-4 gap-4 p-6 rounded-md dark:bg-gray-900">
        <form wire:submit="#" class="grid grid-cols-8 gap-2 col-span-full ">
            <div class="col-span-full " wire:ignore>
                <label for="email_happy">Email</label>
                <textarea id="email_happy" class="w-full " wire:model="email_happy">
                        {{ old('email_happy', $email_happy ?? '') }}
                </textarea>
            </div>

        </form>
        <div class="col-span-full">
            <div class="flex w-full items-center space-x-4 mt-0 justify-end">
                <button class="btn btn-neutral" wire:click="update">Salvar</button>
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

            $('#email_happy').summernote({
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
                        @this.set('email_happy', contents);
                    }
                }
            });
        </script>
    @endsection
</div>
