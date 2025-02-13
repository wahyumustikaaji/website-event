<x-guest-layout>
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
            <!-- Invoice -->
            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
                <div class="sm:w-11/12 lg:w-3/4 mx-auto">
                    <!-- Card -->
                    <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">
                        <!-- Grid -->
                        <div class="flex justify-between">
                            <div>
                                <svg class="size-10" width="26" height="26" viewBox="0 0 26 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 26V13C1 6.37258 6.37258 1 13 1C19.6274 1 25 6.37258 25 13C25 19.6274 19.6274 25 13 25H12"
                                        class="stroke-blue-600 dark:stroke-white" stroke="currentColor"
                                        stroke-width="2" />
                                    <path
                                        d="M5 26V13.16C5 8.65336 8.58172 5 13 5C17.4183 5 21 8.65336 21 13.16C21 17.6666 17.4183 21.32 13 21.32H12"
                                        class="stroke-blue-600 dark:stroke-white" stroke="currentColor"
                                        stroke-width="2" />
                                    <circle cx="13" cy="13.0214" r="5" fill="currentColor"
                                        class="fill-blue-600 dark:fill-white" />
                                </svg>

                                <h1 class="mt-2 text-lg md:text-xl font-semibold text-blue-600 dark:text-white">Preline
                                    Inc.</h1>
                            </div>
                            <!-- Col -->

                            <div class="text-end">
                                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Invoice #</h2>
                                <span class="mt-1 block text-gray-500 dark:text-neutral-500">3682303</span>

                                <address class="mt-4 not-italic text-gray-800 dark:text-neutral-200">
                                    45 Roker Terrace<br>
                                    Latheronwheel<br>
                                    KW5 8NW, London<br>
                                    United Kingdom<br>
                                </address>
                            </div>
                            <!-- Col -->
                        </div>
                        <!-- End Grid -->

                        <!-- Grid -->
                        <div class="mt-8 grid sm:grid-cols-2 gap-3">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Bill to:</h3>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Sara Williams</h3>
                                <address class="mt-2 not-italic text-gray-500 dark:text-neutral-500">
                                    280 Suzanne Throughway,<br>
                                    Breannabury, OR 45801,<br>
                                    United States<br>
                                </address>
                            </div>
                            <!-- Col -->

                            <div class="sm:text-end space-y-2">
                                <!-- Grid -->
                                <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Invoice
                                            date:</dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">03/10/2018</dd>
                                    </dl>
                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Due
                                            date:</dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">03/11/2018</dd>
                                    </dl>
                                </div>
                                <!-- End Grid -->
                            </div>
                            <!-- Col -->
                        </div>
                        <!-- End Grid -->

                        <!-- Table -->
                        <div class="mt-6">
                            <div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
                                <div class="hidden sm:grid sm:grid-cols-5">
                                    <div
                                        class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Item</div>
                                    <div
                                        class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Qty
                                    </div>
                                    <div
                                        class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Rate
                                    </div>
                                    <div
                                        class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Amount
                                    </div>
                                </div>

                                <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>

                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                                    <div class="col-span-full sm:col-span-2">
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Item
                                        </h5>
                                        <p class="font-medium text-gray-800 dark:text-neutral-200">Design UX and UI</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Qty
                                        </h5>
                                        <p class="text-gray-800 dark:text-neutral-200">1</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Rate
                                        </h5>
                                        <p class="text-gray-800 dark:text-neutral-200">5</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Amount</h5>
                                        <p class="sm:text-end text-gray-800 dark:text-neutral-200">$500</p>
                                    </div>
                                </div>

                                <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>

                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                                    <div class="col-span-full sm:col-span-2">
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Item
                                        </h5>
                                        <p class="font-medium text-gray-800 dark:text-neutral-200">Web project</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Qty
                                        </h5>
                                        <p class="text-gray-800 dark:text-neutral-200">1</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Rate
                                        </h5>
                                        <p class="text-gray-800 dark:text-neutral-200">24</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Amount</h5>
                                        <p class="sm:text-end text-gray-800 dark:text-neutral-200">$1250</p>
                                    </div>
                                </div>

                                <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>

                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                                    <div class="col-span-full sm:col-span-2">
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Item
                                        </h5>
                                        <p class="font-medium text-gray-800 dark:text-neutral-200">SEO</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Qty
                                        </h5>
                                        <p class="text-gray-800 dark:text-neutral-200">1</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Rate
                                        </h5>
                                        <p class="text-gray-800 dark:text-neutral-200">6</p>
                                    </div>
                                    <div>
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Amount</h5>
                                        <p class="sm:text-end text-gray-800 dark:text-neutral-200">$2000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Table -->

                        <!-- Flex -->
                        <div class="mt-8 flex sm:justify-end">
                            <div class="w-full max-w-2xl sm:text-end space-y-2">
                                <!-- Grid -->
                                <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">
                                            Subtotal:</dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$2750.00</dd>
                                    </dl>

                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total:
                                        </dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$2750.00</dd>
                                    </dl>

                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Tax:
                                        </dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$39.00</dd>
                                    </dl>

                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Amount
                                            paid:</dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$2789.00</dd>
                                    </dl>

                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Due
                                            balance:</dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$0.00</dd>
                                    </dl>
                                </div>
                                <!-- End Grid -->
                            </div>
                        </div>
                        <!-- End Flex -->

                        <div class="mt-8 sm:mt-12">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Thank you!</h4>
                            <p class="text-gray-500 dark:text-neutral-500">If you have any questions concerning this
                                invoice, use
                                the following contact information:</p>
                            <div class="mt-2">
                                <p class="block text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    example@site.com</p>
                                <p class="block text-sm font-medium text-gray-800 dark:text-neutral-200">+1 (062)
                                    109-9222</p>
                            </div>
                        </div>

                        <p class="mt-5 text-sm text-gray-500 dark:text-neutral-500">© 2022 Preline.</p>
                    </div>
                    <!-- End Card -->

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-end gap-x-3">
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" x2="12" y1="15" y2="3" />
                            </svg>
                            Invoice PDF
                        </a>
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect width="12" height="8" x="6" y="14" />
                            </svg>
                            Print
                        </a>
                    </div>
                    <!-- End Buttons -->
                </div>
            </div>
            <!-- End Invoice -->
        </div>
        <!-- End Hero -->
    </div>
</x-guest-layout>