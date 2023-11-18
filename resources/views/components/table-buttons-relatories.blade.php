@props(['pdf', 'excel','print'])
<div>
    <div class="flex col-span-full items-center space-x-2 mt-2 justify-start px-4 pb-0 mb-0">
        @if (isset($print))
            <div class="tooltip tooltip-top p-0" data-tip="Imprimir">
                <button wire:click="printExport()"
                    class="flex items-center justify-center p-1
                    text-sm tracking-wide text-white transition-colors
                    duration-200 bg-blue-500 rounded-lg sm:w-auto
                    hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                    <svg class="h-6 w-6 " viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.3529 14H19C19.9428 14 20.4142 14 20.7071 13.7071C21 13.4142 21 12.9428 21 12V11C21 9.11438 21 8.17157 20.4142 7.58579C19.8284 7 18.8856 7 17 7H7C5.11438 7 4.17157 7 3.58579 7.58579C3 8.17157 3 9.11438 3 11V13C3 13.4714 3 13.7071 3.14645 13.8536C3.29289 14 3.5286 14 4 14H5.64706" stroke="currentColor" stroke-width="2"/>
                        <path d="M6 20.3063L6 12C6 11.0572 6 10.5858 6.29289 10.2929C6.58579 10 7.05719 10 8 10L16 10C16.9428 10 17.4142 10 17.7071 10.2929C18 10.5858 18 11.0572 18 12L18 20.3063C18 20.6228 18 20.7811 17.8962 20.856C17.7924 20.9308 17.6422 20.8807 17.3419 20.7806L15.1581 20.0527C15.0798 20.0266 15.0406 20.0135 15 20.0135C14.9594 20.0135 14.9202 20.0266 14.8419 20.0527L12.1581 20.9473C12.0798 20.9734 12.0406 20.9865 12 20.9865C11.9594 20.9865 11.9202 20.9734 11.8419 20.9473L9.15811 20.0527C9.07975 20.0266 9.04057 20.0135 9 20.0135C8.95943 20.0135 8.92025 20.0266 8.84189 20.0527L6.65811 20.7806C6.3578 20.8807 6.20764 20.9308 6.10382 20.856C6 20.7811 6 20.6228 6 20.3063Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M18 7V5.88C18 4.87191 18 4.36786 17.8038 3.98282C17.6312 3.64413 17.3559 3.36876 17.0172 3.19619C16.6321 3 16.1281 3 15.12 3H8.88C7.87191 3 7.36786 3 6.98282 3.19619C6.64413 3.36876 6.36876 3.64413 6.19619 3.98282C6 4.36786 6 4.87191 6 5.88V7" stroke="currentColor" stroke-width="2"/>
                        <path d="M10 14L13 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M10 17L14.5 17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    {{-- <span>Imprimir </span> --}}
                </button>
            </div>
        @endif
        @if (isset($excel))
            <div class="tooltip tooltip-top p-0" data-tip="Exportar">
                <button wire:click="excelExport()"
                    class="flex items-center justify-center  p-1
                 text-sm tracking-wide text-white transition-colors
                duration-200 bg-green-500 rounded-lg sm:w-auto hover:bg-green-600 dark:hover:bg-green-500 dark:bg-green-600">
                    <svg class="h-6 w-6 text-white " fill="currentColor" viewBox="0 0 32 32"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28.781,4.405H18.651V2.018L2,4.588V27.115l16.651,2.868V26.445H28.781A1.162,1.162,0,0,0,30,25.349V5.5A1.162,1.162,0,0,0,28.781,4.405Zm.16,21.126H18.617L18.6,23.642h2.487v-2.2H18.581l-.012-1.3h2.518v-2.2H18.55l-.012-1.3h2.549v-2.2H18.53v-1.3h2.557v-2.2H18.53v-1.3h2.557v-2.2H18.53v-2H28.941Z"
                            style="fill:#20744a;fill-rule:evenodd" />
                        <rect x="22.487" y="7.439" width="4.323" height="2.2" />
                        <rect x="22.487" y="10.94" width="4.323" height="2.2" />
                        <rect x="22.487" y="14.441" width="4.323" height="2.2" />
                        <rect x="22.487" y="17.942" width="4.323" height="2.2" />
                        <rect x="22.487" y="21.443" width="4.323" height="2.2" />
                        <polygon
                            points="6.347 10.673 8.493 10.55 9.842 14.259 11.436 10.397 13.582 10.274 10.976 15.54 13.582 20.819 11.313 20.666 9.781 16.642 8.248 20.513 6.163 20.329 8.585 15.666 6.347 10.673" />
                    </svg>
                    {{-- <span>Exportar </span> --}}
                </button>
            </div>
        @endif
        @if (isset($pdf))
        <div class="tooltip tooltip-top p-0" data-tip="PDF">
            <button wire:click="pdfExport()"
                class="flex items-center justify-center p-1
                text-sm tracking-wide text-white transition-colors
                duration-200 bg-red-500 rounded-lg sm:w-auto
                hover:bg-red-600 dark:hover:bg-red-500 dark:bg-red-600">
                <svg class="h-6 w-6 " version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 512 512"  xml:space="preserve">
           <g>
               <path fill="currentColor" d="M347.746,346.204c-8.398-0.505-28.589,0.691-48.81,4.533c-11.697-11.839-21.826-26.753-29.34-39.053
                   c24.078-69.232,8.829-88.91-11.697-88.91c-16.119,0-24.167,17.011-22.376,35.805c0.906,9.461,8.918,29.34,18.78,48.223
                   c-6.05,15.912-16.847,42.806-27.564,62.269c-12.545,3.812-23.305,8.048-31.027,11.622c-38.465,17.888-41.556,41.773-33.552,51.894
                   c15.197,19.226,47.576,2.638,80.066-55.468c22.243-6.325,51.508-14.752,54.146-14.752c0.304,0,0.721,0.097,1.204,0.253
                   c16.215,14.298,35.366,30.67,51.128,32.825c22.808,3.136,35.791-13.406,34.891-23.692
                   C382.703,361.461,376.691,347.942,347.746,346.204z M203.761,408.88c-9.401,11.178-24.606,21.9-29.972,18.334
                   c-5.373-3.574-6.265-13.86,5.819-25.497c12.076-11.623,32.29-17.657,35.329-18.787c3.59-1.337,4.482,0,4.482,1.791
                   C219.419,386.512,213.154,397.689,203.761,408.88z M244.923,258.571c-0.899-11.192,1.33-21.922,10.731-23.26
                   c9.386-1.352,13.868,9.386,10.292,26.828c-3.582,17.464-5.38,29.08-7.164,30.44c-1.79,1.338-3.567-3.144-3.567-3.144
                   C251.627,282.27,245.815,269.748,244.923,258.571z M248.505,363.697c4.912-8.064,17.442-40.702,17.442-40.702
                   c2.683,4.926,23.699,29.956,23.699,29.956S257.438,360.123,248.505,363.697z M345.999,377.995
                   c-13.414-1.768-36.221-17.895-36.221-17.895c-3.128-1.337,24.992-5.157,35.79-4.466c13.875,0.9,18.794,6.718,18.794,12.53
                   C364.362,373.982,359.443,379.787,345.999,377.995z"/>
               <path fill="currentColor" d="M461.336,107.66l-98.34-98.348L353.683,0H340.5H139.946C92.593,0,54.069,38.532,54.069,85.901v6.57H41.353
                   v102.733h12.716v230.904c0,47.361,38.525,85.893,85.878,85.893h244.808c47.368,0,85.893-38.532,85.893-85.893V130.155v-13.176
                   L461.336,107.66z M384.754,480.193H139.946c-29.875,0-54.086-24.212-54.086-54.086V195.203h157.31V92.47H85.86v-6.57
                   c0-29.882,24.211-54.102,54.086-54.102H332.89v60.894c0,24.888,20.191,45.065,45.079,45.065h60.886v288.349
                   C438.855,455.982,414.636,480.193,384.754,480.193z M88.09,166.086v-47.554c0-0.839,0.683-1.524,1.524-1.524h15.108
                   c2.49,0,4.786,0.409,6.837,1.212c2.029,0.795,3.812,1.91,5.299,3.322c1.501,1.419,2.653,3.144,3.433,5.121
                   c0.78,1.939,1.182,4.058,1.182,6.294c0,2.282-0.402,4.414-1.19,6.332c-0.78,1.918-1.932,3.619-3.418,5.054
                   c-1.479,1.427-3.27,2.549-5.321,3.329c-2.036,0.78-4.332,1.174-6.822,1.174h-6.376v17.241c0,0.84-0.683,1.523-1.523,1.523h-7.208
                   C88.773,167.61,88.09,166.926,88.09,166.086z M134.685,166.086v-47.554c0-0.839,0.684-1.524,1.524-1.524h16.698
                   c3.173,0,5.968,0.528,8.324,1.568c2.386,1.062,4.518,2.75,6.347,5.009c0.944,1.189,1.694,2.504,2.236,3.916
                   c0.528,1.375,0.929,2.862,1.189,4.407c0.253,1.531,0.401,3.181,0.453,4.957c0.045,1.694,0.067,3.515,0.067,5.447
                   c0,1.924-0.022,3.746-0.067,5.44c-0.052,1.769-0.2,3.426-0.453,4.964c-0.26,1.546-0.661,3.025-1.189,4.399
                   c-0.55,1.427-1.3,2.743-2.23,3.909c-1.842,2.282-3.976,3.969-6.354,5.016c-2.334,1.04-5.135,1.568-8.324,1.568h-16.698
                   C135.368,167.61,134.685,166.926,134.685,166.086z M214.269,137.981c0.84,0,1.523,0.684,1.523,1.524v6.48
                   c0,0.84-0.683,1.524-1.523,1.524h-18.244v18.579c0,0.84-0.684,1.523-1.524,1.523h-7.209c-0.84,0-1.523-0.683-1.523-1.523v-47.554
                   c0-0.839,0.683-1.524,1.523-1.524h27.653c0.839,0,1.524,0.684,1.524,1.524v6.48c0,0.84-0.684,1.524-1.524,1.524h-18.92v11.444
                   H214.269z"/>
               <path fill="currentColor" d="M109.418,137.706c1.212-1.092,1.798-2.645,1.798-4.749c0-2.096-0.587-3.649-1.798-4.741
                   c-1.263-1.13-2.928-1.68-5.098-1.68h-5.975v12.848h5.975C106.489,139.385,108.155,138.836,109.418,137.706z"/>
               <path fill="currentColor" d="M156.139,157.481c1.13-0.424,2.103-1.107,2.973-2.088c0.944-1.055,1.538-2.571,1.769-4.511
                   c0.26-2.208,0.386-5.091,0.386-8.569c0-3.485-0.126-6.369-0.386-8.569c-0.231-1.946-0.825-3.462-1.762-4.51
                   c-0.869-0.982-1.873-1.679-2.972-2.089c-1.182-0.453-2.534-0.676-4.042-0.676h-7.164v31.68h7.164
                   C153.605,158.15,154.965,157.927,156.139,157.481z"/>
           </g>
           </svg>
                {{-- <span>Imprimir </span> --}}
            </button>
        </div>
    @endif
    </div>
</div>
