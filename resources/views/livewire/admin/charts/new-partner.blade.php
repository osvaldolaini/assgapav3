<div class="w-full h-full">
    <div class="flex items-center justify-between p-3">
        <div class="flex items-center space-x-1">
            <div class="-space-y-1">
                <h2 class="text-sm font-semibold leadi">Novos sócios por mês</h2>
            </div>
        </div>
        <span title="Open options">
            <svg class="w-5 h-5" fill="currentColor" viewBox="-0.5 0 32 32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid">
                <path
                    d="M30.000,32.000 L23.000,32.000 C22.447,32.000 22.000,31.552 22.000,31.000 L22.000,1.000 C22.000,0.448 22.447,-0.000 23.000,-0.000 L30.000,-0.000 C30.553,-0.000 31.000,0.448 31.000,1.000 L31.000,31.000 C31.000,31.552 30.553,32.000 30.000,32.000 ZM29.000,2.000 L24.000,2.000 L24.000,30.000 L29.000,30.000 L29.000,2.000 ZM19.000,32.000 L12.000,32.000 C11.448,32.000 11.000,31.552 11.000,31.000 L11.000,17.000 C11.000,16.448 11.448,16.000 12.000,16.000 L19.000,16.000 C19.553,16.000 20.000,16.448 20.000,17.000 L20.000,31.000 C20.000,31.552 19.553,32.000 19.000,32.000 ZM18.000,18.000 L13.000,18.000 L13.000,30.000 L18.000,30.000 L18.000,18.000 ZM8.000,32.000 L1.000,32.000 C0.448,32.000 0.000,31.552 0.000,31.000 L0.000,11.000 C0.000,10.448 0.448,10.000 1.000,10.000 L8.000,10.000 C8.552,10.000 9.000,10.448 9.000,11.000 L9.000,31.000 C9.000,31.552 8.552,32.000 8.000,32.000 ZM7.000,12.000 L2.000,12.000 L2.000,30.000 L7.000,30.000 L7.000,12.000 Z" />
            </svg>
        </span>
    </div>
    <div class="p-0 m-0 bg-white text-gray-900 w-full h-full rounded-b-md ">
        <div class="w-full h-full px-1">
            <div class="rounded-2xl px-4 py-2 flex flex-col h-full">
                <div x-data='{
                        data: @json($data),
                        labels: @json($labels)
                    }'
                    x-init="
                    const chartData = data;
                    const chartLabels = labels;
                    new Chart($refs.second, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Novos sócios',
                                data: data,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    min: 0,
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            // Certifique-se de acessar os dados corretamente usando chartData e chartLabels

                                            const value = chartData[context.dataIndex] || 0;
                                            return value + ' Sócios';
                                        }
                                    }
                                }
                            }
                        },
                    });">
                    <canvas id="second" x-ref="second"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
