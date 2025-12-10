<x-layoutuser title="Order Confirmation">

<section class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white shadow-xl rounded-2xl p-10 text-center">
        <div class="text-6xl mb-6">✅</div>
        <h1 class="text-3xl font-bold mb-3">PESANAN BERHASIL!</h1>
        <p class="text-gray-600 mb-6">Terima kasih! Tiket Anda telah berhasil diproses.</p>

        <div class="bg-gray-50 border rounded-xl p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Ringkasan Tiket Anda</h2>
            @foreach($order->items as $item)
                <div class="mb-3">
                    <p class="font-semibold">{{ $item->ticket_name }}</p>
                    <p class="text-gray-600 text-sm">
                        Kategori: {{ $item->category }} | Jumlah: {{ $item->quantity }} Tiket
                    </p>
                    <p class="font-semibold mt-1">Subtotal: Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
            <hr class="my-4 border-gray-300">
            <p class="text-lg font-bold flex justify-between">
                TOTAL PEMBAYARAN:
                <span class="text-purple-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </p>
        </div>

        <p class="font-medium text-gray-700 mb-1">Nomor Pesanan Anda: <span class="font-bold">{{ $order->order_number }}</span></p>
        <p class="text-gray-600 mb-6">Detail e-ticket (QR Code) akan dikirim ke email Anda dalam waktu 1x24 jam.</p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('shop.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold">KEMBALI KE BERANDA</a>
        </div>
    </div>
</section>

</x-layoutuser>
