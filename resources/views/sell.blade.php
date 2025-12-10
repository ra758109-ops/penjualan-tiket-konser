
<x-layoutuser :title="'Form Jual Tiket'">

    <section class="max-w-4xl mx-auto px-6 py-16">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-3">Formulir Pengajuan Jual Tiket</h1>
            <p class="text-lg text-gray-600">
                Isi detail tiket Anda dan kami akan memprosesnya secepatnya.
            </p>
        </div>

        <div class="bg-white p-8 sm:p-10 rounded-xl shadow-2xl border-t-4 border-yellow-500">


            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline"> Mohon periksa kembali input Anda.</span>
                    <ul class="mt-3 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Detail Tiket</h2>

            <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="event_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Event</label>
                        <input type="text" id="event_name" name="event_name" placeholder="Contoh: CRAVITY THE LIGHT PARTY" required
                               class="w-full px-4 py-3 border @error('event_name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-150"
                               value="{{ old('event_name') }}">
                        @error('event_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori Tiket</label>
                        <select id="category" name="category" required
                                class="w-full px-4 py-3 border @error('category') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-150">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="konser" {{ old('category') == 'konser' ? 'selected' : '' }}>Konser K-Pop</option>
                            <option value="fan-meeting" {{ old('category') == 'fan-meeting' ? 'selected' : '' }}>Fan Meeting</option>
                            <option value="festival" {{ old('category') == 'festival' ? 'selected' : '' }}>Festival & Gathering</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="zone" class="block text-sm font-medium text-gray-700 mb-1">Zona / Bagian</label>
                        <input type="text" id="zone" name="zone" placeholder="Contoh: VIP Standing A / CAT 3 Seating" required
                               class="w-full px-4 py-3 border @error('zone') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-150"
                               value="{{ old('zone') }}">
                        @error('zone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tiket</label>
                        <input type="number" id="quantity" name="quantity" placeholder="1 atau 2" min="1" required
                               class="w-full px-4 py-3 border @error('quantity') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-150"
                               value="{{ old('quantity') }}">
                        @error('quantity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga Jual per Tiket (IDR)</label>
                    <input type="number" id="price" name="price" placeholder="Contoh: 3100000" required
                           class="w-full px-4 py-3 border @error('price') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-150"
                           value="{{ old('price') }}">
                    <p class="text-xs text-gray-400 mt-2">Harga ini adalah harga bersih yang Anda harapkan.</p>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8 p-5 border-2 border-dashed border-purple-300 rounded-lg bg-purple-50 text-center">
                    <p class="text-sm font-semibold text-gray-700 mb-3">Upload Bukti Kepemilikan Tiket</p>
                    <input type="file" name="proof" required
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-100 file:text-yellow-700 hover:file:bg-yellow-200">
                    <p class="text-xs text-gray-400 mt-2">Pastikan tiket terlihat jelas. Format: PDF, JPG, PNG (Maks 5MB)</p>
                    @error('proof')
                        <p class="text-red-500 text-xs mt-1 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-extrabold py-3 rounded-lg shadow-md transition duration-150 ease-in-out uppercase text-lg">
                    AJUKAN PENJUALAN TIKET
                </button>
            </form>

            <p class="text-center text-xs text-gray-500 mt-6">
                *Pengajuan akan diverifikasi oleh tim KPOP TIX dalam 1x24 jam.
            </p>

        </div>
    </section>

</x-layoutuser>
