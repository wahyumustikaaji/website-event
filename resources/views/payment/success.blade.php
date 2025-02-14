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
                <div class="sm:w-11/12 lg:w-3/4 mx-auto mt-28">
                    <!-- Card -->
                    <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">
                        <!-- Grid -->
                        <div class="flex justify-between">
                            <div>
                                <img class="w-12" src="{{ asset('image/logo/logo.png') }}" alt="logo">
                            </div>
                            <!-- Col -->

                            <div class="text-end">
                                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Invoice</h2>
                                <span class="mt-1 block text-gray-500 dark:text-neutral-500">{{ $orderId }}</span>
                            </div>
                            <!-- Col -->
                        </div>
                        <!-- End Grid -->

                        <!-- Grid -->
                        <div class="mt-8 grid sm:grid-cols-2 gap-3">
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-neutral-200">Pembayaran:
                                </h3>
                                <h3 class="text-gray-500 dark:text-neutral-500">{{
                                    $user->name }}</h3>
                                <h3 class="font-semibold text-gray-800 dark:text-neutral-200 mt-3">Email:
                                </h3>
                                <h3 class="text-gray-500 dark:text-neutral-500">{{ $user->email }}</h3>
                            </div>
                            <!-- Col -->

                            <div class="sm:text-end space-y-2">
                                <!-- Grid -->
                                <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Tanggal
                                            bayar:</dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{
                                            $orderDate }}</dd>
                                    </dl>

                                    <dl class="grid sm:grid-cols-5 gap-x-3">
                                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Harga:
                                        </dt>
                                        <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{
                                            number_format($amount, 0, ',', '.') }}</span></dd>
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
                                        Nama Fitur</div>
                                    <div
                                        class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Qty
                                    </div>
                                    <div
                                        class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Harga
                                    </div>
                                </div>

                                <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>

                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                                    <div class="col-span-full sm:col-span-2">
                                        <h5
                                            class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Item
                                        </h5>
                                        <p class="font-medium text-gray-800 dark:text-neutral-200">Pro Plan</p>
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
                                            Harga</h5>
                                        <p class="sm:text-end text-gray-800 dark:text-neutral-200">{{
                                            number_format($amount, 0, ',', '.') }}</p>
                                    </div>
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
                                        Total:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{
                                        number_format($amount, 0, ',', '.') }}</dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Pajak:
                                    </dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">10%</dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3">
                                    <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total
                                        dibayar:</dt>
                                    <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{
                                        number_format($totalAmount, 0, ',', '.') }}</dd>
                                </dl>
                            </div>
                            <!-- End Grid -->
                        </div>
                    </div>
                    <!-- End Flex -->

                    <div class="flex lg:flex-row flex-wrap-reverse items-end justify-between mt-12">
                        <div class="lg:mt-0 mt-8">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Terima Kasih!</h4>
                            <p class="text-gray-500 dark:text-neutral-500">Jika kamu memiliki pertanyaan tentang
                                pembayaran
                                ini,<br> bisa untuk menghubungi kontak informasi:</p>
                            <div class="mt-2">
                                <p class="block text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    spherevent.my.id</p>
                            </div>
                            <p class="mt-5 text-sm text-gray-500 dark:text-neutral-500">© 2025 Spherevent.</p>
                        </div>


                        <!-- Buttons -->
                        <div class="flex justify-start gap-x-3 lg:w-fit w-full">
                            <a class="py-2 px-3 lg:w-fit w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                href="/events">
                                Ke Halaman Utama
                            </a>
                        </div>
                    </div>
                    <!-- End Buttons -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Invoice -->

    </div>
    <!-- End Hero -->
    </div>
</x-guest-layout>
