<x-layoutuser :title="'Jelajahi Kategori Tiket'">

    <section class="max-w-7xl mx-auto px-6 py-16">

        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-2 text-center">
            <span class="text-purple-600">🎫</span> Jelajahi Kategori Tiket
        </h1>
        <p class="text-lg text-gray-600 mb-12 text-center">
            Temukan jenis tiket yang paling sesuai dengan kebutuhan K-Pop Anda.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white border-2 border-purple-400 p-6 rounded-xl shadow-lg
                        transition duration-300 ease-in-out hover:scale-[1.01] hover:shadow-xl hover:shadow-purple-300/50
                        flex flex-col justify-between">
                <div>
                    <div class="text-4xl text-center mb-4">🎤</div>
                    <h2 class="text-xl font-extrabold text-purple-600 mb-2 text-center">Tiket Konser K-Pop</h2>
                    <p class="text-sm text-gray-500 mb-5 text-center min-h-[50px]">
                        Tiket untuk pertunjukan musik skala besar. Tersedia kategori Standing dan Seating.
                    </p>

                    <ul class="text-sm space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Akses penuh ke acara
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Pilihan kategori VIP/Reguler
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Jadwal tur dunia terbaru
                        </li>
                    </ul>
                </div>

                <a href="{{ route('shop.index', ['category' => 'konser']) }}"
                    class="block w-full text-center bg-violet-600 hover:bg-violet-700 text-white py-3 rounded-lg font-semibold tracking-wide transition duration-150 ease-in-out uppercase text-sm">
                    LIHAT TIKET
                </a>
            </div>

            {{-- TIKET FAN MEETING --}}
            <div class="bg-white border-2 border-purple-400 p-6 rounded-xl shadow-lg
                        transition duration-300 ease-in-out hover:scale-[1.01] hover:shadow-xl hover:shadow-purple-300/50
                        flex flex-col justify-between">
                <div>
                    <div class="text-4xl text-center mb-4">🌟</div>
                    <h2 class="text-xl font-extrabold text-purple-600 mb-2 text-center">Tiket Fan Meeting</h2>
                    <p class="text-sm text-gray-500 mb-5 text-center min-h-[50px]">
                        Acara interaktif lebih dekat dengan idola, sering kali menyertakan *hi-touch* atau *photo op*.
                    </p>

                    <ul class="text-sm space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Sesi tanya jawab & games
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Kesempatan *fan sign*
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Tempat duduk premium
                        </li>
                    </ul>
                </div>

                <a href="{{ route('shop.index', ['category' => 'fan-meeting']) }}"
                    class="block w-full text-center bg-violet-600 hover:bg-violet-700 text-white py-3 rounded-lg font-semibold tracking-wide transition duration-150 ease-in-out uppercase text-sm">
                    CARI FAN MEET
                </a>
            </div>

            {{-- TIKET FESTIVAL & GATHERING --}}
            <div class="bg-white border-2 border-purple-400 p-6 rounded-xl shadow-lg
                        transition duration-300 ease-in-out hover:scale-[1.01] hover:shadow-xl hover:shadow-purple-300/50
                        flex flex-col justify-between">
                <div>

                    <div class="text-4xl text-center mb-4">🎉</div>
                    <h2 class="text-xl font-extrabold text-purple-600 mb-2 text-center">Tiket Festival & Gathering</h2>
                    <p class="text-sm text-gray-500 mb-5 text-center min-h-[50px]">
                        Tiket untuk acara multi-artis atau festival musik K-Pop yang diadakan selama beberapa hari.
                    </p>

                    <ul class="text-sm space-y-3 mb-8">
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Akses ke banyak *line-up*
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Tiket harian atau 3-hari
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="text-purple-500 mr-2">✓</span> Area *merchandise* dan *food court*
                        </li>
                    </ul>
                </div>

                <a href="{{ route('shop.index', ['category' => 'festival']) }}"
                    class="block w-full text-center bg-violet-600 hover:bg-violet-700 text-white py-3 rounded-lg font-semibold tracking-wide transition duration-150 ease-in-out uppercase text-sm">
                    JELAJAHI FESTIVAL
                </a>
            </div>

        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 py-12 mb-16">
        <div class="bg-blue-50 text-center p-8 sm:p-10 shadow-xl rounded-xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Punya Tiket yang Ingin Dijual?</h2>
            <p class="text-gray-600 mb-6 max-w-lg mx-auto">
                Kami menyediakan platform terpercaya untuk menjual tiket K-Pop yang kelebihan Anda, dengan sistem aman dan transparan.
            </p>

            <a href="{{ route('sell.index') }}"
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-extrabold py-3 px-8 rounded-lg shadow-md transition duration-150 ease-in-out uppercase text-sm">
                JUAL TIKET SAYA SEKARANG
            </a>
        </div>
    </section>


</x-layoutuser>
