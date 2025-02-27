<x-guest-layout title="Spherevent - Temukan & Ikuti Event Seru"
    description="Spherevent adalah platform untuk menemukan dan mengikuti berbagai event menarik. Jelajahi acara terbaru, daftar dengan mudah, dan rasakan pengalaman yang tak terlupakan."
    keywords="Event, Acara, Konser, Seminar, Workshop, Festival, Komunitas, Pameran, Tiket, Event Seru"
    author="Tim Spherevent">
    <!-- Hero -->
    <div class="relative overflow-hidden">
        <!-- Gradients -->
        <div aria-hidden="true" class="flex absolute -top-96 start-1/2 transform -translate-x-1/2">
            <div
                class="bg-gradient-to-r from-violet-300/50 to-purple-100 blur-3xl w-[25rem] h-[44rem] rotate-[-60deg] transform -translate-x-[10rem] dark:from-violet-900/50 dark:to-purple-900">
            </div>
            <div
                class="bg-gradient-to-tl from-blue-50 via-blue-100 to-blue-50 blur-3xl w-[90rem] h-[50rem] rounded-fulls origin-top-left -rotate-12 -translate-x-[15rem] dark:from-indigo-900/70 dark:via-indigo-900/70 dark:to-blue-900/70">
            </div>
        </div>
        <!-- End Gradients -->

        <div class="relative z-10">
            <!-- Card Blog -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                <!-- Title -->
                <div class="max-w-2xl text-center mx-auto mb-10 lg:mb-14 mt-20 lg:mt-28">
                    <h2 class="text-2xl font-bold md:text-4xl lg:text-5xl md:leading-tight dark:text-white">Jelajahi
                        Event
                    </h2>
                    <p class="mt-1 text-gray-600 dark:text-neutral-400">We've helped some great companies brand, design
                        and get to
                        market.</p>
                </div>
                <!-- End Title -->
            </div>
            <!-- End Hero -->

            <!-- Card Section Acara Populer -->
            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
                <!-- Title -->
                <div class="flex justify-between items-start">
                    <div class="max-w-2xl mb-10">
                        <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Acara Populer</h2>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Temukan event paling
                            diminati dan
                            jangan
                            sampai
                            ketinggalan!</p>
                    </div>
                    <button type="button" onclick="window.location.href='/all-events'"
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
                <div class="grid {{$events->isEmpty() ? 'lg:grid-cols-1' : 'lg:grid-cols-2'}} lg:gap-y-16 gap-10">
                    <!-- Card -->
                    @if($popularEvents->isEmpty())
                    <main id="content">
                        <div class="text-center py-10 px-4 sm:px-6 lg:px-8">
                            <h1 class="block text-7xl font-bold text-gray-800 lg:text-9xl dark:text-white">404</h1>
                            <p class="mt-3 text-gray-600 dark:text-neutral-400">Oops, something went wrong.</p>
                            <p class="text-gray-600 dark:text-neutral-400">Sorry, we couldn't find your page.</p>
                            <div class="mt-5 flex flex-col justify-center items-center gap-2 sm:flex-row sm:gap-3">
                                <a class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    href="/events">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                    Kembali Ke Beranda
                                </a>
                            </div>
                        </div>
                    </main>
                    @else
                    @foreach ($popularEvents as $events)
                    <a class="group block rounded-xl overflow-hidden focus:outline-none"
                        href="/event/{{ $events->slug }}">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                            <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
                                <img class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl"
                                    src="{{ asset('storage/'.$events->image) }}" alt="Blog Image">
                            </div>

                            <div class="grow">
                                <h3
                                    class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300 dark:group-hover:text-white">
                                    {{ Str::limit($events->title, 78, '...') }}
                                </h3>
                                <p class="mt-3 text-gray-600 dark:text-neutral-400">
                                    {{ $events->formatted_event_date }}, {{ $events->formatted_event_time_start }}
                                </p>
                                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                                    {{ $events->location_name }}
                                </p>

                                @php
                                $now = now(); // Ambil waktu sekarang
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
                        </div>
                    </a>
                    @endforeach
                    @endif
                    <!-- End Card -->
                </div>
                <!-- End Grid -->
            </div>
            <!-- End Section Acara Populer -->

            <!-- Grid -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-10">
                <!-- Title -->
                <div class="">
                    <div class="max-w-2xl mb-10">
                        <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Jelajahi Berdasarkan
                            Kategori</h2>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">Temukan acara sesuai minatmu dan dapatkan
                            pengalaman terbaik!</p>
                    </div>
                </div>
                <!-- End Title -->

                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                    @foreach ($category->take(8) as $category)
                    <a href="/category/{{ $category->slug }}"
                        class="p-4 border border-gray-200 rounded-lg dark:border-neutral-700 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 ease-in-out">
                        {!! $category->icon !!}

                        <p class="font-semibold text-base text-gray-800 dark:text-neutral-200">
                            {{ $category->name }}
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                            {{ $category->events_count }} Acara
                        </p>
                    </a>
                    @endforeach
                </div>
            </div>
            <!-- End Grid -->

            <!-- Card Section Acara Terdekat -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-10 mx-auto">
                <!-- Title -->
                <div class="">
                    <div class="max-w-2xl mb-10">
                        <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Jelajahi Acara
                            Terdekat</h2>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">Temukan event menarik di lokasimu dan jangan
                            sampai terlewat!</p>
                    </div>
                </div>
                <!-- End Title -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                    @foreach ($citycategory->take(8) as $citycategory)
                    <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 ease-in-out focus:outline-none focus:shadow-md dark:bg-neutral-900 dark:border-neutral-800"
                        href="/city-category/{{ $citycategory->slug }}">
                        <div class="p-4 md:p-5">
                            <div class="flex justify-between items-center gap-x-3">
                                <div class="grow">
                                    <div class="flex items-center gap-x-3">
                                        <img class="size-[38px] rounded-full"
                                            src="{{asset('storage/'.$citycategory->image)}}" alt="Avatar">
                                        <div class="grow">
                                            <h3
                                                class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200 transition-all duration-300 ease-in-out">
                                                {{ $citycategory->name }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <svg class="shrink-0 size-5 text-gray-800 dark:text-neutral-200"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <!-- End Grid -->
            </div>
            <!-- End Section Acara Terdekat -->
        </div>
</x-guest-layout>