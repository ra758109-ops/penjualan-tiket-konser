<x-layoutuser title="Homepage">

    <!-- HERO IMAGE -->
    <section class="relative w-full h-[550px]">
        <img src="/image/bg.jpeg"
             class="w-full h-full object-cover brightness-75">

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center">
            <h2 class="text-4xl font-bold">CARI IDOL FAVORITMU</h2>
            <p class="text-lg mt-2">Temukan jadwal konser terbaru dan acara fan meeting.</p>

            <a href="/events"
               class="mt-4 bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-lg font-bold">
               CARI EVENTS
            </a>
        </div>
    </section>

    <!-- 3 FITUR -->
    <section class="py-16 bg-white">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 text-center">

            <div>
                <div class="text-green-500 text-4xl mb-3">✔</div>
                <h3 class="font-bold text-lg">PILIH ACARA DAN TIKET</h3>
                <p class="text-gray-500 mt-2">Hanya dengan beberapa klik.</p>
            </div>

            <div>
                <div class="text-blue-500 text-4xl mb-3">💳</div>
                <h3 class="font-bold text-lg">BAYAR LANGSUNG</h3>
                <p class="text-gray-500 mt-2">Bayar online atau COD.</p>
            </div>

            <div>
                <div class="text-purple-500 text-4xl mb-3">🎟️</div>
                <h3 class="font-bold text-lg">TERIMA TIKET</h3>
                <p class="text-gray-500 mt-2">Via email atau akun anda.</p>
            </div>

        </div>
    </section>

    <!-- UPCOMING EVENTS -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto text-center">

            <h2 class="text-3xl font-bold mb-10">📅 Upcoming Events</h2>

            <!-- Grid center -->
            <div class="flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl place-items-center">

                    <!-- Card 1 -->
                    <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition w-full max-w-sm">
                        <img src="/image/aespa.jpeg" class="w-full h-56 object-cover">
                        <div class="p-5 text-left">
                            <h3 class="font-bold text-lg text-purple-700">FAN MEETING LIVE IN JAKARTA</h3>
                            <p class="text-gray-500 text-sm mt-1">Jakarta, Indonesia • 2025</p>
                            <p class="mt-2 font-semibold">Rp 1,000,000 – Rp 3,500,000</p>
                            <span class="inline-block mt-3 px-3 py-1 text-xs bg-yellow-100 border rounded">⭐ KPOP</span>

                            </a>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition w-full max-w-sm">
                        <img src="/image/nctdream.jpg" class="w-full h-56 object-cover">
                        <div class="p-5 text-left">
                            <h3 class="font-bold text-lg text-purple-700">NCT DREAM CONCERT</h3>
                            <p class="text-gray-500 text-sm mt-1">Bandung, Indonesia • 2025</p>
                            <p class="mt-2 font-semibold">Rp 850,000 – Rp 2,500,000</p>
                            <span class="inline-block mt-3 px-3 py-1 text-xs bg-purple-100 border rounded">🎵 MUSIC</span>

                            </a>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition w-full max-w-sm">
                        <img src="/image/tour.jpeg" class="w-full h-56 object-cover">
                        <div class="p-5 text-left">
                            <h3 class="font-bold text-lg text-purple-700">WORLD TOUR 2026: FINALE</h3>
                            <p class="text-gray-500 text-sm mt-1">Surabaya, Indonesia • 2025</p>
                            <p class="mt-2 font-semibold">Rp 1.500,000 – Rp 5.000,000</p>
                            <span class="inline-block mt-3 px-3 py-1 text-xs bg-green-100 border rounded">🎤 LIVE</span>

                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</x-layoutuser>
