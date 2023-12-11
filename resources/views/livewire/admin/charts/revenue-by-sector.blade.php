<div class="w-full h-full">
    <div class="flex items-center justify-between p-3">
        <div class="flex items-center space-x-1">
            <div class="-space-y-1">
                <h2 class="text-sm font-semibold leadi">Gastos por setor (últimos 30 dias)</h2>
            </div>
        </div>
        <span title="Open options">
            <svg class="w-5 h-5" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-516.000000, -151.000000)" fill="currentColor">
                        <path d="M544.551,172.613 L531,168 L531,153 C538.779,152.961 545.889,159.682 545.889,167.571 C545.889,169.629 545.351,171.19 544.551,172.613 L544.551,172.613 Z M530.5,181 C523.597,181 518,175.404 518,168.5 C518,162.21 522.917,156.878 529,156 L529,169.429 L541.709,173.855 C540.018,178.128 535.163,181 530.5,181 L530.5,181 Z M531,151 L529,151 L529,154 C521.721,154.789 516,161.026 516,168.5 C516,176.508 522.492,183 530.5,183 C536.406,183 541.479,179.463 543.738,174.397 L546,175 C547.093,173.205 548,170.657 548,167.571 C548,158.419 540.005,151 531,151 L531,151 Z" id="pie-chart" sketch:type="MSShapeGroup">

            </path>
                    </g>
                </g>
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
                    new Chart($refs.third, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            // Certifique-se de acessar os dados corretamente usando chartData e chartLabels
                                            const value = chartData[context.dataIndex] || 0;
                                            return value + '%';
                                        }
                                    }
                                }
                            }

                        },
                    });">
                    <canvas id="third" x-ref="third"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
