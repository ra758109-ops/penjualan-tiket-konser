<x-layoutuser title="Semua Event K–Pop">


<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-2">Semua Event K–Pop 🎵</h1>
    <div class="w-full h-[3px] bg-purple-600 rounded mb-6"></div>

    {{-- KONTEN UTAMA DENGAN FORM FILTER --}}
    <form method="GET" action="{{ route('events.index') }}">

        {{-- SEARCH BAR (SEKARANG DINAMIS DAN DI DALAM FORM) --}}
        <div class="flex gap-3 mb-8">
            <input type="text"
                name="q" {{-- 🌟 NAME UNTUK LOGIKA SEARCH DI CONTROLLER 🌟 --}}
                value="{{ request('q') }}" {{-- 🌟 MEMPERTAHANKAN NILAI PENCARIAN 🌟 --}}
                placeholder="Cari berdasarkan nama idol atau kota..."
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-purple-400 focus:border-purple-400">
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                Cari
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- FILTER FORM SIDEBAR --}}
            <div class="lg:col-span-1 bg-white p-5 rounded-xl shadow-md h-max sticky top-5">

                {{-- H3 dan filter lainnya tetap di dalam form --}}
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2 text-purple-700">
                    <i class="text-xl">🔍</i> Filter Event
                </h3>

                <label class="font-semibold block mb-2">Kategori</label>
                <div class="mt-2 mb-4 space-y-2 text-sm">
                    {{-- Ini harus ditambahkan name agar bisa difilter di backend --}}
                    <label class="block"><input type="checkbox" name="kategori[]" value="konser" class="mr-2" checked> Konser K-Pop</label>
                    <label class="block"><input type="checkbox" name="kategori[]" value="fanmeeting" class="mr-2"> Fan Meeting</label>
                    <label class="block"><input type="checkbox" name="kategori[]" value="festival" class="mr-2"> Festival</label>
                    <label class="block"><input type="checkbox" name="kategori[]" value="lainnya" class="mr-2"> Lainnya</label>
                </div>

                <div class="w-full h-[1px] bg-gray-300 my-3"></div>

                <label class="font-semibold block mb-2">Lokasi</label>
                <select name="lokasi" class="w-full mt-2 mb-4 border p-2 rounded bg-white focus:ring-purple-400 focus:border-purple-400">
                    <option value="">Semua Lokasi</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Surabaya">Surabaya</option>
                </select>

                <label class="font-semibold block mb-2">Harga (IDR)</label>

                {{-- INPUT HARGA DENGAN NAME DAN VALUE DINAMIS --}}
                <input type="range"
                    id="price-range"
                    name="max_price" {{-- NAME PENTING UNTUK CONTROLLER --}}
                    min="100000"
                    max="5000000"
                    step="100000"
                    value="{{ request('max_price', 5000000) }}"
                    class="w-full mt-2 appearance-none h-2 bg-purple-200 rounded-lg cursor-pointer range-lg accent-purple-600">

                <p class="text-sm mt-1">Maksimum: <span class="font-semibold text-purple-600" id="max-price-display">Rp 5.000.000</span></p>

                <button type="submit" class="w-full mt-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Terapkan Filter
                </button>

            </div>
            {{-- AKHIR FILTER FORM SIDEBAR --}}


            {{-- LIST EVENT --}}
            <div class="lg:col-span-3 space-y-8">

                {{-- **BAGIAN INI HARUS DICEK KETAT UNTUK @ENDIF DAN @ENDFOREACH** --}}
                @if(isset($events) && count($events) > 0)
                    {{-- Loop Data dari Database --}}
                    @foreach ($events as $event)
                    <div class="bg-white shadow-xl rounded-xl p-5 flex gap-5 hover:shadow-2xl transition duration-300 border-l-4 border-purple-500">
                        <img src="{{ $event->image_url ?? '/image/default.jpeg' }}" class="w-60 h-40 object-cover rounded-lg">

                        <div class="flex flex-col justify-between w-full">
                            <div>
                                <h2 class="text-xl font-bold text-purple-700">{{ $event->nama_event ?? 'Nama Event Default' }}</h2>

                                <p class="text-sm mt-2 flex items-center gap-1">
                                    📅 {{ isset($event->tanggal_event) ? \Carbon\Carbon::parse($event->tanggal_event)->format('d F Y') : 'Tanggal Tidak Tersedia' }}
                                </p>
                                <p class="text-sm flex items-center gap-1">📍 {{ $event->lokasi ?? 'Lokasi Tidak Tersedia' }}</p>

                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $event->deskripsi_singkat ?? 'Deskripsi singkat tidak tersedia.' }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <span class="px-4 py-1 bg-pink-100 text-pink-700 rounded-full text-sm font-semibold border border-pink-300">
                                    Mulai dari **Rp {{ isset($event->harga_min) ? number_format($event->harga_min, 0, ',', '.') : 'Harga T/A' }}**
                                </span>
                                <a href="{{ route('shop.index', ['event_name' => $event->nama_event]) }}"
                                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 shadow-md">
                                         Lihat & Beli Tiket
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    {{-- Jika tidak ada data event --}}
                    <div class="col-span-3 bg-white p-8 rounded-xl shadow-md text-center">
                        {{-- Pesan disesuaikan jika tidak ada hasil dari filter/search --}}
                        @if (request('q') || request('max_price') != 5000000)
                            <p class="text-xl text-gray-600">🥺 Maaf, tidak ditemukan Event K-Pop yang sesuai dengan kriteria Anda.</p>
                        @else
                            <p class="text-xl text-gray-600">🎉 Belum ada Event K-Pop yang tersedia saat ini!</p>
                        @endif
                        <p class="text-sm text-gray-400 mt-2">Silakan ubah filter atau coba kata kunci pencarian lain.</p>
                    </div>
                @endif

            </div>

        </div>
    </form> {{-- AKHIR FORM FILTER BESAR --}}

</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceSlider = document.getElementById('price-range');
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

            // 1. Set nilai awal saat halaman dimuat
            priceDisplay.textContent = formatRupiah(parseInt(priceSlider.value));

            // 2. Update nilai saat slider digeser
            priceSlider.addEventListener('input', function() {
                const value = parseInt(this.value);
                priceDisplay.textContent = formatRupiah(value);
            });
        }
    });
</script>
@endpush
</x-layoutuser>
