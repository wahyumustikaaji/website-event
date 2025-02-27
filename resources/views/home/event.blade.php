<x-guest-layout title="{{ $event->title }}" description="{{ $event->body }}" keywords="{{$event->category->name}}"
    author="{{$event->creator->name}}" image="{{asset('storage/'.$event->image)}}">

    <style>
        #description-event h1 {
            font-size: 1.5rem;
            /* Ukuran besar untuk heading utama */
            font-weight: bold;
            color: #1a202c;
            /* Warna gelap */
            margin-bottom: 1rem;
        }

        #description-event h2 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #2d3748;
            /* Warna sedikit lebih terang */
            margin-bottom: 0.75rem;
        }

        #description-event h3 {
            font-size: 1rem;
            font-weight: bold;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        #description-event ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        #description-event ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        #description-event li {
            margin-bottom: 0.5rem;
        }

        #description-event a {
            color: #3182ce;
            /* Warna biru untuk tautan */
            text-decoration: underline;
            transition: color 0.3s;
        }

        #description-event a:hover {
            color: #2b6cb0;
            /* Warna lebih gelap saat hover */
        }

        #description-event blockquote {
            font-style: italic;
            border-left: 4px solid #3182ce;
            padding-left: 1rem;
            color: #555;
            margin-bottom: 1rem;
        }

        #description-event img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        #description-event strong {
            font-weight: bold;
            color: #222;
        }

        #description-event em {
            font-style: italic;
        }
    </style>

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
                            <img class="w-full h-[28rem] object-cover rounded-xl mb-8"
                                src="{{asset('storage/'.$event->image)}}" alt="Blog Image">
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
                                                src="{{ $event->creator->profile ? asset($event->creator->profile) : asset('image/profile/default.png') }}"
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
                                                                                src="{{ $event->creator->profile ? asset($event->creator->profile) : asset('image/profile/default.png') }}"
                                                                                alt="Avatar">
                                                                        </div>

                                                                        <div class="grow">
                                                                            <p
                                                                                class="text-lg font-semibold text-gray-200 dark:text-neutral-200">
                                                                                {{ $event->creator->name }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
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
                                    @foreach ($event->participants->take(7) as $participant)
                                    <div class="hs-tooltip inline-block">
                                        <img class="hs-tooltip-toggle relative inline-block size-10 rounded-full ring-2 ring-white hover:z-10 dark:ring-neutral-900"
                                            src="{{ $participant->user->profile ? asset($participant->user->profile) : asset('image/profile/default.png') }}"
                                            alt="Avatar">
                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 text-xs text-white rounded-lg dark:bg-neutral-700"
                                            role="tooltip">
                                            {{ $participant->user->name }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                                <p class="text-sm text-gray-500 dark:text-neutral-500 mt-3">
                                    @if ($event->participants->count() > 2)
                                    @foreach ($event->participants->take(2) as $index => $participant)
                                    <span>{{ $participant->user->name }}</span>
                                    @if ($index == 0)
                                    ,
                                    @endif
                                    @endforeach
                                    @if ($event->participants->count() > 2)
                                    dan {{ $event->participants->count() - 2 }} lainnya
                                    @endif
                                    @endif
                                </p>
                            </div>

                            <div class="mt-8 flex items-center justify-between">
                                <a class="inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                    href="/category/{{ $category->slug }}">
                                    # {{ $event->category->name }}
                                </a>

                                <div id="notification-success-copylink" role="alert"
                                    class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-slate-100 text-black px-6 py-2 rounded-lg shadow-lg z-40 hidden">
                                    Link berhasil disalin!
                                </div>

                                <!-- Button -->
                                <div class="hs-dropdown relative inline-flex">
                                    <button id="hs-blog-article-share-dropdown" type="button"
                                        class="hs-dropdown-toggle flex items-center gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                            <polyline points="16 6 12 2 8 6" />
                                            <line x1="12" x2="12" y1="2" y2="15" />
                                        </svg>
                                        Share
                                    </button>
                                    <div class="hs-dropdown-menu w-56 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mb-1 z-40 bg-gray-900 shadow-md rounded-xl p-2 dark:bg-black"
                                        role="menu" aria-orientation="vertical"
                                        aria-labelledby="hs-blog-article-share-dropdown">
                                        <a onclick="copyLink()"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            href="javascript:void(0)">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                                <path
                                                    d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                            </svg>
                                            Copy link
                                        </a>
                                        <div class="border-t border-gray-600 my-2 dark:border-neutral-800"></div>
                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            id="share-twitter" href="#" target="_blank">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                            </svg>
                                            Share on Twitter
                                        </a>

                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            id="share-facebook" href="#" target="_blank">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                            </svg>
                                            Share on Facebook
                                        </a>

                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:bg-white/10 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:focus:bg-neutral-900"
                                            id="share-linkedin" href="#" target="_blank">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                            </svg>
                                            Share on LinkedIn
                                        </a>
                                    </div>
                                </div>
                                <!-- Button -->
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Konten -->
                    <div class="w-full">
                        <div class="">
                            <a class="inline-flex items-center gap-1.5 py-1 px-3 rounded-md text-sm bg-gray-300/50 text-gray-500 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                href="/city-category/{{ $citycategory->slug }}">
                                <div class="flex items-center space-x-1">
                                    <div>
                                        Ditampilkan di <span class="font-semibold text-gray-800">{{
                                            $event->citycategory->name
                                            }}</span>
                                    </div>
                                    <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-200"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </a>
                        </div>

                        <h2 class="text-4xl md:text-5xl font-bold dark:text-white mt-2">
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

                        @if(session('success'))
                        <div id="notification-success" role="alert"
                            class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-green-500 text-white px-6 py-2 rounded-lg shadow-lg z-40">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div id="notification-error" role="alert"
                            class="fixed bottom-8 left-1/2 -translate-x-1/2 text-red-700 bg-red-100 px-6 py-2 rounded-lg shadow-lg z-40">
                            {{ session('error') }}
                        </div>
                        @endif

                        @php
                        $endDateTime = \Carbon\Carbon::parse($event->end_date . ' ' . $event->end_time);
                        $startDateTime = \Carbon\Carbon::parse($event->event_date . ' ' . $event->start_time);
                        $now = \Carbon\Carbon::now();

                        $isExpired = $endDateTime->isPast();
                        $isOngoing = $now->greaterThanOrEqualTo($startDateTime) && $now->lessThan($endDateTime);
                        @endphp

                        <form action="{{ route('event.register', $event->slug) }}" method="POST">
                            @csrf
                            <div class="mt-8">
                                <div
                                    class="p-4 sm:p-7 flex flex-col bg-white border rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:bg-neutral-900">
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <p
                                                class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                                                @if ($isExpired || $event->ticket_quantity == 0)
                                                <svg class="size-6" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M12 23c6.075 0 11-4.925 11-11S18.075 1 12 1 1 5.925 1 12s4.925 11 11 11M7 10a2 2 0 1 0 0 4h10a2 2 0 1 0 0-4z">
                                                    </path>
                                                </svg>
                                                Pendaftaran Ditutup
                                                @elseif($event->price_ticket > 0)
                                                Dapatkan Tiket
                                                @elseif($event->requires_approval && $event->price_ticket == 0)
                                                <span class="bg-gray-100 p-2 rounded-full">
                                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 16 16">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <path fill="currentColor" fill-rule="nonzero"
                                                                d="m5.029 8.556-.001-.003C5.028 7.5 3.3 7 3.3 4.4 3.3 1.987 5.164 0 7.5 0s4.2 1.987 4.2 4.4c0 2.041-1.065 3.437-1.523 3.943.285-.292.69-.707-.028.031q-.104.111-.15.154l-.027.028C8.666 9.896 6.5 10.5 7.5 13s.86 3 0 3c-2.036 0-7 .066-7-3.09 0-2.745 4.529-2.823 4.529-4.354">
                                                            </path>
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.5"
                                                                d="m9.5 11.722 1.454 1.778 3.546-4"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                                Persetujuan Diperlukan
                                                @else
                                                Pendaftaran
                                                @endif
                                            </p>

                                            <div>
                                                @if ($isExpired)
                                                <div>
                                                    <span
                                                        class="py-1 px-2 inline-flex items-center gap-x-1 text-sm font-medium bg-red-100 text-red-600 rounded-md dark:bg-red-500/10 dark:text-red-500">
                                                        Event Selesai
                                                    </span>
                                                </div>
                                                @elseif ($isOngoing)
                                                <div>
                                                    <span
                                                        class="py-1 px-2 inline-flex items-center gap-x-1 text-sm font-medium bg-yellow-100 text-yellow-600 rounded-md dark:bg-yellow-100 dark:text-yellow-600">
                                                        <span class="relative flex size-2">
                                                            <span
                                                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-yellow-500 opacity-75"></span>
                                                            <span
                                                                class="relative inline-flex size-2 rounded-full bg-yellow-600"></span>
                                                        </span>
                                                        Berlangsung
                                                    </span>
                                                </div>
                                                @elseif ($event->ticket_quantity == 0)
                                                <div>
                                                    <span
                                                        class="py-1 px-2 inline-flex items-center gap-x-1 text-sm font-medium bg-red-100 text-red-600 rounded-md dark:bg-red-500/10 dark:text-red-500">
                                                        Tiket Habis
                                                    </span>
                                                </div>
                                                @elseif ($event->ticket_quantity <= 10) <div>
                                                    <span
                                                        class="py-1 px-2 inline-flex items-center gap-x-1 text-sm font-medium bg-yellow-100 text-yellow-600 rounded-md dark:bg-yellow-100 dark:text-yellow-600">
                                                        Hampir Penuh
                                                    </span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="border-t w-full mt-2 mb-3"></div>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                        @if ($isExpired || $event->ticket_quantity == 0)
                                        Acara saat ini tidak menerima pendaftaran. Anda dapat menghubungi pihak
                                        penyelenggara
                                        atau berlangganan untuk menerima
                                        pembaruan.
                                        @elseif($event->price_ticket > 0)
                                        Selamat datang! Untuk bergabung dengan acara, silakan dapatkan tiket Anda di
                                        bawah ini.
                                        @else
                                        Selamat datang! Untuk bergabung dengan acara, silakan mendaftar di bawah
                                        ini.
                                        @endif
                                    </p>

                                    @if(!$isExpired && $event->price_ticket > 0 && $event->requires_approval == 1 &&
                                    $event->ticket_quantity > 0)
                                    <div
                                        class="w-full whitespace-nowrap my-2 py-2 px-2.5 gap-x-2 text-base font-semibold rounded-md border border-transparent bg-gray-100 text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-white dark:text-neutral-800 dark:hover:bg-neutral-200">
                                        <div class="flex justify-between items-center">
                                            <span>Harga Tiket</span>
                                            <span>Rp {{ number_format($event->price_ticket, 0, ',', '.') }}</span>
                                        </div>

                                        <div
                                            class="mt-2 text-sm font-medium flex items-center text-amber-600 dark:text-amber-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Memerlukan persetujuan dari penyelenggara
                                        </div>
                                    </div>
                                    @endif

                                    @if(
                                    !$isExpired &&
                                    $event->price_ticket > 0 &&
                                    $event->requires_approval == 0 &&
                                    $event->ticket_quantity > 0
                                    )
                                    <div
                                        class="w-full whitespace-nowrap my-2 py-2 px-2.5 gap-x-2 text-base font-semibold rounded-md border border-transparent bg-gray-100 text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-white dark:text-neutral-800 dark:hover:bg-neutral-200">
                                        <div class="flex justify-between items-center">
                                            <span>Harga Tiket</span>
                                            <span>Rp {{ number_format($event->price_ticket, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    @if(!$isExpired && $event->requires_approval && $event->price_ticket == 0 )
                                    <div
                                        class="mb-2 text-sm font-medium flex items-center text-amber-600 dark:text-amber-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4 mr-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Memerlukan persetujuan dari penyelenggara
                                    </div>
                                    @endif

                                    @if (!$isExpired && Auth::check())
                                    <div class="flex items-center gap-2 mt-4">
                                        <div class="shrink-0">
                                            <img class="size-5 rounded-full"
                                                src="{{ Auth::user()->profile ? asset(Auth::user()->profile) : asset('image/profile/default.png') }}"
                                                alt="Avatar">
                                        </div>

                                        <div class="grow">
                                            <p class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ Auth::user()->name }}
                                                <span class="text-gray-500 font-normal">{{ Auth::user()->email }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                @if ($isRegistered)
                                @if ($isApproved)
                                <button type="button"
                                    onclick="window.location.href='{{ route('ticket', [$event->slug, app(App\Http\Controllers\EventController::class)->generateTicketCode(auth()->id(), $event->id)]) }}'"
                                    class="w-full py-2.5 px-4 mt-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700 transition-colors">
                                    Lihat Tiket
                                </button>
                                @else
                                <div class="flex flex-col gap-2">
                                    @if ($event->requires_approval)
                                    <a href="{{ route('event.cancel-registration', $event->slug) }}"
                                        class="w-full py-2.5 mt-2 px-4 bg-red-600 text-white text-center rounded-lg hover:bg-red-700 transition-colors">
                                        Batalkan Pendaftaran
                                    </a>
                                    @endif
                                </div>
                                @endif
                                @elseif ($isExpired)
                                {{-- Tidak menampilkan tombol jika event sudah berakhir --}}
                                @elseif ($event->ticket_quantity == 0)
                                {{-- Tidak menampilkan tombol jika tiket habis --}}
                                @elseif (Auth::check())
                                @if ($event->creator_id == Auth::id())
                                <button type="button"
                                    class="w-full py-2.5 px-4 mt-2 bg-gray-300 text-white rounded-lg cursor-not-allowed"
                                    disabled>
                                    Anda Pemilik Acara
                                </button>
                                @else
                                @if ($event->price_ticket > 0)
                                <button type="submit" id="register-button"
                                    class="w-full py-2.5 px-4 bg-gray-800 text-white rounded-lg mt-2 hover:bg-gray-900 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    Pesan Tiket
                                </button>
                                @else
                                <button type="submit" id="register-button"
                                    class="w-full py-2.5 px-4 mt-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Daftar
                                </button>
                                @endif
                                @endif
                                @else
                                @if ($event->price_ticket > 0)
                                {{-- Jika belum login & harga tiket > 0, tampilkan tombol "Pesan Tiket" --}}
                                <button onclick="window.location.href='{{ route('login') }}'" id="register-button"
                                    class="w-full py-2.5 px-4 bg-gray-800 text-white rounded-lg mt-2 hover:bg-gray-900 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    Pesan Tiket
                                </button>
                                @else
                                {{-- Jika belum login & harga tiket = 0, tampilkan tombol "Daftar" --}}
                                <button onclick="window.location.href='{{ route('login') }}'" id="register-button"
                                    class="w-full py-2.5 px-4 mt-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Daftar
                                </button>
                                @endif
                                @endif
                            </div>
                    </div>
                    </form>

                    <div class="mt-8">
                        <div>
                            <h2 class="block text-xl font-bold text-gray-800 dark:text-white">Tentang Acara
                            </h2>
                            <div class="border-t w-full mt-2 mb-3"></div>
                        </div>
                        <div id="description-event" class="text-base text-gray-800 dark:text-neutral-200">
                            {!! $event->body !!}
                        </div>
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
                        {{-- <div id="hs-grayscale-leaflet" class="h-[250px] hs-leaflet z-10"></div> --}}
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.24102053!2d106.74711678874282!3d-6.229740108041162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1740546658082!5m2!1sid!2sid"
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
                                            <div class="hs-tooltip [--trigger:hover] [--placement:bottom] inline-block">
                                                <div class="hs-tooltip-toggle sm:mb-1 block text-start cursor-pointer">
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
                            @foreach ($event->participants->take(7) as $participant)
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

        <script>
            document.addEventListener('DOMContentLoaded', () => {
            const latitude = {{ $event->latitude ?? '-6.2088' }};
            const longitude = {{ $event->longitude ?? '106.8456' }};
            const locationName = "{{ $event->location_name }}";
            const address = "{{ $event->address }}";

            const map = L.map('event-map', {
                center: [latitude, longitude],
                zoom: 15
            });

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
                attribution: '© <a href="https://carto.com/attributions">CARTO</a>'
            }).addTo(map);

            const marker = L.marker([latitude, longitude]).addTo(map);
            marker.bindPopup(`<b>${locationName}</b><br>${address}`).openPopup();
        });
        </script>

        <script>
            function copyLink() {
                const currentUrl = window.location.href;
                navigator.clipboard.writeText(currentUrl).then(() => {
                    const notification = document.getElementById("notification-success-copylink");
                    notification.classList.remove("hidden");

                    // Sembunyikan notifikasi setelah 5 detik
                    setTimeout(() => {
                        notification.classList.add("hidden");
                    }, 5000);
                }).catch(err => {
                    console.error("Gagal menyalin link: ", err);
                });
            }
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
        const currentUrl = encodeURIComponent(window.location.href);
        const text = encodeURIComponent("Cek event ini!");

        document.getElementById("share-twitter").href = `https://twitter.com/intent/tweet?url=${currentUrl}&text=${text}`;
        document.getElementById("share-facebook").href = `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`;
        document.getElementById("share-linkedin").href = `https://www.linkedin.com/sharing/share-offsite/?url=${currentUrl}`;
    });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                    setTimeout(() => {
                        let successNotification = document.getElementById("notification-success");
                        let errorNotification = document.getElementById("notification-error");

                        if (successNotification) {
                            successNotification.style.transition = "transform 0.5s ease, opacity 0.5s ease";
                            successNotification.style.transform = "scale(0)";
                            successNotification.style.opacity = "0";
                            setTimeout(() => successNotification.remove(), 500);
                        }

                        if (errorNotification) {
                            errorNotification.style.transition = "transform 0.5s ease, opacity 0.5s ease";
                            errorNotification.style.transform = "scale(0)";
                            errorNotification.style.opacity = "0";
                            setTimeout(() => errorNotification.remove(), 500);
                        }
                    }, 5000);
                });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
            const registerButton = document.getElementById("register-button");
            if (registerButton) {
                registerButton.addEventListener("click", function (event) {
                    event.preventDefault(); // Cegah pengiriman langsung

                    // Simpan teks asli sebelum berubah ke spinner
                    const originalContent = registerButton.innerHTML;

                    // Ubah tombol menjadi spinner
                    registerButton.innerHTML = `
                        <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-white" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    `;
                    registerButton.disabled = true; // Cegah klik ulang

                    // Simulasi pemrosesan sebelum submit (misalnya 2 detik)
                    setTimeout(() => {
                        registerButton.closest("form").submit(); // Kirim form setelah loading
                    }, 2000);
                });
            }
        });
        </script>
</x-guest-layout>