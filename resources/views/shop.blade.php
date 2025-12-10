<x-layoutuser :title="'Marketplace Tiket K-Pop'">

    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-col items-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 flex items-center mb-3">
                <span class="mr-3 text-purple-600">🛒</span> Marketplace Tiket K-Pop Tersedia
            </h1>
            <div class="w-full h-[3px] bg-purple-600 rounded mb-6"></div>
        </div>

        {{-- CONTAINER UTAMA: MEMBAGI MENJADI SIDEBAR DAN LIST --}}
        <div class="flex flex-col md:flex-row gap-8">

            {{-- BAGIAN KIRI: FILTER SIDEBAR (1/4 Lebar) --}}
            <div class="md:w-1/4">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">

                    {{-- MULAI FORM FILTER --}}
                    <form method="GET" action="{{ route('shop.index') }}">

                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="mr-2 text-purple-600">🔍</span> Filter Tiket
                        </h2>
                        <hr class="mb-5 border-purple-400">

                        {{-- 1. Filter Event --}}
                        <div class="mb-5">
                            <label for="event" class="block text-sm font-medium text-gray-700 mb-2">Event</label>
                            <select id="event" name="event_filter" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500 text-gray-700">
                                <option value="">Semua Event</option>
                                <option>CRAVITY: THE LIGHT PARTY</option>
                                <option>NCT DREAM: THE DREAM SHOW 3</option>
                                <option>SEVENTEEN: THE CARAT LAND FESTIVAL</option>
                                <option>IVE: AFTER PARTY WITH DIVE</option>
                            </select>
                        </div>

                        {{-- 2. Filter Kategori Checkbox --}}
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="kategori[]" value="standing" class="rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Standing (Berdiri)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="kategori[]" value="seating" class="rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Seating (Duduk)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="kategori[]" value="vip" class="rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">VIP/Premium</span>
                                </label>
                            </div>
                        </div>

                        {{-- 3. Filter Harga --}}
                        <div class="mb-6">
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga (IDR)</label>

                            <input type="range"
                                id="harga"
                                name="harga"
                                min="100000"
                                max="5000000"
                                step="100000"
                                value="{{ request('harga', 5000000) }}"
                                class="w-full h-2 bg-purple-200 rounded-lg appearance-none cursor-pointer">

                            <p class="mt-2 text-sm text-gray-600">Maksimum: <span class="font-bold text-red-600" id="max-price-display">Rp 5.000.000</span></p>
                        </div>

                        {{-- TOMBOL SUBMIT UNTUK FILTER --}}
                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-lg transition duration-150">
                            Terapkan Filter
                        </button>

                    </form> {{-- TUTUP FORM FILTER --}}

                </div>
            </div>

            {{-- BAGIAN KANAN: DAFTAR TIKET (3/4 Lebar) --}}
            <div class="md:w-3/4">

                {{-- FORM ORDER (Beli Sekarang) --}}
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        @forelse ($tickets as $ticket)
                            {{-- ... Detail Tiket ... --}}
                            <div class="bg-white p-6 rounded-xl shadow-lg flex justify-between items-center border border-gray-200 hover:shadow-xl transition duration-300">
                                <div class="flex items-start gap-4">
                                    <img src="{{ $ticket['image_url'] }}"
                                        alt="Bukti Tiket {{ $ticket['name'] }}"
                                        class="w-24 h-24 object-cover rounded-lg border border-gray-300 shadow-sm">

                                    <div>
                                        <p class="text-xl font-bold text-violet-700 mb-1">{{ $ticket['name'] }}</p>
                                        <p class="text-gray-600 mb-2">{{ $ticket['category'] }}</p>

                                        <h3 class="mt-2 text-2xl font-extrabold text-red-600">
                                            Rp {{ number_format($ticket['price'], 0, ',', '.') }}
                                        </h3>
                                        <p class="text-gray-500 text-sm mt-1">Seller: {{ $ticket['seller'] }}</p>
                                        <p class="text-green-600 text-sm font-medium">Tersedia: {{ $ticket['available'] }}</p>
                                    </div>
                                </div>

                                <div class="text-right flex flex-col items-end space-y-3">
                                    {{-- Checkbox --}}
                                    <div class="flex items-center space-x-2">
                                        <label for="select-{{ $ticket['id'] }}" class="text-sm font-medium text-gray-700">Pilih:</label>
                                        <input type="checkbox" id="select-{{ $ticket['id'] }}" name="items[{{ $ticket['id'] }}][selected]"
                                            class="w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                                    </div>

                                    {{-- Qty --}}
                                    <input type="number" name="items[{{ $ticket['id'] }}][qty]"
                                        min="1" max="{{ $ticket['available'] }}"
                                        class="w-20 border border-gray-300 rounded text-center text-gray-900 focus:border-purple-500 focus:ring-purple-500"
                                        placeholder="Qty" value="1">

                                    {{-- Hidden fields --}}
                                    <input type="hidden" name="items[{{ $ticket['id'] }}][name]" value="{{ $ticket['name'] }}">
                                    <input type="hidden" name="items[{{ $ticket['id'] }}][price]" value="{{ $ticket['price'] }}">
                                    <input type="hidden" name="items[{{ $ticket['id'] }}][id]" value="{{ $ticket['id'] }}">
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-10 bg-gray-50 rounded-xl shadow-inner">
                                <p class="text-lg text-gray-600">Maaf, belum ada tiket yang tersedia saat ini.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-10 text-center">
                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-7 py-3 rounded-lg font-bold text-lg shadow-md transition duration-150">
                            Beli Sekarang
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </section>

    {{-- 🌟 SCRIPT DIPINDAHKAN KE @push('scripts') 🌟 --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceSlider = document.getElementById('harga');
            const priceDisplay = document.getElementById('max-price-display');

            // Fungsi untuk format angka ke IDR
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            };

            if (priceSlider && priceDisplay) {
                // Set nilai awal saat dimuat (Menggunakan nilai dari request/default)
                const initialValue = parseInt(priceSlider.value);
                priceDisplay.textContent = formatRupiah(initialValue);

                // Listener untuk event geser
                priceSlider.addEventListener('input', function() {
                    const value = parseInt(this.value);
                    priceDisplay.textContent = formatRupiah(value);
                });
            }
        });
    </script>
    @endpush

</x-layoutuser>
