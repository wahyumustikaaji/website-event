<x-guest-layout>
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
            <!-- Blog Article -->
            <div class="max-w-[65rem] px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-0 mx-auto mt-16 lg:mt-28">
                <div class="flex lg:flex-row flex-col items-start lg:gap-8">
                    <!-- Kolom Gambar -->
                    <div class="lg:max-w-md w-full">
                        <figure>
                            <img class="w-full h-80 object-cover rounded-xl mb-8" src="{{ $event->image }}"
                                alt="Blog Image">
                        </figure>

                        <div class="lg:block hidden">
                            <div class="mt-8">
                                <div>
                                    <h3 class="block text-xl font-bold text-gray-800 dark:text-white">Diselenggarakan
                                        Oleh
                                    </h3>
                                    <div class="border-t w-full mt-2 mb-3"></div>
                                </div>

                                <!-- Avatar Media -->
                                <div class="flex justify-between items-center mb-6">
                                    <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                                        <div class="shrink-0">
                                            <img class="size-10 rounded-full"
                                                src="{{ $event->creator->profile_photo_url}}" alt="Avatar">
                                        </div>

                                        <div class="grow">
                                            <div class="flex justify-between items-center gap-x-2">
                                                <div>
                                                    <!-- Tooltip -->
                                                    <div
                                                        class="hs-tooltip [--trigger:hover] [--placement:bottom] inline-block">
                                                        <div
                                                            class="hs-tooltip-toggle sm:mb-1 block text-start cursor-pointer">
                                                            <span
                                                                class="font-semibold text-gray-800 dark:text-neutral-200">
                                                                {{ $event->creator->name }}
                                                            </span>

                                                            <!-- Dropdown Card -->
                                                            <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 max-w-xs cursor-default bg-gray-900 divide-y divide-gray-700 shadow-lg rounded-xl dark:bg-neutral-950 dark:divide-neutral-700"
                                                                role="tooltip">
                                                                <!-- Body -->
                                                                <div class="p-4 sm:p-5">
                                                                    <div
                                                                        class="mb-2 flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                                                                        <div class="shrink-0">
                                                                            <img class="size-8 rounded-full"
                                                                                src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                                                                alt="Avatar">
                                                                        </div>

                                                                        <div class="grow">
                                                                            <p
                                                                                class="text-lg font-semibold text-gray-200 dark:text-neutral-200">
                                                                                {{ $event->creator->name }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <p
                                                                        class="text-sm text-gray-400 dark:text-neutral-400">
                                                                        Leyla is a Customer Success Specialist at
                                                                        Preline
                                                                        and spends her time speaking
                                                                        to in-house recruiters all over the world.
                                                                    </p>
                                                                </div>
                                                                <!-- End Body -->
                                                            </div>
                                                            <!-- End Dropdown Card -->
                                                        </div>
                                                    </div>
                                                    <!-- End Tooltip -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Avatar Media -->
                            </div>

                            <div class="mt-8">
                                <div>
                                    <h3 class="block text-xl font-bold text-gray-800 dark:text-white">{{
                                        $event->participants->count() }} Peserta
                                        Terdaftar
                                    </h3>
                                    <div class="border-t w-full mt-2 mb-3"></div>
                                </div>

                                <div class="flex -space-x-2">
                                    @foreach ($event->participants as $participant)
                                    <div class="hs-tooltip inline-block">
                                        <img class="hs-tooltip-toggle relative inline-block size-10 rounded-full ring-2 ring-white hover:z-10 dark:ring-neutral-900"
                                            src="{{ $participant->user->avatar_url }}" alt="Avatar">
                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 text-xs text-white rounded-lg dark:bg-neutral-700"
                                            role="tooltip">
                                            {{ $participant->user->name }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                                <p class="text-sm text-gray-500 dark:text-neutral-500 mt-3">
                                    @foreach ($event->participants->take(2) as $index => $participant)
                                    <span>{{ $participant->user->name }}</span>
                                    @if ($index == 0)
                                    ,
                                    @endif
                                    @endforeach
                                    @if ($event->participants->count() > 2)
                                    dan {{ $event->participants->count() - 2 }} lainnya
                                    @endif
                                </p>
                            </div>

                            <div class="mt-8">
                                <a class="inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                    href="/category/{{ $category->slug }}">
                                    # {{ $event->category->name }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Konten -->
                    <div class="w-full">
                        <h2 class="text-4xl md:text-5xl font-bold dark:text-white">
                            {{ $event->title }}
                        </h2>
                        <!-- Card Date -->
                        <div class="flex items-center gap-x-3 mt-8">
                            <div class="p-2.5 rounded-full border border-gray-200 shadow">
                                <svg class="text-gray-400" xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                    viewBox="0 0 48 48">
                                    <defs>
                                        <mask id="ipSCalendar0">
                                            <g fill="none" stroke-linejoin="round" stroke-width="4">
                                                <path fill="#fff" stroke="#fff"
                                                    d="M5 19h38v21a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2z" />
                                                <path stroke="#fff" d="M5 9a2 2 0 0 1 2-2h34a2 2 0 0 1 2 2v10H5z" />
                                                <path stroke="#fff" stroke-linecap="round" d="M16 4v8m16-8v8" />
                                                <path stroke="#000" stroke-linecap="round"
                                                    d="M28 34h6m-20 0h6m8-8h6m-20 0h6" />
                                            </g>
                                        </mask>
                                    </defs>
                                    <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipSCalendar0)" />
                                </svg>
                            </div>
                            <div class="grow">
                                <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">{{
                                    $event->formatted_event_date }}</h4>
                                <p class="text-sm text-gray-500 dark:text-neutral-500">{{
                                    $event->formatted_event_time_start
                                    }} - {{
                                    $event->formatted_event_time_end
                                    }}
                                </p>
                            </div>
                        </div>
                        <!-- End Card Date -->

                        <!-- Card Location -->
                        <div class="flex items-center gap-x-3 mt-5">
                            <div class="p-2.5 rounded-full border border-gray-200 shadow">
                                <svg class="text-gray-400" xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 11.5A2.5 2.5 0 0 1 9.5 9A2.5 2.5 0 0 1 12 6.5A2.5 2.5 0 0 1 14.5 9a2.5 2.5 0 0 1-2.5 2.5M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7" />
                                </svg>
                            </div>
                            <div class="grow">
                                <a target="_blank"
                                    href="https://www.google.com/maps?q={{ urlencode($event->location_name) }}+{{ urlencode($event->address) }}"
                                    class="font-medium group text-lg text-gray-800 dark:text-neutral-200 flex items-center gap-1">{{
                                    $event->location_name
                                    }}
                                    <svg class="rotate-45 text-gray-400 group-hover:text-black group-hover:scale-105 transition-all duration-300 ease-in-out"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M13 7.828V20h-2V7.828l-5.364 5.364l-1.414-1.414L12 4l7.778 7.778l-1.414 1.414z" />
                                    </svg>
                                </a>
                                <p class="text-sm text-gray-500 dark:text-neutral-500">{{ Str::limit($event->address,
                                    70, '...') }}
                                </p>
                            </div>
                        </div>
                        <!-- End Card Location -->

                        <form>
                            <div class="mt-8">
                                <!-- Card -->
                                <div
                                    class="p-4 sm:p-7 flex flex-col bg-white border rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:bg-neutral-900">
                                    <div class="">
                                        <h1 class="block text-xl font-bold text-gray-800 dark:text-white">Pendaftaran
                                        </h1>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                            Selamat datang! Untuk bergabung dengan acara, silakan mendaftar di bawah
                                            ini.
                                        </p>
                                    </div>

                                    <div class="mt-5">
                                        <button type="submit"
                                            class="w-full py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Daftar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        </form>

                        <div class="mt-8">
                            <div>
                                <h2 class="block text-xl font-bold text-gray-800 dark:text-white">Tentang Acara
                                </h2>
                                <div class="border-t w-full mt-2 mb-3"></div>
                            </div>
                            <p class="text-base text-gray-800 dark:text-neutral-200">{{ $event->body }}</p>
                        </div>

                        <div class="mt-8">
                            <div>
                                <h3 class="block text-xl font-bold text-gray-800 dark:text-white">Lokasi
                                </h3>
                                <div class="border-t w-full mt-2 mb-3"></div>
                            </div>

                            <p class="block text-base font-bold text-gray-800 dark:text-white mb-1">{{
                                $event->location_name }}
                            </p>
                            <p class="text-base text-gray-800 dark:text-neutral-200 mb-3">{{ $event->address }}</p>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.4913164089!2d106.66470501931336!3d-6.229720928900819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1738656582035!5m2!1sid!2sid"
                                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="lg:hidden">
                        <div class="mt-8">
                            <div>
                                <h3 class="block text-xl font-bold text-gray-800 dark:text-white">Diselenggarakan
                                    Oleh
                                </h3>
                                <div class="border-t w-full mt-2 mb-3"></div>
                            </div>

                            <!-- Avatar Media -->
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                                    <div class="shrink-0">
                                        <img class="size-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                            alt="Avatar">
                                    </div>

                                    <div class="grow">
                                        <div class="flex justify-between items-center gap-x-2">
                                            <div>
                                                <!-- Tooltip -->
                                                <div
                                                    class="hs-tooltip [--trigger:hover] [--placement:bottom] inline-block">
                                                    <div
                                                        class="hs-tooltip-toggle sm:mb-1 block text-start cursor-pointer">
                                                        <span class="font-semibold text-gray-800 dark:text-neutral-200">
                                                            {{ $event->creator->name }}
                                                        </span>

                                                        <!-- Dropdown Card -->
                                                        <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 max-w-xs cursor-default bg-gray-900 divide-y divide-gray-700 shadow-lg rounded-xl dark:bg-neutral-950 dark:divide-neutral-700"
                                                            role="tooltip">
                                                            <!-- Body -->
                                                            <div class="p-4 sm:p-5">
                                                                <div
                                                                    class="mb-2 flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                                                                    <div class="shrink-0">
                                                                        <img class="size-8 rounded-full"
                                                                            src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                                                            alt="Avatar">
                                                                    </div>

                                                                    <div class="grow">
                                                                        <p
                                                                            class="text-lg font-semibold text-gray-200 dark:text-neutral-200">
                                                                            {{ $event->creator->name }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <p class="text-sm text-gray-400 dark:text-neutral-400">
                                                                    Leyla is a Customer Success Specialist at
                                                                    Preline
                                                                    and spends her time speaking
                                                                    to in-house recruiters all over the world.
                                                                </p>
                                                            </div>
                                                            <!-- End Body -->
                                                        </div>
                                                        <!-- End Dropdown Card -->
                                                    </div>
                                                </div>
                                                <!-- End Tooltip -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Avatar Media -->
                        </div>

                        <div class="mt-8">
                            <div>
                                <h3 class="block text-xl font-bold text-gray-800 dark:text-white">{{
                                    $event->participants->count() }} Peserta
                                    Terdaftar
                                </h3>
                                <div class="border-t w-full mt-2 mb-3"></div>
                            </div>

                            <div class="flex -space-x-2">
                                @foreach ($event->participants as $participant)
                                <div class="hs-tooltip inline-block">
                                    <img class="hs-tooltip-toggle relative inline-block size-10 rounded-full ring-2 ring-white hover:z-10 dark:ring-neutral-900"
                                        src="{{ $participant->user->avatar_url }}" alt="Avatar">
                                    <span
                                        class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 text-xs text-white rounded-lg dark:bg-neutral-700"
                                        role="tooltip">
                                        {{ $participant->user->name }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                            <p class="text-sm text-gray-500 dark:text-neutral-500 mt-3">
                                @foreach ($event->participants->take(2) as $index => $participant)
                                <span>{{ $participant->user->name }}</span>
                                @if ($index == 0)
                                ,
                                @endif
                                @endforeach
                                @if ($event->participants->count() > 2)
                                dan {{ $event->participants->count() - 2 }} lainnya
                                @endif
                            </p>
                        </div>

                        <div class="mt-8">
                            <a class="inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                href="/category/{{ $category->slug }}">
                                # {{ $event->category->name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
</x-guest-layout>