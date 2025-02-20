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
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16 mt-20 lg:mt-28">
                <div class="max-w-2xl text-center mx-auto">
                    <p
                        class="inline-block text-sm font-medium bg-clip-text bg-gradient-to-l from-blue-600 to-violet-500 text-transparent dark:from-blue-400 dark:to-violet-400">
                        Spherevent: A vision for 2025
                    </p>

                    <!-- Title -->
                    <div class="mt-5 max-w-2xl">
                        <h1
                            class="block font-semibold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200 ">
                            Event Menyenangkan Berawal dari Kami
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
                        @if (Route::has('login'))
                        <a class="py-3 px-4 w-full max-w-md inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                            Mulai Buat Event
                        </a>
                        @endif
                    </div>
                    <!-- End Buttons -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero -->

    <!-- Features -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto mt-5 lg:mt-10">
        <div class="aspect-w-16 aspect-h-7">
            <img class="w-full object-cover rounded-xl max-h-[20rem] lg:max-h-[35rem]"
                src="https://images.unsplash.com/photo-1624571409412-1f253e1ecc89?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80"
                alt="Features Image">
        </div>

        <!-- Grid -->
        <div class="mt-5 lg:mt-16 grid lg:grid-cols-3 gap-8 lg:gap-12">
            <div class="lg:col-span-1">
                <h2 class="font-bold text-2xl md:text-3xl text-gray-800 dark:text-neutral-200">
                    We tackle the challenges start-ups face
                </h2>
                <p class="mt-2 md:mt-4 text-gray-500 dark:text-neutral-500">
                    Besides working with start-up enterprises as a partner for digitalization, we have built enterprise
                    products for common pain points that we have encountered in various products and projects.
                </p>
            </div>
            <!-- End Col -->

            <div class="lg:col-span-2">
                <div class="grid sm:grid-cols-2 gap-8 md:gap-12">
                    <!-- Icon Block -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="10" x="3" y="11" rx="2" />
                            <circle cx="12" cy="5" r="2" />
                            <path d="M12 7v4" />
                            <line x1="8" x2="8" y1="16" y2="16" />
                            <line x1="16" x2="16" y1="16" y2="16" />
                        </svg>
                        <div class="grow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Creative minds
                            </h3>
                            <p class="mt-1 text-gray-600 dark:text-neutral-400">
                                We choose our teams carefully. Our people are the secret to great work.
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 10v12" />
                            <path
                                d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z" />
                        </svg>
                        <div class="grow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Simple and affordable
                            </h3>
                            <p class="mt-1 text-gray-600 dark:text-neutral-400">
                                From boarding passes to movie tickets, there's pretty much nothing you can't store with
                                Preline.
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                        </svg>
                        <div class="grow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Industry-leading documentation
                            </h3>
                            <p class="mt-1 text-gray-600 dark:text-neutral-400">
                                Our documentation and extensive Client libraries contain everything a business needs to
                                build a custom integration.
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 mt-1 size-6 text-blue-600 dark:text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <div class="grow">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Designing for people
                            </h3>
                            <p class="mt-1 text-gray-600 dark:text-neutral-400">
                                We actively pursue the right balance between functionality and aesthetics, creating
                                delightful experiences.
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Block -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Features -->
</x-guest-layout>