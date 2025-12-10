<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Ubah method index untuk menerima objek Request
    public function index(Request $request)
    {
        // 1. Ambil nilai Filter Harga & Search Query
        // max_price: Dari slider filter harga. Default: 5000000.
        $maxPrice = $request->input('max_price', 5000000);

        // q: Dari search bar. Jika kosong, nilainya null.
        $searchQuery = $request->input('q');

        // 2. Inisiasi Query Builder
        $query = Event::query();

        // 3. Terapkan Filter Harga (Filter 1)
        if ($maxPrice) {
            $query->where('harga_min', '<=', $maxPrice);
        }

        // 4. Terapkan Logika Pencarian (Filter 2: Search)
        if ($searchQuery) {
            // Mencari event yang nama_event-nya mengandung (LIKE) kata kunci
            $query->where('nama_event', 'like', '%' . $searchQuery . '%');
        }

        // 5. Ambil data dan urutkan
        // Query builder tetap diurutkan berdasarkan tanggal terdekat
        $events = $query->orderBy('tanggal_event', 'asc')->get();

        // 6. Kirimkan data ke view
        // View akan otomatis mempertahankan state (max_price dan q) menggunakan request() helper.
        return view('events', compact('events'));
    }
}
