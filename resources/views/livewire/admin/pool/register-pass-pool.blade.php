<div class="artboard artboard-demo  w-full bg-white ">
    @if ($status == '')
        <div class="shadow h-screen w-full text-center py-6">
            <div class="stat-title flex justify-center p-0">
                <img class="w-20 h-20 py-0 my-0" src="{{ url('storage/logos/assgapa.png') }}">
            </div>
            <div class="stat-value py-0">
                <h5 class="text-md font-bold ">{{ $config->acronym }}</h5>
            </div>
            <div class="stat ">
                <div class="max-w-xs px-6 rounded-lg">
                    <svg class="object-cover object-center w-full rounded-md h-72 dark:bg-gray-500" fill="#000000"
                        version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100"
                        enable-background="new 0 0 100 100" xml:space="preserve">
                        <path d="M38.7,11.7c0.9-0.9,0.9-2.4,0-3.3c-0.9-0.9-2.4-0.9-3.3,0l-3.6,3.6l3.3,3.3L38.7,11.7z M25.3,4c0-1.3-1-2.3-2.3-2.3
                        s-2.3,1-2.3,2.3v5.1h4.7V4z M23,34.3c6.3,0,11.5-5.1,11.5-11.5c0-6.3-5.1-11.5-11.5-11.5s-11.5,5.1-11.5,11.5
                        C11.5,29.2,16.6,34.3,23,34.3z M36.6,25.2h5.1c1.3,0,2.3-1,2.3-2.3v0c0-1.3-1-2.3-2.3-2.3h-5.1V25.2z M31.8,33.6l3.6,3.6
                        c0.9,0.9,2.4,0.9,3.3,0c0.9-0.9,0.9-2.4,0-3.3l-3.6-3.6L31.8,33.6z M10.8,15.4l3.3-3.3l-3.6-3.6c-0.9-0.9-2.4-0.9-3.3,0
                        s-0.9,2.4,0,3.3L10.8,15.4z M20.6,41.7c0,1.3,1,2.3,2.3,2.3s2.3-1,2.3-2.3v-5.1h-4.7V41.7z M4.1,25.2h5.1v-4.7H4.1
                        c-1.3,0-2.3,1-2.3,2.3v0C1.8,24.1,2.8,25.2,4.1,25.2z M7.2,33.9c-0.9,0.9-0.9,2.4,0,3.3s2.4,0.9,3.3,0l3.6-3.6l-3.3-3.3L7.2,33.9z
                        M77.9,47.8c-9.3,0-9.3,8-18.6,8c-9.3,0-9.3-8-18.6-8c-9.3,0-9.3,8-18.6,8c-9.3,0-11-8-20.3-8v44.4c0,3.4,2.7,6.1,6.1,6.1h84.2
                        c3.4,0,6.1-2.7,6.1-6.1V55.8C88.9,55.8,87.2,47.8,77.9,47.8z M38.4,69.2l-1.7,4.3l-0.7-0.3l-5.6-5.6L38.4,69.2z M12.7,68.4l-1.4,1.4
                        c-1,1-2.6,1-3.7,0L7,69.2l4.3-4.3c0.5-0.5,1.3-0.8,2.1-0.6l8,1.6l-4.2,0.4v2.3c0,0.3,0,0.6,0.1,0.9L12.7,68.4z M88.7,70.5
                        c0-3.6-4.6-6.6-10-6.6c-3.9,0-7.4,1.6-9,3.8h12.4c2.1,0,3.9,1.7,3.8,3.8c0,0,0,0.1,0,0.1c-0.2,3.2-2.7,5.9-5.9,6.2
                        c-3.1,0.3-5.9-1.6-6.8-4.4H73c-2.3,0-3.4,0.4-4.1,1.2c-0.2,0.4-0.3,0.7-0.6,1c0,0,0,0,0,0.1c-2.2,3.6-7.1,6.1-12.7,6.1
                        c-2.2,0-6.8-0.8-9.2-2.4l2.9-2.9c1.2,0.5,4,1.3,6.2,1.3c2,0,3.9-0.4,5.4-1.1c-0.3-0.3-0.5-0.6-0.7-0.9l0,0l-12.1-0.7l-0.5,0.4
                        l-7.8,7.8c-1,1-2.6,1-3.6,0L24.9,71.1h-3.2c-1.4,0-2.6-1.2-2.6-2.6v-0.9h7.4v0c0,0,0.1,0,0.1,0c0.7,0,1.3,0.3,1.8,0.7l6.3,6.4
                        l2.6,2.6l1.1-2.9l0,0l1.4-3.7c0-0.1,0.1-0.2,0.1-0.2l0.3-0.8c1.3-3.2,4.8-4.7,8-3.6c2.4,0.8,5.4,1.5,9.1,1.5h7.8
                        c1.6-4.5,7.1-7.8,13.5-7.8c7.7,0,14,4.8,14,10.6H88.7z" />
                    </svg>
                </div>
                <div class="mt-4 mb-2">
                    <div class="mt-4 ">
                        <p class="flex items-center text-md p-1">
                            <span class="font-bold px-2">{{ $pass->title }}</span>
                        </p>
                        @if (date('Y-m-d') <= $validity_of_card)
                            <p
                                class="flex items-center text-md {{ date('Y-m-d') > $validity_of_card ? 'bg-red-500 text-white py-2 px-1 rounded-md' : ' p-1' }}">
                                Cliente autorizado:
                                <span class="font-bold px-2">{{ $pass->partner }}</span>
                            </p>
                            @if ($pass->indication_id)
                            <p
                                class="flex items-center text-md {{ date('Y-m-d') > $validity_of_card ? 'bg-red-500 text-white py-2 px-1 rounded-md' : ' p-1' }}">
                                Indicado por:
                                <span class="font-bold px-2">{{ $pass->partners->name }}</span>
                            </p>
                            @endif
                        @endif

                        <p
                            class="flex items-center text-md {{ date('Y-m-d') > $validity_of_card ? 'bg-red-500 text-white py-2 px-1 rounded-md' : ' p-1' }}">
                            Validade piscina:
                            <span class="font-bold px-2">{{ $pass->validity_of_card }}</span>
                        </p>
                    </div>
                </div>
                <div class="mt-4 mb-2">
                    @if (date('Y-m-d') > $validity_of_card)
                        <div class="bg-red-500 text-white py-2 px-1 rounded-md">
                            <div class="text-center">
                                <label for="obs">Observação</label>
                                <h2>Passar na secretaria!</h2>
                            </div>
                        </div>
                    @else
                        <div wire:click="registerAccessPool()"
                            class="inline-flex items-center divide-x rounded bg-blue-500 text-white divide-gray-300">
                            <button type="button" class="px-8 py-3">Registrar</button>
                            <button type="button" title="Toggle dropdown" class="p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M99.73 57L25 131.7V487h110V188.3l80-80V57H99.73zM80 103h80v18H80v-18zm138 27.7L154.7 194c6.4 3.2 13.6 5 21.3 5 26.1 0 47-20.9 47-47 0-7.7-1.8-14.9-5-21.3zm22.7 15.3c.2 2 .3 4 .3 6 0 8.5-1.7 16.6-4.6 24H473c5.8 0 8.9-1.8 11.3-4.5 2.3-2.6 3.7-6.5 3.7-10.5s-1.4-7.9-3.7-10.5c-2.4-2.7-5.5-4.5-11.3-4.5H240.7zm-15.2 48c-4 4.8-8.7 8.9-13.9 12.3l216.8 117.9c5 2.7 8.7 2.6 12 1.4 3.4-1.2 6.5-4 8.4-7.5 1.9-3.5 2.5-7.5 1.7-11-.8-3.4-2.7-6.5-7.7-9.3L251.7 194h-26.2zm-35 21.3c-4.2 1-8.5 1.6-12.9 1.7l86.7 211.6c2.2 5.3 5.1 7.5 8.5 8.7 3.3 1.1 7.5.9 11.2-.6 3.7-1.5 6.7-4.2 8.3-7.4 1.5-3.2 2-6.8-.1-12.1l-77.4-188.6-24.3-13.3z" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    @else
        @if ($status == 'success')
            <div class="shadow h-screen w-full text-center py-6">
                <div class="stat-title flex justify-center p-0">
                    <img class="w-20 h-20 py-0 my-0" src="{{ url('storage/logos/assgapa.png') }}">
                </div>
                <div class="stat-value py-0">
                    <h5 class="text-md font-bold ">{{ $config->acronym }}</h5>
                </div>
                <div class="stat ">
                    <div class="max-w-xs px-6 rounded-lg">
                        <svg class="object-cover object-center w-full rounded-md h-72 text-green-500"
                            fill="currentColor" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>success</title>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="add-copy" fill="currentColor" transform="translate(42.666667, 42.666667)">
                                    <path
                                        d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51296 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.153707,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51296 331.153707,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.43872,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.438933,384 213.333333,384 Z M293.669333,137.114453 L323.835947,167.281067 L192,299.66912 L112.916693,220.585813 L143.083307,190.4192 L192,239.335893 L293.669333,137.114453 Z"
                                        id="Shape">

                                    </path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="mt-4 mb-2">
                        <h1 class="text-4xl font-bold">Registrado com sucesso</h1>

                    </div>

                </div>
            </div>
        @else
            <div class="shadow h-screen w-full text-center py-6">
                <div class="stat-title flex justify-center p-0">
                    <img class="w-20 h-20 py-0 my-0" src="{{ url('storage/logos/assgapa.png') }}">
                </div>
                <div class="stat-value py-0">
                    <h5 class="text-md font-bold ">{{ $config->acronym }}</h5>
                </div>
                <div class="stat ">
                    <div class="max-w-xs px-6 rounded-lg">
                        <svg class="object-cover object-center w-full rounded-md h-72 text-red-500" fill="currentColor"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>alarm</title>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="add" fill="currentColor" transform="translate(42.666667, 42.666667)">
                                    <path
                                        d="M213.333333,3.55271368e-14 C330.943502,3.55271368e-14 426.666667,95.7231591 426.666667,213.333333 C426.666667,330.943502 330.943502,426.666667 213.333333,426.666667 C95.7231591,426.666667 3.55271368e-14,330.943502 3.55271368e-14,213.333333 C3.55271368e-14,95.7231591 95.7231591,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C118.87459,42.6666667 42.6666667,118.87459 42.6666667,213.333333 C42.6666667,307.792077 118.87459,384 213.333333,384 C307.792077,384 384,307.792077 384,213.333333 C384,118.87459 307.792077,42.6666667 213.333333,42.6666667 Z M213.333333,272.042667 C228.571429,272.042667 240,283.306667 240,298.666667 C240,314.026667 228.571429,325.290667 213.333333,325.290667 C197.748918,325.290667 186.666667,314.026667 186.666667,298.325333 C186.666667,283.306667 198.095238,272.042667 213.333333,272.042667 Z M234.666667,85.3333333 L234.666667,234.666667 L192,234.666667 L192,85.3333333 L234.666667,85.3333333 Z"
                                        id="Combined-Shape">

                                    </path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="mt-4 mb-2">
                        <h1 class="text-4xl font-bold">Algo deu errado, informe a secretaria.</h1>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
