<x-app-layout>
    <div class="relative z-10">
        <!-- Title -->
        <div class="max-w-2xl mb-5">
            <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Buat Event Baru</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Buat event paling
                diminati dan
                jangan
                lupa disebarkan!</p>
        </div>
        <!-- End Title -->

        <!-- Card Section -->
        <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 mx-auto">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-900">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Section -->
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 pt-0 last:pb-0">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                Detail Event
                            </h2>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="name-event"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Nama Event
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            <input id="name-event" name="title" type="text" required
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div class="sm:col-span-3">
                            <label for="category-event"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Kategori Event
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            <select id="category-event" name="category_id" required
                                class="py-2 px-3 block w-full border-gray-200 shadow-sm text-sm rounded-lg">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="category-city"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Kategori Kota
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            <select id="category-city" name="city_category_id" required
                                class="py-2 px-3 block w-full border-gray-200 shadow-sm text-sm rounded-lg">
                                @foreach ($cityCategories as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-3">
                            <div class="inline-block">
                                <label for="ticket-quantity"
                                    class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                    Jumlah Tiket
                                </label>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <!-- Input Number -->
                            <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg dark:bg-neutral-900 dark:border-neutral-700"
                                data-hs-input-number='{
                              "step": 1
                            }'>
                                <div class="w-full flex justify-between items-center gap-x-3">
                                    <input id="ticket-quantity"
                                        class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                                        style="-moz-appearance: textfield;" type="number"
                                        aria-roledescription="Number field" name="ticket_quantity" value="0"
                                        data-hs-input-number-input="">
                                    <div class="flex justify-end items-center gap-x-1.5">
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                            tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                            tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5v14"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Input Number -->
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <div class="inline-block">
                                <label for="body"
                                    class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                    Deskripsi Event
                                </label>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <textarea id="body" name="body"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                rows="6" placeholder=""></textarea>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <div class="inline-block">
                                <label for="image"
                                    class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                    Poster Event
                                </label>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <label for="image" class="sr-only">Choose file</label>
                            <input type="file" name="image" id="image" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                                        file:bg-gray-50 file:border-0
                                        file:bg-gray-100 file:me-4
                                        file:py-2 file:px-4
                                        dark:file:bg-neutral-700 dark:file:text-neutral-400">
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->

                    <!-- Section -->
                    <div
                        class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                Wahtu Event Berlangsung
                            </h2>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="date-start-event"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Tanggal & Waktu Event Dimulai
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="date-start-event" name="event_date" type="date" required
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                <input id="time-start-event" name="start_time" type="time"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="date-end-event"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Tanggal & Waktu Event Selesai
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="date-end-event" name="end_date" type="date" required
                                    min="{{ '${document.getElementById(\'date-end-event\').value}' }}"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                <input id="time-end-event" name="end_time" type="time"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->

                    <!-- Section -->
                    <div
                        class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                Lokasi Event Diselenggarakan
                            </h2>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="name-location"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Nama Tempat
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="name-location" name="location_name" type="text" required
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="address"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Alamat Lengkap
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="address" name="address" type="text" required
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->

                    <!-- Section -->
                    <div
                        class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Submit event
                        </h2>
                        <p class="mt-3 text-sm text-gray-600 dark:text-neutral-400">
                            Untuk melanjutkan proses pengiriman formulir, kami perlu menyimpan data pribadi Anda.
                        </p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                            Silakan centang kotak di bawah ini untuk memberikan izin kepada kami.
                        </p>

                        <div class="mt-5 flex">
                            <input type="checkbox" required
                                class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                id="af-submit-application-privacy-check">
                            <label for="af-submit-application-privacy-check"
                                class="text-sm text-gray-500 ms-2 dark:text-neutral-400">
                                Izinkan kami untuk memproses informasi Anda.
                            </label>
                        </div>
                    </div>
                    <!-- End Section -->

                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Buat Event
                    </button>
                </form>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Card Section -->

        @if(session('success'))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/preline/2.0.3/preline.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                    // Tunggu sebentar untuk memastikan semua resource telah dimuat
                    setTimeout(() => {
                        // Buka modal
                        const modal = document.querySelector('#hs-subscription-with-image');
                        if (modal && window.HSOverlay) {
                            HSOverlay.open(modal);
                            
                            // Jalankan confetti
                            confetti({
                                particleCount: 150,
                                spread: 80,
                                origin: { y: 0.6 },
                                colors: ['#4F46E5', '#3B82F6', '#10B981'],
                                ticks: 200
                            });
                        }
                    }, 500);
                });
        </script>
        @endif
</x-app-layout>