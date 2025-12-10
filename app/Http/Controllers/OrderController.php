<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:tickets_for_sale,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.selected' => 'nullable',
        ]);

        $userId = Auth::id();
        $totalAmount = 0;
        $orderItemsData = [];
        $selectedItems = array_filter($request->input('items'), fn($item) => isset($item['selected']));

        if (empty($selectedItems)) {
            return back()->with('error', 'Pilih minimal 1 tiket untuk dibeli.');
        }

        // 2. Proses Item yang Dipilih
        foreach ($selectedItems as $itemId => $item) {

            $ticket = Ticket::find($itemId);

            if (!$ticket) {
                continue;
            }

            $quantity = $item['qty'];

            // Cek Ketersediaan Stok
            if ($ticket->quantity < $quantity) {
                 throw ValidationException::withMessages(['items.' . $itemId . '.qty' => 'Stok tiket ' . $ticket->event_name . ' tidak mencukupi (' . $ticket->quantity . ' tersedia).']);
            }

            $price = $ticket->price; // Gunakan harga dari DB
            $subtotal = $price * $quantity;
            $totalAmount += $subtotal;

            $orderItemsData[] = [
                'ticket_id' => $ticket->id, 
                'ticket_name' => $ticket->event_name,
                'category' => $ticket->zone . ' • ' . $ticket->category,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal,
            ];

            // Kurangi Stok Tiket di Database
            $ticket->decrement('quantity', $quantity);
        }

        // 3. Buat Order
        $order = Order::create([
            'user_id' => $userId,
            'order_number' => 'KPTIX' . now()->format('Ymd') . rand(100,999),
            'total' => $totalAmount,
            'status' => 'pending',
        ]);

        // 4. Buat Order Items
        foreach ($orderItemsData as $itemData) {
            OrderItem::create(array_merge($itemData, ['order_id' => $order->id]));
        }

        // 5. Redirect ke Halaman Konfirmasi
        return redirect()->route('orders.show', $order->id);
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
        $order->load('items');
        return view('confirmation', compact('order'));
    }
}
