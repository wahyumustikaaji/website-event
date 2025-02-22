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
            <div class="max-w-[30rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16 mt-20 lg:mt-20">
                <!-- Card -->
                <div id="ticket-container"
                    class="bg-white border p-5 shadow-sm rounded-xl transition dark:bg-neutral-900 dark:border-neutral-800">
                    <span
                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-sm font-medium bg-gray-200 bg-opacity-90 text-gray-500 dark:bg-white/10 dark:text-white">Tiket</span>

                    <h2
                        class="text-2xl md:text-2xl font-bold dark:text-white mt-3 bg-clip-text hover:bg-gradient-to-l hover:from-blue-600 hover:to-violet-500 hover:text-transparent dark:from-blue-400 dark:to-violet-400">
                        <a href="/event/{{ $event->slug }}">
                            {{ $event->title }}
                        </a>
                    </h2>

                    <p class="text-sm text-gray-400 mt-2">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y,
                        H:i') }} WIB</p>
                    <p class="text-sm text-gray-400 mt-1">{{ $event->location_name }}, {{ $event->address }}</p>

                    <div class="border-t border-[1px] border-gray-300 border-opacity-70 border-dashed my-6"></div>
                    <img class="mx-auto w-64 h-64" src="{{ asset('storage/qrcodes/' . $fileName) }}" alt="QR Code">
                    <div class="border-t border-[1px] border-gray-300 border-opacity-70 border-dashed my-6"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <p class="text-sm text-gray-400">Tamu</p>
                            <p class="text-lg font-medium text-black">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Status</p>
                            <p class="text-lg font-medium text-green-500">Akan Hadir</p>
                        </div>
                    </div>

                    <div class="border-t border-[1px] border-gray-300 border-opacity-70 border-dashed my-6"></div>
                    <div class="flex items-center justify-between space-x-3" id="buttonNot">
                        <button type="button"
                            onclick="window.location.href='https://www.google.com/maps?q={{ urlencode($event->location_name) }}+{{ urlencode($event->address) }}'"
                            class="w-full py-2 px-4 inline-flex items-center gap-x-2 text-base font-medium rounded-lg border border-transparent bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none dark:bg-white dark:text-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m15 21l-6-2.1l-4.65 1.8q-.5.2-.925-.112T3 19.75v-14q0-.325.188-.575T3.7 4.8L9 3l6 2.1l4.65-1.8q.5-.2.925.113T21 4.25v14q0 .325-.187.575t-.513.375zm-1-2.45V6.85l-4-1.4v11.7zm2 0l3-1V5.7l-3 1.15zM5 18.3l3-1.15V5.45l-3 1zM16 6.85v11.7zm-8-1.4v11.7z" />
                            </svg>
                            Dapatkan Peta
                        </button>
                        <button type="button" onclick="generatePDF()"
                            class="w-full py-2 px-4 inline-flex items-center gap-x-2 text-base font-medium rounded-lg border border-transparent bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none dark:bg-white dark:text-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 21h12M12 3v14m0 0l5-5m-5 5l-5-5" />
                            </svg>
                            Download Tiket
                        </button>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
    <!-- End Hero -->

    <div class="relative opacity-0">
        <style>
            #pdf-ticket {
                position: fixed;
                left: -100%;
                top: -100%;
                width: 100%;
                max-width: 600px;
                margin: auto;
                padding: 20px;
                background: #fff;
                visibility: hidden;
                opacity: 0;
                pointer-events: none;
            }
        </style>

        <div id="pdf-ticket">
            <div style="text-align: center; border-bottom: 2px solid #000; padding-bottom: 15px; margin-bottom: 15px;">
                <h1 style="font-size: 22px; font-weight: bold; text-transform: uppercase;">{{ $event->title }}</h1>
            </div>
            <div style="margin-bottom: 15px;">
                <p style="font-size: 14px; margin-bottom: 5px;">
                    <strong style="font-size: 16px;">Tanggal & Waktu:</strong><br>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }},
                    {{$event->formatted_event_time_start}} WIB
                </p>
                <p style="font-size: 14px; margin-bottom: 5px;">
                    <strong style="font-size: 16px;">Lokasi:</strong><br>
                    {{ $event->location_name }}, {{ $event->address }}
                </p>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <img id="qr-code" src="{{ asset('storage/qrcodes/' . $fileName) }}" alt="QR Code"
                    style="width: 150px; height: 150px; margin:auto;">
            </div>
            <div style="margin-bottom: 15px; margin-top: 15px;">
                <p style="font-size: 14px; margin-bottom: 5px;">
                    <strong style="font-size: 16px;">Nama:</strong><br>
                    {{ $user->name }}
                </p>
                <p style="font-size: 14px; margin-bottom: 5px;">
                    <strong style="font-size: 16px;">Email:</strong><br>
                    {{ $user->email }}
                </p>
            </div>
            <div style="text-align: center; font-size: 12px; color: #6B7280; margin-top: 10px;">
                <p>Harap tunjukkan tiket ini saat masuk.</p>
            </div>
        </div>
    </div>

    <!-- Include required libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        window.jsPDF = window.jspdf.jsPDF;

    async function generatePDF() {
        try {
            const element = document.getElementById('pdf-ticket');
            element.style.visibility = 'visible';
            element.style.opacity = '1';
            element.style.position = 'fixed';
            element.style.top = '0';
            element.style.left = '0';

            const qrCode = document.getElementById('qr-code');
            await new Promise((resolve, reject) => {
                if (qrCode.complete) {
                    resolve();
                } else {
                    qrCode.onload = resolve;
                    qrCode.onerror = reject;
                }
            });

            await new Promise(resolve => setTimeout(resolve, 100));

            const canvas = await html2canvas(element, {
                scale: 2,
                useCORS: true,
                logging: true,
                backgroundColor: '#ffffff'
            });

            element.style.visibility = 'hidden';
            element.style.opacity = '0';
            element.style.position = 'fixed';
            element.style.left = '-9999px';
            element.style.top = '-9999px';

            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            const imgWidth = 210;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            pdf.addImage(
                canvas.toDataURL('image/jpeg', 1.0),
                'JPEG',
                0,
                0,
                imgWidth,
                imgHeight
            );

            pdf.save('{{ $event->title }}-ticket.pdf');

        } catch (error) {
            console.error('Error generating PDF:', error);
            alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
        }
    }
    </script>
</x-guest-layout>