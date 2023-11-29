<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $breadcrumb_title }}
                </h3>
            </div>

            <div class="col-span-2 flex justify-end">
                <div class="tooltip tooltip-top p-0" data-tip="Indisponibilidades">
                    <a href="{{ route('ambience-unavailabilities') }}"
                    class="py-2 px-3 flex
                    hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                    duration-200 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " viewBox="0 0 120 120" enable-background="new 0 0 120 120" xml:space="preserve">
                            <g>
                                <path fill="currentColor" d="M60.005,23.299c9.799,0,19.014,3.817,25.946,10.75C92.884,40.98,96.701,50.197,96.701,60c0,9.803-3.817,19.02-10.75,25.952
                                    C79.02,92.884,69.803,96.701,60,96.701c-9.803,0-19.02-3.817-25.952-10.75C27.116,79.02,23.299,69.804,23.299,60
                                    c0-9.804,3.817-19.02,10.75-25.952c6.931-6.931,16.148-10.749,25.955-10.75H60.005 M60,3.299
                                    C45.491,3.3,30.977,8.836,19.906,19.906c-22.144,22.144-22.143,58.045,0,80.188C30.978,111.166,45.489,116.701,60,116.701
                                    s29.021-5.535,40.094-16.607c22.144-22.144,22.144-58.044,0-80.188C89.021,8.833,74.513,3.297,60,3.299L60,3.299z"/>
                            </g>
                            <rect x="49.307" y="11.443" fill="currentColor" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -24.7729 59.8067)" width="20.999" height="96.728"/>
                            </svg>
                    </a>
                </div>
                <div class="tooltip tooltip-top p-0" data-tip="Valores">
                    <a href="{{ route('ambience-values', $id) }}"
                        class="py-2 px-3 flex
                                                                hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                                                                duration-200 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" fill="currentColor"
                                d="M4.5 0h11A1.5 1.5 0 0117 1.5v18.223a.2.2 0 01-.335.148l-1.662-1.513a.5.5 0 00-.673 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.674 0l-1.66 1.51a.5.5 0 01-.673 0l-1.66-1.51a.5.5 0 00-.673 0L3.335 19.87A.2.2 0 013 19.723V1.5A1.5 1.5 0 014.5 0zm4.207 11.293c.667.667 1.29.706 1.316.707.528 0 .977-.448.977-1 0-.646-.128-.751-1.243-1.03h-.001C8.725 9.712 7 9.28 7 7a2.993 2.993 0 012-2.815V4a1 1 0 012 0v.2c.645.23 1.228.604 1.707 1.093a1 1 0 01-1.414 1.414c-.667-.667-1.291-.706-1.317-.707C9.448 6 9 6.448 9 7c0 .646.127.751 1.242 1.03h.002C11.274 8.288 13 8.72 13 11a2.995 2.995 0 01-2 2.815V14a1 1 0 01-2 0v-.2a4.49 4.49 0 01-1.707-1.093 1 1 0 111.414-1.414z" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </x-breadcrumb>
    <section class="px-4 dark:bg-gray-800 dark:text-gray-50 container flex flex-col mx-auto space-y-12">
        <form wire:submit="save">
            <fieldset class="grid grid-cols-12 gap-2 py-6 rounded-md dark:bg-gray-900">
                <div class="col-span-full " wire:ignore>
                    <label for="contract">Contrato</label>
                    <textarea id="contract" class="w-full " wire:model="contract">
                            {{ old('contract', $contract ?? '') }}
                        </textarea>
                </div>
                <div class="col-span-full " wire:ignore>
                    <label for="term">Termo de vistoria</label>
                    <textarea id="term" class="w-full " wire:model="term">
                            {{ old('term', $term ?? '') }}
                        </textarea>
                </div>
        </form>
        <div class="flex col-span-full items-center space-x-4 mt-10 justify-end">
            <button class="btn btn-neutral">Salvar</button>
            <button class="btn btn-success" wire:click="save_out">Salvar e sair</button>
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

        $('#term').summernote({
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
                    @this.set('term', contents);
                }
            }
        });
        $('#contract').summernote({
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
                    @this.set('contract', contents);
                }
            }
        });
    </script>
@endsection
