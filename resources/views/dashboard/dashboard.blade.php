<x-app-layout>
    <div class="relative z-10">
        <!-- Title -->
        <div class="max-w-2xl mb-5">
            <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Halo, {{$user->name}}</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Buat event paling
                diminati dan
                jangan
                lupa disebarkan!</p>
        </div>
        <!-- End Title -->

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Card -->
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                            Total Acara
                        </p>
                        <div class="hs-tooltip">
                            <div class="hs-tooltip-toggle">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                    <path d="M12 17h.01"></path>
                                </svg>
                                <span
                                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                                    role="tooltip" data-popper-placement="top"
                                    style="position: fixed; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(317.5px, -843.5px, 0px);">
                                    Total acara dibuat
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                            {{ number_format($totalEvents) }}
                        </h3>
                    </div>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                            Tiket Saya
                        </p>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                            {{ number_format($myTickets) }}
                        </h3>
                    </div>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                            Event Berlangsung
                        </p>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                            {{ number_format($ongoingEvents) }}
                        </h3>
                    </div>
                </div>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                            Pageviews
                        </p>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                            {{ number_format($pageViews) }}
                        </h3>
                        <span class="text-{{ $pageViewsPercentageChange >= 0 ? 'green' : 'red' }}-600">
                            @if ($pageViewsPercentageChange >= 0)
                            <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                                <polyline points="16 7 22 7 22 13"></polyline>
                            </svg>
                            @else
                            <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline>
                                <polyline points="16 17 22 17 22 11"></polyline>
                            </svg>
                            @endif
                            {{ number_format(abs($pageViewsPercentageChange), 1) }}%
                        </span>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>

        <!-- Title -->
        <div class="w-full mb-5 mt-14 {{$myevents->isEmpty() ? 'hidden' : ''}} flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Daftar Event</h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Buat event paling
                    diminati dan
                    jangan
                    lupa disebarkan!</p>
            </div>
            <button type="button" onclick="window.location.href='/event-create'"
                class="py-1.5 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-200 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 transition-all duration-300 ease-in-out">
                Lihat Semua
                <svg class="size-4 rotate-90" xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                    viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="48" d="m112 244l144-144l144 144M256 120v292" />
                </svg>
            </button>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid {{$myevents->isEmpty() ? 'lg:grid-cols-1' : 'lg:grid-cols-2'}} lg:gap-y-10 gap-10">
            <!-- Card -->
            @if ($myevents->isEmpty())
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16 mt-20 lg:mt-28">
                <div class="max-w-2xl text-center mx-auto">

                    <!-- Title -->
                    <div class="mt-5 max-w-2xl">
                        <h1
                            class="block font-semibold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200 ">
                            Belum Ada Event Yang Dibuat
                        </h1>
                    </div>
                    <!-- End Title -->

                    <div class="mt-5 max-w-3xl">
                        <p class="text-lg text-gray-600 dark:text-neutral-400">Kami menyediakan platform terbaik untuk
                            merancang dan mewujudkan. Dari konsep hingga pelaksanaan, semua
                            dimulai di sini. Mulai buat acara yang menginspirasi!</p>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-12 gap-3 flex justify-center">
                        <a class="py-3 px-4 w-full max-w-md inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            href="/create-event">
                            Mulai Buat Event
                        </a>
                    </div>
                    <!-- End Buttons -->
                </div>
            </div>
            @else
            @foreach ($myevents as $events )
            <div
                class="group block rounded-xl overflow-hidden relative focus:outline-none border shadow-[0_8px_30px_rgb(0,0,0,0.12)] bg-white">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                    <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
                        <img class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl"
                            src="{{asset('storage/'.$events->image)}}" alt="Blog Image">
                    </div>

                    <div class="grow">
                        <a href="/detail-event/{{ $events->slug }}" class=" text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300
                                    dark:group-hover:text-white hover:underline">
                            {{ Str::limit($events->title, 60, '...') }}
                        </a>
                        <p class="mt-3 text-gray-600 dark:text-neutral-400">
                            {{ $events->formatted_event_date }}, {{ $events->formatted_event_time_start }}
                        </p>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">
                            {{ $events->location_name }}
                        </p>

                        @php
                        $now = now();
                        $eventStart = \Carbon\Carbon::parse($events->event_date . ' ' . $events->start_time);
                        $eventEnd = \Carbon\Carbon::parse($events->end_date . ' ' . $events->end_time);
                        @endphp

                        @if ($now->greaterThan($eventEnd))
                        <div>
                            <span
                                class="py-1 mt-2 px-2 inline-flex items-center gap-x-1 text-sm font-medium bg-red-100 text-red-600 rounded-md dark:bg-red-500/10 dark:text-red-500">
                                Event Selesai
                            </span>
                        </div>
                        @elseif ($now->between($eventStart, $eventEnd))
                        <div>
                            <span
                                class="py-1 px-2 mt-2 inline-flex items-center gap-x-1 text-sm font-medium bg-yellow-100 text-yellow-600 rounded-md dark:bg-yellow-100 dark:text-yellow-600">
                                <span class="relative flex size-2">
                                    <span
                                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-yellow-500 opacity-75"></span>
                                    <span class="relative inline-flex size-2 rounded-full bg-yellow-600"></span>
                                </span>
                                Berlangsung
                            </span>
                        </div>
                        @elseif ($events->ticket_quantity == 0)
                        <div>
                            <span
                                class="py-1 px-2 mt-2 inline-flex items-center gap-x-1 text-sm font-medium bg-red-100 text-red-600 rounded-md dark:bg-red-500/10 dark:text-red-500">
                                Tiket Habis
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="absolute right-2 top-2 z-10">
                        <div
                            class="hs-dropdown [--strategy:absolute] [--flip:false] hs-dropdown-example relative inline-flex">
                            <button id="hs-dropdown-example" type="button"
                                class="hs-dropdown-toggle inline-flex items-center gap-x-2 text-sm font-medium bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                    <path fill="currentColor"
                                        d="M14 10.25a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0m-5 0a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0m-5 0a1.249 1.249 0 1 1 2.5 0a1.25 1.25 0 1 1-2.5 0" />
                                </svg>
                            </button>

                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 mt-2 min-w-40 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.12)] rounded-lg p-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-example">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 mb-1"
                                    href="/event/{{ $events->slug }}">
                                    Preview
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 mb-1"
                                    href="{{ route('event.edit', $events->slug) }}">
                                    Edit
                                </a>
                                <button
                                    class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-medium bg-red-500 text-white shadow-md transition-all hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 active:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-500"
                                    data-id="{{ $events->slug }}" data-hs-overlay="#hs-danger-alert"
                                    onclick="showDeleteModal(this)">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!-- End Card -->
        </div>
        <!-- End Grid -->

    </div>

    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function tostifyCustomClose(el) {
            const parent = el.closest('.toastify');
        }

        document.addEventListener('DOMContentLoaded', function() {
            Toastify({
                text: `
                    <!-- Toast -->
                    <div id="dismiss-toast"
                        class="hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 max-w-xs bg-green-500 border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700"
                        role="alert" tabindex="-1" aria-labelledby="hs-toast-dismiss-button-label">
                        <div class="flex p-4">
                            <p id="hs-toast-dismiss-button-label" class="text-sm text-white dark:text-neutral-400">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                    <!-- End Toast -->
                `,
                className: "hs-toastify-on:opacity-100 opacity-0 fixed left-1/2 -translate-x-1/2 z-[90] transition-all duration-300 ease-in-out",
                duration: 3000,
                escapeMarkup: false,
                gravity: "top",
                position: "right",
            }).showToast();
        });
    </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function showDeleteModal(button) {
            let slug = button.getAttribute("data-id");
            let deleteForm = document.getElementById("delete-form");

            if (deleteForm) {
            deleteForm.action = `/event/${slug}`;
            }

            let modal = document.getElementById("hs-danger-alert");
            if (modal) {
            modal.classList.remove("hidden");
            }
            }

            let cancelButton = document.getElementById("cancel-delete");
            if (cancelButton) {
            cancelButton.addEventListener("click", function () {
            let modal = document.getElementById("hs-danger-alert");
            if (modal) {
            modal.classList.add("hidden");
            }
            });
            }

            window.showDeleteModal = showDeleteModal;
            });
    </script>
</x-app-layout>