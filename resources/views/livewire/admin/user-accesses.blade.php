<div>
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki  dark:text-gray-50">
                    {{ $this->breadcrumb_title }}
                </h3>
            </div>
        </div>
    </x-breadcrumb>
    <div>
        <section class="p-6 dark:bg-gray-800 dark:text-gray-50">
            <fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md dark:bg-gray-900">
                <div class="space-y-2 col-span-full lg:col-span-1">
                    <p class="font-medium">Acessos do usuário</p>
                    <p class="text-xs">Informe aqui quais as abas o usuário irá acessar.</p>
                </div>
                <div class="col-span-full lg:col-span-3">
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">ACESSOS</h3>
                    <ul
                        class=" items-center w-full text-sm
                        font-medium text-gray-900 bg-white border border-gray-200 rounded-lg
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        grid grid-cols-3 gap-4 ">
                        <x-link-checkbox-new :access="$access" page="2" title="Lista de usuários">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </x-link-checkbox-new>
                        <x-link-checkbox-new :access="$access" page="10" title="Agenda">
                            <svg class="w-6 h-6" viewBox="0 0 512 512" xml:space="preserve">
                                <g>
                                    <rect x="119.256" y="222.607" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="341.863" y="222.607" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="267.662" y="222.607" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="119.256" y="302.11" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="267.662" y="302.11" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="193.46" y="302.11" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="341.863" y="381.612" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="267.662" y="381.612" fill="currentColor" width="50.881" height="50.885" />
                                    <rect x="193.46" y="381.612" fill="currentColor" width="50.881" height="50.885" />
                                    <path fill="currentColor" d="M439.277,55.046h-41.376v39.67c0,14.802-12.195,26.84-27.183,26.84h-54.025
                                        c-14.988,0-27.182-12.038-27.182-26.84v-39.67h-67.094v39.297c0,15.008-12.329,27.213-27.484,27.213h-53.424
                                        c-15.155,0-27.484-12.205-27.484-27.213V55.046H72.649c-26.906,0-48.796,21.692-48.796,48.354v360.246
                                        c0,26.661,21.89,48.354,48.796,48.354h366.628c26.947,0,48.87-21.692,48.87-48.354V103.4
                                        C488.147,76.739,466.224,55.046,439.277,55.046z M453.167,462.707c0,8.56-5.751,14.309-14.311,14.309H73.144
                                        c-8.56,0-14.311-5.749-14.311-14.309V178.089h394.334V462.707z" />
                                    <path fill="currentColor"
                                        d="M141.525,102.507h53.392c4.521,0,8.199-3.653,8.199-8.144v-73.87c0-11.3-9.27-20.493-20.666-20.493h-28.459
                                        c-11.395,0-20.668,9.192-20.668,20.493v73.87C133.324,98.854,137.002,102.507,141.525,102.507z" />
                                    <path fill="currentColor"
                                        d="M316.693,102.507h54.025c4.348,0,7.884-3.513,7.884-7.826V20.178C378.602,9.053,369.474,0,358.251,0H329.16
                                        c-11.221,0-20.349,9.053-20.349,20.178v74.503C308.81,98.994,312.347,102.507,316.693,102.507z" />
                                </g>
                            </svg>
                        </x-link-checkbox-new>
                        <x-link-checkbox-new :access="$access" page="7" title="Locações">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 20H6C3.79086 20 2 18.2091 2 16V7C2 4.79086 3.79086 3 6 3H17C19.2091 3 21 4.79086 21 7V10"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8 2V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15 2V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M2 8H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M18.5 15.6429L17 17.1429" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="17" cy="17" r="5" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </x-link-checkbox-new>
                    </ul>
                    <ul
                        class="col-span-full lg:col-span-3 items-center w-full text-sm
                        font-medium text-gray-900 bg-white border border-gray-200 rounded-lg
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        grid grid-cols-3 gap-4 ">

                        <x-link-checkbox-new :access="$access" page="9" title="Piscinas">
                            <svg class="w-6 h-6" viewBox="0 0 15 15" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.63639 1C4.14922 1 3 2.20269 3 3.72724V4H9V3.63639C9 1.56904 10.6333 0 12.6818 0V1C11.1667 1 10 2.14011 10 3.63639V10H9V9H3V12H2V3.72724C2 1.68816 3.55993 0 5.63639 0V1ZM3 8H9V5H3V8Z"
                                    fill="currentColor" />
                                <path
                                    d="M7.43931 13.4416C6.54499 13.9461 5.56317 14.5 3.95454 14.5C2.47163 14.5 1.34063 13.7381 0.625824 12.9317L1.37417 12.2683C1.95937 12.9286 2.83745 13.5 3.95454 13.5C5.29393 13.5 6.0834 13.0584 6.95888 12.5645L6.96977 12.5584C7.8641 12.0539 8.84591 11.5 10.4545 11.5C11.9851 11.5 13.3377 12.3202 14.3064 13.0716L13.6936 13.8618C12.7714 13.1465 11.6421 12.5 10.4545 12.5C9.11516 12.5 8.32568 12.9416 7.4502 13.4355L7.43931 13.4416Z"
                                    fill="currentColor" />
                            </svg>
                        </x-link-checkbox-new>
                        <x-link-checkbox-new :access="$access" page="8" title="Financeiro">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 1920 1920"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M480 106.667c-117.82 0-213.333 95.512-213.333 213.333v1280c0 117.82 95.512 213.333 213.333 213.333h960c117.82 0 213.333-95.512 213.333-213.333V320c0-117.82-95.512-213.333-213.333-213.333H480ZM480 0h960c176.731 0 320 143.269 320 320v1280c0 176.731-143.269 320-320 320H480c-176.731 0-320-143.269-320-320V320C160 143.269 303.269 0 480 0Zm106.667 320C527.757 320 480 367.756 480 426.667v106.666C480 592.243 527.756 640 586.667 640h746.666c58.91 0 106.667-47.756 106.667-106.667V426.667c0-58.91-47.756-106.667-106.667-106.667H586.667Zm0-106.667h746.666c117.821 0 213.334 95.513 213.334 213.334v106.666c0 117.821-95.513 213.334-213.334 213.334H586.667c-117.821 0-213.334-95.513-213.334-213.334V426.667c0-117.821 95.513-213.334 213.334-213.334ZM480 853.333h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666C1072.243 853.333 1120 901.09 1120 960c0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1066.667 800 1018.91 800 960c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Zm-853.333 320h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1386.667 800 1338.91 800 1280c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Zm-853.333 320h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1706.667 800 1658.91 800 1600c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Z" />
                            </svg>
                        </x-link-checkbox-new>
                        <x-link-checkbox-new :access="$access" page="3" title="Cadastros">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xml:space="preserve">
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
                        </x-link-checkbox-new>
                    </ul>
                    <ul
                        class="col-span-full lg:col-span-3 items-center w-full text-sm
                        font-medium text-gray-900 bg-white border border-gray-200 rounded-lg
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        grid grid-cols-3 gap-4 ">
                        <x-link-checkbox-new :access="$access" page="4" title="Ambientes">
                            <svg class="h-6 w-6 " fill="none" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 14.0014H17M7 14.0014V11.6014C7 11.0413 7 10.7613 7.10899 10.5474C7.20487 10.3592 7.35785 10.2062 7.54601 10.1104C7.75992 10.0014 8.03995 10.0014 8.6 10.0014H15.4C15.9601 10.0014 16.2401 10.0014 16.454 10.1104C16.6422 10.2062 16.7951 10.3592 16.891 10.5474C17 10.7613 17 11.0413 17 11.6014V14.0014M7 14.0014V18.0014V21.0014M17 14.0014V18.0014V21.0014M18.3466 6.17468L14.1466 4.07468C13.3595 3.68113 12.966 3.48436 12.5532 3.40691C12.1876 3.33832 11.8124 3.33832 11.4468 3.40691C11.034 3.48436 10.6405 3.68113 9.85338 4.07468L5.65337 6.17468C4.69019 6.65627 4.2086 6.89707 3.85675 7.25631C3.5456 7.574 3.30896 7.95688 3.16396 8.37725C3 8.85262 3 9.39106 3 10.4679V19.4014C3 19.9614 3 20.2414 3.10899 20.4554C3.20487 20.6435 3.35785 20.7965 3.54601 20.8924C3.75992 21.0014 4.03995 21.0014 4.6 21.0014H19.4C19.9601 21.0014 20.2401 21.0014 20.454 20.8924C20.6422 20.7965 20.7951 20.6435 20.891 20.4554C21 20.2414 21 19.9614 21 19.4014V10.4679C21 9.39106 21 8.85262 20.836 8.37725C20.691 7.95688 20.4544 7.574 20.1433 7.25631C19.7914 6.89707 19.3098 6.65627 18.3466 6.17468Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </x-link-checkbox-new>
                        <x-link-checkbox-new :access="$access" page="5" title="Estoque">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill="currentColor"
                                    d="M12 6v-6h-8v6h-4v7h16v-7h-4zM7 12h-6v-5h2v1h2v-1h2v5zM5 6v-5h2v1h2v-1h2v5h-6zM15 12h-6v-5h2v1h2v-1h2v5z">
                                </path>
                                <path fill="currentColor" d="M0 16h3v-1h10v1h3v-2h-16v2z"></path>
                            </svg>
                        </x-link-checkbox-new>
                        <x-link-checkbox-new :access="$access" page="6" title="Marketing">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.25 2.1a1.25 1.25 0 0 0-1.17-.1L6.91 4.43a1.22 1.22 0 0 1-.46.09H2.5a1.25 1.25 0 0 0-1.25 1.25v.1H0v3h1.25V9a1.25 1.25 0 0 0 1.25 1.22L4 13.4a1.26 1.26 0 0 0 1.13.72h.63A1.25 1.25 0 0 0 7 12.87v-2.53l6.08 2.43a1.27 1.27 0 0 0 .47.09 1.29 1.29 0 0 0 .7-.22 1.25 1.25 0 0 0 .55-1V3.13a1.25 1.25 0 0 0-.55-1.03zm-8.5 3.67V9H2.5V5.77zm0 7.1h-.63l-1.23-2.65h1.86zm1.62-3.72A2.29 2.29 0 0 0 7 9V5.7a2.26 2.26 0 0 0 .37-.11l6.18-2.46v8.48zm7.46-3.03v2.5a1.25 1.25 0 0 0 0-2.5z" />
                            </svg>
                        </x-link-checkbox-new>
                    </ul>
                    <ul
                        class="col-span-full lg:col-span-3 items-center w-full text-sm
                        font-medium text-gray-900 bg-white border border-gray-200 rounded-lg
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        grid grid-cols-3 gap-4 ">
                        <x-link-checkbox-new :access="$access" page="11" title="Multiplas Locações">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9 20H6C3.79086 20 2 18.2091 2 16V7C2 4.79086 3.79086 3 6 3H17C19.2091 3 21 4.79086 21 7V10"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8 2V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M15 2V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M2 8H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M18.5 15.6429L17 17.1429" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="17" cy="17" r="5" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </x-link-checkbox-new>
                        <x-link-checkbox-new :access="$access" page="1" title="Configurações">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1 3.5A1.5 1.5 0 012.5 2h15A1.5 1.5 0 0119 3.5v2A1.5 1.5 0 0117.5 7h-15A1.5 1.5 0 011 5.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 9.5A1.5 1.5 0 012.5 8h6.073a1.5 1.5 0 011.342 2.17l-1 2a1.5 1.5 0 01-1.342.83H2.5A1.5 1.5 0 011 11.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 15.5A1.5 1.5 0 012.5 14h5.27a1.5 1.5 0 011.471 1.206l.4 2A1.5 1.5 0 018.171 19H2.5A1.5 1.5 0 011 17.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM12.159 13.059l-.682-.429a.987.987 0 01-.452-.611.946.946 0 01.134-.742.983.983 0 01.639-.425 1.023 1.023 0 01.758.15l.682.427c.369-.31.8-.54 1.267-.676V9.97c0-.258.104-.504.291-.686.187-.182.44-.284.704-.284.264 0 .517.102.704.284a.957.957 0 01.291.686v.783c.472.138.903.37 1.267.676l.682-.429a1.02 1.02 0 01.735-.107c.25.058.467.208.606.419.14.21.19.465.141.71a.97.97 0 01-.403.608l-.682.429a3.296 3.296 0 010 1.882l.682.43a.987.987 0 01.452.611.946.946 0 01-.134.742.982.982 0 01-.639.425 1.02 1.02 0 01-.758-.15l-.682-.428c-.369.31-.8.54-1.267.676v.783a.957.957 0 01-.291.686A1.01 1.01 0 0115.5 19a1.01 1.01 0 01-.704-.284.957.957 0 01-.291-.686v-.783a3.503 3.503 0 01-1.267-.676l-.682.429a1.02 1.02 0 01-.75.132.999.999 0 01-.627-.421.949.949 0 01-.135-.73.97.97 0 01.434-.61l.68-.43a3.296 3.296 0 010-1.882zm3.341-.507c-.82 0-1.487.65-1.487 1.449s.667 1.448 1.487 1.448c.82 0 1.487-.65 1.487-1.448 0-.8-.667-1.45-1.487-1.45z" />
                            </svg>
                        </x-link-checkbox-new>
                    </ul>
                </div>
                <div class="space-y-2 col-span-full lg:col-span-1">

                </div>
                <div class="col-span-full lg:col-span-3">

                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">PAINEL DE CONTROLE</h3>
                    <ul
                        class="col-span-full lg:col-span-3 items-center w-full text-sm
                        font-medium text-gray-900 bg-white border border-gray-200 rounded-lg
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        grid grid-cols-4 gap-3 ">

                        <x-link-radio-new :dashboard="$user->dashboard" page="1" title="Presidência">
                            <svg class="w-6 h-6" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.918 10.0005H7.082C6.66587 9.99708 6.26541 10.1591 5.96873 10.4509C5.67204 10.7427 5.50343 11.1404 5.5 11.5565V17.4455C5.5077 18.3117 6.21584 19.0078 7.082 19.0005H9.918C10.3341 19.004 10.7346 18.842 11.0313 18.5502C11.328 18.2584 11.4966 17.8607 11.5 17.4445V11.5565C11.4966 11.1404 11.328 10.7427 11.0313 10.4509C10.7346 10.1591 10.3341 9.99708 9.918 10.0005Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.918 4.0006H7.082C6.23326 3.97706 5.52559 4.64492 5.5 5.4936V6.5076C5.52559 7.35629 6.23326 8.02415 7.082 8.0006H9.918C10.7667 8.02415 11.4744 7.35629 11.5 6.5076V5.4936C11.4744 4.64492 10.7667 3.97706 9.918 4.0006Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.082 13.0007H17.917C18.3333 13.0044 18.734 12.8425 19.0309 12.5507C19.3278 12.2588 19.4966 11.861 19.5 11.4447V5.55666C19.4966 5.14054 19.328 4.74282 19.0313 4.45101C18.7346 4.1592 18.3341 3.9972 17.918 4.00066H15.082C14.6659 3.9972 14.2654 4.1592 13.9687 4.45101C13.672 4.74282 13.5034 5.14054 13.5 5.55666V11.4447C13.5034 11.8608 13.672 12.2585 13.9687 12.5503C14.2654 12.8421 14.6659 13.0041 15.082 13.0007Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.082 19.0006H17.917C18.7661 19.0247 19.4744 18.3567 19.5 17.5076V16.4936C19.4744 15.6449 18.7667 14.9771 17.918 15.0006H15.082C14.2333 14.9771 13.5256 15.6449 13.5 16.4936V17.5066C13.525 18.3557 14.2329 19.0241 15.082 19.0006Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </x-link-radio-new>
                        <x-link-radio-new :dashboard="$user->dashboard" page="2" title="Financeiro">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 1920 1920"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M480 106.667c-117.82 0-213.333 95.512-213.333 213.333v1280c0 117.82 95.512 213.333 213.333 213.333h960c117.82 0 213.333-95.512 213.333-213.333V320c0-117.82-95.512-213.333-213.333-213.333H480ZM480 0h960c176.731 0 320 143.269 320 320v1280c0 176.731-143.269 320-320 320H480c-176.731 0-320-143.269-320-320V320C160 143.269 303.269 0 480 0Zm106.667 320C527.757 320 480 367.756 480 426.667v106.666C480 592.243 527.756 640 586.667 640h746.666c58.91 0 106.667-47.756 106.667-106.667V426.667c0-58.91-47.756-106.667-106.667-106.667H586.667Zm0-106.667h746.666c117.821 0 213.334 95.513 213.334 213.334v106.666c0 117.821-95.513 213.334-213.334 213.334H586.667c-117.821 0-213.334-95.513-213.334-213.334V426.667c0-117.821 95.513-213.334 213.334-213.334ZM480 853.333h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666C1072.243 853.333 1120 901.09 1120 960c0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1066.667 800 1018.91 800 960c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Zm-853.333 320h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1386.667 800 1338.91 800 1280c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Zm-853.333 320h106.667c58.91 0 106.666 47.757 106.666 106.667 0 58.91-47.756 106.667-106.666 106.667H480c-58.91 0-106.667-47.757-106.667-106.667 0-58.91 47.757-106.667 106.667-106.667Zm426.667 0h106.666c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.756 106.667-106.667 106.667H906.667C847.757 1706.667 800 1658.91 800 1600c0-58.91 47.756-106.667 106.667-106.667Zm426.666 0H1440c58.91 0 106.667 47.757 106.667 106.667 0 58.91-47.757 106.667-106.667 106.667h-106.667c-58.91 0-106.666-47.757-106.666-106.667 0-58.91 47.756-106.667 106.666-106.667Z" />
                            </svg>
                        </x-link-radio-new>
                        <x-link-radio-new :dashboard="$user->dashboard" page="3" title="Secretaria">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                <path d="M833.935 1063.327c28.913 170.315 64.038 348.198 83.464 384.79 27.557 51.84 92.047 71.944 144 44.387 51.84-27.558 71.717-92.273 44.16-144.113-19.426-36.593-146.937-165.46-271.624-285.064Zm-43.821-196.405c61.553 56.923 370.899 344.81 415.285 428.612 56.696 106.842 15.811 239.887-91.144 296.697-32.64 17.28-67.765 25.411-102.325 25.411-78.72 0-154.955-42.353-194.371-116.555-44.386-83.802-109.102-501.346-121.638-584.245-3.501-23.717 8.245-47.21 29.365-58.277 21.346-11.294 47.096-8.02 64.828 8.357ZM960.045 281.99c529.355 0 960 430.757 960 960 0 77.139-8.922 153.148-26.654 225.882l-10.39 43.144h-524.386v-112.942h434.258c9.487-50.71 14.231-103.115 14.231-156.084 0-467.125-380.047-847.06-847.059-847.06-467.125 0-847.059 379.935-847.059 847.06 0 52.97 4.744 105.374 14.118 156.084h487.454v112.942H36.977l-10.39-43.144C8.966 1395.137.044 1319.128.044 1241.99c0-529.243 430.645-960 960-960Zm542.547 390.686 79.85 79.85-112.716 112.715-79.85-79.85 112.716-112.715Zm-1085.184 0L530.123 785.39l-79.85 79.85L337.56 752.524l79.849-79.85Zm599.063-201.363v159.473H903.529V471.312h112.942Z" fill-rule="evenodd"/>
                            </svg>
                        </x-link-radio-new>
                        <x-link-radio-new :dashboard="$user->dashboard" page="4" title="Diretor">
                            <svg class="w-6 h-6"  viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.02 5.5H20.98C21.27 5.5 21.5 5.73 21.5 6.02V18.98C21.5 19.27 21.27 19.5 20.98 19.5H3.02C2.73 19.5 2.5 19.27 2.5 18.98V6.02C2.5 5.73 2.73 5.5 3.02 5.5Z" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8.25V10.25" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 15.25V16.75" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 8.25V8.95999" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 11.25V16.75" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 9.75C7.55228 9.75 8 9.30228 8 8.75C8 8.19772 7.55228 7.75 7 7.75C6.44772 7.75 6 8.19772 6 8.75C6 9.30228 6.44772 9.75 7 9.75Z" fill="currentColor"/>
                                <path d="M12 13.75C12.5523 13.75 13 13.3023 13 12.75C13 12.1977 12.5523 11.75 12 11.75C11.4477 11.75 11 12.1977 11 12.75C11 13.3023 11.4477 13.75 12 13.75Z" fill="currentColor"/>
                                <path d="M17 11.96C17.5523 11.96 18 11.5122 18 10.96C18 10.4077 17.5523 9.95996 17 9.95996C16.4477 9.95996 16 10.4077 16 10.96C16 11.5122 16.4477 11.96 17 11.96Z" fill="currentColor"/>
                                <path d="M17 12.96V16.75" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </x-link-radio-new>
                    </ul>
                </div>
            </fieldset>
        </section>
    </div>
</div>
