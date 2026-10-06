<div class="w-100">
    @php
        use App\Enums\Payments\PaymentType;
        use App\Enums\Payments\PaymentStatus;
    @endphp
    <x-breadcrumb>
        <div class="grid grid-cols-8 gap-4 text-gray-600 ">
            <div class="col-span-6 justify-items-start">
                <h3 class="text-2xl font-bold tracki dark:text-gray-50">
                    Vendedor: {{ $partner->name }}
                </h3>
            </div>

        </div>
    </x-breadcrumb>

    <div class="pt-3 px-4 my-6 bg-white dark:bg-gray-800 sm:rounded-lg">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            {{-- Locações indicadas --}}
            <div class="col-span-full sm:col-span-1">
                <div class="relative h-32 overflow-hidden bg-green-500 rounded-lg shadow-md">
                    <svg class="absolute w-24 h-24 text-green-800 rounded-md opacity-50 -top-3 -right-6 md:-right-4"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 21V15H12M15 3V21M15 5H19.4C19.9601 5 20.2401 5 20.454 5.10899C20.6422 5.20487 20.7951 5.35785 20.891 5.54601C21 5.75992 21 6.03995 21 6.6V7.4C21 7.96005 21 8.24008 20.891 8.45399C20.7951 8.64215 20.6422 8.79513 20.454 8.89101C20.2401 9 19.9601 9 19.4 9H15M5 10V16.2C5 17.8802 5 18.7202 5.32698 19.362C5.6146 19.9265 6.07354 20.3854 6.63803 20.673C7.27976 21 8.11984 21 9.8 21H12M3 12L12 3"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="p-4 ">
                        <dl>
                            <dt class="text-sm font-medium leading-5 text-white truncate">
                                Locações indicadas
                            </dt>
                            <dd class="mt-1 text-5xl font-bold leading-9 text-white">
                                {{ $indications ?? 0 }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Pessoas cadastradas --}}
            <div class="col-span-full sm:col-span-1">
                <div class="relative h-32 overflow-hidden bg-green-500 rounded-lg shadow-md">
                    <svg class="absolute w-24 h-24 text-green-800 rounded-md opacity-50 -top-3 -right-6 md:-right-4"
                        fill="currentColor" version="1.2" baseProfile="tiny" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 256 256" xml:space="preserve">
                        <path id="XMLID_7_" d="M123.5,127c2.7-2.5,6-3.9,9.4-3.9H251v15.8H136.9c-3.9,0-6,2.2-7.2,3.3c-5,4.7-38.5,35.5-38.5,35.5l-10.1-9.9
                            C81.1,167.9,118.8,131.4,123.5,127 M191.1,41.1c13.4,0,20.7-9.3,20.7-20.7c0-11.4-9.3-20.7-20.7-20.7c-11.4,0-20.7,9.3-20.7,20.7
                            C170.4,31.8,179.7,41.1,191.1,41.1 M160.4,76.6h6.9l-10.2,36.5H225l-10.2-36.5h6.9l10.5,36.5h17.9l-14.4-48.4
                            c-1.9-6.7-10.4-18.5-25-18.5h-39.4c-14.6,0-23.1,11.9-25,18.5L132,113.1h17.9L160.4,76.6z M101.8,111.2L93,94.8l-9.4-17.6
                            c0,0-1.1-1.6-3.1-0.7c-1.8,0.9-1,2.9-1,2.9l6,11.5l3.8,7.2l-4.3-2c-7.7-3.5-11.9-4.9-13.6-5.7c-0.3-0.1-1.8-1-2.5-2.5
                            c-2-4.5-10.6-26.2-12.5-31c-1.6-4.1-5.6-9.8-13.9-11.9c-9.4-2.3-18.9,3.6-21.1,13L8.6,112.2c-1.1,4.4-3.1,16.2-3.1,21.1
                            c0,5,0.1,105.6,0.1,105.6C5.6,247.9,12,255,20.9,255c8.9,0,15-7.3,14.9-16.2c0,0,0-57.5,0-89.5l13.7-57.7c1.6,3.9,3.6,8.7,4.2,9.8
                            c1.6,2.7,3.1,4.6,6.2,6c0,0,17.9,7.4,24.8,10.6c4.2,1.6,8.7,0.2,11.3-3.1l1-2l0.3,0.6c0,0,2,3.6,5.1,3.8
                            C103.3,114.5,101.8,111.2,101.8,111.2 M74.1,20.2c0-11.4-9.3-20.7-20.7-20.7C42-0.4,32.8,8.8,32.8,20.2c0,11.4,9.3,20.7,20.7,20.7
                            C64.9,40.9,74.1,31.7,74.1,20.2 M83.4,155.2l40.3-37.5l-5.2-5.6l-40.3,37.5L83.4,155.2z" />
                    </svg>
                    <div class="p-4 ">
                        <dl>
                            <dt class="text-sm font-medium leading-5 text-white truncate">
                                Pessoas cadastradas
                            </dt>
                            <dd class="mt-1 text-5xl font-bold leading-9 text-white">
                                {{ $registers ?? 0 }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            {{-- Jóias geradas --}}
            <div class="col-span-full sm:col-span-1">
                <div class="relative h-32 overflow-hidden bg-green-500 rounded-lg shadow-md">
                    <svg class="absolute w-24 h-24 text-green-800 rounded-md opacity-50 -top-3 -right-6 md:-right-4"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19 8.5L17 5.5H14.5L15.5 8.5L12 18.5L19 8.5Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M4.37596 8.08397C4.1462 8.42862 4.23933 8.89427 4.58397 9.12404C4.92862 9.3538 5.39427 9.26067 5.62404 8.91603L4.37596 8.08397ZM7 5.5V4.75C6.74924 4.75 6.51506 4.87533 6.37596 5.08397L7 5.5ZM9.5 6.25C9.91421 6.25 10.25 5.91421 10.25 5.5C10.25 5.08579 9.91421 4.75 9.5 4.75V6.25ZM5.61442 8.0699C5.37689 7.73057 4.90924 7.64804 4.5699 7.88558C4.23057 8.12311 4.14804 8.59076 4.38558 8.9301L5.61442 8.0699ZM12 18.5L11.3856 18.9301C11.6004 19.237 12.0088 19.3383 12.3421 19.1674C12.6755 18.9965 12.8317 18.6058 12.7079 18.2522L12 18.5ZM9.20789 8.25224C9.07106 7.86128 8.6432 7.65527 8.25224 7.79211C7.86128 7.92894 7.65527 8.3568 7.79211 8.74776L9.20789 8.25224ZM5 7.75C4.58579 7.75 4.25 8.08579 4.25 8.5C4.25 8.91421 4.58579 9.25 5 9.25V7.75ZM8.5 9.25C8.91421 9.25 9.25 8.91421 9.25 8.5C9.25 8.08579 8.91421 7.75 8.5 7.75V9.25ZM10.2115 5.73717C10.3425 5.34421 10.1301 4.91947 9.73717 4.78849C9.34421 4.6575 8.91947 4.86987 8.78849 5.26283L10.2115 5.73717ZM7.78849 8.26283C7.6575 8.65579 7.86987 9.08053 8.26283 9.21151C8.65579 9.3425 9.08053 9.13013 9.21151 8.73717L7.78849 8.26283ZM9.5 4.75C9.08579 4.75 8.75 5.08579 8.75 5.5C8.75 5.91421 9.08579 6.25 9.5 6.25V4.75ZM14.5 6.25C14.9142 6.25 15.25 5.91421 15.25 5.5C15.25 5.08579 14.9142 4.75 14.5 4.75V6.25ZM8.5 7.75C8.08579 7.75 7.75 8.08579 7.75 8.5C7.75 8.91421 8.08579 9.25 8.5 9.25V7.75ZM19 9.25C19.4142 9.25 19.75 8.91421 19.75 8.5C19.75 8.08579 19.4142 7.75 19 7.75V9.25ZM5.62404 8.91603L7.62404 5.91603L6.37596 5.08397L4.37596 8.08397L5.62404 8.91603ZM7 6.25H9.5V4.75H7V6.25ZM4.38558 8.9301L11.3856 18.9301L12.6144 18.0699L5.61442 8.0699L4.38558 8.9301ZM12.7079 18.2522L9.20789 8.25224L7.79211 8.74776L11.2921 18.7478L12.7079 18.2522ZM5 9.25H8.5V7.75H5V9.25ZM8.78849 5.26283L7.78849 8.26283L9.21151 8.73717L10.2115 5.73717L8.78849 5.26283ZM9.5 6.25H14.5V4.75H9.5V6.25ZM8.5 9.25H19V7.75H8.5V9.25Z"
                            fill="currentColor" />
                    </svg>
                    <div class="p-4 ">
                        <dl>
                            <dt class="text-sm font-medium leading-5 text-white truncate">
                                Jóias geradas
                            </dt>
                            <dd class="mt-1 text-5xl font-bold leading-9 text-white">
                                {{ $jewels->count() ?? 0 }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Total pago --}}
            <div class="col-span-full sm:col-span-1">
                <div class="relative h-32 overflow-hidden bg-green-500 rounded-lg shadow-md">
                    <svg class="absolute w-24 h-24 text-green-800 rounded-md opacity-50 -top-3 -right-6 md:-right-4"
                        fill="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M374.588,43.842c-2.692,0-4.281,1.49-4.281,4.809v12.745c0,3.318,1.589,4.809,4.281,4.809c2.695,0,4.328-1.49,4.328-4.809
                               V48.651C378.917,45.333,377.282,43.842,374.588,43.842z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M282.939,43.842c-2.692,0-4.281,1.49-4.281,4.809v12.745c0,3.318,1.589,4.809,4.281,4.809c2.695,0,4.328-1.49,4.328-4.809
                               V48.651C287.268,45.333,285.633,43.842,282.939,43.842z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M310.299,43.842c-2.692,0-4.281,1.49-4.281,4.809v12.745c0,3.318,1.589,4.809,4.281,4.809c2.695,0,4.328-1.49,4.328-4.809
                               V48.651C314.627,45.333,312.993,43.842,310.299,43.842z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M337.661,43.842c-2.695,0-4.281,1.49-4.281,4.809v12.745c0,3.318,1.587,4.809,4.281,4.809c2.692,0,4.326-1.49,4.326-4.809
                               V48.651C341.987,45.333,340.353,43.842,337.661,43.842z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M462.855,45.02c0,1.858,1.667,3.013,4.102,4.039v-7.628C464.072,42.008,462.855,43.482,462.855,45.02z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M493.499,7.162H206.673c-0.321,0-0.633,0.032-0.949,0.048c5.871,9.129,9.294,19.977,9.294,31.613
                               c0,14.825-5.542,28.371-14.65,38.706h10.499c35.67,0,64.865,28.551,65.317,63.747l0.004,0.063v0.482v0.042v0.102v20.79l4.513-3.83
                               c2.264-1.922,5.382-2.492,8.18-1.494l30.791,10.978l51.391-37.815c1.731-1.273,3.885-1.82,6.019-1.549l29.436,3.869l32.571-29.711
                               c3.397-3.098,8.662-2.857,11.76,0.539s2.856,8.661-0.539,11.76l-35.429,32.319c-1.811,1.653-4.257,2.427-6.694,2.103
                               l-29.952-3.937l-52.256,38.451c-2.229,1.639-5.125,2.064-7.729,1.135l-30.436-10.851l-11.625,9.865v52.982h217.309
                               c10.218,0,18.501-8.283,18.501-18.501V25.664C512,15.445,503.716,7.162,493.499,7.162z M257.262,70.15
                               c0,1.539-1.874,2.308-3.752,2.308c-1.875,0-3.75-0.769-3.75-2.308v-24.48l-1.396,0.866c-0.432,0.289-0.865,0.385-1.201,0.385
                               c-1.396,0-2.358-1.492-2.358-2.982c0-1.01,0.434-1.972,1.396-2.549l6.349-3.848c0.384-0.241,0.865-0.337,1.394-0.337
                               c1.539,0,3.318,0.913,3.318,2.357V70.15z M264.521,72.747c-2.115,0-3.702-1.731-3.702-3.703c0-2.019,1.587-3.703,3.702-3.703
                               c1.972,0,3.655,1.685,3.655,3.703C268.176,71.015,266.493,72.747,264.521,72.747z M294.77,61.396
                               c0,8.271-5.194,11.35-11.831,11.35s-11.783-3.078-11.783-11.35V48.651c0-8.271,5.146-11.35,11.783-11.35
                               s11.831,3.078,11.831,11.35V61.396z M322.13,61.396c0,8.271-5.194,11.35-11.831,11.35c-6.637,0-11.783-3.078-11.783-11.35V48.651
                               c0-8.271,5.146-11.35,11.783-11.35c6.637,0,11.831,3.078,11.831,11.35V61.396z M349.491,61.396c0,8.271-5.196,11.35-11.831,11.35
                               c-6.637,0-11.783-3.078-11.783-11.35V48.651c0-8.271,5.146-11.35,11.783-11.35c6.636,0,11.831,3.078,11.831,11.35V61.396z
                                M356.17,72.747c-2.115,0-3.702-1.731-3.702-3.703c0-2.019,1.587-3.703,3.702-3.703c1.972,0,3.655,1.685,3.655,3.703
                               C359.825,71.015,358.142,72.747,356.17,72.747z M386.419,61.396c0,8.271-5.194,11.35-11.831,11.35
                               c-6.637,0-11.783-3.078-11.783-11.35V48.651c0-8.271,5.146-11.35,11.783-11.35c6.637,0,11.831,3.078,11.831,11.35V61.396z
                                M413.779,61.396c0,8.271-5.194,11.35-11.831,11.35c-6.637,0-11.783-3.078-11.783-11.35V48.651c0-8.271,5.146-11.35,11.783-11.35
                               c6.637,0,11.831,3.078,11.831,11.35V61.396z M441.14,61.396c0,8.271-5.196,11.35-11.831,11.35c-6.637,0-11.783-3.078-11.783-11.35
                               V48.651c0-8.271,5.146-11.35,11.783-11.35c6.636,0,11.831,3.078,11.831,11.35V61.396z M471.188,78.414v1.86
                               c0,0.896-1.217,1.73-2.435,1.73c-1.411,0-2.435-0.835-2.435-1.73v-1.604c-7.692-0.255-13.974-4.229-13.974-8.333
                               c0-2.179,1.922-5.385,4.359-5.385c2.692,0,4.871,3.782,9.614,4.615V59.186c-5.896-2.243-12.82-5.001-12.82-13.205
                               c0-8.139,6.025-12.049,12.82-13.01v-1.795c0-0.898,1.026-1.732,2.435-1.732c1.219,0,2.435,0.835,2.435,1.732v1.602
                               c3.974,0.128,11.474,1.153,11.474,5.577c0,1.73-1.154,5.254-3.974,5.254c-2.115,0-3.333-2.051-7.5-2.372v9.358
                               c5.833,2.181,12.628,5.194,12.628,13.847C483.814,72.389,478.687,77.197,471.188,78.414z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path
                                    d="M470.546,60.916v8.59c2.18-0.514,3.91-1.732,3.91-4.039C474.457,63.352,472.853,62.006,470.546,60.916z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M401.948,43.842c-2.692,0-4.281,1.49-4.281,4.809v12.745c0,3.318,1.589,4.809,4.281,4.809c2.695,0,4.328-1.49,4.328-4.809
                               V48.651C406.276,45.333,404.643,43.842,401.948,43.842z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M429.31,43.842c-2.695,0-4.281,1.49-4.281,4.809v12.745c0,3.318,1.587,4.809,4.281,4.809c2.692,0,4.326-1.49,4.326-4.809
                               V48.651C433.637,45.333,432.002,43.842,429.31,43.842z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M255.952,146.028c-0.13-26.296-21.966-47.687-48.672-47.687h-22.193l-23.618,60.572l4.934-24.854
                               c0.365-1.837,0.07-3.743-0.832-5.384l-7.779-14.148l6.89-12.531c1.029-1.872-0.334-4.157-2.458-4.157h-18.911
                               c-2.129,0-3.485,2.288-2.458,4.157l6.89,12.531l-7.75,14.096c-0.92,1.672-1.208,3.619-0.811,5.487l5.643,24.803l-23.864-60.572
                               H98.338c-26.219,0-47.658,21.392-47.79,47.789v144.406h-8.602c-5.643,0-10.219,4.576-10.219,10.219c0,16.221,0,12.694,0,29.091
                               H12.24c-6.76,0-12.24,5.48-12.24,12.24v79.843c0,6.76,5.48,12.24,12.24,12.24h117.122c6.76,0,12.24-5.48,12.24-12.24v-79.843
                               c0-6.76-5.48-12.24-12.24-12.24h-19.487v-16.6h37.734c-0.063-9.549,0-4.879,0-20.82h10.442c0,5.619,0,154.012,0,160.567h0.03
                               c-0.018,9.113-0.03,20.221-0.03,33.691c0,13.422,10.881,24.303,24.303,24.303c13.422,0,24.303-10.882,24.303-24.303
                               c0-194.907,0.009-338.707,0.009-340.452c0-2.405,1.934-4.363,4.339-4.392c2.405-0.029,4.386,1.881,4.443,4.286
                               c0.001,0.036,0.001,0.07,0.001,0.105v148.686c0,11.185,9.067,20.252,20.252,20.252c11.185,0,20.252-9.067,20.252-20.252V146.129
                               c0-0.017-0.002-0.032-0.002-0.048C255.95,146.063,255.952,146.046,255.952,146.028z M89.436,329.846H52.164
                               c0-7.793,0-11.016,0-18.871h6.329c3.42,2.626,7.757,4.194,12.307,4.194c4.533,0,8.872-1.557,12.307-4.194h6.329
                               C89.436,318.846,89.436,322.025,89.436,329.846z M99.043,290.535h-7.99V146.231c0.037-2.291,1.912-4.123,4.203-4.105
                               c2.291,0.019,4.135,1.88,4.136,4.171C99.402,216.416,99.542,284.201,99.043,290.535z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M129.361,450.817H98.952v35.867c0,13.422,10.881,24.303,24.303,24.303c13.422,0,24.303-10.882,24.303-24.303v-42.34
                               C142.586,448.387,136.253,450.817,129.361,450.817z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <circle cx="152.811" cy="42.987" r="41.975" />
                            </g>
                        </g>
                    </svg>
                    <div class="p-4 ">
                        <dl>
                            <dt class="text-sm font-medium leading-5 text-white truncate">
                                Total pago
                            </dt>
                            <dd class="mt-1 text-5xl font-bold leading-9 text-white">
                                {{-- {{ $jewels ?? 0 }} --}}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 my-6 bg-white dark:bg-gray-800 sm:rounded-lg">
        <div class="-mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                    <x-table-search></x-table-search>
                    <table style="width:100%" class='min-w-full divide-y divide-gray-200 dark:divide-gray-700'>
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr scope="col"
                                class="py-3.5 px-4 text-xs font-normal text-left text-gray-500
                                dark:text-gray-400">

                                <th scope="col"
                                    class="py-3.5 px-4 text-xs font-normal
                                            text-left text-gray-500
                                            dark:text-gray-400">
                                    Tipo
                                </th>

                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center text-gray-500
                                            dark:text-gray-400">
                                    Pessoa
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center text-gray-500
                                            dark:text-gray-400">
                                    Data
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center text-gray-500
                                            dark:text-gray-400">
                                    Valor
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 text-sm font-normal
                                            text-center text-gray-500
                                            dark:text-gray-400">
                                    Repasse
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            {{-- @if ($items->isEmpty())
                                <tr>
                                    <td colspan="5"
                                        class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                        Nenhum resultado encontrado.
                                    </td>
                                </tr>
                            @else --}}
                            @foreach ($items as $item)
                                <tr>
                                    <td
                                        class="py-1.5 px-4 text-sm font-normal  text-left text-gray-500 dark:text-gray-400">
                                        {{ PaymentType::From($item->type)->label() }}
                                    </td>
                                    <td
                                        class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                        @if ($item?->model)
                                            <div>
                                                <div class="text-sm font-bold">
                                                    {{ $item?->partner->name }}
                                                    ({{ $item?->partner->partner_category_master }})
                                                </div>
                                                <div class="text-sm opacity-50">
                                                    {{ $item?->partner->cpf }}
                                                </div>
                                            </div>
                                        @else
                                            Não vinculado
                                        @endif
                                    </td>
                                    <td
                                        class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                        {{ $item->date }}
                                    </td>
                                    <td
                                        class="py-1.5 px-4 text-sm font-normal  text-center text-gray-500 dark:text-gray-400">
                                        {{ $item->value }}
                                    </td>

                                    <td
                                        class="w-1/6 py-1.5 px-4 text-sm font-normal text-center
                                             text-gray-500 dark:text-gray-400 flex-nowrap">
                                        <div class="flex items-center gap-2">
                                            @if ($item->status === 'waiting')
                                                <span class="badge badge-warning gap-1">
                                                    {{ PaymentStatus::from($item->status)->label() }} </span>
                                            @elseif ($item->status === 'paid')
                                                <span class="badge badge-success gap-1">
                                                    {{ PaymentStatus::from($item->status)->label() }} </span>
                                            @elseif ($item->status === 'released')
                                                <span class="badge badge-info gap-1">
                                                    {{ PaymentStatus::from($item->status)->label() }}
                                                </span>
                                            @endif
                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                            {{-- @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- MODAL PAID --}}
    <x-dialog-modal wire:model="showModalPay">
        <x-slot name="title">Pagar</x-slot>
        <x-slot name="content">
            <form wire:submit="store">
                <div class="grid grid-cols-2 gap-2 mb-1 sm:gap-4 sm:mb-5">
                    <div class="col-span-full">
                        <label for="title">*Descrição</label>
                        <input
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"="Motivo"
                            placeholder="Descrição" wire:model="title" required>
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-left col-span-full sm:col-span-1">
                        <label for="form_payment">*Forma de pagamento</label>
                        <Select wire:model="form_payment" required
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <option value=''>Selecione...</option>
                            <option value='DIN'>Dinheiro</option>
                            <option value='CAR'>Cartões</option>
                            <option value='BOL'>Boleto</option>
                            <option value='PIX'>PIX</option>
                        </Select>
                        @error('form_payment')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1 text-left">
                        <label for="received">*Gerar recibo</label>
                        <Select wire:model="received" required
                            class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900">
                            <option value=''>Selecione...</option>
                            <option value='1'>SIM</option>
                            <option value='2'>NÃO</option>
                        </Select>
                        @error('received')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full sm:col-span-1">
                        <label for="paid_in">*Pagamento / vencimento</label>
                        <x-datepicker id='paid_in' :required="true"></x-datepicker>
                        @error('paid_in')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full sm:col-span-1">
                        <label for="value">*Valor total</label>
                        <input class="w-full rounded-md focus:ring focus:ri dark:border-gray-700 dark:text-gray-900"
                            x-mask:dynamic="$money($input, ',')" placeholder="Valor" wire:model="value" required>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" wire:click="checkout"
                class="text-white
                        bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5
                        text-center dark:bg-blue-600 dark:hover:bg-blue-700
                        dark:focus:ring-blue-800">
                Pagar
            </button>
            <x-secondary-button wire:click="$toggle('showModalPay')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    {{-- MODAL DELETE --}}
    <x-confirmation-modal wire:model="showJetModal">
        <x-slot name="title">
            Excluir registro
        </x-slot>

        <x-slot name="content">
            <h2 class="h2">Deseja realmente excluir o registro?</h2>
            <p>Não será possível reverter esta ação!</p>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showJetModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete({{ $registerId }})" wire:loading.attr="disabled">
                Apagar registro
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>


    {{-- MODAL READ --}}
    <x-dialog-modal wire:model="showModalView">
        <x-slot name="title">Detalhes</x-slot>
        <x-slot name="content">
            <dl class="max-w text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                @if ($detail)
                    @foreach ($detail as $item => $value)
                        @if ($value)
                            @if ($item == 'Foto')
                                <figure class="w-48">
                                    <img class="photo" src="{{ $value }}" alt="Movie" />
                                </figure>
                            @else
                                <div class="flex flex-col pb-1">
                                    <dt class="text-gray-500 md:text-lg dark:text-gray-400">{{ $item }}:</dt>
                                    <dd class="text-lg font-semibold">
                                        {{ $value }}
                                    </dd>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endif
                @if ($logs)
                    {!! $logs !!}
                @endif
            </dl>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showModalView')" class="mx-2">
                Fechar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

</div>
