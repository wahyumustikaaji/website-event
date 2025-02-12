<x-app-layout>
    <style>
        #DataTables_Table_0_filter,
        #DataTables_Table_0_info,
        #DataTables_Table_0_paginate {
            display: none;
        }
    </style>

    <div class="relative z-10">
        <!-- Invoice -->
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
            <!-- Grid -->
            <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-neutral-700">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">{{$event->title}}</h2>
                </div>
                <!-- Col -->

                <div class="inline-flex gap-x-2">
                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        href="/event/{{ $event->slug }}">
                        Lihat Event
                        <svg class="shrink-0 size-4 rotate-45" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m12 5l6 6m-6-6l-6 6m6-6v14" />
                        </svg>
                    </a>
                </div>
                <!-- Col -->
            </div>
            <!-- End Grid -->

            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-3">
                <div>
                    <div class="grid space-y-3">

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Kategori Event:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                {{ $event->category->name }}
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Kategori Kota:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                {{$event->citycategory->name}}
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Jumlah Pendaftar:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                {{$event->participants->count()}} Pendaftar
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Jumlah Tiket:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                @if ($event->ticket_quantity == 0)
                                Habis
                                @else
                                {{ $event->ticket_quantity }} Tersedia
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- Col -->

                <div>
                    <div class="grid space-y-3">
                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Tanggal Event:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                {{$event->formatted_event_date }}
                            </dd>
                        </dl>

                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Lokasi Event:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                <span class="block font-semibold">{{$event->location_name}}</span>
                                <address class="not-italic font-normal">
                                    {{$event->address}}
                                </address>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- Col -->
            </div>
            <!-- End Grid -->

            <div class="mt-8">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Visitor Tracker</h2>
                </div>
                <div id="hs-single-area-chart"></div>

                <div class="mt-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Tracker Device</h2>
                </div>
                <div class="h-[340px] flex flex-col justify-center items-center">
                    <div id="hs-bubble-chart"></div>

                    <!-- Legend Indicator -->
                    <div class="flex justify-center sm:justify-end items-center gap-x-4">
                        @foreach ($bubbleData['browsers'] as $index => $browser)
                        @php
                        $colors = ['#3b82f6', '#22d3ee', '#e5e7eb', '#f59e0b', '#10b981']; // Warna acak untuk legend
                        $color = $colors[$index % count($colors)];
                        @endphp
                        <div class="inline-flex items-center">
                            <span class="size-2.5 inline-block rounded-sm me-2"
                                style="background-color: {{ $color }};"></span>
                            <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                                {{ $browser }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <!-- End Legend Indicator -->
                </div>
            </div>

            <div class="flex flex-col mt-8">
                <div data-hs-datatable='{
                "pageLength": 10,
                "pagingOptions": {
                  "pageBtnClasses": "min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:focus:bg-neutral-700 dark:hover:bg-neutral-700"
                },
                "selecting": true,
                "rowSelectingOptions": {
                  "selectAllSelector": "#hs-table-search-checkbox-all"
                },
                "language": {
                  "zeroRecords": "<div class=\"py-10 px-5 flex flex-col justify-center items-center text-center\"><svg class=\"shrink-0 size-6 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"11\" cy=\"11\" r=\"8\"/><path d=\"m21 21-4.3-4.3\"/></svg><div class=\"max-w-sm mx-auto\"><p class=\"mt-2 text-sm text-gray-600 dark:text-neutral-400\">Data Pendaftar Tidak Ada</p></div></div>"
                }
              }'>
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Pendaftar Event</h2>
                        </div>

                        <div class="relative max-w-xs">
                            <label for="hs-table-input-search" class="sr-only">Search</label>
                            <input type="text" name="hs-table-search" id="hs-table-input-search"
                                class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Search for items" data-hs-datatable-search="">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="size-4 text-gray-400 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="min-h-[521px] overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="border-y border-gray-200 dark:border-neutral-700">
                                        <tr>
                                            <th scope="col" class="py-1 px-3 pe-0 --exclude-from-ordering">
                                                <div class="flex items-center h-5">
                                                    <input id="hs-table-search-checkbox-all" type="checkbox"
                                                        class="border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                    <label for="hs-table-search-checkbox-all"
                                                        class="sr-only">Checkbox</label>
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="py-1 group text-start font-normal focus:outline-none">
                                                <div
                                                    class="py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200 dark:text-neutral-500 dark:hover:border-neutral-700 cursor-pointer">
                                                    Nama
                                                    <svg class="size-3.5 ms-1 -me-0.5 text-gray-400 dark:text-neutral-500"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            class="hs-datatable-ordering-desc:text-blue-600 dark:hs-datatable-ordering-desc:text-blue-500"
                                                            d="m7 15 5 5 5-5"></path>
                                                        <path
                                                            class="hs-datatable-ordering-asc:text-blue-600 dark:hs-datatable-ordering-asc:text-blue-500"
                                                            d="m7 9 5-5 5 5"></path>
                                                    </svg>
                                                </div>
                                            </th>

                                            <th scope="col"
                                                class="py-1 group text-start font-normal focus:outline-none">
                                                <div
                                                    class="py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200 dark:text-neutral-500 dark:hover:border-neutral-700 cursor-pointer">
                                                    Email
                                                    <svg class="size-3.5 ms-1 -me-0.5 text-gray-400 dark:text-neutral-500"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            class="hs-datatable-ordering-desc:text-blue-600 dark:hs-datatable-ordering-desc:text-blue-500"
                                                            d="m7 15 5 5 5-5"></path>
                                                        <path
                                                            class="hs-datatable-ordering-asc:text-blue-600 dark:hs-datatable-ordering-asc:text-blue-500"
                                                            d="m7 9 5-5 5 5"></path>
                                                    </svg>
                                                </div>
                                            </th>

                                            <th scope="col"
                                                class="py-1 group text-start font-normal focus:outline-none">
                                                <div
                                                    class="py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200 dark:text-neutral-500 dark:hover:border-neutral-700 cursor-pointer">
                                                    Tanggal Daftar
                                                    <svg class="size-3.5 ms-1 -me-0.5 text-gray-400 dark:text-neutral-500"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            class="hs-datatable-ordering-desc:text-blue-600 dark:hs-datatable-ordering-desc:text-blue-500"
                                                            d="m7 15 5 5 5-5"></path>
                                                        <path
                                                            class="hs-datatable-ordering-asc:text-blue-600 dark:hs-datatable-ordering-asc:text-blue-500"
                                                            d="m7 9 5-5 5 5"></path>
                                                    </svg>
                                                </div>
                                            </th>

                                            {{-- <th scope="col"
                                                class="py-2 px-3 text-end font-normal text-sm text-gray-500 --exclude-from-ordering dark:text-neutral-500">
                                                Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        @foreach ($eventParticipants as $participant )
                                        <tr>
                                            <td class="py-3 ps-3">
                                                <div class="flex items-center h-5">
                                                    <input id="hs-table-search-checkbox-1" type="checkbox"
                                                        class="border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        data-hs-datatable-row-selecting-individual="">
                                                    <label for="hs-table-search-checkbox-1"
                                                        class="sr-only">Checkbox</label>
                                                </div>
                                            </td>
                                            <td
                                                class="p-3 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{$participant->user->name}}</td>
                                            <td
                                                class="p-3 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                {{$participant->user->email}}</td>
                                            <td
                                                class="p-3 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                {{$participant->created_at->format('d-m-Y H:i')}}</td>
                                            {{-- <td class="p-3 whitespace-nowrap text-end text-sm font-medium">
                                                <button type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Delete</button>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="py-1 px-4 hidden" data-hs-datatable-paging="">
                        <nav class="flex items-center space-x-1">
                            <button type="button"
                                class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                data-hs-datatable-paging-prev="">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <div class="flex items-center space-x-1 [&>.active]:bg-gray-100 dark:[&>.active]:bg-neutral-700"
                                data-hs-datatable-paging-pages=""></div>
                            <button type="button"
                                class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                data-hs-datatable-paging-next="">
                                <span class="sr-only">Next</span>
                                <span aria-hidden="true">»</span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Invoice -->
    </div>

    <script>
        (function () {
        const minEl = document.querySelector('#hs-input-number-min-age');
        const maxEl = document.querySelector('#hs-input-number-max-age');
        const { dataTable } = new HSDataTable('#hs-datatable-filter');

        dataTable.search.fixed('range', function (searchStr, data, index) {
        const min = parseInt(minEl.value, 10);
        const max = parseInt(maxEl.value, 10);
        const age = parseFloat(data[2]) || 0;

        if (
        (isNaN(min) && isNaN(max)) ||
        (isNaN(min) && age <= max) || (min <=age && isNaN(max)) || (min <=age && age <=max) ) return true; return false; });
            minEl.addEventListener('input', ()=> dataTable.draw());
            maxEl.addEventListener('input', () => dataTable.draw());
            })();
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.1/dist/apexcharts.min.js"></script>
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

    <script>
        window.addEventListener('load', () => {
    const chartData = @json($chartData);

    buildChart('#hs-single-area-chart', (mode) => ({
        chart: {
        height: 300,
        type: 'area',
        toolbar: { show: false },
        zoom: { enabled: false }
        },
        series: [{
            name: 'Visitors',
            data: chartData.views
        }],
        legend: { show: false },
        dataLabels: { enabled: false },
        stroke: {
            curve: 'straight',
            width: 2
        },
        grid: { strokeDashArray: 2 },
        fill: {
            type: 'gradient',
            gradient: {
                type: 'vertical',
                shadeIntensity: 1,
                opacityFrom: 0.1,
                opacityTo: 0.8
            }
        },
        xaxis: {
            type: 'category',
            tickPlacement: 'on',
            categories: chartData.dates,
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: {
                style: {
                    colors: '#9ca3af',
                    fontSize: '13px',
                    fontFamily: 'Inter, ui-sans-serif',
                    fontWeight: 400
                },
                formatter: (title) => {
                    if (title) {
                        const newT = title.split(' ');
                        return newT[0];
                    }
                    return title;
                }
            }
        },
        yaxis: {
        min: 0,
        max: Math.ceil(Math.max(...chartData.views) + 10),
        tickAmount: Math.ceil((Math.max(...chartData.views) + 10) / 5),
        labels: {
        style: {
        colors: '#9ca3af',
        fontSize: '13px',
        fontFamily: 'Inter, ui-sans-serif',
        fontWeight: 400
        },
        formatter: (value) => Math.round(value)
        }
        },
        tooltip: {
            x: { format: 'dd MMM yyyy' },
            y: {
                formatter: (value) => `${value >= 1000 ? `${value / 1000}k` : value}`
            }
        },
        responsive: [{
            breakpoint: 568,
            options: {
                chart: { height: 300 },
                labels: {
                    style: {
                        fontSize: '11px'
                    }
                }
            }
        }]
    }), {
        colors: ['#2563eb', '#9333ea']
    });
});
    </script>

    <script>
        window.addEventListener('load', () => {
            const bubbleData = {
                browsers: @json($bubbleData['browsers']),
                totals: @json($bubbleData['totals'])
            };

            const maxSize = Math.max(...bubbleData.totals); // Ukuran maksimal untuk normalisasi

            const bubbleSeries = bubbleData.browsers.map((browser, index) => {
                return {
                    name: browser,
                    data: [[index * 2 + 1, Math.random() * 10, (bubbleData.totals[index] / maxSize) * 50 + 10]]
                };
            });

            buildChart('#hs-bubble-chart', () => ({
                chart: {
                    height: '100%',
                    type: 'bubble',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                series: bubbleSeries,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '14px',
                        fontFamily: 'Inter, ui-sans-serif',
                        fontWeight: '400',
                        colors: ['#fff']
                    },
                    formatter: (value, { seriesIndex }) => `${bubbleData.totals[seriesIndex]}`
                },
                fill: { opacity: 1 },
                legend: { show: false },
                stroke: { width: 2 },
                plotOptions: {
                    bubble: { zScaling: false, minBubbleRadius: 20, maxBubbleRadius: 60 }
                },
                grid: { show: false, padding: { top: 0, bottom: 0, left: 0, right: 0 } },
                xaxis: { min: 0, max: bubbleData.browsers.length * 2, labels: { show: false } },
                yaxis: { min: 0, max: 12, labels: { show: false } },
                tooltip: {
                    enabled: true,
                    y: { formatter: (value, { seriesIndex }) => `${bubbleData.browsers[seriesIndex]}: ${bubbleData.totals[seriesIndex]}` }
                },
                colors: ['#3b82f6', '#22d3ee', '#e5e7eb', '#f59e0b', '#10b981'].slice(0, bubbleData.browsers.length)
            }));
        });
    </script>


</x-app-layout>