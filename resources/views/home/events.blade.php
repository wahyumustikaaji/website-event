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
                    @foreach ($popularEvents as $events )
                    <a class="group block rounded-xl overflow-hidden focus:outline-none"
                        href="/event/{{ $events->slug }}">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                            <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
                                <img class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl"
                                    src="{{asset('storage/'.$events->image)}}" alt="Blog Image">
                            </div>

                            <div class="grow">
                                <h3
                                    class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300 dark:group-hover:text-white">
                                    {{ $events->title }}
                                </h3>
                                <p class="mt-3 text-gray-600 dark:text-neutral-400">
                                    {{ $events->formatted_event_date }}, {{ $events->formatted_event_time_start }}
                                </p>
                                <p class="mt-1 text-gray-600 dark:text-neutral-400">
                                    {{ $events->location_name }}
                                </p>
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

                    {{-- <a href=""
                        class="p-4 border border-gray-200 rounded-lg dark:border-neutral-700 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 ease-in-out">
                        <svg class="shrink-0 size-10 mb-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" width="400"
                            height="400" viewBox="0 0 32 32">
                            <g fill="currentColor">
                                <path
                                    d="M24 19a3 3 0 1 0 0-6a3 3 0 0 0 0 6m0-1a2 2 0 1 1 0-4a2 2 0 0 1 0 4m-7.5-9.25a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0m-6 4a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0M8.25 22a2.25 2.25 0 1 0 0-4.5a2.25 2.25 0 0 0 0 4.5M16 24.25a2.25 2.25 0 1 1-4.5 0a2.25 2.25 0 0 1 4.5 0" />
                                <path
                                    d="M16.2 31a16.7 16.7 0 0 1-7.84-2.622a15.05 15.05 0 0 1-6.948-9.165A13.03 13.03 0 0 1 2.859 9.22c3.757-6.2 12.179-8.033 19.588-4.256c4.419 2.255 7.724 6.191 8.418 10.03a6.8 6.8 0 0 1-1.612 6.02c-2.158 2.356-4.943 2.323-6.967 2.3h-.007c-1.345-.024-2.185 0-2.386.4c.07.308.192.604.36.873a3.916 3.916 0 0 1-.209 4.807A4.7 4.7 0 0 1 16.2 31M14.529 5a11.35 11.35 0 0 0-9.961 5.25a11.05 11.05 0 0 0-1.218 8.473a13.03 13.03 0 0 0 6.03 7.934c3.351 1.988 7.634 3.3 9.111 1.473c.787-.968.537-1.565-.012-2.622a2.84 2.84 0 0 1-.372-2.7c.781-1.54 2.518-1.523 4.2-1.5c1.835.025 3.917.05 5.472-1.649a4.91 4.91 0 0 0 1.12-4.314c-.578-3.2-3.536-6.653-7.358-8.6a15.5 15.5 0 0 0-7.01-1.74z" />
                            </g>
                        </svg>

                        <p class="font-semibold text-base text-gray-800 dark:text-neutral-200">
                            Seni & Budaya
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                            200 Acara
                        </p>
                    </a>

                    <a href=""
                        class="p-4 border border-gray-200 rounded-lg dark:border-neutral-700 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 ease-in-out">
                        <svg class="shrink-0 size-10 mb-3 text-green-500" xmlns="http://www.w3.org/2000/svg" width="400"
                            height="400" viewBox="0 0 512 512">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M433.256 101.735c29.053 30.388 40.558 72.179 34.517 111.598h-43.409c6.515-28.563-.801-59.995-21.948-82.113c-31.299-32.737-81.216-32.737-112.515 0L256 166.679l-33.902-35.46c-31.299-32.737-81.216-32.737-112.515 0c-21.147 22.119-28.463 53.551-21.948 82.114H44.227c-6.042-39.419 5.464-81.211 34.516-111.599c44.631-46.68 114.991-50.05 163.335-10.107a127 127 0 0 1 10.86 10.107l3.062 3.203l3.061-3.202c3.472-3.631 7.099-7 10.86-10.108c48.345-39.943 118.704-36.574 163.335 10.108M360.14 298.667h59.03L256 469.333L92.83 298.667h59.029L256 407.592zM192 122.964l-55.872 111.703H42.667v42.666h119.851L192 218.368l64 128.001l34.517-69.036h178.816v-42.666H311.851L288 186.964l-32 63.98z"
                                clip-rule="evenodd" />
                        </svg>

                        <p class="font-semibold text-base text-gray-800 dark:text-neutral-200">
                            Kesehatan
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                            200 Acara
                        </p>
                    </a>

                    <a href=""
                        class="p-4 border border-gray-200 rounded-lg dark:border-neutral-700 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 ease-in-out">
                        <svg class="shrink-0 size-10 mb-3 text-amber-500" xmlns="http://www.w3.org/2000/svg" width="400"
                            height="400" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M13.5 2c0 .444-.193.843-.5 1.118V5h5a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3h5V3.118A1.5 1.5 0 1 1 13.5 2M6 7a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm-4 3H0v6h2zm20 0h2v6h-2zM9 14.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m6 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3" />
                        </svg>

                        <p class="font-semibold text-base text-gray-800 dark:text-neutral-200">
                            Technology
                        </p>

                        <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                            200 Acara
                        </p>
                    </a> --}}
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
                                        <img class="size-[38px] rounded-full" src="{{$citycategory->image}}"
                                            alt="Avatar">
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