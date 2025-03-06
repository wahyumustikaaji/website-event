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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="./assets/vendor/datatables.net/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.49.1/dist/apexcharts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">
</head>

<body class="font-sans antialiased">

    @include('components.sidebar')

    <div id="hs-subscription-with-image"
        class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[90] overflow-x-hidden overflow-y-auto bg-black bg-opacity-50">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white shadow-lg rounded-xl dark:bg-neutral-900">

                <div class="aspect-w-16 aspect-h-8">
                    <img class="w-full object-cover rounded-t-xl" src="{{ asset('image/create-event.jpg') }}"
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

    <div id="hs-danger-alert"
        class="hs-overlay-delete hidden size-full fixed top-0 start-0 z-[90] overflow-x-hidden overflow-y-auto bg-black bg-opacity-50"
        role="dialog" tabindex="-1" aria-labelledby="hs-danger-alert-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
            <div
                class="relative flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">

                <div class="p-4 sm:p-10 overflow-y-auto">
                    <div class="flex gap-x-4 md:gap-x-7">
                        <!-- Icon -->
                        <span
                            class="shrink-0 inline-flex justify-center items-center size-[46px] sm:w-[62px] sm:h-[62px] rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                        </span>
                        <!-- End Icon -->

                        <div class="grow">
                            <h3 id="hs-danger-alert-label"
                                class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                                Delete Event
                            </h3>
                            <p class="text-gray-500 dark:text-neutral-500">
                                Event yang kamu buat akan di hapus secara permanen di sistem kami. Apakah kamu yakin?
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="flex justify-end items-center gap-x-2 py-3 px-4 bg-gray-50 border-t dark:bg-neutral-950 dark:border-neutral-800">
                    <button type="button" id="cancel-delete"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                        data-hs-overlay="#hs-danger-alert">
                        Cancel
                    </button>
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="confirm-delete"
                            class="delete-button py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none">
                            Delete Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="hs-focus-management-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="hs-focus-management-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 id="hs-focus-management-modal-label" class="font-bold text-gray-800 text-xl dark:text-white">
                        Sarankan Deskripsi
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#hs-focus-management-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Intruksi</label>
                    <textarea
                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none resize-none"
                        rows="20"
                        placeholder="Misalnya, Anda ingin membuat deskripsi tentang event konser ataupun event workshop."
                        data-hs-textarea-auto-height=""></textarea>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <button type="button" id="retry-button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        Coba Lagi
                    </button>
                    <button type="button" id="generate-button"
                        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:bg-gray-800 disabled:opacity-50 disabled:pointer-events-none">
                        Hasilkan
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

<script type="module">
    document.addEventListener('DOMContentLoaded', function () {
        const textArea = document.querySelector('textarea');
        const generateButton = document.getElementById('generate-button');
        const retryButton = document.getElementById('retry-button');
        const editorElement = document.getElementById('editor');
        const bodyInput = document.getElementById('body');

        // Add a flag to track generation state
        let generationCompleted = false;

        const API_KEY = "{{ env('DEEPSEEK_API_KEY') }}";
        const API_URL = "https://api.deepseek.com/v1/chat/completions";

        async function generateEventDescription(prompt) {
            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${API_KEY}`
                    },
                    body: JSON.stringify({
                        model: "deepseek-chat",
                        messages: [{ role: "user", content: prompt }],
                        temperature: 0.7,
                        max_tokens: 500
                    })
                });

                if (!response.ok) {
                    throw new Error(`API error: ${response.status} ${response.statusText}`);
                }

                const data = await response.json();
                const text = data.choices[0]?.message?.content.replace(/\*/g, '') || 'Terjadi kesalahan';
                return text;
            } catch (error) {
                console.error('Error:', error);
                return 'Terjadi kesalahan saat menghasilkan deskripsi. Silakan coba lagi.';
            }
        }

        function typeEffectInTextarea(element, text, speed = 30) {
            return new Promise((resolve) => {
                let i = 0;
                element.value = '';

                function typeNextChar() {
                    if (i < text.length) {
                        element.value += text.charAt(i);
                        i++;
                        adjustTextareaRows();
                        setTimeout(typeNextChar, speed);
                    } else {
                        resolve();
                    }
                }
                typeNextChar();
            });
        }

        function syncContent(content) {
            const contentWithBrTags = content.replace(/\n/g, '<br>');

            if (bodyInput) bodyInput.value = contentWithBrTags;
            if (typeof quill !== 'undefined' && quill) quill.root.innerHTML = contentWithBrTags;
            else if (editorElement) editorElement.innerHTML = contentWithBrTags;
        }

        // Reset the generation state to initial
        function resetGenerationState() {
            generationCompleted = false;
            if (generateButton) {
                generateButton.textContent = 'Hasilkan';
                // Restore the original click handler
                generateButton.onclick = handleGenerate;
                generateButton.disabled = false;
            }
            if (textArea) textArea.value = '';
            if (retryButton) retryButton.disabled = true;
        }

        // Handle generate button click
        async function handleGenerate() {
            const userInput = textArea.value.trim();
            if (!userInput) {
                alert('Silakan masukkan deskripsi singkat tentang event Anda terlebih dahulu.');
                return;
            }

            generateButton.disabled = true;
            generateButton.textContent = 'Menghasilkan...';

            try {
                const enhancedPrompt = `Buatkan deskripsi menarik untuk event berikut: ${userInput}.`;
                const generatedDescription = await generateEventDescription(enhancedPrompt);
                await typeEffectInTextarea(textArea, generatedDescription);

                generationCompleted = true;
                generateButton.textContent = 'Terima Saran';
                generateButton.onclick = handleAcceptSuggestion;
                generateButton.disabled = false;
                if (retryButton) retryButton.disabled = false;
            } catch (err) {
                alert('Terjadi kesalahan: ' + err.message);
                resetGenerationState();
            }
        }

        // Handle accept suggestion button click
        function handleAcceptSuggestion() {
            const descriptionText = textArea.value;
            generateButton.disabled = true;
            generateButton.textContent = 'Memproses...';

            // Sync the content to the main editor
            syncContent(descriptionText);

            // Close the modal
            const modal = document.getElementById('hs-focus-management-modal');
            if (modal && window.HSOverlay) {
                HSOverlay.close(modal);
            } else {
                const closeButton = modal?.querySelector('[data-hs-overlay="#hs-focus-management-modal"]');
                if (closeButton) closeButton.click();
            }

            // Reset the generation state
            resetGenerationState();
        }

        // Add modal open event listener to reset state when modal opens
        const modalTriggers = document.querySelectorAll('[data-hs-overlay="#hs-focus-management-modal"]');
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
                // Only reset if the previous generation was completed and accepted
                if (generationCompleted) {
                    resetGenerationState();
                }
            });
        });

        // Set up initial button handlers
        if (generateButton) {
            generateButton.onclick = handleGenerate;
        }

        if (retryButton) {
            retryButton.addEventListener('click', function () {
                textArea.value = '';
                textArea.focus();
                resetGenerationState();
            });
        }

        // Initialize content if available
        if (bodyInput && bodyInput.value) {
            syncContent(bodyInput.value);
        }
    });

    function adjustTextareaRows() {
        const textArea = document.querySelector('textarea');
        if (textArea) {
            textArea.style.height = 'auto';
            textArea.style.height = (textArea.scrollHeight) + 'px';
        }
    }
</script>

</html>