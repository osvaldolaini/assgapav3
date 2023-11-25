<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:flex">
    <div class="flex flex-col h-full mt-0 sm:mt-4 sm:ml-3">
        <!-- Navigation Rail -->
        <div class="relative h-screen lg:block w-64 pb-3 ">
            <div class="h-full bg-white rounded-2xl dark:bg-gray-700 py-2">
                <nav class="mt-3">
                    <div>
                        <x-link-simple url="dashboard" active="dashboard">
                            <span class="text-left">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 2048 1792"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1070 1178l306-564h-654l-306 564h654zm722-282q0 182-71 348t-191 286-286 191-348 71-348-71-286-191-191-286-71-348 71-348 191-286 286-191 348-71 348 71 286 191 191 286 71 348z">
                                    </path>
                                </svg>
                            </span>
                            <span class="mx-4 text-sm font-normal">
                                Dashboard
                            </span>
                        </x-link-simple>
                        <x-link-simple url="list-users" active="*usuários*">
                            <span class="text-left">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span class="mx-4 text-sm font-normal">
                                Usuários
                            </span>
                        </x-link-simple>

                        <div class="flex mx-2 items-center py-0.5 flex-nowrap border-t border-gray-200"></div>
                        <x-link-simple url="list-users" active="*agendas*">
                            <span class="text-left">
                                <svg class="w-6 h-6" viewBox="0 0 512 512"  xml:space="preserve">

                                    <g>
                                        <rect x="119.256" y="222.607" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="341.863" y="222.607" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="267.662" y="222.607" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="119.256" y="302.11" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="267.662" y="302.11" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="193.46" y="302.11" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="341.863" y="381.612" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="267.662" y="381.612" fill="currentColor" width="50.881" height="50.885"/>
                                        <rect x="193.46" y="381.612" fill="currentColor" width="50.881" height="50.885"/>
                                        <path fill="currentColor" d="M439.277,55.046h-41.376v39.67c0,14.802-12.195,26.84-27.183,26.84h-54.025
                                            c-14.988,0-27.182-12.038-27.182-26.84v-39.67h-67.094v39.297c0,15.008-12.329,27.213-27.484,27.213h-53.424
                                            c-15.155,0-27.484-12.205-27.484-27.213V55.046H72.649c-26.906,0-48.796,21.692-48.796,48.354v360.246
                                            c0,26.661,21.89,48.354,48.796,48.354h366.628c26.947,0,48.87-21.692,48.87-48.354V103.4
                                            C488.147,76.739,466.224,55.046,439.277,55.046z M453.167,462.707c0,8.56-5.751,14.309-14.311,14.309H73.144
                                            c-8.56,0-14.311-5.749-14.311-14.309V178.089h394.334V462.707z"/>
                                        <path fill="currentColor" d="M141.525,102.507h53.392c4.521,0,8.199-3.653,8.199-8.144v-73.87c0-11.3-9.27-20.493-20.666-20.493h-28.459
                                            c-11.395,0-20.668,9.192-20.668,20.493v73.87C133.324,98.854,137.002,102.507,141.525,102.507z"/>
                                        <path fill="currentColor" d="M316.693,102.507h54.025c4.348,0,7.884-3.513,7.884-7.826V20.178C378.602,9.053,369.474,0,358.251,0H329.16
                                            c-11.221,0-20.349,9.053-20.349,20.178v74.503C308.81,98.994,312.347,102.507,316.693,102.507z"/>
                                    </g>
                                    </svg>
                            </span>
                            <span class="mx-4 text-sm font-normal">
                                Agendas
                            </span>
                        </x-link-simple>
                        <x-link-simple url="locations" active="*locações*">
                            <span class="text-left">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 20H6C3.79086 20 2 18.2091 2 16V7C2 4.79086 3.79086 3 6 3H17C19.2091 3 21 4.79086 21 7V10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 2V4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 2V4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 8H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.5 15.6429L17 17.1429" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="17" cy="17" r="5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                            </span>
                            <span class="mx-4 text-sm font-normal">
                                Locações
                            </span>
                        </x-link-simple>

                        <!-- Dropdown Cadastros -->
                            <button id="dropdownArticle" data-dropdown-toggle="dropdown"
                                class="flex items-center justify-start w-full px-4 py-1
                                        font-thin uppercase transition-colors duration-200 mb-0
                                        {{ Request::is('*cadastros*')
                                            ? ' bg-gradient-to-r from-white to-blue-100                                                                                                  dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                                            : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}"
                                type="button">
                                <span class="text-left">
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
                                </span>
                                <span class="mx-4 text-sm font-normal">
                                    Cadastros
                                </span>
                                <svg class="w-2.5 h-2.5 ml-5 justify-end" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdown"
                                class="justify-start w-full z-10 hidden bg-white
                                        divide-gray-100 rounded-es-lg shadow dark:bg-gray-700 ">
                                <ul class="text-sm ml-5 mt-0 rounded-ee-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownArticle">
                                    <x-link-dropdown url="partners" active="*cadastros-sócios*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Sócios
                                    </x-link-dropdown>
                                    <x-link-dropdown url="others" active="*cadastros-não-sócios*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Não Sócios
                                    </x-link-dropdown>
                                    <x-link-dropdown url="ambiences" active="*ambientes*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Ambientes
                                    </x-link-dropdown>
                                </ul>
                            </div>
                        <!-- End Dropdown Cadastros -->
                        <!-- Dropdown Material -->
                            <button id="material" data-dropdown-toggle="dropdownMaterial"
                                class="flex items-center justify-start w-full px-4 py-1
                                font-thin uppercase transition-colors duration-200
                                {{ Request::is('*material*')
                                    ? ' bg-gradient-to-r from-white to-blue-100                                                                                                  dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                                    : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}"
                                type="button">
                                <span class="text-left">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path fill="currentColor"
                                            d="M12 6v-6h-8v6h-4v7h16v-7h-4zM7 12h-6v-5h2v1h2v-1h2v5zM5 6v-5h2v1h2v-1h2v5h-6zM15 12h-6v-5h2v1h2v-1h2v5z">
                                        </path>
                                        <path fill="currentColor" d="M0 16h3v-1h10v1h3v-2h-16v2z"></path>
                                    </svg>
                                </span>
                                <span class="mx-4 text-sm font-normal">
                                    Estoque
                                </span>
                                <svg class="w-2.5 h-2.5 ml-5 justify-end" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdownMaterial"
                                class="justify-start w-full z-10 hidden bg-white
                                divide-gray-100 rounded-es-lg shadow dark:bg-gray-700 ">
                                <ul class="text-sm ml-5 mt-2 rounded-ee-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMaterial">
                                    <x-link-dropdown url="material-permanent" active="*material-permanente*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Permanente
                                    </x-link-dropdown>
                                    <x-link-dropdown url="material-consuption" active="*material-de-consumo*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Consumo
                                    </x-link-dropdown>
                                </ul>
                            </div>
                        <!-- End Dropdown Material -->
                        <!-- Dropdown Marketing -->
                            <button id="marketing" data-dropdown-toggle="dropdownMarketing"
                                class="flex items-center justify-start w-full px-4 py-1
                                font-thin uppercase transition-colors duration-200
                                {{ Request::is('*emails*')
                                    ? ' bg-gradient-to-r from-white to-blue-100                                                                                                  dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                                    : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}"
                                type="button">
                                <span class="text-left">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M14.25 2.1a1.25 1.25 0 0 0-1.17-.1L6.91 4.43a1.22 1.22 0 0 1-.46.09H2.5a1.25 1.25 0 0 0-1.25 1.25v.1H0v3h1.25V9a1.25 1.25 0 0 0 1.25 1.22L4 13.4a1.26 1.26 0 0 0 1.13.72h.63A1.25 1.25 0 0 0 7 12.87v-2.53l6.08 2.43a1.27 1.27 0 0 0 .47.09 1.29 1.29 0 0 0 .7-.22 1.25 1.25 0 0 0 .55-1V3.13a1.25 1.25 0 0 0-.55-1.03zm-8.5 3.67V9H2.5V5.77zm0 7.1h-.63l-1.23-2.65h1.86zm1.62-3.72A2.29 2.29 0 0 0 7 9V5.7a2.26 2.26 0 0 0 .37-.11l6.18-2.46v8.48zm7.46-3.03v2.5a1.25 1.25 0 0 0 0-2.5z"/></svg>
                                </span>
                                <span class="mx-4 text-sm font-normal">
                                    Marketing
                                </span>
                                <svg class="w-2.5 h-2.5 ml-5 justify-end" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdownMarketing"
                                class="justify-start w-full z-10 hidden bg-white
                                divide-gray-100 rounded-es-lg shadow dark:bg-gray-700 ">
                                <ul class="text-sm ml-5 mt-2 rounded-ee-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMarketing">
                                    <x-link-dropdown url="emails-promo" active="*emails-promocionais*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Emails promocionais
                                    </x-link-dropdown>
                                    <x-link-dropdown url="emails-birth" active="*emails-aniversariantes*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Email aniversariante
                                    </x-link-dropdown>
                                    <x-link-dropdown url="material-consuption" active="*material-de-consumo*">
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                fill="currentColor" />
                                            <path fill="#292D32"
                                                d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                        </svg>
                                        Listas
                                    </x-link-dropdown>
                                </ul>
                            </div>
                        <!-- End Dropdown Marketing -->

                        <div class="flex mx-2 items-center py-1 flex-nowrap border-t border-gray-200"></div>
                        <span
                            class="text-gray-600
                                flex items-center justify-start w-full px-4 py-0 my-0 mb-1
                                text-sm transition-colors duration-200">
                            Configurações do sistema
                        </span>
                        <!-- Dropdown Configurações -->
                        <button id="dropdownConfigs" data-dropdown-toggle="configs"
                            class="flex items-center justify-start w-full px-4 py-1
                                font-thin uppercase transition-colors duration-200
                                {{ Request::is('*configurações*')
                                    ? ' bg-gradient-to-r from-white to-blue-100                                                                                                  dark:from-gray-700 dark:to-gray-200 text-blue-500 border-r-4 border-blue-500'
                                    : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}"
                            type="button">
                            <span class="text-left">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M1 3.5A1.5 1.5 0 012.5 2h15A1.5 1.5 0 0119 3.5v2A1.5 1.5 0 0117.5 7h-15A1.5 1.5 0 011 5.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 9.5A1.5 1.5 0 012.5 8h6.073a1.5 1.5 0 011.342 2.17l-1 2a1.5 1.5 0 01-1.342.83H2.5A1.5 1.5 0 011 11.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 15.5A1.5 1.5 0 012.5 14h5.27a1.5 1.5 0 011.471 1.206l.4 2A1.5 1.5 0 018.171 19H2.5A1.5 1.5 0 011 17.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM12.159 13.059l-.682-.429a.987.987 0 01-.452-.611.946.946 0 01.134-.742.983.983 0 01.639-.425 1.023 1.023 0 01.758.15l.682.427c.369-.31.8-.54 1.267-.676V9.97c0-.258.104-.504.291-.686.187-.182.44-.284.704-.284.264 0 .517.102.704.284a.957.957 0 01.291.686v.783c.472.138.903.37 1.267.676l.682-.429a1.02 1.02 0 01.735-.107c.25.058.467.208.606.419.14.21.19.465.141.71a.97.97 0 01-.403.608l-.682.429a3.296 3.296 0 010 1.882l.682.43a.987.987 0 01.452.611.946.946 0 01-.134.742.982.982 0 01-.639.425 1.02 1.02 0 01-.758-.15l-.682-.428c-.369.31-.8.54-1.267.676v.783a.957.957 0 01-.291.686A1.01 1.01 0 0115.5 19a1.01 1.01 0 01-.704-.284.957.957 0 01-.291-.686v-.783a3.503 3.503 0 01-1.267-.676l-.682.429a1.02 1.02 0 01-.75.132.999.999 0 01-.627-.421.949.949 0 01-.135-.73.97.97 0 01.434-.61l.68-.43a3.296 3.296 0 010-1.882zm3.341-.507c-.82 0-1.487.65-1.487 1.449s.667 1.448 1.487 1.448c.82 0 1.487-.65 1.487-1.448 0-.8-.667-1.45-1.487-1.45z" />
                                </svg>
                            </span>
                            <span class="mx-4 text-sm font-normal">
                                Configurações
                            </span>
                            <svg class="w-2.5 h-2.5 ml-5 justify-end" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="configs"
                            class="justify-start w-full z-10 hidden bg-white
                                    divide-gray-100 rounded-es-lg shadow dark:bg-gray-700 ">
                            <ul class="text-sm ml-5 mt-0 rounded-ee-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownConfigs">
                                <x-link-dropdown url="configuration" active="*conf">
                                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            fill="currentColor" />
                                        <path fill="#292D32"
                                            d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                    </svg>
                                    Gerais
                                </x-link-dropdown>
                                <x-link-dropdown url="partner-categories" active="configurações-categorias-de-socio">
                                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            fill="currentColor" />
                                        <path fill="#292D32"
                                            d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                    </svg>
                                    Categorias de sócio
                                </x-link-dropdown>
                                <x-link-dropdown url="ambience-categories"
                                    active="configurações-categorias-de-ambiente">
                                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            fill="currentColor" />
                                        <path fill="#292D32"
                                            d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                    </svg>
                                    Categorias de ambiente
                                </x-link-dropdown>
                                <x-link-dropdown url="ambience-tenats" active="configurações-tipos-de-locatário">
                                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            fill="currentColor" />
                                        <path fill="#292D32"
                                            d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                    </svg>
                                    Tipos de locatário
                                </x-link-dropdown>
                                <x-link-dropdown url="event-types" active="configurações-tipos-de-evento">
                                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            fill="currentColor" />
                                        <path fill="#292D32"
                                            d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                    </svg>
                                    Tipos de evento
                                </x-link-dropdown>
                                <x-link-dropdown url="cost-center" active="configurações-centro-de-custo">
                                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            fill="currentColor" />
                                        <path fill="#292D32"
                                            d="M10.7397 16.2802C10.5497 16.2802 10.3597 16.2102 10.2097 16.0602C9.91969 15.7702 9.91969 15.2902 10.2097 15.0002L13.2097 12.0002L10.2097 9.00016C9.91969 8.71016 9.91969 8.23016 10.2097 7.94016C10.4997 7.65016 10.9797 7.65016 11.2697 7.94016L14.7997 11.4702C15.0897 11.7602 15.0897 12.2402 14.7997 12.5302L11.2697 16.0602C11.1197 16.2102 10.9297 16.2802 10.7397 16.2802Z" />
                                    </svg>
                                    Centro de custo
                                </x-link-dropdown>

                            </ul>
                        </div>
                        <!-- End Dropdown Configurações -->

                        <a href="{{ url('/user/profile') }}"
                            class="flex items-center justify-start w-full px-4 py-2 my-1
                        font-thin uppercase transition-colors duration-200
                        {{ Request::is('*profile*')
                            ? 'bg-gradient-to-r from-white to-blue-100
                                                                                                                                                                                                                        dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500'
                            : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }} sm:hidden">
                            <span class="text-left">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M1 3.5A1.5 1.5 0 012.5 2h15A1.5 1.5 0 0119 3.5v2A1.5 1.5 0 0117.5 7h-15A1.5 1.5 0 011 5.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 9.5A1.5 1.5 0 012.5 8h6.073a1.5 1.5 0 011.342 2.17l-1 2a1.5 1.5 0 01-1.342.83H2.5A1.5 1.5 0 011 11.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM1 15.5A1.5 1.5 0 012.5 14h5.27a1.5 1.5 0 011.471 1.206l.4 2A1.5 1.5 0 018.171 19H2.5A1.5 1.5 0 011 17.5v-2zm3.5 1a1 1 0 11-2 0 1 1 0 012 0zM12.159 13.059l-.682-.429a.987.987 0 01-.452-.611.946.946 0 01.134-.742.983.983 0 01.639-.425 1.023 1.023 0 01.758.15l.682.427c.369-.31.8-.54 1.267-.676V9.97c0-.258.104-.504.291-.686.187-.182.44-.284.704-.284.264 0 .517.102.704.284a.957.957 0 01.291.686v.783c.472.138.903.37 1.267.676l.682-.429a1.02 1.02 0 01.735-.107c.25.058.467.208.606.419.14.21.19.465.141.71a.97.97 0 01-.403.608l-.682.429a3.296 3.296 0 010 1.882l.682.43a.987.987 0 01.452.611.946.946 0 01-.134.742.982.982 0 01-.639.425 1.02 1.02 0 01-.758-.15l-.682-.428c-.369.31-.8.54-1.267.676v.783a.957.957 0 01-.291.686A1.01 1.01 0 0115.5 19a1.01 1.01 0 01-.704-.284.957.957 0 01-.291-.686v-.783a3.503 3.503 0 01-1.267-.676l-.682.429a1.02 1.02 0 01-.75.132.999.999 0 01-.627-.421.949.949 0 01-.135-.73.97.97 0 01.434-.61l.68-.43a3.296 3.296 0 010-1.882zm3.341-.507c-.82 0-1.487.65-1.487 1.449s.667 1.448 1.487 1.448c.82 0 1.487-.65 1.487-1.448 0-.8-.667-1.45-1.487-1.45z" />
                                </svg>
                            </span>
                            <span class="mx-4 text-sm font-normal">
                                Perfil
                            </span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}"
                                class="flex items-center justify-start w-full px-4 py-2 my-1
                            font-thin uppercase transition-colors duration-200
                            {{ Request::is('profile*')
                                ? 'bg-gradient-to-r from-white to-blue-100
                                                                                                                                                                                                                                                            dark:from-gray-700 dark:to-gray-800 text-blue-500 border-r-4 border-blue-500'
                                : 'dark:text-gray-200 hover:text-blue-500 text-gray-500' }}
                            sm:hidden">
                                <span class="text-left">
                                    <svg class="w-6 h-6 " viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14 7.63636L14 4.5C14 4.22386 13.7761 4 13.5 4L4.5 4C4.22386 4 4 4.22386 4 4.5L4 19.5C4 19.7761 4.22386 20 4.5 20L13.5 20C13.7761 20 14 19.7761 14 19.5L14 16.3636"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10 12L21 12M21 12L18.0004 8.5M21 12L18 15.5" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                <span class="mx-4 text-sm font-normal">
                                    {{ __('Log Out') }}
                                </span>
                            </a>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</div>
