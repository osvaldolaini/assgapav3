<div>
    <div>

        <div class="tooltip tooltip-top" data-tip="Minhas indicações">
            <button wire:click='modalRegister()'
                class="flex px-3 py-2 transition-colors duration-200 btn btn-outline btn-success">
                Minhas indicações <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-1" fill="currentColor"
                    viewBox="0 0 24 24" xml:space="preserve">
                    <g id="article">
                        <g>
                            <path
                                d="M20.5,22H4c-0.2,0-0.3,0-0.5,0C1.6,22,0,20.4,0,18.5V6h5V2h19v16.5C24,20.4,22.4,22,20.5,22z M6.7,20h13.8
                                c0.8,0,1.5-0.7,1.5-1.5V4H7v14.5C7,19,6.9,19.5,6.7,20z M2,8v10.5C2,19.3,2.7,20,3.5,20S5,19.3,5,18.5V8H2z" />
                        </g>
                        <g>
                            <rect x="15" y="6" width="5" height="6" />
                        </g>
                        <g>
                            <rect x="9" y="6" width="4" height="2" />
                        </g>
                        <g>
                            <rect x="9" y="10" width="4" height="2" />
                        </g>
                        <g>
                            <rect x="9" y="14" width="11" height="2" />
                        </g>
                    </g>
                </svg>
            </button>

        </div>
        {{-- MODAL CREATE --}}
        <x-dialog-modal wire:model="showModalCreate">
            <x-slot name="title">Minhas indicações</x-slot>
            <x-slot name="content">
                @isset($indications)
                    <div class="overflow-x-auto">
                        <table class="table">
                            <tbody>
                                @if ($indications)
                                    @foreach ($indications as $item)
                                        <tr class="hover:bg-gray-200">
                                            <td>
                                                <div class="flex items-center gap-3 ">
                                                    <div class="avatar">
                                                        <div class="w-12 h-12 mask mask-squircle">
                                                            @if ($item->imageTitle)
                                                                <picture>
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $item->imageTitle . '.jpg') }}" />
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $item->imageTitle . '.webp') }}" />
                                                                    <source
                                                                        srcset="{{ url('storage/partners/' . $item->imageTitle . '.png') }}" />
                                                                    <img src="{{ url('storage/partners/' . $item->imageTitle . '.jpg') }}"
                                                                        alt="{{ $item->name }}">
                                                                </picture>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold">{{ $item->name }} -
                                                            {{ $item->partner_category_master }}</div>
                                                        <div class="text-sm opacity-50">{{ $item->cpf }} </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                @endisset
            </x-slot>
            <x-slot name="footer">

                <x-secondary-button wire:click="$toggle('showModalCreate')" class="mx-2">
                    Fechar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>


    </div>

</div>
