<x-app-layout>
    <div class="relative z-10">
        <!-- Title -->
        <div class="max-w-2xl mb-5 {{$myevents->isEmpty() ? 'hidden' : ''}}">
            <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Semua Acara</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Buat event paling
                diminati dan
                jangan
                lupa disebarkan!</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid {{$myevents->isEmpty() ? 'lg:grid-cols-1' : 'lg:grid-cols-2'}} lg:gap-y-16 gap-10">
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
                        <a href="/event/{{ $events->slug }}" class=" text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300
                            dark:group-hover:text-white hover:underline">
                            {{ $events->title }}
                        </a>
                        <p class="mt-3 text-gray-600 dark:text-neutral-400">
                            {{ $events->formatted_event_date }}, {{ $events->formatted_event_time_start }}
                        </p>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">
                            {{ $events->location_name }}
                        </p>
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
                                    href="#">
                                    Edit
                                </a>
                                <a class="flex items-center gap-x-2 py-2 px-4 rounded-lg text-sm font-medium
                                           bg-red-500 text-white shadow-md transition-all
                                           hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400
                                           active:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700
                                           dark:focus:ring-red-500" href="#">
                                    Delete
                                </a>
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
</x-app-layout>