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

                <div class="mt-5 mx-auto max-w-xl relative">
                    <!-- Form -->
                    <form action="{{ route('search') }}" method="GET">
                        <div
                            class="relative z-10 flex gap-x-3 p-3 bg-white border rounded-lg shadow-lg shadow-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-gray-900/20">
                            <div class="w-full">
                                <label for="search" class="block text-sm text-gray-700 font-medium dark:text-white">
                                    <span class="sr-only">Cari event disini...</span>
                                </label>
                                <input type="search" name="search" id="search"
                                    class="py-2.5 px-4 block w-full border-transparent rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Cari event disini..." value="{{ request('search') }}">
                            </div>
                            <div>
                                <button type="submit"
                                    class="size-[46px] inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.3-4.3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>

                <div class="mt-8 flex lg:flex-row flex-wrap justify-center items-center">
                    @foreach ($category as $category )
                    <a class="m-1 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        href="/category/{{ $category->slug }}">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                        </svg>
                        {{$category->name}}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Hero -->

        <!-- Card Section Acara Populer -->
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <!-- Grid -->
            <div class="grid {{$events->isEmpty() ? 'lg:grid-cols-1' : 'lg:grid-cols-2'}} lg:gap-y-16 gap-10">
                <!-- Card -->
                @if($events->isEmpty())
                <main id="content">
                    <div class="text-center py-10 px-4 sm:px-6 lg:px-8">
                        <h1 class="block text-7xl font-bold text-gray-800 lg:text-9xl dark:text-white">404</h1>
                        <p class="mt-3 text-gray-600 dark:text-neutral-400">Oops, something went wrong.</p>
                        <p class="text-gray-600 dark:text-neutral-400">Sorry, we couldn't find your page.</p>
                        <div class="mt-5 flex flex-col justify-center items-center gap-2 sm:flex-row sm:gap-3">
                            <a class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                href="/events">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6" />
                                </svg>
                                Kembali Ke Beranda
                            </a>
                        </div>
                    </div>
                </main>
                @else
                @foreach ($events as $events )
                <a class="group block rounded-xl overflow-hidden focus:outline-none" href="/event/{{ $events->slug }}">
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
            </div>
            <!-- End Grid -->

        </div>
        <!-- End Section Acara Populer -->
    </div>
</x-guest-layout>