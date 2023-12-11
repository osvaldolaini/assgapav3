<div class="w-full h-full">
        <div class="flex items-center justify-between p-3">
            <div class="flex items-center space-x-1">
                <div class="-space-y-1">
                    <h2 class="text-sm font-semibold leadi">Receita vs Despesas</h2>
                </div>
            </div>
            <span title="Open options">
                <svg class="w-5 h-5" fill="currentColor" viewBox="-0.5 0 32 32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid">
                    <path d="M30.000,32.000 L23.000,32.000 C22.447,32.000 22.000,31.552 22.000,31.000 L22.000,1.000 C22.000,0.448 22.447,-0.000 23.000,-0.000 L30.000,-0.000 C30.553,-0.000 31.000,0.448 31.000,1.000 L31.000,31.000 C31.000,31.552 30.553,32.000 30.000,32.000 ZM29.000,2.000 L24.000,2.000 L24.000,30.000 L29.000,30.000 L29.000,2.000 ZM19.000,32.000 L12.000,32.000 C11.448,32.000 11.000,31.552 11.000,31.000 L11.000,17.000 C11.000,16.448 11.448,16.000 12.000,16.000 L19.000,16.000 C19.553,16.000 20.000,16.448 20.000,17.000 L20.000,31.000 C20.000,31.552 19.553,32.000 19.000,32.000 ZM18.000,18.000 L13.000,18.000 L13.000,30.000 L18.000,30.000 L18.000,18.000 ZM8.000,32.000 L1.000,32.000 C0.448,32.000 0.000,31.552 0.000,31.000 L0.000,11.000 C0.000,10.448 0.448,10.000 1.000,10.000 L8.000,10.000 C8.552,10.000 9.000,10.448 9.000,11.000 L9.000,31.000 C9.000,31.552 8.552,32.000 8.000,32.000 ZM7.000,12.000 L2.000,12.000 L2.000,30.000 L7.000,30.000 L7.000,12.000 Z"/>
                </svg>
            </span>
        </div>
        <div class="p-0 m-0 bg-white text-gray-900 w-full h-full rounded-b-md ">
            <div class="w-full h-full px-1">
                <div class="rounded-2xl px-4 py-2 flex flex-col h-full">
                    <div x-data='{
                        labels: @json($labels),
                        dconcluded: @json($enter),
                        perform: @json($out)
                    }'
                        x-init="new Chart($refs.first, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                        label: 'Receitas',
                                        data: dconcluded,
                                        borderWidth: 1,
                                        borderColor: 'rgb(75, 192, 192)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                        borderRadius: 3,
                                        borderSkipped: false,
                                    },
                                    {
                                        label: 'Despesas',
                                        data: perform,
                                        borderWidth: 1,
                                        borderColor: 'rgba(255, 99, 132)',
                                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                        borderRadius: 3,
                                        borderSkipped: false,
                                    }
                                ]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: false,
                                        text: 'Aproveitamento Geral'
                                    }
                                },
                                responsive: true,
                                scales: {
                                    y: {
                                        min: 0,
                                    }
                                }
                            },
                        });">
                        <canvas id="first" x-ref="first" ></canvas>
                    </div>
                </div>
            </div>
        </div>
</div>
