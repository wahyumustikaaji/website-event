<x-app-layout>
    <div class="relative z-10">
        <!-- Title -->
        <div class="max-w-2xl mb-5 {{$myeventsregistered->isEmpty() ? 'hidden' : ''}}">
            <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Semua Acara Terdaftar</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Buat event paling
                diminati dan
                jangan
                lupa disebarkan!</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid {{$myeventsregistered->isEmpty() ? 'lg:grid-cols-1' : 'lg:grid-cols-2'}} lg:gap-y-16 gap-10">
            <!-- Card -->
            @if ($myeventsregistered->isEmpty())
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16 mt-20 lg:mt-28">
                <div class="max-w-2xl text-center mx-auto">

                    <!-- Title -->
                    <div class="mt-5 max-w-2xl">
                        <h1
                            class="block font-semibold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200 ">
                            Belum Ada Event Yang Didaftar
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
                            href="/events">
                            Mulai Daftar Event
                        </a>
                    </div>
                    <!-- End Buttons -->
                </div>
            </div>
            @else
            @foreach ($myeventsregistered as $events )
            <a href="{{ route('ticket', [$event->slug, app(App\Http\Controllers\EventController::class)->generateTicketCode(auth()->id(), $event->id)]) }}"
                class="group block rounded-xl overflow-hidden relative focus:outline-none border shadow-[0_8px_30px_rgb(0,0,0,0.12)] bg-white">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                    <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
                        <img class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl"
                            src="{{asset('storage/'.$events->image)}}" alt="Blog Image">
                    </div>

                    <div class="grow">
                        <h3 class=" text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300
                            dark:group-hover:text-white ">
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
</x-app-layout>