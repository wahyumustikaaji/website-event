<x-app-layout>
    <div class="relative z-10">
        <!-- Title -->
        <h2 class="text-2xl font-bold md:text-2xl md:leading-tight dark:text-white">History Pembayaran</h2>
        <p class="mt-1 text-gray-600 dark:text-neutral-400 hidden lg:block">Buat event paling
            diminati dan
            jangan
            lupa disebarkan!</p>
        <!-- End Title -->

        <!-- Table Section -->
        <div class="py-10 sm:px-6 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">

                            <!-- Collapse -->
                            <div
                                class="border-b border-gray-200 hover:bg-gray-50 dark:hover:bg-neutral-900 dark:border-neutral-700">
                                <button type="button"
                                    class="hs-collapse-toggle py-4 px-6 w-full flex items-center gap-2 font-semibold text-gray-800 dark:text-neutral-200"
                                    id="hs-as-table" aria-expanded="false" aria-controls="hs-as-table-label"
                                    data-hs-collapse="#hs-as-table-label">
                                    <svg class="hs-collapse-open:rotate-90 size-4" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                    Insights
                                </button>
                                <div id="hs-as-table-label"
                                    class="hs-collapse hidden w-full overflow-hidden transition-[height] duration-300"
                                    aria-labelledby="hs-as-table">
                                    <div class="pb-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="size-5 flex justify-center items-center rounded-full bg-blue-600 text-white dark:bg-blue-500">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg>
                                            </span>
                                            <span class="text-sm text-gray-800 dark:text-neutral-400">
                                                There are no insights for this period.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-900">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Order ID
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Total Bayar
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Status
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Tanggal
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Dibuat
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse($payments as $payment)
                                    <tr class="bg-white hover:bg-gray-50 dark:bg-neutral-900 dark:hover:bg-neutral-800">
                                        <td class="size-px whitespace-nowrap">
                                            <button type="button" class="block" aria-haspopup="dialog"
                                                aria-expanded="false" aria-controls="hs-ai-invoice-modal"
                                                data-hs-overlay="#hs-ai-invoice-modal"
                                                data-payment-id="{{ $payment->id }}">
                                                <span class="block px-6 py-2">
                                                    <span class="font-mono text-sm text-blue-600 dark:text-blue-500">{{
                                                        $payment->order_id }}</span>
                                                </span>
                                            </button>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <button type="button" class="block" aria-haspopup="dialog"
                                                aria-expanded="false" aria-controls="hs-ai-invoice-modal"
                                                data-hs-overlay="#hs-ai-invoice-modal"
                                                data-payment-id="{{ $payment->id }}">
                                                <span class="block px-6 py-2">
                                                    <span class="text-sm text-gray-600 dark:text-neutral-400">Rp. {{
                                                        number_format($payment->total_amount, 0, ',', '.') }}</span>
                                                </span>
                                            </button>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <button type="button" class="block" aria-haspopup="dialog"
                                                aria-expanded="false" aria-controls="hs-ai-invoice-modal"
                                                data-hs-overlay="#hs-ai-invoice-modal"
                                                data-payment-id="{{ $payment->id }}">
                                                <span class="block px-6 py-2">
                                                    @if($payment->status == 'success' || $payment->status == 'paid')
                                                    <span
                                                        class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                        <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16" fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                        </svg>
                                                        Paid
                                                    </span>
                                                    @else
                                                    <span
                                                        class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-green-200">
                                                        <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16" fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                        </svg>
                                                        {{ ucfirst($payment->status) }}
                                                    </span>
                                                    @endif
                                                </span>
                                            </button>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <button type="button" class="block" aria-haspopup="dialog"
                                                aria-expanded="false" aria-controls="hs-ai-invoice-modal"
                                                data-hs-overlay="#hs-ai-invoice-modal"
                                                data-payment-id="{{ $payment->id }}">
                                                <span class="block px-6 py-2">
                                                    <span class="text-sm text-gray-600 dark:text-neutral-400">{{
                                                        $payment->created_at->addDays(3)->format('d M Y') }}</span>
                                                </span>
                                            </button>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <button type="button" class="block" aria-haspopup="dialog"
                                                aria-expanded="false" aria-controls="hs-ai-invoice-modal"
                                                data-hs-overlay="#hs-ai-invoice-modal"
                                                data-payment-id="{{ $payment->id }}">
                                                <span class="block px-6 py-2">
                                                    <span class="text-sm text-gray-600 dark:text-neutral-400">{{
                                                        $payment->created_at->format('d M
                                                        Y, H:i') }}</span>
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                            No payment records found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        <span class="font-semibold text-gray-800 dark:text-neutral-200">{{
                                            $totalPayments }}</span> results
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <button type="button"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            <svg class="size-3" width="16" height="16" viewBox="0 0 16 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.506 1.64001L4.85953 7.28646C4.66427 7.48172 4.66427 7.79831 4.85953 7.99357L10.506 13.64"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                            </svg>
                                            Prev
                                        </button>

                                        <button type="button"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            Next
                                            <svg class="size-3" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.50598 2L10.1524 7.64645C10.3477 7.84171 10.3477 8.15829 10.1524 8.35355L4.50598 14"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Table Section -->
    </div>
</x-app-layout>