<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    {{-- <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}

    @include('components.sidebar')

    <div id="hs-subscription-with-image"
        class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[90] overflow-x-hidden overflow-y-auto bg-black bg-opacity-50">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white shadow-lg rounded-xl dark:bg-neutral-900">

                <div class="aspect-w-16 aspect-h-8">
                    <img class="w-full object-cover rounded-t-xl"
                        src="https://images.unsplash.com/photo-1648747067020-73f77da74e8f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                        alt="Modal Hero Image">
                </div>

                <div class="p-4 sm:p-10 text-center overflow-y-auto">
                    <h3 id="hs-subscription-with-image-label"
                        class="mb-2 text-2xl font-bold text-gray-800 dark:text-neutral-200">
                        Yeahhhh 🎉
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500">
                        Event kamu berhasil dibuat! Kamu dapat melihat dan mengelolanya di dashboard.
                    </p>

                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            onclick="window.location.href='/event/{{ session('slug') }}'">
                            Preview Event
                        </button>
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400"
                            href="/dashboard">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>