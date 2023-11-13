
<div >
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki sm:text-3xl dark:text-gray-50">
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
                <div class="tooltip tooltip-top p-0" data-tip="Termo / contrato">
                    <a href="{{ route('ambience-contracts', $ambience_id) }}"
                        class="py-2 px-3 flex
                                                                hover:text-white dark:hover:bg-blue-500 transition-colors hover:hover:bg-blue-500
                                                                duration-200 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.5189 16.5013C16.6939 16.3648 16.8526 16.2061 17.1701 15.8886L21.1275 11.9312C21.2231 11.8356 21.1793 11.6708 21.0515 11.6264C20.5844 11.4644 19.9767 11.1601 19.4083 10.5917C18.8399 10.0233 18.5356 9.41561 18.3736 8.94849C18.3292 8.82066 18.1644 8.77687 18.0688 8.87254L14.1114 12.8299C13.7939 13.1474 13.6352 13.3061 13.4987 13.4811C13.3377 13.6876 13.1996 13.9109 13.087 14.1473C12.9915 14.3476 12.9205 14.5606 12.7786 14.9865L12.5951 15.5368L12.3034 16.4118L12.0299 17.2323C11.9601 17.4419 12.0146 17.6729 12.1708 17.8292C12.3271 17.9854 12.5581 18.0399 12.7677 17.9701L13.5882 17.6966L14.4632 17.4049L15.0135 17.2214L15.0136 17.2214C15.4394 17.0795 15.6524 17.0085 15.8527 16.913C16.0891 16.8004 16.3124 16.6623 16.5189 16.5013Z"
                                fill="currentColor" />
                            <path
                                d="M22.3665 10.6922C23.2112 9.84754 23.2112 8.47812 22.3665 7.63348C21.5219 6.78884 20.1525 6.78884 19.3078 7.63348L19.1806 7.76071C19.0578 7.88348 19.0022 8.05496 19.0329 8.22586C19.0522 8.33336 19.0879 8.49053 19.153 8.67807C19.2831 9.05314 19.5288 9.54549 19.9917 10.0083C20.4545 10.4712 20.9469 10.7169 21.3219 10.847C21.5095 10.9121 21.6666 10.9478 21.7741 10.9671C21.945 10.9978 22.1165 10.9422 22.2393 10.8194L22.3665 10.6922Z"
                                fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.17157 3.17157C3 4.34315 3 6.22876 3 10V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C20.9812 19.6756 20.9997 17.8316 21 14.1801L18.1817 16.9984C17.9119 17.2683 17.691 17.4894 17.4415 17.6841C17.1491 17.9121 16.8328 18.1076 16.4981 18.2671C16.2124 18.4032 15.9159 18.502 15.5538 18.6225L13.2421 19.3931C12.4935 19.6426 11.6682 19.4478 11.1102 18.8898C10.5523 18.3318 10.3574 17.5065 10.607 16.7579L10.8805 15.9375L11.3556 14.5121L11.3775 14.4463C11.4981 14.0842 11.5968 13.7876 11.7329 13.5019C11.8924 13.1672 12.0879 12.8509 12.316 12.5586C12.5106 12.309 12.7317 12.0881 13.0017 11.8183L17.0081 7.81188L18.12 6.70004L18.2472 6.57282C18.9626 5.85741 19.9003 5.49981 20.838 5.5C20.6867 4.46945 20.3941 3.73727 19.8284 3.17157C18.6569 2 16.7712 2 13 2H11C7.22876 2 5.34315 2 4.17157 3.17157ZM7.25 9C7.25 8.58579 7.58579 8.25 8 8.25H14.5C14.9142 8.25 15.25 8.58579 15.25 9C15.25 9.41421 14.9142 9.75 14.5 9.75H8C7.58579 9.75 7.25 9.41421 7.25 9ZM7.25 13C7.25 12.5858 7.58579 12.25 8 12.25H10.5C10.9142 12.25 11.25 12.5858 11.25 13C11.25 13.4142 10.9142 13.75 10.5 13.75H8C7.58579 13.75 7.25 13.4142 7.25 13ZM7.25 17C7.25 16.5858 7.58579 16.25 8 16.25H9.5C9.91421 16.25 10.25 16.5858 10.25 17C10.25 17.4142 9.91421 17.75 9.5 17.75H8C7.58579 17.75 7.25 17.4142 7.25 17Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </x-breadcrumb>
    <section class="px-4 dark:bg-gray-800 dark:text-gray-50 container flex flex-col mx-auto space-y-12">
            <fieldset class="grid grid-cols-12 gap-2 py-6 rounded-md dark:bg-gray-900">
                <div class="overflow-x-auto col-span-full rounded-md">
                    <div class="grid grid-cols-12 gap-4 px-5 py-4 bg-gray-800 text-lg text-white ">
                        <div class="col-span-7">Tipo de locatário</div>
                        <div class="col-span-2 text-center justify-items-center">
                            Valor da locação
                        </div>
                        <div class="col-span-2 text-center justify-items-center">
                            Caução
                        </div>
                        <div class="col-span-1">

                        </div>
                    </div>
                    @php $z=0;@endphp
                    @foreach ($tenants as $item)
                    @php $z+=1;@endphp
                        {{-- @livewire('admin.ambiences.ambience-pivots-list', ['ambienceTenant' => $item,'ambience'=>$ambience_id], key($item->id)) --}}
                        <div class="grid grid-cols-12 gap-4 px-5 py-2 items-center {{ ($z%2 == 0? 'bg-gray-100':'') }} text-gray-800 text-md border-b">
                            <div class="col-span-7 border-r">{{ $item->title }}</div>
                            <div class="col-span-2 text-center justify-items-center">
                                @if (in_array($item->id,$this->pivots))
                                    @foreach ($this->ambiencePivot->where('ambienceTenant_id',$item->id)->take(1) as $v)
                                        {{ $v['value'] }}
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-span-2 text-center justify-items-center border-l">
                                @if (in_array($item->id,$this->pivots))
                                    @foreach ($this->ambiencePivot->where('ambienceTenant_id',$item->id)->take(1) as $v)
                                        {{ $v['deposit'] }}
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-span-1">
                                @if (in_array($item->id,$this->pivots))
                                    @foreach ($this->ambiencePivot->where('ambienceTenant_id',$item->id)->take(1) as $v)
                                    <button class="btn btn-success" wire:click="showModalUpdate({{ $v['ambienceTenant_id'] }},{{$v['id'] }})">
                                        <svg class="w-6 h-6" viewBox="0 0 32 32">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                                sketch:type="MSPage">
                                                <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                                    transform="translate(-154.000000, -517.000000)" fill="#000000">
                                                    <path
                                                        d="M172,522 C172,521.447 172.448,521 173,521 C173.552,521 174,521.447 174,522 L174,526 C174,526.553 173.552,527 173,527 C172.448,527 172,526.553 172,526 L172,522 L172,522 Z M163,529 L177,529 C177.552,529 178,528.553 178,528 L178,517 L162,517 L162,528 C162,528.553 162.448,529 163,529 L163,529 Z M182,517 L180,517 L180,529 C180,530.104 179.104,531 178,531 L162,531 C160.896,531 160,530.104 160,529 L160,517 L158,517 C155.791,517 154,518.791 154,521 L154,545 C154,547.209 155.791,549 158,549 L182,549 C184.209,549 186,547.209 186,545 L186,521 C186,518.791 184.209,517 182,517 L182,517 Z"
                                                        id="save-floppy" sketch:type="MSShapeGroup">

                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                    @endforeach
                                @else
                                <div class="tooltip tooltip-top p-0" data-tip="Editar">
                                    <button class="btn btn-success" wire:click="showModalUpdate({{ $item->id }})">
                                        <svg class="w-6 h-6" viewBox="0 0 32 32">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                                sketch:type="MSPage">
                                                <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                                    transform="translate(-154.000000, -517.000000)" fill="#000000">
                                                    <path
                                                        d="M172,522 C172,521.447 172.448,521 173,521 C173.552,521 174,521.447 174,522 L174,526 C174,526.553 173.552,527 173,527 C172.448,527 172,526.553 172,526 L172,522 L172,522 Z M163,529 L177,529 C177.552,529 178,528.553 178,528 L178,517 L162,517 L162,528 C162,528.553 162.448,529 163,529 L163,529 Z M182,517 L180,517 L180,529 C180,530.104 179.104,531 178,531 L162,531 C160.896,531 160,530.104 160,529 L160,517 L158,517 C155.791,517 154,518.791 154,521 L154,545 C154,547.209 155.791,549 158,549 L182,549 C184.209,549 186,547.209 186,545 L186,521 C186,518.791 184.209,517 182,517 L182,517 Z"
                                                        id="save-floppy" sketch:type="MSShapeGroup">

                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>

                                @endif

                            </div>
                        </div>
                        @endforeach
                    <div class="grid grid-cols-12 gap-4 px-5 py-2 bg-gray-700 text-md text-white ">
                        <div class="col-span-7">Tipo de locatário</div>
                        <div class="col-span-2 text-center justify-items-center">
                            Valor da locação
                        </div>
                        <div class="col-span-2 text-center justify-items-center">
                            Caução
                        </div>
                        <div class="col-span-1">
                        </div>
                    </div>
                </div>
        </fieldset>

    </section>
    {{-- MODAL UPDATE --}}
    <x-dialog-modal wire:model="showModalEdit">
        <x-slot name="title">Editar</x-slot>
        <x-slot name="content">
            <form wire:submit="update">
                <div class="grid gap-4 mb-1 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="col-span-2 ">
                        <label for="value" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Valor</label>
                        <div class="flex">
                            <input x-mask:dynamic="$money($input, ',')" wire:model="value" type="text" maxlength="8"
                            placeholder="0,00"
                            class="bg-gray-50 border border-gray-300 text-gray-900
                        text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600
                        block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                        dark:focus:border-primary-500">
                        </div>

                    </div>
                    <div class="col-span-2 ">
                        <label for="deposit" class="block text-sm font-medium text-gray-900 dark:text-white">
                            Caução</label>
                        <div class="flex">
                            <input x-mask:dynamic="$money($input, ',')" wire:model="deposit" type="text" maxlength="8"
                            placeholder="0,00"
                            class="bg-gray-50 border border-gray-300 text-gray-900
                        text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600
                        block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500
                        dark:focus:border-primary-500">
                        </div>

                    </div>

                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="update"
                class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                Atualizar
            </button>
            <x-secondary-button wire:click="$toggle('showModalEdit')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>

