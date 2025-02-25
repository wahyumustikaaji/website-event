<x-app-layout>
    <div class="relative z-10">
        <!-- Title -->
        @if (!$event)
        <div class="max-w-2xl mb-5">
            <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">Buat Event Baru</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Buat event paling
                diminati dan
                jangan
                lupa disebarkan!</p>
        </div>
        @endif
        <!-- End Title -->

        <!-- Card Section -->
        <div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 mx-auto">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-900">
                <form action="{{ $event ? route('event.update', $event->slug) : route('events.store') }}" method="POST"
                    enctype="multipart/form-data" onsubmit="submitForm(this); return false;">
                    @csrf
                    @if($event)
                    @method('PUT')
                    @endif

                    <!-- Section -->
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 pt-0 last:pb-0">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                {{ $event ? 'Edit Event' : 'Detail Event' }}
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
                                value="{{ old('title', $event ? $event->title : '') }}" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg
                                              focus:border-blue-500 focus:ring-blue-500
                                              @error('title') border-red-500 @enderror">
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                                <option value="{{ $category->id }}" {{ old('category_id', $event ? $event->category_id :
                                    '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                <option value="{{ $city->id }}" {{ old('city_category_id', $event ? $event->
                                    city_category_id : '') == $city->id ?
                                    'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

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
                            <div id="editor-container">
                                <div id="editor" style="min-height: 200px;">{!! old('body', $event ? $event->body : '')
                                    !!}</div>
                            </div>
                            <input class="rounded-lg @error('body') border-red-500 @enderror" type="hidden" name="body"
                                id="body">
                            @error('body')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                            @if($event && $event->image)
                            <div class="mb-2">
                                <img src="{{Storage::url($event->image)}}" alt="Poster Event" class="max-w-xs rounded">
                            </div>
                            @endif

                            <!-- Preview Container -->
                            <div id="imagePreviewContainer" class="mb-4 hidden">
                                <div class="w-64 h-64 rounded-lg overflow-hidden">
                                    <img id="imagePreview" class="w-full h-full object-cover" alt="Preview">
                                </div>
                            </div>

                            <label for="image" class="sr-only">Choose file</label>
                            <input type="file" name="image" id="image" accept="image/*" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm
                                          focus:border-blue-500 focus:ring-blue-500
                                          @error('image') border-red-500 @enderror
                                          file:bg-gray-50 file:border-0
                                          file:bg-gray-100 file:me-4
                                          file:py-2 file:px-4">
                            @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->

                    <div
                        class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                Waktu Event Berlangsung
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
                            <div class="sm:flex gap-2">
                                <div class="w-full">
                                    <input id="date-start-event" name="event_date" type="date" required
                                        value="{{ old('event_date', $event ? $event->event_date : '') }}"
                                        class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg sm:mt-0 sm:first:ms-0 text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('event_date') border-red-500 @enderror">
                                    @error('event_date')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <input id="time-start-event" name="start_time" type="time" required
                                        value="{{ old('start_time', $event ? $event->start_time : '') }}"
                                        class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg sm:mt-0 sm:first:ms-0 text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('start_time') border-red-500 @enderror">
                                    @error('start_time')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
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
                            <div class="sm:flex gap-2">
                                <div class="w-full">
                                    <input id="date-end-event" name="end_date" type="date" required
                                        value="{{ old('end_date', $event ? $event->end_date : '') }}"
                                        min="{{ '${document.getElementById(\'date-end-event\').value}' }}"
                                        class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg sm:mt-0 sm:first:ms-0 text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('end_date') border-red-500 @enderror">
                                    @error('end_date')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <input id="time-end-event" name="end_time" type="time" required
                                        value="{{ old('end_time', $event ? $event->end_time : '') }}"
                                        class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px rounded-lg sm:mt-0 sm:first:ms-0 text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('end_time') border-red-500 @enderror">
                                    @error('end_time')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>

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
                                value="{{ old('location_name', $event ? $event->location_name : '') }}"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('location_name') border-red-500 @enderror">
                            @error('location_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
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
                                value="{{ old('address', $event ? $event->address : '') }}"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('address') border-red-500 @enderror">
                            @error('address')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->

                    <!-- Section -->
                    <div
                        class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                        <div class="sm:col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                Opsi Event
                            </h2>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3 flex items-center gap-x-2 mt-2.5">
                            <label for="name-location"
                                class="inline-block text-sm font-medium text-gray-500 dark:text-neutral-500">
                                Harga per Tiket
                            </label>
                            <div class="hs-tooltip">
                                <div class="hs-tooltip-toggle">
                                    <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                        <path d="M12 17h.01"></path>
                                    </svg>
                                    <span
                                        class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                                        role="tooltip" data-popper-placement="top"
                                        style="position: fixed; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(317.5px, -843.5px, 0px);">
                                        Kosongkan jika gratis
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="price_ticket" name="price_ticket" type="text"
                                value="{{ old('price_ticket', $event ? number_format($event->price_ticket, 0, ',', '.') : '0') }}"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('price_ticket') border-red-500 @enderror"
                                oninput="formatRupiah(this)">
                            @error('price_ticket')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <div class="flex items-center gap-x-2 mt-2.5">
                                <label for="ticket-quantity"
                                    class="inline-block text-sm font-medium text-gray-500 dark:text-neutral-500">
                                    Jumlah Tiket
                                </label>
                                <div class="hs-tooltip">
                                    <div class="hs-tooltip-toggle">
                                        <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                            <path d="M12 17h.01"></path>
                                        </svg>
                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                                            role="tooltip" data-popper-placement="top"
                                            style="position: fixed; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(317.5px, -843.5px, 0px);">
                                            Kosongkan jika Tak Terbatas
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <!-- Input Number -->
                            <div class="py-2 px-3 bg-white border border-gray-200 @error('ticket_quantity') border-red-500 @enderror rounded-lg dark:bg-neutral-900 dark:border-neutral-700"
                                data-hs-input-number='{
                                                      "step": 1
                                                    }'>
                                <div class="w-full flex justify-between items-center gap-x-3">
                                    <input id="ticket-quantity"
                                        value="{{ old('ticket_quantity', $event ? $event->ticket_quantity : '') }}"
                                        class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                                        style="-moz-appearance: textfield;" type="number"
                                        aria-roledescription="Number field" name="ticket_quantity" value=""
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
                            @error('ticket_quantity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <!-- End Input Number -->
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3 flex items-center gap-x-2">
                            <label for="requires_approval"
                                class="inline-block text-sm font-medium text-gray-500 dark:text-neutral-500">
                                Memerlukan Persetujuan
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <!-- Switch/Toggle -->
                            <div class="relative inline-block">
                                <input type="checkbox" id="requires_approval" name="requires_approval"
                                    class="peer relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent
                                    text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200
                                    focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none
                                    checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800
                                    dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600
                                    before:inline-block before:size-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0
                                    checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0
                                    before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-blue-200" {{ old('requires_approval',
                                    $event->requires_approval ?? false) ? 'checked' : '' }}>
                                <label for="requires_approval" class="sr-only">Requires Approval</label>

                                <!-- X Icon (Unchecked) -->
                                <span
                                    class="peer-checked:text-white text-gray-500 size-6 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200 dark:text-neutral-500">
                                    <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </span>

                                <!-- Check Icon (Checked) -->
                                <span
                                    class="peer-checked:text-blue-600 text-gray-500 size-6 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200 dark:text-neutral-500">
                                    <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </span>
                            </div>
                            <!-- End Switch/Toggle -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->

                    <!-- Section -->
                    @if(!$event)
                    <div
                        class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Submit event
                        </h2>
                        <p class="mt-3 text-sm text-gray-600 dark:text-neutral-400">
                            Untuk melanjutkan proses pengiriman formulir, kami perlu menyimpan data event Anda.
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
                                Izinkan kami untuk memproses informasi event Anda.
                            </label>
                        </div>
                    </div>
                    @endif
                    <!-- End Section -->

                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        {{ $event ? 'Update Event' : 'Buat Event'}}
                    </button>
                </form>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Card Section -->

        <!-- Include stylesheet -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                document.getElementById('body').value = quill.root.innerHTML;
            });

            quill.on('text-change', function() {
                document.getElementById('body').value = quill.root.innerHTML;
            });
        </script>

        <script>
            function submitForm(form) {
            // Dapatkan button submit
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;

            // Ganti konten button dengan loading spinner
            submitBtn.innerHTML = `
                <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-white rounded-full dark:text-white" role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                </div>
            `;
            submitBtn.disabled = true;

            // Submit form
            form.submit();
        }
        </script>

        <script>
            document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
                preview.src = '';
            }
        });
        </script>

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

        <script>
            function formatRupiah(input) {
            let value = input.value.replace(/\D/g, ""); // Hapus karakter non-digit
            let formatted = new Intl.NumberFormat("id-ID").format(value); // Format ke Rupiah
            input.value = formatted;
        }
        </script>
</x-app-layout>