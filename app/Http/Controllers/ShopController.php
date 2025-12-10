<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisiasi Query Builder
        $query = Ticket::with('user')
            ->where('quantity', '>', 0)
            ->orderBy('created_at', 'desc');

        // 2. Ambil semua nilai filter dari Request
        $maxPrice = $request->input('harga'); // Dari slider harga
        $eventNameFromEventPage = $request->input('event_name'); // Dari link halaman Events
        $eventNameFromDropdown = $request->input('event_filter'); // Dari dropdown di sidebar Shop
        $categories = $request->input('kategori'); // Dari checkbox kategori (akan berupa array)

        // 3. Terapkan Filter Harga
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        // 4. Terapkan Filter Nama Event
        // Prioritaskan event_name dari link halaman Events, jika tidak ada, gunakan dari dropdown sidebar
        $targetEventName = $eventNameFromEventPage ?? $eventNameFromDropdown;

        if ($targetEventName) {
            $query->where('event_name', $targetEventName);
        }

        // 5. Terapkan Filter Kategori (Checkbox)
        if (!empty($categories)) {
            // Gunakan whereIn() untuk mencari tiket yang kategorinya ada dalam array $categories
            // Misalnya: Jika user centang Standing dan VIP, akan mencari tiket category = 'standing' ATAU 'vip'
            $query->whereIn('category', $categories);
        }


        // 6. Ambil data yang sudah difilter
        $dbTickets = $query->get();

        // 7. Transformasi data (Mapping)
        $tickets = $dbTickets->map(function ($ticket) {

            $categoryDetail = $ticket->zone . ' • ' . ucwords($ticket->category);

            // Logika Path Gambar (Sudah benar dan optimal)
            $imageUrl = $ticket->proof_path
                            ? asset('storage/' . $ticket->proof_path)
                            : asset('storage/proofs/LUVITY TIKET.jpg');

            return [
                'id' => $ticket->id,
                'image_url' => $imageUrl,
                'name' => $ticket->event_name,
                'category' => $categoryDetail,
                'price' => $ticket->price,
                'seller' => $ticket->user->name ?? 'Anonim',
                'available' => $ticket->quantity,
            ];
        });

        // 8. Kirim data ke view
        return view('shop', compact('tickets'));
    }
}
